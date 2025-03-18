
<?php
class EventModel {
    private $db;
    private $table = 'events';

    public function __construct($db) {
        $this->db = $db;
    }

    public function createEvent($data) {
        $sql = "INSERT INTO {$this->table} (name, description, schedule_date) 
                VALUES (:name, :description, :schedule_date)";
        
        try {
            $stmt = $this->db->prepare($sql);
            $result = $stmt->execute([
                ':name' => $data['eventName'],
                ':description' => $data['eventDescription'],
                ':schedule_date' => $data['scheduleDate']
            ]);

            if (!$result) {
                throw new Exception("Failed to create event");
            }

            return $this->db->lastInsertId();
        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
            throw new Exception("Failed to save event");
        }
    }

    public function getAllEvents() {
        try {
            $stmt = $this->db->prepare("SELECT * FROM {$this->table} ORDER BY schedule_date");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
            throw new Exception("Failed to fetch events");
        }
    }

    public function deleteEvent($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = :id");
            return $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
            throw new Exception("Failed to delete event");
        }
    }

    public function updateEvent($id, $data) {
        $sql = "UPDATE {$this->table} 
                SET name = :name, description = :description, schedule_date = :schedule_date 
                WHERE id = :id";
        
        try {
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                ':id' => $id,
                ':name' => $data['eventName'],
                ':description' => $data['eventDescription'],
                ':schedule_date' => $data['scheduleDate']
            ]);
        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
            throw new Exception("Failed to update event");
        }
    }
}
