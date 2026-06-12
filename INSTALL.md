# Installation Guide

Follow these steps to set up the E-Station Time Log application on your web server.

---
## Prerequisites

*   A web server with PHP support (e.g., Apache, Nginx).
*   A MySQL or MariaDB database.
## System & Hardware Requirements 

The E-Station Time Log is optimized for lightweight execution and can be hosted on functional, resource-constrained, or legacy hardware to maximize the lifecycle of existing school equipment. 
### Minimum Hardware (Host Server) 

* **CPU:** Dual-core processor (Intel Core 2 Duo, AMD Athlon, or equivalent legacy chips). 
* **RAM:** 2 GB to 4 GB (2 GB is sufficient for lightweight Linux/LAMP installations). 
* **Storage:** 500 MB of free disk space (accounting for log file growth). 
* **Network:** A standard Local Area Network (LAN) switch/router if client stations need to access the server. (Not required if used as a single standalone logging kiosk). 
### Software Requirements (The Stack) 

* **Web Server:** Apache 2.4+ or Nginx (WAMP for Windows / LAMP for Linux). 
* **Database:** MySQL 5.7+ or MariaDB 10.3+. 
* **Runtime:** PHP 7.4 to PHP 8.x (using standard vanilla PHP extensions).

---
---
## 🟢 For Non-Technical Admins (Quick Start)

If you have never set up a local web server before, the easiest way to run this application on a Windows computer is by using **WAMP Server** or **XAMPP**.

1. **Download a Pre-packaged Stack:** Download and install [Wampserver](https://www.wampserver.com/en/) or [XAMPP](https://www.apachefriends.org/). They bundle Apache, PHP, and MySQL into a single, one-click installer.
2. **Launch the Control Panel:** Run the installed program and ensure the Apache and MySQL services are turned on (the system tray icon will turn green in WAMP).
3. **Access Your Database Manager:** Open your browser and go to `http://localhost/phpmyadmin`. Log in using the default credentials:
   * **Username:** `root`
   * **Password:** *(Leave this blank—by default, fresh installations have no password).*
4. **Proceed to Step 1 Below:** Use the `phpMyAdmin` visual interface to import the `sql/estation_clean.sql` file instead of using the command line prompt.

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

*Note: FIctional student records are added to test purposes and can be removed. You can also remove the existing admin account and create a new administrator account.*

---
## Step 2: Unzip files to your computer/server

1.  Download the [E-station Github Repository](https://github.com/dtr-kalfer/e-station/archive/refs/heads/main.zip)
2. Unzip all the files from the `estation` directory to your web server (C:/wamp64/www/estation).

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
## Step 3: Run the Database Upgrade Script

1.  In your web browser, navigate to the `upgrade_db.php` script (e.g., `http://your-domain.com/estation/upgrade_db.php`). If you are using a local computer, navigate your browser to this link (e.g., `http://localhost/estation/upgrade_db.php`).
2.  This script will check for existing tables and a default admin user (Username: admin / Password: admin), also set your local timezone.
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
    *   **Staff Access (RBAC):** Register staff credentials to delegate monitoring controls without granting structural administrative access.
    *   **Fair Use Policy:** Set the maximum usage session limits for student computer access.
    *   **Branding:** Upload your institutional school logo and define the school name.

## Data Privacy & Extraction (UN DPG Compliance)

- **Offline Architecture:** All student data, timestamps, and usage log metadata reside exclusively on your local server database. No telemetry, analytical metrics, or personal data are transmitted over the public internet.
    
- **Data Minimization:** The system tracks only the essential data points required to maintain fair-use time allocation (timestamps, student identifiers, and active computer seat numbers).
    
- **Anonymized Reporting:** The `print_report.php` utility generates clean, print-friendly usage reports. These outputs focus strictly on performance and usage metrics (e.g., hours used, session logs) and completely shield sensitive administrative account hashes from public extraction.

That's it! Your E-Station Time Log application should now be up and running.