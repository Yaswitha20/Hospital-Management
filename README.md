
# 🏥 Hospital Management System

A web-based **Hospital Management System (HMS)** designed to manage hospital operations such as **Admin, Doctor, and Patient modules**, appointment handling, and database-driven records.

---

## 📌 Project Overview
This project helps hospitals manage:
- Patient records
- Doctor information
- Admin controls
- Secure login for different user roles

The system is built using **PHP, MySQL, HTML, CSS, and JavaScript**.

---

## 🧑‍⚕️ User Roles
- Admin
- Doctor
- Patient

Each role has separate login credentials and access privileges.

---

## 🔑 Login Credentials (For Testing)

### 👨‍💼 Admin
- Username: admin  
- Password: Test@12345  

### 🧑‍🦽 Patient
- Email: test@gmail.com  
- Password: Test@123  

### 🩺 Doctor
- Email: test@demo.com  
- Password: Test@123  

⚠️ These credentials are for demo/testing purposes only.

---

## 🗄️ Database Setup (IMPORTANT)

### Step 1: Create Database
Create a database named:
hms

### Step 2: Import SQL File
- Open phpMyAdmin
- Select the `hms` database
- Import the SQL file located in:
/sqlfile/hms.sql

❗ The project will NOT run without importing the database.

---

## ▶️ How to Run the Project

1. Install XAMPP / WAMP
2. Copy the project folder into:
   htdocs
3. Start Apache and MySQL
4. Open browser and go to:
   http://localhost/Hospital-Management/

---

## 🛠️ Technologies Used
- Frontend: HTML, CSS, JavaScript
- Backend: PHP
- Database: MySQL
- Server: Apache (XAMPP)

---

## 📂 Project Structure

Hospital-Management/
│
├── css/
├── js/
├── images/
├── hms/
├── sqlfile/
│   └── hms.sql
├── index.html
├── index.php
├── contact.php
└── README.md

---

## ✅ Features
- Role-based authentication
- Admin dashboard
- Doctor & patient login
- Database-driven system
- Responsive UI

---

## ⚠️ Important Notes
- Database name must be exactly `hms`
- Import SQL file before running
- Update database credentials in PHP files if required

---

## 📄 License
This project is for educational purposes only.

---

## 🙌 Author
Hospital Management System Project  
Developed for academic learning
