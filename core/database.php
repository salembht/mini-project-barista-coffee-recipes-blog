<?php

$connection = db_connect('localhost', 'root', '', 'coffee_recipes');

function db_connect($db_server, $db_user, $db_user_pass, $db_name){

    $conn = mysqli_connect($db_server, $db_user, $db_user_pass, $db_name);

    if (!$conn) {
        return array("status" => "error", "code" => 401, "message" => mysqli_connect_error());
    }

    return $conn;
}

function db_close($conn){

    try{
        mysqli_close($conn);
    } catch(Exception $e){
        return array("status" => "error", "code" => 402, "message" => $e->getMessage());
    }
}

function db_execute_query($connection, $sql){
    try {
        $result = mysqli_query($connection, $sql);
        if (!$result) {
            throw new Exception(mysqli_error($connection));
        }
    } catch (Exception $e) {
        return array("status" => "error", "code" => 403, "message" => $e->getMessage());
    }
    
    return $result;
}

function db_select($table, $columns = "*", $where = "") {


    if (is_array($columns)) {
        $columns = implode(", ", $columns);
    }

    $sql = "SELECT $columns FROM $table";

    if (is_array($where) && !empty($where)) {
        $whereClause = _buildWhereClause($where);
        $sql .= " WHERE $whereClause";
    }
    else if (!empty($where)) {
        $sql .= " WHERE $where";
    }


    try{
        $result = db_execute_query($sql);
    }catch(Exception $e){
        return array("status" => "error", "code" => 404, "message" => $e->getMessage());
    }

    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function db_insert($connection,$table, $data){

    $columns = implode(", ", array_keys($data));
    $values = "'" . implode("', '", array_values($data)) . "'";

    $sql = "INSERT INTO $table ($columns) VALUES ($values)";

    db_execute_query($connection,$sql);

    $result = mysqli_insert_id($connection);
    if(!$result){
        return array("status" => "error", "code" => 405, "message" => mysqli_error($connection));
    }
    return $result;
}

function db_update($table, $data, $where) {

    $set = "";

    foreach ($data as $column => $value) {
        $set .= "$column = '$value', ";
    }

    $set = rtrim($set, ", ");

    $sql = "UPDATE $table SET $set";
    if (is_array($where) && !empty($where)) {
        $whereClause = _buildWhereClause($where);
        $sql .= " WHERE $whereClause";
    }
    else if (!empty($where)) {
        $sql .= " WHERE $where";
    }

    try{
        $result = db_execute_query($connection,  $sql);
        return $result;
    }catch(Exception $e){
        return array("status" => "error", "code" => 406, "message" => $e->getMessage());
    }
}

function db_delete( $table, $where){

    $sql = "DELETE FROM $table";
    if (is_array($where) && !empty($where)) {
        $whereClause = _buildWhereClause($where);
        $sql .= " WHERE $whereClause";
    }
    else if (!empty($where)) {
        $sql .= " WHERE $where";
    }
    $result = db_execute_query($sql);

    if(!$result){
        return array("status" => "error", "code" => 407, "message" => mysqli_error($connection));
    }

    return $result;
}

function _escapeValue($connection, $value) {
    return mysqli_real_escape_string($connection, $value);
}

// function _buildWhereClause($connection, $where) {

//     $conditions = [];

//     foreach ($where as $condition) {
//         $column = _escapeValue($connection, $condition['column']);
//         $operator = _escapeValue($connection, $condition['operator']);
//         $value = _escapeValue($connection, $condition['value']);
//         $conditions[] = "$column $operator '$value'";
//     }

//     $out = implode(" AND ", $conditions);
//     return $out;
// }
function _buildWhereClause($where) {
    $conditions = [];

    foreach ($where as $condition) {
        $column = _escapeValue($condition['column']);
        $operator = _escapeValue($condition['operator']);
        $value = _escapeValue($condition['value']);
        $conditions[] = "$column $operator '$value'";
    }

    $out = implode(" AND ", $conditions);
    return $out;
}