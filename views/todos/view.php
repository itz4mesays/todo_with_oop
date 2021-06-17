<?php 

require __DIR__.'/../../classes/member.php';
$success_msg = isset($_SESSION['success_msg']) ? $_SESSION['success_msg'] : null;

$member = new Member();
$todos = $member->fetchAll();


?>

<div class="col-sm-12">

    <?php if(isset($success_msg) && !empty($success_msg)) :?>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Success!</strong> <?php echo $success_msg ?>
        </div>
    <?php endif ?>

    
    <h2>My Todos</h2>
    <p>This show your the list of all your todos.</p>

    <hr/>

    <?php if(isset($todos) && count($todos) > 0) :?>
       
        <div class="row-fluid">        
            <?php foreach($todos as $item) :?>
                <div class="col-sm-4">
                    <h2><?php echo $item['todo_title'] ?></h2>
                    <p>
                       <small>Date Created:</small> [<?php echo date('F d, Y', strtotime($item['created_at'])) ?>]
                    </p>
                    <p>
                        <a class="btn" href="single-todo.php?id=<?php echo $item['id'] ?>">View details &raquo;</a>
                        <a class="btn btn-success" href="edit-todo.php?id=<?php echo $item['id'] ?>">Edit &raquo;</a>
                    </p>

                    <hr/>
                    
                </div>

                
            <?php endforeach ?>        
        </div>
      <?php else :?>
        <p>No todo created at the moment.</p>
      <?php endif ?>

</div>