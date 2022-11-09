<?php

$method = $_SERVER['REQUEST_METHOD'];

if ($method == "GET") {
  include 'views/indexView.php';
} else if ($method == "POST") {
  if(isset($_POST['query'])){
    require 'controllers/webServiceController.php';
    $controller = new serviceController();
    $data = $controller -> getDataWebService();
    if ($data != null) {
      echo $data;
    } else {
      echo json_encode(["success" => "false"]);
    }
  }
}
