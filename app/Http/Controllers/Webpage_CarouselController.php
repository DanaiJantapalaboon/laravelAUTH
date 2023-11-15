<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Webpage_CarouselController extends Controller
{

    //============= 1. Add Carousel รับมาจากหน้า Carousel =============//
    public function addCarousels(request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
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






    //============= 3. Delete Carousel รับมาจากหน้า Carousel =============//
    public function deleteCarousels($id)
    {
        $carousel = Carousel::find($id);

        // unlink image and delete from db
        Storage::disk('public')->delete($carousel->image);
        $carousel->delete();
        return back();
    }
}
