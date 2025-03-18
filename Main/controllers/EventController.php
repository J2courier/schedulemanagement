<?php
class EventController {
    private $eventModel;

    public function __construct($db) {
        $this->eventModel = new EventModel($db);
    }

    public function index() {
        $events = $this->eventModel->getAllEvents();
        require 'views/events/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Add CSRF protection
            if (!$this->validateCSRFToken()) {
                echo json_encode(['success' => false, 'message' => 'Invalid token']);
                return;
            }

            $data = json_decode(file_get_contents('php://input'), true);
            
            // Input validation
            if (!$this->validateEventData($data)) {
                echo json_encode(['success' => false, 'message' => 'Invalid input data']);
                return;
            }

            try {
                $result = $this->eventModel->createEvent($data);
                echo json_encode(['success' => true, 'message' => 'Event created']);
            } catch (Exception $e) {
                error_log($e->getMessage());
                echo json_encode(['success' => false, 'message' => 'Server error occurred']);
            }
        }
    }

    private function validateEventData($data) {
        return (
            isset($data['eventName']) && 
            isset($data['eventDescription']) && 
            isset($data['scheduleDate']) &&
            strlen($data['eventName']) <= 255 &&
            strtotime($data['scheduleDate']) !== false
        );
    }

    private function validateCSRFToken() {
        // Implement CSRF validation
        return true;
    }
}
