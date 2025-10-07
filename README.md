````markdown
# 💰 Vemana Institute of Technology Fee Management System

A simple PHP-based **Fee Management System** built for demonstration purposes at **Vemana Institute of Technology**.  
It provides separate portals for **Admins** and **Students** to manage and view fee-related data.

---

## 🚀 Features

### 👨‍💼 Admin Panel
- Secure admin authentication.
- Dashboard displaying total students and total fees collected.
- Add, edit, and manage student records.
- View pending dues.
- Export student data as CSV.
- Analytics view for fee insights.

### 🎓 Student Portal
- Student login with ID & password.
- View personal details, total fees, and payment history.
- Option to pay fees online (dummy flow).
- Responsive and modern dashboard UI.

---

## 🛠️ Tech Stack

| Component | Technology |
|------------|-------------|
| Frontend | HTML, CSS, Bootstrap 5 |
| Backend | PHP (XAMPP / MySQL) |
| Database | MySQL |
| Styling | Custom CSS + Bootstrap |
| Server | Apache (via XAMPP) |

---

## ⚙️ Setup Instructions

1. Clone this repository:
   ```bash
   git clone https://github.com/your-username/vemana-fee-management-system.git
````

2. Move the folder to your **htdocs** directory (if using XAMPP).
3. Import the provided `database.sql` file into your MySQL server.
4. Update your database credentials in `config.php`.
5. Start Apache and MySQL from XAMPP Control Panel.
6. Access the system in your browser:

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

* Clean, modern dashboard design.
* Light & dark theme consistency.
* Responsive layout for all devices.
* Smooth transitions and hover effects.

---

## 🧠 Note

This project is a **dummy prototype** made for educational demonstration.
It is **not intended for production use**. No actual payment gateway is integrated.

---

## 🧑‍💻 Author

**Sandeep Singh**
B.E - Computer Science (Data Science)
Vemana Institute of Technology

---

```
```
