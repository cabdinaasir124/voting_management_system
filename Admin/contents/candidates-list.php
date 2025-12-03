<!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
    <div class="content">
     <!-- Start Content-->
    <div class="container-fluid md-8 mt-3">
    <div class="row">
      <div class="col-12 d-flex justify-content-between">
        <h3>Candidation List</h3>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#voterModal"><i class="fas fa-plus"></i></button>
      </div>
    </div>
    
    <div class="container-fluid mt-2">
    <div id="cardBody" class="row d-flex">
        <!-- Your card layout goes here -->
    </div>
</div>


   

    <!-- Modal -->
<div class="modal fade" id="voterModal" tabindex="-1" aria-labelledby="voterModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="voterModal">Voter form</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <form id="CandidateF" method="POST" enctype="multipart/form-data">
        <label>upload image</label>
        <input name="file" type="file" class="form-control" placeholder="Enter full name">
        <label>Full name</label>
        <input name="f_name" type="text" class="form-control" placeholder="Enter full name">
        <label>Phone number</label>
        <input name="p_num" type="text" value="252"  class="form-control" placeholder="Enter full name">
        <label>Sex</label>
        <select class="form-control" name="sex">
          <option name="sex" value="male">Male</option>
          <option name="sex" value="female">Female</option>
        </select>
        <label>candidate Position</label>
        <select name="position" id="" class="form-control">
          <option name="position">president</option>
          <option name="position">vice-president</option>
        </select>
        <label>Age</label>
        <input name="Age" type="number" class="form-control" placeholder="Enter your age">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save candidate</button>
      </div>
      </form>
    </div>
  </div>
</div>
