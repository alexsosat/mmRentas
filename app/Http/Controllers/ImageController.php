<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\User;
use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\UploadedFile;
use Cloudinary;


class ImageController extends Controller
{

    public function retrievePublicId($url)
    {
        preg_match("/upload\/(?:v\d+\/)?([^\.]+)/", $url, $matches);
        return $matches[1];
    }


    /**
     * Show the user profile picture
     *
     * @return \Illuminate\Http\Response
     */
    public function showUserImage(User $User)
    {
        if ($User === null) {
            abort(404);
        }

        $file = file_get_contents(public_path('img/defaults/user.png'));

        if ($User->image_url !== null) {
            $file = file_get_contents($User->image_url);
        }

        $response = Response::make($file, 200);
        $response->header("Content-Type", 'image/png');

        return $response;
    }

    /**
     * Show the publication thumbnail
     *
     * @return \Illuminate\Http\Response
     */
    public function showPublicationThumbnail(Publication $Publication)
    {

        if ($Publication === null) {
            abort(404);
        }

        $file = file_get_contents(public_path('img/defaults/publication.png'));

        $thumbnail_url = $Publication->images()->first();


        if ($thumbnail_url !== null) {
            $file = file_get_contents($thumbnail_url->image_url);
        }

        $response = Response::make($file, 200);
        $response->header("Content-Type", 'image/png');

        return $response;
    }

    /**
     * Show the publication picture
     *
     * @return \Illuminate\Http\Response
     */
    public function showPublicationImage(Publication $Publication, Image $Image)
    {
        if ($Image === null) {
            abort(404);
        }

        $file = file_get_contents(public_path('img/defaults/publication.png'));

        if ($Image->image_url !== null) {
            $file = file_get_contents($Image->image_url);
        }

        $response = Response::make($file, 200);
        $response->header("Content-Type", 'image/png');

        return $response;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UploadedFile $file, $path)
    {
        //Cloudinary
        return Cloudinary::upload($file->getRealPath(), [
            'folder' => $path,
            'transformation' => [
                'quality' => 'auto',
                'fetch_format' => 'auto'
            ]
        ])->getSecurePath();
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy($url)
    {
        $public_id = $this->retrievePublicId($url);
        Cloudinary::destroy($public_id);
    }
}
