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

    //get basic information of searched student
    public function show(int $studentId)
    {
        $student = Student::findOrFail($studentId);

        return Inertia::render("Student/BasicInformation", ['student' => $student]);
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
        $request->validated();
        $uuid = Str::uuid();
        $id = Auth::id();
        Student::create([
            'uuid' => $uuid,
            'user_id' => $id,
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'dob' => $request->input('dob'),
            'date_of_admission' => $request->input('date_of_admission'),
            'date_of_leave' => $request->input('date_of_leave'),
            'address' => $request->input('address'),
            'email' => $request->input('email'),
            'mobile_no' => $request->input('mobile_no'),
            'land_no' => $request->input('land_no'),

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
        $request->validated();
        $student = Student::findOrFail($studentId);
        $uuid = Str::uuid();
        $id = Auth::id();

        $student->update([
            'uuid' => $uuid,
            'user_id' => $id,
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'dob' => $request->input('dob'),
            'date_of_admission' => $request->input('date_of_admission'),
            'date_of_leave' => $request->input('date_of_leave'),
            'address' => $request->input('address'),
            'email' => $request->input('email'),
            'mobile_no' => $request->input('mobile_no'),
            'land_no' => $request->input('land_no'),

        ]);

        return redirect()->route('dashboard');
    }

    public function destroy(int $studentId)
    {
        $student = Student::findOrFail($studentId);
        $student->delete();
        return redirect()->route('dashboard');
    }
}
