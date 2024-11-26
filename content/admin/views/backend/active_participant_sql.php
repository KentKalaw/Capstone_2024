<?php
// Fetch participation data for the specific event
$participation_sql = "
    SELECT ep.alumni_id, ep.fname, ep.lname, ep.username, ep.batch, COUNT(*) AS participation_count 
    FROM events_participation ep
    WHERE ep.participationStatus = 'Approved'
    GROUP BY ep.alumni_id, ep.fname, ep.lname, ep.username, ep.batch
    ORDER BY participation_count DESC
";
$participation_result = $conn->query($participation_sql);

$participants = [];

while ($row = $participation_result->fetch_assoc()) {
    $alumni_id = $row['alumni_id'];
    $name = $row['fname'] . ' ' . $row['lname'];
    $row['name'] = $name;

    // Fetch events for each participant
    $events_sql = "
        SELECT e.*, ep.submissionDate
        FROM events_participation ep
        JOIN events e ON ep.event_id = e.event_id
        WHERE ep.alumni_id = ? 
        AND ep.participationStatus = 'Approved'
        ORDER BY e.eventStartDate DESC
    ";
    $stmt = $conn->prepare($events_sql);
    $stmt->bind_param("i", $alumni_id);
    $stmt->execute();
    $events_result = $stmt->get_result();

    $events = [];
    while ($event = $events_result->fetch_assoc()) {
        $events[] = $event;
    }

    $row['events'] = $events;
    $participants[] = $row;
}
?>