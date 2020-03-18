<?php
require_once 'core/config.php';
require_once 'core/function.php';
$conn = connect();
$cat = getAllCatInfo($conn);


?>

<?php


if (isset($_POST['task']) AND $_POST['task'] !='') {
    $task = $_POST['task'];
    $descrMin = $_POST['descr_min'];
    $datetime = $_POST['datetime'];
    $priority = $_POST['priority'];
    $status = $_POST['status'];

 
    $conn = connect();

    if ($_POST['task']!='') {
       
        $sql = "UPDATE tasks set task = '".$task."', descr_min = '".$descrMin."', `datetime` = '".$datetime."', priority = '".$priority."', `status` = '".$status."' WHERE id=".$_GET['id'];
    }
    else {
       echo "Ошибка обновления записи";
    }

    if (mysqli_query($conn, $sql)) {
        $sql = "DELETE FROM tags WHERE task_id=".$_GET['id'];
        mysqli_query($conn, $sql);

        for ($i = 0; $i < count($newTags); $i++){
            $sql = "INSERT INTO tags (tag, task_id) VALUES ('".$newTags[$i]."', ".$_GET['id'].")";
            mysqli_query($conn, $sql);
        }
        // var_dump($lastId); 
        setcookie('bd_create_success', 1, time()+10);
        header('Location: /admin.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    close($conn);
}

?>
<?php
    $sql = 'SELECT * FROM tasks WHERE id='.$_GET['id'];
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
?>
<?php

require_once('template/header_admin.php');
?>
<div class="container">
    <div class="row">
    <div class="col-lg-12">
    <h2>Обновить задачу id=<?php echo $_GET['id']; ?></h2>
    <form action="" method="POST"  enctype="multipart/form-data">
        <div class="form-group">
            <label for="task">Задание:</label>
            <input type="text" name="task" class="form-control" id="title" value="<?php echo $row['task'];?>">
        </div>
        <div class="form-group">
            <label for="descr-min">Описание:</label>
            <input type="text" name="descr_min" class="form-control" id="descr_min" value="<?php echo $row['descr_min'];?>">
        </div>
        <div class="form-group">
            <label for="descr-min">Дата-Время:</label>
            <input type="datetime-local" name="datetime" class="form-control" id="datetime" value="<?php echo $row['datetime'];?>">
        </div>

        <div class="input-group mb-3">
        <div class="input-group-prepend">
            <label class="input-group-text" for="inputGroupSelect01">Приоритет</label>
        </div>
        <select class="custom-select" id="inputGroupSelect01" name="priority" value="<?php echo $row['priority'];?>">
            <option selected>Выбор...</option>
            <option name="Первостепенное">Первостепенное</option>
            <option name="Важное">Важное</option>
            <option name="Необходимое">Необходимое</option>
        </select>
        </div>

        <div class="input-group mb-3">
        <div class="input-group-prepend">
            <label class="input-group-text" for="inputGroupSelect01">Статус</label>
        </div>
        <select class="custom-select" id="inputGroupSelect01" name="status" value="<?php echo $row['status'];?>">
            <option selected>Выбор...</option>
            <option name="Выполненно">Выполненно</option>
            <option name="Отмененно">Отмененно</option>
            <option name="Выполняется">Выполняется</option>
        </select>
        </div>


        <div class="form-group text-right">
            <input type="submit" value="обновить запись" class="btn btn-success">
        </div>
    </form>
        </div>
    </div>
</div>

<?php 
    require_once('template/footer.php');
?>