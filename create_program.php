<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $expiry_date = $_POST['expiry_date'];

    $sql = "INSERT INTO programs (user_id, name, expiry_date) VALUES ('$user_id', '$name', '$expiry_date')";

    if ($conn->query($sql) === TRUE) {
        echo "Program created successfully";
    } else {
        die("Error creating program: " . $conn->error);
    }

    $conn->close();
    echo "<script>$('#editModal').modal('hide'); loadContent('programs.php');</script>";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Program</title>
</head>
<body>
    <h2>Add Program</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label>유저고유번호</label>
            <input type="number" name="user_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label>프로그램</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>만료일</label>
            <input type="date" name="expiry_date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Program</button>
    </form>
</body>
</html>

<?php
$conn->close();
?>
