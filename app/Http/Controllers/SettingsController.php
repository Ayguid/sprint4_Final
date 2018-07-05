<?php
namespace App\Http\Controllers;


use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Session;

class SettingsController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index(){
    if (Session::has('user')){
      $user = Session::get('user');
    }else{
      $user = Auth::user();
    }
    return view('settings', compact('user'));
  }


  // if (Auth::user()->bio) {
  //   $rgb=Auth::user()->bio;
  //   $pieces = explode(",",$rgb);
  // }
  // if (isset($_POST['redSlider'])) {
  //   Auth::user()->bio = $_POST['redSlider'].','.$_POST['greenSlider'].','.$_POST['blueSlider'];
  //   Auth::user()->save();
  //
  // }

//password update
  public function update(Request $request){

    if (isset($_POST['redSlider'])) {
    Auth::user()->bio = $_POST['redSlider'].','.$_POST['greenSlider'].','.$_POST['blueSlider'];
    Auth::user()->save();
    return redirect('settings');
  }

    $additional_msg = false;
    //estaba sin && Hash::check($request->input("current_password"), Auth::user()->password)
    if (($request->input("type") == "password") && Hash::check($request->input("current_password"), Auth::user()->password) ){
      $validator = Validator::make($request->all(), [
        'current_password' => 'required|string|min:6',
        'password' => 'required|string|min:6|confirmed'
      ]);
      if ($validator->fails()) {
        $save = false;

      }
      else{
        Auth::user()->password = Hash::make($request->input("password"));
        $save = Auth::user()->save();
      }
    }


// username
    else if ($request->input("type") == "username"){
      $validator = Validator::make($request->all(), [
        'username' => 'required|max:191|unique:users,username,' . Auth::user()->id
      ]);

      $user = [
        'username' => $request->input("username"),
        'name' => Auth::user()->name,
        'email' => Auth::user()->email
      ];

      if ($validator->fails()) {
        $save = false;
      }
      else {
        Auth::user()->username = $user['username'];
        if (Auth::user()->validateUsername()) {
          $save = Auth::user()->save();
        }else{
          $save = false;
          $additional_msg = "El Usuario no puede contener caracteres especiales o espacios";
        }
      }
    }




// change nombre e email
    else  {
      $validator = Validator::make($request->all(), [
        'name' => 'required|max:191',
        'email' => 'required|email|max:191|unique:users,email,' . Auth::user()->id
      ]);

      $user = [
        'name' => $request->input("name"),
        'email' => $request->input("email"),
        'private' => $request->input("private"),
      ];



      if ($validator->fails()) {
        $save = false;

      }else {
        Auth::user()->name = $user['name'];
        Auth::user()->email = $user['email'];
        Auth::user()->private = $user['private'];
        $save = Auth::user()->save();
      }
    }

    if ($save){
      $request->session()->flash('alert-success', 'Sus Datos Fueron Actualizados Correctamente!');
    }else
    {
      $request->session()->flash('alert-danger', ($additional_msg)?$additional_msg:'Hubo un problema.....oops!');
    }



    if ($request->input("type") == "password"||$request->input("type") == "username"||$request->input("type") == "email") {
      if ($save){
        return redirect('settings');
      }else{
        return redirect('settings')->withErrors($validator);
      }
    }

    else{
      if ($save){

        return redirect('settings');
      }else{
        return redirect('settings')->withErrors($validator);
      }
    }


    if ($request->input("type") =="commit") {
        return view('settings', compact('user'));
  }






  }


  public function colors(){

  }

}
