<?php
//funkcije za SQL
function select_query($sql){
    global $connection;
    $data = [];
    $result = $connection->query($sql);

    if ($result->num_rows > 0)
        while($row = $result->fetch_assoc())
            array_push($data, $row);

    return $data;
}
function insert_update_query($sql){
    global $connection;
    return $connection->query($sql) === TRUE ? true : false;
}
function return_num_rows($sql){
    global $connection;
    $result = $connection->query($sql);
    return $result->num_rows;
}     


// Zanrovi
function select_zanrovi($where = null){
    $sql = "SELECT * FROM zanrovi";

    if($where) //ukoliko se trazi neki uslov
        $sql .= " WHERE {$where}";

    return select_query($sql);
}


?>