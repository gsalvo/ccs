<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ExerciseB extends MY_Controller {
	

	public function index(){		
		$data['flashMessage'] = $this->session->flashdata('flashMessage');		
		$this->form_validation->set_rules('period', 'periodo', 'required');		
		$this->form_validation->set_rules('value', 'tipo de valor', 'required');
		$this->form_validation->set_rules('start-date', 'fecha inicio', 'required|is_date');
		$this->form_validation->set_rules('end-date', 'fecha término', 'required|is_date|date_is_greater_or_equal_than['.$this->input->post('start-date').']');
		var_dump($this->input->post());
		if(!$this->input->post('type')){						
			$this->form_validation->set_rules('type[]', 'índice', 'callback_check_index');
		}		
		if($this->form_validation->run() === FALSE){
			$this->data = $data;	
			$this->render('exercise_b_view');					
		}else{
			/*$auxStartDate = explode("-", $this->input->post('start-date'));
			$auxStartDate = $auxStartDate[2].'-'.$auxStartDate[1].'-'.$auxStartDate[0];
			$auxEndDate = explode("-", $this->input->post('end-date'));
			$auxEndDate = $auxEndDate[2].'-'.$auxEndDate[1].'-'.$auxEndDate[0];			
			
			$param = array('indice'=> strtoupper ($this->input->post('type')),
						 	'periodo'=> $this->input->post('period'),
						 	'f_desde'=> $auxStartDate,
						 	'f_hasta'=> $auxEndDate);			
			
			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => "http://bcstest.mybluemix.net/bcstest/rest/indices/consultaIndices?". http_build_query($param),
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "GET",						
			));
			$response = curl_exec($curl);
			$err = curl_error($curl);
			curl_close($curl);
			if ($err) {
				$this->session->set_flashdata('flashMessage', 'true');
				redirect('exercisea');
			} else {
				$auxResult = json_decode($response, TRUE);
				if($auxResult['code'] == 0 && $auxResult['message'] == 'OK'){
					$result = array();
					foreach ($auxResult['indicesItem'] as $key => $value) {
						array_push($result, array_values($auxResult['indicesItem'][$key]));
					}
					$data['result'] = $result;										
				} else{
					$this->session->set_flashdata('flashMessage', 'true');
					redirect('exercisea');
				}							
							
			}	
			$this->data = $data;			
			$this->render('exercise_a_view');*/
		}
		
	}
}
