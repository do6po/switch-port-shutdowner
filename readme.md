## Switch port shutdowner (Laravel)

Program for automatic switching off and on of ports on switches.

## Install
```bash
git clone https://github.com/do6po/switch-port-shutdowner.git switch-port-shutdowner
cd switch-port-shutdowner
composer install
```

Config the switches.php files.
Generate new tokens:
```bash
php artisan token:gen
```

Copy this token into .env file

```
SECRET_TOKENS= <---- # comma separated
```

Adding this application to your web-server and go to:

http://yourhost/?token=$yourtoken