<?php
include 'db.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $points = $_POST['points'];
    $verified = isset($_POST['verified']) ? 1 : 0;

    $sql = "UPDATE users SET email='$email', password='$password', points=$points, verified=$verified WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "유저 업데이트가 완료되었습니다.";
    } else {
        die("Error updating record: " . $conn->error);
    }

    $conn->close();
    echo "<script>$('#editModal').modal('hide');</script>";
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
    <title>유저 정보 수정</title>
</head>
<body>
    <h2>유저 정보 수정</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label>이메일:</label>
            <input type="email" name="email" class="form-control" value="<?php echo $row['email']; ?>" required>
        </div>
        <div class="form-group">
            <label>비밀번호:</label>
            <input type="text" name="password" class="form-control" value="<?php echo $row['password']; ?>" required>
        </div>
        <div class="form-group">
            <label>포인트:</label>
            <input type="number" name="points" class="form-control" value="<?php echo $row['points']; ?>" required>
        </div>
        <div class="form-group">
            <label>인증:</label>
            <input type="checkbox" name="verified" <?php echo $row['verified'] ? 'checked' : ''; ?>>
        </div>
        <button type="submit" class="btn btn-primary">완료</button>
    </form>
</body>
</html>

<?php
$conn->close();
?>