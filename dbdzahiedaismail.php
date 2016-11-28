<?php
// PHP 4
//$conn = mysql_connect("localhost", "root", "");
//mysql_select_db("sitenameabc", $conn);

//PHP 5
// $conn = mysqli_connect("localhost", "root", "", "dbdzahiedaismail");

// $sql = "INSERT INTO tbldzahiedaismail (
// name, student_id, email, gender, programme, coursework, final)
// VALUES ('$_POST[name]', '$_POST[student_id]',
// '$_POST[email]', '$_POST[gender]', '$_POST[programme]', '$_POST[coursework]', '$_POST[final]', NOW())";

// //if (mysql_query($sql, $conn))
// if (mysqli_query($conn, $sql))
//         echo"Record succesfully added!";
// else
//         echo"Something went wrong!";
// ;
// //mysql_close($conn);
// mysqli_close($conn);

/***************************
Versi PHP terkini adalah 5.6.x atau 7.x.
Elak daripada menggunakan PHP version
yang rendah dari ini kerana semua versi
tersebut telahpun deprecated.
***************************/

// Tetapkan constant DB
define('HOST', 'localhost');
define('DB_NAME', 'assignment');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');

// Tetapkan variable resource untuk connection ke DB
$db_connection = new mysqli( HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Lakukan semakkan connection ke DB
if ( $db_connection->connect_error )
{
    die('Connection ke DB gagal ' . $db_connection->connect_error);
}