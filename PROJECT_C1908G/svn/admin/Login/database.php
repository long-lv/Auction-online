<?php
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "project1");

function db_connect() {
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    return $connection;
}

$db = db_connect();
function dedirec_to($location){
    header("location:".$location);
    exit;
}
function db_disconnect($connection) { 
    if(isset($connection)) {
      mysqli_close($connection);
    }
}

function confirm_query_result($result){
    global $db;
    if (!$result){
        echo mysqli_error($db);
        db_disconnect($db);
        exit; 
    } else {
        return $result;
    }
}

function insert_Admin($Admin) {
    global $db;
    $name=mysqli_real_escape_string($db,$Admin['Name']);
    $pass=mysqli_real_escape_string($db,$Admin['Password']);
    $email=mysqli_real_escape_string($db,$Admin['Email']);
    $hashPassword=password_hash($pass,PASSWORD_DEFAULT);
    $sql = "INSERT INTO admin ";
    $sql .= "(Name,Password,Email) ";
    $sql .= "VALUES (";
    $sql .= "'" .$name. "',";
    $sql .= "'" . $hashPassword . "',";
    $sql .= "'" . $email . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}

function find_all_Admins(){
    global $db;
    $sql = "SELECT * FROM admin ";
    $sql .= "ORDER BY Name";
    $result = mysqli_query($db, $sql); 
    return confirm_query_result($result);
}

function find_Admin_by_id($id) {
    global $db;
    $sql = "SELECT * FROM admin ";
    $sql .= "WHERE id='" . $id . "'";
    $result = mysqli_query($db, $sql);
    confirm_query_result($result);
    $Admin = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $Admin; 
}

function update_Admin($Admin) {
    global $db;
    $name=mysqli_real_escape_string($db,$Admin['Name']);
    $pass=mysqli_real_escape_string($db,$Admin['Password']);
    $email=mysqli_real_escape_string($db,$Admin['Email']);
    $hashPassword=password_hash($pass,PASSWORD_DEFAULT); ;
    $sql = "UPDATE admin SET ";
    $sql .= "name='" . $name . "', ";
    $sql .= "password='" . $hashPassword . "', ";
    $sql .= "email='" . $email. "' ";
    $sql .= "WHERE id='" . $Admin['id'] . "' ";
    $result = mysqli_query($db, $sql);
    return confirm_query_result($result);
}

function delete_Admin($id) {
    global $db;

    $sql = "DELETE FROM Admin ";
    $sql .= "WHERE id='" . $id . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);

    return confirm_query_result($result);
}
session_start();
?>