<?php

namespace App\Http\Controllers;

use PDF;
use App\Event;
use App\Http\Requests\StudentRequest;
use App\Jobs\SendEventEmail;
use Illuminate\Support\Facades\Mail;
use App\Mail\StudentEventReportMail;
use App\OSA;
use App\Student;
use App\AuthorizedPersonnel;
use App\College;
use App\CollegeCourse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        return response()->json(
            $students
        );
    }

    public function showStudentListPage() {
        $colleges = College::all();
        return view('dashboard.student-list', compact('colleges'));
    }

    public function getCollegeCourse(Request $request) {
        $course = CollegeCourse::where('college_id', $request->college_id)->get();
        return response()->json($course);
    }


    public function getEventParticipants()
    {
        $event_students = DB::table('event_student')
        ->select('event.id as event_id', 'event.name', 'event_student.involvement', 'student.id as student_id', 'student.first_name', 'student.middle_initial', 'student.last_name', 'student.created_at', 'student.updated_at')
        ->join('event', 'event_student.event_id', '=', 'event.id')
        ->join('student', 'event_student.student_id', '=', 'student.id')
        ->where('event.status', '!=', '6')
        ->where('event.organization_id', auth()->user()->id)->get();

        return response()->json($event_students);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        $student = Student::where('student_id', $request->student_id)->first();
        if($student)
        {
            return response()->json([
                'success' => false,
                'error' => "Student with the STUDENT_ID of {$request->input('student_id')} already exists",
            ]);
        }
        else 
        {
            $student = Student::create([
                'student_id' => $request->input('student_id'),
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'middle_initial' => $request->input('middle_initial'),
                'college' => $request->college,
                'course' => $request->course
            ]);
            return response()->json([
                'success' => true,
                'student' => $student
            ]);
        }

    }


    public function updateStudentInfo(Request $request)
    {
        // $student = Student::where('student_id', $request->student_id)->first();
        $student = Student::find($request->id);
         if($student->student_id == $request->student_id){
            $check_id = false;
        } 
        else{
            $check_student = Student::where('student_id', $request->student_id)->first();
            if (!empty($check_student)) {
                $check_id = true;
            }
            else {
                $chek_id = false;
            }
        }

        if($check_id === true)
        {
            return response()->json([
                'success' => false,
                'error' => "Student with the STUDENT_ID of {$request->input('student_id')} already exists",
            ]);
        }
        else 
        {
            $student = Student::where('id', $request->id)->update([
                'student_id' => $request->input('student_id'),
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'middle_initial' => $request->input('middle_initial'),
                'college' => $request->college,
                'course' => $request->course
            ]);
            return response()->json([
                'success' => true,
                'student' => $student
            ]);
        }

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::where('id', $id)->with('events')->first();
        return response()->json([
            'student' => $student
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StudentRequest $request, $id)
    {
        $student = Student::find($id);
        if($student)
        {
            $student->last_name = $request->input('last_name');
            $student->first_name = $request->input('first_name');
            $student->middle_initial = $request->input('middle_initial');
            $student->save();

            return response()->json([
                'student' => $student
            ]);
        }
        else 
        {
            return response()->json([
                'error' => 'Student not found'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function getSpecificInfo(Request $request)
    {
        $student = Student::find($request->id);
        return response()->json(
            $student
        );

    }


    public function assignToEvent(Request $request)
    {
        $student_id = $request->student;
        $event_id = $request->event;
        $student = Student::find($student_id);
        $event = Event::find($event_id);

        if($student && $event)
        {
            if($student->events()->where('event.id', $event_id)->get()->count())
            {
                return response()->json([
                    'success' =>  false,
                    'error' => "Student with ID of $student_id has already been registered to event with ID of $event_id"
                ]);
            }
            else 
            {
                $student->events()->attach($event_id, ['involvement' => $request->input('involvement')]);
                return response()->json([
                    'success' =>  true,
                    'student' => Student::find($student_id),
                    'event' => Event::find($event_id),
                    'involvement' => $request->input('involvement'),
                ]);
            }
        }
        else 
        {
            $errors = [];
            if(!$student)
            {
                array_push($errors, "Student with ID of $student_id not found");
            }
            if(!$event)
            {
                array_push($errors, "Event with ID of $event_id not found");
            }
            if($errors)
            {
                return response()->json([
                    'errors' => $errors
                ]);
            }
        }
    }

    public function removeFromEvent($student_id, $event_id)
    {
        $student = Student::find($student_id);
        $event = Event::find($event_id);

        if($student && $event)
        {
            if(!$student->events()->where('event.id', $event_id)->get()->count())
            {
                return response()->json([
                    'error' => "Student with an ID of $student_id is currently not associated with the event with an ID of $event_id"
                ]);
            }
            else 
            {
                $student->events()->detach($event_id);
                return response()->json([
                    'speaker' => Student::find($student_id),
                    'event' => Event::find($event_id),
                ]);
            }
        }
        else 
        {
            $errors = [];
            if(!$student)
            {
                array_push($errors, "Student with ID of $student_id not found");
            }
            if(!$event)
            {
                array_push($errors, "Event with ID of $event_id not found");
            }
            if($errors)
            {
                return response()->json([
                    'errors' => $errors
                ]);
            }
        }
    }

    public function generateReport(Request $request, $id)
    {
        $student = Student::with(['events' => function($query) {
            $query->where('status', Config::get('constants.event_status.cleared'));
        }, 
            'events.organization',
        ])
            ->where('student.id', $id)
            ->first();
        $osa = static::getCurrentUser()->osa;

        $check_ap = AuthorizedPersonnel::all();
        if(count($check_ap) > 0) {
            $ap = AuthorizedPersonnel::find(1);
        }
        else {
            $ap = array();
        }          
            $context = [
            'student' => $student,
            'osa' => $osa,
            'ap' => $ap,
        ];
        /* return $context; */

        /* return view('student.student-event-report')->with($context); */
        if($student)
        {
            if($request->input('export') == true)
            {
                // if($request->input('recipient'))
                // {
                    //$recipient = $request->input('recipient');
                    $pdf = PDF::loadView('student.student-event-report', $context);
                    //SendEventEmail::dispatch($student, $osa, $recipient);
                    /* Mail::to($request->input('recipient'))->send(new StudentEventReportMail($student, $pdf, $osa)); */
                    return $pdf->download(strtoupper($student->last_name) . ", " . strtoupper($student->first_name) . " " . Carbon::now()->toDateString() . ".pdf");
                // }
                // else 
                // {
                //     return response()->json([
                //         'error' => "The send mail action was specified without a entering a recipient email address"
                //     ]);
                // }
            }
            // return response()->json([
            //     'student' => $student,
            //     'send_email' => $request->input('mail'),
            //     'recipient' => $request->input('recipient'),
            // ]);
        }
        else 
        {
            return response()->json([
                'error' => "Student with ID of $id not found"
            ]);
        }
    }
}
