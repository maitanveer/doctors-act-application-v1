# MySQL Database Setup Guide

## ✅ What's Already Done

1. **.env file** - Updated to use MySQL connection
2. **Migration file** - Created with all application form fields
3. **Application Model** - Created with proper fillable fields and casts
4. **Controller** - Updated to save data to database automatically

## 📋 Database Configuration

Your `.env` file is configured with:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ibnsinafoundation
DB_USERNAME=root
DB_PASSWORD=
```

## 🔧 Setup Steps

### Option 1: Install MySQL via Homebrew (Recommended for Mac)

```bash
# Install MySQL
brew install mysql

# Start MySQL service
brew services start mysql

# Secure MySQL installation (set root password)
mysql_secure_installation

# Create the database
mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS ibnsinafoundation CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

### Option 2: Use MAMP/XAMPP

If you're using MAMP or XAMPP:

1. Start MAMP/XAMPP
2. Open phpMyAdmin (usually at http://localhost:8888/phpMyAdmin or http://localhost/phpmyadmin)
3. Create a new database named `ibnsinafoundation`
4. Set charset to `utf8mb4` and collation to `utf8mb4_unicode_ci`

**Update your .env if using MAMP:**
```
DB_HOST=127.0.0.1
DB_PORT=8889  # MAMP default, or 3306 for XAMPP
DB_USERNAME=root
DB_PASSWORD=root  # MAMP default password
```

### Option 3: MySQL Workbench or Other GUI Tools

1. Install [MySQL Community Server](https://dev.mysql.com/downloads/mysql/)
2. Install [MySQL Workbench](https://dev.mysql.com/downloads/workbench/) or [TablePlus](https://tableplus.com/)
3. Connect to localhost
4. Create database: `CREATE DATABASE ibnsinafoundation CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;`

## 🚀 Running Migrations

Once MySQL is installed and the database is created:

```bash
# Navigate to project directory
cd "/Users/imranjan/WazProjects/internship gbtechieve/medical/ibnsinafoundation"

# Run migrations to create all tables
php artisan migrate

# Check if migrations were successful
php artisan migrate:status
```

## 📊 Database Schema

The migration creates an `applications` table with the following columns:

### Personal Information
- full_name, dob, gender, citizenship, passport
- email, phone, country_code, address
- visa_status, other_visa_text

### Medical Education
- degree, other_degree, medical_school
- school_country, graduation_year, ecfmg

### Licensure
- license_country, license_number
- issue_date, expiry_date
- licensure_status, disciplinary

### Training & Experience
- pathway, residency, residency_institution
- residency_from, residency_to
- post_residency_years, total_practice_years

### Exams
- step1, step2, jurisprudence, english

### Employment
- job_offer, employer_name, facility_type
- employer_address, contact_person, designation
- contact_phone, contact_email

### Background Check
- security_risk, itar, criminal
- military, misconduct, investigations

### Documents (filenames)
- 19 document upload fields for storing filenames

### Metadata
- application_id (unique), status, ip_address
- user_agent, submission_date, timestamps

## 🧪 Testing

After setup, test the database connection:

```bash
php artisan tinker

# In tinker, run:
DB::connection()->getPdo();
# Should show PDO connection object without errors

# Test creating a test record
\App\Models\Application::count();
# Should return 0 initially
```

## 🔍 Viewing Data

### Via Tinker (Command Line)
```bash
php artisan tinker

# Get all applications
\App\Models\Application::all();

# Get latest 10 applications
\App\Models\Application::latest()->take(10)->get();

# Search by email
\App\Models\Application::where('email', 'test@example.com')->first();
```

### Via Database Tools
- **phpMyAdmin**: Browse `applications` table
- **MySQL Workbench**: Connect and query
- **TablePlus**: Visual interface to browse data

## 📝 Common Issues

### "Access denied for user 'root'@'localhost'"
- Update `DB_PASSWORD` in `.env` with your MySQL root password
- Run: `php artisan config:clear`

### "Database 'ibnsinafoundation' doesn't exist"
- Create the database manually using one of the methods above

### "SQLSTATE[HY000] [2002] Connection refused"
- MySQL service is not running
- Start MySQL: `brew services start mysql` or start MAMP/XAMPP

### Port 3306 already in use
- Another MySQL instance is running
- Change `DB_PORT` in `.env` to match your setup (e.g., 8889 for MAMP)

## 🎯 Next Steps

1. Install MySQL if not already installed
2. Create the database `ibnsinafoundation`
3. Update `.env` with correct credentials
4. Run migrations: `php artisan migrate`
5. Test your application form - submissions will now be saved to MySQL!

---

**Need Help?** 
- Check MySQL is running: `brew services list` or check MAMP/XAMPP status
- Test connection: `php artisan migrate:status`
- View logs: Check `storage/logs/laravel.log` for errors
