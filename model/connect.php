<?php
class Database
{
    function connect()
    {
        $conn = new mysqli("localhost", "root", "", "cosodulieu");

        if ($conn->connect_error)
            echo "Kết nối database thất bại!";
        else return $conn;
    }
}
