<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\App;
use App\Models\Blog;
use App\Models\Chat;
use App\Models\Commande;
use App\Models\Contact;
use App\Models\Download;
use App\Models\Message;
use App\Models\User;
use App\Models\Visite;
use Illuminate\Http\Request;

class StatistiqueAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        $cmd = Commande::count();
        $clients = User::where('user_role', 'client')->count();
        $blog = Blog::count();
        $contact = Contact::count();

        $nouveauxclients = [];
        $commandes = [];

        foreach (range(1, 12) as $m) {
            $nouveauxclients[] =   User::where('user_role', 'client')->whereMonth('created_at', $m)->count();
            $commandes[] =   Commande::whereMonth('date', $m)->count();
        }
        return response(compact('cmd', 'clients', 'blog', 'contact', 'nouveauxclients', 'commandes'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
