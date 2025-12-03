document.addEventListener("DOMContentLoaded", () => {
    fetch("api/get_candidates-grids.php")
        .then(res => res.json())
        .then(data => {
            const row = document.getElementById("voteRow");
            row.innerHTML = "";

            data.forEach((item, index) => {

                let imagePath = item.image ? `uploads/${item.image}` : "assets/no-img.png";

              row.innerHTML += `
    <div class="col-12 col-md-6 col-lg-4">
        <div class="vote-card shadow-sm">
            <div class="card-number">${index + 1}</div>

            <img src="${imagePath}" 
                class="rounded-circle border border-2 mb-3" 
                alt="Candidate" 
                style="height: 90px; margin-top:20px; width: 90px; object-fit: cover;">

            <div class="d-flex align-items-center gap-3">
                <div>
                    <div class="candidate-name">${item.name}</div>

                    <div class="d-flex gap-3 mt-2">
                        <span class="tag-green">Ku Hogaaminaya</span>
                        <span class="tag-gray">${item.position}</span>
                    </div>

                    <div class="d-flex justify-content-between mt-2 align-items-center w-100">
                        <small>${item.votes} votes</small>

                        <div class="text-end">
                            <span class="tag-blue">Liiska Furan</span>
                            <small class="fw-bold text-success">${item.percentage}%</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="progress">
                <div class="progress-bar bg-success uumi" data-width="${item.percentage}"></div>
            </div>
        </div>
    </div>
`;

            });

            animateBars();
        });
});

function animateBars() {
    const bars = document.querySelectorAll(".uumi");
    bars.forEach(bar => {
        const width = bar.getAttribute("data-width");
        setTimeout(() => {
            bar.style.width = width + "%";
        }, 200);
    });
}
