<!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">

                    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                        <div class="flex-grow-1">
                            <h4 class="fs-18 fw-semibold m-0">Projects</h4>
                        </div>
                    </div>

                    <!-- Start Quick Stats Row -->
<div class="row">
    <div class="col-md-12">
        <div class="row">

            <!-- TOTAL VOTERS -->
            <div class="col-md-6 col-xl-3">
    <div class="card overflow-hidden">
        <div class="card-body">
            <div class="widget-first">

                <div class="d-flex align-items-center mb-1">
                    <span class="avatar-md rounded-circle bg-gray d-flex justify-content-center align-items-center me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24">
                            <path fill="#108dff" d="M12 12a5 5 0 1 0-5-5a5 5 0 0 0 5 5m-7.5 8a7.5 7.5 0 0 1 15 0z"/>
                        </svg>
                    </span>

                    <div>
                        <p class="mb-2 text-dark fs-15 fw-medium">Total Voters</p>
                        <h3 class="mb-0 fs-22 text-dark me-3" id="totalVoters">0</h3>
                    </div>
                </div>

                <div class="d-flex align-items-center mt-3 justify-content-between">
                    <p class="mb-0 text-dark mt-1">New This Week</p>
                    <span class="text-success px-2 py-1 bg-success-subtle rounded-4" id="newThisWeek">+0%</span>
                </div>

            </div>
        </div>
    </div>
</div>


            <!-- TOTAL CANDIDATES -->
            <div class="col-md-6 col-xl-3">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="widget-first">

                            <div class="d-flex align-items-center mb-1">
                                <span class="avatar-md rounded-circle bg-gray d-flex justify-content-center align-items-center me-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24">
                                        <path fill="#287F71" d="M12 12a3 3 0 1 0-3-3a3 3 0 0 0 3 3m-7 8c0-3.87 3.13-7 7-7s7 3.13 7 7z"/>
                                    </svg>
                                </span>

                                <div>
                                    <p class="mb-2 text-dark fs-15 fw-medium">Total Candidates</p>
                                    <h3 id="totalCandidates" class="mb-0 fs-22 text-dark me-3">0</h3>
                             </div>
                            </div>

                            <div class="d-flex align-items-center mt-3 justify-content-between">
                                <p class="mb-0 text-dark mt-1">Positions Covered</p>
                                <span id="positionsPercentage" class="text-success px-2 py-1 bg-success-subtle rounded-4">0%</span>
                               </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- TOTAL POSITIONS -->
            <div class="col-md-6 col-xl-3">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="widget-first">

                            <div class="d-flex align-items-center mb-1">
                                <span class="avatar-md rounded-circle bg-gray d-flex justify-content-center align-items-center me-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24">
                                        <path fill="#E77636" d="M4 4h16v2H4zm2 4h12v2H6zm-2 4h16v2H4zm2 4h12v2H6z"/>
                                    </svg>
                                </span>

                                <div>
                                    <p class="mb-2 text-dark fs-15 fw-medium">Total Positions</p>
                                    <h3 class="mb-0 fs-22 text-dark me-3" id="totalPositions">5</h3>
                              </div>
                            </div>

                            <div class="d-flex align-items-center mt-3 justify-content-between">
                                <p class="mb-0 text-dark mt-1">New Positions</p>
                                <span class="text-danger px-2 py-1 bg-danger-subtle rounded-4" id="newPositions">0</span>
                              </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- TOTAL VOTES CAST -->
            <div class="col-md-6 col-xl-3">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="widget-first">

                            <div class="d-flex align-items-center mb-1">
                                <span class="avatar-md rounded-circle bg-gray d-flex justify-content-center align-items-center me-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24">
                                        <path fill="#963b68" d="M12 2L2 7l10 5l10-5zm0 13L2 10l10 5l10-5zm0 8l-10-5l10 5l10-5z"/>
                                    </svg>
                                </span>

                                <div>
                                    <p class="mb-2 text-dark fs-15 fw-medium">Votes Cast</p>
                                    <h3 class="mb-0 fs-22 text-dark me-3" id="votesCast">0</h3>                                </div>
                            </div>

                            <div class="d-flex align-items-center mt-3 justify-content-between">
                                <p class="mb-0 text-dark mt-1">Turnout Rate</p>
                                <span class="text-success px-2 py-1 bg-success-subtle rounded-4" id="turnoutRate">0%</span>                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- End Quick Stats -->

                <!-- CHARTS ROW -->
<div class="row">

   <div class="row g-3 align-items-stretch">
   <div class="col-xl-6 col-md-12 mb-3">
    <div class="card shadow-sm rounded-4 h-100">
        <div class="card-header bg-primary text-white rounded-top">
            <h4 class="mb-0 fs-17">Votes Per Candidate</h4>
        </div>
        <div class="card-body">
            <canvas id="candidateVotesChart"></canvas>
        </div>
    </div>
</div>

<div class="col-xl-6 col-md-12 mb-3">
    <div class="card shadow-sm rounded-4 h-100">
        <div class="card-header bg-primary text-white rounded-top">
            <h4 class="mb-0 fs-17">Votes Per Position</h4>
        </div>
        <div class="card-body">
            <canvas id="positionVotesChart"></canvas>
        </div>
    </div>
</div>

</div>

</div>

<!-- Second Row -->
<div class="row mt-3">

    <!-- Voter Turnout -->
    <div class="col-xl-12 mb-3">
        <div class="card shadow-sm rounded-4">
            <div class="card-header bg-primary text-white rounded-top">
                <h4 class="mb-0 fs-17">Voter Turnout (Hourly)</h4>
            </div>
            <div class="card-body">
                <canvas id="turnoutChart" style="height: 100px;"></canvas>
            </div>
        </div>
    </div>

</div>


        </div> <!-- container-fluid -->
    </div> <!-- content -->
</div>
<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->