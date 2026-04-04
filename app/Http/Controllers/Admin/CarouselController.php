<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarouselSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CarouselController extends Controller
{
    public function index(): View
    {
        $slides = CarouselSlide::orderBy('order')->get();
        return view('admin.carousel.index', compact('slides'));
    }

    public function create(): View
    {
        return view('admin.carousel.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
            'title' => 'nullable|string|max:255',
            'order' => 'integer',
        ]);

        $path = $request->file('image')->store('uploads/carousel', 'public');

        CarouselSlide::create([
            'image_path' => $path,
            'title' => $request->title,
            'order' => $request->order ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.carousel.index')->with('success', 'Slide creado correctamente.');
    }

    public function edit(CarouselSlide $carousel): View
    {
        return view('admin.carousel.edit', compact('carousel'));
    }

    public function update(Request $request, CarouselSlide $carousel): RedirectResponse
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'title' => 'nullable|string|max:255',
            'order' => 'integer',
        ]);

        if ($request->hasFile('image')) {
            // Eliminar imagen anterior
            if ($carousel->image_path) {
                Storage::disk('public')->delete($carousel->image_path);
            }
            $carousel->image_path = $request->file('image')->store('uploads/carousel', 'public');
        }

        $carousel->title = $request->title;
        $carousel->order = $request->order;
        $carousel->is_active = $request->has('is_active');
        $carousel->save();

        return redirect()->route('admin.carousel.index')->with('success', 'Slide actualizado.');
    }

    public function destroy(CarouselSlide $carousel): RedirectResponse
    {
        if ($carousel->image_path) {
            Storage::disk('public')->delete($carousel->image_path);
        }
        
        $carousel->delete();

        return redirect()->route('admin.carousel.index')->with('success', 'Slide eliminado correctamente.');
    }
}