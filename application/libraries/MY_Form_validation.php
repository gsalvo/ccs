<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {
	

	public function __construct() {
		parent::__construct();		
		$this->_CI =& get_instance();
       
        if (file_exists(APPPATH . 'config/form_validation.php')){
	        $this->_CI->config->load('form_validation');
	    }
        $this->_error_prefix = (config_item('error_prefix') ? config_item('error_prefix') : '<p>');
        $this->_error_suffix = (config_item('error_suffix') ? config_item('error_suffix') : '</p>');
	}


	public function is_date($str) {
		if (preg_match("/([0-9]{2})\-([0-9]{2})\-([0-9]{4})/", $str)){
			$aux = explode("-", $str);
			return (checkdate($aux[1], $aux[0], $aux[2]));
		}else{
			return FALSE;
		}
	}

	public function check_index($str){
		if(!$str){
			return FALSE;
		}else{
			return TRUE;
		}
	}

	public function date_is_greater_or_equal_than($str, $date){		
		if (preg_match("/([0-9]{2})\-([0-9]{2})\-([0-9]{4})/", $str) && (preg_match("/([0-9]{2})\-([0-9]{2})\-([0-9]{4})/", $date))){
			$date1 = explode("-", $str);
			$date2 = explode("-", $date);			
			if (checkdate($date1[1], $date1[0], $date1[2]) && checkdate($date2[1], $date2[0], $date2[2])){
				return(strtotime($date1[1].'/'.$date1[0].'/'.$date1[2]) >= strtotime($date2[1].'/'.$date2[0].'/'.$date2[2]));
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}

	


	
}