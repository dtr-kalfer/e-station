[![DOI](https://zenodo.org/badge/DOI/10.5281/zenodo.20666443.svg)](https://doi.org/10.5281/zenodo.20666443)
# E-Station Time Log

A simple, web-based time tracking application for student computer usage at e-stations or computer labs.

---
## Table of Contents

-  [Features](#features)
-  [Screenshots](README#screenshots)
-  [Why E-Station Time Log Exists](#why-e-station-time-log-exists)
-  [Current Deployment](#current-deployment)
-  [Real-World Context](#real-world-context)
-  [Replication and Adoption](#replication-and-adoption)
-  [Privacy](#privacy)
-  [Getting Started](#getting-started)
-  [Technical Note](#technical-note)
-  [Contributing](#contributing)
-  [License](#license)

---
## Features

*   **Student Time Tracking**: Log student time-ins and time-outs to monitor computer usage.
*   **Usage Limits**: Set a maximum usage time for all students.
*   **Role-Based Access Control (RBAC)**: Differentiate between `admin` and `staff` roles, with admins having full control over the system.
*   **Staff Management**: Admins can add, view, and delete staff accounts.
*   **Customizable Branding**: Admins can upload a school logo and set the school name.
*   **Printable Reports**: Generate print-friendly reports of student usage.
*   **Light/Dark Mode**: A selectable light/dark theme for user comfort.
*   **Power Failure Recovery**: A feature to log out all active users in case of a power outage.
*   **Session Count**: Shows the number of sessions made by each students.
*   **Timezone Support**: Set your country timezone for correct time usage check.
*   **Batch Check All Active Users**: Displays usage time of all active users.
*   **Auto-kick logged-in users upon reaching time limit**: Log out zero time users/students. This keeps the system autonomous, especially on busy days when e-station staff don't have time to stare at the dashboard monitor 


---
## Screenshots

### First Run (upgrade_db.php)
![Collection and Circulation Chart](./readme_assets/first_run.avif)
### Login Interface
![Collection and Circulation Chart](./readme_assets/estation_sample4.avif)

### E-Station Dashboard
![Collection and Circulation Chart](./readme_assets/new_index_menu.avif)

### Admin Panel
![Collection and Circulation Chart](./readme_assets/estation_sample5.avif)

### Print Report
![Collection and Circulation Chart](./readme_assets/sample_print_report.avif)

---
## Why E-Station Time Log Exists

Many educational institutions maintain computer laboratories, libraries, or shared computer stations intended to support student learning. However, access to these resources is not always easy to measure, organize, or document.

In some cases, students may not have regular access to personal computers or laptops outside campus. Academic tasks such as document preparation, online submissions, research, and digital learning activities may therefore depend on the availability of shared institutional resources.

Without a structured system, schools often rely on paper logbooks or manual monitoring to record usage. While functional, these approaches can make it difficult to understand actual demand, generate reports, support accreditation activities, or plan future improvements.

E-Station Time Log was developed to help institutions organize access to shared computer resources, promote fair and efficient utilization, and provide measurable evidence of how these resources support students.

The project is particularly relevant for institutions seeking practical ways to document digital access, improve resource management, and support students who rely on campus computing facilities.

For detailed comparison see [Comparison](COMPARISON.md).

---
## Current Deployment

The **E-Station Time Log** system is actively used at **Burauen Community College (Dr. Jay P. Cabrera Hall, E-Station Facility)** to support the management of shared computer resources and student access to e-station facilities.

![Collection and Circulation Chart](./readme_assets/complab-03.avif)

The system assists staff in documenting computer usage, generating utilization reports, and promoting fair access to available workstations. Through continuous usage recording, the institution is able to maintain historical records that support operational planning, student services, and accreditation-related documentation.

![Collection and Circulation Chart](./readme_assets/complab-02.avif)

The project serves as both a production system and a practical example of how educational institutions can organize and measure access to shared computing resources using open-source software.

---
## Real-World Context

**E-Station Time Log** was developed based on actual operational experiences within an educational institution.

Common scenarios observed in many schools include:

* Students completing assignments using shared computers on campus.
* Students relying on mobile phones for document preparation when computers are unavailable.
* Limited personnel available to manage open-access computer facilities.
* Difficulty producing usage statistics from paper logbooks.
* The need for historical utilization data during accreditation and institutional reporting activities.
* The challenge of balancing open access with fair use of limited computing resources.
* Power interruption common in rural areas during computer use, and the 'log-off active students' button to reflect actual time consumed per student.
* Technical related problems which include hardware and software issues, affecting computer networks and its operation.

These practical considerations influenced the design of the system and continue to guide its development.

---
## Replication and Adoption

**E-Station Time Log** is designed to be deployable by schools, libraries, learning commons, and other educational facilities that provide shared computer access to students.

Institutions interested in adopting the system may customize usage policies, reporting requirements, and operational procedures according to local needs while retaining the project's core objective of promoting organized and equitable access to computing resources.

---
## Privacy

The system is designed to assist educational institutions in managing, monitoring resource utilization, and documenting access to shared computer resources. The system promotes fair and organized use of computer facilities while providing operational statistics for planning, reporting, and resource management.

For full details see [Privacy](PRIVACY.md).

---
## Getting Started

To get started with the E-Station Time Log, please follow the installation instructions in the [INSTALL.md](INSTALL.md) file.

---
### Usage

#### Roles

*   **Admin**: Has full access to all features, including staff management, application settings, and student data management.
*   **Staff**: Can register students and manage their time-ins and time-outs.

#### Logging In

Log in with your staff or admin credentials on the login page.

#### Managing Students

*   **Register**: Add new students to the system.
*   **Time-In/Time-Out**: Start and stop student sessions.
*   **Reset**: (Admin only) Reset a student's total time usage.
*   **Delete**: (Admin only) Remove a student from the system.

---
### Admin Panel

The admin panel is accessible to users with the `admin` role. Here you can:

*   Manage staff accounts.
*   Set the maximum usage time for students.
*   Customize the school name and logo.

---
## Technical Note

 Full description of the app: [TECHNICAL_NOTE.md](TECHNICAL_NOTE.md)
 
---
## Contributing

Contributions are welcome! Please feel free to submit a pull request or open an issue.

---
## License

© 2026 Ferdinand Tumulak

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.