<?php
// 디버그 모드 활성화
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'db.php';

// GET 요청으로 전달된 ID 확인
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // DELETE 쿼리 실행
    $sql = "DELETE FROM users WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "유저 삭제가 완료되었습니다";
    } else {
        die("Error deleting record: " . $conn->error);
    }

    $conn->close();
    
    // 삭제 후 users.php로 리디렉션
    header('Location: users.php');
    exit();
} else {
    die("ID not specified.");
}
?>
