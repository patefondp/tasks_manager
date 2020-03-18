<?php
require_once('template/header_admin.php');

// $data = select($conn);
$dataProject = selectProject($conn);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
        <?php
            echo   $flash;
            echo '<h2>Список проектов</h2>';
            echo '<div class="mt-2 mb-2 text-right">';
            echo '<a href="/admin_create_project.php"><button class="btn btn-success">Новый проект</button></a></div>';
            
            for ($k=0; $k< count($dataProject); $k++){
                $out = "<div class='project'>";
                $out .= "<p><b>Наименование проекта:</b> {$dataProject[$k]['project']}</p>";
                
            
                    $sql = "SELECT * FROM tasks WHERE id_project=".$dataProject[$k]['id'];
                    $result = mysqli_query($conn, $sql);
                    
                    $a = array();
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            $a[] = $row;
                        }
                    } 
                    
                $data = $a;
               
                $out .= '<table  class="table table-striped">';
                $out .= "<th><a href='/admin_update_project.php?id={$dataProject[$k]['id']}'><button class='btn btn-primary'>обновить данные проекта</button><a></th>";
                $out .= "<th><a href='/admin_create.php?id={$dataProject[$k]['id']}'><button class='btn btn-success'>добавить задачу</button></a></th>";
                $out .= "<th><button class='check_delete_project btn btn-danger' data-id={$dataProject[$k]['id']}'>удалить проект</button></th>";
                $out .='<tr><th>Задача</th><th>Описание</th><th>Приоритет</th><th>Статус</th><th>Дата-Время</th></tr>';
                
                for ($i=0; $i < count($data); $i++){
                $out .="<tr><td>{$data[$i]['task']}</td><td>{$data[$i]['descr_min']}</td>";
                $out.="<td>{$data[$i]['priority']}</td><td>{$data[$i]['status']}</td><td>{$data[$i]['datetime']}</td>";
                $out .="<td><a href='/admin_update.php?id={$data[$i]['id']}'><button class='btn btn-info'>обновить задачу</button></a></td>";
                $out .="<td><button class='check-delete btn btn-dark' data='{$data[$i]['id']}'>удалить задачу</button></td></tr>";
              }
            
                
                $out .='</table>';
                $out .='</div>';
                echo $out;
            }
                
            close($conn);
           
          
            ?>
        </input>
    </div>
</div>

<!-- <script>
    window.onload= function(){
            let checkDeletePro = document.querySelectorAll('.check_delete_project');
            checkDeletePro.forEach(function(element){
                element.onclick = checkDeleteProject;
            })
            function checkDeleteProject(event){
                event.preventDefault();
                let a = confirm('Вы хотите удалить проект?');
                if (a == true) {
                    location.href = '/admin_delete_project.php?id='+this.getAttribute('data-id');
                }
                return false;
            }
        }
</script> -->
<script>
    window.onload= function(){
        let checkDelete = document.querySelectorAll('.check-delete');
        checkDelete.forEach(function(element){
            element.onclick = checkDeleteFunction;
        })
        function checkDeleteFunction(event){
            event.preventDefault();
            let a = confirm('Вы хотите удалить задание?');
            if (a == true) {
                location.href = '/admin_delete.php?id='+this.getAttribute('data');
            }
            return false;
        }
    }

    
</script>

<?php 
    require_once('template/footer.php');
?>

