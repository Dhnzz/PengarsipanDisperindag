<?php

namespace App\Http\Controllers;

use App\Models\{File, Category};
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Arsip';
        $subtitle = [
            'subtitle' => 'Arsip',
        ];
        $file = File::all();
        return view('file.index', compact('title', 'subtitle', 'file'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Arsip';
        $subtitle = [
            'subtitle' => 'Arsip',
            'subs' => 'Tambah Arsip',
            'route' => 'file.index',
        ];
        $category = Category::all();
        return view('file.create', compact('title', 'subtitle', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'nullable|file|mimes:jpg,png,pdf,docx', // File baru bersifat opsional
            'category_id' => 'required|exists:categories,id', // Validasi category_id
            'from' => 'required|string|max:255', // Validasi data tambahan 'from'
            'to' => 'required|string|max:255', // Validasi data tambahan 'to'
        ]);
        $category = Category::findOrFail($request->input('category_id'));

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName(); // Contoh nama file berdasarkan waktu
            $path = 'uploads/' . $category->slug; // Menyimpan di dalam folder berdasarkan slug kategori

            // Simpan file ke Storage
            $filePath = $file->storeAs($path, $filename, 'public'); // Menggunakan disk 'public'
        }

        $createFile = File::create([
            'nomor_surat' => $request->input('nomor_surat'),
            'name' => $request->input('name'),
            'desc' => $request->input('desc'),
            'path' => $filePath,
            'from' => $request->input('from'),
            'to' => $request->input('to'),
            'category_id' => $request->input('category_id'),
            'date' => $request->input('date'),
        ]);
        return redirect()->route('file.index')->with('success', 'Berhasil menginputkan arsip');
    }

    /**
     * Display the specified resource.
     */
    public function show(File $file)
    {
        $title = 'Arsip';
        $subtitle = [
            'subtitle' => 'Arsip',
            'subs' => 'Detail Arsip',
            'route' => 'file.index',
        ];
        return view('file.show', compact('title', 'subtitle', 'file'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(File $file)
    {
        $title = 'Arsip';
        $subtitle = [
            'subtitle' => 'Arsip',
            'subs' => 'Edit Arsip',
            'route' => 'file.index',
        ];
        $category = Category::all();
        return view('file.edit', compact('title', 'subtitle', 'file', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, File $file)
    {
        // Validasi input
        $request->validate([
            'file' => 'nullable|file|mimes:jpg,png,pdf,docx|max:2048', // File baru bersifat opsional
            'category_id' => 'required|exists:categories,id', // Validasi category_id
            'from' => 'required|string|max:255', // Validasi data tambahan 'from'
            'to' => 'required|string|max:255', // Validasi data tambahan 'to'
        ]);

        // Cari arsip berdasarkan ID
        $fileRecord = $file;
        $category = Category::findOrFail($request->input('category_id'));

        $filePath = $fileRecord->path; // Default path jika tidak ada file baru

        // Jika ada file baru, lakukan update file
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName(); // Contoh nama file berdasarkan waktu
            $path = 'uploads/' . $category->slug; // Menyimpan di dalam folder berdasarkan slug kategori

            // Hapus file lama jika ada
            if ($fileRecord->path && \Storage::disk('public')->exists($fileRecord->path)) {
                \Storage::disk('public')->delete($fileRecord->path);
            }

            // Simpan file baru ke Storage
            $filePath = $file->storeAs($path, $filename, 'public'); // Menggunakan disk 'public'
        }

        // Update arsip di database
        $fileRecord->update([
            'nomor_surat' => $request->input('nomor_surat'),
            'name' => $request->input('name'),
            'desc' => $request->input('desc'),
            'path' => $filePath,
            'from' => $request->input('from'),
            'to' => $request->input('to'),
            'category_id' => $request->input('category_id'),
            'date' => $request->input('date'),
        ]);

        return redirect()->route('file.index')->with('success', 'Berhasil mengupdate arsip');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(File $file)
    {
        // Cari arsip berdasarkan ID
        $fileRecord = $file;

        // Hapus file dari storage jika ada
        if ($fileRecord->path && \Storage::disk('public')->exists($fileRecord->path)) {
            \Storage::disk('public')->delete($fileRecord->path);
        }

        // Hapus arsip dari database
        $fileRecord->delete();

        return redirect()->route('file.index')->with('success', 'Berhasil menghapus arsip');
    }
}
