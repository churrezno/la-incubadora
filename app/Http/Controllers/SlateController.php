<?php

namespace App\Http\Controllers;

use App\Http\Requests\SlateRequest;
use App\Models\Archivo;
use App\Models\Slate;
use App\Models\User;
use Illuminate\Http\Request;
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

    
    public function store(SlateRequest $request, ?Slate $slate = null)
    {
        $request->merge(['user_id' => auth()->user()->id, 'categoria_id' => 1]);
        $slate = Slate::create($request->except('pdf_documentacion'));

        $this->uploadFile($request, $slate, 'pdf_documentacion', 4);

        return redirect()->route('home')->with('success', 'Perfil creado correctamente :)');
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


    public function showToUser(Slate $slate)
    {
        $this->authorize('view', $slate);

        return view('slates.show-to-user', compact('slate'));
    }

}
