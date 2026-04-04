<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LibroController extends Controller
{
    public function index()
    {
        $libros = Libro::latest()->paginate(12);
        return view('admin.libros.index', compact('libros'));
    }

    public function create()
    {
        return view('admin.libros.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'cover' => 'required|image|max:2048', // Portada
            'pdf' => 'required|file|mimes:pdf|max:20480', // PDF máx 20MB
        ]);

        $coverPath = $request->file('cover')->store('libros/covers', 'public');
        $pdfPath = $request->file('pdf')->store('libros/files', 'public');

        Libro::create([
            'title' => $request->title,
            'cover_image_path' => $coverPath,
            'pdf_file_path' => $pdfPath,
        ]);

        return redirect()->route('admin.libros.index')->with('success', 'Libro publicado exitosamente.');
    }

    public function edit(Libro $libro)
    {
        return view('admin.libros.edit', compact('libro'));
    }

    public function update(Request $request, Libro $libro)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'cover' => 'nullable|image|max:2048',
            'pdf' => 'nullable|file|mimes:pdf|max:20480',
        ]);

        $data = ['title' => $request->title];

        if ($request->hasFile('cover')) {
            if ($libro->cover_image_path) Storage::disk('public')->delete($libro->cover_image_path);
            $data['cover_image_path'] = $request->file('cover')->store('libros/covers', 'public');
        }

        if ($request->hasFile('pdf')) {
            if ($libro->pdf_file_path) Storage::disk('public')->delete($libro->pdf_file_path);
            $data['pdf_file_path'] = $request->file('pdf')->store('libros/files', 'public');
        }

        $libro->update($data);

        return redirect()->route('admin.libros.index')->with('success', 'Libro actualizado.');
    }

    public function destroy(Libro $libro)
    {
        if ($libro->cover_image_path) Storage::disk('public')->delete($libro->cover_image_path);
        if ($libro->pdf_file_path) Storage::disk('public')->delete($libro->pdf_file_path);
        
        $libro->delete();
        return back()->with('success', 'Libro eliminado.');
    }
}
