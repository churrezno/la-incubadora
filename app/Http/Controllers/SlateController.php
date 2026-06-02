<?php

namespace App\Http\Controllers;

use App\Http\Requests\SlateRequest;
use App\Models\Archivo;
use App\Models\Slate;
use Illuminate\Support\Facades\Storage;

class SlateController extends Controller
{
    
    public function store(SlateRequest $request, ?Slate $slate = null)
    {
        $request->merge(['user_id' => auth()->user()->id]);
        Slate::create($request->except('pdf_documentacion'));

        $request->merge([
            'user_id' => $slate->user_id ?? auth()->user()->id,
            'categoria_id' => $request->categoria_id ?? 1,
        ]);

        $this->uploadFile($request, $slate, 'pdf_documentacion', 1);

        return redirect()->route('home')->with('success', 'Perfil creado correctamente :)');
    }


    public function uploadFile($request, $slate, $inputName, $fileType)
    {

        if ($request->file($inputName)) {
            // Delete previous file if exists
            $archivos = $slate->archivos;
            foreach ($archivos as $archivo) {
                if ($archivo->archivo_tipo_id == $fileType) {
                    Storage::delete($archivo->url);
                    $archivo->delete();
                }
            }
            $fileUrl = Storage::put('archivos', $request->file($inputName));

            Archivo::create([
                'url' => $fileUrl,
                'inscripcion_id' => $slate->id,
                'archivo_tipo_id' => $fileType,
            ]);
        }
    }

}
