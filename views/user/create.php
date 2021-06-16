<?php 

require __DIR__.'/../../classes/member.php';
// require __DIR__.'/../../config/utils.php';

session_start(); 

$utils = new Utils();
// $member = new Member();

$arrayRem = ['formData','success_msg'];
if(isset($_SESSION)){
  $utils->destroySession($_SESSION, $arrayRem);
}

$session = isset($_SESSION['errors']) ? $_SESSION['errors'] : null;
$formData = isset($_SESSION['formData']) ? $_SESSION['formData'] : null;

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

    <h2>New User</h2>

    <form action="action/register.php" method="post" id="saveTodo">
        <div class="form-group">
            <label for="firstname">Firstname</label>
            <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo isset($formData) ? $formData['firstname']: null ?>">
        </div>

        <div class="form-group">
            <label for="lastname">Lastname</label>
            <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo isset($formData) ? $formData['lastname']: null ?>">
        </div>

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo isset($formData) ? $formData['username']: null ?>">
        </div>

        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($formData) ? $formData['email']: null ?>">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>


        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div>