<?php

namespace App\Http\Controllers;

use App\Models\Categorieblog;
use App\Models\Commande;
use App\Models\Contact;
use App\Models\Taux;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function index()
    {
        return view('admin.index');
    }
    function taux()
    {
        $data = Taux::first();
        return view('admin.taux', compact('data'));
    }
    function clients()
    {
        return view('admin.clients');
    }
    function blog()
    {
        $categories = Categorieblog::orderBy('categorie')->get();
        return view('admin.blog', compact('categories'));
    }
    function categorie()
    {
        return view('admin.categorie');
    }
    public function contact()
    {
        $data = Contact::orderBy('id', 'desc')->get();
        return view('admin.contact', compact('data'));
    }

    function commande()
    {
        $commandes = Commande::orderBy('id', 'desc')->get();
        return view('admin.commande', compact('commandes'));
    }
    function livres()
    {
        return view('admin.livres');
    }
}
