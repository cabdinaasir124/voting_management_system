
<style>
.custom-radio input[type="radio"] {
    display: none;
}
.custom-radio .custom-control-label {
    display: inline-block;
    width: 23px;
    height: 23px;
    border: 2px solid #007bff;
    border-radius: 50%;
    background-color: #fff;
    position: relative;
    cursor: pointer;
}
.custom-radio input[type="radio"]:checked + .custom-control-label::after {
    content: "";
    width: 10px;
    height: 10px;
    background-color: #007bff;
    border-radius: 50%;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
.candidate-card img {
    height: 150px;
    width: 150px;
    object-fit: cover;
    margin-bottom: 15px;
}
</style>
<div class="content-page">
    <div class="content">
     <!-- Start Content-->
    <div class="container-fluid md-8 mt-3">
<div class="container my-5">

    <!-- Step 1: President -->
    <div id="presidentSection">
        <div class="p-cand" style="display: flex; justify-content:space-between;">
        <h3>Select President</h3>
        <button class="btn btn-success mt-3" id="submitPresident">Next</button>
        </div>
        <div class="row" id="presidentCandidates"></div>
    </div>

    <!-- Step 2: Vice President -->
    <div id="viceSection" style="display:none">
         <div class="vice-president" style="display: flex; justify-content:space-between;">
<h3>Select Vice President</h3>
        <button class="btn btn-success mt-3" id="submitVice">Next</button>
         </div>
        <div class="row" id="viceCandidates"></div>
    </div>

</div>

<!-- Step 3: Voter Modal -->
<div class="modal fade" id="voterModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content p-3">
            <h5>Enter Your Credentials</h5>
            <label for="">Enter your Voter ID</label>
            <input type="text" id="voterId" class="form-control mb-2" placeholder="Voter ID">
            <label for="">Enter your PIN</label>
            <input type="password" id="voterPin" class="form-control mb-2" placeholder="PIN/Password">
            <button class="btn btn-primary w-100" id="submitCredentials">Submit Vote</button>
        </div>
    </div>
</div>


