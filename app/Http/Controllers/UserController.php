<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $heads = [
            // 'DT_RowId',
            'ID',
            'Nombre',
            'Email',
            'Rol',
            'Inscripciones',
            'Asig. Desarrollo',
            'Asig. Slate',
            'Acción',
        ];

        $config = [
            'autoWidth' => false,
            'language' => [
                'url' => asset('vendor/datatables-plugins/lang/datatables-es-ES.json'),
            ],
            'ajax' => [
                'url' => route('datatable.users'),
            ],
            'columns' => [
                ['data' => 'id', 'width' => '80px'],
                ['data' => 'name'],
                ['data' => 'email'],
                ['data' => 'roles[0].name', 'width' => '120px'],
                ['data' => 'inscripciones'],
                ['data' => 'asig_desarrollo'],
                ['data' => 'asig_slate'],
                ['data' => 'acciones', 'width' => '80px', 'sortable' => false, 'width' => '120px'],
            ],
            'pageLength' => 10,
            // 'dom' => '<"container-fluid"<"row mb-3 align-items-end"<"col p-0"B><"col p-0"f>>>rt<"container-fluid"<"row mt-5 mb-5"<"col p-0"i><"col p-0"p>>>',
            'lengthMenu' => [[10, 25, 50, 75, 100, -1], [10, 25, 50, 75, 100, 'Todos']],
            'buttons' => [
                ['pageLength'],
                ['extend' => 'csvHtml5', 'className' => 'btn-export', 'text' => '<i class="fa-solid fa-fw fa-file-csv"></i>', 'titleAttr' => 'Exportar a CSV'],
                ['extend' => 'excelHtml5', 'className' => 'btn-export', 'text' => '<i class="fa-regular fa-fw fa-file-excel"></i>', 'titleAttr' => 'Exportar a Excel'],
                ['extend' => 'pdfHtml5', 'className' => 'btn-export', 'text' => '<i class="fa-regular fa-fw fa-file-pdf"></i>', 'titleAttr' => 'Exportar a PDF'],
            ],
            'order' => [
                [0, 'asc'],
            ],
            // 'columnDefs' => [
            //     'orderable' => false,
            //     'render' => 'DataTable.render.select()',
            //     'targets' => 0
            // ],
            // 'select' => [
            //     'info' => false,
            //     'style' =>'os',
            //     'selector' =>'td:first-child'
            // ],
            'layout' => [
                'topStart' => 'buttons',
            ],
        ];

        return view('users.index', compact('heads', 'config'));
    }

    public function create()
    {
        $roles = Role::all();

        return view('users.create', compact('roles'));
    }

    public function store(StoreUser $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        $user->syncRoles($request->rol);

        return redirect()->route('users.index')->with('info', 'Usuario creado correctamente :)');
    }

    public function edit(User $user)
    {
        $roles = Role::all();

        return view('users.edit', compact('user', 'roles'));
    }

    public function update(UpdateUser $request, User $user)
    {
        $validated = $request->validated();

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();
        $user->syncRoles([$request->rol]);

        return redirect()->route('users.index')->with('info', 'Usuario actualizado :)');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('info', 'Usuario eliminado :)');
    }

    // FORCE DELETE FROM THRASH BIN
    public function forceDelete($id)
    {
        $user = User::withTrashed()->findOrFail($id);

        try {
            $user->asignaciones()->forceDelete();
            $user->inscripciones()->forceDelete();
            if ($user->slate) {
                $user->slate->asignaciones()->forceDelete();
                $user->slate->forceDelete();
            }
            $user->forceDelete();

            return response()->json(['message' => 'Usuario eliminado permanentemente'], 200);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al eliminar el usuario'], 500);
        }
    }
}
