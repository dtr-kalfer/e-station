<?php
include('db/db.php');

// 1. Add 'role' column to staff table
$conn->query("ALTER TABLE staff ADD COLUMN role VARCHAR(50) NOT NULL DEFAULT 'staff'");

// 2. Create a default admin user (if it doesn't exist)
// Default credentials: admin / admin
$username = 'admin';
$password = 'admin';

// Check if admin exists
$check = $conn->prepare("SELECT id FROM staff WHERE username = ?");
$check->bind_param("s", $username);
$check->execute();
$result = $check->get_result();

if ($result->num_rows == 0) {
    $stmt = $conn->prepare("INSERT INTO staff (username, password, role) VALUES (?, SHA2(?, 256), 'admin')");
    $stmt->bind_param("ss", $username, $password);
    if ($stmt->execute()) {
        echo "✅ Default admin user created successfully (admin/admin).<br>";
    } else {
        echo "❌ Error creating default admin user.<br>";
    }
} else {
    echo "ℹ️ Default admin user already exists.<br>";
}

echo "✅ Database upgrade complete. You should delete this file now.";


// 3. Create settings table and add default max usage
$conn->query("CREATE TABLE IF NOT EXISTS settings (id INT AUTO_INCREMENT PRIMARY KEY, setting_key VARCHAR(255) NOT NULL UNIQUE, setting_value VARCHAR(255) NOT NULL)");

// Check if setting exists
$check_setting = $conn->query("SELECT id FROM settings WHERE setting_key = 'max_usage_minutes'");
if ($check_setting->num_rows == 0) {
    $conn->query("INSERT INTO settings (setting_key, setting_value) VALUES ('max_usage_minutes', '1200')");
    echo "✅ Default setting for max_usage_minutes created.<br>";
} else {
    echo "ℹ️ Setting for max_usage_minutes already exists.<br>";
}



// 4. Add school name and logo settings
$conn->query("INSERT IGNORE INTO settings (setting_key, setting_value) VALUES ('school_name', 'E-Station School')");
$conn->query("INSERT IGNORE INTO settings (setting_key, setting_value) VALUES ('school_logo', 'logo.png')");
echo "✅ Default settings for school_name and school_logo created.<br>";

// 5. Add session_count column to students (for persistent session tally)
$check_col = $conn->query("SHOW COLUMNS FROM students LIKE 'session_count'");
if ($check_col->num_rows == 0) {
    $conn->query("ALTER TABLE students ADD COLUMN session_count INT NOT NULL DEFAULT 0");
    echo "✅ Added session_count column to students table.<br>";
} else {
    echo "ℹ️ session_count column already exists in students.<br>";
}