<?php

namespace App\Http\Controllers;
/*gallery*/
use File;
use Flash;
use Intervention\Image\Facades\Image;
use App\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Gallery::paginate(10);

        return view('backend.layout.galleries', ['images' => $images]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,jpg,png,gif|max:8000'
        ]);

        if ($request->hasFile('image')) {
            $images = $request->file('image');

            $org_img = $thm_img = true;

            if( ! File::exists('images/gallery/originals/')) {
                $org_img = File::makeDirectory(public_path('images/gallery/originals/'), 0777, true);
            }
            if ( ! File::exists('images/gallery/thumbnails/')) {
                $thm_img = File::makeDirectory(public_path('images/gallery/thumbnails'), 0777, true);
            }

            foreach($images as $key => $image) {

                $gallery = new Gallery;

                $filename = rand(1111,9999).time().'.'.$image->getClientOriginalExtension();

                $org_path = 'images/gallery/originals/' . $filename;
                $thm_path = 'images/gallery/thumbnails/' . $filename;

                $gallery->image     = 'images/gallery/originals/'.$filename;
                $gallery->thumbnail = 'images/gallery/thumbnails/'.$filename;
                $gallery->title     = $request->title;
                $gallery->status    = $request->status;

                if ( ! $gallery->save()) {
                    flash('Gallery could not be updated.')->error()->important();
                    return redirect()->back()->withInput();
                }

                if (($org_img && $thm_img) == true) {
                    Image::make($image)->fit(900, 500, function ($constraint) {
                        $constraint->upsize();
                    })->save($org_path);
                    Image::make($image)->fit(270, 160, function ($constraint) {
                        $constraint->upsize();
                    })->save($thm_path);
                }
            }
        }

        $request->session()->flash('alert-success','Image uploaded successfully.');
        return redirect()->action('GalleryController@index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        $image = Gallery::findOrFail($request->id);

        if ($image->status == 1) {
            $image->status = 0;
            $status = 'disabled';
        } else {
            $image->status = 1;
            $status = 'enabled';
        }

        if ( ! $image->save()) {
            flash('Image could not be reverted.')->error();
            return redirect()->route('gallery.index');
        }

        flash('Image has been successfully '.$status)->success();
        return redirect()->route('gallery.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Gallery::findOrFail($id);

        if ($post->delete()) {
            flash('Image successfully deleted.')->success();
        } else {
            flash('Image could not be deleted.')->error();
        }

        return redirect()->route('gallery.index');
    }
}

//https://www.kodementor.com/image-gallery-system-with-laravel-5/