



function getCoursesData(){

    axios.get('/getCoursesData')
    .then(function(response) {

            if (response.status == 200) {


                $('#mainDivCourse').removeClass('d-none');
                $('#loaderDivCourse').addClass('d-none');

                $('#courses_table').empty();
            

                var jsonData = response.data;

                $.each(jsonData, function(i, item) {
                    $('<tr>').html(
                        "<th class='th-sm'>"+jsonData[i].course_name+"</th>"+
	                    "<th class='th-sm'>"+jsonData[i].course_fee+"</th>"+
	                    "<th class='th-sm'>"+jsonData[i].course_totalclass+"</th>"+
	                    "<th class='th-sm'>"+jsonData[i].course_totalenroll+"</th>"+
                        "<td class='th-sm'><a data-toggle='modal' class='courseViewDetailsBtn' data-id=" + jsonData[i].id + " data-target='#editModal' ><i class='fas fa-eye'></i></a></td>" +
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



            } else {


                $('#loaderDivCourse').addClass('d-none');
                $('#wrongDivCourse').removeClass('d-none');


            }

        }).catch(function(error) {

                $('#loaderDivCourse').addClass('d-none');
                $('#wrongDivCourse').removeClass('d-none');

        });




} /* Function End */






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

})







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
                    getCoursesData()

                } else {

                    $('#deleteCourseModal').modal('hide');
                    toastr.error('Delete Fail');
                    getCoursesData()


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




/* Service Save button Click */
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
      //  $('#courseEditConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
      
        axios.post('/CourseUpdate', {

                id : courseEditID,
                ourse_name : courseName,
                course_des : courseDes,
                course_fee : courseFee,
                course_totalenroll : courseEnroll,
                course_totalclass : courseClass,
                course_link : courseLink,
                course_img : courseImg

            })
            .then(function(response) {

                $('#courseEditConfirmBtn').html('Save');
               

                     alert(response.data);
           
                    // getCoursesData(); 
             

            })
            .catch(function(error) {

                //$('#editCourseModal').modal('hide');
                //toastr.error('Something Went Wrong!');

            });


    } /* Else ended */


} /* ServiceUpdate Function Ended*/

