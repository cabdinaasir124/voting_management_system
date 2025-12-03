// Fetch candidates
// 🔊 VOICE FILES
const soundPresidentIntro = new Audio("assets/sounds/gudoomiye_dooro.mp4");
const soundPresidentError = new Audio("assets/sounds/fadlan_door_gudoomiye.mp4");

const soundViceIntro = new Audio("assets/sounds/gudoomiye_kuxigeen_dooro.mp4");
const soundViceError = new Audio("assets/sounds/fadlan_dooro_g_kuxigeen.mp4");

async function fetchCandidates() {
    const res = await fetch('api/get_candidates.php');
    const data = await res.json();





    const presidentContainer = document.getElementById('presidentCandidates');
    const viceContainer = document.getElementById('viceCandidates');

    presidentContainer.innerHTML = '';
    viceContainer.innerHTML = '';

    // Presidents
    data.president.forEach(c => {
        let imagePath = c.image ? `uploads/${c.image}` : "assets/no-img.png";

        presidentContainer.innerHTML += `
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card p-3 shadow-sm text-center candidate-card">
                <div class="d-flex justify-content-center mb-2">
                    <img src="${imagePath}" 
                         class="rounded-circle" 
                         style="width:100px;height:100px;object-fit:cover;" 
                         alt="${c.full_name}">
                </div>
                <h5>${c.full_name}</h5>

                <table class="table table-sm table-borderless mb-2">
                    <tbody>
                        <tr style="border-bottom:1px solid #ddd;">
                            <th class="p-1 text-start">ID</th>
                            <td class="p-1 text-end">${c.id}</td>
                        </tr>
                        <tr style="border-bottom:1px solid #ddd;">
                            <th class="p-1 text-start">Position ID</th>
                            <td class="p-1 text-end">${c.position_id}</td>
                        </tr>
                        <tr>
                            <th class="p-1 text-start">Age</th>
                            <td class="p-1 text-end">${c.age}</td>
                        </tr>
                    </tbody>
                </table>

                <label class="btn btn-primary w-100 mt-1 d-flex justify-content-between align-items-center custom-radio">
                    <span>Codee</span>
                    <input type="radio" name="president" value="${c.id}">
                    <span class="custom-control-label"></span>
                </label>
            </div>
        </div>`;
    });

    // Vice Presidents
    data.vice.forEach(c => {
        let imagePath = c.image ? `uploads/${c.image}` : "assets/no-img.png";

        viceContainer.innerHTML += `
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card p-3 shadow-sm text-center candidate-card">
                <div class="d-flex justify-content-center mb-2">
                    <img src="${imagePath}" 
                         class="rounded-circle" 
                         style="width:100px;height:100px;object-fit:cover;" 
                         alt="${c.full_name}">
                </div>
                <h5>${c.full_name}</h5>

                <table class="table table-sm table-borderless mb-2">
                    <tbody>
                        <tr style="border-bottom:1px solid #ddd;">
                            <th class="p-1 text-start">ID</th>
                            <td class="p-1 text-end">${c.id}</td>
                        </tr>
                        <tr style="border-bottom:1px solid #ddd;">
                            <th class="p-1 text-start">Position ID</th>
                            <td class="p-1 text-end">${c.position_id}</td>
                        </tr>
                        <tr>
                            <th class="p-1 text-start">Age</th>
                            <td class="p-1 text-end">${c.age}</td>
                        </tr>
                    </tbody>
                </table>

                <label class="btn btn-primary w-100 mt-1 d-flex justify-content-between align-items-center custom-radio">
                    <span>Codee</span>
                    <input type="radio" name="vice" value="${c.id}">
                    <span class="custom-control-label"></span>
                </label>
            </div>
        </div>`;
    });
}

fetchCandidates();

    // Play intro sound automatically when page opens
// Add a "Start Voting" button in your page somewhere
const buttons = document.getElementsByClassName('startVoting');

Array.from(buttons).forEach(btn => {
    btn.addEventListener('click', (e) => {
        e.preventDefault();

        soundPresidentIntro.currentTime = 0;
        soundPresidentIntro.play();

        document.getElementById('presidentSection').style.display = 'block';
    });
});




// Step 1: President Next
document.getElementById('submitPresident').addEventListener('click', () => {
    const selected = document.querySelector('input[name="president"]:checked');

    if (!selected) {
        soundPresidentIntro.play(); // 🔊 Play error voice
        Swal.fire({ icon:'warning', title:'Fadlan dooro Gudoomiye' });
        return;
    }

    // Switch to Vice section
    document.getElementById('presidentSection').style.display = 'none';
    document.getElementById('viceSection').style.display = 'block';

    // 🔊 Auto play intro sound for Vice section
    soundViceIntro.play();
});

// Step 2: Vice President Next
document.getElementById('submitVice').addEventListener('click', () => {
    const selected = document.querySelector('input[name="vice"]:checked');

    if (!selected) {
        soundViceError.play(); // 🔊 Error voice
        Swal.fire({ icon:'warning', title:'Fadlan dooro Gudoomiye ku-xigeenka' });
        return;
    }

    new bootstrap.Modal(document.getElementById('voterModal')).show();
});

// Step 3: Submit Vote
document.getElementById('submitCredentials').addEventListener('click', () => {
    const voterId = document.getElementById('voterId').value.trim();
    const voterPin = document.getElementById('voterPin').value.trim();
    const presidentId = document.querySelector('input[name="president"]:checked')?.value;
    const viceId = document.querySelector('input[name="vice"]:checked')?.value;

    if(!voterId || !voterPin){ Swal.fire({icon:'warning', title:'Fadlan buuxi xogtaada'}); return; }
    if(!presidentId || !viceId){ Swal.fire({icon:'warning', title:'Fadlan dooro codkaaga'}); return; }

    fetch('api/cast_vote_api.php', {
        method:'POST',
        headers:{'Content-Type':'application/json'},
        body: JSON.stringify({ voterId, voterPin, presidentId, viceId })
    })
    .then(res=>res.json())
    .then(data=>{
        if(data.success){
            Swal.fire({icon:'success', title:'Codkaaga waa la diiwaangeliyey', text:data.message}).then(()=>{
                bootstrap.Modal.getInstance(document.getElementById('voterModal')).hide();
                document.getElementById('presidentSection').style.display='block';
                document.getElementById('viceSection').style.display='none';
                document.querySelectorAll('input[type=radio]').forEach(r=>r.checked=false);
                document.getElementById('voterId').value='';
                document.getElementById('voterPin').value='';
            });
        } else {
            Swal.fire({icon:'error', title:'Khalad', text:data.message});
        }
    })
    .catch(err=>{
        Swal.fire({icon:'error', title:'Khalad', text:'Waxbaa qaldamay!'});
        console.error(err);
    });
});
