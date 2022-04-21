@extends('Layout.app')


@section('content')


<div id="mainDiv" class="container d-none">
     <div class="row">
        <div class="col-md-12 p-5">

        <!-- Add Button -->
         <button class="btn my-3 btn-sm btn-danger" data-toggle="modal" data-target="#addModal" >Add Data</button>

      <table id="serviceDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
          <h5 id="serviceDeleteID" class="mt-4 d-none"></h5>
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
    
    <div class="modal-header">
        <h5 class="modal-title">Update Service</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>

      <div class="modal-body text-center p-4">
          
           <h5 id="serviceEditID" class="mt-4 d-none"></h5> 

  <!-- EDit Form-->
          <div id="serviceEditForm" class="d-none w-100">
            <input type="text" id="serviceNameID" class="form-control mb-4" placeholder="Service Name"/>
            <input type="email" id="serviceDesID" class="form-control mb-4" placeholder="Service Description" />
            <input type="email" id="serviceImgID" class="form-control mb-4" placeholder="Service Image Link" />
          </div>


    <!-- Service EditLoader & Project Edit Wrong--> 
        <img id="serviceEditLoader" class="loading-icon m-5" src="{{asset('images/loader.svg')}}" alt="" /> 
        <h5 class="d-none" id="serviceEditWrong">Something went wrong!</h5>

       </div>
       
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button type="button" id="serviceEditConfirmBtn" class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>






<!-- Service Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
   
   
      <div class="modal-body text-center p-3">
      <h5 class="modal-title">Add New Service</h5>
       <!-- data add Form-->
          <div id="serviceAddForm" class="w-100">
            <input type="text" id="serviceName" class="form-control mb-4" placeholder="Service Name"/>
            <input type="email" id="serviceDes" class="form-control mb-4" placeholder="Service Description" />
            <input type="email" id="serviceImg" class="form-control mb-4" placeholder="Service Image Link" />
          </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button type="button" id="serviceAddConfirmBtn" onClick="serviceDataInsert()" class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>



@endsection



@section('script')
<script type="text/javascript">

getServicesData();




function getServicesData() {

    axios.get('/getServicesData')
        .then(function(response) {

            if (response.status == 200) {


                $('#mainDiv').removeClass('d-none');
                $('#loaderDiv').addClass('d-none');

              
                 $('#serviceDataTable').DataTable().destroy();
                 $('#service_table').empty();
                 //$('#service_table').html(null);



                var jsonData = response.data;

                $.each(jsonData, function(i, item) {
                    $('<tr>').html(
                        "<td><img class='table-img' src=" + jsonData[i].service_img + "></td>" +
                        "<td class='th-sm' >" + jsonData[i].service_name + "</td>" +
                        "<td class='th-sm'>" + jsonData[i].service_des + "</td>" +
                        "<td class='th-sm'><a data-toggle='modal' class='serviceEditBtn' data-id=" + jsonData[i].id + " data-target='#editModal' ><i class='fas fa-edit'></i></a></td>" +
                        "<td class='th-sm'><a data-toggle='modal' class='serviceDeleteBtn' data-id=" + jsonData[i].id + " data-target='#deleteModal' href='' ><i class='fas fa-trash-alt'></i></a></td>"
                    ).appendTo('#service_table');

                });


                // Service Delete Icon click
                $('.serviceDeleteBtn').click(function() {

                    var id = $(this).data('id');
                    $('#serviceDeleteID').html(id);

                });




                // Service Edit icon click
                $('.serviceEditBtn').click(function() {

                    var id = $(this).data('id');
                    $('#serviceEditID').html(id);

                    getServiceEditFormData(id);

                });


                   $('#serviceDataTable').DataTable({"order":false});
                   $('.dataTables_length').addClass('bs-select');



            } else {


                $('#loaderDiv').addClass('d-none');
                $('#wrongDiv').removeClass('d-none');


            }

        }).catch(function(error) {

            $('#loaderDiv').addClass('d-none');
            $('#wrongDiv').removeClass('d-none');

        });




} /* Function End */




// Service Delete Modal Yes Button
$('#serviceDeleteConfirmBtn').click(function() {

    var id = $('#serviceDeleteID').html();
    ServiceDelete(id);

});

/* Service Delete Function Started*/
function ServiceDelete(deleteID) {

    /*progress spinner*/
    $('#serviceDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");

    axios.post('/ServiceDelete', {
            id: deleteID
        })
        .then(function(response) {

            $('#serviceDeleteConfirmBtn').html('Yes');

            if (response.status == 200) {

                if (response.data == 1) {

                    $('#deleteModal').modal('hide');
                    toastr.success('Delete Success');
                    getServicesData();

                } else {

                    $('#deleteModal').modal('hide');
                    toastr.error('Delete Fail');
                    getServicesData();


                }

            } else {

                $('#deleteModal').modal('hide');
                toastr.error('Something Went Wrong!');
            }


        })
        .catch(function(error) {

            $('#deleteModal').modal('hide');
            toastr.error('Something Went Wrong!');
        });



} /*serviceDelete function Ended*/



/*getServiceEditFormData function started */
function getServiceEditFormData(editFormID) {


    axios.post('/ServiceEditform', {
            id: editFormID
        })
        .then(function(response) {

            if (response.status == 200) {

                $('#serviceEditForm').removeClass('d-none');
                $('#serviceEditLoader').addClass('d-none');

                var jsonData = response.data;

                $('#serviceNameID').val(jsonData[0].service_name);
                $('#serviceDesID').val(jsonData[0].service_des);
                $('#serviceImgID').val(jsonData[0].service_img);

            } else {

                $('#serviceEditLoader').addClass('d-none');
                $('#serviceEditWrong').removeClass('d-none');

            }


        })
        .catch(function(error) {


            $('#serviceEditLoader').addClass('d-none');
            $('#serviceEditWrong').removeClass('d-none');

        });


}




/* Service Save button Click */
$('#serviceEditConfirmBtn').click(function() {

    var id = $('#serviceEditID').html();
    var name = $('#serviceNameID').val();
    var des = $('#serviceDesID').val();
    var img = $('#serviceImgID').val();
    ServiceUpdate(id, name, des, img);

});

/* ServiceUpdate function Started*/
function ServiceUpdate(serviceID, serviceName, serviceDes, serviceImg) {


    if (serviceName.length == 0) {
        toastr.error('Service Name is empty!');
    }else if (serviceDes.length == 0) {
        toastr.error('Service Description is empty!');
    }else if (serviceImg.length == 0) {
        toastr.error('Service Image is empty!');
    }else {

            
        /*progress spinner*/
        $('#serviceEditConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");



        axios.post('/ServiceUpdate', {
                id: serviceID,
                name: serviceName,
                des: serviceDes,
                img: serviceImg
            })
            .then(function(response) {

                $('#serviceEditConfirmBtn').html('Save');

                if (response.status == 200) {

                    if (response.data == 1) {

                        $('#editModal').modal('hide');
                        toastr.success('Update Success');
                        getServicesData();

                    } else {

                        $('#editModal').modal('hide');
                        toastr.error('Update Fail');
                        getServicesData();

                    }

                } else {

                    $('#editModal').modal('hide');
                    toastr.error('Something Went Wrong!');
                }

            })
            .catch(function(error) {

                $('#editModal').modal('hide');
                toastr.error('Something Went Wrong!');

            });


    } /* Else ended */


} /* ServiceUpdate Function Ended*/




/* Service Data Insert */
function serviceDataInsert() {

    var service_name = $('#serviceName').val();
    var service_des = $('#serviceDes').val();
    var service_img = $('#serviceImg').val();

    var url = '/ServiceDataInsert';
    var data = {
        name: service_name,
        des: service_des,
        img: service_img
    };


    if (service_name.length == 0) {
        toastr.error('Service Name is empty!');
    } else if (service_name.length == 0) {
        toastr.error('Service Description is empty!');
    } else if (service_img.length == 0) {
        toastr.error('Service Image is empty!');
    } else {



        /*progress spinner*/
        $('#serviceAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");

        axios.post(url, data)
            .then(function(response) {

                $('#serviceAddConfirmBtn').html('Save');

                if (response.status == 200) {

                    if (response.data == 1) {

                        $('#addModal').modal('hide');
                        toastr.success('Add Success');
                        getServicesData();

                    } else {


                        $('#addModal').modal('hide');
                        toastr.error('Add Fail');
                        getServicesData();

                    }

                } else {

                    $('#addModal').modal('hide');
                    toastr.error('Something Went Wrong!');
                }


            })
            .catch(function(error) {

                $('#addModal').modal('hide');
                toastr.error('Something Went Wrong!');

            });


    } /* else ended */


}



</script>
@endsection