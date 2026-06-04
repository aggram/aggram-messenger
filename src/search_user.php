<?php
require 'db.php';

header('Content-Type: application/json');

if (!isset($_GET['username'])) {
	    echo json_encode([]);
	        exit;
}

$username = trim($_GET['username']);
$search = $username . "%";

$stmt = $conn->prepare("SELECT id, username FROM users_account WHERE username LIKE ? LIMIT 10");
$stmt->bind_param("s", $search);
$stmt->execute();

$result = $stmt->get_result();

$users = [];

while ($row = $result->fetch_assoc()) {
	    $users[] = $row;
}

echo json_encode($users);
