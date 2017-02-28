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

class Api extends Controller {
    
    function __construct() {
        
        $this->secure_api();
        
    }

    public function register() {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
        } else {
            $json['status'] = '0';
            $json['message'] = 'Only Post method is allowded.';
            $this->send_response($json);
        }
    }

}
