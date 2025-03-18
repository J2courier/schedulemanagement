<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Public/assets/css/main.css">
    <title>Home Page</title>
</head>
<body>
    <nav class="NavBar"> 
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">My Schedule</a></li>
            <li><a href="#">My Profile</a></li>
        </ul>
    </nav>
    <section class="dashboard-section">
        <form id="eventForm" onsubmit="addEvent(event)">
            <h1>WELCOME TO WEB SCHEDULING</h1>
            <label for="event-name">Add Event</label><br>
            <input type="text" id="event-name" name="event-name" placeholder="Event Name" required><br>
            <input type="text" id="event-description" name="event-description" placeholder="Event Description" required><br>
            <div class="DatePickerContainer">
                <input type="date" id="schedule-date" name="schedule-date" required>
                <button type="submit">Add Schedule</button>
            </div>
        </form>

        <div class="table-container">
            <table id="scheduleTable">
                <thead>
                    <tr>
                        <th>Event</th>
                        <th>Monday</th>
                        <th>Tuesday</th>
                        <th>Wednesday</th>
                        <th>Thursday</th>
                        <th>Friday</th>
                        <th>Saturday</th>
                        <th>Sunday</th>
                    </tr>
                </thead>
                <tbody id="scheduleBody">
                    <!-- Dynamic rows will be added here -->
                </tbody>
            </table>
        </div>
    </section>

    <script src="../Public/assets/js/main.js"></script>
</body>
</html>

<?php
//    require_once __DIR__ . '/../core/Database.php';
//    require_once __DIR__ . '/../controllers/EventController.php';
//    require_once __DIR__ . '/../models/EventModel.php';
   
   // Basic routing
//    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
//    $db = Database::getInstance();
//    $controller = new EventController($db->getConnection());
   
//    switch ($uri) {
//        case '/':
//        case '/index.php':
//            $controller->index();
//            break;
       
//        case '/event/create':
//            $controller->create();
//            break;
       
//        default:
//            header('HTTP/1.1 404 Not Found');
//            echo '404 - Page not found';
//            break;
//    }
?>
