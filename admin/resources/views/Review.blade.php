@extends('Layout.app')

@section('title','ReviewPage')


@section('content')



<div id="mainDivReview" class="container d-none">
<div class="row">
<div class="col-md-12 p-5">

     <!-- Add Button -->
     <button class="btn my-3 btn-sm btn-danger" id="addNewReviewBtnID" data-toggle="modal" data-target="#addModal" >Add New</button>

<table id="reviewDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
	  <th class="th-sm">Name</th>
	  <th class="th-sm">Description</th>
	  <th class="th-sm">Edit</th>
      <th class="th-sm">Delete</th>

    </tr>
  </thead>
  <tbody id="review_table">
  
	
	
  </tbody>
</table>

</div>
</div>
</div>



<!-- Loading Animation Part -->
<div id="loaderDivReview" class="container">
   <div class="row">
      <div class="col-md-12 text-center p-5">

           <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}" alt="" />

      </div>
   </div>
</div>



<!-- Data not found part-->
<div id="wrongDivReview" class="container d-none">
   <div class="row">
      <div class="col-md-12 text-center p-5">

           <h3>Something went wrong!</h3>

      </div>
   </div>
</div>





<!-- Modals Part -->

<!-- Review Add Modal -->
<div class="modal fade" id="addReviewModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
   
   
      <div class="modal-body text-center p-3">
      <h5 class="modal-title">Add New Review</h5>
       <!-- data add Form-->
          <div id="ReviewAddForm" class="w-100">
            <input type="text" id="ReviewNameId" class="form-control mb-4" placeholder="Review Name"/>
            <input type="text" id="ReviewDesId" class="form-control mb-4" placeholder="Review Description" />
            <input type="email" id="ReviewImgId" class="form-control mb-4" placeholder="Review Image" />
          </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button type="button" id="ReviewAddConfirmBtn" class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>






<!-- Delete Modal -->
<div class="modal fade" id="deleteReviewModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
   
      <div class="modal-body text-center p-3">
          <h5 class="mt-4">Do You Want To Delete!</h5>
          <h5 id="reviewDeleteID" class="mt-4 d-none"></h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
        <button type="button" id="reviewDeleteConfirmBtn" class="btn btn-sm btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>






<!-- Review Update Modal-->
<div class="modal fade" id="editReviewModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

     <div class="modal-header">
        <h5 class="modal-title">Update Review</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
     </div>

      <div class="modal-body  text-center p-4">
 
         <h5 id="reviewEditID" class="mt-4 d-none"></h5> 

    <!--Review Edit Form -->
       <div id="reviewEditForm" class="w-100 d-none">
             	<input id="ReviewNameUpdateId" type="text" id="" class="form-control mb-3" placeholder="Review Name">
          	 	<input id="ReviewDesUpdateId" type="text" id="" class="form-control mb-3" placeholder="Review Description">
     		     	<input id="ReviewImgUpdateId" type="text" id="" class="form-control mb-3" placeholder="Review Image">
       </div>
  
          <!-- Project EditLoader & Project Edit Wrong-->
             <img id="reviewEditLoader" class="loading-icon m-5" src="{{asset('images/loader.svg')}}" alt="" /> 
             <h5 id="reviewEditWrong" class="d-none">Something went wrong!</h5>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="reviewEditConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>

    </div>
  </div>
</div>




@endsection



@section('script')
<script type="text/javascript">

    getReviewData();

    function getReviewData() {

axios.get('/getReviewData')
    .then(function(response) {

        if (response.status == 200) {


            $('#mainDivReview').removeClass('d-none');
            $('#loaderDivReview').addClass('d-none');

            $('#reviewDataTable').DataTable().destroy();
            $('#review_table').empty();


            var jsonData = response.data;

            $.each(jsonData, function(i, item) {
                $('<tr>').html(
                    "<td class='th-sm'>" + jsonData[i].review_name + "</td>" +
                    "<td class='th-sm'>" + jsonData[i].review_des + "</td>" +
                    "<td class='th-sm'><a data-toggle='modal' class='reviewEditBtn' data-id=" + jsonData[i].id + " data-target='#editModal' ><i class='fas fa-edit'></i></a></td>" +
                    "<td class='th-sm'><a data-toggle='modal' class='reviewDeleteBtn' data-id=" + jsonData[i].id + " data-target='#deleteModal' href='' ><i class='fas fa-trash-alt'></i></a></td>"
                ).appendTo('#review_table');

            });



            /* Review Delete icon Onclick */
            $('.reviewDeleteBtn').click(function() {

                $('#deleteReviewModal').modal('show');

                var id = $(this).data('id');
                $('#reviewDeleteID').html(id);

            });



            // Review Edit icon click
            $('.reviewEditBtn').click(function() {

                var id = $(this).data('id');
                getReviewEditFormData(id);

                $('#reviewEditID').html(id);
                $('#editReviewModal').modal('show');

            });


            /* DataTable Library */
            $('#reviewDataTable').DataTable({
                "order": false
            });
            $('.dataTables_length').addClass('bs-select');



        } else {


            $('#loaderDivReview').addClass('d-none');
            $('#wrongDivReview').removeClass('d-none');


        }

    }).catch(function(error) {


        $('#loaderDivReview').addClass('d-none');
        $('#wrongDivReview').removeClass('d-none');

    });




} /* Function End */




/* Add New Review Button Click */
$('#addNewReviewBtnID').click(function() {

$('#addReviewModal').modal('show');

});




//Review Data Add Confirm Save button onclick
$('#ReviewAddConfirmBtn').click(function() {

var name = $('#ReviewNameId').val();
var des = $('#ReviewDesId').val();
var img = $('#ReviewImgId').val();

ReviewAdd(name, des, img);

});



function ReviewAdd(ReviewName, ReviewDes, ReviewImg) {

var url = '/ReviewDataInsert';
var data = {
    review_name: ReviewName,
    review_des: ReviewDes,
    review_img: ReviewImg

};


if (ReviewName.length == 0) {
    toastr.error('Review Name is empty!');
} else if (ReviewDes.length == 0) {
    toastr.error('Review Description is empty!');
} else if (ReviewImg.length == 0) {
    toastr.error('Review Image is empty!');

} else {


    /*progress spinner*/
    $('#ReviewAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");

    axios.post(url, data)
        .then(function(response) {

            $('#ReviewAddConfirmBtn').html('Save');

            if (response.status == 200) {

                if (response.data == 1) {

                    $('#addReviewModal').modal('hide');
                    toastr.success('Add Success');
                    getReviewData();

                } else {


                    $('#addReviewModal').modal('hide');
                    toastr.error('Add Fail');
                    getReviewData();

                }

            } else {

                $('#addReviewModal').modal('hide');
                toastr.error('Something Went Wrong!');
            }


        })
        .catch(function(error) {

            $('#addReviewModal').modal('hide');
            toastr.error('Something Went Wrong!');

        });


} /* else ended */


} /* ReviewAdd Function Ended*/




// Review Delete Modal Yes Button
$('#reviewDeleteConfirmBtn').click(function() {

var id = $('#reviewDeleteID').html();
ReviewDelete(id);

});



/* Review Delete Function Started*/
function ReviewDelete(deleteID) {

/*progress spinner*/
$('#reviewDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");

axios.post('/ReviewDelete', {
        id: deleteID
    })
    .then(function(response) {

        $('#reviewDeleteConfirmBtn').html('Yes');

        if (response.status == 200) {

            if (response.data == 1) {

                $('#deleteReviewModal').modal('hide');
                toastr.success('Delete Success');
                getReviewData();

            } else {

                $('#deleteReviewModal').modal('hide');
                toastr.error('Delete Fail');
                getReviewData();


            }

        } else {

            $('#deleteReviewModal').modal('hide');
            toastr.error('Something Went Wrong!');
        }


    })
    .catch(function(error) {

        $('#deleteReviewModal').modal('hide');
        toastr.error('Something Went Wrong!');

    });



} /*Review Delete function Ended*/




/* Review Edit Form Data Show function started */
function getReviewEditFormData(editFormID) {

axios.post('/ReviewEditform', {
        id: editFormID
    })
    .then(function(response) {

        if (response.status == 200) {

            $('#reviewEditForm').removeClass('d-none');
            $('#reviewEditLoader').addClass('d-none');

            var jsonData = response.data;

            console.log(jsonData);

            $('#ReviewNameUpdateId').val(jsonData[0].review_name);
            $('#ReviewDesUpdateId').val(jsonData[0].review_des);
            $('#ReviewImgUpdateId').val(jsonData[0].review_img);


        } else {

            $('#reviewEditLoader').addClass('d-none');
            $('#reviewEditWrong').removeClass('d-none');

        }


    })
    .catch(function(error) {


        $('#reviewEditLoader').addClass('d-none');
        $('#reviewEditWrong').removeClass('d-none');

    });


} /* Review Edit Form Data Show function Ended */




/* Review Edit Confirm Save button Click */
$('#reviewEditConfirmBtn').click(function() {

var id = $('#reviewEditID').html();
var update_name = $('#ReviewNameUpdateId').val();
var update_des = $('#ReviewDesUpdateId').val();
var update_img = $('#ReviewImgUpdateId').val();

ReviewUpdate(id, update_name, update_des, update_img);

});


/* CourseUpdate function Started*/
function ReviewUpdate(reviewEditID, reviewName, reviewDes, reviewImg) {


if (reviewName.length == 0) {
    toastr.error('Review Name is empty!');
} else if (reviewDes.length == 0) {
    toastr.error('Review Description is empty!');
} else if (reviewImg.length == 0) {
    toastr.error('Review Image is empty!');

} else {


    /*progress spinner*/
    $('#reviewEditConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");

    axios.post('/ReviewUpdate', {

            id: reviewEditID,
            review_name: reviewName,
            review_des: reviewDes,
            review_img: reviewImg

        })
        .then(function(response) {

            $('#reviewEditConfirmBtn').html('Save');

            if (response.status == 200) {

                if (response.data == 1) {

                    $('#editReviewModal').modal('hide');
                    toastr.success('Update Success');
                    getReviewData();

                } else {

                    $('#editReviewModal').modal('hide');
                    toastr.error('Update Fail');
                    getReviewData();

                }

            } else {
                $('#editReviewModal').modal('hide');
                toastr.error('Something Went Wrong!');
            }

        })
        .catch(function(error) {

            $('#editReviewModal').modal('hide');
            toastr.error('Something Went Wrong!');

        });


} /* Else ended */


} /* Course Update Function Ended*/
</script>
@endsection