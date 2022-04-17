<?php

function get_books()
{
    include("inc/connect.php");
    //fetch from database
    $sql = "SELECT * from books";
    $result = $conn->query($sql);
    return $result;
}
