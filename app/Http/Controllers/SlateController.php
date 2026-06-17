<?php

namespace App\Http\Controllers;

use App\Http\Requests\SlateRequest;
use App\Http\Requests\UpdateSlateRequest;
use App\Mail\SendConfirmationMailToSlateMailable;
use App\Models\Archivo;
use App\Models\Categoria;
use App\Models\Slate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class SlateController extends Controller
{
    public function index()
    {

        $comites = User::role('comite')->get();

        $heads = [
            'Categoría',
            '',
            'Fecha',
            'Productor/a',
            'Puntos',
            'Acción',
        ];

        $config = [
            'autoWidth' => false,
            'language' => [
                'url' => asset('vendor/datatables-plugins/lang/datatables-es-ES.json'),
            ],
            'ajax' => [
                'url' => route('datatable.slates'),
            ],
            'columns' => [
                ['data' => 'DT_RowClass', 'visible' => false],
                ['data' => null, 'defaultContent' => '', 'sortable' => false, 'searchable' => false, 'width' => '60px'],
                ['data' => 'fecha', 'width' => '100px'],
                ['data' => 'productor'],
                ['data' => 'puntos', 'class' => 'puntos', 'width' => '80px'],
                ['data' => 'acciones', 'sortable' => false, 'width' => '120px'],
            ],
            'pageLength' => 10,
            'lengthMenu' => [[10, 25, 50, 75, 100, -1], [10, 25, 50, 75, 100, 'Todas']],
            'buttons' => [
                ['pageLength'],
                ['extend' => 'csvHtml5', 'className' => 'btn-export', 'text' => '<i class="fa-solid fa-fw fa-file-csv"></i>', 'titleAttr' => 'Exportar a CSV'],
                ['extend' => 'excelHtml5', 'className' => 'btn-export', 'text' => '<i class="fa-regular fa-fw fa-file-excel"></i>', 'titleAttr' => 'Exportar a Excel'],
                ['extend' => 'pdfHtml5', 'className' => 'btn-export', 'text' => '<i class="fa-regular fa-fw fa-file-pdf"></i>', 'titleAttr' => 'Exportar a PDF'],
            ],
            'order' => [
                [2, 'desc'],
            ],
            'layout' => [
                'topStart' => 'buttons',
            ],
        ];

        return view('slates.index', compact('comites', 'heads', 'config'));
    }

    
    /* public function store(SlateRequest $request, ?Slate $slate = null)
    {
        $idSlate = ($slate !== null) ?
                        $slate->id :
                        null;

        $request->merge([
            'user_id' => $slate->user_id ?? auth()->user()->id,
            'categoria_id' => $request->categoria_id ?? 1,
        ]);

        if ($idSlate == null) {
            $slate = Slate::create($request->except('pdf_documentacion'));
        } else {
            $slate = Slate::find($idSlate);
            $slate->update($request->except('slate_id', 'pdf_documentacion'));
        }        

        $this->uploadFile($request, $slate, 'pdf_documentacion', 4);

        
        if ($user->hasRole('admin')) {
            return redirect()->route('slates.index');
        } else {
            if ($request->accion == 'guardar') {
                return redirect()->route('home');
            } elseif ($request->accion == 'enviar') {
                // Send mail to user confirming Inscripcion is OK
                //Mail::to($user->email)->send(new SendConfirmationMailToUserMailable($user, $slate));

                return redirect()->route('home')->with('success', 'Perfil de Slate creado correctamente. No podrás editar la información.');
            }
        }
    } */

    public function create(?Slate $slate = null)
    {
        return $this->authorizeEditSlate($slate);
    }

    public function postCreate(SlateRequest $request, ?Slate $slate = null)
    {        
        $idSlate = ($slate !== null) ?
                        $slate->id :
                        null;

        $request->merge([
            'user_id' => $slate->user_id ?? auth()->user()->id,
            'categoria_id' => $request->categoria_id ?? 1,
        ]);


        // Check finished editing => Perfil completo
        if ($request->accion == 'enviar') {
            // Set Slate as COMPLETO
            $request->merge(['complete' => true]);
        }

        $request = $this->updateSwitches($request, ['switch_acepta_bases', 'switch_acepta_politica']);

        if ($idSlate == null) {
            $slate = Slate::create($request->except('pdf_documentacion', 'accion'));
        } else {
            $slate = Slate::find($idSlate);
            $slate->update($request->except('slate_id', 'pdf_documentacion', 'accion'));
        }        

        $this->uploadFile($request, $slate, 'pdf_documentacion', 4);

        $user = auth()->user();
        
        if ($user->hasRole('admin')) {
            return redirect()->route('slates.index');
        } else {
            if ($request->accion == 'guardar') {
                return redirect()->route('home');
            } elseif ($request->accion == 'enviar') {
                // Send mail to user confirming Slate is OK
                Mail::to($user->email)->send(new SendConfirmationMailToSlateMailable($user, $slate));

                return redirect()->route('home')->with('info', 'Perfil de Slate creado correctamente. No podrás editar la información.');
            }
        }
    }


    public function show(Slate $slate)
    {

        $this->authorize('view', $slate);

        $heads = [
            'Valoraciones',
        ];

        $config = [
            'autoWidth' => false,
            'language' => [
                'url' => asset('vendor/datatables-plugins/lang/datatables-es-ES.json'),
            ],
            'ajax' => [
                'url' => route('datatable.valoraciones-slate', $slate->id),
            ],
            'columns' => [
                ['data' => 'valoraciones'],
            ],
            'pageLength' => -1,
            // 'dom' => '<"container-fluid mt-3 mb-3"<"row align-items-end"<"col p-0"B>>>',
            'buttons' => [
                ['extend' => 'csvHtml5', 'className' => 'btn-export', 'text' => '<i class="fa-solid fa-fw fa-file-csv"></i>', 'titleAttr' => 'Exportar a CSV'],
                ['extend' => 'excelHtml5', 'className' => 'btn-export', 'text' => '<i class="fa-regular fa-fw fa-file-excel"></i>', 'titleAttr' => 'Exportar a Excel'],
                ['extend' => 'pdfHtml5', 'className' => 'btn-export', 'text' => '<i class="fa-regular fa-fw fa-file-pdf"></i>', 'titleAttr' => 'Exportar a PDF', 'exportOptions' => ['stripNewlines' => false]],
            ],
            'layout' => [
                'topStart' => 'buttons',
            ],
        ];

        $prev = Slate::where('id', '<', $slate->id)->orderBy('id', 'desc')->first();
        $next = Slate::where('id', '>', $slate->id)->orderBy('id')->first();

        return view('slates.show', compact('slate', 'heads', 'config'))
            ->with('prev', $prev)
            ->with('next', $next);
    }

    public function destroy(Slate $slate)
    {
        $slate->delete();

        return redirect()->route('slates.index')->with('info', 'Slate eliminado :)');
    }

    // FORCE DELETE FROM THRASH BIN
    public function forceDelete($id)
    {
        $slate = Slate::withTrashed()->findOrFail($id);

        try {
            $slate->asignaciones()->forceDelete();
            $slate->archivo()->delete();
            $slate->forceDelete();

            return response()->json(['message' => 'Slate eliminado permanentemente'], 200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al eliminar el slate'], 500);
        }
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

    public function updateCategory(Request $request, Slate $slate)
    {

        $slate->categoria_id = $request->categoria_id;
        $slate->save();
    }

    public function updateSwitches($request, $arraySwitches)
    {

        foreach ($arraySwitches as $switch) {
            if ($request[$switch] == null) {
                $request->merge([$switch => false]);
            }
        }

        return $request;
    }

    public function showToUser(Slate $slate)
    {
        $this->authorize('view', $slate);

        return view('slates.show-to-user', compact('slate'));
    }

    public function edit(Slate $slate)
    {
        $this->authorize('update', $slate);
        $categorias = Categoria::all();

        return view('slates.edit', compact('slate', 'categorias'));
    }

    public function update(UpdateSlateRequest $request, Slate $slate)
    {
        $slate->update($request->except('pdf_documentacion'));

        if ($request->file('pdf_documentacion')) {
            $slate->archivo()->delete();
            $this->uploadFile($request, $slate, 'pdf_documentacion', 4);
        }

        return redirect()->route('slates.show', $slate)->with('info', 'Slate actualizado correctamente');
    }

    public function authorizeEditSlate($slate)
    {

        $user = auth()->user();
        $isAdmin = $user->hasRole('admin');
        $numSlatesUser = Slate::where('user_id', $user->id)->count();
        $categorias = Categoria::all();

        if ($slate != null && ! $isAdmin) {

            if ($slate->user_id != $user->id) {
                return redirect()->route('home')->with('info', '¡Ese perfil no te pertenece!')->with('alert_type', 'warning');
            } elseif ($slate->complete) {
                return redirect()->route('home')->with('info', 'El perfil de"'.$slate->productor.'" ya está enviado y no se puede editar.')->with('alert_type', 'warning');
            }
        }

        return view('slates.create', compact('slate', 'numSlatesUser', 'categorias', 'isAdmin'));
    }
}
