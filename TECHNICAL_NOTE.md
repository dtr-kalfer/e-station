# Technical Note: E-Station Time Log

## Abstract

E-Station Time Log is a lightweight web-based application developed to monitor and manage student computer usage in school computer laboratories, libraries, e-learning centers, and other shared computing environments. The system was designed for institutions operating under limited budgets that require a simple and practical method for tracking workstation usage without relying on proprietary laboratory management software.

The application provides student registration, session tracking, usage quota enforcement, role-based access control, printable reports, and administrative management features through a PHP and MySQL-based architecture. Its primary objective is to support fair access to shared computing resources while maintaining minimal hardware and software requirements.

---

## Introduction

Educational institutions frequently provide shared computer facilities for students, faculty, and community users. In many cases, these facilities require mechanisms for monitoring workstation utilization, enforcing time limits, and generating administrative reports.

Commercial laboratory management systems may be financially inaccessible for small schools, community colleges, public libraries, and training centers. Consequently, many institutions continue to rely on manual logbooks or spreadsheets for tracking computer usage.

E-Station Time Log was developed as an alternative solution that combines ease of deployment with essential management functions. The application operates entirely within a local area network and can be hosted on existing PHP/MySQL infrastructure.

---

## System Overview

The application follows a traditional web architecture consisting of:

- PHP for server-side processing
    
- MySQL/MariaDB for data storage
    
- HTML, CSS, and JavaScript for the user interface
    

The system records computer usage sessions by tracking student time-in and time-out events. Session durations are automatically calculated and accumulated into a total usage counter associated with each registered user.

Administrative users may configure usage limits, manage staff accounts, customize institutional branding, and generate reports.

---

## Core Features

### Student Time Tracking

The system records:

- Student registration information
    
- Time-in events
    
- Time-out events
    
- Total accumulated usage time
    
- Remaining allowable usage time
    
- Timezone support during initial setup
    
- Power failure log-off (All students are logged out). Please consider using UPS (Uninterruptible Power Supply) to allow a few minutes of power retention to properly log-off all active users. Laptops would be ideal for this e-station setup, allowing a proper log-off.

This functionality allows staff to monitor laboratory utilization and enforce fair-use policies.

### Usage Quota Enforcement

A configurable maximum usage allowance can be established through the administrative interface.

Once a user reaches the configured limit, additional sessions are prevented until administrative intervention or quota adjustment occurs.

### Role-Based Access Control

The application implements two user roles:

#### Administrator

Administrators have access to:

- Student management
    
- Staff account management
    
- System configuration
    
- Institutional branding settings
    
- Printable reports
    
- Usage quota configuration
    

#### Staff

Staff users may:

- Register students
    
- Perform time-in operations
    
- Perform time-out operations
    
- View student records
    

Administrative functions remain restricted.

### Staff Management

Administrative users may create and manage staff accounts through the web interface. This reduces dependency on direct database modifications and simplifies deployment in multi-user environments.

### Institutional Branding

The application supports customization of:

- School name
    
- School logo
    

This feature enables institutions to adapt the interface to their local identity and reporting requirements.

### Reporting

Printable reports provide summaries of student usage activity and quota consumption. These reports can assist administrators in monitoring laboratory operations and preparing institutional documentation.

### Power Failure Recovery

A dedicated power-failure function allows active sessions to be closed in bulk during unexpected outages. This minimizes the risk of incomplete session records and helps preserve usage statistics.

---

## Technical Architecture

The system utilizes a relational database structure composed of entities representing:

- Students
    
- Staff accounts
    
- Usage sessions
    
- Application settings
    

Session records maintain historical information about user activity and permit calculation of cumulative usage statistics.

The application is designed to operate on:

- Windows (WAMP/XAMPP)
    
- Linux (LAMP)
    
- Dockerized PHP/MySQL environments
    

No external frameworks are required.

---

## Intended Applications

E-Station Time Log may be applied in:

- School computer laboratories
    
- Academic libraries
    
- Learning resource centers
    
- Community e-centers
    
- Digital literacy programs
    
- Vocational training institutions
    
- Public-access computer facilities
    

The lightweight design allows deployment on older hardware commonly found in educational environments.

---

## Current Limitations

The current implementation focuses on simplicity and ease of deployment.

The system presently does not include:

- RFID authentication
    
- Barcode login support
    
- QR code identification
    
- Multi-campus synchronization
    
- Automated backup scheduling
    
- Advanced analytics dashboards
    

These features remain potential areas for future development.

---

## Future Development

Potential future enhancements include:

- Activity and audit logging
    
- Export to CSV and spreadsheet formats
    
- Academic term-based quota resets
    
- Student profile photographs
    
- QR code-based authentication
    
- REST API integration
    
- Mobile-friendly administrative dashboard
    
- Enhanced statistical reporting
    
- Multi-location deployment support
    

Future work will continue emphasizing low-cost deployment and accessibility for educational institutions with limited technical resources.

---

## Conclusion

E-Station Time Log demonstrates that practical computer laboratory management can be achieved using lightweight open-source technologies. By providing session tracking, quota enforcement, administrative management, and reporting capabilities within a simple PHP/MySQL environment, the system offers a viable solution for schools and organizations seeking affordable methods for managing shared computing resources.

The project contributes to the broader goal of improving access to digital resources while supporting responsible and equitable usage within educational settings.

---

## Software Availability

Developer:  
Ferdinand Tumulak

Programming Languages:  
PHP, JavaScript, HTML, CSS, SQL

Database:  
MySQL / MariaDB

License:  
MIT License

Repository:  
https://github.com/dtr-kalfer/e-station

Zenodo Archive:  
[![DOI](https://zenodo.org/badge/1261685102.svg)](https://doi.org/10.5281/zenodo.20577594)