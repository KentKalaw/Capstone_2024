<?php
// fetch_event_data.php
include_once('./backend/client.php');

function getEventData($eventId) {
    global $conn;
    
    $participantsQuery = "SELECT COUNT(*) as count FROM events_participation WHERE event_id = ? AND participationStatus = 'Approved'";
    $volunteersQuery = "SELECT COUNT(*) as count FROM events_volunteer WHERE event_id = ? AND volunteerStatus = 'Approved'";
    
    $stmt = $conn->prepare($participantsQuery);
    $stmt->bind_param("i", $eventId);
    $stmt->execute();
    $participantsResult = $stmt->get_result()->fetch_assoc();
    $participantsCount = $participantsResult['count'];
    
    $stmt = $conn->prepare($volunteersQuery);
    $stmt->bind_param("i", $eventId);
    $stmt->execute();
    $volunteersResult = $stmt->get_result()->fetch_assoc();
    $volunteersCount = $volunteersResult['count'];
    
    return [
        'participants' => $participantsCount,
        'volunteers' => $volunteersCount
    ];
}

header('Content-Type: application/json');

if (isset($_GET['event_id'])) {
    $eventId = intval($_GET['event_id']);
    $data = getEventData($eventId);
    echo json_encode($data);
} else {
    // Fetch all events
    $eventsQuery = "SELECT event_id, eventName FROM events ORDER BY eventStartDate DESC";
    $eventsResult = $conn->query($eventsQuery);
    $events = $eventsResult->fetch_all(MYSQLI_ASSOC);
    echo json_encode($events);
}

?>