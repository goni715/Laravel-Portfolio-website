<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReviewModel;

class ReviewController extends Controller {

    function ReviewIndex() {

        return view('Review');
    }




    function getReviewData() {

        $result = json_encode(ReviewModel::orderBy('id','desc')->get());
        return $result;

    }




    /* Review Data Insert function Started */
    function ReviewDataInsert(Request $req) {


        $review_name = $req->input('review_name');
        $review_des = $req->input('review_des');
        $review_img = $req->input('review_img');



        $result = ReviewModel::insertOrIgnore([
            'review_name' => $review_name,
            'review_des' => $review_des,
            'review_img' => $review_img

        ]);


        if ($result == true) {

            return 1;

        } else {

            return 0;
        }


    } /* Review Data Insert function Ended */




    // Review Delete function started
    function ReviewDelete(Request $req) {

        $id = $req->input('id');

        $result = ReviewModel::where('id','=',$id)->delete();

        if ($result == true) {

            return 1;

        } else {

            return 0;
        }


    } /* Review Delete functin Ended */




    /* Review Edit form Data show function Started */
    function getReviewEditFormData(Request $req) {

        $id = $req->input('id');

        $result = json_encode(ReviewModel::where('id','=',$id)->get());

        return $result;


    } /* Review Edit form Data show function Ended */




    /* Review Update function Started */
    function ReviewUpdate(Request $req) {

        $id = $req->input('id');
        $review_name = $req->input('review_name');
        $review_des = $req->input('review_des');
        $review_img = $req->input('review_img');



        $result = ReviewModel::where('id','=',$id)->update([

            'review_name'=>$review_name,
            'review_des'=>$review_des,
            'review_img'=>$review_img
        ]);



        if ($result == true) {

            return 1;

        } else {

            return 0;
        }


    } /* Review Update function Ended */




}