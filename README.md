# 🎮 G4ME Pro Africa – Backend API & Admin Panel

Bienvenue dans le backend du projet **G4ME Pro Africa**, la première plateforme panafricaine dédiée aux tournois mobiles, compétitions e-sport, et à la communauté des gamers africains.

Ce backend Laravel permet de :

-   Collecter les adresses e-mail des utilisateurs en attente du lancement 📩
-   Envoyer des emails de bienvenue automatiquement 💌
-   Gérer les leads via un **panel d’administration sécurisé**
-   Fournir une **API REST** simple pour connexion au front React ⚙️

---

## 📦 Stack technique

-   **Laravel 11**
-   **MySQL / MariaDB**
-   **Jobs + Queue (Mail)** avec `SendWelcomeEmailJob`
-   **API RESTful** pour les leads
-   **Validation, exceptions & réponse JSON standardisées**
-   **Mailing avec SMTP (Hostinger)**

---

## 🚀 Installation

### 1. Clone le projet

```bash
git clone https://github.com/sokevinjonas/api_newsletter_gpa.gitt
cd api_newsletter_gpa
```

### 2. Installer les dépendances

```bash
composer install
```

### 3. Copier le fichier .env et le configurer

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configure les variables SMTP + base de données :

### 5. Migrer la base de données

```bash
php artisan migrate
```
