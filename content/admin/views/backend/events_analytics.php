<script>
let participationChart;
let batchDistributionChart;

function showErrorMessage(message) {
    let errorContainer = document.getElementById('chartErrorContainer');
    if (!errorContainer) {
        errorContainer = document.createElement('div');
        errorContainer.id = 'chartErrorContainer';
        errorContainer.className = 'alert alert-danger text-center mt-4';
        const eventSelect = document.getElementById('eventSelect');
        eventSelect.parentNode.insertBefore(errorContainer, eventSelect.nextSibling);
    }
    errorContainer.textContent = message;
}

function clearErrorMessage() {
    const errorContainer = document.getElementById('chartErrorContainer');
    if (errorContainer) {
        errorContainer.remove();
    }
}

function updateBatchDistributionChart(eventId) {
    // Only proceed if a valid event is selected
    if (!eventId) {
        showErrorMessage('Please select an event');
        return;
    }

    fetch(`fetch_event_batch_distribution.php?event_id=${eventId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {

            console.log('Full Batch Distribution Data:', data);
            console.log('Participants:', data.participants);
            console.log('Volunteers:', data.volunteers);

            clearErrorMessage();

            if (batchDistributionChart) {
                batchDistributionChart.destroy();
            }
            
            const ctx = document.getElementById('batchDistributionChart').getContext('2d');
            
            // Combine unique years
            const allYears = [...new Set([
                ...data.participants.map(p => p.year),
                ...data.volunteers.map(p => p.year)
            ])].sort();

            console.log('All Years:', allYears);

            // Prepare data for chart
            const participantCounts = allYears.map(year => {
                const found = data.participants.find(p => p.year === year);
                const count = found ? Math.round(parseFloat(found.participant_count)) : 0;
                console.log(`Participants for ${year}:`, count);
                return count;
            });

            const volunteerCounts = allYears.map(year => {
                const found = data.volunteers.find(p => p.year === year);
                const count = found ? Math.round(parseFloat(found.volunteer_count)) : 0;
                console.log(`Volunteers for ${year}:`, count);
                return count;
            });

            console.log('Participant Counts:', participantCounts);
            console.log('Volunteer Counts:', volunteerCounts);

            // Check if there's any data to display
            if (allYears.length === 0) {
                showErrorMessage('No year data available for this event');
                return;
            }

            // Check if all counts are zero
            const totalCount = [...participantCounts, ...volunteerCounts].reduce((a, b) => a + b, 0);
            if (totalCount === 0) {
                showErrorMessage('No participants or volunteers found for this event');
                return;
            }

            batchDistributionChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: allYears,
                    datasets: [
                        {
                            label: 'Participants',
                            data: participantCounts,
                            backgroundColor: 'rgba(255, 99, 132, 0.6)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Volunteers',
                            data: volunteerCounts,
                            backgroundColor: 'rgba(54, 162, 235, 0.6)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Year'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Count'
                            },
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1, 
                                callback: function(value) {
                                    return Number.isInteger(value) ? value : null; 
                                }
                            }
                        }
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Year Distribution of Participants and Volunteers'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const dataset = context.dataset.label;
                                    const value = context.parsed.y;
                                    return `${dataset}: ${value}`;
                                }
                            }
                        }
                    }
                }
            });
        })
        .catch(error => {
            console.error('Error fetching batch distribution:', error);
            showErrorMessage('Unable to load year distribution. Please try again.');
        });
}

function updateChart(eventId) {
    // Only proceed if a valid event is selected
    if (!eventId) {
        showErrorMessage('Please select an event');
        return;
    }

    fetch(`fetch_event.php?event_id=${eventId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            clearErrorMessage();

            // Check for any error in the response
            if (data.error) {
                showErrorMessage(data.error);
                return;
            }

            // Destroy existing chart if it exists
            if (participationChart) {
                participationChart.destroy();
            }
            
            const ctx = document.getElementById('eventParticipationChart').getContext('2d');
            
            // Check if there's data to display
            if (data.participants === 0 && data.volunteers === 0) {
                showErrorMessage('No participation data available for this event');
                return;
            }

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
            
            // Update batch distribution chart
            updateBatchDistributionChart(eventId);
        })
        .catch(error => {
            console.error('Error fetching event data:', error);
            showErrorMessage('Unable to load event data. Please try again.');
        });
}

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('eventSelect').addEventListener('change', function() {
        const selectedEventId = this.value;
        
        // Clear existing charts if no event is selected
        if (!selectedEventId) {
            if (participationChart) {
                participationChart.destroy();
            }
            if (batchDistributionChart) {
                batchDistributionChart.destroy();
            }
            showErrorMessage('Please select an event');
            return;
        }

        updateChart(selectedEventId);
    });
});
</script>