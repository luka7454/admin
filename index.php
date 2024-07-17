<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>관리자페이지</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }
        .sidebar {
            width: 250px;
            background-color: #f8f9fa;
            padding: 20px;
            height: 100vh;
            position: fixed;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            flex-grow: 1;
            width: calc(100% - 250px); /* 전체 너비에서 사이드바 너비를 뺌 */
        }
        .sidebar a {
            display: block;
            padding: 10px;
            margin: 5px 0;
            color: #000;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #ddd;
        }
    </style>
    <script>
        function loadContent(page) {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', page, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    document.getElementById('content').innerHTML = xhr.responseText;
                    window.history.pushState({ page: page }, "", page);
                    localStorage.setItem('currentPage', page); // 현재 페이지를 로컬 저장소에 저장
                }
            };
            xhr.send();
        }

        function submitSearch(form, event) {
            event.preventDefault();
            const formData = new FormData(form);
            const params = new URLSearchParams(formData).toString();
            loadContent(`${form.action}?${params}`);
        }

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

        window.onpopstate = function (event) {
            if (event.state && event.state.page) {
                loadContent(event.state.page);
            }
        };

        window.onload = function () {
            const currentPage = localStorage.getItem('currentPage');
            const defaultPage = window.location.pathname === '/' ? 'users.php' : window.location.pathname.substring(1);
            loadContent(currentPage || defaultPage);
        };
    </script>
</head>
<body>
    <div class="sidebar">
        <h2>관리자페이지</h2>
        <a href="#" onclick="loadContent('home.php'); return false;">홈</a>
        <a href="#" onclick="loadContent('users.php'); return false;">사용자</a>
        <a href="#" onclick="loadContent('programs.php'); return false;">프로그램</a>
        <a href="#" onclick="loadContent('paymentstatus.php'); return false;">결제</a>
        <a href="#" onclick="loadContent('points.php'); return false;">포인트</a>
        <a href="logout.php">Logout</a>
    </div>
    <div class="content" id="content">
        <h2>관리자페이지입니다</h2>
        <p>화이팅</p>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit</h5>
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
