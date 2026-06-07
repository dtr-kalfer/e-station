<?php
session_start();
include('db/db.php');

// Redirect if already logged in
if (isset($_SESSION['staff'])) {
    header("Location: index.php");
    exit;
}

$settings_result = $conn->query("SELECT * FROM settings");
$settings = [];
while ($row = $settings_result->fetch_assoc()) {
    $settings[$row['setting_key']] = $row['setting_value'];
}

$msg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $stmt = $conn->prepare("SELECT role FROM staff WHERE username=? AND password=SHA2(?, 256)");
    $stmt->bind_param("ss", $user, $pass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $_SESSION['staff'] = $user;
        $_SESSION['role'] = $row['role']; // Store role in session
        header("Location: index.php");
        exit;
    } else {
        $msg = "Invalid credentials!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>E-Station</title>
		<meta name="author" content="Ferdinand Tumulak">
		<meta name="project-url" content="https://github.com/dtr-kalfer/e-station" >
		<meta name="description" content="A simple, web-based time tracking application for e-stations or computer labs.">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/dark-mode.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<style>
		* {
			box-sizing: border-box;
		}

		body {
			margin: 0;
			min-height: 100vh;
			display: flex;
			align-items: center;
			justify-content: center;
		}
		
		.footer {
			width: 100%;
		}
		
		button {
			margin-top: 10px;
		}
		</style>
</head>
<body>
		<div class="login-container">
			<div id="theme-switcher">🌓</div>
			<div class="header">
					<img src="uploads/<?= $settings['school_logo'] ?? 'logo.png' ?>" alt="School Logo">
					<h1><?= $settings['school_name'] ?? 'Generic E-Station' ?></h1>
			</div>
			
					<h2 style="margin-top: 45px;">🧑 E-Station Staff Login</h2>
					<form method="post" style="text-align: center; ">
							<input name="username" placeholder="Username" required><br>
							<input type="password" name="password" placeholder="Password" required><br>
							<button >Login</button>
							<p class="error"><?= $msg ?></p>
					</form>

			<div class="footer">
					<p><?= $settings['school_name'] ?? 'Generic E-Station' ?></p><p>&copy; <?= date('Y') ?> Ferdinand Tumulak</p>
			</div>
		</div>
    <script src="assets/js/script.js"></script>
</body>
</html>