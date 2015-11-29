<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()

	{
			$url="http://www.eporner.com/api_xml/hd/15";

		    $this->load->library('MovieLoader');
		    $mL=new movieLoader();
		    $db=null;
			try{
				$db=$mL->readDatabase($url);
			   }
		catch(Exception $e)
				{
					log_message("erorr","read ULR==> ".$url." <==error");
				}
            //var_dump($db[0]->imgthumb);
		$data = array(

			'db'=>$db
	);

		$this->load->view('main_page',$data);


	}
	public function _404(){

		  // $this->load->view("errors/html/my_error_404.php");
		    show_404();
		   // log_message("error","404 Error");
	}


}
