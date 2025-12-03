<!-- Left Sidebar Start -->
<div class="app-sidebar-menu">
    <div class="h-100" data-simplebar>

        <div id="sidebar-menu">

          <div class="logo-box d-flex align-items-center p-2">

    <!-- CIRCLE LOGO -->
    <img src="assets/images/alkaamil_logo.jpeg" 
         alt="Logo" 
         class="sidebar-logo-circle">

    <!-- SCHOOL NAME -->
    <span class="sidebar-school-name ms-2">AL-KAAMIL MODERN</span>

</div>


            <ul id="side-menu">

                <li class="menu-title">Voting System</li>

                <li>
                    <a href="index.php" class="tp-link">
                        <i data-feather="home"></i>
                        <span> Dashboard </span>
                    </a>
                </li>

                <li>
                    <a href="#sidebarPositions" data-bs-toggle="collapse">
                        <i data-feather="briefcase"></i>
                        <span> Positions </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarPositions">
                        <ul class="nav-second-level">
                            <!-- <li><a href="positions-add.php" class="tp-link">Add Position</a></li> -->
                            <li><a href="positions-list.php" class="tp-link">Manage Positions</a></li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarCandidates" data-bs-toggle="collapse">
                        <i data-feather="users"></i>
                        <span> Candidates </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarCandidates">
                        <ul class="nav-second-level">
                            <!-- <li><a href="candidates-add.php" class="tp-link">Add Candidate</a></li> -->
                            <li><a href="candidates-list.php" class="tp-link">Manage Candidates</a></li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="#sidebarVoters" data-bs-toggle="collapse">
                        <i data-feather="user-check"></i>
                        <span> Voters </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarVoters">
                        <ul class="nav-second-level">
                            <!-- <li><a href="voters-add.php" class="tp-link">Add Voter</a></li> -->
                            <li><a href="voters-list.php" class="tp-link">Manage Voters</a></li>
                            <li><a href="voters-import.php" class="tp-link">Import Voters (Excel)</a></li>
                        </ul>
                    </div>
                </li>

                <li>
                    <a href="start-election.php" id="startVoting" class="tp-link">
                        <i data-feather="play-circle"></i>
                        <span> Start Election </span>
                    </a>
                </li>

                <li>
                    <a href="live-results.php" class="tp-link">
                        <i data-feather="bar-chart"></i>
                        <span> Live Results </span>
                    </a>
                </li>
                <li> 
    <a href="live-results-grid.php" class="tp-link">
        <i data-feather="bar-chart"></i>
        <span> Live Results Grid </span>
        <span class="badge bg-success ms-2">New</span>
    </a>
</li>


                <li>
                    <a href="final-results.php" class="tp-link">
                        <i data-feather="award"></i>
                        <span> Final Results </span>
                    </a>
                </li>

                <li class="menu-title mt-2">System</li>

                <li>
                    <a href="settings.php" class="tp-link">
                        <i data-feather="settings"></i>
                        <span> Settings </span>
                    </a>
                </li>

                <li>
                    <a href="../Auth/logout.php" class="tp-link">
                        <i data-feather="log-out"></i>
                        <span> Logout </span>
                    </a>
                </li>

            </ul>

        </div>

       <!-- Sidebar Footer / App Info -->
<hr class="my-3">

<div class="px-3 mb-3 text-center">

    <!-- Badge -->
    <div class="mb-2">
        <span class="badge bg-primary-subtle text-primary fw-semibold rounded-pill py-1 px-2">
            Developer Edition
        </span>
    </div>

    <!-- App/Site Info -->
    <p class="mb-1 text-muted fs-12">AL-KAAMIL MODERN</p>
    <p class="mb-1 text-muted fs-12">Built by <strong>Eng. Abdinaasir Moha</strong></p>
    <p class="mb-0 text-muted fs-12">Version 1.0.0</p>

    <!-- Upgrade Button -->
    <a href="upgrade.php" class="btn btn-sm btn-success mt-2 w-100">
        Upgrade Now
    </a>
</div>



        <div class="clearfix"></div>

    </div>
</div>
<!-- Left Sidebar End -->
