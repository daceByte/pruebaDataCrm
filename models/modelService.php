<?php

class WebService
{

    private $tokenString;

    public function __construct()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://develop.datacrm.la/anieto/anietopruebatecnica/webservice.php?operation=getchallenge&username=prueba',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $this->tokenString = curl_exec($curl);

        curl_close($curl);
        $this->tokenString = json_decode($this->tokenString, true);
        if($this->tokenString['success']=="true"){
            $this->tokenString = $this->tokenString['result']['token'];
            $this->tokenString = md5($this->tokenString . '3DlKwKDMqPsiiK0B');
        }else{
            $this->tokenString = null;
        }
    }

    public function getSessionName()
    {
        if ($this->tokenString != null) {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://develop.datacrm.la/anieto/anietopruebatecnica/webservice.php',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => 'operation=login&username=prueba&accessKey=' . $this->tokenString,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/x-www-form-urlencoded',
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            return json_decode($response, true)['result']['sessionName'];
        }
        return null;
    }

    public function queryGetData($sessionName)
    {
        if ($sessionName != null) {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://develop.datacrm.la/anieto/anietopruebatecnica/webservice.php?operation=query&sessionName=' . $sessionName . '&query=select%20*%20from%20Contacts;',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            return json_decode($response, true);
        }
        return null;
    }
}
