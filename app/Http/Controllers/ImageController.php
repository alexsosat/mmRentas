<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\UploadedFile;
use Cloudinary;


class ImageController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UploadedFile $file)
    {
        //Cloudinary
        return Cloudinary::upload($file->getRealPath(), [
            'folder' => 'uploads',
            'transformation' => [
                'quality' => 'auto',
                'fetch_format' => 'auto'
            ]
        ])->getSecurePath();
    }

    /**
     * Show the user profile picture
     *
     * @return \Illuminate\Http\Response
     */
    public function showUserImage($id)
    {
        $User = User::select('user_image')->find($id);
        if ($User === null) {
            abort(404);
        }

        $file = file_get_contents(public_path('img/defaults/user.png'));
        $type = 'image/png';

        if ($User->user_image !== null) {

            $file = file_get_contents($User->user_image);
        }

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        //
    }
}
