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
        $this->session->set("user_id", $user['ID']);
        $data = 1;
        $response = $this->generateResponse("OK", $data);
        return  $this->setResponseFormat('json')->respond($response, 200);
   }

   public function createAccount(){
        header("Content-type: application/json");
        $username = $this->request->getPost("username");
        $password = $this->request->getPost("confirm_password");
        $firstname = $this->request->getPost("firstname");
        $lastname = $this->request->getPost("lastname");

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
            'FIRSTNAME' => $firstname,
            'LASTNAME' => $lastname,
            'DATE_CREATED' => $this->time->now(),
        ];

        $this->userModel->insert($new_user);

        $data = 1;

        $response = $this->generateResponse("OK", $data);
        return  $this->setResponseFormat('json')->respond($response, 200);
   }

   public function newEstablishment(){
        header("Content-type: application/json");
        $code = $this->request->getPost("business_code");
        $owner = $this->request->getPost("business_owner");
        $name = $this->request->getPost("business_name");

        $new_establishment = [
            'BUSINESS_CODE' => $code,
            'OWNER' => $owner,
            'NAME' => $name,
        ];

        $this->establishmentModel->insert($new_establishment);

        $data = $new_establishment;
        $response = $this->generateResponse("OK", $data);
        return  $this->setResponseFormat('json')->respond($response, 200);
   }

   public function addEmployementData(){
        header("Content-type: application/json");
        $date = $this->request->getPost('date');
        $barangay = $this->request->getPost("barangay");
        $establishment = $this->request->getPost("establishment");
        $female = $this->request->getPost("female_employee");
        $male = $this->request->getPost("male_employee");
        $residential = $this->request->getPost("residential_employee");
        $capital = $this->request->getPost("business_capital");
        $gross = $this->request->getPost("business_gross");
        // SAVE SA DB
        $newData = [
            'DATE' => $date,
            'BRGY_ID' => $barangay,
            'ESTABLISHMENT_ID' => $establishment,
            'FEMALE_WORKER' => $female,
            'MALE_WORKER' => $male,
            'RESIDENTIAL_WORKER' => $residential,
            'TOTAL_WORKER' => ($female + $male),
            'BUSINESS_CAPITAL' => $capital,
            'BUSINESS_GROSS' => $gross,
            'USER_ID' => $this->session->get("user_id"),
        ];

        $this->employmentModel->insert($newData);

        // RETURN YEAR, OTHER DATA
        // SAVE SA FIREBASE
        $barangay_info = $this->barangayModel->find($barangay);

        $parse_date = date_parse($date);
        $january = $parse_date['year']."-01-01";
        $december = $parse_date['year']."-12-31";
        // QUERY LATEST EMPLOYEMENT STATUS FROM X BARANGAY
        $employement_status = $this->employmentModel
        ->select("
            SUM(`FEMALE_WORKER`) AS `TTL_FEMALE`,
            SUM(`MALE_WORKER`) AS `TTL_MALE`,
            SUM(`RESIDENTIAL_WORKER`) AS `TTL_RESIDENTIAL`,
            SUM(`TOTAL_WORKER`) AS `TTL_WORKER`
        ")
        ->where("BRGY_ID", $barangay)
        ->where("DATE >=", $january)
        ->where("DATE <=", $december)
        ->first();
        
        $firebase = [
            'YEAR' => $parse_date['year'],
            'BARANGAY' => strtoupper($barangay_info['NAME']),
            'EMPLOYMENT_STATUS' => $employement_status,
        ];

        $data = $firebase;
        $response = $this->generateResponse("OK", $data);
        return  $this->setResponseFormat('json')->respond($response, 200);
   }

   private function generateResponse(string $message, $data){
       return ['message' => $message, 'data' => $data];
   }
}
