<?php

class myGuzzle{
	protected $controllerLocation = 'localhost:8080/'; //server name
	
	public function __construct($controllerLocation){
		$this->controllerLocation .= $controllerLocation;
	}
	
	public function getControllerLocation(){
		return $this->controllerLocation;
	}

	public function formParams($dataToPass, $request){
		// return $dataToPass;
		// return $request;
		// return $this->controllerLocation;
		$client = new GuzzleHttp\Client();

		$response = $client->request($request, $this->controllerLocation, array(
			'form_params' => $dataToPass
		));

		$return = $response->getBody();
		$return = json_decode($return, true);
		return $return;
	}

	protected function changeData($data, $multiPart){
		foreach ($data as $key => $value) {
			$multiPart[] = [
				'name' => $key,
				'contents' => (string)$value
			];
		}
		return $multiPart;
	}

	protected function changeDataFiles($data, $multiPart){
		$i = 0;
		foreach ($data as $key => $value) {
			$multiPart[] = [
				'name' => $key,
				'contents' => fopen($value->getRealPath(), 'r')
			];
			$multiPart[] = [
				'name' => 'extension' . $i,
				'contents' => $value->getClientOriginalExtension()
			];
			$multiPart[] = [
				'name' => 'filesize' . $i,
				'contents' => (string)$value->getSize()
			];
			$i++;
		}
		return $multiPart;
	}


	public function multiPart($dataToPass, $request){
		// print_r($dataToPass);
		// echo "<br>" . $request;
		$id = $dataToPass[0]['id'];
		$multiPart = array();
		$multiPart = $this->changeData($dataToPass[1]['namesANDcontents'], $multiPart);
		$multiPart = $this->changeDataFiles($dataToPass[2]['namesANDcontentsFiles'], $multiPart);
		// print_r($multiPart);
		
		$client = new GuzzleHttp\Client();
		$response = $client->request($request, $this->controllerLocation, array(
			'multipart' => $multiPart
		));

		$return = $response->getBody();
		$return = json_decode($return, true);

		return $return;
	}
}
