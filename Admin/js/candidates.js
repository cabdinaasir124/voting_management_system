document.addEventListener("DOMContentLoaded", function () {

    // ==============================================================  
    // 1️⃣ Load Positions into Dropdown
    // ==============================================================  
    loadPositions();

    function loadPositions() {
        fetch("api/candidates_api.php?action=get_positions")
            .then(res => res.json())
            .then(data => {
                let options = `<option value="">Select Position</option>`;
                if (data.status) {
                    data.data.forEach(pos => {
                        options += `<option value="${pos.id}">${pos.position_name}</option>`;
                    });
                }
                document.querySelector("select[name='position']").innerHTML = options;
            })
            .catch(err => console.error("Error loading positions:", err));
    }

    // ==============================================================  
    // 2️⃣ Load All Candidates as Cards
    // ==============================================================  
    loadCandidates();

    function loadCandidates() {
        fetch("api/candidates_api.php?action=get_candidates")
            .then(res => res.json())
            .then(data => {
                let html = "";

                if (data.status && data.data.length > 0) {
                    data.data.forEach(c => {
let imagePath = c.image ? `uploads/${c.image}` : "assets/no-img.png";

html += `
<div class="col-lg-4 col-md-6 mb-4">
    <div class="card text-center shadow-sm rounded-4 h-100">
        <div class="card-body">
            <div class="position-relative">
                <img src="${imagePath}" 
                     class="rounded-circle border border-2 mb-3" 
                     alt="Candidate" 
                     style="height: 150px; width: 150px; object-fit: cover;">
            </div>
            <h5 class="card-title text-center fw-bold">${c.full_name}</h5>
            <div class="card-text text-start mt-3">
                <p><strong>Age:</strong> ${c.age}</p>
                <hr style="margin:5px 0;">
                <p><strong>Sex:</strong> ${c.sex}</p>
                <hr style="margin:5px 0;">
                <p><strong>Position:</strong> ${c.position_name}</p>
                <hr style="margin:5px 0;">
                <p class="text-success"><strong>Status:</strong> ${c.status == 1 ? 'Active' : 'Inactive'}</p>
                <hr style="margin:5px 0;">
                <div class="d-flex justify-content-between mt-3">
                    <button class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</button>
                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>`;



                    });
                } else {
                    html = `<div class="col-12 text-center mt-4"><p class="text-muted">No candidates found.</p></div>`;
                }

                document.getElementById("cardBody").innerHTML = html;
            })
            .catch(err => console.error("Error loading candidates:", err));
    }

    // ==============================================================  
    // 3️⃣ Add Candidate (Submit Form)
    // ==============================================================  
    document.getElementById("CandidateF").addEventListener("submit", function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        fetch("api/candidates_api.php?action=add_candidate", {
            method: "POST",
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.status) {
                alert("Candidate saved successfully!");
                this.reset();
                loadCandidates();  // Reload cards
                document.querySelector(".btn-close").click();
            } else {
                alert(data.message || "Failed to save candidate.");
            }
        })
        .catch(err => console.error("Error adding candidate:", err));
    });

});
