<?php

use Illuminate\Http\Request;

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

Route::get('/', function () {
    return view('login');
});

// Updated Custom Dashboard Routes
Route::get('/dashboard', 'UserController@showDashboard');

Route::get('/change-password', function () {
    return view('dashboard.changepassword');
});

Route::get('/post-event-reports', function () {
    return view('dashboard.postevent-reports');
});

Route::get('/search', function () {
    return view('dashboard.postevent-records');
});

Route::get('/account-management', function () {
    return view('dashboard.account-management');
});

Route::get('/student-list', 'StudentController@showStudentListPage');


Route::get('/speaker-list', function () {
    return view('dashboard.speaker-list');
});

Route::get('/student-participants', function () {
    return view('dashboard.student-participants');
});

Route::get('/event-speakers', function () {
    return view('dashboard.event-speaker');
});

 Route::get('/administrator', 'UserController@showAdministratorPage');


//  End


 Route::get('/users/get-all-roles', 'UserController@getAllRoles');
 Route::get('/users/get-all-users', 'UserController@getAllUsers');



// Generate password manually for testing
Route::get('password', 'Auth\RegisterController@generatePassword');


Route::get('user/get-new-password', 'UserController@generateNewPassword');
Route::post('user/update-status', 'UserController@updateStatus');
Route::post('user/update-ap-info', 'UserController@updateApInfo');

Route::get('logout', 'Auth\LoginController@logout');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('students/{id}/generate-report', 'StudentController@generateReport');

/* Route::get('{student_id}/createReport', 'FileController@index'); */

Route::post('register', 'UserController@register');
Route::post('login', 'UserController@authenticate');
Route::post('logout', 'UserController@authenticate');
// Route::group(['middleware' => ['jwt.verify']], function () {
    Route::get('speakers/index', "SpeakerController@index");
    Route::post('speakers/store', "SpeakerController@store");
    Route::post('speakers/update', "SpeakerController@update");
    Route::resource('speakers', 'SpeakerController')->middleware('org.user');
    Route::post('speakers/{speaker_id}/events/{event_id}', "SpeakerController@assignToEvent");
    Route::delete('speakers/{speaker_id}/events/{event_id}', "SpeakerController@removeFromEvent");

    Route::prefix('users')->group(function(){
        
        Route::get('', 'UserController@index');
        Route::get('{id}', 'UserController@show');
        // Route::delete('delete/{id}', 'UserController@destroy');
    });

    Route::prefix('students')->group(function() {
        Route::get('', 'StudentController@index');
        Route::get('get-event-participants', 'StudentController@getEventParticipants');
        Route::get('{id}', 'StudentController@show');
        Route::get('{id}/generate-report', 'StudentController@generateReport')->middleware('osa.user');
        Route::put('{id}', 'StudentController@update');
        
        Route::post('get-specific-info', 'StudentController@getSpecificInfo');
        Route::post('store', 'StudentController@store')->middleware('org.user');
        Route::post('update', 'StudentController@updateStudentInfo')->middleware('org.user');

        Route::post('/get-college-course', 'StudentController@getCollegeCourse');
        Route::post('/events/add', 'StudentController@assignToEvent')->middleware('org.user');
        Route::delete('{student_id}/events/{event_id}', 'StudentController@removeFromEvent')->middleware('org.user');
    });

    Route::prefix('events')->group(function() {
        Route::get('get-post-event-reports', 'EventController@getPostEventReports');
        Route::get('all', 'EventController@index');
        Route::get('get-all-events', 'EventController@getAllEvents');
        Route::post('get-specific-event', 'EventController@getSpecificEvent');
        Route::get('get-all-event-speakers', 'EventController@getAllEventSpeakers');
        Route::post('get-all-speakers', 'EventController@getAllSpeakers');

        Route::delete('speaker', 'EventController@deleteEventSpeaker');

        Route::get('show/{$id}', 'EventController@show');
        Route::get('/search', 'EventController@search');
        Route::get('archived', 'EventController@archived')->middleware('osa.user');
        Route::get('{id}', 'EventController@show');
        Route::put('{id}', 'EventController@update')->middleware('org.user', 'event.owner');
        Route::post('store', 'EventController@store');
        Route::delete('delete', 'EventController@destroy');
        Route::post('{event_id}/students/{student_id}', 'EventController@addStudent')->middleware('org.user');
        Route::post('/speakers/add', 'EventController@addSpeaker')->middleware('org.user');
        Route::delete('{event_id}/students/{student_id}', 'EventController@removeStudent')->middleware('org.user');
        Route::delete('{event_id}/speakers/{speaker_id}', 'EventController@removeSpeaker')->middleware('org.user');
        Route::delete('{id}', 'EventController@destroy')->middleware('osa.user');

        // Route::group(['middleware' => ['event.inspectors']], function() {
            Route::post('approve', 'EventController@approve');
            Route::post('reject', 'EventController@reject');
        // });
    });

    Route::group(['middleware' => 'auth', 'prefix' => 'auth'], function () {
        Route::post('/update-password', 'UserController@updatePassword');
        Route::post('/update-profile', 'Auth\UsersController@updateProfile');
    });

    Route::get('user', 'UserController@getAuthenticatedUser');
    Route::get('closed', 'DataController@closed');
    Route::get('test', 'DataController@test');
// });


/**
 * Test routes beyond here, please heed them no mind ^^
 */

Route::group(['middleware' => ['jwt.verify']], function () {

    Route::get('user', 'UserController@getAuthenticatedUser');
    Route::get('closed', 'DataController@closed');
    Route::get('test', 'DataController@test');
});

Route::prefix('test')->group(function() {
    Route::get('', 'TestController@index');
    Route::get('/{id}', 'TestController@show');
});
Route::get('open', 'DataController@open');