<?php

use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\AdminContorller;
use App\Http\Controllers\AdminToParentsController;
use App\Http\Controllers\ClassRoomController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\LectuersController;
use App\Http\Controllers\PayInfoController;
use App\Http\Controllers\SchedulesController;
use App\Http\Controllers\subjectsController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\TeachersController;
use App\Http\Controllers\UsersControler;
use App\Models\AdminToParents;
use Illuminate\Support\Facades\Route ;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

Route::prefix('admin')->middleware('theme:admin')->name('admin.')->group(function () {
    Route::view('/login', 'auth.login')->middleware('guest:admin')->name('login');    
    Route::view('/register', 'auth.register')->name('register'); 
  
    $limiter = config('fortify.limiters.login');


    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->middleware(array_filter([
            'guest:admin',
            $limiter ? 'throttle:'.$limiter : null,
        ]));
    
        Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->middleware('auth:admin')
        ->name('logout');

    Route::get('/home', [AdminContorller::class , 'home'])->middleware('auth:admin')->name('home');
    
    Route::get('teachers/index' , [TeachersController::class , 'index'])->middleware('auth:admin')->name('teachers');
    Route::get('teachers/create' , [TeachersController::class , 'create'])->middleware('auth:admin')->name('teacher.create');
    Route::post('teachers/store' , [TeachersController::class , 'store'])->middleware('auth:admin')->name('teacher.store');
    Route::get('teachers/{id}/insert' , [TeachersController::class , 'insert'])->middleware('auth:admin')->name('teacher.insert');
    Route::get('teachers/{id}/edit' , [TeachersController::class , 'edit'])->middleware('auth:admin')->name('teacher.edit');
    Route::get('teachers/account' , [TeachersController::class , 'account'])->middleware('auth:admin')->name('teacher.account');
    Route::get('teachers/{User}/account' , [TeachersController::class , 'active'])->middleware('auth:admin')->name('teacher.active');
    Route::get('teachers/{User}/unaccount' , [TeachersController::class , 'unactive'])->middleware('auth:admin')->name('teacher.unactive');
    Route::put('teachers/{teacher}/update' , [TeachersController::class , 'update'])->middleware('auth:admin')->name('teacher.update');


    // classRooms 
    Route::get('classroom/index' , [ClassRoomController::class , 'index'])->middleware('auth:admin')->name('classroom');
    Route::get('classroom/create' , [ClassRoomController::class , 'create'])->middleware('auth:admin')->name('classroom.create');
    Route::post('classroom/store' , [ClassRoomController::class , 'store'])->middleware('auth:admin')->name('classroom.store');
    Route::get('classroom/{id}/students' , [ClassRoomController::class , 'show'])->middleware('auth:admin')->name('classroom.student');

//
    Route::post('theacher/store' , [UsersControler::class , 'storeTeacher'])->middleware('auth:admin')->name('store.theacher');

// subject
    
    Route::get('subject/{id}/class' , [subjectsController::class , 'getSubjectClass'])->middleware('auth:admin')->name('subject.class');
    Route::get('subject/index' , [subjectsController::class , 'index'])->middleware('auth:admin')->name('subjects_index');
    Route::get('subject/create' , [subjectsController::class , 'create'])->middleware('auth:admin')->name('subjects_create');
    Route::post('subject/store' , [subjectsController::class , 'store'])->middleware('auth:admin')->name('subjects_store');
    Route::delete('subject/{id}/subject', [subjectsController::class, 'destroy'])->middleware('auth:admin')->name('subjects_destroy');
    Route::put('subject/{subjects}/update', [subjectsController::class, 'update'])->middleware('auth:admin')->name('subjects_update');

    //
    
// lectures
    Route::get('lecture/{id}/show', [LectuersController::class , 'show'])->middleware('auth:admin')->name('lecture.show');
    Route::get('lecture/index', [LectuersController::class , 'index'])->middleware('auth:admin')->name('lecture.index');
    Route::get('lecture/create', [LectuersController::class , 'create'])->middleware('auth:admin')->name('lecture.create');
    Route::post('lecture/store', [LectuersController::class , 'store'])->middleware('auth:admin')->name('lecture.store');
    Route::any('lecture/{video_id}',[LectuersController::class ,'getVideo'])->middleware('auth:admin')->name('lacture.video');

// attendances

Route::get('Attendance/{id}/Class', [LectuersController::class , 'AttendanceClass'])->middleware('auth:admin')->name('attebdces');

    // content 

    Route::get('content/{id}/create' , [ContentController::class , 'create'])->middleware('auth:admin')->name('content.create');
    Route::post('content/store' , [ContentController::class , 'store'])->middleware('auth:admin')->name('content.store');
  


// schedule 

    Route::get('schedule/index' , [SchedulesController::class , 'index'])->middleware('auth:admin')->name('schedule.index');
    Route::get('schedule/create' , [SchedulesController::class , 'create'])->middleware('auth:admin')->name('schedule.create');
    Route::post('schedule/store' , [SchedulesController::class , 'store'])->middleware('auth:admin')->name('schedule.store');
    Route::delete('schedule/{id}/subject', [SchedulesController::class, 'destroy'])->middleware('auth:admin')->name('schedule_destroy');
    Route::put('schedule/{schedule}/update', [SchedulesController::class, 'update'])->middleware('auth:admin')->name('schedule_update');
//  schedule ajax
    Route::get('schedule/{class_room_id}/getScheduleClass' , [SchedulesController::class , 'getScheduleClass'])->middleware('auth:admin')->name('schedule.getScheduleClass');
 

    //pay
Route::get('pay/{id}/ShowPayStudent' , [PayInfoController::class , 'ShowPayStudent'])->middleware(['auth:admin'])->name('ShowPayStudent');
Route::post('pay/store' , [PayInfoController::class , 'store'])->middleware(['auth'])->name('pay.store');



Route::get('Messages/AdminToParents' , [AdminToParentsController::class , 'index'])->middleware('auth:admin')->name('message.AdminToParents');
 
//
Route::get('News/index' , [NewsController::class , 'index'])->middleware('auth:admin')->name('News.index');
Route::get('News/create' , [NewsController::class , 'create'])->middleware('auth:admin')->name('News.create');
Route::post('News/store' , [NewsController::class , 'store'])->middleware('auth:admin')->name('News.store');
Route::delete('News/{id}/subject', [NewsController::class, 'destroy'])->middleware('auth:admin')->name('News.destroy');
Route::put('News/{News}/update', [NewsController::class, 'update'])->middleware('auth:admin')->name('News.update');



// 
Route::get('/push-notificaiton', [NotificationsController::class, 'index'])->name('push-notificaiton');
Route::post('/store-token', [NotificationsController::class, 'storeToken'])->name('store.token');
Route::post('/send-web-notification', [NotificationsController::class, 'sendWebNotification'])->name('send.web-notification');

});

?>