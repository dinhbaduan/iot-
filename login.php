<?php
session_start();
include 'db/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if ($result && password_verify($password, $result['password'])) {
        $_SESSION['admin'] = $result['username'];
        header("Location: index.php");
    } else {
        $error = "Sai tài khoản hoặc mật khẩu!";
    }
}
?>
<!-- HTML giao diện form đăng nhập -->
