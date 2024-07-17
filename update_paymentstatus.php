<?php
include 'db.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $paymentStatus = $_POST['paymentStatus'];

    $sql = "UPDATE users SET paymentStatus='$payment_status' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Payment status updated successfully";
    } else {
        die("Error updating record: " . $conn->error);
    }

    $conn->close();
    echo "<script>$('#editModal').modal('hide'); loadContent('paymentstatus.php');</script>";
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
    <title>결제유무</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <h2>결제유무 수정</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label>결제유무:</label>
            <select name="paymentStatus" class="form-control">
                <option value="Pending" <?php echo $row['paymentStatus'] == 'Pending' ? 'selected' : ''; ?>>대기</option>
                <option value="Completed" <?php echo $row['paymentStatus'] == 'Completed' ? 'selected' : ''; ?>>결제완료</option>
                <option value="Failed" <?php echo $row['paymentStatus'] == 'Failed' ? 'selected' : ''; ?>>결제실패</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">결제유무 업데이트</button>
    </form>
</body>
</html>

<?php
$conn->close();
?>
