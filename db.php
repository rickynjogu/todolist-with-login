<?php
class DatabaseConfig {
    private static $connection;

    public static function getConnection() {
        if (!self::$connection) {
            // Replace with your database credentials
            $host = 'localhost';         // Usually 'localhost'
            $username = 'root';          // Default MySQL username
            $password = '';              // Your MySQL password
            $database = 'task_manager';      // Name of your database

            // Create a MySQL connection
            self::$connection = new mysqli($host, $username, $password, $database);

            // Check for connection errors
            if (self::$connection->connect_error) {
                die("Database connection failed: " . self::$connection->connect_error);
            }
        }
        return self::$connection;
    }
}
?>

