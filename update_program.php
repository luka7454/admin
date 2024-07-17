<?php
include 'db.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $expiry_date = $_POST['expiry_date'];

    $sql = "UPDATE programs SET user_id='$user_id', name='$name', expiry_date='$expiry_date' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "프로그램 업데이트가 완료되었습니다.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
    header('Location: programs.php');
    exit();
} else {
    $sql = "SELECT * FROM programs WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>프로그램업데이트</title>
</head>
<body>
    <h2>프로그램 업데이트</h2>
    <form method="POST" action="">
        <label>유저고유번호:</label><br>
        <input type="number" name="user_id" value="<?php echo $row['user_id']; ?>" required><br>
        <label>프로그램이름</label><br>
        <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br>
        <label>만료일</label><br>
        <input type="date" name="expiry_date" value="<?php echo $row['expiry_date']; ?>" required><br><br>
        <input type="submit" value="업데이트">
    </form>
</body>
</html>

<?php
$conn->close();
?>
