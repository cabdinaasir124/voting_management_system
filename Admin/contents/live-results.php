
<style>
.candidate-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; }
.candidate-card { position: relative; border: 1px solid #ddd; border-radius: 10px; padding: 15px; background: #fff; box-shadow: 0 4px 8px rgba(0,0,0,0.1); text-align:center; }
.progress-container { position: relative; width: 150px; height: 150px; margin:auto; transition:0.3s ease-in-out; }
.candidate-image { width:100px; height:100px; border-radius:50%; object-fit:cover; position:absolute; left:50%; top:50%; transform:translate(-50%, -50%); z-index:2; transition: opacity 0.3s ease-in-out; }
.progress-text { position:absolute; font-size:20px; font-weight:bold; color:black; left:50%; top:50%; transform:translate(-50%, -50%); opacity:0; z-index:3; transition:opacity 0.3s ease-in-out; }
.progress-container:hover .progress-text { opacity:1; }
.progress-container:hover .candidate-image { opacity:0.3; }
.progress-container canvas {
    width: 150px !important;
    height: 150px !important;
    display: block !important;
}
.info-divider {
    margin: 2px 0 !important;
    border: 1;
    border-bottom: 1px solid #e2e2e2;
}



</style>
</head>
<body>
<div class="content-page">
    <div class="content">
     <!-- Start Content-->
    <div class="container-fluid md-8 mt-3">
<div class="container py-4">
    <h2 class="mb-4 text-center">Live Election Results</h2>

    <h3 class="text-primary mt-4 mb-3 fw-bold">Presidential Candidates</h3>
    <div id="presidentGrid" class="row"></div>

    <h3 class="text-success mt-5 mb-3 fw-bold">Vice Presidential Candidates</h3>
    <div id="viceGrid" class="row"></div>
</div>

</div>
</div>


