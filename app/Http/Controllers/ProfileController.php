<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Hash;
use Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('user.profile');
    }

    public function update(Request $request)
    {
        // Validation Part
        $rules = [
            'name'     => 'required|string|min:3|max:191',
            'email'    => 'required|email|min:3|max:191',
            'password' => 'nullable|string|min:5|max:191',
            'image'    => 'nullable|image|max:1999', //formats: jpeg, png, bmp, gif, svg
        ];
        $request->validate($rules);

        // Get the auth user, assigning the profile image
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;

        // Finally Uploading the Image
        if($request->hasFile('image')){

            //get image file.
            $image = $request->image;

            //get just extension.
            $ext = $image->getClientOriginalExtension();

            //make a unique name
            $filename = uniqid().'.'.$ext;

            //upload the image
            $image->storeAs('public/pics',$filename);

            //delete the previous image.
            Storage::delete("public/pics/{$user->image}");

            //this column has a default value so don't need to set it empty.
            $user->image = $filename;
        }

        // If password not exist inside the request, then we will keep the previous password, else assign new password with hashing
        if($request->password){
            $user->password = Hash::make($request->password);
        }

        // Finally save the user and redirect to specific route
        $user->save();
        return redirect()
            ->route('profile.index')
            ->with('status','Your profile has been updated!');
        }
}
