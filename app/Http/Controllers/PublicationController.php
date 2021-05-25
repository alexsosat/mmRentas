<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Models\Image;
use App\Http\Controllers\ImageController;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('publications.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validating the data
        $request->validate([
            'title' => ['required', 'string', 'max:100'],
            'address' => ['required', 'string', 'max:255'],
            'price' => ['nullable', 'regex:/^\d*(\.\d{2})?$/'],
            'description' => ['nullable', 'string', 'max:490'],
            'rooms' => ['required', 'int'],
            'restrooms' => ['required', 'int'],
            'files' => 'max:5',
            'files.*' => 'mimes:jpg,png||max:5048'
        ]);



        //if description is null set a default description
        if ($request->description === null) {
            $request->description = 'descripción no disponible';
        }


        $pubId = Publication::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'description' => $request->description,
            'address' => $request->address,
            'price' => $request->price,
            'rooms' => $request->rooms,
            'bathrooms' => $request->restrooms
        ])->id;


        //check if the request has images
        if ($request->hasfile('files')) {

            foreach ($request->file('files') as $file) {
                //create img in database
                Image::create([
                    'publication_id' => $pubId,
                    'image_url' => app(ImageController::class)->store($file, 'mmRentas/publications/' . $pubId),
                ]);
            }
        }

        return redirect('/user/' . $request->user_id . '/publications');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Publication  $Publication
     * @return \Illuminate\Http\Response
     */
    public function show(Publication $Publication)
    {
        return View('publications.show', compact('Publication'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Publication  $Publication
     * @return \Illuminate\Http\Response
     */
    public function edit(Publication $Publication)
    {
        return View('publications.edit', compact('Publication'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Publication  $Publication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Publication $Publication)
    {


        //Validating the data
        $request->validate([
            'title' => ['required', 'string', 'max:100'],
            'address' => ['required', 'string', 'max:255'],
            'price' => ['nullable', 'regex:/^\d*(\.\d{2})?$/'],
            'description' => ['nullable', 'string', 'max:490'],
            'rooms' => ['required', 'int'],
            'restrooms' => ['required', 'int'],
            'files' => 'max:5',
            'files.*' => 'mimes:jpg,png||max:5048'
        ]);

        //if description is null then set a default description
        if ($request->description === null) {
            $request->description = 'descripción no disponible';
        }


        //updating the user
        $Publication->title = $request->title;
        $Publication->address = $request->address;
        $Publication->price = $request->price;
        $Publication->description = $request->description;
        $Publication->rooms = $request->rooms;
        $Publication->bathrooms = $request->restrooms;

        $Publication->update();

        //Check if the data has images
        if ($request->hasfile('files')) {

            if ((count($request->file('files')) + count($Publication->images)) <= 5) {
                foreach ($request->file('files') as $file) {
                    //create img in database
                    Image::create([
                        'publication_id' => $Publication->id,
                        'image_url' => app(ImageController::class)->store($file, 'mmRentas/publications/' . $Publication->id),
                    ]);
                }
            } else {
                return back()->with('error', 'Cantidad máxima de imágenes sobrepasada, por favor subir una cantidad permitida o eliminar imágenes');
            }
        }

        return
            back()->with('success', 'Publicación actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroyPublicationImage(Publication $Publication, Image $Image)
    {
        app(ImageController::class)->destroy($Image->image_url);

        Image::destroy($Image->id);

        return back()->with('success', 'Imagen eliminada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroyAllImages(Publication $Publication)
    {
        foreach ($Publication->images as $Image) {
            app(ImageController::class)->destroy($Image->image_url);
            Image::destroy($Image->id);
        }

        return back()->with('success', 'Imagenes eliminadas exitosamente');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Publication  $Publication
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publication $Publication)
    {

        $this->destroyAllImages($Publication);

        Publication::destroy($Publication->id);
        return redirect()->back();
    }
}
