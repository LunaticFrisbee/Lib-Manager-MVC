#! /bin/bash

if [ -f config/config.php ];
then
    composer install
    composer dump-autoload
    echo "Starting the development server at PORT 5000"
    cd public
    php -S localhost:5000
else
    echo "Entering the details of config.php file"

    echo "Enter the name of the database you want to create for the application"
    read DB_NAME
    
    echo "Enter your mySQL username"
    read DB_USERNAME

    echo "Enter your mySQL password"
    read -s DB_PASSWORD

    touch config/config.php
    echo '<?php ' > config/config.php
    echo '$DB_HOST = "127.0.0.1";' >> config/config.php
    echo '$DB_PORT = "3306";' >> config/config.php
    echo '$DB_NAME = "'$DB_NAME'";' >> config/config.php
    echo '$DB_USERNAME = "'$DB_USERNAME'";' >> config/config.php
    echo '$DB_PASSWORD = "'$DB_PASSWORD'";' >> config/config.php

    mysql -u $DB_USERNAME -p$DB_PASSWORD -e "CREATE DATABASE $DB_NAME;"
    if [ $? -eq 0 ];
    then
        mysql -u $DB_USERNAME -p$DB_PASSWORD $DB_NAME < schema/schema.sql
        if [ $? -eq 0 ];
        then
        composer install
        composer dump-autoload
            cd public
            echo "Starting the development server at port 5000"
            php -S localhost:5000
        else
            echo "Error encountered while importing from the SQLdump"
            rm config/config.php
        fi
    else
        echo "Error encountered while connecting to the mySQL server"
        rm config/config.php
    fi
fi
