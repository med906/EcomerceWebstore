<?php

namespace App\Http\Controllers;

use App\Mail\signupMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class signupMailController extends Controller
{
    public static function sendSignupEmail($name,$email,$verification_code){

        $data = [
            'name'=>$name,
            'verification_code'=>$verification_code
        ];
        Mail::to($email)->send(new signupMail($data));



    }
}
