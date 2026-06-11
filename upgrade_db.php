<?php
include('db/db.php');

// Handle Form Submission for Setup/Upgrade
$message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['run_upgrade'])) {
    $selected_timezone = $_POST['timezone'] ?? 'UTC';

    // 1. Run all your standard database migrations
    $conn->query("ALTER TABLE staff ADD COLUMN role VARCHAR(50) NOT NULL DEFAULT 'staff'");

    // Create default admin account
    $username = 'admin';
    $password = 'admin';
    $check = $conn->prepare("SELECT id FROM staff WHERE username = ?");
    $check->bind_param("s", $username);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows == 0) {
        $stmt = $conn->prepare("INSERT INTO staff (username, password, role) VALUES (?, SHA2(?, 256), 'admin')");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
    }

    // 2. Create settings table
    $conn->query("CREATE TABLE IF NOT EXISTS settings (id INT AUTO_INCREMENT PRIMARY KEY, setting_key VARCHAR(255) NOT NULL UNIQUE, setting_value VARCHAR(255) NOT NULL)");

    // Insert Default App Configurations
    $conn->query("INSERT IGNORE INTO settings (setting_key, setting_value) VALUES ('max_usage_minutes', '1200')");
    $conn->query("INSERT IGNORE INTO settings (setting_key, setting_value) VALUES ('school_name', 'E-Station School')");
    $conn->query("INSERT IGNORE INTO settings (setting_key, setting_value) VALUES ('school_logo', 'logo.png')");
    
    // 3. Save or Update the Timezone choice inside the DB
    $stmt = $conn->prepare("INSERT INTO settings (setting_key, setting_value) VALUES ('timezone', ?) ON DUPLICATE KEY UPDATE setting_value = ?");
    $stmt->bind_param("ss", $selected_timezone, $selected_timezone);
    $stmt->execute();

    // 4. Run remaining migrations
    $check_col = $conn->query("SHOW COLUMNS FROM students LIKE 'session_count'");
    if ($check_col->num_rows == 0) {
        $conn->query("ALTER TABLE students ADD COLUMN session_count INT NOT NULL DEFAULT 0");
    }

    // 5. Generate a dynamic 'config.php' utility file automatically!
    $config_content = "<?php\n" .
                      "// Generated automatically by upgrade_db.php\n" .
                      "define('DB_TIMEZONE', '$selected_timezone');\n" .
                      "date_default_timezone_set(DB_TIMEZONE);\n";
    
    if (file_put_contents('config.php', $config_content)) {
        $message = "<h3>✅ Setup Successful!</h3>" .
                   "<p>Database updated and timezone set to <strong>$selected_timezone</strong>.</p>" .
                   "<p style='color:red;'>⚠️ For security, please delete <strong>upgrade_db.php</strong> immediately.</p>";
    } else {
        $message = "<h3>⚠️ Database updated, but failed to write config.php. Check your folder permissions!</h3>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>E-Station - App Setup Wizard</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 50px; background: #f4f6f9; color: #333; }
        .wizard-card { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); max-width: 500px; margin: auto; }
        select, button { width: 100%; padding: 12px; margin-top: 10px; border-radius: 4px; border: 1px solid #ccc; font-size: 16px; }
        button { background: #007bff; color: white; border: none; font-weight: bold; cursor: pointer; }
        button:hover { background: #0056b3; }
        .alert { padding: 15px; border-radius: 4px; background: #e2f0d9; border: 1px solid #b8dc9e; margin-bottom: 20px; }
    </style>
</head>
<body>

<div class="wizard-card">
    <h2>🚀 E-Station Setup & Upgrade</h2>
    <p>This script will provision your database schema updates and initialize application environments.</p>
    
    <?php if (!empty($message)) echo "<div class='alert'>$message</div>"; ?>

    <?php if (empty($message)): ?>
		<form method="POST">
				<label for="timezone"><strong>Select System Timezone:</strong></label>
				<select name="timezone" id="timezone">
						<!-- Asia -->
						<option value="Asia/Manila">Manila, Philippines (GMT+8)</option>
						<option value="Asia/Singapore">Singapore (GMT+8)</option>
						<option value="Asia/Kuala_Lumpur">Kuala Lumpur, Malaysia (GMT+8)</option>
						<option value="Asia/Jakarta">Jakarta, Indonesia (GMT+7)</option>
						<option value="Asia/Bangkok">Bangkok, Thailand (GMT+7)</option>
						<option value="Asia/Ho_Chi_Minh">Ho Chi Minh City, Vietnam (GMT+7)</option>
						<option value="Asia/Hong_Kong">Hong Kong (GMT+8)</option>
						<option value="Asia/Tokyo">Tokyo, Japan (GMT+9)</option>
						<option value="Asia/Seoul">Seoul, South Korea (GMT+9)</option>
						<option value="Asia/Kolkata">Kolkata, India (GMT+5:30)</option>
						<option value="Asia/Dubai">Dubai, UAE (GMT+4)</option>

						<!-- Europe -->
						<option value="Europe/London">London, UK (GMT/BST)</option>
						<option value="Europe/Paris">Paris, France (CET/CEST)</option>
						<option value="Europe/Berlin">Berlin, Germany (CET/CEST)</option>
						<option value="Europe/Rome">Rome, Italy (CET/CEST)</option>
						<option value="Europe/Madrid">Madrid, Spain (CET/CEST)</option>

						<!-- North America -->
						<option value="America/New_York">New York, USA (EST/EDT)</option>
						<option value="America/Chicago">Chicago, USA (CST/CDT)</option>
						<option value="America/Denver">Denver, USA (MST/MDT)</option>
						<option value="America/Los_Angeles">Los Angeles, USA (PST/PDT)</option>
						<option value="America/Toronto">Toronto, Canada (EST/EDT)</option>

						<!-- South America -->
						<option value="America/Sao_Paulo">São Paulo, Brazil (GMT-3)</option>
						<option value="America/Buenos_Aires">Buenos Aires, Argentina (GMT-3)</option>

						<!-- Oceania -->
						<option value="Australia/Perth">Perth, Australia (GMT+8)</option>
						<option value="Australia/Sydney">Sydney, Australia (AEST/AEDT)</option>
						<option value="Pacific/Auckland">Auckland, New Zealand (NZST/NZDT)</option>

						<!-- Africa -->
						<option value="Africa/Johannesburg">Johannesburg, South Africa (GMT+2)</option>
						<option value="Africa/Cairo">Cairo, Egypt (GMT+2)</option>

						<!-- Universal -->
						<option value="UTC">Universal Coordinated Time (UTC)</option>
				</select>
				<button type="submit" name="run_upgrade">Run Upgrades & Save</button>
		</form>
    <?php endif; ?>
</div>

</body>
</html>