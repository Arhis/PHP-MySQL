<?php
require_once 'login.php';


$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error)
{
    include_once 'error_information.php';
    Error_information::got_error($conn->connect_error);
   
}

$query = "SELECT * FROM classics";
$result = $conn->query($query);
if(!$result) {die($conn->connect_error);}
$rows = $result->num_rows;
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="style.css" />
        <title>GET SOME FROM MYSQL</title>        
    </head>
<body>  
    <h1>This table is from database 'classics'</h1>
    <table>
        <tr class="ths">
        <td><strong>Author</strong></td>
        <td><strong>Title</strong></td>
        <td><strong>Category</strong></td>
        <td><strong>Year</strong></td>
        <td><strong>ISBN</strong></td>    
    </tr>
<?php
 
for ($i = 0; $i<$rows; ++$i)
{
    $result->data_seek($i);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    
    echo "\t".'<tr>'.PHP_EOL;        
    echo "\t\t".'<td>'.$row['author'].'</td>'.PHP_EOL;
    echo "\t\t".'<td>'.$row['title'].'</td>'.PHP_EOL;
    echo "\t\t".'<td>'.$row['category'].'</td>'.PHP_EOL;
    echo "\t\t".'<td>'.$row['year'].'</td>'.PHP_EOL;
    echo "\t\t".'<td>'.$row['isbn'].'</td>'.PHP_EOL; 
    if($i == $rows - 1)
    {
        echo "\t".'</tr>'; 
    }   else {
        echo "\t".'</tr>'.PHP_EOL; 
    }    
}
$result->close();
$conn->close();
?>   
</table>
</body> 
</html>
