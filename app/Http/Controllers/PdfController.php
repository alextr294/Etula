<?php

namespace App\Http\Controllers;
use PDF;
use App\Lesson;
use App\User;
use App\TeachingUnit;

use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function createPDF(Request $request){
        $student = $request->user()->studentAccess;
        $AllLessons = Lesson::all();
        $PresentLessons = $student->presentLessons;

        $c=0;
        foreach($AllLessons as $lesson){
            if(strtotime($lesson->begin_at)<strtotime("last Monday") or strtotime($lesson->begin_at)>strtotime("next Sunday")){
                unset($AllLessons[$c]);
            }
            $c++;
        }

        $PresentLessonsId = [];
        foreach ($PresentLessons as $lesson) {
            $PresentLessonsId [] = $lesson->id;
        }


        $pdf = PDF::loadView('pdf',compact('PresentLessonsId','AllLessons'));
        $name = "Etula.pdf";
        return $pdf->download($name);
    }
}
