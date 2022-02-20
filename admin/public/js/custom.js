$(document).ready(function () {
$('#VisitorDt').DataTable();
$('.dataTables_length').addClass('bs-select');
});


getServicesData();

function getServicesData(){


    axios.get('/getServicesData')
    .then(function (response) {


      var dataJSON=response.data;

      console.log(dataJSON);

    
     $.each(dataJSON, function(i, item) {
      $('<tr>').html(
        `<td class="th-sm"><img class="table-img" src="http://localhost/images/code.svg"></td>`);
  
  }).catch(function (error) {
  
  });


}