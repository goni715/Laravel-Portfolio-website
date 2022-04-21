@extends('Layout.app')


@section('content')



<div id="mainDivCourse" class="container d-none">
<div class="row">
<div class="col-md-12 p-5">

     <!-- Add Button -->
     <button class="btn my-3 btn-sm btn-danger" id="addNewCourseBtnID" data-toggle="modal" data-target="#addModal" >Add New</button>

<table id="courseDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
	  <th class="th-sm">Name</th>
	  <th class="th-sm">Fee</th>
	  <th class="th-sm">Class</th>
	  <th class="th-sm">Enroll</th>
      <th class="th-sm">Edit</th>
      <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id="courses_table">
  
	
	
	
	
  </tbody>
</table>

</div>
</div>
</div>



<!-- Loading Animation Part -->
<div id="loaderDivCourse" class="container">
   <div class="row">
      <div class="col-md-12 text-center p-5">

           <img class="loading-icon m-5" src="{{asset('images/loader.svg')}}" alt="" />

      </div>
   </div>
</div>



<!-- Data not found part-->
<div id="wrongDivCourse" class="container d-none">
   <div class="row">
      <div class="col-md-12 text-center p-5">

           <h3>Something went wrong!</h3>

      </div>
   </div>
</div>




<!--Modals Part-->

<!-- Add New Course Data Modal-->
<div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Add New Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>
      <div class="modal-body  text-center">
       <div class="container">
       	<div class="row">
       		<div class="col-md-6">
             	<input id="CourseNameId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
          	 	<input id="CourseDesId" type="text" id="" class="form-control mb-3" placeholder="Course Description">
    		    	<input id="CourseFeeId" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
     			    <input id="CourseEnrollId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
       		</div>
       		<div class="col-md-6">
     			    <input id="CourseClassId" type="text" id="" class="form-control mb-3" placeholder="Total Class">      
     			    <input id="CourseLinkId" type="text" id="" class="form-control mb-3" placeholder="Course Link">
     			    <input id="CourseImgId" type="text" id="" class="form-control mb-3" placeholder="Course Image">
       		</div>
       	</div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="CourseAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>


<!-- Delete Modal -->
<div class="modal fade" id="deleteCourseModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
   
      <div class="modal-body text-center p-3">
          <h5 class="mt-4">Do You Want To Delete!</h5>
          <h5 id="courseDeleteID" class="mt-4 d-none"></h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
        <button type="button" id="courseDeleteConfirmBtn" class="btn btn-sm btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>





<!-- Course Update Modal-->
<div class="modal fade" id="editCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Update Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
 
         <h5 id="courseEditID" class="mt-4 d-none"></h5> 

       <div id="courseEditForm" class="container d-none">
       	<div class="row">
       		<div class="col-md-6">
             <form>
             	<input id="CourseNameUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
          	 	<input id="CourseDesUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Description">
    		 	<input id="CourseFeeUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
     			<input id="CourseEnrollUpdateId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
       		</div>
       		<div class="col-md-6">
     			<input id="CourseClassUpdateId" type="text" id="" class="form-control mb-3" placeholder="Total Class">      
     			<input id="CourseLinkUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Link">
     			<input id="CourseImgUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Image">
        </form>
       		</div>
       	</div>
       </div>
  
             <img id="courseEditLoader" class="loading-icon m-5" src="{{asset('images/loader.svg')}}" alt="" /> 
             <h5 id="courseEditWrong" class="d-none">Something went wrong!</h5>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="courseEditConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>



@endsection




@section('script')
<script type="text/javascript">


getCoursesData(); 



function getCoursesData(){

axios.get('/getCoursesData')
.then(function(response) {

        if (response.status == 200) {


            $('#mainDivCourse').removeClass('d-none');
            $('#loaderDivCourse').addClass('d-none');

            $('#courseDataTable').DataTable().destroy();
            $('#courses_table').empty();
        

            var jsonData = response.data;

            $.each(jsonData, function(i, item) {
                $('<tr>').html(
                    "<th class='th-sm'>"+jsonData[i].course_name+"</th>"+
                  "<th class='th-sm'>"+jsonData[i].course_fee+"</th>"+
                  "<th class='th-sm'>"+jsonData[i].course_totalclass+"</th>"+
                  "<th class='th-sm'>"+jsonData[i].course_totalenroll+"</th>"+
                    "<td class='th-sm'><a data-toggle='modal' class='courseEditBtn' data-id=" + jsonData[i].id + " data-target='#editModal' ><i class='fas fa-edit'></i></a></td>" +
                    "<td class='th-sm'><a data-toggle='modal' class='courseDeleteBtn' data-id=" + jsonData[i].id + " data-target='#deleteModal' href='' ><i class='fas fa-trash-alt'></i></a></td>"
                ).appendTo('#courses_table');

            });



                 /* Course Delete icon Onclick */
                  $('.courseDeleteBtn').click(function(){

                        $('#deleteCourseModal').modal('show');

                        var id = $(this).data('id');
                        $('#courseDeleteID').html(id);

                  });



                  // Course Edit icon click
                 $('.courseEditBtn').click(function() {

                     
                      
                        var id = $(this).data('id');
                        getCourseEditFormData(id);

                        $('#courseEditID').html(id);
                        $('#editCourseModal').modal('show');

                 });


                     /* DataTable Library */
                      $('#courseDataTable').DataTable({"order":false});
                      $('.dataTables_length').addClass('bs-select');



        } else {


            $('#loaderDivCourse').addClass('d-none');
            $('#wrongDivCourse').removeClass('d-none');


        }

    }).catch(function(error) {

            $('#loaderDivCourse').addClass('d-none');
            $('#wrongDivCourse').removeClass('d-none');

    });




} /* Function End */




/* Add New Course Button Click */
$('#addNewCourseBtnID').click(function(){

$('#addCourseModal').modal('show');

});





//Course Data Add Confirm Save button onclick
$('#CourseAddConfirmBtn').click(function(){



var CourseName = $('#CourseNameId').val();
var CourseDes = $('#CourseDesId').val();
var CourseFee = $('#CourseFeeId').val();
var CourseEnroll = $('#CourseEnrollId').val();
var CourseClass = $('#CourseClassId').val();
var CourseLink = $('#CourseLinkId').val();
var CourseImg = $('#CourseImgId').val();


var url = '/CoursesDataInsert';
var data = {
    course_name : CourseName,
    course_des : CourseDes,
    course_fee : CourseFee,
    course_totalenroll : CourseEnroll,
    course_totalclass : CourseClass,
    course_link :CourseLink,
    course_img : CourseImg

};


if ( CourseName.length == 0) {
    toastr.error('Course Name is empty!');
} else if (CourseDes.length == 0) {
    toastr.error('Course Description is empty!');
} else if (CourseFee.length == 0) {
    toastr.error('Course Fee is empty!');
} else if (CourseEnroll.length == 0) {
    toastr.error('CourseEnroll is empty!');
} else if (CourseClass.length == 0) {
    toastr.error('Course Class is empty!');
} else if (CourseLink.length == 0) {
    toastr.error('Course Link is empty!');
} else if (CourseImg.length == 0) {
    toastr.error('Course Image is empty!');
}else {



    /*progress spinner*/
    $('#CourseAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");

    axios.post(url, data)
        .then(function(response) {

            $('#CourseAddConfirmBtn').html('Save');

            if (response.status == 200) {

                if (response.data == 1) {

                    $('#addCourseModal').modal('hide');
                    toastr.success('Add Success');
                    getCoursesData();

                } else {


                    $('#addCourseModal').modal('hide');
                    toastr.error('Add Fail');
                    getCoursesData();

                }

            } else {

                $('#addCourseModal').modal('hide');
                toastr.error('Something Went Wrong!');
            }


        })
        .catch(function(error) {

            $('#addCourseModal').modal('hide');
            toastr.error('Something Went Wrong!');

        });


} /* else ended */

});







// Course Delete Modal Yes Button
$('#courseDeleteConfirmBtn').click(function() {

var id = $('#courseDeleteID').html();
CourseDelete(id);

});

/* Course Delete Function Started*/
function CourseDelete(deleteID) {

/*progress spinner*/
$('#courseDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");

axios.post('/CoursesDelete', {
        id: deleteID
    })
    .then(function(response) {

        $('#courseDeleteConfirmBtn').html('Yes');

        if (response.status == 200) {

            if (response.data == 1) {

                $('#deleteCourseModal').modal('hide');
                toastr.success('Delete Success');
                getCoursesData();

            } else {

                $('#deleteCourseModal').modal('hide');
                toastr.error('Delete Fail');
                getCoursesData();


            }

        } else {

            $('#deleteCourseModal').modal('hide');
            toastr.error('Something Went Wrong!');
        }


    })
    .catch(function(error) {

        $('#deleteCourseModal').modal('hide');
        toastr.error('Something Went Wrong!');
    });



} /*serviceDelete function Ended*/











/* Course Edit Form Data Show function started */
function getCourseEditFormData(editFormID) {

axios.post('/CourseEditform', {
        id: editFormID
    })
    .then(function(response) {

        if (response.status == 200) {

            $('#courseEditForm').removeClass('d-none');
            $('#courseEditLoader').addClass('d-none');

            var jsonData = response.data;

            console.log(jsonData);

            $('#CourseNameUpdateId').val(jsonData[0].course_name);
            $('#CourseDesUpdateId').val(jsonData[0].course_des);
            $('#CourseFeeUpdateId').val(jsonData[0].course_fee);
            $('#CourseEnrollUpdateId').val(jsonData[0].course_totalenroll);
            $('#CourseClassUpdateId').val(jsonData[0].course_totalclass);
            $('#CourseLinkUpdateId').val(jsonData[0].course_link);
            $('#CourseImgUpdateId').val(jsonData[0].course_img);


        } else {

            $('#courseEditLoader').addClass('d-none');
            $('#courseEditWrong').removeClass('d-none');

        }


    })
    .catch(function(error) {


        $('#courseEditLoader').addClass('d-none');
        $('#courseEditWrong').removeClass('d-none');

    });


}/* Course Edit Form Data Show function Ended */




/* Course Edit Confirm Save button Click */
$('#courseEditConfirmBtn').click(function() {



var id = $('#courseEditID').html();
var update_name = $('#CourseNameUpdateId').val();
var update_des = $('#CourseDesUpdateId').val();
var update_fee = $('#CourseFeeUpdateId').val();
var update_enroll = $('#CourseEnrollUpdateId').val();
var update_class = $('#CourseClassUpdateId').val();
var update_link = $('#CourseLinkUpdateId').val();
var update_img = $('#CourseImgUpdateId').val();

CourseUpdate(id, update_name, update_des, update_fee, update_enroll, update_class, update_link, update_img);

});


/* CourseUpdate function Started*/
function CourseUpdate(courseEditID, courseName, courseDes, courseFee, courseEnroll, courseClass, courseLink, courseImg) {


if (courseName.length == 0) {
    toastr.error('Course Name is empty!');
}else if (courseDes.length == 0) {
    toastr.error('Course Description is empty!');
}else if (courseFee.length == 0) {
    toastr.error('Course Fee is empty!');
}else if (courseEnroll.length == 0) {
    toastr.error('Course Enroll is empty!');
}else if (courseClass.length == 0) {
    toastr.error('Course Class is empty!');
}else if (courseLink.length == 0) {
    toastr.error('Coure Link is empty!');
}else if (courseImg.length == 0) {
    toastr.error('Course Image is empty!');

}
else {

        
    /*progress spinner*/
   $('#courseEditConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
  
    axios.post('/CourseUpdate', {

            id : courseEditID,
            course_name : courseName,
            course_des : courseDes,
            course_fee : courseFee,
            course_totalenroll : courseEnroll,
            course_totalclass : courseClass,
            course_link : courseLink,
            course_img : courseImg

        })
        .then(function(response) {

            $('#courseEditConfirmBtn').html('Save');

            if (response.status == 200) {

                if (response.data == 1) {

                    $('#editCourseModal').modal('hide');
                    toastr.success('Update Success');
                    getCoursesData();

                } else {

                    $('#editCourseModal').modal('hide');
                    toastr.error('Update Fail');
                    getCoursesData();

                }

            } else {
                $('#editCourseModal').modal('hide');
                toastr.error('Something Went Wrong!');
            }

        })
        .catch(function(error) {

               $('#editCourseModal').modal('hide');
               toastr.error('Something Went Wrong!');

        });


} /* Else ended */


} /* Course Update Function Ended*/




</script>

@endsection