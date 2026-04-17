<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SendMailToUsersMailable;
use App\Models\Inscripcion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendMailToUsersController extends Controller
{
    public function index() {
        
        return view('admin.send-mail-to-users');
    }



    public function store(Request $request) {

        $request->validate([
            'destinatarios' => 'required',
            'mensaje' => 'required',
        ]);

        $destinatariosTipo = $request->destinatarios;

        if ( $destinatariosTipo == 'excluidos' ) 
            $inscripciones = Inscripcion::whereIn('categoria_id', [1, 2])->get();

        elseif ( $destinatariosTipo == 'preseleccionados' )
            $inscripciones = Inscripcion::where('categoria_id', 3)->get();

        foreach ($inscripciones as $inscripcion) {            
            $user = User::find($inscripcion->user_id);
            $emailUser = $user->email;
            
            $request->merge([
                'username' => $user->name,
                'inscripcion' => $inscripcion->titulo
            ]);

            Mail::to($emailUser)
                ->send(new SendMailToUsersMailable($request->all()));
        }

        // Send copy to Rocío Cabrera
        Mail::to('rocio.cabrera@ecam.es')
            ->send(new SendMailToUsersMailable($request->all()));
            
        return redirect()
                ->route('send.mail.index')
                ->with('info', 'Su mensaje se ha enviado correctamente :)');
    }
}
