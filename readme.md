# Minimal requirements

- **PHP >7.2**
- **MySQL or MariaDB**, with a user that has a *username* and a *password*.

# Setup the project

Clone the project : 
```
git clone https://github.com/JScriber/perma-farmer.git perma-farmer
```

CD into the directory :
```
cd perma-farmer
```

Install dependencies :
```
composer install
npm install
```

Create the `.env` file:
```
cp .env.example .env
```

Generate an app key :
```
php artisan key:generate 
```

Create a database in **MySQL or MariaDB**.

Open the `.env` file located at the root of the project and set the access to your database.
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=<database-name>
DB_USERNAME=<user>
DB_PASSWORD=<password>
```

Create the tables and seed them: 
```
php artisan migrate:fresh --seed
```

Launch the project : 
```
php artisan serve
```
## Usage
|  email | password  | role  |
|--------|-----------|-------|
| root.root@gmail.com | password | administrator |
| client.client@gmail.com | password | client |


# Development

Access tinker and play with the DAO with:
```
php artisan tinker
```