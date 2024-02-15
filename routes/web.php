<?php

use App\Http\Controllers\AchievementController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SportController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UnionController;
use App\Http\Controllers\UnionProjectController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



    Route::get('/student/{regNo}/show', [StudentController::class, 'show'])->name('student.show');
    Route::get('/student/{firstName}/{lastName}/showbyName', [StudentController::class, 'showbyName'])->name('student.showbyName');
    //Route::get('/student', [StudentController::class, 'index'])->name('student.index');
    Route::get('/student/viewAddStudentForm', [StudentController::class, 'viewAddStudentForm'])->name('student.viewAddStudentForm');
    Route::get('/student/searchStudent', [StudentController::class, 'searchStudent'])->name('student.searchStudent');
    Route::get('/student/{studentId}/edit', [StudentController::class, 'edit'])->name('student.edit');
    Route::put('/student/{studentId}/update', [StudentController::class, 'update'])->name('student.update');
    Route::delete('/student/{studentId}/destroy', [StudentController::class, 'destroy'])->name('student.destroy');
    Route::post('/student/store', [StudentController::class, 'store'])->name('student.store');

    Route::get('/student/{student}/exam/create', [ExamController::class, 'create'])->name('exam.create');
    Route::get('/student/{student}/exam/index', [ExamController::class, 'index'])->name('exam.index');
    Route::post('/student/{studentId}/exam/store', [ExamController::class, 'store'])->name('exam.store');
    Route::get('/student/{studentId}/exam/{examId}/edit', [ExamController::class, 'edit'])->name('exam.edit');
    Route::put('/student/{studentId}/exam/{examId}/update', [ExamController::class, 'update'])->name('exam.update');
    Route::delete('/student/{studentId}/exam/{examId}/destroy', [ExamController::class, 'destroy'])->name('exam.destroy');
    Route::get('/student/{studentId}/exam/{examId}/showresult', [ExamController::class, 'showresult'])->name('exam.showresult');

    // Route::get('/result/{studentId}/show', [ResultController::class, 'show'])->name('result.show');
    // Route::post('/result/store', [ResultController::class, 'store'])->name('result.store');

    //Route::get('/union', [UnionController::class, 'index'])->name('union.index');
    //correct the error heredue to same url signature
    //Route::get('/union/{unionId}', [UnionController::class, 'index'])->name('union.index');
    Route::post('/union/store', [UnionController::class, 'store'])->name('union.store');
    Route::get('student/{studentId}/union/', [UnionController::class, 'index'])->name('union.index');
    Route::get('student/{studentId}/union/{unionId}/project', [UnionController::class, 'create'])->name('union.create');
    Route::delete('student/{studentId}/union/{unionId}/project', [UnionController::class, 'destroy'])->name('union.destroy');

    Route::get('/project/union/{unionId}', [ProjectController::class, 'index'])->name('project.index');
    //need to render in UnionProjectDetails.vue error occur due to same url signature
    //Route::get('/project/union/{unionId}', [ProjectController::class, 'index2'])->name('project.index2');
    Route::post('/project/store', [ProjectController::class, 'store'])->name('project.store');
    Route::post('student/{studentId}/union/{unionId}/project/store', [ProjectController::class, 'attachProject'])->name('unionProject.attachProject');


    Route::get('student/{studentId}/unionProject/create', [UnionProjectController::class, 'create'])->name('unionProject.create');
    Route::get('student/{studentId}/unionProject/{unionId}', [UnionProjectController::class, 'index'])->name('unionProject.index');
    //Route::get('student/{studentId}/unionProject/{unionId}/create2', [UnionProjectController::class, 'create2'])->name('unionProject.create2');


    Route::get('student/{studentId}/unionProject/{unionId}/edit', [UnionProjectController::class, 'edit'])->name('unionProject.edit');
    Route::post('student/{student}/unionProject/store', [UnionProjectController::class, 'store'])->name('unionProject.store');
    //Route::post('student/{studentId}/unionProject/{unionId}/store', [UnionProjectController::class, 'attachProject'])->name('unionProject.attachProject');
    Route::delete('student/{studentId}/union/{unionId}/project/{projectId}', [UnionProjectController::class, 'destroy'])->name('unionProject.destroy');
    Route::put('student/{studentId}/unionProject/{unionId}', [UnionProjectController::class, 'update'])->name('unionProject.update');

    Route::get('student/{studentId}/sport/index', [SportController::class, 'index'])->name('sport.index');
    Route::get('student/{studentId}/sport/create', [SportController::class, 'create'])->name('sport.create');
    Route::delete('student/{studentId}/sport/{sportId}', [SportController::class, 'destroy'])->name('sport.destroy');
    Route::put('student/{studentId}/sport/{sportId}/update', [SportController::class, 'update'])->name('sport.update');
    Route::get('student/{studentId}/sport/{sportId}/edit', [SportController::class, 'edit'])->name('sport.edit');


    Route::get('student/{studentId}/achievement/create', [AchievementController::class, 'create'])->name('achievement.create');
    Route::post('student/{studentId}/achievement/store', [AchievementController::class, 'store'])->name('achievement.store');
    Route::delete('student/{studentId}/achievement/{achievementId}', [AchievementController::class, 'destroy'])->name('achievement.destroy');
    Route::get('student/{studentId}/achievement/{achievementId}/edit', [AchievementController::class, 'edit'])->name('achievement.edit');
    Route::put('student/{studentId}/achievement/{achievementId}/update', [AchievementController::class, 'update'])->name('achievement.update');
    Route::post('student/{studentId}/sport/attach', [SportController::class, 'attachSport'])->name('sport.attach');
});

require __DIR__ . '/auth.php';
