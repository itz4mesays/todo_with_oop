<div class="masthead">
    <h3 class="muted">TODO APP</h3>
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container">
                <ul class="nav">
                <li class="active"><a href="index.php">Home</a></li>
                <li><a href="about.php">About TODO</a></li>
                <?php if(isset($_SESSION['loggedIn'])) :?>
                    <li><a href="create_todo.php">Add ToDO</a></li>
                    <li><a href="view_todos.php">List ToDo</a></li>
                    <li><a href="logout.php">Logout</a></li>
                <?php else :?>
                    <li><a href="register.php">Register</a></li>
                     <li><a href="login.php">Login</a></li>
                <?php endif ?>
                <li><a href="contact.php">Contact</a></li>
                </ul>
            </div>
        </div>
    </div><!-- /.navbar -->
</div>
