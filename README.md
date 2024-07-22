# Customer Management System

## Overview
This is a simple ERP System built using PHP and MySQL. The system allows you to add, edit, view, and delete customer and item records and generate the reports and download the reports as a CSV file.

## Assumptions
1. **Database Schema**:
    - There are two tables: `customer`, `district`,`invoice`, `item`,`invoice_master`, `item_category`,`item_subcategory`.
    - The `customer` table includes the columns: `id`, `title`, `first_name`, `last_name`, `contact_no`, and `district`.
    - The `district` table includes the columns: `district`,`active` and `id`.
    - The `invoice` table includes the columns: `id`, `date`, `time`, `invoice_no`, `customer`,`item_count` and `amount`.
    - The `item` table includes the columns: `id`, `item_code`, `item_category`, `item_subcategory`, `item_name`, `quentity`and `unit_price`.
    - The `invoice_master` table includes the columns: `id`, `invoice_no`, `item_id`, `quentity`, `unit_price`, and `amount`.
    - The `item_category` table includes the columns: `id`and `category`.
    - The `item_subcategory` table includes the columns: `id`and `sub_category`.
    - The `district` column in the `customer` table is a foreign key referencing the `id` column in the `district` table.

2. **Environment**:
    - The project is set up to run in a local development environment using a web server (e.g., Apache) and a MySQL database server.

## Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- A web server (e.g., Apache)
- Composer (for managing PHP dependencies)

## Installation

1. **Clone the Repository**:
    ```bash
    git clone https://github.com/yourusername/customer-management-system.git
    cd customer-management-system
    ```

2. **Set Up the Database**:
    - Create a new MySQL database:
    ```sql
    CREATE DATABASE customer_management;
    ```

    - Switch to the new database:
    ```sql
    USE customer_management;
    ```

    - Create the `district` table:
    ```sql
    CREATE TABLE district (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL
    );
    ```

    - Create the `customer` table:
    ```sql
    CREATE TABLE customer (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(10) NOT NULL,
        first_name VARCHAR(255) NOT NULL,
        last_name VARCHAR(255) NOT NULL,
        contact_no VARCHAR(10) NOT NULL,
        district INT,
        FOREIGN KEY (district) REFERENCES district(id)
    );
    ```

    - Insert sample data into the `district` table:
    ```sql
    INSERT INTO district (name) VALUES
    ('District 1'),
    ('District 2'),
    ('District 3');
    ```

3. **Configure the Database Connection**:
    - Edit the `includes/db.php` file to match your database credentials:
    ```php
    <?php
    $dsn = 'mysql:host=localhost;dbname=customer_management';
    $username = 'your_db_username';
    $password = 'your_db_password';
    $options = [];

    try {
        $pdo = new PDO($dsn, $username, $password, $options);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
    ?>
    ```

4. **Start the Local Web Server**:
    - If you are using a built-in PHP server, navigate to the project directory and run:
    ```bash
    php -S localhost:8000
    ```

    - Open your web browser and navigate to `http://localhost:8000`.

## Features
- **Add Customer**: Allows you to add a new customer to the database.
- **Edit Customer**: Allows you to edit the details of an existing customer.
- **Delete Customer**: Allows you to delete a customer from the database.
- **View Customers**: Displays a list of all customers with their details.

- **Add item**: Allows you to add a new items to the database.
- **Edit item**: Allows you to edit the details of an existing item.
- **Delete item**: Allows you to delete a item from the database.
- **View item**: Displays a list of all items with their details.

- **generate invoice report**: Allows you to generate a invoice report.
- **generate invoice item report**: Allows you to generate a invoice item report.
- **generate item report**: Allows you to generate a item report.
- **download the report**: Allows you to download the reports as a CSV file.

## Validation
- **First Name and Last Name**: Must contain only letters.
- **Contact Number**: Must contain exactly 10 digits.

## Usage
1. **Add Customer**:
    - Navigate to the Add Customer page.
    - Fill out the form with the required details and click Submit.
    - A pop-up message will confirm that the customer has been added successfully.

2. **Edit Customer**:
    - Navigate to the Customer List page.
    - Click the Edit button next to the customer you wish to edit.
    - Update the form with the new details and click Update.
    - A pop-up message will confirm that the customer has been updated successfully.

3. **Delete Customer**:
    - Navigate to the Customer List page.
    - Click the Delete button next to the customer you wish to delete.
    - Confirm the deletion in the pop-up dialog.
    - A pop-up message will confirm that the customer has been deleted successfully.
4. **Add item**
5. **Edit item**
6. **Delete item**
7. **generate invoice report**
8. **generate invoice item report**
9. **generate item report**
10. **download the report**
