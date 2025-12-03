let votersTable;

document.addEventListener("DOMContentLoaded", function () {
    loadTable();
});

function loadTable(className = "") {

    let url = "api/voters-fetch.php";
    if (className !== "") {
        url += "?class=" + encodeURIComponent(className);
    }

    if ($.fn.DataTable.isDataTable("#basic-datatable")) {
        $('#basic-datatable').DataTable().destroy();
    }

    votersTable = $('#basic-datatable').DataTable({
        responsive: true,
        pageLength: 10,
        ajax: {
            url: url,
            dataSrc: "data"
        },
        columns: [
            { data: "voter_id" },
            { data: "student_name" },
            { data: "class" },
            { 
                data: "password",
                render: d => `<span class="badge bg-success">${d}</span>`
            },
            { data: "created_at" }
        ],

        // UI config
        initComplete: function () {
            // Make table beautiful
            $('#basic-datatable').addClass('table table-bordered table-striped align-middle');
            $('#basic-datatable thead').addClass('table-primary text-primary');
        },

        dom: "Bfrtip",
        buttons: [
            {
                extend: "print",
                title: "",
                exportOptions: {
                    columns: [0,1,2,3,4]
                },
                customize: function (win) {
                    $(win.document.body).css("font-size", "12px");

                    // Logo header
                    $(win.document.body).prepend(`
                        <div style="text-align:center; margin-bottom:20px;">
    <img src="assets/images/logoBanner.jpeg"
        style="width:650px; max-width:100%; height:auto; display:block; margin:auto;">

    <h3 style="margin-top:10px; font-weight:bold; text-transform:uppercase;">
        Voters List
    </h3>

    <p style="font-size:14px; margin-top:-5px;">
        <strong>Academic Year:</strong> 2024 - 2025<br>
        <strong>Generated on:</strong> ${new Date().toLocaleDateString()}
    </p>
</div>

                    `);

                    // Fix table borders in print
                    $(win.document.body).find("table")
                        .addClass("compact")
                        .css("border", "1px solid black")
                        .css("width", "100%");

                    $(win.document.body).find("table th, table td")
                        .css("border", "1px solid black")
                        .css("padding", "6px");
                }
            },
            "excelHtml5",
            "pdfHtml5"
        ]
    });
}

document.getElementById("classFilter").addEventListener("change", function () {
    loadTable(this.value);
});

document.getElementById('importForm').addEventListener('submit', function (e) {
    e.preventDefault();
    let formData = new FormData(this);

    fetch('api/voters_import_api.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        let resultDiv = document.getElementById('result');

        if (data.status) {
            resultDiv.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
            $('#basic-datatable').DataTable().ajax.reload(null, false);
        } else {
            resultDiv.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
        }
    })
    .catch(err => console.error(err));
});
