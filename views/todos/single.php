<?php

require __DIR__.'/../../classes/member.php';

$member = new Member();
$member->setId($_GET['id']);
$singleTodo = $member->view();

?>

<h2>Todo Details</h2>

<br/>

 <div class="row-fluid">        
    <div class="col-sm-12">

        <table class="table table-hover table-responsive">
            <tr>
                <th>Title:</th>
                <td><?php echo $singleTodo->todo_title ?></td>
            </tr>
            <tr>
                <th>Description:</th>
                <td><?php echo $singleTodo->todo_desc ?></td>
            </tr>
            <tr>
                <th>Status:</th>
                <td>
                    <?php if($singleTodo->status == 1): ?>
                        <span class="label label-danger">Pending</span>
                    <?php elseif($singleTodo->status == 2) :?>
                        <span class="label label-warning">In Progress</span>
                    <?php elseif($singleTodo->status == 3) :?>
                        <span class="label label-success">Completed</span>
                    <?php else :?>
                        <span class="label label-danger">Canceled</span>
                    <?php endif ?>
                </td>
            </tr>
            <tr>
                <th>Date Created:</th>
                <td><?php echo date('F d, Y', strtotime($singleTodo->created_at)) ?></td>
            </tr>
        </table>
        <hr/>
        
    </div>       
</div>
