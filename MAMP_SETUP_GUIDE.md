# MAMP MySQL Setup - Quick Steps

## ✅ You're using MAMP! Here's what to do:

### 1. Start MAMP
- Open MAMP application
- Click "Start Servers" button
- Wait until both Apache and MySQL are green/running

### 2. Create Database via phpMyAdmin
- Open your browser and go to: **http://localhost:8888/phpMyAdmin**
  (or click "Open WebStart page" in MAMP, then click phpMyAdmin)
- Click on "Databases" tab
- In "Create database" section:
  - Database name: `ibnsinafoundation`
  - Collation: `utf8mb4_unicode_ci`
- Click "Create"

### 3. Run Migrations
Open terminal and run:
```bash
cd "/Users/imranjan/WazProjects/internship gbtechieve/medical/ibnsinafoundation"

# Clear config cache
php artisan config:clear

# Run migrations
php artisan migrate

# Check migration status
php artisan migrate:status
```

### 4. Test Database Connection
```bash
php artisan tinker

# In tinker console, type:
DB::connection()->getPdo();
# Should show PDO connection without errors

\App\Models\Application::count();
# Should return 0 (no applications yet)

exit
```

### 5. Start Your Application
```bash
php artisan serve
```

Now visit your application form - all submissions will be saved to MySQL!

---

## 📝 Your .env is configured for MAMP:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=8889          # MAMP default MySQL port
DB_DATABASE=ibnsinafoundation
DB_USERNAME=root
DB_PASSWORD=root      # MAMP default password
```

## 🔍 View Submitted Applications

### Method 1: phpMyAdmin
- Go to: http://localhost:8888/phpMyAdmin
- Select `ibnsinafoundation` database
- Click on `applications` table
- Browse all submitted applications

### Method 2: Laravel Tinker
```bash
php artisan tinker

# Get all applications
\App\Models\Application::all();

# Get latest 10
\App\Models\Application::latest()->take(10)->get();

# Count total applications
\App\Models\Application::count();

# Search by email
\App\Models\Application::where('email', 'example@email.com')->first();
```

## 🎯 Quick Verification Checklist
- [ ] MAMP servers are running (green lights)
- [ ] Database `ibnsinafoundation` created in phpMyAdmin
- [ ] `.env` file has MAMP settings (port 8889, password root)
- [ ] Migrations run successfully
- [ ] Can connect via `php artisan tinker`

---

**Having issues?**
- Make sure MAMP is running
- Check MAMP uses port 8889 (check in MAMP > Preferences > Ports)
- If using different port, update `DB_PORT` in `.env`
