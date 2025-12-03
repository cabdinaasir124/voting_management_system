<!-- Start Content-->
<div class="content-page">
    <div class="content"> 
<div class="container-fluid md-8">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Al-kaamil</a></li>
                        <li class="breadcrumb-item"><a href="../includes/index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Election</li>
                    </ol>
                </div>
                <h4 class="page-title">Voters</h4>
            </div>
        </div>
    </div>    
    <div class="card">
    <div class="card-header d-flex justify-content-between items-center">
        <h3 class="text-primary">Voters list is here</h3>
        <select id="classFilter" class="form-select w-auto">
            <option value="">All Classes</option>
            <option value="Form One">Form One</option>
            <option value="Form Two">Form Two</option>
            <option value="Form Three">Form Three</option>
            <option value="Form Four">Form Four</option>
            <option value="Grade Eight">Grade Eight</option>
            <option value="Grade Seven">Grade Seven</option>
        </select>
    </div>

    <div class="card-body">
        <table id="basic-datatable" class="table table-bordered table-striped dt-responsive nowrap w-100">
            <thead class="table-primary text-white">
                <tr>
                    <th>Voter ID</th>
                    <th>Full Name</th>
                    <th>Class</th>
                    <th>Password</th>
                    <th>Created At</th>
                    <!-- <th>Edit</th>
                    <th>Delete</th> -->
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

    </div>
    </div>
    </div>