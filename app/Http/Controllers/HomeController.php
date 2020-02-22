<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lead;
use Illuminate\Support\Facades\Mail; //percorso per poter utilizzare Mail::
use App\Mail\NewLead; //Percorso per NewLead()

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function contatti() {
        return view('contatti');
    }

    public function contattiStore(Request $request) {
        $new_message = new Lead();
        $new_message->fill($request->all()); //Prendo tutti i dati rievuti dal form
        $new_message->save(); //Salvo nel database

        Mail::to('admin@boolpress.com')->send(new NewLead($new_message)); //invio email all'admin

        return redirect()->route('contatti.grazie');
    }

    public function grazie()
    {
        return view('thanks');
    }
}
