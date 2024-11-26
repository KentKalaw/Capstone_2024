<?php
// Prevent any output before JSON
ob_clean();
error_reporting(0);

include_once('./backend/client.php');

function getEventData($eventId) {
    global $conn;
    
    $participantsQuery = "SELECT COUNT(*) as count FROM events_participation WHERE event_id = ? AND participationStatus = 'Approved'";
    $volunteersQuery = "SELECT COUNT(*) as count FROM events_volunteer WHERE event_id = ? AND volunteerStatus = 'Approved'";
    
    // Prepare participants query
    $stmt = $conn->prepare($participantsQuery);
    $stmt->bind_param("i", $eventId);
    $stmt->execute();
    $participantsResult = $stmt->get_result()->fetch_assoc();
    $participantsCount = $participantsResult['count'] ?? 0;
    
    // Prepare volunteers query
    $stmt = $conn->prepare($volunteersQuery);
    $stmt->bind_param("i", $eventId);
    $stmt->execute();
    $volunteersResult = $stmt->get_result()->fetch_assoc();
    $volunteersCount = $volunteersResult['count'] ?? 0;
    
    return [
        'participants' => intval($participantsCount),
        'volunteers' => intval($volunteersCount)
    ];
}

// Ensure JSON response
header('Content-Type: application/json');

try {
    // If no event ID is provided, return default values or error
    if (!isset($_GET['event_id']) || empty($_GET['event_id'])) {
        echo json_encode([
            'participants' => 0,
            'volunteers' => 0,
            'error' => 'No event selected'
        ]);
        exit;
    }

    $eventId = intval($_GET['event_id']);
    
    // Validate event ID
    if ($eventId <= 0) {
        echo json_encode([
            'participants' => 0,
            'volunteers' => 0,
            'error' => 'Invalid event ID'
        ]);
        exit;
    }

    // Fetch and return event data
    $data = getEventData($eventId);
    echo json_encode($data);
} catch (Exception $e) {
    // Handle any unexpected errors
    http_response_code(500);
    echo json_encode([
        'participants' => 0,
        'volunteers' => 0,
        'error' => $e->getMessage()
    ]);
}
exit();
?>