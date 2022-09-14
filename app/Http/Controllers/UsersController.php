<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Image;
use Illuminate\Support\Facades\File;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('created_at')->get();
        return view('users.index',compact('users'));
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
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|unique:users,email,,id',
            'name' => 'required',
            'date_of_joining' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'gender' => 'required',
        ]);
        if($validator->fails()){
            return back()->withErrors($validator,'createUser')->withInput();
        }
        try{
            DB::beginTransaction();
            $image_path = null;
            if ($request->hasfile('profile_image')) {
                $image = $request->file('profile_image');
                $imageDimensions = Image::make($image);
                $height = $imageDimensions->height();
                $width = $imageDimensions->width();
                $image_name = $request->name .  "_profile_image_" . time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('storage/user_images');
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath);
                }
                $imgFile = Image::make($image->getRealPath());
                $imgFile->resize(100, 100, function ($constraint) {
                    // $constraint->aspectRatio();
                })->save($destinationPath . '/' . $image_name);
                $image_path = 'storage/user_images/' . $image_name;
            }

            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->date_of_joining = $request->date_of_joining;
            $user->date_of_leaving = (!isset($request->working_flag)) ? $request->date_of_leaving : null;
            $user->profile_image = $image_path;
            $user->gender = $request->gender;
            $user->save();
            DB::commit();

            return back()->with('success','User created successfully.');
        }catch(Exception $e){
            DB::rollback();
            return back()->with('error','Oops! Something went wrong. Please try after sometime.')->withInput();
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
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|unique:users,email,'.$id,
            'name' => 'required',
            'date_of_joining' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'gender' => 'required',
        ]);
        if($validator->fails()){
            return back()->withErrors($validator,$id)->withInput();
        }
        try{
            $user = User::find($id);
            DB::beginTransaction();
            $image_path = $user->profile_image;
            if ($request->hasfile('profile_image')) {
                if($user->profile_image != null){
                    unlink($user->profile_image);
                }
                $image = $request->file('profile_image');
                $imageDimensions = Image::make($image);
                $height = $imageDimensions->height();
                $width = $imageDimensions->width();
                $image_name = $request->name .  "_profile_image_" . time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('storage/user_images');
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath);
                }
                $imgFile = Image::make($image->getRealPath());
                $imgFile->resize(100, 100, function ($constraint) {
                    // $constraint->aspectRatio();
                })->save($destinationPath . '/' . $image_name);
                $image_path = 'storage/user_images/' . $image_name;
            }

            $user->name = $request->name;
            $user->email = $request->email;
            $user->date_of_joining = $request->date_of_joining;
            $user->date_of_leaving = (!isset($request->working_flag)) ? $request->date_of_leaving : null;
            $user->profile_image = $image_path;
            $user->gender = $request->gender;
            $user->save();
            DB::commit();

            return back()->with('success','User updated successfully.');
        }catch(Exception $e){
            DB::rollback();
            return back()->with('error','Oops! Something went wrong. Please try after sometime.')->withInput();
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
        try{
            $user = User::find($id);
            DB::beginTransaction();
            if($user->profile_image != null){
                unlink($user->profile_image);
            }
            $user->delete();
            DB::commit();

            return back()->with('success','User deleted successfully.');
        }catch(Exception $e){
            DB::rollback();
            return back()->with('error','Oops! Something went wrong. Please try after sometime.')->withInput();
        }
    }
}
