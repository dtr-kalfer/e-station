![e-station_pc](./readme_assets/e-station_pc.avif)
## 🏫 Context & Target Environment

In many school computer laboratories, the "Server" is structurally a standard desktop computer commonly referred to as the **"Server PC" or "Teacher's PC."** This is typically the most secure machine in the laboratory—positioned safely behind the teacher's or librarian's desk, connected to the primary shared printer, backed up by an Uninterruptible Power Supply (UPS), and occasionally granted internet access. 

This specific configuration is the standard blueprint for the vast majority of public and private school computer labs across rural and regional areas in the Philippines. 

Because student access to this specific computer is strictly restricted, and remote network connections are advised against to eliminate security vulnerabilities, **the E-Station Time Log is optimized to run natively on this single machine via `localhost`.** This localized setup transforms the secure Teacher's PC into a resilient, centralized administrative logging kiosk that stays operational even during network or local grid power fluctuations.

### Minimum Hardware (Host Server) 

* **CPU:** Dual-core processor (Intel Core 2 Duo, AMD Athlon, or equivalent legacy chips). 
* **RAM:** 2 GB to 4 GB (2 GB is sufficient for lightweight Linux/LAMP installations). 
* **Storage:** 500 MB of free disk space (accounting for log file growth). 
* **Network:** A standard Local Area Network (LAN) switch/router if client stations need to access the server. (Not required if used as a single standalone logging kiosk). 
## 🐧 Alternative Path: Production Linux Deployment (LAMP)

For enhanced stability on old hardware, deploying Linux distribution (such as Ubuntu or Debian) is recommended. Run the following commands from your terminal.

### 🛠️ Step 1: Install the Web Software (The Terminal)

Open the **Terminal** app on your Ubuntu desktop (Shortcut: `Ctrl` + `Alt` + `T`) and copy-paste these commands to install the database and web server packages: 
```bash
sudo apt update sudo apt install apache2 mariadb-server php libapache2-mod-php php-mysql -y
```
### 2. Configure the Database 

Secure your database installation and access the database engine prompt:

```Bash
sudo mysql_secure_installation
sudo mysql -u root -p

```
Copy and paste these lines all at once into the database window, then press Enter:
```sql
CREATE DATABASE IF NOT EXISTS estation;
USE estation;
CREATE USER 'estation_user'@'localhost' IDENTIFIED BY 'estationconnect';
GRANT ALL PRIVILEGES ON `estation`.* TO 'estation_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

### 3. Copy Files Visually (No Terminal Required)

1. Open your visual Ubuntu **Files** manager.
    
2. Extract or copy your downloaded `e-station` project folder.
    
3. Navigate to **Other Locations > Computer > var > www > html**.
    
4. Paste your folder here so the path looks like `/var/www/html/estation/`.
    
5. Open your Terminal one last time to give the system permission to run the files safely:
```Bash
sudo chown -R www-data:www-data /var/www/html/estation
sudo chmod -R 755 /var/www/html/estation
```
### Step 4: Import the Database Structure

Run this final command in your terminal to load the clean template database into your system:
```Bash
sudo mysql -u root -p estation < /var/www/html/estation/sql/estation_clean.sql
```
### Step 5: Verification & Kiosk Activation

1. Open the **Firefox** web browser on this Ubuntu computer.
    
2. Go to the configuration verification page: `http://localhost/estation/upgrade_db.php`
    
3. **CRITICAL:** Once the page loads successfully, open your visual Files manager, go to `/var/www/html/estation/`, right-click the file named `upgrade_db.php`, and select **Move to Trash**.
    
4. Navigate to `http://localhost/estation/login.php` to access the system with the default credentials (`admin` / `admin`).
    
📌 **Tip:** Bookmark this login page. This PC remains at the teacher's/staff desk under the protection of your UPS backup system to manage all student time allocations safely.

### Step 6: Initial Login & Hardening

Navigate to your login interface at:
```browser
http://localhost/estation/login.php.
```
Access the system using the default administrative credentials:
```login
Username: admin
Password: admin
```
Immediate Action: Once logged in, navigate to the Staff Management panel, create a unique administrator account with a strong password, and permanently delete the default admin profile.

### Step 7: System Customization

From your secure Admin Dashboard, you can completely configure your offline e-station environment:

- Branding: Upload your institutional school logo and define the school name.
- Fair Use Policy: Set the maximum usage session limits for student computer access.
- Staff Access (RBAC): Register staff credentials to delegate monitoring controls without granting structural administrative database access.

## 🔒 Data Privacy & Extraction (UN DPG Compliance)

- Offline Architecture: All student data, timestamps, and usage log metadata reside exclusively on your local server database. No telemetry, analytical metrics, or personal data are transmitted over the public internet.

- Data Minimization: The system tracks only the essential data points required to maintain fair-use time allocation (timestamps, student identifiers, and active computer seat numbers).

- Anonymized Reporting: The print_report.php utility generates clean, print-friendly usage reports. These outputs focus strictly on performance and usage metrics (e.g., hours used, session logs) and completely shield sensitive administrative account hashes from public extraction.

***