<?php

function get_books()
{
    include("inc/connect.php");
    //fetch from database
    $sql = "SELECT * from books b inner join users u on b.uploader_id=u.id";
    $result = $con->query($sql);
    return $result;
}


function unique_file_name($ext)
{
    $file_name = date("Y-m-d") . '-' . uniqid() . '.' . $ext;
    return $file_name;
}

function search_advance($keyword)
{
    include('connect.php');
    $keyword = trim($keyword);

    $pro_kw = "";
    $keys = explode('"', $keyword);
    if (count($keys) > 1) {
        for ($i = 0; $i < count($keys) - 1; $i++) {
            $key = trim($keys[$i]);
            if (!empty($key)) {
                if ($i == count($keys) - 2) {
                    if (empty(end($keys))) {
                        $pro_kw = $pro_kw . "$key";
                    } else {
                        $pro_kw = $pro_kw . "$key%' or book_name like '%" . trim(end($keys));
                    }
                } else {
                    $pro_kw = $pro_kw . "$key%' or book_name like '%";
                }
            }
        }
    } else {
        $pro_kw = $pro_kw = $pro_kw . "$keyword";
    }

    $pro_kw = str_replace('"', "", $pro_kw);
    $query = "select * from books b inner join users u on b.uploader_id=u.id where book_name like '%$pro_kw%'";

    $result = $con->query($query) or die("Query failed: " . $conn->error);

    if ($result->num_rows > 0) {
        while ($book = $result->fetch_assoc()) {
            echo <<<_RES
            <div class="w-56">
            <a href="topic.php?topic_id=$book[id]">
                <img class="h-64 object-cover w-full" src="uploads/books/covers/$book[book_cover]" alt="">
                <p class="text-base text-indigo-600 mt-1">$book[book_name]</p>
                <h4 class="text-sm text-gray-500">$book[book_desc]</h4>
                <div class="flex justify-between">
                    <h5 class="text-sm text-gray-400 mt-2">Author: $book[book_author]</h5>
                    <h5 class="text-sm text-gray-400 mt-2">$book[username]</h5>
                </div>
            </a>
        </div>
_RES;
        }
    } else {
        echo "Not found";
    }
}
