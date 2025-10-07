<h1 align="center">💻 Vemana Institute of Technology Fee Management System</h1>

<p align="center">
  <i>A clean and modern web application to manage and track student fee records efficiently at <b>Vemana Institute of Technology</b>.</i>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-Backend-blue?style=for-the-badge&logo=php" alt="PHP Badge"/>
  <img src="https://img.shields.io/badge/MySQL-Database-orange?style=for-the-badge&logo=mysql" alt="MySQL Badge"/>
  <img src="https://img.shields.io/badge/Bootstrap-Frontend-purple?style=for-the-badge&logo=bootstrap" alt="Bootstrap Badge"/>
</p>

---

## ✨ Overview

The **Vemana Institute of Technology Fee Management System** is a web-based platform built with **PHP and MySQL**, designed to simplify fee management for students and administrators. It provides an **Admin Dashboard** to monitor payments and student data, along with a **Student Portal** for checking dues, fee history, and more — all in a smooth, responsive interface.

---

## 🚀 Features

### 👨‍💼 Admin Panel
- 🔐 Secure Admin Login  
- 📊 Dashboard Overview (Total Students, Fees Collected)  
- ➕ Add & Manage Students  
- 🧾 View Pending Dues  
- 📤 Export Finance CSV  
- 📈 Analytics Dashboard  

### 🎓 Student Portal
- 🔑 Student Login  
- 👤 Profile Overview (Name, Branch, Year)  
- 💸 Check Total Fees & Dues  
- 🧾 Payment History  
- 🪙 Dummy Fee Payment Flow  

---

## 🛠️ Tech Stack

| Layer | Technology |
|-------|-------------|
| **Frontend** | HTML5, CSS3, Bootstrap 5 |
| **Backend** | PHP (Procedural) |
| **Database** | MySQL |
| **Server** | Apache (via XAMPP) |

---

## ⚙️ Installation Guide

### 1️⃣ Clone this Repository
```bash
git clone https://github.com/your-username/vemana-fee-management-system.git

### 2️⃣ Move Project to XAMPP Directory

```bash
C:\xampp\htdocs\vemana-fee-management-system
```

### 3️⃣ Import Database

* Open [phpMyAdmin](http://localhost/phpmyadmin)
* Create a new database named **demo_fees**
* Import the provided `database.sql` file

### 4️⃣ Configure Database

* Open `config.php` and update your MySQL credentials (if needed)

### 5️⃣ Run the Application

Visit:

```
http://localhost/vemana-fee-management-system/
```

---

## 🧩 Folder Structure

```
vemana-fee-management-system/
│
├── admin_login.php
├── admin_dashboard.php
├── add_student.php
├── student_login.php
├── student_dashboard.php
├── student_pay.php
├── create_admin.php
├── logout.php
├── config.php
├── css/
│   └── style.css
└── database.sql
```

---

## 🎨 UI Highlights

* 🌈 Clean, professional, and responsive design
* 🪶 Light background with smooth shadow effects
* 🧱 Bootstrap 5 for layout and form styling
* 📱 Mobile-friendly responsive design

---

## ⚠️ Note

> 🧠 This is a **dummy educational project** made for learning and demonstration purposes.
> It does **not include a real payment gateway** and is **not intended for production use**.

---

## 🧑‍💻 Author

**Sandeep Singh**
🎓 B.E. in Computer Science (Data Science)
🏫 Vemana Institute of Technology, Bengaluru
🌐 [GitHub Profile](https://github.com/your-username)

---

<p align="center">
  ⭐ If you like this project, give it a star — it motivates open-source contributors! ⭐
</p>
```
