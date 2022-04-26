@extends('Layout.app')

@section('title', 'ContactPage');




@section('content')


<div class="container-fluid jumbotron mt-5 ">
        <div class="row d-flex justify-content-center">
            <div class="col-md-6  text-center">
                <h1 class="page-top-title mt-3">- যোগাযোগ করুন -</h1>
            </div>
        </div>
    </div>


<div class="container">
    <div class="row">

        <div class="col-md-6">

                <iframe style="width:100%;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d114947.26000127607!2d88.85565274824832!3d25.800212924861988!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39e35049a0597e5d%3A0xdcf3bc5b3efc2369!2sSaidpur%20Upazila!5e0!3m2!1sen!2sbd!4v1650623410842!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>


        <div class="col-md-6 contact-form">
                
                <h3 class="service-card-title">ঠিকানা</h3>
                <hr>
                <p class="footer-text"><i class="fas fa-map-marker-alt"></i> শেখেরটেক ৮ মোহাম্মদপুর, ঢাকা <i class="fas ml-2 fa-phone"></i> ০১৭৮৫৩৮৮৯১৯ <i class="fas ml-2 fa-envelope"></i> Rabbil@Yahoo.com</p>
               

                <div class="form-group ">
                    <input id="contactNameId" type="text" class="form-control w-100 inputDataReset" placeholder="আপনার নাম">
                </div>
                <div class="form-group">
                    <input id="contactMobileId" type="text" class="form-control w-100 inputDataReset" placeholder="মোবাইল নং ">
                </div>
                <div class="form-group">
                    <input id="contactEmailId" type="text" class="form-control w-100 inputDataReset" placeholder="ইমেইল ">
                </div>
                <div class="form-group">
                    <input id="contactMsgId" type="text" class="form-control w-100 inputDataReset" placeholder="মেসেজ ">
                </div>
                <button id="contactSendBtnId" class="btn btn-block normal-btn w-100">পাঠিয়ে দিন </button>
                
        </div>

    </div>
</div>




@endsection