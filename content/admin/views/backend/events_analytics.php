<script>
let participationChart;

function updateChart(eventId) {
    fetch(`fetch_event.php?event_id=${eventId}`)
        .then(response => response.json())
        .then(data => {
            if (participationChart) {
                participationChart.destroy();
            }
            
            const ctx = document.getElementById('eventParticipationChart').getContext('2d');
            participationChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Participants', 'Volunteers'],
                    datasets: [{
                        label: 'Event Participation',
                        data: [data.participants, data.volunteers],
                        backgroundColor: ['#FF6384', '#36A2EB']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'Event Participation and Volunteer Ratio'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    const index = tooltipItem.dataIndex;
                                    if (index === 0) {
                                        return `Number of Participants: ${tooltipItem.raw}`;
                                    } else if (index === 1) {
                                        return `Number of Volunteers: ${tooltipItem.raw}`;
                                    }
                                }
                            }
                        }
                    }
                }
            });
        });
}

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('eventSelect').addEventListener('change', function() {
        if (this.value) {
            updateChart(this.value);
        }
    });
});
</script>