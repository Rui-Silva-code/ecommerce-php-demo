# 🛒 E-commerce Demo — PHP & MySQL

Academic / portfolio project simulating a basic **e-commerce platform**, including product catalog, shopping cart, checkout flow, and an admin management area.

> ⚠️ **Demo project — not production ready**

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

## 📸 Screenshots

### Homepage — Product Listing
![Homepage](screenshots/homepage-products.png)

### Shopping Cart
![Cart](screenshots/cart-summary.png)

### Checkout Form
![Checkout](screenshots/checkout-form.png)

### Admin Login
![Admin Login](screenshots/admin-login.png)

### Admin Dashboard
![Admin Dashboard](screenshots/admin-dashboard.png)

---

## 📂 Project Structure

/config
└── basedados.php
/screenshots
/imagem
/loginadmin.php
/paginaadmin.php
/paginaprincipal.php
/formulario_compra.php
/finalizar_compra.php
/salvar_compra.php


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