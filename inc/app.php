<?php

require_once('core/database.php');

$db_server = "localhost";
$db_user = "root";
$db_user_pass = "root";
$db_name = "coffee_recipes";



if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


$connection = db_connect($db_server, $db_user, $db_user_pass, $db_name);
// Function to authenticate user
function signin($username, $password)
{
    global $connection; // Access $connection variable defined outside the function
    $checkUsername = array(
        "column" => "username",
        "operator" => "=",
        "value" => $username
    );
    $checkPassword = array(
        "column" => "password",
        "operator" => "=",
        "value" => $password
    );
    $where = array();
    $where[] = $checkPassword;
    $where[] = $checkUsername;
    $user = db_select( $connection,"users", "*", $where);
        // Check if user exists and password matches
        if (!empty($user)) {
            // Start a session and store the user ID
            session_start();
            $_SESSION['username'] = $user['username'];
            $_SESSION['current_user'] = $user['id'];
            $_SESSION['isSignedIn'] = true;
            return true; // Authentication successful
        }
    

    return false; // Authentication failed
}
function signup($username, $password)
{
    global $connection;
    
    // Check if the username already exists
    $existingUser = db_select($connection, "users", "*", array("column" => "username", "operator" => "=", "value" => $username));
    
    if (!empty($existingUser)) {
        return false; // Username already exists, return false
    }
    
    $data = array(
        "username" => $username,
        "password" => $password
    );
    
    $user = db_insert($connection, "users", $data);
    
    if ($user) {
        return true; // Signup successful
    }
    
    return false; // Signup failed
}


// Function to check if user is logged in
function isUserSignedIn()
{
    return isset($_SESSION['isSignedIn']);
}

// Function to log out user
function signout()
{
    // Starting a session
    // session_start();
    session_unset();
    session_destroy();
}


function add_recipe($recipe_name, $category_id,$flavor,$brewing_method,$instructions,$pic){
    global $connection;
    
    $data = array(
        "recipe_name" => $recipe_name,
        "instructions" => $instructions,
        "flavor" => $flavor,
        "brewing_method" => $brewing_method,
        "category_id" => $category_id,
        "pic" => $pic,
        "user_id" => $_SESSION['current_user'],


    );
    
    $recipe = db_insert($connection, "recipes", $data);
    
    if ($recipe) {
        return true; 
    }
    
    return false; 
}
// // Redirect to index.php
// header("Location: index.php");
// exit;