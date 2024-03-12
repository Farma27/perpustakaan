<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['title'] = __('kategori.title.index');
        return view("pages.category.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['title'] = __('kategori.title.create');
        return view("pages.category.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {
        try{
            DB::beginTransaction();
            $category = new Category();
            $category->category_name = $request->category_name;
            $category->save();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error(
                $th->getMessage(),
                [
                    'action' => 'Store Category', 
                    'data' => $request->all()
                ]
            );
            return to_route('categories.index')->withToastError($th->getMessage());
        }
        return to_route('categories.index')->withToastSuccess(__('kategori.flash.store'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return self::edit($category);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $data['title'] = __('buku.title.edit');
        $data['category'] = $category;
        return view('pages.category.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, Category $category)
    {
        DB::beginTransaction();
        try{
            $category->category_name = $request->category_name;
            $category->save();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error(
                $th->getMessage(),
                [
                    'action' => 'Store Category', 
                    'data' => $request->all()
                ]
            );
            return to_route('categories.index')->withToastError($th->getMessage());
        }
        return to_route('categories.index')->withToastSuccess(__('kategori.flash.update'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json([
            'msg' => __('kategori.flash.destroy')
        ], 200);
    }
}
