# Installation Guide

Follow these steps to set up the E-Station Time Log application on your web server.

---
## Prerequisites

*   A web server with PHP support (e.g., Apache, Nginx).
*   A MySQL or MariaDB database.

---
## Folder Structure
```txt
C:/wamp64/www/e-station/
├── 📙 .gitignore
├── 📙 INSTALL.md
├── 📙 README.md
├── 📙 admin.php
├── 📁 assets
│   ├── 📁 css
│   │   ├── 📙 dark-mode.css
│   │   └── 📙 style.css
│   └── 📁 js
│       └── 📙 script.js
├── 📁 db
│   └── 📙 db.php
├── 📙 index.php
├── 📙 login.php
├── 📙 logout.php
├── 📙 print_report.php
├── 📁 sql
│   └── 📙 estation_clean.sql
├── 📙 upgrade_db.php
└── 📁 uploads
    └── 📙 logo.png
```
---
## Step 1: Database Setup

1. Copy the file (estation_clean.sql) on the specified path.

```txt
C:/wamp64/tmp/
```

2.  Login into your mysql prompt and follow the instruction below:

```mysql
CREATE DATABASE IF NOT EXISTS estation;
USE estation;
SOURCE C:/wamp64/tmp/estation_clean.sql
```

3. Still inside the MySQL prompt, create a new user with a password (e.g., `estation_user` / `estationconnect`).

```mysql
CREATE USER 'estation_user'@'localhost' IDENTIFIED BY 'estationconnect';
GRANT ALL PRIVILEGES ON `estation`.* TO 'estation_user'@'localhost';
```

*Note: (Optional) For advanced user, you may open the `db/db.php` file and change `$host`, `$user`, `$pass`, and `$dbname` variables to according to your own database grant configuration.*

*Note: FIctional student records are added to test purposes and can be removed.*

---
## Step 2: Upload Files

1.  Upload all the files from the `estation` directory to your web server (C:/wamp64/www/estation).

---
## Step 3: Run the Database Upgrade Script

1.  In your web browser, navigate to the `upgrade_db.php` script (e.g., `http://your-domain.com/estation/upgrade_db.php`).
2.  This script will check for existing tables and a default admin user (Username: admin / Password: admin).
3.  **IMPORTANT**: After running the script, delete the `upgrade_db.php` file from your server for security reasons.

---
## Step 4: Log In

1.  Navigate to the `login.php` page in your browser.
2.  Log in with the default admin credentials:
    *   **Username**: `admin`
    *   **Password**: `admin`
3.  Once logged in, you can create a new admin account and delete the default admin and start using the application.

---
## Step 5: Customize

1.  As an admin, you can access the **Admin Panel** to:
    *   Add and manage staff accounts.
    *   Set the maximum usage time for students.
    *   Upload your school's logo and set the school name.

That's it! Your E-Station Time Log application should now be up and running.