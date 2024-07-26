<?php 
include('../config.php');

if($_SERVER['REQUEST_METHOD']  == 'POST'){
  $response = $User->Login($_POST);
  echo json_encode($response);die;

}



