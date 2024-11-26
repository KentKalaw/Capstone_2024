<?php
// Fetch volunteer data for the specific event
$volunteer_sql = "
    SELECT ev.alumni_id, ev.fname, ev.lname, ev.username, ev.batch, COUNT(*) AS volunteer_count 
    FROM events_volunteer ev
    WHERE ev.volunteerStatus = 'Approved'
    GROUP BY ev.alumni_id, ev.fname, ev.lname, ev.username, ev.batch
    ORDER BY volunteer_count DESC
";
$volunteer_result = $conn->query($volunteer_sql);

$volunteers = [];

while ($row = $volunteer_result->fetch_assoc()) {
    $alumni_id = $row['alumni_id'];
    $name = $row['fname'] . ' ' . $row['lname'];
    $row['name'] = $name;

    // Fetch events for each volunteer
    $events_sql = "
        SELECT e.*, ev.requestDate
        FROM events_volunteer ev
        JOIN events e ON ev.event_id = e.event_id
        WHERE ev.alumni_id = ? 
        AND ev.volunteerStatus = 'Approved'
        ORDER BY e.eventStartDate DESC
    ";
    $stmt = $conn->prepare($events_sql);

    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }


    $stmt->bind_param("i", $alumni_id);
    $stmt->execute();
    $events_result = $stmt->get_result();

    $events = [];
    while ($event = $events_result->fetch_assoc()) {
        $events[] = $event;
    }

    $row['events'] = $events;
    $volunteers[] = $row;
}
?>