<?php

class mCategories
{
    public function showCategories($sql)
    {
        $db = new Database;
        $conn = $db->connect();
        if ($conn == null) return 0;

        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0)
            return 1;
        return 0;
    }
}
