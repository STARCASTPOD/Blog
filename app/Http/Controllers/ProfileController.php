<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserDetails;
use App\User;


class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except'=>['show', 'index']]);
    }


    /** 
    * Shows the Profile of all users.
    *
    * @return view 
    */
    function index(){
        $users = User::orderBy('created_at')->paginate(10);

        return view('profiles.index')->with('users', $users);
    }


    /** 
    * Shows the Profile of a user.
    * @param int $id
    * @param string $username
    *
    * @return view 
    */
    function show($username){
        $user = User::where('username', $username)->first();

        // return $u . '<br><br>' . $u->details;
        return view('profiles.show')->with('user', $user);
        // return $user->posts;
    }

    /**
    * Updates the profile of the user.
    * @param int $id
    * @param Request $request
    *
    * @return view
    */
    function update(Request $request,int $id){

        if (auth()->user()->id !== $id) {
            return redirect( url()->previous())->with('errors', 'Unathorized access.');
        }

        $this->validate($request, [
            'name'=>'required|max:64',
            'bio'=>'nullable|max:255',
            'country'=>'nullable|max:72',
            'city'=>'nullable|max:72',
            'facebook'=> 'url|nullable',
            'twitter'=> 'url|nullable',
            'instagram'=> 'url|nullable',
            'profile_image'=> 'bail|image|nullable|max:1999|mimes:jpeg,jpg,png'
        ]);

        if ($request->hasFile('profile_image')) {
            // Get the file name with extension
            $fileWithExt = $request->file('profile_image')->getClientOriginalName();

            // Get just filename
            $filename = pathinfo($fileWithExt, PATHINFO_FILENAME);

            // Get just extension
            $ext = $request->file('profile_image')->getClientOriginalExtension();

            // Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$ext;

            // Upload Image
            $path = $request->file('profile_image')->storeAs('public/profile_pictures', $fileNameToStore);
        }

        $user = User::find($id);
        $user->name = $request->input('name');
        $user->details['bio'] = ($request->input('bio'))? $request->input('bio'):'';
        $user->details['country'] = ($request->input('country'))? $request->input('country'):'';
        $user->details['city'] = ($request->input('city'))? $request->input('city'):'';
        $user->details['facebook'] = ($request->input('facebook'))? $request->input('facebook'):'';
        $user->details['twitter'] = ($request->input('twitter'))? $request->input('twitter'):'';
        $user->details['instagram'] = ($request->input('instagram'))? $request->input('instagram'):'';

        if ($request->hasFile('profile_image')) {
            $user->details['avatar'] = $fileNameToStore;
        }
    
        $user->save();
        $user->details->save();

        return redirect('/dashboard')->with('success','Profile Updated'); 
    }

    /**
    * To Edit the profile of the user
    * @param int $id
    * @param Request $request
    *
    * @return view
    */
    function edit(Request $request, $username){
        $user = User::where('username', $username)->first();

        if (auth()->user()->id !== $user->id) {
            return redirect(url()->previous())->with('error', 'Unauthorized user!');
        }

        return view('profiles.edit')->with('user', $user);
    }
}
