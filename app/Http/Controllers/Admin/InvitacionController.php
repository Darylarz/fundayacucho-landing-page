<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invitacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvitacionController extends Controller
{
    public function index()
    {
        $invitaciones = Invitacion::orderBy('order', 'asc')->get();
        return view('admin.invitaciones.index', compact('invitaciones'));
    }

    public function create()
    {
        return view('admin.invitaciones.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048', // Max 2MB
            'link' => 'required|url',
            'title' => 'nullable|string|max:255',
            'order' => 'integer',
        ]);

        $path = $request->file('image')->store('invitaciones', 'public');

        Invitacion::create([
            'image_path' => $path,
            'link' => $request->link,
            'title' => $request->title,
            'order' => $request->order ?? 0,
            'is_active' => true,
        ]);

        return redirect()->route('admin.invitaciones.index')->with('success', 'Invitación creada correctamente.');
    }

    public function edit(Invitacion $invitacion)
    {
        return view('admin.invitaciones.edit', compact('invitacion'));
    }

    public function update(Request $request, Invitacion $invitacion)
    {
        $request->validate([
            'image' => 'nullable|image|max:2048',
            'link' => 'required|url',
            'title' => 'nullable|string|max:255',
            'order' => 'integer',
            'is_active' => 'boolean',
        ]);

        $data = $request->only(['link', 'title', 'order']);
        $data['is_active'] = $request->has('is_active');

        if ($request->hasFile('image')) {
            if ($invitacion->image_path) Storage::disk('public')->delete($invitacion->image_path);
            $data['image_path'] = $request->file('image')->store('invitaciones', 'public');
        }

        $invitacion->update($data);

        return redirect()->route('admin.invitaciones.index')->with('success', 'Invitación actualizada.');
    }

    public function destroy(Invitacion $invitacion)
    {
        if ($invitacion->image_path) Storage::disk('public')->delete($invitacion->image_path);
        $invitacion->delete();
        return back()->with('success', 'Invitación eliminada.');
    }
}