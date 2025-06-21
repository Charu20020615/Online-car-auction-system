# 🚗 Online Car Auction System

[![License](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)
[![Status](https://img.shields.io/badge/status-in%20development-yellow)]()
[![Built with Students](https://img.shields.io/badge/built%20by-SLIIT%20Undergraduates-blueviolet)]()

> An online web-based car auction platform that enables users to list vehicles, place bids, and manage auctions in real time. Built using PHP, MySQL, and hosted on a local XAMPP server.

---

## 📌 Table of Contents

- [About](#about)
- [Objectives](#objectives)
- [Core Modules](#core-modules)
- [System Architecture](#system-architecture)
- [Tech Stack](#tech-stack)
- [Getting Started](#getting-started)
  - [Local Server Setup](#local-server-setup)

---

## 🧠 About

Traditional vehicle auctions are often limited to physical events with manual processing. This Online Car Auction System provides a digital alternative, allowing users to post vehicles, bid on listings, and manage sales efficiently through a browser-based application.

---

## 🎯 Objectives

- Create an online auction system specifically for cars.
- Allow users to register, login, and participate in auctions.
- Let admins post and manage car listings.
- Implement real-time bidding and timer countdown.
- Maintain secure user sessions and store data in a MySQL database.

---

## 🧩 Core Modules

### 1. 👤 User & Admin Management
- User registration and login
- Admin panel for auction listing control

### 2. 🚘 Vehicle Auction Listings
- Add/edit/delete car details with images
- Set auction time frame and starting price

### 3. 💸 Bidding System
- Place live bids on active car auctions
- Display highest bid and bidder info
- Real-time countdown and bidding history

### 4. 📦 Auction Result Handling
- Automatically close auction when timer ends
- Declare winners and save bid history
- Admin can review past auctions

---

## 🛠️ Tech Stack

**Frontend**	       **Backend**	  **Database**	   **Server**  
HTML/CSS/JS	            PHP	          MySQL	           XAMPP (Apache + MySQL)  
                        Vanilla JS    phpMyAdmin       Localhost

---

## 🚀 Getting Started

### 📂 Local Server Setup (XAMPP)

**1. Install XAMPP**

- Download from [https://www.apachefriends.org](https://www.apachefriends.org)
- Start **Apache** and **MySQL** modules

**2. Clone or Download the Project**
```bash
git clone https://github.com/yourusername/car-auction-system.git
