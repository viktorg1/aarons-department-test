# Aarons Department Test

### Full-Stack Test Project for Aarons Department

<img src="https://i.imgur.com/Uy8f3eE.png">

###### Clone the project and install composer dependencies

```
$ git clone https://github.com/viktorg1/aarons-department-test.git
$ cd aarons-department-test

$ composer install
$ npm install

```


###### Rename the .env.example file to .env and change the database attributes

For Windows

```

$ move .env.example .env
$ notepad .env

DB_DATABASE= YOUR_DATABASE_NAME
DB_USERNAME= YOUR_MYSQL_USERNAME
DB_PASSWORD= YOUR_MYSQL_PASSWORD

```

For Linux/MacOS

```

$ mv .env.example .env
$ nano .env

DB_DATABASE= YOUR_DATABASE_NAME
DB_USERNAME= YOUR_MYSQL_USERNAME
DB_PASSWORD= YOUR_MYSQL_PASSWORD

```

###### Generate an application key
```
$ php artisan key:generate
```
###### Migrate the database

```
$ php artisan migrate:fresh
```

###### You have successfully set up your project, now you go ahead and check it out!

```
$ php artisan serve
```

<img src="https://i.imgur.com/H7JGPcp.png" />
