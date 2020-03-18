<?php
require_once('template/header_admin.php');

if (isset($_POST['project']) AND $_POST['project'] !='') {
    $project = $_POST['project'];
    $task = $_POST['task'];
    $descrMin = $_POST['descr_min'];
    $datetime = $_POST['datetime'];
    $priority = $_POST['priority'];
    $status = $_POST['status'];
   
    $conn = connect();
    $sql = "INSERT INTO project (project) VALUES ('".$project."')";
    if (mysqli_query($conn, $sql)) {
        $lastIdProject = mysqli_insert_id($conn);
        $sql = "INSERT INTO tasks (task, descr_min, datetime, priority, status, id_project) VALUES ('".$task."', '".$descrMin."', '".$datetime."', '".$priority."', '".$status."', '".$lastIdProject."')";
        mysqli_query($conn, $sql);
        
        setcookie('bd_create_success', 1, time()+10);
        header('Location: /admin.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    close($conn);
}   



?>
<div class="container">
    <div class="row">
    <div class="col-lg-12">
    <h2>Создание проектов</h2>
    <form action="" method="POST"  enctype="multipart/form-data">
        <div class="form-group">
            <label for="project">Проект:</label>
            <input type="text" name="project" class="form-control" id="project">
        </div>
        <div class="form-group">
            <label for="task">Задание:</label>
            <input type="text" name="task" class="form-control" id="task">
        </div>

        <div class="form-group">
            <label for="descr-min">Описание:</label>
            <input type="text" name="descr_min" class="form-control" id="descr-min">
        </div>

        <div class="form-group">
            <label for="descr-min">Datetime</label>
            <input type="datetime-local" name="datetime" class="form-control" id="datetime">
        </div>

        <div class="input-group mb-3">
        <div class="input-group-prepend">
            <label class="input-group-text" for="inputGroupSelect01">Приоритет</label>
        </div>
        <select class="custom-select" id="inputGroupSelect01" name="priority">
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
        <select class="custom-select" id="inputGroupSelect01" name="status">
            <option selected>Выбор...</option>
            <option name="Выполненно">Выполненно</option>
            <option name="Отмененно">Отмененно</option>
            <option name="Выполняется">Выполняется</option>
        </select>
        </div>

        <div class="form-group text-right">
            <input type="submit" value="Добавить задание" class="btn btn-success">
        </div>
    </form>
        </div>
    </div>
</div>

<?php 
    require_once('template/footer.php');
?>