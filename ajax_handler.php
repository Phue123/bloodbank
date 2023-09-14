<?php
// ajax_handler.php

// Include the necessary files (adjust the paths based on your directory structure)
include_once __DIR__.'/controller/hospitalReqController.php';
include_once __DIR__.'/model/hospital_req.php';

// Create an instance of the controller and the model
$controller = new hospitalReqController();
$hospitalReqModel = new hospital_req();

// Get the BloodType_Id from the AJAX request
$bloodtypeId = $_GET['id'];

// Call the method in the controller to handle the AJAX request
$response = $controller->handleAjaxRequest($hospitalReqModel, $bloodtypeId);

// Send the JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
