CREATE USER IF NOT EXISTS 'riccardomandich'@'172.20.0.10' IDENTIFIED BY '';
GRANT ALL PRIVILEGES ON my_riccardomandich.* TO 'riccardomandich'@'172.20.0.10';
FLUSH PRIVILEGES;
