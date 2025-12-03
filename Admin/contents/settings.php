<div class="content-page">
    <div class="content">

        <div class="container-fluid mt-4">

            <div class="card shadow-sm">
                <div class="card-header pb-0">
                    <h4 class="card-title mb-0">System Settings</h4>
                </div>

                <div class="card-body">

                    <!-- Navigation Tabs -->
                    <ul class="nav nav-pills mb-3" id="settingsTabs" role="tablist">
                        <!-- <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="general-tab" data-bs-toggle="pill" data-bs-target="#general" type="button" role="tab">
                                General Settings
                            </button>
                        </li> -->
                        
                        <li class="nav-item" role="presentation">
                            <button class="nav-link bg-primary text-white" id="users-tab" data-bs-toggle="pill" data-bs-target="#users" type="button" role="tab">
                                User Management
                            </button>
                        </li>

                        <!-- <li class="nav-item" role="presentation">
                            <button class="nav-link" id="roles-tab" data-bs-toggle="pill" data-bs-target="#roles" type="button" role="tab">
                                Roles & Permissions
                            </button>
                        </li> -->

                        <!-- <li class="nav-item" role="presentation">
                            <button class="nav-link" id="system-tab" data-bs-toggle="pill" data-bs-target="#systemConfig" type="button" role="tab">
                                System Configuration
                            </button>
                        </li> -->

                        <!-- <li class="nav-item" role="presentation">
                            <button class="nav-link" id="notify-tab" data-bs-toggle="pill" data-bs-target="#notifications" type="button" role="tab">
                                Email / SMS
                            </button>
                        </li> -->

                        <!-- <li class="nav-item" role="presentation">
                            <button class="nav-link" id="backup-tab" data-bs-toggle="pill" data-bs-target="#backup" type="button" role="tab">
                                Backup & Restore
                            </button>
                        </li> -->
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content" id="settingsTabsContent">

                        <!-- GENERAL SETTINGS
                        <div class="tab-pane fade show active" id="general" role="tabpanel">
                            <h5 class="mb-3">General System Settings</h5>

                            <form id="generalSettingsForm">
                                <div class="mb-3">
                                    <label class="form-label">System Name</label>
                                    <input type="text" class="form-control" placeholder="AL-KAAMIL Voting System">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Institute Name</label>
                                    <input type="text" class="form-control" placeholder="Your School / Organization">
                                </div>

                                <button class="btn btn-primary">Save Changes</button>
                            </form>
                        </div> -->

                        <!-- USER MANAGEMENT -->
                        <div class="tab-pane fade" id="users" role="tabpanel">
                            <div class="card-header d-flex justify-content-between align-items-center">
                           <h5 class="mb-3">User Accounts</h5>

                            <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
                                Add New User
                            </button>
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Username</th>
                                        <th>Role</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="usersTableBody"></tbody>
                            </table>
                        </div>

                        <!-- ROLES & PERMISSIONS -->
                        <div class="tab-pane fade" id="roles" role="tabpanel">
                            <h5 class="mb-3">Roles & Permissions</h5>

                            <button class="btn btn-primary mb-3">Add New Role</button>

                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Administrator</span>
                                    <button class="btn btn-sm btn-outline-info">Manage</button>
                                </li>

                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Manager</span>
                                    <button class="btn btn-sm btn-outline-info">Manage</button>
                                </li>

                                <li class="list-group-item d-flex justify-content-between">
                                    <span>Viewer</span>
                                    <button class="btn btn-sm btn-outline-info">Manage</button>
                                </li>
                            </ul>
                        </div>

                        <!-- SYSTEM CONFIGURATION -->
                        <div class="tab-pane fade" id="systemConfig" role="tabpanel">
                            <h5 class="mb-3">System Configurations</h5>

                            <form>
                                <div class="mb-3">
                                    <label class="form-label">Timezone</label>
                                    <select class="form-select">
                                        <option>Africa/Mogadishu</option>
                                        <option>UTC</option>
                                        <option>Africa/Nairobi</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">System Mode</label>
                                    <select class="form-select">
                                        <option>Production</option>
                                        <option>Maintenance</option>
                                    </select>
                                </div>

                                <button class="btn btn-primary">Save</button>
                            </form>
                        </div>

                        <!-- EMAIL / SMS -->
                        <div class="tab-pane fade" id="notifications" role="tabpanel">
                            <h5 class="mb-3">Email / SMS Settings</h5>

                            <form>
                                <div class="mb-3">
                                    <label class="form-label">SMTP Host</label>
                                    <input type="text" class="form-control" placeholder="smtp.gmail.com">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">SMTP Username</label>
                                    <input type="text" class="form-control">
                                </div>

                                <button class="btn btn-primary">Save</button>
                            </form>
                        </div>

                        <!-- BACKUP -->
                        <div class="tab-pane fade" id="backup" role="tabpanel">
                            <h5 class="mb-3">Backup & Restore</h5>

                            <button class="btn btn-outline-primary mb-3">Download Backup</button>

                            <div class="alert alert-warning">
                                <strong>Note:</strong> Keep backups safely to prevent data loss.
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>

        <!-- Add User Modal -->
<div class="modal fade" id="addModal">
  <div class="modal-dialog">
    <form id="addUserForm" class="modal-content">
      <div class="modal-header"><h5>Add User</h5></div>
      <div class="modal-body">
        <input name="username" class="form-control mb-2" placeholder="Username" required>
        <input name="password" type="password" class="form-control mb-2" placeholder="Password" required>
        <select name="role" class="form-control">
          <option>admin</option>
          <option>staff</option>
        </select>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary">Save</button>
      </div>
    </form>
  </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editModal">
  <div class="modal-dialog">
    <form id="editUserForm" class="modal-content">
      <input type="hidden" name="id" id="edit_id">
      <div class="modal-header"><h5>Edit User</h5></div>
      <div class="modal-body">
        <input name="username" id="edit_username" class="form-control mb-2" required>
        <input name="password" id="edit_password" type="password" class="form-control mb-2" placeholder="Leave empty to keep old">
<select name="role" id="edit_role" class="form-control">
    <option value="admin">Admin</option>
    <option value="staff">Staff</option>
</select>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary">Update</button>
      </div>
    </form>
  </div>
</div>




    </div>
</div>

