<?php

require __DIR__.'/../../classes/member.php';

$member = new Member();
$member->setId($_GET['id']);
$singleTodo = $member->view();

$utils = new Utils();

$session = isset($_SESSION['errors']) ? $_SESSION['errors'] : null;
?>

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
<h3>Edit Todo</h3>
<!-- <p>Information</p> -->

<br/>

 <div class="row-fluid">        
    <div class="col-sm-12">

    <form action="action/update_todo.php?id=<?php echo $_GET['id'] ?>" method="post" id="saveTodo">
        <div class="form-group">
            <label for="todo_title">Title</label>
            <input type="text" class="form-control" id="todo_title" name="todo_title" value="<?php echo $singleTodo->todo_title ?>">
        </div>

        <div class="form-group">
            <label for="todo_desc">Description</label>
            <textarea name="todo_desc" id="" cols="30" rows="10" class="form-control" id="todo_desc"><?php echo $singleTodo->todo_desc ?></textarea>
        </div>

        <div class="form-group">
            <label for="todo_status">Status</label>
            <select name="todo_status" id="todo_status" class="form-control">
                <option value="">Select One</option>
                <?php foreach($utils->listStatus() as $i) :?>
                    <option <?php echo $singleTodo->status == $i['id'] ? 'selected' : '' ?> value="<?php echo $i['id'] ?>"><?php echo $i['status'] ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
        
    </div>       
</div>
