
<?php
include_once('./backend/client.php');

// Prevent any output before JSON
ob_clean();
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

function getBatchDistribution($eventId) {
    global $conn;
    
    try {
        // Query for participants batch distribution
        $participantQuery = "
        SELECT 
            a.year,
            COUNT(DISTINCT ep.alumni_id) as participant_count
        FROM alumni a
        INNER JOIN events_participation ep ON a.id = ep.alumni_id
        WHERE ep.event_id = ? 
        AND ep.participationStatus = 'Approved'
        GROUP BY a.year
        ORDER BY a.year";

        $volunteerQuery = "
        SELECT 
            a.year,
            COUNT(DISTINCT ev.alumni_id) as volunteer_count
        FROM alumni a
        INNER JOIN events_volunteer ev ON a.id = ev.alumni_id
        WHERE ev.event_id = ? 
        AND ev.volunteerStatus = 'Approved'
        GROUP BY a.year
        ORDER BY a.year";

        // Debug: Print out the queries
        error_log("Participant Query: $participantQuery");
        error_log("Event ID: $eventId");

        // Get participants data
        $stmt = $conn->prepare($participantQuery);
        if (!$stmt) {
            throw new Exception("Failed to prepare participant query: " . $conn->error);
        }
        
        $stmt->bind_param("i", $eventId);
        $stmt->execute();
        $participantResult = $stmt->get_result();
        
        // Debug: Check participant results
        $participants = $participantResult->fetch_all(MYSQLI_ASSOC);
        error_log("Participants Data: " . print_r($participants, true));

        // Get volunteers data
        $stmt = $conn->prepare($volunteerQuery);
        if (!$stmt) {
            throw new Exception("Failed to prepare volunteer query: " . $conn->error);
        }
        
        $stmt->bind_param("i", $eventId);
        $stmt->execute();
        $volunteerResult = $stmt->get_result();
        
        // Debug: Check volunteer results
        $volunteers = $volunteerResult->fetch_all(MYSQLI_ASSOC);
        error_log("Volunteers Data: " . print_r($volunteers, true));

        return [
            'success' => true,
            'participants' => $participants,
            'volunteers' => $volunteers
        ];

    } catch (Exception $e) {
        error_log("Error in getBatchDistribution: " . $e->getMessage());
        return [
            'success' => false,
            'error' => $e->getMessage(),
            'participants' => [],
            'volunteers' => []
        ];
    }
}

try {
    // Validate event ID
    if (!isset($_GET['event_id']) || empty($_GET['event_id'])) {
        throw new Exception('No event selected');
    }

    $eventId = intval($_GET['event_id']);
    if ($eventId <= 0) {
        throw new Exception('Invalid event ID');
    }

    // Get batch distribution data
    $data = getBatchDistribution($eventId);
    
    // Ensure proper JSON encoding
    $jsonData = json_encode($data, JSON_NUMERIC_CHECK);
    if ($jsonData === false) {
        throw new Exception('JSON encoding failed: ' . json_last_error_msg());
    }
    
    echo $jsonData;

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage(),
        'participants' => [],
        'volunteers' => []
    ]);
}

exit();
?>