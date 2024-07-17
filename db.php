<?php
// 디버그 모드 활성화
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 출력 버퍼링 시작
ob_start();

$host = 'svc.sel5.cloudtype.app';
$port = 32699;
$user = 'oursoft';
$pass = 'Epdlwl1!1';
$dbname = 'oursoft';

// 데이터베이스 연결
$conn = new mysqli($host, $user, $pass, $dbname, $port);

// 연결 체크
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



// 출력 버퍼링 종료 및 출력
ob_end_flush();
?>
