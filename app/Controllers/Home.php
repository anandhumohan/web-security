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

    //Twilio call handler for sending SMS
    public function sendToken($otp){

        $account_sid = 'AC256b99d0305e99317525152e9a31f327';
        $auth_token = 'd59fe2d0b5af48e8f0c3725f5e0ce70e';
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
                if($pwdWerify){
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

    public function createNewUser(){
        helper('form');
        $request = \Config\Services::request();
        //print_r($request);exit();
        $firstname = $this->request->getVar('firstname');
        $lastname = $this->request->getVar('lastname');
        $email = $this->request->getVar('email');
        $phone = $this->request->getVar('phone');
        $username = $this->request->getVar('username');
        $password = password_hash($this->request->getVar('password'),PASSWORD_DEFAULT);
        $userModel = new \App\Models\User();

        $data = [
            'firstname' => $firstname,
            'lastname'  => $lastname,
            'email'  => $email,
            'phone'  => $phone,
            'username'  => $username,
            'password'  => $password
        ];
        
        if($userModel->createUser($data)){
            return true;
        }else{
            return false;
        }
    }

    public function topPasswordCheck($pwd){

        $lines = file(WRITEPATH."password_list.txt");
        foreach($lines as $line)
        {   
            if($line == $pwd)
                return true;
        }
        return false;
    }

    public function validateRegister(){
        $message = array();
        $pwd = $this->request->getVar('password');

        if (strlen($pwd) < 8) {
            $message[] = "atlease  8 character";
        }

        if (!preg_match("#[0-9]+#", $pwd)) {
            $message[] = "at least one number";
        }

        if (!preg_match("#[a-z]+#", $pwd)) {
            $message[] = "at least one small letter";
        } 
        if (!preg_match("#[A-Z]+#", $pwd)) {
            $message[] = "at least one capital letter";
        }     

        if (!preg_match("#[^a-zA-Z\d]+#", $pwd)) {
            $message[] = "at least one special charancter letter";
        }
        if(count($message) == 0){
            if($this->topPasswordCheck($pwd)){
                $message[] = "Password is too weak";
                $session = session();
                $session->setFlashdata('msg', $message);
                return view('register');
            }else{
                if($this->createNewUser()){
                    return view('register_success');
                }
            }
        }else{
            $session = session();
            $session->setFlashdata('msg', $message);
            return view('register');
        }

    }

    public function tryxss(){
        return view('xss');
    }

    public function addUserInput(){
        helper('form');
        $request = \Config\Services::request();
        $username =  htmlspecialchars($this->request->getVar('username'));
        $userModel = new \App\Models\User();

        $data = [
            'username'  => $username
        ];
        
        if($userModel->addUser($data)){
            return true;
        }else{
            return false;
        }

    }


}








