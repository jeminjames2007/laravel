<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class Controller extends BaseController {

    use AuthorizesRequests,
        AuthorizesResources,
        DispatchesJobs,
        ValidatesRequests;

    function send_response($data) {
        header('Content-Type: application/json');
        $json = json_encode($data, JSON_PRETTY_PRINT);
        echo $json;
        exit;
    }

    function secure_api() {
        $key = "123";
        header('Content-Type: application/json');
        $headers = apache_request_headers();
        if ($key != $headers['api_key']) {
            $json['success'] = false;
            $json['message'] = "Invalid Api Key.";
            echo json_encode($json);
            exit;
        }
    }

}
