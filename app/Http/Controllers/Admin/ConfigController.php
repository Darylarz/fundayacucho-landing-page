<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConfigController extends Controller
{
    public function edit()
    {
        // Obtener la configuración o crear una vacía si no existe
        $config = SiteConfig::firstOrCreate([], []);
        return view('admin.config.edit', compact('config'));
    }

    public function update(Request $request)
    {
        $config = SiteConfig::first();

        $request->validate([
            'logo' => 'nullable|image|max:2048',
            'cintillo' => 'nullable|image|max:2048',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
        ]);

        $data = $request->except(['logo', 'cintillo', '_token', '_method']);

        if ($request->hasFile('logo')) {
            if ($config->logo_path) Storage::disk('public')->delete($config->logo_path);
            $data['logo_path'] = $request->file('logo')->store('config', 'public');
        }

        if ($request->hasFile('cintillo')) {
            if ($config->cintillo_path) Storage::disk('public')->delete($config->cintillo_path);
            $data['cintillo_path'] = $request->file('cintillo')->store('config', 'public');
        }

        $config->update($data);

        return back()->with('success', 'Configuración actualizada correctamente.');
    }
}
