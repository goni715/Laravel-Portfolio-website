@extends('Layout.app')
@section('title','ContactPage')

@section('content')

<div id="mainDivContact" class="container d-none">
     <div class="row">
        <div class="col-md-12 p-5">

      <table id="contactDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
       <thead>
         <tr>
            
	           <th class="th-sm">Name</th>
	           <th class="th-sm">Mobile</th>
	           <th class="th-sm">Email</th>
	           <th class="th-sm">Message</th>
               <th class="th-sm">Delete</th>

         </tr>
       </thead>
       <tbody id="contact_table">
  

	
       </tbody>
      </table>

        </div>
    </div>
</div>





<!-- Loading Animation Part -->
<div id="loaderDivContact" class="container">
   <div class="row">
      <div class="col-md-12 text-center p-5">

           <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}" alt="" />

      </div>
   </div>
</div>



<!-- Data not found part-->
<div id="wrongDivContact" class="container d-none">
   <div class="row">
      <div class="col-md-12 text-center p-5">

           <h3>Something went wrong!</h3>

      </div>
   </div>
</div>





<!-- Delete Modal -->
<div class="modal fade" id="deleteContactModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
   
      <div class="modal-body text-center p-3">
          <h5 class="mt-4">Do You Want To Delete!</h5>
          <h5 id="contactDeleteID" class="mt-4 d-none"></h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
        <button type="button" id="contactDeleteConfirmBtn" class="btn btn-sm btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>



@endsection


@section('script')
<script type="text/javascript">

    getContactsData();




function getContactsData(){

       axios.get('/getContactsData')
      .then(function(response) {

         if (response.status == 200) {


            $('#mainDivContact').removeClass('d-none');
            $('#loaderDivContact').addClass('d-none');

            $('#contactDataTable').DataTable().destroy();
            $('#contact_table').empty();
        

            var jsonData = response.data;

            $.each(jsonData, function(i, item) {
                $('<tr>').html(
                    "<th class='th-sm'>"+jsonData[i].contact_name+"</th>"+
                  "<th class='th-sm'>"+jsonData[i].contact_mobile+"</th>"+
                  "<th class='th-sm'>"+jsonData[i].contact_email+"</th>"+
                  "<th class='th-sm'>"+jsonData[i].contact_msg+"</th>"+
                  "<td class='th-sm'><a data-toggle='modal' class='contactDeleteBtn' data-id=" + jsonData[i].id + " data-target='#deleteModal' href='' ><i class='fas fa-trash-alt'></i></a></td>"
                ).appendTo('#contact_table');

            });



                 /* Contact Delete icon Onclick */
                  $('.contactDeleteBtn').click(function(){

                        $('#deleteContactModal').modal('show');

                        var id = $(this).data('id');
                        $('#contactDeleteID').html(id);

                  });



             
                     /* DataTable Library */
                     $('#contactDataTable').DataTable({"order":false});
                     $('.dataTables_length').addClass('bs-select');



        } else {


            $('#loaderDivContact').addClass('d-none');
            $('#wrongDivContact').removeClass('d-none');


        }

    }).catch(function(error) {

           $('#loaderDivContact').addClass('d-none');
           $('#wrongDivContact').removeClass('d-none');

    });




} /* Function End */







// Contact Delete Modal Yes Button
$('#contactDeleteConfirmBtn').click(function() {

var id = $('#contactDeleteID').html();
   ContactDelete(id);

});

/* Contact Delete Function Started*/
function ContactDelete(deleteID) {

/*progress spinner*/
$('#contactDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");

axios.post('/ContactDelete', {
        id: deleteID
    })
    .then(function(response) {

        $('#contactDeleteConfirmBtn').html('Yes');

        if (response.status == 200) {

            if (response.data == 1) {

                $('#deleteContactModal').modal('hide');
                toastr.success('Delete Success');
                getContactsData();

            } else {

                $('#deleteContactModal').modal('hide');
                toastr.error('Delete Fail');
                getContactsData();


            }

        } else {

            $('#deleteContactModal').modal('hide');
            toastr.error('Something Went Wrong!');
        }


    })
    .catch(function(error) {
        $('#deleteContactModal').modal('hide');
        toastr.error('Something Went Wrong!');
    });



} /*Contact Delete function Ended*/








</script>

@endsection