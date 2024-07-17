<?php
include 'db.php';

$id = $_GET['id'];

$sql = "DELETE FROM programs WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "프로그램 삭제 완료";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header('Location: programs.php');
exit();
?>
