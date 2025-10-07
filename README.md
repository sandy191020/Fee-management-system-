````markdown
<h1 align="center">💻 Vemana Institute of Technology Fee Management System</h1>

<p align="center">
  <em>A modern and lightweight web application for managing and tracking student fee records at <b>Vemana Institute of Technology</b>.</em>
</p>

<p align="center">
  🎓 <b>Admin Dashboard</b> • 💰 <b>Student Portal</b> • ⚡ <b>PHP + MySQL</b>
</p>

---

## ✨ Overview
The **Vemana Institute of Technology Fee Management System** is a simple yet professional PHP-based web application designed to manage student fee data efficiently.  
It includes **separate dashboards** for admins and students, allowing secure login, fee tracking, and payment record management — all within a clean, responsive interface.

---

## 🚀 Features

### 👨‍💼 Admin Panel
- 🔐 Secure Admin Login  
- 📊 Dashboard Overview (Total Students, Fees Collected)  
- ➕ Add & Manage Students  
- 🧾 View Pending Dues  
- 📤 Export Student Data as CSV  
- 📈 Analytics for Financial Overview  

### 🎓 Student Portal
- 🔑 Student Login  
- 👤 View Profile Details (Name, Branch, Year)  
- 💸 Check Total Fees & Dues  
- 🧾 View Payment History  
- 🪙 Pay Fees (Dummy Flow)  

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

1. **Clone this Repository**
   ```bash
   git clone https://github.com/your-username/vemana-fee-management-system.git
````

2. **Move Project to XAMPP htdocs**

   ```
   C:\xampp\htdocs\vemana-fee-management-system
   ```

3. **Import Database**

   * Open [phpMyAdmin](http://localhost/phpmyadmin)
   * Create a new database named `demo_fees`
   * Import the provided SQL file: `database.sql`

4. **Configure Database**

   * Edit `config.php` with your MySQL credentials.

5. **Run the Application**

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

* 🌈 Clean, modern, and responsive layout
* 🪶 Light & dark theme consistency
* 🎬 Smooth hover effects and transitions
* 📱 Works on desktop, tablet, and mobile

---

## ⚠️ Note

> 🧠 This is a **dummy educational project** created for demonstration purposes.
> It does **not include a real payment gateway** and is **not meant for production**.

---

## 🧑‍💻 Author

**Sandeep Singh**
B.E. in Computer Science (Data Science)
Vemana Institute of Technology
📍 Bengaluru, India

---

<p align="center">
  ⭐ If you like this project, consider giving it a star on GitHub! ⭐
</p>
```
