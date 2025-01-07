# 🎵 Sound Entertainment

Welcome to **Sound Entertainment**! This platform is designed to host and organize a rich collection of music and videos across various categories. Whether you're exploring new content or revisiting classics, **Sound Entertainment** has something for everyone. Follow the steps below to set up and run the project locally.

---

## 📜 Problem Statement
The **SOUND Group** aims to develop an entertainment website to host and organize a collection of music and videos. This platform will feature both new and old content across various categories, including regional and English languages. The system offers functionalities for:
- **Administrators**: Efficiently manage content and user accounts.
- **Users**: Discover, rate, and review media.

---

## 🚀 Features

### Content Structure
- **Categorized Media**: Music and videos organized by Album, Artist, Year, Genre, and Language.
- **Latest Content Section**: Displays the 5 newest music tracks and videos with a "New" badge.

### Roles and Responsibilities
#### Administrator
- Manage music and video files (Add, Edit, Delete).
- Create and manage categories (Year, Artist, Album, etc.).
- Oversee user accounts and website details.

#### User
- Register with validated personal information.
- Search for music/videos by categories or keywords.
- Add or modify reviews and ratings for content.

### User Interface
- **Homepage**: Features the latest music and videos with an intuitive layout.
- **Responsive Design**: Tailored for desktop and mobile devices using Tailwind CSS.
- **Search Bar**: Quickly find content by keyword or filter by categories.

### Validation and Security
- Mandatory fields for user registration (Name, Address, Phone Number, Email).
- Robust input validations to prevent invalid or malicious entries.

---

## 🛠️ Prerequisites
Before you begin, ensure you have the following installed:
- [XAMPP](https://www.apachefriends.org/index.html) (PHP and MySQL)
- A web browser (Google Chrome or Mozilla Firefox recommended)

---

## 📂 Installation Guide

### Step 1: Download and Extract
1. Download the project ZIP file from this repository.
2. Unzip the project folder to your local machine.

### Step 2: Setup XAMPP
1. Navigate to your XAMPP installation directory.
   - Typically found at `C:\xampp` on Windows.
2. Open the `htdocs` folder.
3. Copy the unzipped project folder into the `htdocs` directory.

### Step 3: Configure the Database
1. Open your browser and go to:  
   `http://localhost/phpmyadmin`
2. Create a new database:
   - **Database Name**: `sound-entertainment`
3. Import the database:
   - Click on the **Import** tab.
   - Select the database file provided in the project folder:
     - **File**: `DATABASE/Query.sql`
   - Click **Go** to complete the import.

### Step 4: Launch the Application
1. Open your browser and go to:  
   `http://localhost/sound-entertainment/Project`

---

## 🔑 Default Login Details
| Role       | Username           | Password  |
|------------|--------------------|-----------|
| **Admin**  | `admin@example.com` | `admin123` |
| **User**   | `user@example.com`  | `user123`  |

---

## 🎉 Website Structure

### Frontend Pages
| Page               | Description                             |
|--------------------|-----------------------------------------|
| `index.php`        | Homepage with latest content.          |
| `music.php`        | Music listing page.                    |
| `videos.php`       | Video listing page.                    |
| `search.php`       | Search results page.                   |
| `profile.php`      | User profile page.                     |
| `signup.php`       | User registration form.                |
| `login.php`        | User login form.                       |

### Admin Panel
| Page                         | Description                        |
|------------------------------|------------------------------------|
| `admin/dashboard.php`        | Admin dashboard overview.         |
| `admin/manage-content.php`   | Add, edit, or delete media.        |
| `admin/manage-users.php`     | Manage user accounts.             |
| `admin/settings.php`         | Configure website settings.       |

---

## 🤝 Contributing
Contributions, issues, and feature requests are welcome! Feel free to fork this repository and submit a pull request.

---

## 📧 Contact
For any questions or support, please contact [fmugheri83@gmail.com](mailto:fmugheri83@gmail.com).
