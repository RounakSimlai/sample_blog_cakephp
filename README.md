# Sample Blog Program

This is a simple blog program with basic authentication and authorization

---

## Pre-Requisites

1.Composer(2.1.8 or higher)

2.IDE(VS Code, PhpStorm etc.)

3.PgAdmin(If you use Postgresql) or PhpMyAdmin(If MySQL).

4.Cakephp(4.2.0 or higher)

---

## Steps for Installation

1.Clone the Project.

2.Open the local terminal(cmd,powershell etc.) and run ``composer install`` then ``composer update``

3.After the composer downloads all the dependencies, run ``bin\cake server`` to host the project in the localhost

---

## Setting up the environment of the project

1. Copy the ".env.example" file and rename to ".env".


2. In line 16 of the ".env" file, change the value of APP_NAME to the name of your database.

3.In lines 33 and 34, do the following:-

```
export DATABASE_URL="type_of_db://user_group_name:user_group_password@localhost/${APP_NAME}?encoding=utf8&timezone=UTC&cacheMetadata=true&quoteIdentifiers=false&persistent=false"

export DATABASE_TEST_URL="type_of_db://user_group_name:user_group_password@localhost/test_${APP_NAME}?encoding=utf8&timezone=UTC&cacheMetadata=true&quoteIdentifiers=false&persistent=false"
```

---

## Configuring the bootstrap.php

In ``config/bootstrap.php``, uncomment lines 63 to 69 to use the ".env" file instead of the "app_local.php" file.

---

# Change Log:-

### 25th September 2021

1. Project is now responsive(Previously ran on 1024 X 768 resolution and below).
2. An email is sent when password is changed by a user.
3. Users can now add or change their profile picture.
4. Users registered through the 'Sign Up' page cannot set themselves as admin anymore. To get the admin details, check
   the UserSeeder class.
5. "Keep Me Signed In" feature is added. If not checked, the session of that user expires after 1 Minute.

### 27th September 2021

1. Added Search functionality.
2. Users can now see the data of articles and categories also by scanning the QR code from the view page.
3. Table Data can now be downloaded as a PDF file.

### 30th September 2021

1. User data can now be downloaded in pdf and excel formats.

---

#### Note:-

> The expiration time of the custom cookie can be changed in the login method of UsersController.

---
