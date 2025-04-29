<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Gopay;
use App\Models\Livre;
use App\Models\Taux;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PAYAPIController extends Controller
{
    public function init_payment()
    {
        $validator = Validator::make(
            request()->all(),
            [
                'devise' => 'required|in:CDF,USD',
                'book_id' => 'required|exists:livre,id',
                'telephone' => 'required'
            ]
        );

        if ($validator->fails()) {
            $m = implode(', ', $validator->errors()->all());
            return response([
                'success' => false,
                'message' => $m
            ]);
        }
        $tel = request()->telephone;
        $tel = "+" . ((int) $tel);

        $ok = preg_match('/(\+24390|\+24399|\+24397|\+24398|\+24380|\+24381|\+24382|\+24383|\+24384|\+24385|\+24389)[0-9]{7}/', $tel);

        if (!$ok) {
            $m = "Le numéro $tel est invalide";
            return response([
                'success' => false,
                'message' => $m
            ]);
        }

        $devise = request()->devise;
        $book = Livre::where('id', request('book_id'))->first();
        $amount = reduction($book);
        $amount = change($amount, $book->devise, $devise);

        if ($devise == 'CDF' and $amount < 500) {
            return response([
                'success' => false,
                'message' => "Le montant minimum de paiement est de 500 CDF"
            ]);
        } else if ($devise == 'USD' and  $amount < 1) {
            return response([
                'success' => false,
                'message' => 'Le montant minimum de paiement est de 1 USD'
            ]);
        }
        $user = auth()->user();

        $myref = 'myref' . time() . rand(10000, 90000);
        $gopay = Gopay::create([
            'myref' => $myref,
            'issaved' => 0,
            'isfailed' => 0,
            'paydata' => json_encode([
                'users_id' => $user->id,
                'myref' => $myref,
                'livre' => $book->titre,
                'livre_id' => $book->id,
                'data' => json_encode(['devise' => $devise, 'montant' => $amount, 'phone' => $tel, 'book' => $book]),
            ]),
            'date' => nnow()
        ]);
        $r = gopay_init_payment($amount, $devise, $tel, $myref);

        $ref = null;
        if ($r->success) {
            $ref = $r->data->ref;
            $gopay->update(compact('ref'));
        }

        return response([
            'success' =>  $r->success,
            'message' => $r->message,
            'data' => ['myref' => $myref]
        ]);
    }

    public function check_payment()
    {
        $myref = request()->myref;
        $ok =  false;
        $issaved = 0;
        $trans = Gopay::where(['myref' => $myref])->lockForUpdate()->first();

        if (!$trans) {
            return response([
                'success' => false,
                'message' => "Invalid ref"
            ]);
        };

        $t = transaction_status($myref);
        $status = @$t->status;

        if ($status === 'success') {
            $issaved = @Gopay::where(['myref' => $myref])->first()->issaved;
            if ($issaved !== 1) {
                $paydata = json_decode($trans->paydata);
                saveData($paydata, $trans);
                $ok =  true;
                $trans->update(['isfailed' => 0]);
            }
        } else if ($status === 'failed') {
            $trans->update(['isfailed' => 1]);
        }

        if ($ok || $issaved === 1 || @$trans->issaved === 1) {
            return response([
                'success' => true,
                'message' => 'Votre transaction est effectuée.',
                'transaction' => $t
            ]);
        } else {
            $m = "Aucune transation trouvée.";
            return response([
                'success' => false,
                'message' => $m,
                'transaction' => $t
            ]);
        }
    }

    function subscribeval()
    {
        $devise = request('devise');
        $book_id = request('book_id');
        $book = Livre::where('id', $book_id)->first();
        abort_if(!$book, 404, 'uhm');
        $prix = reduction($book);
        $dev = $book->devise;

        $val = change($prix, $dev, $devise);
        return [
            'val' => v(round($val, 2), $devise)
        ];
        abort(422);
    }
}
