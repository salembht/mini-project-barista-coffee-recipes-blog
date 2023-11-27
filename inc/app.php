<?php

require_once('core/database.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}



// Function to authenticate user
function signin($username, $password)
{
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
    $user = db_select( "users", "*", $where);
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

// // Redirect to index.php
// header("Location: index.php");
// exit;