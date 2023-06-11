# Visitor Management System

The Visitor Management System is a Laravel and Vue.js application that helps in managing visitors to a specific location. This system allows for easy tracking, check-in, and check-out of visitors, ensuring better security and organization.

## Installation

To install and run the Visitor Management System, please follow the steps below:

### Prerequisites

- PHP (>= 7.4)
- Composer
- Node.js (>= 12)
- npm (>= 6)
- Laravel CLI

### Step 1: Clone the repository

Begin by cloning this repository to your local machine. You can use the following command:

```
git clone https://github.com/lenfelix/visitor-management-system.git
```

### Step 2: Install dependencies

Navigate to the project's root directory and install the PHP and JavaScript dependencies. Use the following commands:

```
cd visitor-management-system
composer install
npm install
cd vue
npm install
```

### Step 3: Set up the environment

Copy the `.env.example` file and rename it to `.env`. Update the necessary environment variables such as database credentials, and any other configuration options.

```
cp .env.example .env
```

### Step 4: Generate application key

Generate a new application key using the Laravel CLI:

```
php artisan key:generate
```

### Step 5: Set up the database

Create a new database for the Visitor Management System and update the database connection details in the `.env` file.

After configuring the database, run the migrations to create the required tables:

```
php artisan migrate --seed
```

### Step 6: Compile assets

Compile the application's assets using npm (at the /vue layer):

```
npm run dev
```

### Step 7: Start the development server

You are now ready to start the development server. Use the following command to run the application:

```
php artisan serve
```

The Visitor Management System should now be accessible at http://localhost:8000 (or the specified application URL).

## Usage

Once the application is up and running, you can access the Visitor Management System through a web browser. 

Use the credentials below
Email: john@example.com
Password: password
to start managing visitors.

## Acknowledgements

Special thanks to the Laravel and Vue.js communities for their amazing frameworks and tools that made this project possible.
