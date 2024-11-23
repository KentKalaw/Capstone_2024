<?php
// Main query for login data
$sql = "SELECT 
          DATE(STR_TO_DATE(timestamp, '%M %d, %Y %h:%i %p')) as login_date,
          COUNT(DISTINCT id) as total_logins
        FROM top_online_visitor
        WHERE MONTH(STR_TO_DATE(timestamp, '%M %d, %Y %h:%i %p')) = ?
          AND YEAR(STR_TO_DATE(timestamp, '%M %d, %Y %h:%i %p')) = ?
        GROUP BY DATE(STR_TO_DATE(timestamp, '%M %d, %Y %h:%i %p'))
        ORDER BY login_date";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $currentMonth, $currentYear);
$stmt->execute();
$result = $stmt->get_result();

$dates = [];
$logins = [];

while ($row = $result->fetch_assoc()) {
    $dates[] = date('M d, Y', strtotime($row['login_date']));
    $logins[] = $row['total_logins'];
}

// Encode the arrays
$dates = json_encode($dates);
$logins = json_encode($logins);


?>

<script>
var ctx = document.getElementById('loginChart').getContext('2d');
var dates = <?php echo $dates; ?>;
var logins = <?php echo $logins; ?>;

var chart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: dates,
        datasets: [{
            label: 'Number of Logins',
            data: logins,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1,
            fill: false
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false, // Set to false to allow responsive resizing
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1 // Optional: Ensures small increments for better display
                }
            }
        },
        plugins: {
            title: {
                display: true,
                text: 'Login Statistics - <?php echo $monthName . " " . $currentYear; ?>',
                font: {
                    size: 18
                }
            },
            subtitle: {
                display: true,
                text: 'Daily Login Count',
                font: {
                    size: 14
                }
            }
        }
    }
});

// Add event listener for month/year selection
document.getElementById('monthYearSelect').addEventListener('change', function() {
    const [month, year] = this.value.split('-');
    window.location.href = `?month=${month}&year=${year}`;
});
</script>