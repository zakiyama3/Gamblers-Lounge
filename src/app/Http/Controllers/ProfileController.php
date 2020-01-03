<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Image;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
  public function profile(Request $request)
  {
    $id=$request->input('id');
    if(Auth::id() == $id){
      $id=Auth::id();
    }

    $user=DB::table('users')
                ->where('users.id',$id)
                ->get();
    $posts=DB::table('users')
                ->join('posts', 'users.id', '=', 'posts.id')
                ->where('posts.delete_flag',0)
                ->where('users.id',$id)
                ->orderBy('posts.created_at')
                ->select('users.name','users.image_url','users.id','posts.post_text','posts.post_image')
                ->paginate(12);

    $display=[
      'posts'=>$posts,
      'users'=>$user,
      'id'=>$id
    ];
    return view("profile", $display);
  }
  public function profileEdit(Request $request)
  {
    $id=Auth::id();
    $name=$request->name;
    $email=$request->email;
    $profile=$request->profile;
    $imagePath = $request->file('imageFile')->store('public/profileImage');
    $imagePath = str_replace('public','storage',$imagePath);
    $request->user()->fill(['password' => Hash::make($request->password)])->save();

    $this->validate($request, [
        'imageFile' => [
            'required',
            'file',
            'image',
            'mimes:jpeg,png'
        ]
    ]);

    DB::table('users')
                ->where('id', $id)
                ->update(['name' => $name,
                          'profile'=>$profile,
                          'image_url'=>$imagePath
                        ]);

    $user=DB::table('users')
                ->where('users.id',$id)
                ->get();

    $posts=DB::table('users')
                ->join('posts', 'users.id', '=', 'posts.id')
                ->where('posts.delete_flag',0)
                ->where('users.id',$id)
                ->orderBy('posts.created_at')
                ->select('users.name','users.image_url','users.id','posts.post_text','posts.post_image')
                ->paginate(12);

    $display=[
      'posts'=>$posts,
      'users'=>$user,
      'id'=>$id
    ];

    return view('profile',$display);
  }
}
