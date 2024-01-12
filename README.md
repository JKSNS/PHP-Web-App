# Lab 3B - PHP Part 2: Implementation Overview

## Overview

Having successfully set up authentication in a previous lab, I embarked on an engaging journey to "transpile" my code from the JavaScript lab into PHP. This task involved a deep dive into the intricacies of PHP, as I sought to replicate the functionality of my JavaScript code in this new environment. 

Throughout this lab, which is a continuation of previous labs, I meticulously organized my code to ensure readability and future usability. By the end of this lab, I minimized the use of JavaScript in my project, limiting it to form data capture, submission, and certain UI enhancements like task display modifications and date picker initialization. The core functionalities, however, were now elegantly handled by PHP.

> Note: During the transition of files from Lab 3A, I carefully avoided copying the hidden .git folder to prevent any mix-up of my lab repositories.

### Functionality

- Successfully interacted with a MariaDB database for task CRUD operations.

#### Key Differences from Lab 2

- Switched to PHP, a server-side language, for database interactions, unlike the client-side JavaScript used in previous labs.
- Used a database server instead of local storage, adapting to PHP's server-side nature.
- Implemented user login for personalized task management.

### Concepts

- Mastered the art of Code Transpiling.

### Technologies

- Utilized UML, PHP, and MariaDB.

### Resources

- Leveraged the [Official PHP Documentation](https://www.php.net/) and other online resources for PHP Sessions and Prepared Statements.
> NOTE: Emphasized on using "Object-Oriented Style" prepared statements.

### Assignments

Completed the Lab Write-Up as per instructions in the "Content" tab in Learning Suite.

## Completed Steps

### Step 1: UML

I created a comprehensive UML diagram with swim lanes to map out the CRUD functions and user authentication process before starting the coding phase.

### Step 2: Database Setup

#### Production Environment

1. In PHPMyAdmin on my Production Environment, I created and configured the `'task'` table within the `'lab_3'` database.

#### Development Environment

1. I replicated the database setup steps in my Development Environment at [`http://localhost:8080`](http://localhost:8080).

### Step 3: Transpile

1. Create, Read, Update, Delete:
   - Successfully transpiled these functionalities from JavaScript to PHP, making necessary adjustments for server-side execution.

### Step 4: General Requirements

1. Ensured all forms used appropriate HTTP methods.
2. Employed Prepared Statements for all SQL transactions involving user input.
3. Achieved a neat and user-friendly interface.
4. Optimized the `<nav>` element for usability and aesthetics.
5. Implemented automatic redirection to the login screen when no user is logged in.
6. Enabled seamless navigation between the login and register pages.
7. Added a <kbd>Log Out</kbd> button in the `<nav>` bar for easy access.
8. Limited the use of `<script>` tags to essential CSS framework JavaScript files.

# Tips and Tricks

## How do I...?

Throughout this lab, I found searching online (especially Google) to be immensely helpful for specific PHP and HTML queries.

## var_dump()

Leveraged `var_dump()` in PHP for efficient variable debugging.
