<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    ////return all course list
    public function courseList()
    {

        //select the fields
        try {
            $result = Course::select('name', 'thumbnail', 'lesson_num', 'price', 'id')->get();

            return response()->json([
                'code'  => 200,
                'msg' => 'My course list is here',
                'data'  => $result,
            ], 200);
        } catch (\Throwable $throw) {
            return response()->json([
                'code' => 500,
                'msg' => 'The Column does not exist or syntax error',
                'data' => $throw->getMessage(),
            ], 500);
        }
    }
    ////return a course detail
    public function courseDetail(Request $request)
    {
        //course id
        $id = $request->id;
        //select the fields
        try {
            $result = Course::where('id', '=', $id)->select(
                'id',
                'name',
                'user_token',
                'price',
                'description',
                'video_length',
                'lesson_num',
                'thumbnail',
                'downloadable_res'
            )->first();
            return response()->json([
                'code'  => 200,
                'msg' => 'My course detail is here',
                'data'  => $result,
            ], 200);
        } catch (\Throwable $throw) {
            return response()->json([
                'code' => 500,
                'msg' => 'The Column does not exist or syntax error',
                'data' => $throw->getMessage(),
            ], 500);
        }
    }
}
