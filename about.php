<?php

// require 'config/connection.php';

session_start();
require __DIR__.'/isLoggedIn.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Todo &middot; About Todo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <?php require '_partials/_style.php' ;?>

  </head>

  <body>

    <div class="container">

      <?php include '_partials/_menulinks.php'; ?>

      <h2>About</h2>
    
        <p class="lead">
            I needed to go back to drawing board to learn some fundamental principles on Object Oriented Programming, so I decided to build a simple TODO with a minimal functionalities.
            PDO was used to interact with the database (MySQL).Although it is a work in progress...
        </p>

	</div>

   <hr/>

	<?php require '_partials/_footer.php'; ?>

    <?php require '_partials/_script.php';?>

  </body>
</html>
