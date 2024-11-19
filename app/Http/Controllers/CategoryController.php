<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Kategori';
        $subtitle = [
            'subtitle' => 'Kategori',
        ];
        $category = Category::all();
        return view('category.index', compact('title', 'subtitle', 'category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Kategori';
        $subtitle = [
            'subtitle' => 'Kategori',
            'subs' => 'Tambah Kategori',
            'route' => 'category.index'
        ];
        return view('category.create', compact('title', 'subtitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ],[
            'name.required' => 'Harap untuk mengisi kolom nama'
        ]);

        Category::create([
            'name' => $request->input('name'),
            'slug' => str_replace(' ','',Str::lower($request->input('name')))
        ]);
        return redirect()->route('category.index')->with('success','Berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $title = 'Kategori';
        $subtitle = [
            'subtitle' => 'Kategori',
            'subs' => 'Edit Kategori',
            'route' => 'category.index'
        ];
        return view('category.edit', compact('title', 'subtitle', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required'
        ],[
            'name.required' => 'Harap untuk mengisi kolom nama'
        ]);

        $category->update([
            'name' => $request->input('name'),
            'slug' => str_replace(' ','',Str::lower($request->input('name')))
        ]);
        return redirect()->route('category.index')->with('success','Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('category.index')->with('success','Berhasil menghapus data');
    }
}
