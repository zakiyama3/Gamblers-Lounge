<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
  public function sigh()
  {
    return view("sigh");
  }
  public function sighCheck(Request $request)
  {
      $name=$request->name;
      $email=$request->email;
      $password=$request->user()->fill([
            'password' => Hash::make($request->newPassword)
        ])->save();
      // $imagePath = $request->file('imageFile')->store('public/profileImage');

      $validate_rule=[
        'name'=>'required',
        'email'=>'email',
        'password'=>'required',
      ];

      $this->validate($request,$validate_rule);

      // $data=[
      //   'name'=>$name,
      //   'email'=>$email,
      //   'password'=>$password
      // ];
      // DB::insert('insert into users(name,email,password) value(:name,:email,:password)',$data);
      DB::table('users')->insert(
                                  [
                                  'name' => $name,
                                  'email' => $email,
                                  'password' => $password
                                  ]
                                );
      return view("main",$data);
  }
  public function login()
  {
    return view("login");
  }
  public function loginCheck(Request $request)
  {
    $email=$request->email;
    $password=$request->user()->fill([
          'password' => Hash::make($request->newPassword)
      ])->save();

      $data=[
        'email'=>$email,
        'password'=>$password
      ];

      $userCount=DB::table('users')
                      ->where('email',$data['email'])
                      ->where('password',$data['password'])
                      ->count('id');

      if($userCount==1){
        $userData=DB::table('users')
                      ->where('email',$data['email'])
                      ->where('password',$data['password'])
                      ->first();
        $data=[
          'id'=>$userData->id,
          'name'=>$userData->name
        ];
        return redirect(route('main',$data));
      }else{
        return view("login");
      }
      return view("login",$data);
  }
}
