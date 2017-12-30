<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ExerciseB extends MY_Controller {
	

	public function index(){		
		$data['flashMessage'] = $this->session->flashdata('flashMessage');		
		$this->form_validation->set_rules('period', 'periodo', 'required');		
		$this->form_validation->set_rules('value', 'tipo de valor', 'required');
		$this->form_validation->set_rules('start-date', 'fecha inicio', 'required|is_date');
		$this->form_validation->set_rules('end-date', 'fecha término', 'required|is_date|date_is_greater_or_equal_than['.$this->input->post('start-date').']');		
		if(!$this->input->post('type')){						
			$this->form_validation->set_rules('type[]', 'índice', 'callback_check_index');
		}		
		if($this->form_validation->run() === FALSE){
			$this->data = $data;	
			$this->render('exercise_b_view');					
		}else{
			$auxStartDate = explode("-", $this->input->post('start-date'));
			$auxStartDate = $auxStartDate[2].'-'.$auxStartDate[1].'-'.$auxStartDate[0];
			$auxEndDate = explode("-", $this->input->post('end-date'));
			$auxEndDate = $auxEndDate[2].'-'.$auxEndDate[1].'-'.$auxEndDate[0];			
			$valueType = $this->input->post('value');
			$params = array();
			foreach ($this->input->post('type') as $key => $value) {
				array_push($params, array('indice'=> strtoupper($value),
										'periodo' => $this->input->post('period'),
										'f_desde' => $auxStartDate,
										'f_hasta' => $auxEndDate));
			}
			$result = array();
			$errors = array();
			foreach ($params as $key => $value) {
				$curl = curl_init();
				curl_setopt_array($curl, array(
					CURLOPT_URL => "http://bcstest.mybluemix.net/bcstest/rest/indices/consultaIndices?". http_build_query($params[$key]),
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
				
				if($err){
					array_push($errors, $params[$key]['indice']);
				} else {
					$auxResult = json_decode($response, TRUE);					
					if($auxResult['code'] == 0 && $auxResult['message'] == 'OK'){
						$aux = array();						
						foreach ($auxResult['indicesItem'] as $keyInd => $valueInd) {
							$aux[$valueInd['fecha']] = $valueInd[$valueType];
						}
						$result[$params[$key]['indice']] = $aux;
					} else{
						array_push($errors, $params[$key]['indice']);
					}		
				}
			}

			if($errors){
				$this->session->set_flashdata('flashMessage', 'true');
				redirect('ExerciseB');
			}else{
				$auxDates = current($result);
				$data['labels'] = array_keys($auxDates);
				$data['formatLabels'] = array();
				

				foreach ($data['labels'] as $key => $value) {
					$auxDate = explode("-", $value);
					array_push($data['formatLabels'], $auxDate[2].'-'.$auxDate[1].'-'.$auxDate[0]);
				}
				$finalResult = array();
				foreach ($result as $key => $value) {
					$finalResult[$key] = array();
					foreach ($data['labels'] as $keyLabels => $valueLabels) {
						if(isset($result[$key][$valueLabels])){
							$finalResult[$key][$keyLabels] = $result[$key][$valueLabels];
						}else{
							$finalResult[$key][$keyLabels] = null;
						}
					}
				}
				$data['result'] = $finalResult;
			}			
			$this->data = $data;			
			$this->render('exercise_b_view');
		}	
		
	}
}
