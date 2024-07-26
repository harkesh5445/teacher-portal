<?php 
include('../config.php');

if($_SERVER['REQUEST_METHOD']  == 'POST'){
  $response = $User->deletestu($_POST);
  echo json_encode($response);die;

}



