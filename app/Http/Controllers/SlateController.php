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
        $request->merge(['user_id' => auth()->user()->id, 'categoria_id' => 1]);
        $slate = Slate::create($request->except('pdf_documentacion'));

        $this->uploadFile($request, $slate, 'pdf_documentacion', 4);

        return redirect()->route('home')->with('success', 'Perfil creado correctamente :)');
    }


    public function uploadFile($request, $slate, $inputName, $fileType)
    {

        if ($request->file($inputName)) {
            $fileUrl = Storage::put('archivos', $request->file($inputName));

            Archivo::create([
                'url' => $fileUrl,
                'archivable_id' => $slate->id,
                'archivable_type' => Slate::class,
                'archivo_tipo_id' => $fileType,
            ]);
        }
    }

}
