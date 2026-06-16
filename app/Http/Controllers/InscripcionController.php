<?php

namespace App\Http\Controllers;

use App\Http\Requests\InscripcionStepOneRequest;
use App\Http\Requests\InscripcionStepThreeRequest;
use App\Http\Requests\InscripcionStepTwoRequest;
use App\Http\Requests\StoreInscripcionRequest;
use App\Http\Requests\UpdateInscripcionRequest;
use App\Mail\SendConfirmationMailToUserMailable;
use App\Models\Archivo;
use App\Models\Categoria;
use App\Models\Inscripcion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class InscripcionController extends Controller
{
    public function index()
    {

        $comites = User::role('comite')->get();

        $heads = [
            'Categoría',
            '',
            'Fecha',
            'Título',
            'Autor',
            'Puntos',
            'Acción',
        ];

        $config = [
            'autoWidth' => false,
            'language' => [
                'url' => asset('vendor/datatables-plugins/lang/datatables-es-ES.json'),
            ],
            'ajax' => [
                'url' => route('datatable.inscripciones'),
            ],
            'columns' => [
                ['data' => 'DT_RowClass', 'visible' => false],
                ['data' => null, 'defaultContent' => '', 'sortable' => false, 'searchable' => false, 'width' => '60px'],
                ['data' => 'fecha', 'width' => '100px'],
                ['data' => 'titulo', 'class' => 'titulo'],
                ['data' => 'autor'],
                ['data' => 'puntos', 'class' => 'puntos', 'width' => '80px'],
                ['data' => 'acciones', 'sortable' => false, 'width' => '120px'],
            ],
            'pageLength' => 10,
            // 'dom' => '<"container-fluid"<"row mb-3 align-items-end"<"col p-0"B><"col p-0"f>>>rt<"container-fluid"<"row mt-5 mb-5"<"col p-0"i><"col p-0"p>>>',
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

        return view('inscripciones.index', compact('comites', 'heads', 'config'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        $numInscripcionesUser = Inscripcion::where('user_id', auth()->id())->count();

        return view('inscripciones.create', compact('categorias', 'numInscripcionesUser'));
    }

    public function store(StoreInscripcionRequest $request)
    {
        $request->merge(['user_id' => auth()->user()->id]);
        Inscripcion::create($request->all());

        return redirect()->route('inscripciones.index')->with('info', 'Inscripción creada correctamente :)');
    }

    public function show(Inscripcion $inscripcion)
    {

        $this->authorize('view', $inscripcion);

        $heads = [
            'Valoraciones',
        ];

        $config = [
            'autoWidth' => false,
            'language' => [
                'url' => asset('vendor/datatables-plugins/lang/datatables-es-ES.json'),
            ],
            'ajax' => [
                'url' => route('datatable.valoraciones', $inscripcion->id),
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

        $prev = Inscripcion::where('id', '<', $inscripcion->id)->orderBy('id', 'desc')->first();
        $next = Inscripcion::where('id', '>', $inscripcion->id)->orderBy('id')->first();

        return view('inscripciones.show', compact('inscripcion', 'heads', 'config'))
            ->with('prev', $prev)
            ->with('next', $next);
    }

    public function edit(Inscripcion $inscripcion)
    {
        $categorias = Categoria::all();

        return view('inscripciones.edit', compact('inscripcion', 'categorias'));
    }

    public function update(UpdateInscripcionRequest $request, Inscripcion $inscripcion)
    {
        $inscripcion->titulo = $request->titulo;
        $inscripcion->categoria_id = $request->categoria_id;

        $inscripcion->save();

        return redirect()->route('inscripciones.index')->with('info', 'Inscripción actualizada :)');
    }

    public function destroy(Inscripcion $inscripcion)
    {
        $inscripcion->delete();

        return redirect()->route('inscripciones.index')->with('info', 'Inscripción eliminada :)');
    }

    // FORCE DELETE FROM THRASH BIN
    public function forceDelete($id)
    {
        $inscripcion = Inscripcion::withTrashed()->findOrFail($id);

        try {
            $inscripcion->asignaciones()->forceDelete();
            $inscripcion->archivos()->delete();
            $inscripcion->forceDelete();

            return response()->json(['message' => 'Inscripción eliminada permanentemente'], 200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al eliminar la inscripción'], 500);
        }
    }

    /*
    /*
    /* USER FUNCTIONS
    /*
    */

    public function createStepOne(?Inscripcion $inscripcion = null)
    {
        return $this->authorizeEditInscripcion($inscripcion, 1);
    }

    public function postCreateStepOne(InscripcionStepOneRequest $request, ?Inscripcion $inscripcion = null)
    {
        $idInscripcion = ($inscripcion !== null) ?
                        $inscripcion->id :
                        null;

        $request->merge([
            'user_id' => $inscripcion->user_id ?? auth()->user()->id,
            'categoria_id' => $request->categoria_id ?? 1,
        ]);

        $request = $this->updateSwitches($request, [
            'switch_largometrajes',
            'switch_codirector',
            'switch_guionista',
            'switch_coguionista',
        ]);

        if ($idInscripcion == null) {
            $inscripcion = Inscripcion::create($request->except('portada'));
        } else {
            $inscripcion = Inscripcion::find($idInscripcion);
            $inscripcion->update($request->except('inscripcion_id', 'portada'));
        }

        $this->uploadFile($request, $inscripcion, 'portada', 1);

        $user = auth()->user();

        if (! $user->hasRole('admin')) {
            $user->syncRoles('inscrito');
        }

        return redirect()->route('inscripciones.create.step.two', compact('inscripcion'));
    }

    public function createStepTwo(Inscripcion $inscripcion)
    {
        return $this->authorizeEditInscripcion($inscripcion, 2);
    }

    public function postCreateStepTwo(InscripcionStepTwoRequest $request, Inscripcion $inscripcion)
    {
        $accion = $request->accion;

        $request = $this->updateSwitches($request, ['switch_coproductor']);

        $inscripcion->update($request->except('inscripcion_id', 'user_id', 'accion'));

        $user = auth()->user();

        if ($user->hasRole('admin')) {
            return $accion == 'guardar' ?
                redirect()->route('inscripciones.index') :
                redirect()->route('inscripciones.create.step.three', compact('inscripcion'));
        } else {
            return $accion == 'guardar' ?
                redirect()->route('home') :
                redirect()->route('inscripciones.create.step.three', compact('inscripcion'));
        }

    }

    public function createStepThree(Inscripcion $inscripcion)
    {
        return $this->authorizeEditInscripcion($inscripcion, 3);
    }

    public function postCreateStepThree(InscripcionStepThreeRequest $request, Inscripcion $inscripcion)
    {
        // Check finished editing => Inscripcion complete
        if ($request->accion == 'enviar') {
            // Set Inscripcion as COMPLETA
            $request->merge(['complete' => true]);

        }

        $request = $this->updateSwitches($request, ['switch_acepta_bases', 'switch_acepta_politica']);

        $inscripcion->update($request->except('inscripcion_id', 'user_id', 'pdf_guion', 'pdf_info', 'accion'));

        $this->uploadFile($request, $inscripcion, 'pdf_guion', 2);
        $this->uploadFile($request, $inscripcion, 'pdf_info', 3);

        $user = auth()->user();

        /* return ($user->hasRole('admin')) ?
            redirect()->route('inscripciones.index') :
            redirect()->route('home')->with('success', 'Formulario enviado correctamente. No podrás editar la información.'); */

        if ($user->hasRole('admin')) {
            return redirect()->route('inscripciones.index');
        } else {
            if ($request->accion == 'guardar') {
                return redirect()->route('home');
            } elseif ($request->accion == 'enviar') {
                // Send mail to user confirming Inscripcion is OK
                Mail::to($user->email)->send(new SendConfirmationMailToUserMailable($user, $inscripcion));

                return redirect()->route('home')->with('success', 'Formulario enviado correctamente. No podrás editar la información.');
            }
        }

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

    public function uploadFile($request, $inscripcion, $inputName, $fileType)
    {

        if ($request->file($inputName)) {
            // Delete previous file if exists
            $archivos = $inscripcion->archivos;
            foreach ($archivos as $archivo) {
                if ($archivo->archivo_tipo_id == $fileType) {
                    Storage::delete($archivo->url);
                    $archivo->delete();
                }
            }
            $fileUrl = Storage::put('archivos', $request->file($inputName));

            Archivo::create([
                'url' => $fileUrl,
                'archivable_id' => $inscripcion->id,
                'archivable_type' => Inscripcion::class,
                'archivo_tipo_id' => $fileType,
            ]);
        }
    }

    public function updateCategory(Request $request, Inscripcion $inscripcion)
    {

        $inscripcion->categoria_id = $request->categoria_id;
        $inscripcion->save();
    }

    public function showToUser(Inscripcion $inscripcion)
    {
        $this->authorize('view', $inscripcion);

        return view('inscripciones.show-to-user', compact('inscripcion'));
    }

    public function authorizeEditInscripcion($inscripcion, $step)
    {

        $user = auth()->user();
        $isAdmin = $user->hasRole('admin');
        $numInscripcionesUser = Inscripcion::where('user_id', $user->id)->count();
        $categorias = Categoria::all();

        if ($inscripcion != null && ! $isAdmin) {

            if ($inscripcion->user_id != $user->id) {
                return redirect()->route('home')->with('info', '¡Esa inscripción no te pertenece!')->with('alert_type', 'warning');
            } elseif ($inscripcion->complete) {
                return redirect()->route('home')->with('info', 'La inscripción "'.$inscripcion->titulo.'" ya está enviada y no se puede editar.')->with('alert_type', 'warning');
            }
        }

        $url = 'inscripciones.create-step-'.$step;

        return view($url, compact('inscripcion', 'numInscripcionesUser', 'categorias', 'isAdmin'));
    }
}
