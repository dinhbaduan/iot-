<?php
include '../db/connect.php';

$uid = $_POST['card_uid'];
$device = $_POST['device_name'];

$stmt = $conn->prepare("SELECT * FROM rfid_cards WHERE card_uid = ? AND is_active = 1");
$stmt->bind_param("s", $uid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $access = 'granted';
} else {
    $access = 'denied';
}

$stmt2 = $conn->prepare("INSERT INTO access_logs (card_uid, access_result, device_name) VALUES (?, ?, ?)");
$stmt2->bind_param("sss", $uid, $access, $device);
$stmt2->execute();

echo json_encode(['access' => $access]);
?>
