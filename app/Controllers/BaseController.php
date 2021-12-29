<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

// services
use CodeIgniter\I18n\Time;
use CodeIgniter\API\ResponseTrait;

// model
// TODO: IMPORT MODELS: use \App\Models\model;
use \App\Models\Users;
use \App\Models\Employment;
use \App\Models\Establishment;
use \App\Models\Barangay;
/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
class BaseController extends Controller
{
    use ResponseTrait;
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;
    
    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['url','filesystem'];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // init models
        $this->userModel = new Users();
        $this->establishmentModel = new Establishment();
        $this->employmentModel = new Employment();
        $this->barangayModel = new Barangay();

		// preload services
		$this->session = \Config\Services::session();
		$this->uri = service('uri');
		$this->time = new Time();
		$this->queryBuilder	= \Config\Database::connect();
    }

    // Generate page
    public function generatePage(string $filename, 
    array $default_data = [],
    string $header_path = "layout/header.php", 
    string $footer_path = "layout/footer.php",
    ){
        if($header_path){echo view($header_path, $default_data);}        
        echo view("pages/".$filename, $default_data);
        if($footer_path){echo view($footer_path, $default_data);}   
    }

    public function mapPageArguments(string $title, bool $is_image = false, string $banner_path = '',  array $others = []){
        
        return (empty($others))? [
            'page_title' => $title,
            'base_url' => base_url(),
            'is_image' => $is_image,
            'banner_path' => base_url()."/".$banner_path,
            'is_login' => $this->session->has("is_login"),
        ]: array_merge([
            'page_title' => $title,
            'base_url' => base_url(),
            'is_image' => $is_image,
            'banner_path' => base_url()."/".$banner_path,
            'is_login' => $this->session->has("is_login"),
        ], $others);
    }
}
