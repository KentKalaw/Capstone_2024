<?php include_once('active_volunteer_sql.php'); ?>

<script>

const volunteersChart = document.getElementById('volunteersChart').getContext('2d');

let volunteersData = <?php echo json_encode($volunteers); ?>;

console.log(volunteersData);


const labelsVolunteer = volunteersData.map(v => v.name);
const countsVolunteer = volunteersData.map(v => v.volunteer_count);

new Chart(volunteersChart, {
    type: 'bar',
    data: {
        labels: labelsVolunteer,
        datasets: [{
            label: 'Number of Events Volunteered',
            data: countsVolunteer,
            backgroundColor: '#752738',
            borderColor: '#752738',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: true,
                position: 'top'
            },
            title: {
                display: true,
                text: 'Active Event Volunteer',
                font: {
                    size: 16
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1
                },
                title: {
                    display: true,
                    text: 'Number of Events'
                }
            },
            x: {
                ticks: {
                    maxRotation: 45,
                    minRotation: 45
                },
                title: {
                    display: true,
                    text: 'Volunteers'
                },
            }
        },
        barPercentage: 0.5,
        categoryPercentage: 0.5,
    }
});
</script>