<?php
session_start();
if (!isset($_SESSION['staff']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

include('db/db.php');

// Handle file upload
if (isset($_FILES['school_logo'])) {
    if ($_FILES['school_logo']['error'] == 0) {
        move_uploaded_file($_FILES['school_logo']['tmp_name'], 'uploads/' . 'logo.png');
    }
}

// Update settings
if (isset($_POST['update_settings'])) {
    $max_minutes = intval($_POST['max_usage_minutes']);
    $school_name = $_POST['school_name'];

    $stmt = $conn->prepare("UPDATE settings SET setting_value = ? WHERE setting_key = 'max_usage_minutes'");
    $stmt->bind_param("s", $max_minutes);
    $stmt->execute();

    $stmt = $conn->prepare("UPDATE settings SET setting_value = ? WHERE setting_key = 'school_name'");
    $stmt->bind_param("s", $school_name);
    $stmt->execute();

    header("Location: admin.php");
    exit;
}

// Add staff
if (isset($_POST['add_staff'])) {
    $stmt = $conn->prepare("INSERT INTO staff (username, password, role) VALUES (?, SHA2(?, 256), ?)");
    $stmt->bind_param("sss", $_POST['username'], $_POST['password'], $_POST['role']);
    $stmt->execute();
    header("Location: admin.php");
    exit;
}

// Delete staff
if (isset($_POST['delete_staff'])) {
    $stmt = $conn->prepare("DELETE FROM staff WHERE id = ?");
    $stmt->bind_param("i", $_POST['staff_id']);
    $stmt->execute();
    header("Location: admin.php");
    exit;
}

$staff_list = $conn->query("SELECT * FROM staff");
$settings_result = $conn->query("SELECT * FROM settings");
$settings = [];
while ($row = $settings_result->fetch_assoc()) {
    $settings[$row['setting_key']] = $row['setting_value'];
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin - Staff Management</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1>👑 Admin Panel</h1>
    <p>
        Logged in as <strong><?= $_SESSION['staff'] ?> (<?= $_SESSION['role'] ?>)</strong> |
        <a href="index.php">🏠 Home</a> |
        <a href="logout.php">🚪 Logout</a>
    </p>

    <h2>Settings</h2>
    <form method="post" enctype="multipart/form-data">
        <label for="school_name">School Name:</label>
        <input type="text" name="school_name" value="<?= $settings['school_name'] ?? '' ?>" required>

        <label for="max_usage_minutes">Max Usage Minutes:</label>
        <input type="number" name="max_usage_minutes" value="<?= $settings['max_usage_minutes'] ?? '' ?>" required>

        <label for="school_logo">School Logo (100x100px):</label>
        <input type="file" name="school_logo" accept="image/png">

        <button name="update_settings">Save Settings</button>
    </form>

    <h2>Add New Staff</h2>
    <form method="post">
        <input name="username" placeholder="Username" required>
        <input name="password" placeholder="Password" required>
        <select name="role">
            <option value="staff">Staff</option>
            <option value="admin">Admin</option>
        </select>
        <button name="add_staff">Add Staff</button>
    </form>

    <h2>Staff List</h2>
    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $staff_list->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['username'] ?></td>
                    <td><?= $row['role'] ?></td>
                    <td>
                        <form method="post" onsubmit="return confirm('Delete this staff member?')">
                            <input type="hidden" name="staff_id" value="<?= $row['id'] ?>">
                            <button name="delete_staff" class="delete-btn">🗑️ Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>