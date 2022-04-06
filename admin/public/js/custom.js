$(document).ready(function() {
    $('#VisitorDt').DataTable();
    $('.dataTables_length').addClass('bs-select');
});




function getServicesData() {

    axios.get('/getServicesData')
        .then(function(response) {

            if (response.status == 200) {


                $('#mainDiv').removeClass('d-none');
                $('#loaderDiv').addClass('d-none');

                $('#service_table').empty();

                var jsonData = response.data;

                $.each(jsonData, function(i, item) {
                    $('<tr>').html(
                        "<td><img class='table-img' src=" + jsonData[i].service_img + "></td>" +
                        "<td class='th-sm' >"+ jsonData[i].service_name + "</td>" +
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


                   // Service Delete Modal Yes Button
                $('#serviceDeleteConfirmBtn').click(function() {

                    var id = $('#serviceDeleteID').html();
                    ServiceDelete(id);

                });




                  /* Service Data Edit Area Started */
                  // Service Edit icon click
                  $('.serviceEditBtn').click(function() {

                       var id = $(this).data('id');
                       $('#serviceEditID').html(id);

                       $('input').val(id);

                        EditIdCheck(id);

                  });






            } else {


                $('#loaderDiv').addClass('d-none');
                $('#wrongDiv').removeClass('d-none');


            }

        }).catch(function(error) {

            $('#loaderDiv').addClass('d-none');
            $('#wrongDiv').removeClass('d-none');

        });




} /* Function End */





/* Service Delete Function Started*/

function ServiceDelete(deleteID) {


    axios.post('/ServiceDelete', {
            id: deleteID
        })
        .then(function(response) {

            if (response.data == 1) {

                $('#deleteModal').modal('hide');
                toastr.success('Delete Success');
                getServicesData();

            } else {

                $('#deleteModal').modal('hide');
                toastr.error('Delete Fail');
                getServicesData();


            }


        })
        .catch(function(error) {

        });




} /*serviceDelete function Ended*/




function EditIdCheck(editID) {


    axios.post('/ServiceEdit', {
            id: editID
        })
        .then(function(response) {

            var jsonData = response.data;

              //console.log(jsonData);
           //$.each(jsonData, function(i, item) {

                  $('#name').val(jsonData[0].service_name);
                  $('#des').val(jsonData[0].service_des);
                  $('#img').val(jsonData[0].service_img);

           //});


        })
        .catch(function(error) {

        });


    }
