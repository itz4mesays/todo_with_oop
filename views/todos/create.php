<?php 

require __DIR__.'/../../config/utils.php';

session_start(); 

$utils = new Utils();
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

    <h2>New Todo</h2>

    <form action="action/save_todo.php" method="post" id="saveTodo">
        <div class="form-group">
            <label for="todo_title">Title</label>
            <input type="text" class="form-control" id="todo_title" name="todo_title" value="<?php echo isset($formData) ? $formData['todo_title']: null ?>" required>
        </div>

        <div class="form-group">
            <label for="todo_desc">Description</label>
            <textarea name="todo_desc" id="" cols="30" rows="10" class="form-control" id="todo_desc" required><?php echo isset($formData) ? $formData['todo_desc'] : null ?></textarea>
        </div>

        <div class="form-group">
            <label for="todo_status">Status</label>
            <select name="todo_status" id="todo_status" class="form-control" required>
                <option value="">Select One</option>
                <?php foreach($utils->listStatus() as $i) :?>
                    <option value="<?php echo $i['id'] ?>"><?php echo $i['status'] ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div>