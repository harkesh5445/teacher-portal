<?php 
include('../config.php');

if($_SERVER['REQUEST_METHOD']  == 'POST'){
  $response = $User->editstu($_POST);
  echo json_encode($response);die;

}



