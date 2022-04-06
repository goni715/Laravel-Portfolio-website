@extends('Layout.app')


@section('content')


<div id="mainDiv" class="container d-none">
     <div class="row">
        <div class="col-md-12 p-5">
      <table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
       <thead>
         <tr>
             <th class="th-sm">Image</th>
	           <th class="th-sm">Name</th>
	           <th class="th-sm">Description</th>
	           <th class="th-sm">Edit</th>
	           <th class="th-sm">Delete</th>
         </tr>
       </thead>
       <tbody id="service_table">
  

	
       </tbody>
      </table>

        </div>
    </div>
</div>




<!-- Loading Animation Part -->


<div id="loaderDiv" class="container">
   <div class="row">
      <div class="col-md-12 text-center p-5">

           <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}" alt="" />

      </div>
   </div>
</div>




<!-- Data not found part-->


<div id="wrongDiv" class="container d-none">
   <div class="row">
      <div class="col-md-12 text-center p-5">

           <h3>Something went wrong!</h3>

      </div>
   </div>
</div>





<!--Modals Part-->


<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
   
      <div class="modal-body text-center p-3">
          <h5 class="mt-4">Do You Want To Delete!</h5>
          <h5 id="serviceDeleteID" class="mt-4"></h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
        <button type="button" id="serviceDeleteConfirmBtn" class="btn btn-sm btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>



<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
   
      <div class="modal-body text-center p-3">
          
      <h5 id="serviceEditID" class="mt-4"></h5> 

  <!-- Name input -->
  <div class="form-outline mb-4">
    <input type="text" id="name" class="form-control" placeholder="Service Name"/>
  </div>
  <div class="form-outline mb-4">
    <input type="email" id="des" class="form-control" placeholder="Service Description" />
  </div>
  <div class="form-outline mb-4">
    <input type="email" id="img" class="form-control" placeholder="Service Image Link" />
  </div>




      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button type="button" id="serviceEditConfirmBtn" class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>







@endsection



@section('script')
<script type="text/javascript">

       getServicesData();









</script>
@endsection