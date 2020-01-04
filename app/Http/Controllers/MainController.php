<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Name;

class MainController extends Controller
{
  private function validator(array $data)
  {
    return Validator::make($data, [
            'MyName' => 'required|max:255',
            'MyOldPassword'=>'required|min:6',
            'MyNewPassword' => 'required|confirmed|min:6',
    ]);
  }
  public function __construct(){
    $this->middleware('auth');
  }
  public function main()
  {
    $id=Auth::id();
    $posts=DB::table('users')
                ->join('posts', 'users.id', '=', 'posts.id')
                ->where('posts.delete_flag',0)
                ->orderBy('posts.created_at')
                ->select('users.name','users.image_url','users.id','posts.post_id','posts.post_text','posts.post_image')
                ->paginate(12);

    $display=[
      'id'=>$id,
      'posts'=>$posts
    ];
    return view("main", $display);
  }
  public function mainPost(Request $request)
  {
    $id=Auth::id();
    $userPost=$request->input('userPost');
    $imagePath = $request->file('imageFile')->store('public/postImage');
    $imagePath = str_replace('public','storage',$imagePath);

    $this->validate($request, [
        'imageFile' => [
            'required',
            'file',
            'image',
            'mimes:jpeg,png'
        ]
    ]);

    DB::table('posts')->insert([
      'id' => $id,
      'post_text' => $userPost,
      'post_image' => $imagePath,
      'delete_flag' => 0,
      'created_at'  => Carbon::now()
    ]);

    $posts=DB::table('users')
                ->join('posts', 'users.id', '=', 'posts.id')
                ->where('posts.delete_flag',0)
                ->orderBy('posts.created_at')
                ->select('users.name','users.image_url','users.id','posts.post_id','posts.post_text','posts.post_image')
                ->paginate(12);

    $display=[
      'id'=>$id,
      'posts'=>$posts
    ];

    return view("main",$display);
  }
  public function mainPostEdit(Request $request)
  {
    $id=Auth::id();
    $postId=$request->postId;
    $postText=$request->postText;
    $imagePath = $request->file('imageFile')->store('public/postImage');
    $imagePath = str_replace('public','storage',$imagePath);

    $this->validate($request, [
        'imageFile' => [
            'required',
            'file',
            'image',
            'mimes:jpeg,png'
        ]
    ]);

    DB::table('posts')
                ->where('post_id', $postId)
                ->update(['post_text'=>$postText,
                          'post_image'=>$imagePath,
                          'updated_at'  => Carbon::now()
                        ]);

    $posts=DB::table('users')
                ->join('posts', 'users.id', '=', 'posts.id')
                ->where('posts.delete_flag',0)
                ->orderBy('posts.created_at')
                ->select('users.name','users.image_url','users.id','posts.post_id','posts.post_text','posts.post_image')
                ->paginate(12);

    $display=[
      'id'=>$id,
      'posts'=>$posts
    ];

    return view('main',$display);
  }
  public function mainPostDelete(Request $request)
  {
    $id=Auth::id();
    $postId=$request->postId;

    DB::table('posts')
                ->where('post_id', $postId)
                ->update(['delete_flag'=>1,
                          'updated_at'  => Carbon::now()
                        ]);    

    $posts=DB::table('users')
              ->join('posts', 'users.id', '=', 'posts.id')
              ->where('posts.delete_flag',0)
              ->orderBy('posts.created_at')
              ->select('users.name','users.image_url','users.id','posts.post_id','posts.post_text','posts.post_image')
              ->paginate(12);

    $display=[
      'id'=>$id,
      'posts'=>$posts
    ];

    return view('main',$display);
  }
}
