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

        $page_path = "form.php";
        $data = $this->mapPageArguments('GRAPH', true, 'assets/images/graph_banner_1.jpg');
        $this->generatePage($page_path, $data);
    }

    public function about(){

        $page_path = "about.php";
        $data = $this->mapPageArguments('GRAPH', true, 'assets/images/graph_banner_1.jpg');
        $this->generatePage($page_path, $data);
    }

    public function profile(){

        $page_path = "profile.php";
        $data = $this->mapPageArguments('GRAPH', true, 'assets/images/graph_banner_1.jpg');
        $this->generatePage($page_path, $data);
    }

    public function register(){

        $page_path = "register.php";
        $data = $this->mapPageArguments('CREATE ACCOUNT');
        $this->generatePage($page_path, $data, '', '');
    }

    public function signOut(){
        $this->session->destroy('is_login');

        return redirect()->to("/");
    }
}
