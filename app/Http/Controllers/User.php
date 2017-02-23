<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Auth;
use Illuminate\Support\Facades\Input;
use Validator;
Use Redirect;
Use Session;
use Hash;
use Image;

class User extends Controller {

    public function index() {
        if (Session::has('USER_ID')) {
            return Redirect::to('/user/my_account');
        }
        return view('user');
    }

    public function validateform(Request $request) {
        $postData = Input::all();
        $messages = [
            'name.required' => 'Please enter valid name',
            'name.alpha' => 'Name only alphabets',
            'email.required' => 'Please enter Email',
            'email.email' => 'Invalid Email',
            'email.unique' => 'Email Already registered',
            'mobile.required' => 'Please enter Mobile',
            'mobile.unique' => 'Mobile Already registered',
            'password.required' => 'Password is Required',
            'confirm_password.same' => 'Password must Match',
            'confirm_password.required' => 'Confirm password is required'
        ];
        $rules = [
            'name' => 'required|alpha',
            'email' => 'required|email|unique:user',
            'mobile' => 'required|unique:user',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ];

        $validator = Validator::make($postData, $rules, $messages);
        if ($validator->fails()) {
            return Redirect::to('/user')->withInput()->withErrors($validator);
        } else {
            $ins_arr = array('name' => Input::get('name'), 'email' => Input::get('email'), 'mobile' => Input::get('mobile'),
                'password' => md5(Input::get('password'))
            );
            DB::table('user')->insert($ins_arr);
            $user_id = DB::getPdo()->lastInsertId();
            Session::set('USER_ID', $user_id);
            return Redirect::to('/user/my_account');
        }
    }

    public function login() {
        if (Session::has('USER_ID')) {
            return Redirect::to('/user/my_account');
        }
        return view('login');
    }

    public function login_validate_form(Request $request) {
        $postData = Input::all();
        $messages = [
            'email.required' => 'Password is Required',
            'password.required' => 'Password is Required',
        ];
        $rules = [
            'email' => 'required',
            'password' => 'required',
        ];
        $validator = Validator::make($postData, $rules, $messages);
        if ($validator->fails()) {
            return Redirect::to('/user/login')->withInput()->withErrors($validator);
        } else {
            $condition = array('email' => Input::get('email'), 'password' => md5(Input::get('password')));
            $user_data = DB::table('user')->where($condition)->get();
            if (empty($user_data)) {
                Session::flash('message', 'Invalid Username or Password');
                return Redirect::to('/user/login');
            } else {
                $user_data = end($user_data);
                Session::set('USER_ID', $user_data->id);
                return Redirect::to('/user/my_account');
            }
        }
    }

    public function my_account() {
        if (!Session::has('USER_ID')) {
            Session::flash('message', 'You must login to access this page');
            return Redirect::to('/user/login');
        }
        return view('my_account');
    }

    public function image_upload(Request $request) {
        $postData = Input::all();
        $messages = [
            'photo.required' => 'Image is Required',
        ];
        $rules = [
            'photo' => 'required',
        ];
        $validator = Validator::make($postData, $rules, $messages);
        if ($validator->fails()) {
            return Redirect::to('/user/my_account')->withInput()->withErrors($validator);
        } else {
            $image = Input::file('photo');
            $rand = rand(000000, 99999999);
            $filename = time() . '_' . $rand . '.' . $image->getClientOriginalExtension();
            $path = base_path() . '/uploads/' . $filename;
            $path1 = base_path() . '/uploads/thumbnail/' . $filename;
            Image::make($image->getRealPath())->save($path);
            Image::make($image->getRealPath())->resize(200, 200)->save($path1);
            Session::flash('message', 'Image has been uploaded');
            return Redirect::to('/user/my_account');
        }
    }

    public function logout() {
        Session::forget('USER_ID');
        return Redirect::to('/');
    }

}
