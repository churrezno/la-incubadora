<?php

namespace App\Http\Controllers;

use App\Mail\ContactoMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    public function index() {
        
        return view('pages.contacto');
    }



    public function store(Request $request) {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'mensaje' => 'required',
        ]);

        Mail::to('jorge@devala.es')
            ->send(new ContactoMailable($request->all()));
            
        //session()->flash('info', 'Su mensaje se ha enviado correctamente');
        return redirect()
                ->route('contacto.index')
                ->with('info', 'Su mensaje se ha enviado correctamente :)');
    }
}
