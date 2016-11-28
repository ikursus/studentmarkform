<?php

// Semak adakah form yang dikirimkan menggunakan request method POST
if ( ! isset( $_SERVER['REQUEST_METHOD'] ) == 'POST' )
{
    // Redirect ke form jika tidak wujud request method POST
    header('Location: ./dzahiedaismail.html');
    exit();
}

// Lakukan validasi ke atas data yang dihantar pada borang jika perlu.
// Tetapkan default null value untuk $variable error
$error = null;

// Contoh function semak semua field wajib diisi
foreach( $_POST as $key => $value )
{
    if ( $value == '' )
    {
        // Append error message
        $error .= 'Sila isi maklumat pada ' . $key . '<br>';
    }

}

// Paparkan error jika $variable $error tidak null
if ( ! is_null( $error ) )
{
    echo $error;
    exit();
}

// Selepas validasi borang dibuat, connect ke DB yang berkaitan
include ('dbdzahiedaismail.php');

// Tetapkan $variable agar mudah digunakan pada query untuk
// semua data diperolehi dari METHOD POST Form
// Lakukan escape string untuk mengelakkan error pada DB jika ada special characters
$name = mysqli_real_escape_string( $db_connection, $_POST['name'] );
$student_id = mysqli_real_escape_string( $db_connection, $_POST['student_id'] );
$email = mysqli_real_escape_string( $db_connection, $_POST['email'] );
$gender = mysqli_real_escape_string( $db_connection, $_POST['gender'] );
$programme = mysqli_real_escape_string( $db_connection, $_POST['programme'] );
$coursework = mysqli_real_escape_string( $db_connection, $_POST['coursework'] );
$final = mysqli_real_escape_string( $db_connection, $_POST['final'] );

// Tetapkan query INSERT data ke table tbldzahiedaismail
$sql = "INSERT INTO tbldzahiedaismail (name, student_id, email, gender, programme, coursework, final) 
VALUES ('$name', '$student_id', '$email', '$gender', '$programme', '$coursework', '$final')";

// Jalankan proses query INSERT ke DB
if ( $db_connection->query( $sql ) === FALSE )
{
    // Sekiranya tidak berjaya simpan rekod ke DB, paparkan error
    echo 'Masalah: ' . $sql . '<br>' . $db_connection->error;
    exit();
}

// Tamatkan connection ke DB
$db_connection->close();

?>

<html>
<head>
    <title>Form Feedback Grade</title>
</head>

<body>
     <center><p><h1>ISB42503 Internet Programming</h1></p>
    <p><h2>Assignment</h2></p>
    <p><h3>Student Grade</h3></p>
    </center>
      
<?php

$overall = ($coursework * 0.6) + ($final * 0.4);

if ($overall >= 40) {
    $grade = "PASS";
} else {
    $grade = "FAIL";
}

if ($overall >= 80) {
    $grd = "A";
} elseif ($overall >= 75) {
    $grd = "A-";
} elseif ($overall >= 70) {
    $grd = "B+";
} elseif ($overall >= 65) {
    $grd = "B";
} elseif ($overall >= 60) {
    $grd = "B-";
} elseif ($overall >= 55) {
    $grd = "C+";
} elseif ($overall >= 50) {
    $grd = "C";
} elseif ($overall >= 45) {
    $grd = "C-";
} elseif ($overall >= 40) {
    $grd = "D";
} else {
    $grd = "F";
}

echo "<p>Name: $name</p>";
echo "<p>Student ID: $student_id</p>";
echo "<p>Email: $email</p>";
echo "<p>Gender: $gender</p>";
echo "<p>Programme: $programme</p>";
echo "<p>Coursework: $coursework</p>";
echo "<p>Final: $final</p>";
echo "<p>Overall: $overall</p>";
echo "<p>Grade: $grade</p>";
echo "<p>Detail grade: $grd</p>";
?>
</body>
</html>