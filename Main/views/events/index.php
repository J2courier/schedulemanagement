<section class="dashboard-section">
    <form id="eventForm">
        <h1>WELCOME TO WEB SCHEDULING</h1>
        <label for="event-name">Add Event</label>
        <input type="text" id="event-name" name="event-name" placeholder="Event Name" required>
        <input type="text" id="event-description" name="event-description" placeholder="Event Description" required>
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
                <?php foreach ($events as $event): ?>
                    <tr>
                        <td><?= htmlspecialchars($event['name']) ?><br><?= htmlspecialchars($event['description']) ?></td>
                        <?php for ($i = 1; $i <= 7; $i++): ?>
                            <td><?= date('N', strtotime($event['schedule_date'])) == $i ? '✓' : '' ?></td>
                        <?php endfor; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
