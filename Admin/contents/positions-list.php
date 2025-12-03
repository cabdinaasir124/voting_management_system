<div class="content-page">
    <div class="content">
        <div class="container-fluid mt-1">

            <!-- Positions Management Card -->
            <div class="row mt-3">
                <div class="col-12">
                    <div class="card shadow-sm ">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Manage Positions</h5>
                            <div class="d-flex gap-2">
                                <input id="searchInput" class="form-control form-control-sm" placeholder="Search positions..." style="width:180px;">
                                <select id="perPage" class="form-select form-select-sm" style="width:90px;">
                                    <option value="5">5</option>
                                    <option value="10" selected>10</option>
                                    <option value="25">25</option>
                                </select>
                                <button id="btnAdd" class="btn btn-primary btn-sm rounded">+ Add Position</button>
                                <button id="btnExport" class="btn btn-success btn-sm rounded">Export CSV</button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div id="positionsArea"></div>
                            <nav>
                                <ul id="pagination" class="pagination justify-content-center mt-3"></ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add/Edit Modal -->
            <div class="modal fade" id="positionModal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header" style="background: linear-gradient(90deg,#7366ff,#a566ff); color:#fff;">
                            <h5 class="modal-title" id="modalTitle">Add Position</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="positionForm">
                                <input type="hidden" name="id" id="pos_id">
                                <div class="mb-3">
                                    <label class="form-label">Position Name</label>
                                    <input type="text" class="form-control" id="position_name" name="position_name" required>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col">
                                        <label class="form-label">Max Candidates</label>
                                        <input type="number" class="form-control" id="max_candidates" name="max_candidates" value="1" min="1">
                                    </div>
                                    <div class="col">
                                        <label class="form-label">Priority</label>
                                        <input type="number" class="form-control" id="priority" name="priority" value="1" min="1">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="status" checked>
                                    <label class="form-check-label">Active</label>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary rounded" data-bs-dismiss="modal">Cancel</button>
                            <button id="saveBtn" type="button" class="btn btn-primary rounded">Save</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

