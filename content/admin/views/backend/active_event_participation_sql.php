<?php include_once('active_participant_sql.php'); ?>

<script>

const participantsChart = document.getElementById('participantsChart').getContext('2d');


let participantsData = <?php echo json_encode($participants); ?>;


const labelsParticipant = participantsData.map(p => p.name);
const countsParticipant = participantsData.map(p => p.participation_count);


new Chart(participantsChart, {
    type: 'bar',
    data: {
        labels: labelsParticipant,
        datasets: [{
            label: 'Number of Events Participated',
            data: countsParticipant,
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
                text: 'Active Event Participation',
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
                    text: 'Participants'
                },
            }
        },
        barPercentage: 0.5,
        categoryPercentage: 0.5,
    }
});
</script>