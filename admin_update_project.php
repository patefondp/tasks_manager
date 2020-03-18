<?php
require_once 'core/config.php';
require_once 'core/function.php';
$conn = connect();
$cat = getAllCatInfo($conn);
$catProject = getAllCatProject($conn);

?>

<?php


if (isset($_POST['project']) AND $_POST['project'] !='') {
    
    $updateProject = $_POST['project'];
    $conn = connect();
       
    $sql = "UPDATE project SET project = '".$updateProject."' WHERE id=".$_GET['id'];
       
    if (mysqli_query($conn, $sql)) {
        echo " Запись успешно обновлена";
        setcookie('bd_create_success', 1, time()+10);
        header('Location: /admin.php');
    } else {
        echo "Ошибка записи в базу данных: " . mysqli_error($conn);
    }
    close($conn);
   

}

require_once('template/header_admin.php');
?>
<div class="container">
    <div class="row">
    <div class="col-lg-12">
    <h2>Обновить проект id=<?php echo $_GET['id']; ?></h2>
    <form action="" method="POST"  enctype="multipart/form-data">
      
        <div class="form-group">
            <label for="project">Проект:</label>
            <input type="text" name="project" class="form-control" id="project">
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