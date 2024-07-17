<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $points = $_POST['points'];
    $verified = isset($_POST['verified']) ? 1 : 0;

    $sql = "INSERT INTO users (email, password, points, verified) VALUES ('$email', '$password', $points, $verified)";

    if ($conn->query($sql) === TRUE) {
        echo "User created successfully";
    } else {
        die("Error creating user: " . $conn->error);
    }

    $conn->close();
    echo "<script>$('#editModal').modal('hide'); loadContent('users.php');</script>";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>사용자추가</title>
</head>
<body>
    <h2>사용자추가</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label>이메일:</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label>비번:</label>
            <input type="text" name="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label>포인트:</label>
            <input type="number" name="points" class="form-control" required>
        </div>
        <div class="form-group">
            <label>인증:</label>
            <input type="checkbox" name="verified">
        </div>
        <button type="submit" class="btn btn-primary">사용자추가</button>
    </form>
</body>
</html>

<?php
$conn->close();
?>
