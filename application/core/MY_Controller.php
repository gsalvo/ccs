<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class MY_Controller extends CI_Controller {
	protected $data = array();
	
	function __construct() {
		parent::__construct();
	}

	protected function render($view = NULL, $template = 'master'){
		if($template == 'json' || $this->input->is_ajax_request()){
			header('Content-Type: application/json');
			echo json_encode($this->data);
		}else {			
			$this->data['content'] = (is_null($view)) ? '' : $this->load->view($view , $this->data, TRUE);
			$this->data['flashMessage'] = $this->load->view('templates/flash_message', $this->data, TRUE);
			$this->load->view('templates/'.$template.'_view', $this->data);
		}
	}
}