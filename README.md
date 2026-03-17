# 🌌 Superior Tasks - Modern Task Management

🚀 **Live Demo:** [https://superior-tasks-production.up.railway.app/](https://superior-tasks-production.up.railway.app/)

Welcome to **Superior Tasks**, a high-end, premium task management application built with **Symfony 8** and **FrankenPHP**. This project was designed with a focus on cutting-edge aesthetics, featuring **Glassmorphism**, **Google Fonts (Outfit)**, and vibrant gradients.

## ✨ Features

- **Premium UI**: Deep glassmorphism cards, animated backgrounds, and micro-animations.
- **Smart Dashboard**: Grid-based task overview with real-time state tracking.
- **Dynamic Forms**: Modern, interactive objective tracking system.
- **High-Performance**: Powered by **FrankenPHP** & **Symfony AssetMapper**.
- **Automated Deployment**: Ready for one-click deployment on Railway/Render.

---

## 📸 Screenshots

![Dashboard](images/Screenshot%202026-03-17%20at%205.30.33%20PM.png)
![Login](images/Screenshot%202026-03-17%20at%205.30.38%20PM.png)
![Task Details](images/Screenshot%202026-03-17%20at%205.30.44%20PM.png)

> [!TIP]
> Aceste imagini reflectă designul final cu Glassmorphism și tipografia Outfit.

---

## 🔑 Mock Credentials (Demo)

Pentru prezentarea la interview, am pregătit următoarele conturi în baza de date:

| Role | Email | Password |
| :--- | :--- | :--- |
| **Junior User** | `junior@test.com` | `password` |
| **Senior User** | `senior@test.com` | `password123` |

---

## 🛠️ Performance Stack

- **PHP 8.4**
- **Symfony 8.0**
- **FrankenPHP** (Modern App Server)
- **Tailwind CSS** (via CDN + Custom Context)
- **MySQL 8.0**

---

## 🚀 Quick Setup (Local)

1. **Clone & Install Dependencies**:
   ```bash
   composer install
   ```
2. **Setup Database**:
   ```bash
   php bin/console doctrine:database:create
   php bin/console doctrine:migrations:migrate --no-interaction
   php bin/console doctrine:fixtures:load --no-interaction
   ```
3. **Run Dev Server**:
   ```bash
   symfony server:start
   ```

## ☁️ Deployment

Proiectul este pre-configurat pentru **Railway** și **Render.com**.
Toate detaliile tehnice despre cum să pui aplicația live sunt disponibile în [Ghidul de Deployment](file:///Users/bogdy2k/.gemini/antigravity/brain/bb9c07cf-5f90-4333-93d1-8b1106920398/deployment_guide.md).

---

## 🛡️ License

Proprietary - Prepared for Technical Interview Demo.
