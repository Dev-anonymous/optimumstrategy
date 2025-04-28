<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\App;
use App\Models\Message;
use App\Models\Solde;
use App\Models\User;
use Illuminate\Http\Request;

class ClientAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $app = User::where('user_role', 'client')->orderBy('derniere_connexion', 'desc')->get();
        $tab = [];

        foreach ($app as $el) {
            $o = (object) $el->toArray();
            $o->derniere_connexion = $el->derniere_connexion?->format('d-m-Y H:i:s');
            $o->datecreation = $el->created_at?->format('d-m-Y H:i:s');
            $tab[] = $o;
        }


        return response()->json([
            'success' => true,
            'data' => $tab
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(App $client)
    {
        $label = 'Déconnecté';
        $actif = "<b class='badge badge-danger text-white'> <i class='fa fa-wifi'></i> DECONNECTE</b>";
        $el = $client;
        if ($el->last_login) {
            $n = $el->last_login->diffInDays();
            $l = $el->last_login->diffForHumans();

            $isco = isconnected($el->last_login);

            if ($isco->ok) {
                $label = 'Connecté';
                $actif =
                    "<b class='badge badge-success text-white'> <i class='fa fa-wifi'></i> CONNECTE</b>";
            } else {
                if ($isco->days >= 8) {
                    $label = $isco->label;
                    $actif =
                        "<b class='badge badge-info'> <i class='fa fa-check-circle'></i> ACTIF</b>";
                }
            }
            $actif .= "<br><i>$isco->label</i>";
        }
        $solde = $client->soldes()->first()->solde_usd;
        $data['profil'] = [
            'client' => $client->nom ?? '-',
            'tel' => $client->telephone ?? '-',
            'email' => $client->email ?? '-',
            'uid' => $client->uid ?? '-',
            'deviceid' => $client->deviceid ?? '-',
            'status' => $actif,
            'solde' => v($solde, 'USD')
        ];

        $tab = [];
        foreach ($client->paiements()->orderBy('id', 'desc')->get() as $el) {
            $o = (object)[];
            $o->ref = $el->ref;
            $o->montant = v($el->montant, $el->devise);
            $o->date = $el->date->format('d-m-Y H:i:s');
            $o->methode = $el->methode;
            $o->image = $el->methode == 'mobile_money' ? asset('images/mmoney.png') : asset('images/visa.png');
            $tab[] = $o;
        }

        $data['paiement'] = $tab;

        $docta = '';
        $messa = $messr = 0;
        $chat = $client->chats()->first();
        if ($chat) {
            $user = $chat->user;
            if ($user) {
                $docta = ucwords($user->name);
            }
            $messa = Message::where('chat_id', $chat->id)->where('fromuser', 0)->count();
            $messr = Message::where('chat_id', $chat->id)->where('fromuser', 1)->count();
        }

        $data['appareil'] = [
            'marque' => $client->devicename ?? '-',
            'appversion' => $client->appversion ?? '-',
        ];

        $data['message'] = [
            'docta' => $docta,
            'messageenvoye' => $messa,
            'messagerecu' => $messr,
        ];
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, App $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(App $client)
    {
        //
    }
}
