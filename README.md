# Feedback & Complaint Management System

This is a web-based application developed for the **CCS6344 T2510 – Database & Cloud Security Assignment 1**. It allows users to submit feedback or complaints and provides an admin interface to manage and respond to them efficiently.

##  Features

- User feedback and complaint submission form
- Admin dashboard with feedback statistics
- Category filtering and message management
- Activity logs for admin actions
- Admin profile settings
- Secure login and database handling

##  Technologies Used

- **Language:** PHP
- **Database:** MySQL
- **Server:** Apache via XAMPP
- **Operating System:** Windows 10

##  Database Security Features

- SQL injection protection via prepared statements
- Password hashing using `password_hash()`
- Role-based access control
- Input sanitization and validation
- Database access via minimal-privilege user

##  How to Run This Project

1. Clone this repo or download the ZIP
2. Place the folder `feedback_system/` in `C:\xampp\htdocs\`
3. Start **Apache** and **MySQL** in XAMPP
4. Open `phpMyAdmin`, create a database (e.g., `feedback_db`)
5. Import the SQL structure manually if you have it (`feedback_system.sql`)
6. In browser, open:  
   `http://localhost/feedback_system/`

##  File Structure
feedback_system/
├── admin.php
├── dashboard.php
├── feedback_detail.php
├── login.php
├── login_action.php
├── profile.php
├── register.php
├── register_action.php
├── send_message.php
├── submit_feedback.php
├── update_status.php
├── view_feedback.php
└── feedback_system.sql


##  Contributors

- Zainal Zikry bin Zainal Effendy (1181100917)
- Maliny Thanaraj (1211100910)
- Zainal Zaim Hakimi bin Zainal Effendy (1211111689)

##  Presentation Video

👉 [Watch here](placeholder)

---

