<?php

require 'models/modelService.php';

class serviceController{

    private $sessionName;
    private $webService;

    public function __construct(){
        $this->webService = new WebService();
        $this->sessionName = $this->webService->getSessionName();
    }

    public function getDataWebService(){
        $dataWebService = $this->webService->queryGetData($this->sessionName);
        if($dataWebService!=null && $dataWebService != "" && sizeof($dataWebService) != 0 && $dataWebService['success']=="true"){
            $dataWebService = $dataWebService['result'];
            $arrayTemp = array();
            foreach($dataWebService as $element){
                $arrayTempElement = [
                    "id" => $element['id'],
                    "contact_no" => $element['contact_no'],
                    "lastname" => $element['lastname'],
                    "createdtime" => $element['createdtime']
                ];

                array_push($arrayTemp, $arrayTempElement);
            }

            if(sizeof($arrayTemp) != 0){
                return json_encode($arrayTemp);
            }
        }
        return null;
    }
}

?>