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

$sql = "SELECT * FROM users";
if ($search) {
    $sql .= " WHERE email LIKE '%$search%' OR id LIKE '%$search%' OR points LIKE '%$search%' OR created_at LIKE '%$search%'";
}
$result = $conn->query($sql);

if ($result === false) {
    die("Error executing query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>유저</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid">
        <h2 class="my-4">유저정보</h2>
        <form method="GET" action="users.php" class="form-inline mb-3" onsubmit="submitSearch(this, event);">
            <input type="text" name="search" class="form-control mr-sm-2" placeholder="입력해주세요" value="<?php echo $search; ?>">
            <button type="submit" class="btn btn-primary">검색</button>
        </form>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>고유번호</th>
                    <th>이메일</th>
                    <th>비밀번호</th>
                    <th>포인트</th>
                    <th>인증</th>
                    <th>회원가입일시</th>
                    <th>수정</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['password']; ?></td>
                    <td><?php echo $row['points']; ?></td>
                    <td><?php echo $row['verified'] ? '예' : '아니요'; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                    <td>
                        <button class="btn btn-sm btn-warning" onclick="loadModal('update_user.php?id=<?php echo $row['id']; ?>')">수정</button>
                        <a href="delete_user.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('정말 삭제하시겠습니까?');">삭제</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <button class="btn btn-primary" onclick="loadModal('create_user.php')">유저 추가</button>
    </div>
</body>
</html>

<?php
$conn->close();
?>
