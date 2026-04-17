# 🚀 PHP Application Deployment on Azure (DevOps Project)

## 📌 Overview
This project demonstrates end-to-end deployment of a PHP web application using Docker, Azure services, and CI/CD automation.

The application allows users to submit data, which is stored in an Azure MySQL database and displayed dynamically.

---

## 🌐 Live Application

### 🔹 CI/CD Deployment (Azure Container Apps)
https://php-app.mangomoss-fc367e64.southeastasia.azurecontainerapps.io

---

## 🛠 Tech Stack
- PHP
- MySQL (Azure Database for MySQL)
- Docker
- Azure Virtual Machine
- Azure Container Registry (ACR)
- Azure Container Apps
- GitHub Actions (CI/CD)

---

## ⚙️ Implementation Steps

### 1. PHP Web Application
- Created a form-based PHP application
- Stores user input in MySQL
- Retrieves and displays stored data

---

### 2. Dockerization
- Created Dockerfile
- Used PHP-Apache base image
- Exposed port 80
- Built and ran container

---

### 3. Azure MySQL Database
- Configured Azure MySQL server
- Created database and tables
- Connected PHP application to cloud database

---

### 4. Manual Deployment (Azure VM)
- Created Linux VM in Azure
- Installed Docker
- Built Docker image on VM
- Ran container using port 80
- Accessed application via public IP

---

### 5. Testing
- Verified application via browser
- Tested data insertion and retrieval

---

### 6. CI/CD Pipeline (GitHub Actions)
- Triggered on push to main branch
- Steps:
  - Checkout code
  - Login to Azure
  - Build Docker image
  - Push image to Azure Container Registry
  - Deploy to Azure Container Apps

---

## 🔁 CI/CD Flow
GitHub → Docker Build → ACR → Azure Container Apps → Live App

---

## Conclusion
This project demonstrates practical experience in containerization, cloud deployment, and CI/CD automation using modern DevOps tools and Azure services.
