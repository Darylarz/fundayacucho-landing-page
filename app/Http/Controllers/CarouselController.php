<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarouselSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarouselController extends Controller
{
    public function index()
    {
        $slides = CarouselSlide::orderBy('order')->get();
        return view('admin.carousel.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.carousel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:5120',
            'title' => 'nullable|string|max:255',
        ]);

        $path = $request->file('image')->store('uploads/carousel', 'public');

        CarouselSlide::create([
            'image_path' => $path,
            'title' => $request->title,
            'order' => CarouselSlide::max('order') + 1,
            'is_active' => true,
        ]);

        return redirect()->route('admin.carousel.index')->with('success', 'Slide creado correctamente.');
    }

    public function destroy(CarouselSlide $carousel)
    {
        if ($carousel->image_path) {
            Storage::disk('public')->delete($carousel->image_path);
        }
        $carousel->delete();
        return redirect()->route('admin.carousel.index')->with('success', 'Slide eliminado.');
    }
    
    // Métodos edit, update, reorder se implementarían de forma similar
    public function edit(CarouselSlide $carousel)
    {
        return view('admin.carousel.edit', compact('carousel'));
    }
}
