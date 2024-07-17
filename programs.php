<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
include 'db.php';

$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

$sql = "SELECT programs.id, programs.name, programs.expiry_date, users.email FROM programs JOIN users ON programs.user_id = users.id";
if ($search) {
    $sql .= " WHERE programs.name LIKE '%$search%' OR users.email LIKE '%$search%' OR programs.expiry_date LIKE '%$search%'";
}
$result = $conn->query($sql);

if ($result === false) {
    die("Error executing query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>프로그램</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid">
        <h2 class="my-4">프로그램리스트</h2>
        <form method="GET" action="programs.php" class="form-inline mb-3" onsubmit="submitSearch(this, event);">
            <input type="text" name="search" class="form-control mr-sm-2" placeholder="입력해주세요" value="<?php echo $search; ?>">
            <button type="submit" class="btn btn-primary">검색</button>
        </form>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>유저고유번호</th>
                    <th>이메일</th>
                    <th>프로그램</th>
                    <th>만료일</th>
                    <th>수정</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['expiry_date']; ?></td>
                    <td>
                        <button class="btn btn-sm btn-warning" onclick="loadModal('update_program.php?id=<?php echo $row['id']; ?>')">수정</button>
                        <a href="delete_program.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('정말 삭제하시겠습니까?');">삭제</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <button class="btn btn-primary" onclick="loadModal('create_program.php')">새프로그램 추가</button>
    </div>
</body>
</html>

<?php
$conn->close();
?>
