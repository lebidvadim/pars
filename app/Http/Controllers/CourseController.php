<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseResource;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CourseController extends Controller
{
    public function getCourses(Request $request) : ResourceCollection
    {
        $courses = Course::filter($request)->get();

        return CourseResource::collection($courses);
    }
    public function getCourse(int $sendCurrency, int $receiveCurrency) : ResourceCollection
    {
        $course = Course::where([
            'send_currency' => $sendCurrency,
            'receive_currency' => $receiveCurrency,
        ])->get();

        return CourseResource::collection($course);
    }
}
