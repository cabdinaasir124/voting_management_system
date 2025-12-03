document.addEventListener("DOMContentLoaded", function() {
    fetchFinalResults();
});

function fetchFinalResults() {
    fetch('api/final_results_api.php')
        .then(res => res.json())
        .then(data => {
            if (!data.status) return;

            const container = document.getElementById('resultsContainer');
            container.innerHTML = '';

            data.results.forEach(position => {
                // Create position section
                const posDiv = document.createElement('div');
                posDiv.classList.add('position-section', 'mb-4');

                const title = document.createElement('h5');
                title.textContent = position.position_name;
                posDiv.appendChild(title);

                // Table of candidates
                const table = document.createElement('table');
                table.classList.add('table', 'table-striped');
                table.innerHTML = `
                    <thead>
                        <tr>
                            <th>Candidate</th>
                            <th>Votes</th>
                            <th>Winner</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${position.candidates.map(c => `
                            <tr>
                                <td>${c.name}</td>
                                <td>${c.votes}</td>
                                <td>${c.winner ? '✅' : ''}</td>
                            </tr>
                        `).join('')}
                    </tbody>
                `;
                posDiv.appendChild(table);

                // Append to container
                container.appendChild(posDiv);

                // Optional: Chart per position
                const canvas = document.createElement('canvas');
                canvas.id = 'chart-' + position.id;
                canvas.style.height = '250px';
                posDiv.appendChild(canvas);

                const ctx = canvas.getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: position.candidates.map(c => c.name),
                        datasets: [{
                            label: 'Votes',
                            data: position.candidates.map(c => c.votes),
                            backgroundColor: position.candidates.map(c => c.winner ? '#28a745' : '#007bff'),
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        animation: { duration: 1200 },
                        scales: { y: { beginAtZero: true } }
                    }
                });
            });
        })
        .catch(err => console.erraor(err));
}
