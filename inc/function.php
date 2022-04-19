<?php

function get_books()
{
    include("inc/connect.php");
    //fetch from database
    $sql = "SELECT * from books b inner join users u on b.uploader_id=u.id";
    $result = $con->query($sql);
    return $result;
}


function unique_file_name($ext) {
	$file_name = date("Y-m-d") . '-' . uniqid() . '.' . $ext;
    return $file_name;
}