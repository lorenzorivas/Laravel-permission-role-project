<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use Illuminate\Http\Request;
use App\User;
use App\Traits\UploadTrait;
use Storage;

class ProfileController extends Controller
{
    use UploadTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name'              =>  'required',
        ],
            [ 
                'name.required' => 'Has olvidado tu nombre'
            ]);

        $user = User::findOrFail(auth()->user()->id);
        $user->name = $request->input('name');

        // Check if a profile image has been uploaded
        if ($request->has('profile_image')) {
            // Get image file
            $image = $request->file('profile_image');
            // Make a image name based on user name and current timestamp
            $name = str_slug($request->input('name')).'_'.time();
            // Define folder path
            $folder = '/uploads/images/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, 'profile', $name);
            // Set user profile image path in database to filePath
            $user->profile_image = $filePath;

            $file = $request->image;
            Storage::disk('profile')->delete($file);
        }
        // Persist user record to database
        $user->save();

        // Return user back and show a flash message
        return redirect()->back()->with(['status' => 'Perfil actualizado con exito']);
    }

    public function showchangepasswordform(){
        return view('profile.changepassword');
    }

    public function changepassword(Request $request){
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Tu password actual no coincide. Intentalo de nuevo");
        }
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","Tu nueva password no puede ser la misma que ya usas. Ingresa una password distinta.");
        }
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
	return redirect()->back()->with("success","Tu password ha cambiada con exito!");
    }

}
