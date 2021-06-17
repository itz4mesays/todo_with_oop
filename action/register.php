<?php
session_start();

require __DIR__.'/../classes/member.php';

$utils = new Utils();

$errors = []; //po

if(isset($_POST)){

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty($firstname)){
        array_push($errors, 'Firstname field is required');
    }

    if(empty($lastname)){
        array_push($errors, 'Lastname field is required');
    }

    if(empty($username)){
        array_push($errors, 'Username field is required');
    }

    if(strlen($username) < 7){
        array_push($errors, 'Username must not be less than 7 characters');
    }

    if(empty($email)){
        array_push($errors, 'Email Address field is required');
    }

    if(empty($password)){
        array_push($errors, 'Password field is required');
    }

    if(!empty($username) || !empty($email)){
        $user = new User();
        $user->setEmail($email);
        $user->setUsername($username);

        if($user->confirmUsernameEmail()){
            array_push($errors, 'Username or Email is already in use.');
        }

    }

    if(!empty($errors)){
        $_SESSION['errors'] = $errors;
        $_SESSION['formData'] = $_POST;
        header("Location: ../register.php");
        exit();
    }

    /**
     * See https://www.php.net/manual/en/filter.filters.sanitize.php for more documentation
     */
    $sanitizedFirstname = filter_var($firstname, FILTER_SANITIZE_STRING);//Strip tags and HTML-encode double and single quotes, optionally strip or encode special characters.
    $sanitizedLastname = filter_var($lastname, FILTER_SANITIZE_STRING);
    $sanitizedUsername = filter_var($username, FILTER_SANITIZE_STRING);
    $sanitizedEmail= filter_var($email, FILTER_SANITIZE_EMAIL);
    $sanitizedPassword = filter_var($password, FILTER_SANITIZE_STRING);

    $member = new Member();
    $member->username = $sanitizedUsername;
    $member->firstname = $sanitizedFirstname;
    $member->lastname = $sanitizedLastname;
    $member->email = $sanitizedEmail;
    $member->setPassword($sanitizedPassword);
    
    if($member->createUser() == true){
        $_SESSION['success_msg'] = true;
        header("Location: ../login.php");
        exit();

    }else{
        $_SESSION['errors'] = ['Unable to create this todo at the moment.'];
        header("Location: ../register.php");
        exit();
    }
}