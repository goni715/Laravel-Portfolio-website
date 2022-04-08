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




                /* Service Data Edit Area Started */
                // Service Edit icon click
                $('.serviceEditBtn').click(function() {

                    var id = $(this).data('id');
                    $('#serviceEditID').html(id);

                    getServiceEditFormData(id);

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


    /*progress spinner*/
    $('#serviceEditConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");


    if (serviceName.length == 0) {
        toastr.error('Service Name is empty!');
    } else if (serviceDes.length == 0) {
        toastr.error('Service Description is empty!');
    } else if (serviceImg.length == 0) {
        toastr.error('Service Image is empty!');
    } else {

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