# 🌟 Eventy: An Event Management Platform

Eventy is a PHP-based web application for publishing and managing events. This README was updated automatically by scanning the repository to reflect current progress and available components.

---

## Current Status (2026-01-26)

- **Language / Platform:** PHP-based web app (uses `composer` and `PHPMailer`).
- **Database:** MySQL database dumps are provided in `db/eventy.sql` and `db/import.sql`.
- **Web server / env:** Intended for WAMP/XAMPP (local Apache + PHP) environments.
- **Progress:** Core API endpoints and frontend assets are present. Basic CRUD for events (create, read, update, delete) and participant flows (join, manage favorites) are implemented as API endpoints.

---

## Key Implemented Features (detected)

- **Event CRUD endpoints (API):** `create_event.php`, `fetch_event.php`, `UpdateEvent.php`, `DeleteEvent.php` ([api/](api/)).
- **Authentication / Accounts:** `register.php`, `login.php`, `delete_account.php` ([api/]).
- **Participant features:** `participant_get_events.php`, `participant_join_event.php`, `participant_manage_favorites.php` ([api/]).
- **Security / 2FA / OTP flows:** `enable_2fa.php`, `send_otp.php`, `verify_otp.php`, `request_password_otp.php`, `verify_password_otp.php` ([api/]).
- **Settings & Notifications:** `get_settings.php`, `update_settings.php`, `get_notification_settings.php`, `update_notification_settings.php` ([api/]).
- **Profile management & upload:** `update_profile.php`, `upload_profile_picture.php` ([api/]); profile pics stored under `uploads/profile_pics`.
- **Email / mailer support:** `config/mail.php` + `vendor/phpmailer` present.

---

## Repository Inventory (high level)

- Root PHP pages: `index.php`, `host.php`, `participant.php`, `profile.php`, `our_team.php`, `logout.php`.
- API folder: [api/](api/) — multiple endpoints for events, auth, profile, OTP, settings.
- Frontend assets: `assets/css/` and `assets/js/` (styles and scripts), plus `styles.css` in root.
- Database: `db/eventy.sql`, `db/import.sql`.
- Config: `config/database.php`, `config/mail.php`.
- Includes: `includes/db.php` for DB connection logic.
- Uploads: `uploads/events/`, `uploads/profile_pics/`.
- Dependencies: `composer.json` and `vendor/` (autoload + PHPMailer).

---

## Suggested README updates applied

- Set concrete Technology Stack based on detected files.
- Added explicit list of implemented features and key files to help testers and maintainers.
- Added notes for installation and DB import below.

---

## Technology Stack (detected)

- **Frontend:** HTML, CSS, JavaScript (plain JS + jQuery).
- **Backend:** PHP (repository uses `composer` and PHPMailer).
- **Database:** MySQL (SQL dumps in `db/`).
- **Web server:** Apache (WAMP/XAMPP recommended for local development).

---

## Quick Local Setup

1. Copy the repository into your WAMP/XAMPP `www` or `htdocs` folder.
2. Import the database using `db/eventy.sql` (or `db/import.sql`) into MySQL.

```bash
mysql -u root -p your_database_name < db/eventy.sql
```

3. Update database credentials in `config/database.php`.
4. Ensure `uploads/` is writable by the webserver.

---

## Notable files

- API endpoints: [api/](api/)
- Database dump: [db/eventy.sql](db/eventy.sql)
- DB config: [config/database.php](config/database.php)
- Mail config: [config/mail.php](config/mail.php)
- Main README: [README.md](README.md)

---

## Team

Keep original team section and update roles as needed.

---

If you'd like, I can now:

1. Expand the README with more detailed installation steps for Windows/WAMP.
2. Add a short API reference listing each endpoint and parameters.
3. Commit the updated README and create a changelog entry.

Tell me which of the above you'd like me to do next.
