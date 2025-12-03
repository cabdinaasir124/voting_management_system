function fetchVotes() {
    $.ajax({
        url: "api/live_results_Api.php",
        method: "GET",
        dataType: "json",
        success: function(response) {

            let candidates = response.candidates;
            let totalVotes = response.totalVotes;

            let presidentHTML = "";
            let viceHTML = "";

            candidates.forEach(function(c) {

                let percentage = totalVotes > 0 ? Math.round((c.votes / totalVotes) * 100) : 0;
                let chartId = "chart-" + c.id;
                let imagePath = c.image ? `uploads/${c.image}` : "assets/no-img.png";

                let cardHTML = `
                <div class="col-lg-4 col-md-6">
                    <div class="card candidate-card shadow-sm p-3">

                        <div class="progress-container mb-3">
                            <canvas id="${chartId}"></canvas>
                            <div class="progress-text">${percentage}%</div>
                            <img src="${imagePath}" class="candidate-image" alt="${c.full_name}">
                        </div>

                        <h5 class="text-center fw-bold mb-3">${c.full_name}</h5>

                        <div class="text-start">
                            <p><strong>Candidate ID:</strong> ${c.id}</p>
                            <hr class="info-divider">
                            <p><strong>Position:</strong> ${c.position}</p>
                            <hr class="info-divider">
                            <p><strong>Total Votes:</strong> ${c.votes}</p>
                            <hr class="info-divider">
                            <p class="fw-bold ${c.votes > 0 ? 'text-success' : 'text-danger'}">
                                Votes: ${c.votes}
                            </p>
                        </div>

                    </div>
                </div>
                `;

                // Split by Position
                if (c.position.toLowerCase() === "president") {
                    presidentHTML += cardHTML;
                } else if (c.position.toLowerCase() === "vice-president" || c.position.toLowerCase() === "vice president") {
                    viceHTML += cardHTML;
                }
            });

            // Inject HTML
            $("#presidentGrid").html(presidentHTML);
            $("#viceGrid").html(viceHTML);

            // Render charts
            candidates.forEach(function(c) {
                let percentage = totalVotes > 0 ? Math.round((c.votes / totalVotes) * 100) : 0;

                let canvas = document.getElementById("chart-" + c.id);
                if (!canvas) return;

                let ctx = canvas.getContext("2d");

                new Chart(ctx, {
                    type: "doughnut",
                    data: {
                        labels: ["Votes", "Remaining"],
                        datasets: [{
                            data: [percentage, 100 - percentage],
                            backgroundColor: ["#28a745", "#ddd"],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        cutout: "70%",
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { display: false },
                            tooltip: { enabled: false }
                        }
                    }
                });
            });
        },
        error: function(err) {
            console.error(err);
        }
    });
}

setInterval(fetchVotes, 3000);
$(document).ready(fetchVotes);
