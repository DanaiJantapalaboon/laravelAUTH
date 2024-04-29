<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Admin_CarouselController extends Controller
{

    //============= 1. Add Carousel รับมาจากหน้า Carousel =============//
    public function addCarousels(request $request)
    {
        $request->validate([
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'uploadCarousel' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2080',
            'addedby' => 'required|string'
        ]);

        $carousel = new Carousel();
    
        $carousel->title = $request->title;
        $carousel->description = $request->description;
        $carousel->image = $request->file('uploadCarousel')->store('uploaded_file/carousel', 'public');
        $carousel->added_by = $request->addedby;
        $carousel->save();

        return back();
    }


    //============= 2. Edit Carousel รับมาจากหน้า Carousel =============//
    public function editCarousels(request $request, $id)
    {
        $request->validate([
            'editTitle' => 'nullable|string',
            'editDescription' => 'nullable|string',
            'editCarousel' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2080',
            'editedby' => 'required|string'
        ]);

        $carousel = Carousel::find($id);
        $carousel->title = $request->editTitle;
        $carousel->description = $request->editDescription;
        $carousel->added_by = $request->editedby;

        if ($request->editCarousel) {
            Storage::disk('public')->delete($carousel->image);
            $carousel->image = $request->file('editCarousel')->store('uploaded_file/carousel', 'public');
        }

        $carousel->save();
        return back();
    }


    //============= 3. Delete Carousel รับมาจากหน้า Carousel =============//
    public function deleteCarousels($id)
    {
        $carousel = Carousel::find($id);

        Storage::disk('public')->delete($carousel->image);
        $carousel->delete();
        return back();
    }
}