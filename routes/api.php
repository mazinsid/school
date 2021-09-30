<?php

use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\StudantAPIController;
use App\Http\Controllers\PirantsAPIController;
use App\Http\Controllers\TeachersAPIController;
use App\Http\Controllers\StudentController;
use App\Models\students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// studant API APP
Route::post('StudantInfoAPI' , [StudantAPIController::class , 'StudantInfoAPI']);
Route::post('TeachersLestAPI' , [StudantAPIController::class , 'TeachersLestAPI']);
Route::post('SubjectsAPI' , [StudantAPIController::class , 'SubjectsAPI']);
Route::post('LectureAPI' , [StudantAPIController::class , 'LectureAPI']);
Route::post('LectureContentAPI' , [StudantAPIController::class , 'LectureContentAPI']);
Route::post('LectureChatAPI' , [StudantAPIController::class , 'LectureChatAPI']);
Route::post('LectuerDateAPI' , [StudantAPIController::class , 'LectuerDateAPI']);
Route::post('MessageLectuerAPI' , [StudantAPIController::class , 'MessageLectuerAPI']);
Route::post('HomeworkAPI' , [StudantAPIController::class , 'HomeworkAPI']);
Route::post('ScheduleAPI' , [StudantAPIController::class , 'ScheduleAPI']);
Route::post('LogoutAPI' , [StudantAPIController::class , 'LogoutAPI']);

//notifictaion

Route::post('NotificationAPI', [NotificationsController::class, 'send']);
Route::post('PirantsNotificationAPI', [NotificationsController::class, 'PirantsNotificationAPI']);

// pirants API APP 

Route::post('SingUpAPI', [PirantsAPIController::class , 'SingUpAPI'] );
Route::post('PirantSingInAPI', [PirantsAPIController::class , 'PirantSingInAPI'] );
Route::post('PirantTeachersLestAPI', [PirantsAPIController::class , 'PirantTeachersLestAPI'] );
Route::post('PirantGetMessagesAPI', [PirantsAPIController::class , 'PirantGetMessagesAPI'] );
Route::post('PirantSentMessagesAPI', [PirantsAPIController::class , 'PirantSentMessagesAPI'] );
Route::post('PirantSingOutAPI', [PirantsAPIController::class , 'PirantSingOutAPI'] );
Route::post('AddStudantAPI', [PirantsAPIController::class , 'AddStudantAPI'] );
Route::post('PirantStudantsAPI', [PirantsAPIController::class , 'PirantStudantsAPI'] );
Route::post('EvaluationsAPI', [PirantsAPIController::class , 'EvaluationsAPI'] );
Route::post('PirantNewsAPI', [PirantsAPIController::class , 'PirantNewsAPI'] );


// Teachers App 

Route::post('TeacherSingInAPI', [TeachersAPIController::class , 'TeacherSingInAPI']);
Route::post('TeacherLectuerDateAPI', [TeachersAPIController::class , 'TeacherLectuerDateAPI']);
Route::post('TeacherLectuerContentAPI', [TeachersAPIController::class , 'TeacherLectuerContentAPI']);
Route::post('TeacherLectuerMessageAPI', [TeachersAPIController::class , 'TeacherLectuerMessageAPI']);
Route::post('TeacherSubjectsAPI', [TeachersAPIController::class , 'TeacherSubjectsAPI']);
Route::post('EvaluationSubjectAPI', [TeachersAPIController::class , 'EvaluationSubjectAPI']);
Route::post('EvaluationAddAPI', [TeachersAPIController::class , 'EvaluationAddAPI']);
Route::post('TeacherAddHomworkAPI', [TeachersAPIController::class , 'TeacherAddHomworkAPI']);
Route::post('EvaluationstudantListAPI', [TeachersAPIController::class , 'EvaluationstudantListAPI']);
Route::post('TeacherSingOutAPI', [TeachersAPIController::class , 'TeacherSingOutAPI']);