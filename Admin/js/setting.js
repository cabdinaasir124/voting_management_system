document.addEventListener("DOMContentLoaded", () => {
    loadUsers();
});

/* FETCH USERS */
function loadUsers() {
    fetch("api/setting_api.php?action=fetch")
        .then(res => res.json())
        .then(data => {
            let table = "";
            data.data.forEach((u, i) => {
                table += `
                    <tr>
                        <td>${i + 1}</td>
                        <td>${u.username}</td>
                        <td>${u.role}</td>
                        <td>${u.created_at}</td>
                        <td>
                            <button class="btn btn-sm btn-primary" onclick="editUser(${u.id})">Edit</button>
                            <button class="btn btn-sm btn-danger" onclick="deleteUser(${u.id})">Delete</button>
                        </td>
                    </tr>
                `;
            });
            document.getElementById("usersTableBody").innerHTML = table;
        });
}

/* ADD USER */
document.getElementById("addUserForm").addEventListener("submit", function (e) {
    e.preventDefault();
    let formData = new FormData(this);
    formData.append("action", "add");

    fetch("api/setting_api.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);
        loadUsers();
        document.getElementById("addUserForm").reset();
        bootstrap.Modal.getInstance(document.getElementById("addModal")).hide();
    });
});

/* GET USER FOR EDIT */
function editUser(id) {
    fetch("api/setting_api.php?action=getUser&id=" + id)
        .then(res => res.json())
        .then(data => {
            document.getElementById("edit_id").value = data.id;
            document.getElementById("edit_username").value = data.username;
            document.getElementById("edit_role").value = data.role;
            document.getElementById("edit_password").value = "";
            new bootstrap.Modal(document.getElementById("editModal")).show();
        });
}

/* UPDATE USER */
document.getElementById("editUserForm").addEventListener("submit", function (e) {
    e.preventDefault();
    let formData = new FormData(this);
    formData.append("action", "update");

    fetch("api/setting_api.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);
        loadUsers();
        bootstrap.Modal.getInstance(document.getElementById("editModal")).hide();
    });
});

/* DELETE USER */
function deleteUser(id) {
    if (!confirm("Are you sure?")) return;

    let formData = new FormData();
    formData.append("action", "delete");
    formData.append("id", id);

    fetch("api/setting_api.php", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);
        loadUsers();
    });
}
