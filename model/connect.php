<?php
class Database
{
    function connect()
    {
        $conn = new mysqli("localhost", "root", "", "domdom", port:"3307");

        if ($conn->connect_error)
            echo "Kết nối database thất bại!";
        else return $conn;
    }
}
