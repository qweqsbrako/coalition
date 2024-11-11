Here's a `README.md` file that explains how to set up and use the product inventory management system you requested. This README provides all the necessary instructions for installation, configuration, and usage.

---

# Product Inventory Management System

This is a simple product inventory management system built with **Laravel**, **PHP**, **AJAX**, and **Bootstrap**. The application allows users to add, view, update, and calculate the total value of products based on their quantity and price. The data is stored in a `JSON` file.

## Features

- Add products with name, quantity, and price.
- Automatically calculate the total value of products.
- Edit product details inline in the table.
- View all submitted data in a table, with the total sum at the bottom.
- Data stored in a `JSON` file.

## Prerequisites

Before getting started, make sure you have the following installed:

- PHP >= 8.x
- Composer (for managing PHP dependencies)
- Laravel >= 9.x
- A web server (Apache/Nginx or use Laravel’s built-in development server)

## Installation

1. **Clone the repository:**

   Clone this repository to your local machine:

   ```bash
   git clone https://github.com/qweqsbrako/coalition-laravel.git
   cd coalition-laravel
   ```

2. **Install dependencies:**

   Use Composer to install all the PHP dependencies:

   ```bash
   composer install
   ```

3. **Set up your environment:**

   Copy the `.env.example` file to `.env`:

   ```bash
   cp .env.example .env
   ```

   Then, generate the application key:

   ```bash
   php artisan key:generate
   ```

4. **Create the `data.json` file:**

   Inside the `storage` directory, create a file named `data.json`:

   ```bash
   touch storage/app/public/data.json 
   ```
   and run php artisan storage:link to make the json file accessible from the web

   Ensure that the `storage` directory and `data.json` file are writable by the web server:

   ```bash
   chmod -R 775 storage
   chmod 664 storage/data.json
   ```

5. **Run the Laravel development server:**

   Start the server using Artisan:

   ```bash
   php artisan serve
   ```

   This will start the application on `http://localhost:8000`.

## Usage

Once the server is running, you can access the application in your browser:

- **Home Page:** `http://localhost:8000`
  - This page displays a form to add products, as well as a table showing all products added.
  
### Add Products

- Enter the **Product Name**, **Quantity in Stock**, and **Price per Item**.
- Click the **Submit** button to add the product to the inventory.
- After submission, the product will be displayed in a table with its calculated **Total Value** (Quantity * Price per Item).
  
### Edit Products

- You can edit any of the product details directly in the table by clicking on the cell.
- After editing, click the **update** button to save the changes.

### View Total Value

- The table will show the **Grand Total** of all products at the bottom, which is the sum of the total values of all products.
  
## How it Works

1. **Submitting Data:**
   - When a user submits the form, an AJAX request is made to `/store`.
   - The product data is added to `data.json`.
   - A loader is shown until the request is completed.

2. **Loading Data:**
   - When the page is loaded, an AJAX GET request is made to `/load-data` to fetch and display all the products.

3. **Editing Data:**
   - Inline editing is enabled for product name, quantity, and price.
   - When the **Save** button is clicked, an AJAX POST request is made to `/update/{id}` to save the changes.

4. **Grand Total Calculation:**
   - The total value for each product is calculated as `Quantity * Price`.
   - The grand total is displayed at the bottom of the table.
