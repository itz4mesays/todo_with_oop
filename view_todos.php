<?php

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Todo &middot; View Todos</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <?php require '_partials/_style.php' ;?>

  </head>

  <body>

    <div class="container">

      <?php include '_partials/_menulinks.php'; ?>

		<div class="spa">
			<?php require 'views/todos/view.php' ;?>
		</div>

	</div>


  <!-- <hr/> -->

	<?php require '_partials/_footer.php'; ?>

    <?php require '_partials/_script.php';?>

  </body>
</html>
