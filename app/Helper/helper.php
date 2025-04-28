<?php

use App\Models\Blog;
use App\Models\Commande;
use App\Models\Gopay;
use App\Models\Livre;
use App\Models\Taux;
use App\Models\User;
use Illuminate\Support\Facades\DB;

$xApiKey = "MFE2R0s0cEZMZVh2Rm8zb0tZNjNMdz09";

define('API_BASE', 'https://gopay.gooomart.com/api/v2');
define('API_HEADEARS',  [
    "Accept: application/json",
    "Content-Type: application/json",
    "x-api-key: $xApiKey"
]);

function gopay_init_payment($amount, $devise, $telephone, $myref)
{
    $_api_headers = API_HEADEARS;
    $telephone = (float) $telephone;
    $data = array(
        "telephone" => "+$telephone",
        "amount" => $amount,
        "devise" => $devise,
        "myref" => $myref,
    );

    $data = json_encode($data);
    $gateway = API_BASE . "/payment/init";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $gateway);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $_api_headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
    $response = curl_exec($ch);
    $rep['success'] = false;
    if (curl_errno($ch)) {
        $rep['message'] = "Erreur, veuillez reessayer.";
    } else {
        $jsonRes = json_decode($response);
        $rep['success'] = @$jsonRes->success;
        $rep['message'] = @$jsonRes->message;
        $rep['data'] = @$jsonRes->data;
    }
    curl_close($ch);
    return (object) $rep;
}

function completeTrans()
{
    $pendingPayments = Gopay::where(['issaved' => '0', 'isfailed' => '0'])->get();
    foreach ($pendingPayments as $trans) {
        $paydata = json_decode($trans->paydata);
        $myref = $trans->myref;
        $t = transaction_status($myref);
        $status = @$t->status;
        if ($status === 'success') {
            saveData($paydata, $trans);
        } else if ($status === 'failed') {
            $trans->update(['isfailed' => 1]);
        }
    }
}

function transaction_status($myref)
{
    $_api_headers = API_HEADEARS;

    $gateway = API_BASE . "/payment/check/" . $myref;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $gateway);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $_api_headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
    $response = curl_exec($ch);

    $status = null;
    if (!curl_errno($ch)) {
        curl_close($ch);
        $status = @json_decode($response)->transaction;
    }
    return $status;
}

function nnow($date = null)
{
    if ($date) {
        return $date->format('d-m-Y H:i:s');
    }
    return now('Africa/Lubumbashi');
}

function saveData($paydata, $trans)
{
    try {
        DB::transaction(function () use ($paydata, $trans) {
            $d = (array) $paydata;
            $d['date'] =  nnow();
            Commande::create($d);
            $trans->update(['issaved' => 1]);
        });
    } catch (\Throwable $th) {
        // throw $th;
    }
}


function makeRand($prefix = '', $max = 5)
{
    $max = (int) $max;
    if (!$max or $max <= 0) {
        return 0;
    }

    $num = '';
    while ($max > 0) {
        $max--;
        $num .= rand(1, 9);
    }
    return "$prefix$num-" . time();
}


function candl(Blog $blog)
{
    return (bool) $blog->fichier;
}


function v($amount, $devise = '')
{
    return number_format($amount, 2, ',', ' ') . (" $devise");
}

function change($montant, $from, $to)
{
    if (!in_array(strtoupper($from), ['USD', 'CDF']) or !in_array(strtoupper($to), ['USD', 'CDF'])) {
        throw new TypeError("Devise non valide : $from -> $to");
    }
    $att = strtolower("{$from}_{$to}");
    $taux = Taux::first();
    if (!$taux) {
        throw new TypeError("Taux non disponible : $from -> $to");
    }
    $t = $taux->$att;
    if ($from != $to) {
        $montant = $montant * $t;
    }
    return  round($montant, 2);
}

function reduction(Livre $book)
{
    $user = auth()->user();
    if (!$user) {
        return @$book->prix;
    }
    $cmd = $user->commandes()->first();
    if ($cmd) {
        return @$book->prix;
    }
    $m = @$book->prix;
    if (@$book->reduction) {
        $m = @$book->prix - (@$book->prix * (@$book->reduction / 100));
    }
    return $m;
}
