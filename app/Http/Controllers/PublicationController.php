<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Models\Image;
use App\Http\Controllers\ImageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PublicationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('search')->with([
            'Publications' =>
            Publication::select('id', 'title', 'rooms', 'bathrooms')->where('isActive', '=', 1)->take(12)->orderBy('id', 'DESC')->get()
        ]);
    }

    /**
     * Returns the publications that matches the desired parameters
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $titlePublications = Publication::select('id', 'user_id', 'title', 'description', 'rooms', 'bathrooms', 'price')
            ->where('title', 'LIKE', "%{$request->key_words}%")->where('isActive', '=', 1);

        $descriptionPublications = Publication::select('id', 'user_id', 'title', 'description', 'rooms', 'bathrooms', 'price')
            ->where('description', 'LIKE', "%{$request->key_words}%")->where('isActive', '=', 1);


        if ($request->rooms != null) {
            $titlePublications = $titlePublications->where('rooms', '=', $request->rooms);
            $descriptionPublications = $descriptionPublications->where('rooms', '=', $request->rooms);
        }

        if ($request->bathrooms != null) {
            $titlePublications = $titlePublications->where('bathrooms', '=', $request->bathrooms);
            $descriptionPublications = $descriptionPublications->where('bathrooms', '=', $request->bathrooms);
        }


        if ($request->min_price != null && $request->max_price != null)
            if ($request->min_price > $request->max_price) return back()->with('error', 'El valor del precio mínimo no puede ser mayor a la cantidad máxima');


        if ($request->min_price != null) {
            $titlePublications = $titlePublications->where('price', '>=', $request->min_price);
            $descriptionPublications = $descriptionPublications->where('price', '>=', $request->min_price);
        }

        if ($request->max_price != null) {
            $titlePublications = $titlePublications->where('price', '<=', $request->max_price);
            $descriptionPublications = $descriptionPublications->where('price', '<=', $request->max_price);
        }


        $col1 = $titlePublications->get();
        $col2 = $descriptionPublications->get();

        $Publications = $col1->merge($col2)->paginate(5);

        // Return the search view with the resluts compacted
        return view('publications.results')->with(compact('Publications', 'request'));
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
    public function pause(Publication $Publication)
    {

        $Publication->isActive = !($Publication->isActive);

        $Publication->update();
        return redirect()->back();
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
