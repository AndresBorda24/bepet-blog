<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table = Category::class;
        $fields = [
            'Id' => ['id', true],
            'Nombre' => ['name', true],
            'slug' => ['slug', false]
        ];
        $filters = [
            'id' => [],
            'name' => []
        ];

        return view('admin.categories.home', compact('table', 'fields', 'filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $validated = array_merge(
            $request->validate(['name' => 'required|max:50|unique:categories']), 
            [ 'slug' => \Illuminate\Support\Str::slug($request['name'])
        ]);

        Category::create($validated);
        return redirect()->route('dashboard.admin.categories.index')->with('success', 'Categoria creada correctamente');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validated = array_merge(
            $request->validate(['name' => 'required|max:50|unique:categories,name,'. $category->id]), 
            [ 'slug' => \Illuminate\Support\Str::slug($request['name'])
        ]);

        $category->update($validated);
        return redirect()->route('dashboard.admin.categories.index')->with('success', 'Categoria Actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('dashboard.admin.categories.index')->with('success', 'Categoria ELIMINADA correctamente');
    }
}
