<?php
class Database
{
    function connect()
    {
        $conn = new mysqli("localhost", "root", "", "domdomv1");

        if ($conn->connect_error)
            echo "Kết nối database thất bại!";
        else return $conn;
    }
}
