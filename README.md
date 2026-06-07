# E-Station Time Log

A simple, web-based time tracking application for student computer usage at e-stations or computer labs.

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

---
## Screenshots

![Collection and Circulation Chart](./readme_assets/estation_sample4.avif)

![Collection and Circulation Chart](./readme_assets/estation_sample3.avif)

![Collection and Circulation Chart](./readme_assets/estation_sample5.avif)

---
## Getting Started

To get started with the E-Station Time Log, please follow the installation instructions in the [INSTALL.md](INSTALL.md) file.

---
## Usage

### Roles

*   **Admin**: Has full access to all features, including staff management, application settings, and student data management.
*   **Staff**: Can register students and manage their time-ins and time-outs.

### Logging In

Log in with your staff or admin credentials on the login page.

### Managing Students

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
## Contributing

Contributions are welcome! Please feel free to submit a pull request or open an issue.

---
## License

© 2026 Ferdinand Tumulak

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.