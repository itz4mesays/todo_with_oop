<?php 

require __DIR__.'/../../classes/member.php';
// require __DIR__.'/../../config/utils.php';

session_start(); 

$utils = new Utils();

$session = isset($_SESSION['errors']) ? $_SESSION['errors'] : null;
$formData = isset($_SESSION['formData']) ? $_SESSION['formData'] : null;

$success_msg = isset($_SESSION['success_msg']) ? $_SESSION['success_msg'] : null;

?>

<div class="col-sm-12">

    <div class="error-message">
        <?php if(isset($session)) :?>
                <div class="alert alert-danger" role="alert">
                <ul>
                    <?php foreach($session as $k => $value) :?>
                        <li><?php echo $value ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif ?>
    </div>

    <?php if($success_msg) :?>
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Success</strong> Your account has been registered. You can login now.
            </div>
        <?php endif ?>

    <h2>Login</h2>

    <form action="action/login.php" method="post" id="saveTodo">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo isset($formData) ? $formData['username']: null ?>">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>


        <button type="submit" class="btn btn-success">Login</button>
    </form>
</div>