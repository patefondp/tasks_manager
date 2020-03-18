<?php
require_once 'core/config.php';
require_once 'core/function.php';
$conn = connect();
$data = select($conn);
$dataProject = selectProject($conn);
// print_r($dataProject);
require_once 'template/check_login.php';
$flash='';
if (isset($_COOKIE['bd_create_success']) AND $_COOKIE['bd_create_success']!=''){
    if ($_COOKIE['bd_create_success'] == 1) {
        setcookie('bd_create_success', 1, time()-10);
        $flash =  "Новая запись успешно добалена";
    }
}
?>
<?php
require_once 'template/header_html.php';
?>