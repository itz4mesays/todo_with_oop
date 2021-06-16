<?php
session_start();

require __DIR__.'/../classes/todo.php';

$utils = new Utils();

$errors = []; //po

if(isset($_POST)){

    $title = $_POST['todo_title'];
    $desc = $_POST['todo_desc'];
    $status = $_POST['todo_status'];

    if(empty($title)){
        array_push($errors, 'Todo Title field is required');
    }

    if(empty($desc)){
        array_push($errors, 'Description field is required');
    }

    if(empty($status)){
        array_push($errors, 'Status field is required');
    }

    if(!empty($errors)){
        $_SESSION['errors'] = $errors;
        $_SESSION['formData'] = $_POST;
        header("Location: ../create_todo.php");
        exit();
    }

    /**
     * See https://www.php.net/manual/en/filter.filters.sanitize.php for more documentation
     */
    $sanitizedTitle = filter_var($title, FILTER_SANITIZE_STRING);//Strip tags and HTML-encode double and single quotes, optionally strip or encode special characters.
    $sanitizedDesc= filter_var($desc, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $sanitizedStatus = filter_var($status, FILTER_SANITIZE_NUMBER_INT);

    $todo = new Todo();
    $todo->todo_desc = $sanitizedDesc;
    $todo->todo_title = $sanitizedTitle;
    $todo->status = $sanitizedStatus;
    
    if($todo->insertTodo() == true){

        if(isset($_SESSION)){
            $arrayRem = ['errors'];
            $utils->destroySession($_SESSION, $arrayRem);
        }

        $_SESSION['success_msg'] = 'You have successfully added a new todo';
        header("Location: ../view_todos.php");
        exit();

    }else{

        if(isset($_SESSION)){
            $arrayRem = ['success_msg'];
            $utils->destroySession($_SESSION, $arrayRem);
        }

        $_SESSION['errors'] = 'Unable to create this todo at the moment.';
        header("Location: ../create_todo.php");
        exit();
    }
}