



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
                        "<td class='th-sm'><a data-toggle='modal' class='s' data-id=" + jsonData[i].id + " data-target='#editModal' ><i class='fas fa-eye'></i></a></td>" +
                        "<td class='th-sm'><a data-toggle='modal' class='' data-id=" + jsonData[i].id + " data-target='#editModal' ><i class='fas fa-edit'></i></a></td>" +
                        "<td class='th-sm'><a data-toggle='modal' class='' data-id=" + jsonData[i].id + " data-target='#deleteModal' href='' ><i class='fas fa-trash-alt'></i></a></td>"
                    ).appendTo('#courses_table');

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





