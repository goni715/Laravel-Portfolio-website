@extends('Layout.app')
@section('title','Photo Gallery')
@section('content')

    <div id="mainDivPhoto" class="container-fluid m-0 ">
        <div class="row">
            <div class="col-md-12 p-3">
                <button data-toggle="modal" data-target="#PhotoModal" id="addNewPhotoBtnId" class="btn my-3 btn-sm btn-danger">Add New </button>
            </div>
        </div>

    </div>



    <!-- Modal -->
    <div class="modal fade" id="PhotoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Photo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input class="form-control" id="imgInput" type="file">
                    <img class="imgPreview mt-3" id="imgPreview" src="{{asset('images/default-image.png')}}">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Close</button>
                    <button id="SavePhoto" type="button" class="btn btn-sm btn-success">Save</button>
                </div>
            </div>
        </div>
    </div>



@endsection
@section('script')

<script type="text/javascript">

 $('#imgInput').change(function(){

       var reader = new FileReader();
       reader.readAsDataURL(this.files[0]);

       reader.onload= function(event){

            var ImgSource = event.target.result;
            $('#imgPreview').attr('src',ImgSource);
       }

 });



 $('#SavePhoto').on('click',function () {


    var photoFile= $('#imgInput').prop('files')[0];

         let photoFileName = photoFile.name;
         let photoFileSize = photoFile.size;
         let photoFileExtension = photoFileName.split('.').pop();

         let FileData = new FormData();

         FileData.append('FileKey',photoFile);

         let config = {headers:{'content-type':'multipart/form-data'}};

         var data = {id:1}

           console.log(FileData);
         //axios.post("/PhotoUpload",data)
         axios.post('/PhotoUpload',FileData)
         .then(function (response) {

            alert(response.data);
              
            /* if(response.status ==200){

                 toastr.success('Photo Upload Success');
             }
              */
           }).catch(function (error) {
              

           })

        



  });




</script>
@endsection