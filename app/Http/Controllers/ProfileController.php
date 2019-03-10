<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;
use Illuminate\Support\Facades\Input;

class ProfileController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo "Here I'm";
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = User::findOrFail($id);
        
        return view('pages.user.profile.view-profile',['profile' => $profile, 'title'=> 'Profile', 'customJs' => 'profile-manage-js']);
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
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required | email | unique:users,email,'.$user->id,        
                ], [
            'first_name.required' => 'First name is required',
            'last_name.required' => 'Last name is required',
            'email.required' => 'Email is required',
            'email.unique' => 'Email is already register'
        ]);

        $data = array(
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'name' => $request->input('first_name')." ".$request->input('last_name'),
            'email' => $request->input('email'),
            'updated_at' => date('Y-m-d')
        );

        $result = User::where('id', $id)->update($data);

        if($result){
            Session::flash('success', 'Information Updated.');
            return redirect()->back();
        }else{
            Session::flash('errors', 'Update failed.');
            return redirect()->back();
        }
    }

    public function update_profile_image(Request $request, $id){
        $userImage = User::select('image')->where('id',$id)->first();

        if(is_null($userImage->image)){
            $newImageName = $id.'_'.strtolower($request->input('first_name')). '.' . $request->image->getClientOriginalExtension();
        }else{
            $imageName = explode(".",$userImage->image);            
            $newImageName = $imageName[0]. '.' . $request->image->getClientOriginalExtension();                
        }

        if (Input::hasFile('image')) {
            $file = $request->file('image');
            
            $fileExtent = $file->getClientOriginalExtension(); //file extension
            $extent = array('jpeg', 'jpg', 'png');
            
            if (in_array($fileExtent, $extent)) {
                $destinationPath = 'assets/images/user';
                
                $file->move($destinationPath, $newImageName); //here we rename with the valid file extension
                // return redirect()->back();
            } else {
                return redirect()->back()->withErrors('File in not an image');
            }
        } else {
            $upload_image = NULL;
        }

        $result = User::where('id', $id)->update(['updated_at' => date('Y-m-d'), 'image' => $newImageName]);

        if($result){
            Session::flash('success', 'Profile Image Updated.');
            return redirect()->back();
        }else{
            Session::flash('errors', 'Image update failed.');
            return redirect()->back();
        }
    }


    public function change_own_password(Request $request, $id){
        $this->validate($request, [
            'new_password' => 'required',
            'conf_new_password' => 'required | same:new_password'
                ], [
            'new_password.required' => 'New Password field is required.',
            'conf_new_password.required' => 'confirm password field is required.',
            'conf_new_password.same' => 'Both password fields are not match.',
        ]);

        // Password Hashing
        $password = $request->input('new_password');
        $hash_pass = password_hash($password, PASSWORD_DEFAULT);

        $result = User::where('id', $id)->update(['updated_at' => date('Y-m-d'), 'password' => $hash_pass]);

        if($result){
            Session::flash('success', 'Password Change Successful.');
            return redirect()->back();
        }else{
            Session::flash('errors', 'Password Change failed.');
            return redirect()->back();
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
