@extends('Layout.app')
@section('title','ProjectPage')

@section('content')

  
<div id="mainDiv" class="container d-none">
     <div class="row">
        <div class="col-md-12 p-5">

        <!-- Add Button -->
         <button id="addNewProjectBtnID" class="btn my-3 btn-sm btn-danger" data-toggle="modal" data-target="#addModal" >Add Data</button>

      <table id="projectDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
       <thead>
         <tr>
	           <th class="th-sm">Name</th>
	           <th class="th-sm">Description</th>
	           <th class="th-sm">Edit</th>
	           <th class="th-sm">Delete</th>
         </tr>
       </thead>
       <tbody id="project_table">
  

	
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





<!-- Modals Part -->

<!-- Project Add Modal -->
<div class="modal fade" id="addProjectModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
   
   
      <div class="modal-body text-center p-3">
      <h5 class="modal-title">Add New Project</h5>
       <!-- data add Form-->
          <div id="projectAddForm" class="w-100">
            <input type="text" id="ProjectNameId" class="form-control mb-4" placeholder="Project Name"/>
            <input type="text" id="ProjectDesId" class="form-control mb-4" placeholder="Project Description" />
            <input type="text" id="ProjectLinkId" class="form-control mb-4" placeholder="Project Link" />
            <input type="email" id="ProjectImgId" class="form-control mb-4" placeholder="Project Image" />
          </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button type="button" id="ProjectAddConfirmBtn" class="btn btn-sm btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>




<!-- Delete Modal -->
<div class="modal fade" id="deleteProjectModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
   
      <div class="modal-body text-center p-3">
          <h5 class="mt-4">Do You Want To Delete!</h5>
          <h5 id="projectDeleteID" class="mt-4 d-none"></h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
        <button type="button" id="projectDeleteConfirmBtn" class="btn btn-sm btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>





<!-- Project Update Modal-->
<div class="modal fade" id="editProjectModal" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

     <div class="modal-header">
        <h5 class="modal-title">Update Project</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
     </div>


      <div class="modal-body  text-center p-4">
 
         <h5 id="projectEditID" class="mt-4 d-none"></h5> 

    <!--Projet Edit Form -->
       <div id="projectEditForm" class="d-none w-100">
             	<input id="ProjectNameUpdateId" type="text" id="" class="form-control mb-3" placeholder="Project Name">
          	 	<input id="ProjectDesUpdateId" type="text" id="" class="form-control mb-3" placeholder="Project Description">
    		 	    <input id="ProjectLinkUpdateId" type="text" id="" class="form-control mb-3" placeholder="Project Link">
     		     	<input id="ProjectImgUpdateId" type="text" id="" class="form-control mb-3" placeholder="Project Image">
       </div>
  
          <!-- Project EditLoader & Project Edit Wrong-->
             <img id="projectEditLoader" class="loading-icon m-5" src="{{asset('images/loader.svg')}}" alt="" /> 
             <h5 id="projectEditWrong" class="d-none">Something went wrong!</h5>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="projectEditConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>

    </div>
  </div>
</div>




  @endsection





@section('script')

<script type="text/javascript">

getProjectsData();

function getProjectsData() {

axios.get('/getProjectsData')
    .then(function(response) {

        if (response.status == 200) {

            $('#mainDiv').removeClass('d-none');
            $('#loaderDiv').addClass('d-none');

          
            $('#projectDataTable').DataTable().destroy();
             $('#project_table').empty();
             //$('#service_table').html(null);



            var jsonData = response.data;

            $.each(jsonData, function(i, item) {
                $('<tr>').html(
                    "<td class='th-sm' >" + jsonData[i].project_name + "</td>" +
                    "<td class='th-sm'>" + jsonData[i].project_des + "</td>" +
                    "<td class='th-sm'><a data-toggle='modal' class='projectEditBtn' data-id=" + jsonData[i].id + " data-target='#editModal' ><i class='fas fa-edit'></i></a></td>" +
                    "<td class='th-sm'><a data-toggle='modal' class='projectDeleteBtn' data-id=" + jsonData[i].id + " data-target='#deleteModal' href='' ><i class='fas fa-trash-alt'></i></a></td>"
                ).appendTo('#project_table');

            });

     
        
             /* Project Delete icon Onclick */
             $('.projectDeleteBtn').click(function(){

                $('#deleteProjectModal').modal('show');

                var id = $(this).data('id');
                 $('#projectDeleteID').html(id);

              });



            // Project Edit icon click
             $('.projectEditBtn').click(function() {
    
                  var id = $(this).data('id');
                   getProjectEditFormData(id);

                  $('#projectEditID').html(id);
                  $('#editProjectModal').modal('show');

              });


              
                     /* DataTable Library */
                 $('#projectDataTable').DataTable({"order":false});
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






/* Add New Project Button Click */
$('#addNewProjectBtnID').click(function(){

     $('#addProjectModal').modal('show');

});





/*Project Data Add Confirm Save button onclick*/
$('#ProjectAddConfirmBtn').click(function(){


var ProjectName = $('#ProjectNameId').val();
var ProjectDes = $('#ProjectDesId').val();
var ProjectLink = $('#ProjectLinkId').val();
var ProjectImg = $('#ProjectImgId').val();


var url = '/ProjectsDataInsert';
var data = {
        project_name : ProjectName,
        project_des : ProjectDes,
        project_link : ProjectLink,
        project_img : ProjectImg

};


if ( ProjectName.length == 0) {

toastr.error('Project Name is empty!');

} else if (ProjectDes.length == 0) {
toastr.error('Project Description is empty!');

} else if (ProjectLink.length == 0) {

toastr.error('Project Link is empty!');

} else if (ProjectImg.length == 0) {
toastr.error('Project Image is empty!');

}else {

/*progress spinner*/
$('#ProjectAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");

axios.post(url, data)
    .then(function(response) {

        $('#ProjectAddConfirmBtn').html('Save');

        if (response.status == 200) {

            if(response.data ==1) {

                $('#addProjectModal').modal('hide');
                toastr.success('Add Success');
                getProjectsData();

            }else {

                $('#addProjectModal').modal('hide');
                toastr.error('Add Fail');
                getProjectsData();

            }

        } else {

            $('#addProjectModal').modal('hide');
            toastr.error('Something Went Wrong!');
        }


    })
    .catch(function(error) {

         $('#addProjectModal').modal('hide');
         toastr.error('Something Went Wrong!');

    });


} /* else ended */

});

//Project Data Add Confirm Save button onclick Ended




// Project Delete Modal Yes Button
$('#projectDeleteConfirmBtn').click(function() {

var id = $('#projectDeleteID').html();
    ProjectDelete(id);

});


/* Project Delete Function Started*/
function ProjectDelete(deleteID) {

/*progress spinner*/
$('#projectDeleteConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");

axios.post('/ProjectsDelete', {
        id: deleteID
    })
    .then(function(response) {

    $('#projectDeleteConfirmBtn').html('Yes');

        if (response.status == 200) {

            if (response.data == 1) {

                $('#deleteProjectModal').modal('hide');
                toastr.success('Delete Success');
                 getProjectsData();

            } else {

                $('#deleteProjectModal').modal('hide');
                toastr.error('Delete Fail');
                getProjectsData();


            }

        } else {

            $('#deleteProjectModal').modal('hide');
            toastr.error('Something Went Wrong!');
        }


    })
    .catch(function(error) {

        $('#deleteProjectModal').modal('hide');
        toastr.error('Something Went Wrong!');
    });



} /*ProjectDelete function Ended*/







/* Project Edit Form Data Show function started */
function getProjectEditFormData(editFormID) {

axios.post('ProjectEditform', {
        id: editFormID
    })
    .then(function(response) {

        if (response.status == 200) {

            $('#projectEditForm').removeClass('d-none');
            $('#projectEditLoader').addClass('d-none');

            var jsonData = response.data;

            $('#ProjectNameUpdateId').val(jsonData[0].project_name);
            $('#ProjectDesUpdateId').val(jsonData[0].project_des);
            $('#ProjectLinkUpdateId').val(jsonData[0].project_link);
            $('#ProjectImgUpdateId').val(jsonData[0].project_img);


        } else {

            $('#projectEditLoader').addClass('d-none');
            $('#projectEditWrong').removeClass('d-none');

        }


    })
    .catch(function(error) {


        $('#projectEditLoader').addClass('d-none');
        $('#projectEditWrong').removeClass('d-none');

    });


}/* Project Edit Form Data Show function Ended */





/* Project Edit Confirm Save button Click */
$('#projectEditConfirmBtn').click(function() {



var id = $('#projectEditID').html();
var update_name = $('#ProjectNameUpdateId').val();
var update_des = $('#ProjectDesUpdateId').val();
var update_link = $('#ProjectLinkUpdateId').val();
var update_img = $('#ProjectImgUpdateId').val();

   ProjectUpdate(id, update_name, update_des, update_link, update_img);

});


/* ProjectUpdate function Started*/
function ProjectUpdate(projectEditID, projectName, projectDes, projectLink, projectImg) {


if (projectName.length == 0) {
    toastr.error('Project Name is empty!');
}else if (projectDes.length == 0) {
    toastr.error('Project Description is empty!');
}else if (projectLink.length == 0) {
    toastr.error('Project Link is empty!');
}else if (projectImg.length == 0) {
    toastr.error('Project Image is empty!');

}
else {

        
    /*progress spinner*/
   $('#projectEditConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
  
    axios.post('/ProjectUpdate', {

            id : projectEditID,
            project_name : projectName,
            project_des : projectDes,
            project_link : projectLink,
            project_img : projectImg

        })
        .then(function(response) {

            $('#projectEditConfirmBtn').html('Save');

            if (response.status == 200) {

                if (response.data==1) {

                    $('#editProjectModal').modal('hide');
                    toastr.success('Update Success');
                    getProjectsData();

                } else {

                    $('#editProjectModal').modal('hide');
                    toastr.error('Update Fail');
                    getProjectsData();

                }

            } else {
                 $('#editProjectModal').modal('hide');
                 toastr.error('Something Went Wrong!');
            }

        })
        .catch(function(error) {

               $('#editProjectModal').modal('hide');
               toastr.error('Something Went Wrong!');

        });


} /* Else ended */


} /* Project Update Function Ended*/






</script>
@endsection