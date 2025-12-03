document.addEventListener("DOMContentLoaded", function() {
    fetchDashboardStats();
});

function fetchDashboardStats() {
    fetch('api/dashboard_api.php')
        .then(res => res.json())
        .then(data => {
            if(data.status){
                // Voters
                document.getElementById('totalVoters').innerText = data.voters.total;
                document.getElementById('newThisWeek').innerText = `+${data.voters.new_week}%`;

                // Candidates
                document.getElementById('totalCandidates').innerText = data.candidates.total;
                document.getElementById('positionsPercentage').innerText = `${data.candidates.percentage}%`;

                // Positions
                document.getElementById('totalPositions').innerText = data.positions.total;
                document.getElementById('newPositions').innerText = `+${data.positions.new_week}`;

                // Votes
                document.getElementById('votesCast').innerText = data.votes.total;
                document.getElementById('turnoutRate').innerText = `${data.votes.turnout}%`;

            } else {
                console.error(data.message);
            }
        })
        .catch(err => console.error(err));
}

document.addEventListener("DOMContentLoaded", function() {
    fetchCandidateVotesChart();
});

function fetchCandidateVotesChart() {
    fetch('api/dashboard_api.php')
        .then(res => res.json())
        .then(data => {
            if (!data.status) return;

            // Combine president and vice president votes
            const allCandidates = [
                ...(data.votes.president || []),
                ...(data.votes.vice_president || [])
            ];

            if (allCandidates.length === 0) {
                console.warn("No candidate votes found!");
                return;
            }

            // Labels and votes
            const labels = allCandidates.map(c => c.full_name);
            const votesData = allCandidates.map(c => parseInt(c.votes));

            // Destroy previous chart if exists (prevents overlapping)
            if (window.candidateVotesChartInstance) {
                window.candidateVotesChartInstance.destroy();
            }

            // Render chart
            const ctx = document.getElementById('candidateVotesChart').getContext('2d');
            window.candidateVotesChartInstance = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Votes',
                        data: votesData,
                        backgroundColor: labels.map((_, i) => i % 2 === 0 ? '#007bff' : '#28a745'),
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    animation: { duration: 1200 },
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });

        })
        .catch(err => console.error(err));
}


document.addEventListener("DOMContentLoaded", function() {
    fetchPositionVotesChart();
});

function fetchPositionVotesChart() {
    fetch('api/dashboard_api.php')
        .then(res => res.json())
        .then(data => {
            if (!data.status || !data.votes.per_position) return;

            const positions = data.votes.per_position;

            const labels = positions.map(p => p.position_name);
            const votesData = positions.map(p => p.votes);

            // Destroy previous chart if exists
            if (window.positionVotesChartInstance) {
                window.positionVotesChartInstance.destroy();
            }

            const ctx = document.getElementById('positionVotesChart').getContext('2d');
            window.positionVotesChartInstance = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: votesData,
                        backgroundColor: [
                            '#007bff','#28a745','#ffc107','#dc3545',
                            '#6f42c1','#20c997','#fd7e14'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    animation: { duration: 1200 },
                    plugins: { legend: { position: 'bottom' } }
                }
            });
        })
        .catch(err => console.error(err));
}

document.addEventListener("DOMContentLoaded", function() {
    fetchVoterTurnoutChart();
});

function fetchVoterTurnoutChart() {
    fetch('api/dashboard_api.php')
        .then(res => res.json())
        .then(data => {
            if (!data.status || !data.votes.hourly_turnout) return;

            const turnout = data.votes.hourly_turnout;

            const labels = turnout.map(t => t.hour);       // 12 AM, 1 AM, ...
            const votersData = turnout.map(t => t.voters); // Number of voters

            // Destroy previous chart if exists
            if (window.turnoutChartInstance) {
                window.turnoutChartInstance.destroy();
            }

            const ctx = document.getElementById('turnoutChart').getContext('2d');
            window.turnoutChartInstance = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Voters',
                        data: votersData,
                        borderWidth: 3,
                        borderColor: '#007bff',
                        backgroundColor: 'rgba(0,123,255,0.1)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    animation: { duration: 1500 },
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });
        })
        .catch(err => console.error(err));
}

// Call on DOM load
document.addEventListener("DOMContentLoaded", function() {
    fetchVoterTurnoutChart();
});

