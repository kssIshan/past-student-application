<?php

namespace App\Http\Controllers;

use App\Http\Requests\Education\Exam\ExamSaveRequest;
use App\Http\Requests\Education\Exam\ExamUpdateRequest;
use App\Models\Exam;
use App\Models\Result;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Support\Facades\DB;
//use Illuminate\Http\Request;
use Inertia\Inertia;

class ExamController extends Controller
{
    //view for AddEducation form-> create a student
    public function create(int $studentId)
    {
        $student = Student::findOrFail($studentId);
        $subjects = Subject::all();
        return Inertia::render("Education/AddEducation", ['student' => $student, 'subjects' => $subjects]);
    }
    //render the page
    public function index1(int $regNo, String $searchEducationId)
    //public function index1()
    {

        //$student = Student::findOrFail($studentId);
        $student = Student::where('reg_no', $regNo)->first();

        if ($student === null) {
            return "no studnet union found";
        } else {


            if ($searchEducationId == "searchEducation") {
                return Inertia::render("Education/SearchEducationDetails", ['student' => $student]);
            }
            if ($searchEducationId = "searchStudent") {
                return Inertia::render("Education/EducationDetails", ['student' => $student]);
            }
        }



        //$exams = $student->exams()->paginate(1); // Paginate the exams, assuming 10 exams per page

        //return Inertia::render("Education/EducationDetails");

    }

    //show exam details of selected student
    public function index2(int $studentId)
    {

        //$student = Student::with('exams')->findOrFail($studentId);
        $student = Student::findOrFail($studentId);

        $exams = $student->exams()->paginate(1); // Paginate the exams, assuming 10 exams per page

        return response()->json(['student' => $student, 'exams' => $exams]);
        //return Inertia::render("Education/EducationDetails", ['exams' => $exams, 'student' => $student]);
    }
    //show exam details and result of a particular exam
    public function showresult(int $studentId, int $examId, String $searchShowResultId)
    {

        $exam = Exam::with('results')->findOrFail($examId);
        // Assuming $exam->results is a collection of Result models
        $results = $exam->results;

        // Access subject_id values using a loop
        /*foreach ($results as $result) {
            $subjectId = $result->subject_id;
            // Do something with $subjectId
        }*/

        // Or use pluck to get an array of subject_id values
        $subjectIds = $results->pluck('subject_id')->toArray();

        // Dump the result for debugging
        //dd($subjectIds);
        //$results = DB::select('select * from results where exam_id=?', [$examId]);
        //dd($results);
        // Assuming $subjectIds is an array of subject_id values

        // Retrieve all records from the 'results' table where the 'id' matches any value in $subjectIds
        $subjects = Subject::whereIn('id', $subjectIds)->get();
        //$subjectName = $results->pluck('name')->toArray();
        // Dump the results for debugging
        //dd($subjectName);
        $student = Student::findOrFail($studentId);


        if ($searchShowResultId == "searchShowResult") {
            return Inertia::render("Education/SearchShowResult", ['exam' => $exam, 'subjects' => $subjects,  'student' => $student]);
        }
        if ($searchShowResultId = "searchStudent") {
            return Inertia::render("Education/ShowResult", ['exam' => $exam, 'subjects' => $subjects,  'student' => $student]);
        }
    }
    //store exam details of selected student
    public function store(ExamSaveRequest $request, int $studentId)
    {
        $student = Student::findOrFail($studentId);
        $validatedData = $request->validated();
        //dd($validatedData);
        $exam = Exam::create([
            'student_id' => $studentId,
            'index_no' => $validatedData['index_no'],
            'type' => $validatedData['type'],
            'exam_year' => $validatedData['exam_year'],
            'attempt' => $validatedData['attempt'],
            'island_rank' => $validatedData['island_rank'],
            'district_rank' => $validatedData['district_rank'],
            'z_score' => $validatedData['z_score'],
            'cut_of_marks' => $validatedData['cut_of_marks'],
            'subject_stream' => $validatedData['subject_stream'],
            'is_pass' => $validatedData['is_pass'],
        ]);
        //this is a nother method to save array
        /* $resultData = collect($request['results'])->map(function ($result) {
            return [
                'subject_id' => $result['subject_id'],
                'grade' => $result['grade'],
            ];
        })->toArray();

        // Create Result records
        $exam->results()->createMany($resultData);*/

        //$resultarray = $request->results;
        $resultarray = $validatedData['results'];
        //dd($resultarray);

        foreach ($resultarray as  $result) {
            //check the retrived array they carry null values there fore it throw 
            //error when exam saved without values. so i used if statement to save results
            if ($result['subject_id'] !== null) {
                Result::create([
                    'exam_id' => $exam->id,
                    'subject_id' => $result['subject_id'],
                    'grade' => $result['grade'],
                ]);
            }
        }


        return redirect()->route('exam.create', $student);
    }
    //get exam details and result details. since exam is connected with results with hasMany relationship
    //results data can be taken along with exam deatails
    public function edit(int $studentId, int $examId)
    {
        $exam = Exam::with('results')->findOrFail($examId);
        $subjects = Subject::all();
        $student = Student::findOrFail($studentId);
        // $resultData = Result::findOrFail($examId);
        //$resultData = Result::where('exam_id', $examId)->get();

        return Inertia::render("Education/EditEducation", ['exam' => $exam, 'subjects' => $subjects, 'student' => $student]);
    }
    public function update(ExamUpdateRequest $request, int $studentId, int $examId)
    {
        //dd($request);
        $validatedRequest = $request->validated();
        //dd($validatedRequest);
        $exam = Exam::with('results')->findOrFail($examId);
        //$studentId = $exam->student_id;
        //dd($exam->results);
        //dd($request);
        $exam->update([
            'student_id' => $studentId,
            'index_no' => $request->input('index_no'),
            'type' => $request->input('type'),
            'exam_year' => $request->input('exam_year'),
            'attempt' => $request->input('attempt'),
            'island_rank' => $request->input('island_rank'),
            'district_rank' => $request->input('district_rank'),
            'z_score' => $request->input('z_score'),
            'cut_of_marks' => $request->input('cut_of_marks'),
            'subject_stream' => $request->input('subject_stream'),
            'is_pass' => $request->input('is_pass'),
        ]);


        //$resultarray = $exam->results;
        //dd($resultarray);
        //delete and create new result array
        /*$exam->results()->delete();
        $resultData = collect($request['results'])->map(function ($result) {
            return [
                'subject_id' => $result['subject_id'],
                'grade' => $result['grade'],
            ];
        })->toArray();
        $exam->results()->createMany($resultData);*/

        //update existing result set without deleting previous result array
        /*foreach ($resultarray as $key => $result) {
            //if ($subject_id)
            $result->update([
                'subject_id' => $validatedRequest["results.$key.subject_id"],
                'grade' => $validatedRequest["results.$key.grade"],

            ]);
        }*/
        $result = $exam->results;
        if ($result !== null) {
            // Get all subject IDs from the database for the current exam
            $existingSubjectIds = Result::where('exam_id', $examId)->pluck('subject_id')->toArray();

            // Get subject IDs from $validatedRequest
            $updatedSubjectIds = collect($validatedRequest['results'])->pluck('subject_id')->toArray();

            // Identify subject IDs that exist in the database but not in $validatedRequest
            $subjectIdsToDelete = array_diff($existingSubjectIds, $updatedSubjectIds);

            // Delete results for subject IDs that are not present in $validatedRequest
            Result::where('exam_id', $examId)
                ->whereIn('subject_id', $subjectIdsToDelete)
                ->delete();
            foreach ($validatedRequest['results'] as  $resultData) {
                // Access subject_id and grade from the nested array
                $subjectId = $resultData['subject_id'];
                $grade = $resultData['grade'];

                // Check if a result with the same subject_id exists
                $existingResult = Result::where('exam_id', $examId)
                    ->where('subject_id', $subjectId)
                    ->first();

                if ($existingResult) {
                    // If the result exists, update it
                    $existingResult->update([
                        'grade' => $grade,
                    ]);
                } else {
                    // If the result does not exist, insert a new result
                    Result::create([
                        'exam_id' => $examId,
                        'subject_id' => $subjectId,
                        'grade' => $grade,
                    ]);
                }
            }
        }




        return redirect()->route('exam.showresult', [$studentId, $examId]);
    }
    public function destroy(int $studentId, int $examId)
    {
        $exam = Exam::findOrFail($examId);
        $exam->delete();
        return redirect()->route('exam.showresult', [$studentId, $examId]);
    }
}
