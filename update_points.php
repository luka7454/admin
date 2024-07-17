<?php
include 'db.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $points = $_POST['points'];

    $sql = "UPDATE users SET points=$points WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "포인트 업데이트가 완료되었습니다";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    header('Location: points.php');
    exit();
} else {
    $sql = "SELECT * FROM users WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>포인트수정</title>
</head>
<body>
    <h2>유저 포인트 수정 <?php echo $row['email']; ?></h2>
    <form method="POST" action="">
        <label>포인트:</label><br>
        <input type="number" name="points" value="<?php echo $row['points']; ?>" required><br><br>
        <input type="submit" value="Update Points">
    </form>
</body>
</html>

<?php
$conn->close();
?>
