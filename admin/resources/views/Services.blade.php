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


<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
   
      <div class="modal-body text-center p-3">
          <h5 class="m-4">Do You Want To Delete!</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
        <button type="button" id="deleteBtn" value="" class="btn btn-sm btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>



@endsection



@section('script')
<script type="text/javascript">

       getServicesData();



             
                 var deleteBtn = document.querySelectorAll('#deleteBtn');
                 var len = deleteBtn.length;


                  for(var i=0; i < len; i++){

                  deleteBtn[i].addEventListener('click', function(){

                    // alert('hello');

                   var myID = this.value;

                   alert(myID);
   
                  /* var url = "/deleteData";
                   var data = {id:myID};


 
                axios.post(url,data)
                .then(function (response) {

                 alert(response.data);


                 })
                 .catch(function (error) {
                  console.log(error);
                 });

                  */


                  }); /* deleteBtn click event ended */




                  }/* delete Button loop Ended */






         



//alert('hello');





</script>
@endsection