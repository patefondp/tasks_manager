<?php
require_once('template/header.php');
if (isset($_GET['id']) AND $_GET['id'] !=''){
    $data = deleteTasks($conn,$_GET['id']);
    }
    else echo 'id не передан!';
?>
<div class="container">
    <div class="ro">
        <div class="col-lg-12">
            <?php
                if ($data === true) {
                    echo 'Задача удалена';
                }
                else {
                    echo 'Ошибка!'.$data;
                }
            ?>
        </div>
    </div>
</div>
<?php
close($conn);
setcookie('bd_create_success', 1, time()+10);
header('Location: /admin.php');
?>
