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
            $_SESSION['signin_error'] = "Credential not valid. Please try again.";
            // header("Location: ".ROOT_PATH."/signin?error=not_valid");
            header("Location: ".ROOT_PATH."/signin");

            exit;
        }
    }
    
}else if($pageName == "/signup"){
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (signup($username, $password)) {
            // Signup successful, redirect to /
            header("Location: " . ROOT_PATH);
            exit;
        } else {
            // Signup failed, redirect to /signup with an error message
            // header("Location: " . ROOT_PATH . "/signup?error=username_exists");
            $_SESSION['signup_error'] = "Username already exists. Please choose a different username.";
            header("Location: " . ROOT_PATH . "/signup");

            exit;
        }
    }
    
}else if($pageName == "/signout"){
    signout();
    // Redirect to /
    header("Location: ".ROOT_PATH);
    exit;
}else if($pageName == "/add_recipe"){
    //  print_r($_POST); exit;

    if (isset($_POST['recipe_name']) && isset($_POST['category_id']) && isset($_POST['brewing_method']) && isset($_POST['flavor']) && isset($_POST['instructions']) && isset($_FILES['pic'])) {
            // print_r($_SESSION); print_r($_POST); print_r($_FILES); exit;

        $recipe_name = $_POST['recipe_name'];
        $category_id = $_POST['category_id'];
        $brewing_method = $_POST['brewing_method'];
        $flavor = $_POST['flavor'];
        $instructions = $_POST['instructions'];
        $pic = "assets/images/".$_FILES['pic']['name'];
        if (add_recipe($recipe_name, $category_id,$flavor,$brewing_method,$instructions,$pic)) {
            header("Location: " . ROOT_PATH);
            exit;
        } else {
            // header("Location: " . ROOT_PATH . "/signup?error=username_exists");
            header("Location: " . ROOT_PATH . "/add_recipe");
            exit;
        }
    }
    
}else if($pageName == "/recipes"){

}else if (strpos($pageName, "/recipe_details.php") === 0 && isset($_GET['id'])) {
    $_SESSION['recipe_id'] = $_GET['id'];
    $pageName = "/recipe_details";
}

// Construct the file path

// Check if the file exists



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