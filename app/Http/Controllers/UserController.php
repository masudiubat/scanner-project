<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;
use Illuminate\Support\Facades\Input;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userList = User::where('status',1)->get();
        return view('pages.user.profile.user-list-view',['userList' => $userList, 'title' => 'User Management', 'customJs' => 'user-management-js']);
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required | email | unique:users',
            'password' => 'required',
            'confirm_password' => 'required | same:password',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',        
                ], [
            'first_name.required' => 'First name is required',
            'last_name.required' => 'Last name is required',
            'email.required' => 'Email is required',
            'email.unique' => 'Email is already register',
            'password.required' => 'Password field is required.',
            'confirm_password.required' => 'confirm password field is required.',
            'confirm_password.same' => 'Both password fields are not match.',
            'image.image' => 'File should be an Image.',
            'image.mimes' => 'File should be jpeg, png, jpg',
            'image.max' => 'Maximum Image size is 2048'
        ]);

        if(Input::hasFile('image')){
            $lastid = User::select('id')->orderBy('id', 'DESC')->first();
            $imageName = $lastid->id.'_'.strtolower($request->input('first_name')). '.' . $request->image->getClientOriginalExtension();
            //$request->image->move(('assets/images'), $imageName);

            $file = $request->file('image');

            $fileExtent = $file->getClientOriginalExtension(); //file extension
            $extent = array('jpeg', 'jpg', 'png');

            if (in_array($fileExtent, $extent)) {
                $destinationPath = 'assets/images/user';
                
                $file->move($destinationPath, $imageName); //here we rename with the valid file extension
                // return redirect()->back();
            } else {
                return redirect()->back()->withErrors('File in not an image');
            }

        }

        $password = $request->input('password');

        $hash_pass = password_hash($password, PASSWORD_DEFAULT);

        $data = array(
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => $hash_pass,
            'image' => $imageName,
            'created_at' => date('y-m-d')
        );
        
        $result = User::create($data);

        if($result){
            Session::flash('success', 'New profile created.');
            return redirect()->back();
        }else{
            Session::flash('errors', 'New profile creation failed.');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $result = $user->delete();

        if($result){
            Session::flash('success', 'Delete Successful.');
            return redirect()->back();
        }else{
            Session::flash('errors', 'Delete failed.');
            return redirect()->back();
        }
    }
}
