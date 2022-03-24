<?php

namespace App\Controllers;

require '/Applications/XAMPP/xamppfiles/htdocs/WebApp/vendor/autoload.php';

use Twilio\Rest\Client;

class Home extends BaseController
{
    public function index()
    {
        return view('home');
    }

    public function brockenAuthentication(){
        return view('authentication');
    }

    public function register(){
        return view('register');
    }


    public function sendToken($otp){
        //twilio call handler for sending the token
        //echo "string"; exit();
        $account_sid = 'AC256b99d0305e99317525152e9a31f327';
        $auth_token = '8720ee6cb27f021dd5ce58b8d3ea5146';

        $twilio_number = "+15407248646";
        $client = new Client($account_sid, $auth_token);
        $client->messages->create(
        '+919900470055',
        array(
            'from' => $twilio_number,
            'body' => 'your 6 digit secure opt is '.$otp
        )
        );
    }

    public function validateCredentials()
    {
        $validation =  \Config\Services::validation();
        $flag = false;

        $rules = [
            "username" => [
                "label" => "Username", 
                "rules" => "required"
            ],
            "password" => [
                "label" => "Password", 
                "rules" => "required"
            ]
        ];

        if($this->validate($rules)) {
            $flag = true;
        } else {
            $data["validation"] = $validation->getErrors();
        }
        
        
        if($flag){
            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');
            $userModel = new \App\Models\User();
            
            $userSet = $userModel->where('username', $username)->first();
            //echo "string";
            if($userSet){
                $passWord = $userSet['password'];
                $pwdWerify = password_verify($password, $passWord);
                //print_r($pwdWerify);
                if($pwdWerify){
                    //have to generat ethe code and save it in tha session
                    $otp = random_int(100000, 999999);
                    $result = $this->sendToken($otp);
                    $userdata = [
                        'id' => $userSet['id'],
                        'firstname' => $userSet['firstname'],
                        'email' => $userSet['email'],
                        'otp' => $otp
                    ];
                    $session = session();
                    $session->set($userdata);
                    //print_r($_SESSION);exit();
                    return view('secondphase');
                }else{
                    $session = session();
                    $session->setFlashdata('msg', 'Password is wrong');
                    return view('authentication');
                    
                }
            }else{
                $session = session();
                $session->setFlashdata('msg', 'Username is wrong');
                return view('authentication');
            }    
        }else{
            return view('authentication');
        }
    }

    public function validateOtp(){

        $otp = $this->request->getVar('otp');
        if($otp == $_SESSION['otp']){
            return view('lancher');
        }else{
            return view('authentication');
        }

    }
}
