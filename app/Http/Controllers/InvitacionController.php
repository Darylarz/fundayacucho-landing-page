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
        $invitaciones = Invitacion::orderBy('order')->get();
        return view('admin.invitaciones.index', compact('invitaciones'));
    }

    public function create()
    {
        return view('admin.invitaciones.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
            'link' => 'nullable|url',
            'title' => 'nullable|string',
        ]);

        $path = $request->file('image')->store('uploads/invitaciones', 'public');

        Invitacion::create([
            'image_path' => $path,
            'link' => $request->link,
            'title' => $request->title,
            'order' => Invitacion::max('order') + 1,
        ]);

        return redirect()->route('admin.invitaciones.index')->with('success', 'Invitación creada.');
    }

    public function destroy(Invitacion $invitacion)
    {
        Storage::disk('public')->delete($invitacion->image_path);
        $invitacion->delete();
        return redirect()->route('admin.invitaciones.index')->with('success', 'Invitación eliminada.');
    }
}
