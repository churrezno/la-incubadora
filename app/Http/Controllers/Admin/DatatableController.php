<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inscripcion;
use App\Models\Slate;
use App\Models\User;
use App\Models\Valoracion;
use App\Models\ValoracionSlate;

class DatatableController extends Controller
{
    public function users()
    {

        $users = User::with('roles')->select('id', 'name', 'email');

        return datatables()
            ->eloquent($users)
            ->addColumn('acciones', 'admin.acciones-user')
            ->addColumn('inscripciones', 'admin.inscripciones-user')
            ->addColumn('asig_desarrollo', 'admin.asignaciones-desarrollo-user')
            ->addColumn('asig_slate', 'admin.asignaciones-slate-user')
            ->rawColumns(['acciones', 'inscripciones', 'asig_desarrollo', 'asig_slate'])
            ->toJson();
    }

    public function inscripciones()
    {

        $user = auth()->user();

        if ($user->hasRole('admin')) {
            $inscripciones = Inscripcion::query();
        } else {
            $inscripciones = Inscripcion::whereHas('asignaciones', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });
        }

        $inscripciones->with([
            'user:id,name',
            'categoria:id,name',
        ]);

        return datatables()
            ->eloquent($inscripciones)
            ->addColumn('fecha', function ($data) {
                return $data->created_at->format('d/m/Y');
            })
            ->addColumn('titulo', function ($data) {
                return '<a href=inscripciones/'.$data->id.'>'.$data->titulo.'</a>';
            })
            ->addColumn('autor', function ($data) {
                return $data->user?->name;
            })
            ->addColumn('puntos', 'admin.puntos-inscripcion')
            ->addColumn('acciones', 'admin.acciones-inscripcion')
            ->addColumn('valoraciones', 'admin.valoraciones-inscripcion')
            ->rawColumns(['titulo', 'puntos', 'acciones', 'valoraciones'])
            ->setRowClass(function ($data) {
                $categoria = $data->categoria?->name ?? 'sin-categoria';
                $claseCategoria = 'cat cat-'.strtolower(str_replace(' ', '-', $categoria));
                return Inscripcion::find($data->id)->complete ? $claseCategoria : $claseCategoria . ' incompleta';
            })
            ->toJson();
    }

    public function slates()
    {

        $user = auth()->user();

        if ($user->hasRole('admin')) {
            $slate = Slate::query();
        } else {
            $slate = Slate::whereHas('asignaciones', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });
        }

        $slate->with([
            'user:id,name',
            'categoria:id,name',
        ]);

        return datatables()
            ->eloquent($slate)
            ->addColumn('fecha', function ($data) {
                return $data->created_at->format('d/m/Y');
            })
            ->addColumn('productor', function ($data) {
                return $data->productor;
            })
            ->addColumn('puntos', 'admin.puntos-slate')
            ->addColumn('acciones', 'admin.acciones-slate')
            ->addColumn('valoraciones', 'admin.valoraciones-slate')
            ->rawColumns(['puntos', 'acciones', 'valoraciones'])
            ->setRowClass(function ($data) {
                $categoria = $data->categoria?->name ?? 'sin-categoria';
                $claseCategoria = 'cat cat-'.strtolower(str_replace(' ', '-', $categoria));
                return Slate::find($data->id)->complete ? $claseCategoria : $claseCategoria . ' incompleta';
            })
            ->toJson();
    }

    public function valoraciones($id)
    {

        $inscripcion = Inscripcion::findOrFail($id);

        $valoraciones = Valoracion::with('asignacion.user:id,name')
            ->whereHas('asignacion', function ($query) use ($inscripcion) {
                $query->where('asignable_type', 'App\Models\Inscripcion')
                      ->where('asignable_id', $inscripcion->id);
            });

        $user = auth()->user();

        if ($user->hasRole('comite')) {
            $valoraciones->whereHas('asignacion', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });
        }

        return datatables()
            ->eloquent($valoraciones)
            ->addColumn('valoraciones', 'admin.valoracion-inscripcion-show')
            ->rawColumns(['valoraciones'])
            ->toJson();
    }

    public function valoracionesSlate($id)
    {

        $slate = Slate::findOrFail($id);

        $valoracionesSlate = ValoracionSlate::with('asignacion.user:id,name')
            ->whereHas('asignacion', function ($query) use ($slate) {
                $query->where('asignable_type', 'App\Models\Slate')
                      ->where('asignable_id', $slate->id);
            });

        $user = auth()->user();

        if ($user->hasRole('comite')) {
            $valoracionesSlate->whereHas('asignacion', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });
        }

        return datatables()
            ->eloquent($valoracionesSlate)
            ->addColumn('valoraciones', 'admin.valoracion-slate-show')
            ->rawColumns(['valoraciones'])
            ->toJson();
    }

    public function allValoraciones()
    {

        $valoraciones = Valoracion::with([
            'asignacion.user:id,name',
            'asignacion.asignable:id,titulo',
        ]);

        return datatables()
            ->eloquent($valoraciones)
            ->addColumn('fecha', function ($data) {
                return $data->created_at->format('d/m/Y');
            })
            ->addColumn('comite', function ($data) {
                return $data->asignacion?->user?->name;
            })
            ->addColumn('titulo', function ($data) {
                $inscripcion = $data->asignacion?->inscripcion;

                if ($inscripcion === null) {
                    return '';
                }

                return '<a href=inscripciones/'.$inscripcion->id.'>'.$inscripcion->titulo.'</a>';
            })
            ->addColumn('valoracion', 'admin.valoracion-inscripcion-show')
            ->rawColumns(['titulo', 'valoracion'])
            ->toJson();
    }

    public function allValoracionesSlate()
    {

        $valoraciones = ValoracionSlate::with([
            'asignacion.user:id,name',
            'asignacion.asignable:id,productor',
        ]);

        return datatables()
            ->eloquent($valoraciones)
            ->addColumn('fecha', function ($data) {
                return $data->created_at->format('d/m/Y');
            })
            ->addColumn('comite', function ($data) {
                return $data->asignacion?->user?->name;
            })
            ->addColumn('productor', function ($data) {
                $slate = $data->asignacion?->asignable;

                if ($slate === null) {
                    return '';
                }

                return '<a href=slates/'.$slate->id.'>'.$slate->productor.'</a>';
            })
            ->addColumn('valoracion', 'admin.valoracion-slate-show')
            ->rawColumns(['productor', 'valoracion'])
            ->toJson();
    }

    public function usersTrash()
    {

        $users = User::onlyTrashed()->select('id', 'name');

        return datatables()
            ->eloquent($users)
            ->addColumn('acciones', 'admin.acciones-user-trash')
            ->rawColumns(['acciones'])
            ->toJson();
    }

    public function inscripcionesTrash()
    {

        $users = Inscripcion::onlyTrashed()->select('id', 'titulo');

        return datatables()
            ->eloquent($users)
            ->addColumn('acciones', 'admin.acciones-inscripcion-trash')
            ->rawColumns(['acciones'])
            ->toJson();
    }

    public function slatesTrash()
    {

        $users = Slate::onlyTrashed()->select('id', 'productor');

        return datatables()
            ->eloquent($users)
            ->addColumn('acciones', 'admin.acciones-slate-trash')
            ->rawColumns(['acciones'])
            ->toJson();
    }
}
