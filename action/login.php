<?php
session_start();

require __DIR__.'/../classes/member.php';

$utils = new Utils();

$errors = []; //po

if(isset($_POST)){

    $username = $_POST['username'];
    $password = $_POST['password'];

  
    if(empty($username)){
        array_push($errors, 'Username field is required');
    }

    if(empty($password)){
        array_push($errors, 'Password field is required');
    }


    if(!empty($errors)){
        $_SESSION['errors'] = $errors;
        $_SESSION['formData'] = $_POST;
        header("Location: ../login.php");
        exit();
    }

    /**
     * See https://www.php.net/manual/en/filter.filters.sanitize.php for more documentation
     */
    $sanitizedUsername = filter_var($username, FILTER_SANITIZE_STRING);
    $sanitizedPassword = filter_var($password, FILTER_SANITIZE_STRING);

    $member = new Member();
    $member->username = $sanitizedUsername;;
    $member->setPassword($sanitizedPassword);
    
    if($member->login()){
        header("Location: ../index.php");
        exit();

    }else{
        header("Location: ../login.php");
        exit();
    }
}