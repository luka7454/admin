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

$sql = "SELECT id, email, paymentStatus FROM users";
if ($search) {
    $sql .= " WHERE email LIKE '%$search%' OR paymentStatus LIKE '%$search%'";
}
$result = $conn->query($sql);

if ($result === false) {
    die("Error executing query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>결제유무</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <script>
        function loadModal(page) {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', page, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    document.getElementById('modal-body').innerHTML = xhr.responseText;
                    $('#editModal').modal('show');
                }
            };
            xhr.send();
        }
    </script>
</head>

    <div class="content-fluid">
        <h2 class="my-4">결제유무</h2>
        <form method="GET" action="paymentstatus.php" class="form-inline mb-3" onsubmit="submitSearch(this, event);">
            <input type="text" name="search" class="form-control mr-sm-2" placeholder="입력해주세요" value="<?php echo $search; ?>">
            <button type="submit" class="btn btn-primary">검색</button>
        </form>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>고유번호</th>
                    <th>이메일</th>
                    <th>결제유무</th>
                    <th>수정</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['paymentStatus']; ?></td>
                    <td>
                        <button class="btn btn-sm btn-warning" onclick="loadModal('update_paymentstatus.php?id=<?php echo $row['id']; ?>')">수정</button>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">결제유무 수정</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body">
                    <!-- Modal content will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
