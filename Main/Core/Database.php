<?php
// class Database {
//     private static $instance = null;
//     private $connection;
//     private $config;

//     public function __construct() {
//         $this->config = [
//             'host' => 'localhost',  // Remove the port from host
//             'port' => 3306,         // Add port separately
//             'dbname' => 'schedulemanagementdb',
//             'username' => 'jfcompanydb',
//             'password' => '',
//             'charset' => 'utf8mb4'
//         ];
//         $this->connect();
//     }

//     private function connect() {
//         try {
//             $this->connection = new mysqli(
//                 $this->config['host'],
//                 $this->config['username'],
//                 $this->config['password'],
//                 $this->config['dbname'],
//                 $this->config['port']    // Add port parameter
//             );

//             // Check connection
//             if ($this->connection->connect_error) {
//                 error_log("Database Connection Error: " . $this->connection->connect_error);
//                 throw new Exception("Database connection failed. Please try again later.");
//             }

//             // Set charset
//             $this->connection->set_charset($this->config['charset']);
            
//             // Set SQL mode for better compatibility
//             $this->connection->query("SET SESSION sql_mode = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION'");
            
//         } catch (Exception $e) {
//             error_log("Database Connection Error: " . $e->getMessage());
//             throw new Exception("Database connection failed. Please try again later.");
//         }
//     }

//     public function reconnect() {
//         if ($this->connection) {
//             $this->connection->close();
//         }
//         $this->connect();
//     }

//     public static function getInstance() {
//         if (self::$instance === null) {
//             self::$instance = new self();
//         }
//         return self::$instance;
//     }

//     public function getConnection() {
//         return $this->connection;
//     }

//     public function __destruct() {
//         if ($this->connection) {
//             $this->connection->close();
//         }
//     }

//     // Helper method for prepared statements
//     public function prepare($sql) {
//         $stmt = $this->connection->prepare($sql);
//         if (!$stmt) {
//             error_log("Prepare Statement Error: " . $this->connection->error);
//             throw new Exception("Database query preparation failed.");
//         }
//         return $stmt;
//     }

//     // Helper method for queries
//     public function query($sql) {
//         $result = $this->connection->query($sql);
//         if (!$result) {
//             error_log("Query Error: " . $this->connection->error);
//             throw new Exception("Database query failed.");
//         }
//         return $result;
//     }
// }
?>
