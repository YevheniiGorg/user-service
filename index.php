<?php
// Composer
require_once 'vendor/autoload.php';

use Test\request\Request;

if(isset($_POST)){
    $request = new Request;
    $request->processingRequests();
}