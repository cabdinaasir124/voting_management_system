const apiUrl = 'api/positions_api.php';
let currentPage = 1;
let currentSort = 'priority';
let currentOrder = 'ASC';
let currentPerPage = 10;

// Load positions
function loadPositions(page=1) {
    const search = document.getElementById('searchInput').value;
    currentPerPage = document.getElementById('perPage').value;

    fetch(`${apiUrl}?action=list&page=${page}&per_page=${currentPerPage}&sort=${currentSort}&order=${currentOrder}&search=${encodeURIComponent(search)}`)
        .then(r => r.json())
        .then(resp => {
            if (resp.status !== 'success') return;
            renderTable(resp.data);
            renderPagination(resp.total, resp.page, resp.per_page);
        });
}

// Render table
function renderTable(rows) {
    let html = `<div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Position Name</th>
                    <th>Max Candidates</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>`;

    if (!rows.length) html += '<tr><td colspan="7" class="text-center">No positions found</td></tr>';

    rows.forEach((r,i)=>{
        html += `<tr>
            <td>${i+1}</td>
            <td>${escapeHtml(r.position_name)}</td>
            <td>${r.max_candidates}</td>
            <td>${r.priority}</td>
            <td>${r.status==1?'<span class="badge bg-success">Active</span>':'<span class="badge bg-danger">Inactive</span>'}</td>
            <td>${new Date(r.created_at).toLocaleDateString()}</td>
            <td>
                <button class="btn btn-sm btn-primary me-1" onclick="openEdit(${r.id})">Edit</button>
                <button class="btn btn-sm btn-danger" onclick="doDelete(${r.id})">Delete</button>
            </td>
        </tr>`;
    });

    html += `</tbody></table></div>`;
    document.getElementById('positionsArea').innerHTML = html;
}

// Render pagination
function renderPagination(total, page, per_page) {
    const pages = Math.ceil(total/per_page) || 1;
    let html = '';
    for (let i=1;i<=pages;i++) {
        html += `<li class="page-item ${i==page?'active':''}">
            <a class="page-link" href="#" onclick="loadPositions(${i});return false;">${i}</a>
        </li>`;
    }
    document.getElementById('pagination').innerHTML = html;
}

// Escape HTML
function escapeHtml(text) {
    if (!text) return '';
    return text.replace(/[&<>\"']/g, m => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m]));
}

// Add button
document.getElementById('btnAdd').addEventListener('click', ()=>{
    document.getElementById('positionForm').reset();
    document.getElementById('pos_id').value = '';
    document.getElementById('modalTitle').innerText = 'Add Position';
    new bootstrap.Modal(document.getElementById('positionModal')).show();
});

// Save Add/Edit
document.getElementById('saveBtn').addEventListener('click', ()=>{
    const id = document.getElementById('pos_id').value;
    const payload = {
        position_name: document.getElementById('position_name').value.trim(),
        max_candidates: document.getElementById('max_candidates').value,
        priority: document.getElementById('priority').value,
        description: document.getElementById('description').value,
        status: document.getElementById('status').checked ? '1' : '0'
    };
    if (!payload.position_name) {
        Swal.fire({
            icon: 'warning',
            title: 'Required',
            text: 'Position name is required!'
        });
        return;
    }

    const action = id ? 'edit' : 'add';
    if (id) payload.id = id;

    fetch(`${apiUrl}?action=${action}`, {
        method: 'POST',
        headers: {'Content-Type':'application/json'},
        body: JSON.stringify(payload)
    })
    .then(r => r.json())
    .then(resp => {
        if (resp.status === 'success') {
            bootstrap.Modal.getInstance(document.getElementById('positionModal')).hide();
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: `Position ${action==='add'?'added':'updated'} successfully`,
                timer: 1500,
                showConfirmButton: false
            });
            loadPositions(currentPage);
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: resp.message || 'Something went wrong'
            });
        }
    });
});

// Open Edit
function openEdit(id) {
    fetch(`${apiUrl}?action=get&id=${id}`).then(r => r.json()).then(resp => {
        if (resp.status === 'success') {
            const r = resp.data;
            document.getElementById('pos_id').value = r.id;
            document.getElementById('position_name').value = r.position_name;
            document.getElementById('max_candidates').value = r.max_candidates;
            document.getElementById('priority').value = r.priority;
            document.getElementById('description').value = r.description;
            document.getElementById('status').checked = (r.status==1);
            document.getElementById('modalTitle').innerText = 'Edit Position';
            new bootstrap.Modal(document.getElementById('positionModal')).show();
        } else Swal.fire({icon:'error', title:'Error', text:'Position not found'});
    });
}

// Delete with SweetAlert
function doDelete(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "This action cannot be undone!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`${apiUrl}?action=delete&id=${id}`)
            .then(r => r.json())
            .then(resp => {
                if (resp.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: 'Position has been deleted.',
                        timer: 1500,
                        showConfirmButton: false
                    });
                    loadPositions(currentPage);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed!',
                        text: 'Delete operation failed.'
                    });
                }
            });
        }
    });
}

// Export CSV
document.getElementById('btnExport').addEventListener('click', ()=>{
    const search = document.getElementById('searchInput').value;
    window.location = `${apiUrl}?action=export&search=${encodeURIComponent(search)}`;
});

// Search & PerPage
let searchTimeout;
document.getElementById('searchInput').addEventListener('input', ()=>{
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(()=>{ currentPage=1; loadPositions(1); }, 400);
});
document.getElementById('perPage').addEventListener('change', ()=>loadPositions(1));

// Init
loadPositions(1);
