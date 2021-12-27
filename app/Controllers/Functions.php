<?php

namespace App\Controllers;

class Functions extends BaseController
{ 
   public function authenticate(){
        header("Content-type: application/json");
        $username = $this->request->getPost("username");
        $password = $this->request->getPost("password");

        // retrieve user
        $user = $this->userModel
        ->where("USERNAME", $username)
        ->first();

        if(empty($user)){
            $data = null;
            $response = $this->generateResponse("Invalid Username or Password", $data);
            return  $this->setResponseFormat('json')->respond($response, 200);
        }
        // match password
        $password_match = password_verify($password, $user['PASSWORD']);
        if(!$password_match){
            $data = null;
            $response = $this->generateResponse("Invalid Username or Password", $data);
            return  $this->setResponseFormat('json')->respond($response, 200);
        }
        
        $this->session->set("is_login",1);
        $data = 1;
        $response = $this->generateResponse("OK", $data);
        return  $this->setResponseFormat('json')->respond($response, 200);
   }

   public function createAccount(){
        header("Content-type: application/json");
        $username = $this->request->getPost("username");
        $password = $this->request->getPost("confirm_password");

        $isExist = $this->userModel
        ->where("USERNAME", $username)
        ->countAllResults();

        if($isExist > 0){
            $data = null;
            $response = $this->generateResponse("username already exist!", $data);
            return  $this->setResponseFormat('json')->respond($response, 200);
        }

        $hash_password = password_hash($password, PASSWORD_DEFAULT);
        
        $new_user = [
            'USERNAME' => $username,
            'PASSWORD' => $hash_password,
            'DATE_CREATED' => $this->time->now(),
        ];

        $this->userModel->insert($new_user);

        $data = 1;

        $response = $this->generateResponse("OK", $data);
        return  $this->setResponseFormat('json')->respond($response, 200);
   }

   private function generateResponse(string $message, $data){
       return ['message' => $message, 'data' => $data];
   }
}
