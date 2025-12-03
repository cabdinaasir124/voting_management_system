<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Import Voters</title>
</head>
<body>

<div class="content-page">
    <div class="content">
     <!-- Start Content-->
    <div class="container-fluid md-8 mt-3">
<div class="container mt-5">
    <h3 class="mb-4">Import Voters (Excel)</h3>

    <form id="importForm" enctype="multipart/form-data">
        <div class="mb-3">
            <input type="file" name="excel_file" class="form-control" accept=".xlsx,.xls" required>
        </div>
        <button type="submit" class="btn btn-success">Import</button>
    </form>

    <div id="result" class="mt-3"></div>
</div>
</div>
</div>
</div>


</body>
</html>
