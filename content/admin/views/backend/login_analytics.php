<?php

  $sql = "SELECT DATE(STR_TO_DATE(timestamp, '%M %d, %Y %h:%i %p')) as login_date, COUNT(DISTINCT id) as total_logins
          FROM top_online_visitor
          GROUP BY DATE(STR_TO_DATE(timestamp, '%M %d, %Y %h:%i %p'))";
  $result = $conn->query($sql);

  $dates = [];
  $logins = [];

  // Populate arrays with dates and logins
  while ($row1 = $result->fetch_assoc()) {
      $dates[] = $row1['login_date'];
      $logins[] = $row1['total_logins'];
  }

  // Encode the arrays after the loop
  $dates = json_encode($dates);
  $logins = json_encode($logins);

?>

<script>
    var ctx = document.getElementById('loginChart').getContext('2d');
    
    var dates = <?php echo $dates; ?>;
    var logins = <?php echo $logins; ?>;
    console.log(dates, logins); 

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
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true 
                }
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Login Statistics',
                    font: {
                        size: 18
                    }
                },
                subtitle: {
                    display: true,
                    text: 'Number of Logins over the last 30 days',
                    font: {
                        size: 14
                    }
                }
            }
        }
    });
</script>