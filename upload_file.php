<?php

/* 
 * This is a file uploader,  it uploads a file on server and change
 * its name to an order number that began from 1. The main idea is that 
 * all uploaded files on the server will be numbered by their names.
 */

echo <<<_END
<!DOCTYPE html>
<html>
<head>
    <title>Secure uploading</title>
<head>
<body>
<form method = 'post' action = 'upload_secure.php' enctype = 'multipart/form-data'>
Загрузите файл с расширением JPEG, GIF, PNG или TIFF:
<input type = 'file' name = 'file_name' size = '10'>
<input type = 'submit' value = 'Загрузить на сервер'>
</form>
_END;

if($_FILES)
{    
    switch ($_FILES['file_name']['type'])
    {
        case 'image/jpeg': $extension = 'jpg';  break;
        case 'image/gif' : $extension = 'gif';  break;
        case 'image/png' : $extension = 'png';  break;
        case 'image/tiff': $extension = 'tiff'; break;
        default :          $extension = '';     break;
    }
    
    if ($extension)
    {
        /*Giving the name of uploaded file (from 1 to ...)*/
        $give_name = 1; 

        /*loop that check of exsistance of the file, if TRUE name changing on 1 one more*/
        while(file_exists(sprintf("%02s", $give_name).".".$extension))
        {
            ++$give_name;
        }

        $final_name = sprintf("%02s", $give_name).".".$extension;  //we got final name of file
        move_uploaded_file($_FILES['file_name']['tmp_name'], $final_name);
        $file_size = $_FILES['file_name']['size'];
        echo "Загруженное изображение '$final_name' и его размер: $file_size bytes"
            ."<br><img src = '$final_name'></body></html>";        
    }   else {
        echo "Загрузка не удалась. Неверный формат изображения.";
        echo "</body></html>";
    }
}

