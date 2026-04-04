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
        $noticias = Noticia::latest()->paginate(10);
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
            'image' => 'nullable|image|max:5120',
            'body' => 'required',
        ]);

        $data = $request->only(['title', 'body']);
        $data['is_published'] = $request->has('is_published');

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('noticias', 'public');
        }

        Noticia::create($data);

        return redirect()->route('admin.noticias.index')->with('success', 'Noticia creada exitosamente.');
    }

    public function edit(Noticia $noticia)
    {
        return view('admin.noticias.edit', compact('noticia'));
    }

    public function update(Request $request, Noticia $noticia)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|max:5120',
            'body' => 'required',
        ]);

        $data = $request->only(['title', 'body']);
        $data['is_published'] = $request->has('is_published');

        if ($request->hasFile('image')) {
            if ($noticia->image_path) Storage::disk('public')->delete($noticia->image_path);
            $data['image_path'] = $request->file('image')->store('noticias', 'public');
        }

        $noticia->update($data);

        return redirect()->route('admin.noticias.index')->with('success', 'Noticia actualizada.');
    }

    public function destroy(Noticia $noticia)
    {
        if ($noticia->image_path) Storage::disk('public')->delete($noticia->image_path);
        $noticia->delete();
        return back()->with('success', 'Noticia eliminada.');
    }
}