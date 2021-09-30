<?php
use App\Http\Controllers\AdminContorller;

use App\Http\Controllers\ChatLectureController;
use App\Http\Controllers\HomeworkController;
use App\Http\Controllers\HomeworِAnswerkController;
use App\Http\Controllers\LectuersController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\PayInfoController;
use App\Http\Controllers\SchedulesController;
use App\Http\Controllers\TeachersController;
use App\Http\Controllers\UsersControler;
use App\Models\Parents;
use App\Models\students;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

// web-socut

use App\Events\Chat;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

Route::post('', function (Request $request) {
     (
        new Chat(
            $request->input('lecture_id'),
            $request->input('student_id'),
            $request->input('message')

        )
    );
    return ['success' => true];
});
// 

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [AdminContorller::class , 'UserHome'])->middleware('auth')->name('home');
   

Route::post('logged_in', [LoginController::class, 'authenticate']);
// Route::view('/home', 'home')->middleware('auth')->name('home');
//student routes

Route::get('students/index' , [StudentController::class , 'index'])->middleware('auth')->name('student.index');
Route::get('students/{id}/info' , [StudentController::class , 'insert'])->middleware(['auth', 'parentsinfo'])->name('student.info');
Route::get('students/create' , [StudentController::class , 'create'])->middleware(['auth', 'parentsinfo'])->name('student.create');
Route::get('students/ParentStudents' , [StudentController::class , 'ParentStudents'])->middleware(['auth', 'parentsinfo'])->name('parent.students');
Route::post('students/addinfo' , [StudentController::class , 'store'])->middleware('auth')->name('addinfo.students');
Route::post('students/addstudents' , [UsersControler::class , 'store'])->middleware('auth')->name('store.students');
Route::get('students/{student}/edit' , [StudentController::class , 'edit'])->middleware('auth')->name('edit.students');
Route::get('students/{student}/update' , [StudentController::class , 'update'])->middleware('auth')->name('update.students');


//partent
Route::get('parents/create' , [ParentController::class , 'create'])->middleware('auth')->name('parents.create');
Route::post('parents/insert' , [ParentController::class , 'store'])->middleware('auth')->name('parents.store');

//pay info
Route::get('pay/{id}/GetStudentPay' , [PayInfoController::class , 'GetStudentPay'])->middleware(['auth'])->name('GetStudentPay');
Route::get('pay/{id}/create' , [PayInfoController::class , 'PayStudent'])->middleware(['auth'])->name('PayStudent');
Route::post('pay/store' , [PayInfoController::class , 'store'])->middleware(['auth'])->name('pay.store');

/*
|--------------------------------------------------------------------------
| student Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('schedule/ScheduleStudent',[SchedulesController::class,'ScheduleStudent'])->middleware('auth')->name('schedule.student');
Route::get('schedule/ScheduleDay',[SchedulesController::class,'ScheduleDay'])->middleware('auth')->name('schedule.day');

// lecture

Route::get('student/{id}/lectuer', [LectuersController::class , 'ShowStudent'])->middleware('auth')->name('lecture.student');

//chat lecture
Route::post('student/comment' , [ChatLectureController::class , 'StudentMessage'])->middleware('auth')->name('lecture.comment');


// teachersubject 
Route::get('teacher/subject',[TeachersController::class, 'getSubject'])->middleware('auth')->name('teachersubject');
Route::get('teacher/{subject}/{classroom}/classroom',[TeachersController::class, 'getClassRoom'])->middleware('auth')->name('teacher.class_room');
Route::get('teacher/{id}/lectures',[TeachersController::class, 'getLectures'])->middleware('auth')->name('teacher.lectures');
Route::get('teacher/{studant}/{subject}/evaluations',[TeachersController::class, 'evaluations'])->middleware('auth')->name('teacher.evaluations');

// evaluation
Route::post('Evaluation/store' , [TeachersController::class , 'EvaluationٍٍStore'])->middleware('auth')->name('evaluation.store');
Route::put('Evaluation/{evaluation}/update' , [TeachersController::class , 'EvaluationٍٍUpdate'])->middleware('auth')->name('evaluation.update');



Route::post('homework/store' , [HomeworkController::class , 'store'])->middleware('auth')->name('homework_store');

Route::get('homework/{id}/show' , [HomeworkController::class , 'show'])->middleware('auth')->name('homework_show');  // get homework to student

// homework answer
Route::get('homework/{lectuer_id}/answers',[HomeworِAnswerkController::class , 'index'])->middleware('auth')->name('homeworek_answer_index');

// linke
Route::get('/link', function () {        
    $target = '/domains/inshirahschools.com/lcor/public/storage';
    $shortcut = '/domains/inshirahschools.com/public_html/public';
    symlink($target, $shortcut);
 });

 Route::get('/symlink', function () {
    $target ='/domains/inshirahschools.com/lcor/storage/app/public';
    $link = '/domains/inshirahschools.com/public_html/public/storage';
    symlink($target, $link);
    echo "Done";
 });

require __DIR__.'/admin.php';