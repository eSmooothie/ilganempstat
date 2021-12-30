<?php

namespace App\Controllers;
use FPDF;
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
            'TOTAL_WORKER' => ($female + $male + $residential),
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

   public function downloadReport($year = null){
        $lower_bound = $year."-01-01";
        $upper_bound = $year."-12-31";
        $report_per_establishment = $this->employmentModel
        ->select("
            `barangay`.`NAME` AS `BARANGAY`,
            `establishment_info`.`NAME` AS `ESTABLISHMENT_NAME`,
            `establishment_info`.`OWNER` AS `ESTABLISHMENT_OWNER`,
            `establishment_info`.`BUSINESS_CODE` AS `ESTABLISHMENT_CODE`,
            `employment_history`.`FEMALE_WORKER` AS `FEMALE_EMPLOYEE`,
            `employment_history`.`MALE_WORKER` AS `MALE_WORKER`,
            `employment_history`.`RESIDENTIAL_WORKER` AS `RESIDENTIAL_WORKER`,
            `employment_history`.`TOTAL_WORKER` AS `TOTAL_WORKER`,
            `employment_history`.`BUSINESS_CAPITAL` AS `BUSINESS_CAPITAL`,
            `employment_history`.`BUSINESS_GROSS` AS `BUSINESS_GROSS`
        ")
        ->join("`establishment_info`","`establishment_info`.`ID` = `employment_history`.`ESTABLISHMENT_ID`","inner")
        ->join("`barangay`","`barangay`.`ID` = `employment_history`.`BRGY_ID`","inner")
        ->where("`employment_history`.`DATE` >= ", $lower_bound)
        ->where("`employment_history`.`DATE` <= ", $upper_bound)
        ->orderBy("`barangay`.`NAME`","ASC")
        ->findAll();

        $report_per_barangay = $this->employmentModel
        ->select("
            `barangay`.`NAME` AS `BARANGAY`,
            SUM(`employment_history`.`FEMALE_WORKER`) AS `FEMALE_EMPLOYEE`,
            SUM(`employment_history`.`MALE_WORKER`) AS `MALE_WORKER`,
            SUM(`employment_history`.`RESIDENTIAL_WORKER`) AS `RESIDENTIAL_WORKER`,
            SUM(`employment_history`.`TOTAL_WORKER`) AS `TOTAL_WORKER`
        ")
        ->join("`barangay`","`barangay`.`ID` = `employment_history`.`BRGY_ID`","inner")
        ->where("`employment_history`.`DATE` >= ", $lower_bound)
        ->where("`employment_history`.`DATE` <= ", $upper_bound)
        ->groupBy("`barangay`.`NAME`")
        ->orderBy("`barangay`.`NAME`","ASC")
        ->findAll();

        $data = [
            'per_establishment' => $report_per_establishment,
            'per_barangay' => $report_per_barangay,
        ];
        $this->generatePDF($data, $year);
   }

   private function generatePDF(array $data, $year){
        $pageOrientation = "L"; // landscape
        $pageUnitSize = "mm"; // milimeter
        $pageSize = "Legal"; // paper size
        $pdf = new FPDF( $pageOrientation, $pageUnitSize,$pageSize);

        $pdf->AddPage();

        $pageWidth = $pdf->GetPageWidth();
        $pageHeight = $pdf->GetPageHeight();
        $pdf->SetFont('Arial','',12);
       
        // start header
        $this->pdfHeader($pdf, $year);
        
        // display per barangay
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(0, 14, 'Per Barangay', 0, 1, 'L');
        $this->displayPerBarangay($pdf, $data['per_barangay']);
        
        // display per establishment
        $pdf->AddPage();

        $this->pdfHeader($pdf, $year);
      
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(0, 14, 'Per Establishment', 0, 1, 'L');
        $this->displayPerEstablishment($pdf, $data['per_establishment']);

        $this->response->setHeader('Content-Type', 'application/pdf');

        // doc config
        $pageTitle = $year."_employment_report";
        $author = "eSmooothiee";
        $pdf->SetTitle($pageTitle);
        $pdf->SetAuthor($author);
        $pdf->SetCreator($author);
        $pdf->Output();
   }

   private function displayPerBarangay(FPDF $pdf, array $data){
        // thead
        $pdf->SetFont('Arial','',12);
        $pdf->Cell(125, 14, 'Barangay', 1, 0, 'C');

        $pdf->Cell(210, 7, 'Workers', 1, 2, 'C');
        $pdf->Cell(52, 7, 'Female(%)', 1, 0, 'C');
        $pdf->Cell(52, 7, 'Male(%)', 1, 0, 'C');
        $pdf->Cell(54, 7, 'Residential(%)', 1, 0, 'C');
        $pdf->Cell(52, 7, 'Total', 1, 1, 'C');
        
        $ttl_female = 0;
        $ttl_male = 0;
        $ttl_residential = 0;
        $all_workers = 0;
        // tbody
        foreach($data as $key => $value){
            $barangay = $value['BARANGAY'];
            // $establishment_name = $value['ESTABLISHMENT_NAME'];
            $female = $value['FEMALE_EMPLOYEE'];
            $male = $value['MALE_WORKER'];
            $residential = $value['RESIDENTIAL_WORKER'];
            $ttl_worker = $value['TOTAL_WORKER'];

            $ttl_female += $female;
            $ttl_male += $male;
            $ttl_residential += $residential;
            $all_workers += $ttl_worker;

            $f_percentage = round(($female / $ttl_worker) * 100, 2);
            $m_percentage = round(($male / $ttl_worker) * 100, 2);
            $r_percentage = round(($residential / $ttl_worker) * 100, 2);

            $pdf->Cell(125, 10, $barangay, 1, 0, 'L');

            $pdf->Cell(52, 10, $female."(".$f_percentage.")", 1, 0, 'C');
            $pdf->Cell(52, 10, $male."(".$m_percentage.")", 1, 0, 'C');
            $pdf->Cell(54, 10, $residential."(".$r_percentage.")", 1, 0, 'C');
            $pdf->Cell(52, 10, $ttl_worker, 1, 1, 'C');
        }
        // tfoot
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(125, 10, 'OVERALL', 1, 0, 'R');

        $pdf->Cell(52, 10, $ttl_female."(".round(($ttl_female / $all_workers) * 100, 2).")", 1, 0, 'C');
        $pdf->Cell(52, 10, $ttl_male."(".round(($ttl_male / $all_workers) * 100, 2).")", 1, 0, 'C');
        $pdf->Cell(54, 10, $ttl_residential."(".round(($ttl_residential / $all_workers) * 100, 2).")", 1, 0, 'C');
        $pdf->Cell(52, 10, $all_workers, 1, 1, 'C');
        $pdf->SetFont('Arial','',12);
   }

   private function displayPerEstablishment(FPDF $pdf, array $data){
       // thead
       $pdf->SetFont('Arial','',12);
       $pdf->Cell(50, 14, 'Barangay', 1, 0, 'C');
       $pdf->Cell(60, 14, 'Establishment', 1, 0, 'C');
       $pdf->Cell(55, 14, 'Owner', 1, 0, 'C');
       $pdf->Cell(25, 14, 'Capital', 1, 0, 'C');
       $pdf->Cell(20, 14, 'Gross', 1, 0, 'C');

       $pdf->Cell(125, 7, 'Workers', 1, 2, 'C');
       $pdf->Cell(31, 7, 'Female(%)', 1, 0, 'C');
       $pdf->Cell(31, 7, 'Male(%)', 1, 0, 'C');
       $pdf->Cell(32, 7, 'Residential(%)', 1, 0, 'C');
       $pdf->Cell(31, 7, 'Total', 1, 1, 'C');
       
       $ttl_female = 0;
       $ttl_male = 0;
       $ttl_residential = 0;
       $all_workers = 0;
       // tbody
       foreach($data as $key => $value){
           $barangay = $value['BARANGAY'];
           $establishment_name = $value['ESTABLISHMENT_NAME'];
           $establishment_owner = $value['ESTABLISHMENT_OWNER'];
           $capital = $value['BUSINESS_CAPITAL'];
           $gross = $value['BUSINESS_GROSS'];
           // $establishment_name = $value['ESTABLISHMENT_NAME'];
           $female = $value['FEMALE_EMPLOYEE'];
           $male = $value['MALE_WORKER'];
           $residential = $value['RESIDENTIAL_WORKER'];
           $ttl_worker = $value['TOTAL_WORKER'];

           $ttl_female += $female;
           $ttl_male += $male;
           $ttl_residential += $residential;
           $all_workers += $ttl_worker;

           $f_percentage = round(($female / $ttl_worker) * 100, 2);
           $m_percentage = round(($male / $ttl_worker) * 100, 2);
           $r_percentage = round(($residential / $ttl_worker) * 100, 2);

           $pdf->Cell(50, 7, $barangay, 1, 0, 'C');
           $pdf->Cell(60, 7, $establishment_name, 1, 0, 'C');
           $pdf->Cell(55, 7, $establishment_owner, 1, 0, 'C');
           $pdf->Cell(25, 7, $capital, 1, 0, 'C');
           $pdf->Cell(20, 7, $gross, 1, 0, 'C');

           $pdf->Cell(31, 7, $female."(".$f_percentage.")", 1, 0, 'C');
           $pdf->Cell(31, 7, $male."(".$m_percentage.")", 1, 0, 'C');
           $pdf->Cell(32, 7, $residential."(".$r_percentage.")", 1, 0, 'C');
           $pdf->Cell(31, 7, $ttl_worker, 1, 1, 'C');
       }
       // tfoot
       $pdf->SetFont('Arial','B',12);
       $pdf->Cell(210, 10, 'OVERALL', 1, 0, 'R');

       $pdf->Cell(31, 10, $ttl_female."(".round(($ttl_female / $all_workers) * 100, 2).")", 1, 0, 'C');
       $pdf->Cell(31, 10, $ttl_male."(".round(($ttl_male / $all_workers) * 100, 2).")", 1, 0, 'C');
       $pdf->Cell(32, 10, $ttl_residential."(".round(($ttl_residential / $all_workers) * 100, 2).")", 1, 0, 'C');
       $pdf->Cell(31, 10, $all_workers, 1, 1, 'C');
       $pdf->SetFont('Arial','',12);
   }

   private function pdfHeader(FPDF $pdf,string $year){
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 7, $year." EMPLOYMENT REPORT", 0, 1, 'C');
        $pdf->SetFont('Arial', '', 8);
        $pdf->Cell(0, 5, "SAMPLE", 0, 0, 'C');
        $pdf->SetFont('Arial','',12);
        $pdf->Ln(15);
   }

   private function generateResponse(string $message, $data){
       return ['message' => $message, 'data' => $data];
   }
}
