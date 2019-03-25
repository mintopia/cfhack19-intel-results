<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Result;

class ResultController extends Controller
{
    public function index(Request $request)
    {
        $query = Result::query();
        $query->orderBy('created_at', 'desc');
        $params = [
            'per_page' => $request->input('per_page', 10)
        ];

        // TODO: Filtering

        $page = $query->paginate($params['per_page'])->appends($params)->setPath(route('results.index'));
        return view('results.index', [
            'results' => $page
        ]);
    }

    public function show(Request $request, Result $result)
    {
        return view('results.show', [
            'result' => $result
        ]);
    }
}
