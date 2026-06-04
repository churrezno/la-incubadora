<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SendMailToUsersMailable;
use App\Models\Inscripcion;
use App\Models\Slate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendMailToUsersController extends Controller
{
    public function index() {

        $counts = [
            'desarrollo_descartados' => Inscripcion::whereIn('categoria_id', [1, 2])->count(),
            'desarrollo_preseleccionados' => Inscripcion::where('categoria_id', 3)->count(),
            'slate_descartados' => Slate::whereIn('categoria_id', [1, 2])->count(),
            'slate_preseleccionados' => Slate::where('categoria_id', 3)->count(),
        ];

        return view('admin.send-mail-to-users', compact('counts'));
    }



    public function store(Request $request) {

        $request->validate([
            'tipo' => 'required|in:desarrollo,slate',
            'destinatarios' => 'required',
            'mensaje' => 'required',
        ]);

        $tipo = $request->tipo;
        $destinatariosTipo = $request->destinatarios;

        if ($tipo == 'desarrollo') {
            $records = ($destinatariosTipo == 'descartados')
                ? Inscripcion::whereIn('categoria_id', [1, 2])->get()
                : Inscripcion::where('categoria_id', 3)->get();
        } else {
            $records = ($destinatariosTipo == 'descartados')
                ? Slate::whereIn('categoria_id', [1, 2])->get()
                : Slate::where('categoria_id', 3)->get();
        }

        foreach ($records as $record) {            
            $user = User::find($record->user_id);
            $emailUser = $user->email;
            $recordName = $tipo == 'desarrollo' ? $record->titulo : $record->productor;
            
            $request->merge([
                'username' => $user->name,
                'inscripcion' => $recordName,
                'tipo' => $tipo,
            ]);

            Mail::to($emailUser)
                ->send(new SendMailToUsersMailable($request->all()));
        }

        /* Mail::to('rocio.cabrera@ecam.es')
            ->send(new SendMailToUsersMailable($request->all())); */
            
        return redirect()
                ->route('send.mail.index')
                ->with('info', 'Su mensaje se ha enviado correctamente :)');
    }
}