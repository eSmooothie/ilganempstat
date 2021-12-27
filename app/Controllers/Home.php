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
}
