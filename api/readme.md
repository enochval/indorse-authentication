# Installation Guide


1. Clone repo

```
git clone https://github.com/enochval/indorse-auth-api.git
```

2. cd into the project folder and install dependencies

```
composer install
```

3. Copy .env.example file on the project root to .env

```
For linux OS

cp .env.example .env
```

3. Open the .env file for edit and set the following environment variables

```
MAIL_HOST=  // Your mail server host
MAIL_PORT=  // Your mail server port
MAIL_USERNAME=  // your mail server username
MAIL_PASSWORD=  // your mail server password
```

3. You can set the database variables if you choose to create a local one, otherwise the default should work fine.

```
DB_HOST=  // database server
DB_PORT=  // database port
DB_DATABASE=  // database name
DB_USERNAME=  // database user
DB_PASSWORD= // database password
```

3. Set the domain to the frontend by editing the below url

```
FRONTEND_BASEURL=https://your-frontend-domain-name/confirmation?code=

```

3. Run migration on the terminal using

```
php artisan migrate

```