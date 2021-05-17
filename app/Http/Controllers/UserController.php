<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Controllers\ImageController;


class UserController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $User)
    {
        return View('user.info', compact('User'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateInfo(Request $request, User $User)
    {

        //validating the email if changed
        if ($request->email !== $User->email) {
            $request->validate([
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);
        }

        //validating the data
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'user_image' => 'mimes:jpg,png|max:3000',
        ]);

        //updating the image if new file is sent
        if ($request->user_image !== null) {

            if ($User->image_url !== null) {
                //Deleting previous image
                app(ImageController::class)->destroy($User->image_url);
            }

            $User->image_url = app(ImageController::class)->store($request->user_image);
        }

        //updating the user data
        $User->name = $request->name;
        $User->surname = $request->surname;
        $User->email = $request->email;

        $User->update();
        return back()->with('success', 'Datos actualizados exitosamente');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, User $User)
    {
        if (!Hash::check($request->old_password, $User->password)) {
            return back()->withErrors(['La contraseña no coincidie con tu antigua contraseña', 'old_password']);
        }

        if (Hash::check($request->password, $User->password)) {
            return back()->withErrors(['La contraseña antigua es la misma que la nueva', 'same_password']);
        }

        //validating the password
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        //updating the user
        $User->password = Hash::make($request->password);
        $User->update();


        return back()->with('success', 'Datos actualizados exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $User)
    {
        if ($User->image_url !== null) {
            app(ImageController::class)->destroy($User->image_url);
        }

        //Finding the publications to delete the visual archive and images in local storage
        $Publications = Publication::where('user_id', '=', $User->id)->get();
        foreach ($Publications as $Publication) {
            //deleting the publication images
            $Images = Image::all()->where('pub_id', '=', $Publication->id);
            foreach ($Images as $Image) {
                app(ImageController::class)->destroy($Image->image_file);
                Image::destroy($Image->id);
            }
        }

        User::destroy($User->id);
        return redirect('/');
    }
}
