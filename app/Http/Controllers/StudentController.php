<?php

namespace App\Http\Controllers;

use App\Http\Requests\Student\StudentSaveRequest;
use App\Http\Requests\Student\StudentUpdateRequest;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    // public function index()
    // {
    //     $students = Student::all();
    //     return Inertia::render("Student/BasicInformation", ['students' => $students]);
    // }

    //get basic information of searched student by registration no.
    public function show(int $regNo)
    {
        $student = Student::where('reg_no', $regNo)->first();

        /* if ($student) {
            //return response()->json(['data' => $student], 200);
            return Inertia::render("Student/BasicInformation", ['student' => $student]);
        } else {
            return Inertia::render("Student/SearchStudent");
        }*/
        //$student = Student::findOrFail($regNo);

        return Inertia::render("Student/BasicInformation", ['student' => $student]);
    }
    public function showbyName(string $firstName, string $lastName)
    {
        $students = Student::where('first_name', $firstName)
            ->where('last_name', $lastName)
            ->get();


        // return Inertia::render("Student/BasicInformation", ['students' => $students]);
        return response()->json(['students' => $students]);
    }

    public function viewAddStudentForm()
    {
        return Inertia::render("Student/AddStudent");
    }
    //Search student
    public function searchStudent()
    {
        return Inertia::render("Student/SearchStudent");
    }
    //Add student to the database
    public function store(StudentSaveRequest $request)
    {

        $validatedRequest = $request->validated();
        //dd($validatedRequest);
        $uuid = Str::uuid();
        $id = Auth::id();
        Student::create([
            'uuid' => $uuid,
            'user_id' => $id,
            'reg_no' => $validatedRequest['reg_no'],
            'nic' => $validatedRequest['nic'],
            'first_name' => $validatedRequest['first_name'],
            'last_name' => $validatedRequest['last_name'],
            'dob' => $validatedRequest['dob'],
            'date_of_admission' => $validatedRequest['date_of_admission'],
            'date_of_leave' => $validatedRequest['date_of_leave'],
            'address' => $validatedRequest['address'],
            'email' => $validatedRequest['email'],
            'mobile_no' => $validatedRequest['mobile_no'],
            'mobile_no2' => $validatedRequest['mobile_no2'],
            'first_name' => $validatedRequest['first_name'],
            'land_no' => $validatedRequest['land_no'],

        ]);
        return redirect()->route('dashboard');
    }
    public function edit(int $studentId)
    {
        $student = Student::findOrFail($studentId);

        return Inertia::render("Student/EditStudent", ['student' => $student]);
    }
    public function update(int $studentId, StudentUpdateRequest $request)
    {
        $validatedRequest = $request->validated();
        $student = Student::findOrFail($studentId);
        //$reg_no = $student->reg_no;
        $uuid = Str::uuid();
        $id = Auth::id();
        $reg_no = $validatedRequest['reg_no'];

        $student->update([
            'uuid' => $uuid,
            'user_id' => $id,
            'reg_no' => $validatedRequest['reg_no'],
            'nic' => $validatedRequest['nic'],
            'first_name' => $validatedRequest['first_name'],
            'last_name' => $validatedRequest['last_name'],
            'dob' => $validatedRequest['dob'],
            'date_of_admission' => $validatedRequest['date_of_admission'],
            'date_of_leave' => $validatedRequest['date_of_leave'],
            'address' => $validatedRequest['address'],
            'email' => $validatedRequest['email'],
            'mobile_no' => $validatedRequest['mobile_no'],
            'mobile_no2' => $validatedRequest['mobile_no2'],
            'first_name' => $validatedRequest['first_name'],
            'land_no' => $validatedRequest['land_no'],

        ]);

        return redirect()->route('student.show', $reg_no);
    }

    public function destroy(int $studentId)
    {
        $student = Student::findOrFail($studentId);
        $student->delete();
        $reg_no = $student->reg_no;
        return redirect()->route('student.show', $reg_no);
    }
}
