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
        $libros = Libro::latest()->get();
        return view('admin.libros.index', compact('libros'));
    }

    public function create()
    {
        return view('admin.libros.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'cover' => 'required|image',
            'pdf' => 'required|mimes:pdf|max:10240',
        ]);

        $coverPath = $request->file('cover')->store('uploads/libros/covers', 'public');
        $pdfPath = $request->file('pdf')->store('uploads/libros/files', 'public');

        Libro::create([
            'title' => $request->title,
            'cover_image_path' => $coverPath,
            'pdf_file_path' => $pdfPath,
        ]);

        return redirect()->route('admin.libros.index')->with('success', 'Libro publicado.');
    }

    public function destroy(Libro $libro)
    {
        Storage::disk('public')->delete([$libro->cover_image_path, $libro->pdf_file_path]);
        $libro->delete();
        return redirect()->route('admin.libros.index')->with('success', 'Libro eliminado.');
    }
}
