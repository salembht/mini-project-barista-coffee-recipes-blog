<?php

// Define a constant
define('ROOT_PATH', '/barista-coffee-recipes-blog');

require_once('inc/app.php');


// Get the file name from the URL
$pageName = $_SERVER['REQUEST_URI'];
// echo "<h1>".$pageName ."</h1>";

$pageName = str_replace(ROOT_PATH,"",$pageName);
// echo "<h1>".$pageName ."</h1>";
if($pageName == "/"){
    $pageName = "/home";
}


if($pageName == "/signin"){
    if(isUserSignedIn()){
        // Redirect to /
        header("Location: ".ROOT_PATH);
        exit;
    }else if(isset($_POST['username']) &&(isset($_POST['password']))){
        if(signin($_POST['username'], $_POST['password'])){
            // Redirect to /
            header("Location: ".ROOT_PATH);
            exit;
        }else{
            header("Location: ".ROOT_PATH."/signin");
            exit;
        }
    }
    
}else if($pageName == "/signout"){
    signout();
    // Redirect to /
    header("Location: ".ROOT_PATH);
    exit;
}


// Construct the file path
$filePath = 'pages' . $pageName . '.php';


// Check if the file exists
if (file_exists($filePath)) {
    require_once('layout/header.php');
    // Include or require the file
    require_once($filePath);
    require_once('layout/footer.php');
} else {
    require_once('layout/header.php');
    // File not found, handle the error
    require_once('pages/notfound.php');
    
    require_once('layout/footer.php');
}