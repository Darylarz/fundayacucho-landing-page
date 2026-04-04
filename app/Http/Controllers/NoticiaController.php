<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NoticiaController extends Controller
{
    public function index()
    {
        $noticias = Noticia::latest()->get();
        return view('admin.noticias.index', compact('noticias'));
    }

    public function create()
    {
        return view('admin.noticias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
            'image' => 'required|image',
        ]);

        $path = $request->file('image')->store('uploads/noticias', 'public');

        Noticia::create([
            'title' => $request->title,
            'body' => $request->body,
            'image_path' => $path,
            'is_published' => $request->has('is_published'),
        ]);

        return redirect()->route('admin.noticias.index')->with('success', 'Noticia creada.');
    }

    public function destroy(Noticia $noticia)
    {
        Storage::disk('public')->delete($noticia->image_path);
        $noticia->delete();
        return redirect()->route('admin.noticias.index')->with('success', 'Noticia eliminada.');
    }
}
