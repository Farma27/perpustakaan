<?php

namespace App\Http\Controllers\Datatables;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryDatatables extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $query = Category::query();
        return DataTables::of($query)
            ->addColumn('action', function ($row) {
                $data = [
                    'edit_url'     => route('categories.edit', ['category' => $row->getKey()]),
                    'delete_url'   => route('categories.destroy', ['category' => $row->getKey()]),
                    'redirect_url' => route('categories.index'),
                    'name'         => $row->category_name,
                    'resource'     => 'categories',
                ];

                return view('components.datatable-action', $data);
            })
            ->toJson();
    }
}
