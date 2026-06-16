# PRIVACY POLICY

## E-Station Time Log System

### Purpose

The E-Station Time Log System is designed to assist educational institutions in managing, monitoring resource utilization, and documenting access to shared computer resources. The system promotes fair and organized use of computer facilities while providing operational statistics for planning, reporting, and resource management.

# Data Privacy Statement & Compliance (R.A. 10173)

The E-Station Time Log is built entirely upon "Privacy by Design" principles. It features complete structural isolation to guarantee institutional data integrity and protect student privacy in strict adherence to **Republic Act No. 10173**, also known as the **Philippine Data Privacy Act of 2012 (DPA)**.

---
## 🔒 Privacy Safeguards & Compliance Pillars

### 1. Localized Data Storage (No Third-Party Transmission)
In strict adherence to the DPA's organizational and physical security mandates, all data storage and processing occur **entirely within the institution’s private hardware environment** (Local Host or Local Area Network via a WAMP/LAMP stack). No student logs, names, or system metadata are ever transmitted to external cloud servers, remote trackers, or third-party data processors. The data stays entirely within the school's physical walls.

### 2. Consent & Operational Transparency
The application’s interface incorporates absolute transparency regarding data collection. Users are visually notified at the login terminal (`index.php`) that the system records only their name, academic course, and usage timestamps. This data collection is strictly limited to the sole purpose of automated resource allocation and fair-use computer lab scheduling.

### 3. Strict Access Controls (Role-Based Access)
Student tracking records are heavily protected from unauthorized exposure. The codebase utilizes strict server-side session validation to enforce **Role-Based Access Control (RBAC)**. Standard staff operators have strictly limited system views, while administrative functionalities are completely locked away, preventing unauthorized copies or data leakages.

### 4. Data Subject Rights & Controlled Erasure
The application respects the data subject rights outlined in the DPA (the right to access and the right to erasure). System administrators retain unhindered access to the underlying local database engine. This allows the institution to easily fulfill individual student requests for data verification, or execute thorough seasonal data purges at the conclusion of an academic semester.

