# Eventy on WampServer (Windows)

This guide helps you run the Eventy project on WampServer and import the database from `db/import.sql`.

## 1) Install and start WampServer
- Download WampServer 64-bit: https://www.wampserver.com/en/
- Install to default path `C:\wamp64`.
- Start WampServer (green tray icon = all services running). If orange/red, see Troubleshooting.

## 2) Place the project under WAMP
- Preferred: copy this folder to `C:\wamp64\www\Eventy`.
- Or create an Apache Alias via Wamp tray icon: Apache → Alias directories → Add an alias → point to this folder.

## 3) Create the database and import SQL
Choose one method.

### A. Using phpMyAdmin (easiest)
1. Open http://localhost/phpmyadmin
2. Create database `eventy` with collation `utf8mb4_unicode_ci`.
3. Go to Import → Choose file → `db/import.sql` → Go.

### B. Using the MySQL client (CLI)
1. Find your MySQL bin folder, e.g. `C:\wamp64\bin\mysql\mysql8.0.x\bin`.
2. In a terminal, run:

```bat
"C:\wamp64\bin\mysql\mysql8.0.x\bin\mysql.exe" -u root -e "CREATE DATABASE IF NOT EXISTS eventy CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
"C:\wamp64\bin\mysql\mysql8.0.x\bin\mysql.exe" -u root eventy < db\import.sql
```

Note: WAMP default `root` has no password. If you set one, add `-p`.

## 4) Update app DB config (if needed)
Project uses `mysqli` with defaults:
- Host: `localhost`
- User: `root`
- Password: `""` (empty)
- DB: `eventy`

If MySQL runs on a non-default port, add the port parameter to `mysqli`:

```php
// includes/db.php
$conn = new mysqli($servername, $username, $password, $dbname, 3308); // example port
```

Files to check:
- `config/database.php`
- `includes/db.php`

## 5) Run the app
- Visit http://localhost/Eventy (if copied to `www`)
- Or your alias URL if you created an alias.

## 6) Optional: VirtualHost `eventy.local`
1. Wamp tray → Apache → httpd-vhosts.conf → add:

```
<VirtualHost *:80>
    ServerName eventy.local
    DocumentRoot "C:/wamp64/www/Eventy"
    <Directory "C:/wamp64/www/Eventy">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

2. Edit `C:\Windows\System32\drivers\etc\hosts` and add:

```
127.0.0.1   eventy.local
```

3. Restart all services, open http://eventy.local

## Troubleshooting
- Port in use (MySQL): Stop other MySQL servers (e.g., XAMPP), or change WAMP MySQL port via `my.ini` or Wamp tray → MySQL → Use a port other than 3306, then update the `mysqli` connection to include that port.
- `mysql` not recognized: Use the full path to `mysql.exe` or add its bin folder to PATH.
- PHP extensions: Ensure `mysqli` and `pdo_mysql` are enabled (Wamp tray → PHP → Extensions).
- Email/SMTP: PHPMailer is bundled; configure SMTP credentials in your mail-related scripts if you need outbound email.
