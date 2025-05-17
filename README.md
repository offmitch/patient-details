# 📦 Hematology Patient Information Database (Web Application)
Team 8: Mitchell MacDonald, Gurshaan Daula, Hugo Amuan
---

## 📚 Table of Contents

- [About](#about)
- [Features](#features)
- [Installation](#installation)
- [Technologies](#technologies)
- [Project Structure](#project-structure)

---

## 🧠 About

Our team has developed a web application to support health sciences students studying hematology. The application simulates a database system that students will encounter in their future careers, allowing them to store, manage, and query patient information related to hematological conditions. By interacting with this system, students gain hands-on experience with patient data management and querying techniques commonly used in the healthcare industry.

---

## 🚀 Features

1. **Account Types**
   - **User**  
     - Has access to the website and the basic operation of searching for a patient.
     - No permission to view all patient fields from the database. Required to find by filtering for a valid first name and last name fields or an exact MRN field.
     
   - **Admin**  
     - Same privileges as a user.
     - Can modify account privileges and access user account information for actions such as password retrieval (manually done).
     - Authority to add or remove patients in the database.
     - Can see all patient fields from the database without querying.

2. **Patient Search**  
   - Any user type can look up a patient's information by entering the exact first and last name or the exact MRN number identifying that patient.

3. **Sessions**  
   - Sessions expire within 15 minutes of inactivity for security reasons, as the program will be used on public computers owned by BCIT.

4. **Desktop-Compatible**  
   - Development was intended to be used on desktop computers or laptops, and UI is ensured to work on the latest versions of Firefox, Safari, or Chrome.

---

## ⚙️ Installation

```bash
# Clone the repository (in your cmd)
git clone https://github.com/offmitch/patient-details.git
cd patient-details

# After cloning the repository, create an .env file with the following variables:
DB_HOST=
DB_PORT=
DB_NAME=
DB_USER=
DB_PASS=
# Please do not push these files to GitHub as they contain confidential information.
```

## 💻 Technologies
* PHP - Used for server-side scripting logic.
* HTML & CSS - Used for front-end structure and stylization of the user interface.
* MySQL - Handles the database management of the application.
* Git & GitHub - Facilitates version control and team collaboration.
