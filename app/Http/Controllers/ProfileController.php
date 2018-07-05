<?php
namespace App\Http\Controllers;


use App\Models\Hobby;
use App\Models\User;
use App\Models\UserHobby;

use App\Models\UserRelationship;
use Auth;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Response;
use Session;

class ProfileController extends Controller
{
    private $user;
    private $my_profile = false;


    public function __construct()
    {
        $this->middleware('auth');
    }


    public function secure($username, $is_owner = false){
        $user = User::where('username', $username)->first();

        if ($user){
            $this->user = $user;
            $this->my_profile = (Auth::id() == $this->user->id)?true:false;
            if ($is_owner && !$this->my_profile){
                return false;
            }
            return true;
        }
        return false;
    }

    public function index($username){

        if (!$this->secure($username)) return redirect('/404');

        $user = $this->user;


        $my_profile = $this->my_profile;


        $wall = [
            'new_post_group_id' => 0
        ];

        $can_see = ($my_profile)?true:$user->canSeeProfile(Auth::id());


        $hobbies = Hobby::all();
        $relationship = $user->relatives()->with('relative')->where('allow', 1)->get();
        $relationship2 = $user->relatives2()->with('main')->where('allow', 1)->get();


        return view('profile.index', compact('user', 'my_profile', 'wall', 'can_see', 'hobbies', 'relationship', 'relationship2'));
    }

    public function following(Request $request, $username){

        if (!$this->secure($username)) return redirect('/404');

        $user = $this->user;

        $list = $user->following()->where('allow', 1)->with('following')->get();

        $my_profile = $this->my_profile;

        $can_see = ($my_profile)?true:$user->canSeeProfile(Auth::id());

        return view('profile.following', compact('user', 'list', 'my_profile', 'can_see'));
    }


    public function followers(Request $request, $username){

        if (!$this->secure($username)) return redirect('/404');

        $user = $this->user;

        $list = $user->follower()->where('allow', 1)->with('follower')->get();


        $my_profile = $this->my_profile;

        $can_see = ($my_profile)?true:$user->canSeeProfile(Auth::id());

        return view('profile.followers', compact('user', 'list', 'my_profile', 'can_see'));
    }



    public function saveHobbies(Request $request, $username){

        if (!$this->secure($username)) return redirect('/404');


        $my_hobbies = Auth::user()->hobbies()->get();


        $list = [];
        // dd($request->input('hobbies'));
        foreach($request->input('hobbies') as $i => $id){
            $list[$id] = 1;
        }



        foreach($my_hobbies as $hobby){
            $hobby_id = $hobby->hobby_id;
            if (!array_key_exists($hobby_id, $list)){
                $deleted = DB::delete('delete from user_hobbies where user_id='.Auth::id().' and hobby_id='.$hobby_id);
            }
            unset($list[$hobby_id]);
        }



        foreach($list as $id => $status){
            $hobby = new UserHobby();
            $hobby->user_id = Auth::id();
            $hobby->hobby_id = $id;
            $hobby->save();
        }

        $request->session()->flash('alert-success', 'Tus Hobbies fueron actualizados!');

        return redirect('/'.Auth::user()->username);

    }

    public function saveRelationship(Request $request, $username){

        if (!$this->secure($username)) return redirect('/404');


        $relationship = $request->input('relation');
        $person = $request->input('person');


        $relation = new UserRelationship();
        $relation->main_user_id = $person;
        $relation->relation_type = $relationship;
        $relation->related_user_id = Auth::id();

        if ($relation->save()) {

            $request->session()->flash('alert-success', 'Tu solicitud de relación ha sido enviada. El usuario aún debe aceptar esta relacion');

        }else{
            $request->session()->flash('alert-danger', 'Algo salio mal...');
        }

        return redirect('/'.Auth::user()->username);

    }

    public function uploadProfilePhoto(Request $request, $username){

        $response = array();
        $response['code'] = 400;
        if (!$this->secure($username, true)) return Response::json($response);

        $messages = [
            'image.required' => trans('validation.required'),
            'image.mimes' => trans('validation.mimes'),
            'image.max.file' => trans('validation.max.file'),
        ];
        $validator = Validator::make(array('image' => $request->file('image')), [
            'image' => 'required|mimes:jpeg,jpg,png,gif|max:2048'
        ], $messages);

        if ($validator->fails()) {
            $response['code'] = 400;
            $response['message'] = implode(' ', $validator->errors()->all());
        }else{
            $file = $request->file('image');

            $file_name = md5(uniqid() . time()) . '.' . $file->getClientOriginalExtension();
            if ($file->storeAs('public/uploads/profile_photos', $file_name)){
                $response['code'] = 200;
                $this->user->profile_path = $file_name;
                $this->user->save();
                $response['image_big'] = $this->user->getPhoto();
                $response['image_thumb'] = $this->user->getPhoto(200, 200);
            }else{
                $response['code'] = 400;
                $response['message'] = "Something went wrong!";
            }
        }
        return Response::json($response);

    }

    public function uploadCover(Request $request, $username){

        $response = array();
        $response['code'] = 400;
        if (!$this->secure($username, true)) return Response::json($response);

        $messages = [
            'image.required' => trans('validation.required'),
            'image.mimes' => trans('validation.mimes'),
            'image.max.file' => trans('validation.max.file'),
        ];
        $validator = Validator::make(array('image' => $request->file('image')), [
            'image' => 'required|mimes:jpeg,jpg,png,gif|max:2048'
        ], $messages);

        if ($validator->fails()) {
            $response['code'] = 400;
            $response['message'] = implode(' ', $validator->errors()->all());
        }else{
            $file = $request->file('image');

            $file_name = md5(uniqid() . time()) . '.' . $file->getClientOriginalExtension();
            if ($file->storeAs('public/uploads/covers', $file_name)){
                $response['code'] = 200;
                $this->user->cover_path = $file_name;
                $this->user->save();
                $response['image'] = $this->user->getCover();
            }else{
                $response['code'] = 400;
                $response['message'] = "Something went wrong!";
            }
        }
        return Response::json($response);

    }
}
