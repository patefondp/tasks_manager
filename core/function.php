<?php

function connect(){
    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DBNAME);
    mysqli_set_charset($conn, "utf8");
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}

function select($conn){
    $sql = "SELECT * FROM tasks";
    $result = mysqli_query($conn, $sql);
    
    $a = array();
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $a[] = $row;
        }
    } 
    return $a;
}

function selectProject($conn){
    $sql = "SELECT * FROM project";
    $result = mysqli_query($conn, $sql);
    
    $a = array();
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $a[] = $row;
        }
    } 
    return $a;
}


function selectArticle($conn){
    $sql = "SELECT * FROM tasks WHERE id=".$_GET['id'];
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row;
    } 
    return false;
}


function getAllCatInfo($conn){
    $sql = "SELECT * FROM tasks";
    $result = mysqli_query($conn, $sql);
    
    $a = array();
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $a[] = $row;
        }
    } 
    return $a;
}
function getAllCatProject($conn){
    $sql = "SELECT * FROM project LEFT JOIN tasks ON project.id = tasks.id_project";
    $result = mysqli_query($conn, $sql);
    
    $a = array();
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $a[] = $row;
        }
    } 
    return $a;
}

function deleteTasks($conn,$id){
    $sql = "DELETE FROM tasks WHERE id=".$id;
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return "Error deleting record: " . mysqli_error($conn);
    }
}

function deleteProject($conn,$id){
    $sql = "DELETE FROM project WHERE id=".$id;
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return "Error deleting record: " . mysqli_error($conn);
    }
}

function close($conn){
    mysqli_close($conn);
}