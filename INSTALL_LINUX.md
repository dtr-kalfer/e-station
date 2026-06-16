## 🐧 Alternative Path: Production Linux Deployment (LAMP)

For enhanced stability on old hardware, deploying Linux distribution (such as Ubuntu or Debian) is recommended. Run the following commands from your terminal.

### 1. Install the Stack
```bash
sudo apt update
sudo apt install apache2 mariadb-server php libapache2-mod-php php-mysql -y
```
### 2. Configure the Database 

Secure your database installation and access the database engine prompt:
Bash
```
sudo mysql_secure_installation
sudo mysql -u root -p

```
Inside the MariaDB/MySQL prompt, run the schema initiation:
```sql
CREATE DATABASE IF NOT EXISTS estation;
USE estation;
CREATE USER 'estation_user'@'localhost' IDENTIFIED BY 'estationconnect';
GRANT ALL PRIVILEGES ON `estation`.* TO 'estation_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```
### 3. Deploy Files & Set Permissions

Clone or move your repository files into the Linux default web directory and apply proper permissions so the web server can read your assets and write logo uploads:
```Bash
sudo cp -r /path/to/your/repository/. /var/www/html/estation
sudo chown -R www-data:www-data /var/www/html/estation
sudo chmod -R 755 /var/www/html/estation
```

### 4. Deploy Files & Set Permissions

Import the structure from the command line:

```Bash
sudo mysql -u root -p estation < /var/www/html/estation/sql/estation_clean.sql
```
## 🚀 Verification & Initial Login (All Platforms)

### Step 1: Run the Schema Verification Script
Open your web browser on a client computer connected to the network and navigate to the upgrade script:

```browser
http://SERVER_IP_ADDRESS/estation/upgrade_db.php
```
*Note: This script will verify database tables and automatically seed the default administrator account.

Note: To get the SERVER_IP_ADDRESS, on your linux prompt:
 ```
 ip a
 ```
(You may get something similar to this **192.168.1.101** depending on your network router, so you will enter the following on the browser address bar `http://192.168.1.101/estation/`)

⚠️ CRITICAL SECURITY NOTE: After confirming successful execution, immediately delete the upgrade_db.php file from your web server directory to prevent unauthorized resets.

```Linux command
sudo rm /var/www/html/estation/upgrade_db.php
```
### Step 2: Initial Login & Hardening

Navigate to your login interface at 
```browser
http://<server-ip>/estation/login.php.
```
Access the system using the default administrative credentials:
```login
Username: admin
Password: admin
```
Immediate Action: Once logged in, navigate to the Staff Management panel, create a unique administrator account with a strong password, and permanently delete the default admin profile.

### Step 3: System Customization

From your secure Admin Dashboard, you can completely configure your offline e-station environment:

- Branding: Upload your institutional school logo and define the school name.
- Fair Use Policy: Set the maximum usage session limits for student computer access.
- Staff Access (RBAC): Register staff credentials to delegate monitoring controls without granting structural administrative database access.

## 🔒 Data Privacy & Extraction (UN DPG Compliance)

- Offline Architecture: All student data, timestamps, and usage log metadata reside exclusively on your local server database. No telemetry, analytical metrics, or personal data are transmitted over the public internet.

- Data Minimization: The system tracks only the essential data points required to maintain fair-use time allocation (timestamps, student identifiers, and active computer seat numbers).

- Anonymized Reporting: The print_report.php utility generates clean, print-friendly usage reports. These outputs focus strictly on performance and usage metrics (e.g., hours used, session logs) and completely shield sensitive administrative account hashes from public extraction.

***