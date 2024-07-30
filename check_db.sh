#!/bin/bash

DB_PATH="/var/www/html/database/database.sqlite"

if [ -f "$DB_PATH" ]; then
    echo "Database file exists at: $DB_PATH"
else
    echo "Database file does not exist at: $DB_PATH"
    exit 1
fi
