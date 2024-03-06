<?php

namespace App\Http\Controllers;

use App\Http\Requests\Sport\AchievementSaveRequest;
use App\Http\Requests\sport\AchievementUpdateRequest;
use App\Models\Achievement;
use App\Models\Sport;
use App\Models\Student;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AchievementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($studentId)
    {

        $student = Student::findOrFail($studentId);
        //$sports = Sport::all();
        $sports = $student->sports()->get();
        return Inertia::render("Sport/AddAchievement", ['student' => $student, 'sports' => $sports]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AchievementSaveRequest $request, int $studentId)
    {
        //dd($request);
        $validatedData = $request->validated();
        // $studentId = $validatedData['sport_id'];
        $student = Student::findOrFail($studentId);
        //dd($validatedData);
        $achievement = Achievement::create([
            'student_id' => $studentId,
            'sport_id' => $validatedData['sport_id'],
            'achievement_name' => $validatedData["achievement_name"],
            'achievement_date' => $validatedData['achievement_date'],
            'achievement_type' => $validatedData['achievement_type'],
            'achievement_level' => $validatedData['achievement_level'],
            'achievement_status' => $validatedData['achievement_status'],
            'age_gap' => $validatedData['age_gap'],
            'description' => $validatedData['description']
        ]);
        return redirect()->route('sport.index', $studentId);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $studentId, int $achievementId)
    {
        //dd($achievementId);
        $achievement = Achievement::with('sport')->findOrFail($achievementId);
        $student = Student::findOrFail($studentId);
        $sports = $student->sports()->get();
        //$sportName = $achievement->sport->sport_name;
        //$sports = Sport::all();

        //dd($achievement);
        return Inertia::render("Sport/EditAchievement", ['achievement' => $achievement, 'sports' => $sports, 'student' => $student]);
        //return Inertia::render("Sport/EditAchievement");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AchievementUpdateRequest $request, int $studentId, int $AchievementId)
    {
        //dd($request);
        $validatedData = $request->validated();
        // $studentId = $validatedData['sport_id'];
        //$student = Student::findOrFail($studentId);
        $achievement = Achievement::findOrFail($AchievementId);

        //dd($validatedData);
        $achievement->update([
            'student_id' => $studentId,
            'sport_id' => $validatedData['sport_id'],
            'achievement_name' => $validatedData["achievement_name"],
            'achievement_date' => $validatedData['achievement_date'],
            'achievement_type' => $validatedData['achievement_type'],
            'achievement_level' => $validatedData['achievement_level'],
            'achievement_status' => $validatedData['achievement_status'],
            'age_gap' => $validatedData['age_gap'],
            'description' => $validatedData['description']
        ]);
        return redirect()->route('sport.index', $studentId);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $studentId, int $achievementId)
    {
        //dd($achievementId);
        try {
            $achievement = Achievement::findOrFail($achievementId);
            //dd($achievement);
            $achievement->delete();
        } catch (ModelNotFoundException $e) {

            //dd($e);
            // Achievement not found, handle error (e.g., return response or log)
            return response()->json(['error' => 'Achievement not found'], 404);
        }

        // Achievement deleted successfully, redirect
        return redirect()->route('sport.index', [$studentId]);
    }
}
