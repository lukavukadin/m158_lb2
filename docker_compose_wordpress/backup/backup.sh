#!/bin/bash

# Aktuelles Datum
DATE=$(date +%Y-%m-%d_%H-%M-%S)

# Backup-Verzeichnis (im Container gemountet)
BACKUP_DIR="/backup"

# Datenbank-Zugang
DB_NAME="wordpress_db"
DB_USER="wordpress_user"
DB_PASS="wordpress_pass"

# 1. Backup SQL-Dump
mysqldump -u$DB_USER -p$DB_PASS $DB_NAME > $BACKUP_DIR/db_backup_$DATE.sql

# 2. Backup Dateien (WordPress)
tar -czf $BACKUP_DIR/wp_files_$DATE.tar.gz /var/www/html

# 3. Alte Backups (älter als 7 Tage) löschen
find $BACKUP_DIR -type f -mtime +7 -exec rm {} \
