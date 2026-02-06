# 🛒 E-commerce Demo — PHP & MySQL

Academic project simulating a basic **e-commerce platform**, including product catalog, shopping cart, checkout flow, and an admin management area.

---

## ✨ Features

### 🧑‍💻 Customer Side
- Product listing with stock display
- Shopping cart (session-based)
- Quantity selection with live total calculation
- Checkout form with age validation (18+)
- Orders stored in the database

### 🔐 Admin Area
- Secure admin login
- Product management (Create, Read, Update, Delete)
- Order overview
- Stock management

---

## 🛠️ Tech Stack

### Backend
- PHP 7.4+
- MySQL
- PDO (Prepared Statements)

### Frontend
- HTML5
- CSS3
- Bootstrap 5
- Vanilla JavaScript

---

## 🔒 Security Practices

- PDO prepared statements (SQL Injection prevention)
- Password hashing with `password_hash()` and `password_verify()`
- Session-based authentication
- Output escaping using `htmlspecialchars()`
- Sensitive configuration handled via `.env` (not committed)

---

## 🚀 Installation Guide

## ⚡ Quick Start (Local)

1. Clone the repository  
2. Import the database schema  
3. Configure the database connection  
4. Run the project using XAMPP or a PHP built-in server  

---

## 📋 Prerequisites

Ensure you have the following installed:

- **PHP 7.4+** with PDO extension enabled  
- **MySQL 5.7+** or MariaDB equivalent  
- **Apache** or **Nginx** web server  
- Recommended: **XAMPP**, **MAMP**, or **WAMP** for local development  

---

## 📥 Step 1: Clone Repository

```bash
git clone https://github.com/Rui-Silva-code/ecommerce-php-demo.git
cd ecommerce-php-demo

Move the project to your web server root:

XAMPP (Windows)

C:\xampp\htdocs\ecommerce
````

## 🗄️ Step 2: Database Setup

 2.1 Create Database
```bash

Using phpMyAdmin or MySQL CLI, create a database named:

CREATE DATABASE lojaonline CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

````

2.2 Import Database Schema

```bash
Import the file:

lojaonline.sql

Using MySQL CLI:

mysql -u root -p lojaonline < lojaonline.sql

Or using phpMyAdmin:

    Open phpMyAdmin

    Select the lojaonline database

    Click Import

    Choose lojaonline.sql

    Click Go
````
## ⚙️ Step 3: Configure Database Connection

```bash

Create a .env file in the project root and copy the contents from .env.example:

DB_HOST=localhost
DB_NAME=lojaonline
DB_USER=root
DB_PASS=

The database connection is handled in:

/config/basedados.php

No changes are required if the .env file is correctly configured.

    ⚠️ The .env file is excluded from version control for security reasons.
````
## ▶️ Step 4: Start Application
```bash
Option A: XAMPP / MAMP / WAMP

    Start Apache and MySQL

    Open your browser

    Access:

http://localhost/ecommerce/paginaprincipal.php

Option B: PHP Built-in Server

From the project root:

php -S localhost:8000

Then open:

http://localhost:8000/paginaprincipal.php

🔑 Admin Access

To access the admin area:

http://localhost/ecommerce/loginadmin.php

Use an administrator account stored in the database.

    Admin passwords are stored securely using password_hash().

````

## 📸 Screenshots

### Product Listing
![products](https://github.com/user-attachments/assets/2e10c87f-fe7c-46c4-8c50-0b62d05f8106)


### Shopping Cart
![cart](https://github.com/user-attachments/assets/fc62111e-fc93-44d3-a8f3-0e32e78780cf)

### Checkout Form
![cartBuy](https://github.com/user-attachments/assets/9d1ef79a-7d53-49cc-98f0-fbdc925d8c97)
![BuyMessage](https://github.com/user-attachments/assets/2ce3c081-553e-4591-b765-dfe91b474fa7)

### Admin Login
![adminLogin](https://github.com/user-attachments/assets/1f7ca6cc-65d0-4020-80e9-7f31d408ceb7)


### Admin Dashboard
![adminpage1](https://github.com/user-attachments/assets/27168204-ab1a-457f-8878-2df82985f6a8)
![adminpage2](https://github.com/user-attachments/assets/a494b0a8-7add-4238-a211-d4a14ebd5094)



---

## 📂 Project Structure

```bash
/config
  └── basedados.php          # Database connection (PDO + env)

/screenshots                 # Project screenshots (for README)
/imagem                      # Product images and assets

# Public pages
/paginaprincipal.php         # Product listing and cart
/formulario_compra.php       # Checkout form
/finalizar_compra.php        # Order processing

# Admin area
/loginadmin.php              # Admin authentication
/paginaadmin.php             # Admin dashboard
/logout.php                  # Session termination

# Product management (admin)
inserir_produto.php
alterar_produto.php
excluir_produto.php

# Cart / session handling
/salvar_compra.php

# Database
/lojaonline.sql              # Database schema and sample data

````

---

## 🚧 Limitations (Intentional)

This project was built for **learning and portfolio purposes**:

- No real payment gateway (checkout is simulated)
- No CSRF protection (documented limitation)
- Stock validation mainly handled on the frontend
- No customer user accounts (admin only)

---

## 🚀 What I Learned

- Migrating legacy MySQLi code to PDO
- Secure authentication basics in PHP
- Session management
- Frontend–backend integration
- Structuring and refactoring a PHP project
- Debugging and improving existing code

---
