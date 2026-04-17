<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inscripcion;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function showNavBarSearchResults(Request $request)
    {

        $term = $request->searchVal;
        $columns = [
            'titulo',
            'director',
            'codirector',
            'guionista',
            'coguionista',
            'productora',
            'productor',
            'coproductor',
            'idioma',
            'genero',
            'pais_productor',
            'ciudad_productor',
        ];

        $results = Inscripcion::with(['user:id,name', 'categoria:id,name'])
            ->where(function ($query) use ($columns, $term) {
                foreach ($columns as $column) {
                    $query->orWhere($column, 'like', "%{$term}%");
                }
            })
            ->latest()
            ->limit(100)
            ->get();

        return view('search-results', compact('term', 'results'));
    }
}
