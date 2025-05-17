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

## 🏛️ Project Structure
```
/ Main Directory
├── index.php                # Main landing page of the website
├── signup.php               # Page for new users to sign up
│   ├── Admin                # Admin-related files for managing patient data and user accounts
│   │   ├── account_list.php # Displays the list of user accounts
│   │   ├── account_view.php # View details of a specific account
│   │   ├── admin_edit_patient.php # Edit patient details as an admin
│   │   ├── admin_page.php   # Main admin dashboard page
│   │   ├── admin_patient_details.php # View detailed information about a specific patient
│   │   ├── admin_patients.php # List and manage all patients
│   │   ├── delete_patient.php # Delete a patient record
│   │   ├── delete_user.php   # Delete a user account
│   │   ├── edit_user.php     # Edit user account details
│   │   ├── new_patient.php   # Add a new patient to the system
│   │   └── reset_password.php # Reset a user or patient's password
│   ├── Config                # Configuration files for database, environment variables, and sessions
│   │   ├── .env              # Environment variables (e.g., database credentials)
│   │   ├── db.php            # Database connection settings
│   │   ├── env_loader.php    # Loads environment variables from .env file
│   │   └── session.php       # Manages session handling and authentication
│   ├── Images                # Stores image assets used throughout the website
│   │   ├── bcit_logo.jpg     # Logo for BCIT (British Columbia Institute of Technology)
│   │   ├── health-science_building.jpg # Image of the health science building
│   │   └── landing_page_background.jpg # Background image for the landing page
│   ├── Include               # Reusable components like headers, footers, and snippets
│   │   ├── admin_footer.php  # Footer for the admin section
│   │   ├── footer.php        # General footer for the website
│   │   ├── header_auth.php   # Header for pages requiring authentication
│   │   └── header.php        # General header for the website
│   ├── Student               # Files related to the student interface
│   │   ├── patient_details.php # Displays detailed information about a student's patient
│   │   └── student_patients.php # List of all patients assigned to a student
│   └── Style                 # CSS files for styling various pages of the website
│       ├── accounts.css      # Styles for the account-related pages
│       ├── admin.css         # Styles for the admin interface
│       ├── footer.css        # Styles for the footer section
│       ├── header.css        # Styles for the header section
│       └── landing.css       # Styles for the landing page
```
## Known Issues
1. to be determined
2. ...
3. ...
4. ...
5. ...

## Team Contact Information
1) Hugo Amuan | hamuan@my.bcit.ca
2) Gurshaan Daula | gdaula@my.bcit.ca
3) Mitchell MacDonald | mmacdonald157@my.bcit.ca
