<?php

namespace Étula\Http\Controllers;
use PDF;
use Étula\Lesson;
use Étula\User;

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

    /**
     * Admin: export to pdf.
     * @param $idStudent
     * @return mixed
     */
    public function createPdfAdmin($idStudent) {
        // get student from url parameter
        $student = User::find($idStudent);
        if ($student == null) {
            abort(404,'student not found');
        } else {
            $student = $student->studentAccess;
        }
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
