CREATE USER IF NOT EXISTS 'riccardomandich'@'172.31.0.%' IDENTIFIED BY '';
GRANT ALL PRIVILEGES ON riccardomandich.* TO 'riccardomandich'@'172.31.0.%';
FLUSH PRIVILEGES;
