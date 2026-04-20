<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Informacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InformacionController extends Controller
{
    public function index()
    {
        $informaciones = Informacion::orderBy('order', 'asc')->get();
        return view('admin.informaciones.index', compact('informaciones'));
    }

    public function create()
    {
        return view('admin.informaciones.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:500',
            'link' => 'nullable|url',
            'order' => 'integer',
        ]);

        $path = $request->file('image')->store('informaciones', 'public');

        Informacion::create([
            'image_path' => $path,
            'title' => $request->title,
            'content' => $request->content,
            'link' => $request->link,
            'order' => $request->order ?? 0,
            'is_active' => true,
        ]);

        return redirect()->route('admin.informaciones.index')->with('success', 'Información creada correctamente.');
    }

    public function edit(Informacion $informacion)
    {
        return view('admin.informaciones.edit', compact('informacion'));
    }

    public function update(Request $request, Informacion $informacion)
    {
        $request->validate([
            'image' => 'nullable|image|max:2048',
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:500',
            'link' => 'nullable|url',
            'order' => 'integer',
            'is_active' => 'boolean',
        ]);

        $data = $request->only(['title', 'content', 'link', 'order']);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            if ($informacion->image_path) Storage::disk('public')->delete($informacion->image_path);
            $data['image_path'] = $request->file('image')->store('informaciones', 'public');
        }

        $informacion->update($data);

        return redirect()->route('admin.informaciones.index')->with('success', 'Información actualizada.');
    }

    public function destroy(Informacion $informacion)
    {
        if ($informacion->image_path) Storage::disk('public')->delete($informacion->image_path);
        $informacion->delete();
        return back()->with('success', 'Información eliminada.');
    }
}
