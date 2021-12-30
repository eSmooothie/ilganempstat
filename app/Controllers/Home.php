<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(){
        
        $page_path = "homepage.php";
        $data = $this->mapPageArguments('HOMEPAGE', false, 'assets/videos/vid_1.mp4');
        $this->generatePage($page_path, $data);
    }

    public function graph(){

        $page_path = "graph.php";
        $data = $this->mapPageArguments('GRAPH', true, 'assets/images/graph_banner_1.jpg');
        $this->generatePage($page_path, $data);
    }

    public function form(){

        $establishments = $this->establishmentModel->findAll();
        $barangays = $this->barangayModel
        ->orderBy('NAME','ASC')
        ->findAll();

        $args = [
            'establishments' => $establishments,
            'barangays' => $barangays,
        ];

        $page_path = "form.php";
        $data = $this->mapPageArguments('FORM', true, 'assets/images/graph_banner_1.jpg', $args);
        $this->generatePage($page_path, $data);
    }

    public function about(){

        $page_path = "about.php";
        $data = $this->mapPageArguments('ABOUT', true, 'assets/images/graph_banner_1.jpg');
        $this->generatePage($page_path, $data);
    }

    public function profile(){

        $user_id = $this->session->get("user_id");
        $user_info = $this->userModel->find($user_id);
        $year =  $this->employmentModel
        ->select("
            DISTINCT(YEAR(`DATE`)) AS `year`
        ")->findAll();

        $args = [
            'user' => $user_info,
            'year' => $year
        ];
        
        $page_path = "profile.php";
        $data = $this->mapPageArguments('PROFILE', true, 'assets/images/graph_banner_1.jpg', $args);
        $this->generatePage($page_path, $data);
    }

    public function register(){

        $page_path = "register.php";
        $data = $this->mapPageArguments('CREATE ACCOUNT');
        $this->generatePage($page_path, $data, '','');
    }

    public function signOut(){
        $this->session->destroy('is_login');

        return redirect()->to("/");
    }
}
