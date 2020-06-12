<?php

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

Route::get('/', 'MainPageController@index');

#AUTHENTICATION ROUTE
Route::get('login', 'Auth\All_LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\All_LoginController@login')->name('auth.login');
Route::get('logout', 'Auth\LoginController@logout');
Route::post('logout', 'Auth\All_LoginController@logout')->name('logout');

#PASSWORD RESET ROUTE
	#STAFF
	Route::get('password_reset', 'ForgotPasswordController@showLinkRequestForm')->name('staff.password.request');
	Route::post('password_email', 'ForgotPasswordController@sendResetLinkEmail')->name('staff.password.email');
	Route::get('password_reset/token={token}', 'ResetPasswordController@showResetForm')->name('password.reset.token');
	Route::post('password_reset/{token}', 'ResetPasswordController@reset');

	#STUDENT
	Route::get('studentPassword_reset', 'SForgotPasswordController@showLinkRequestForm')->name('student.password.request');
	Route::post('studentPassword_reset_email', 'SForgotPasswordController@sendResetLinkEmail')->name('stud.password.email');
	Route::get('s-password/reset/{token}', 'SResetPasswordController@showResetForm')->name('stud.password.reset.token');
	Route::post('s-password/reset/{token}', 'SResetPasswordController@reset');

#ADMIN ROUTE
	#HOMEPAGE
	Route::get('admin_home', 'AdminController@index')->name('admin.dashboard');

	#PROFILE
	Route::get('admin_profile', 'AdminController@adminprofile')->name('ad.profile');
	Route::post('admin_profile', 'AdminController@adminUpdateInfo')->name('ad.updateInfo');

	#CHANGE PASSWORD
	Route::get('admin_change_password', 'AdminController@adpasswordchange')->name('ad.edit.pass');
	Route::post('admin_change_password','AdminController@adchangePassword')->name('ad.changePassword');
	
	#GALLERY
	Route::get('admin_gallery', 'AdminController@gallery')->name('ad.gallery');
	Route::get('admin_gallery_upload', 'AdminController@adshowupload')->name('ad.add.pict');
	Route::post('admin_gallery_upload', 'AdminController@aduploadPost')->name('upload.gambar');
	Route::get('admin_gallery_delete_id={id}', 'AdminController@addelImage');

	#ATTENDANCES
		#ATTENDANCE PAGE OPTION
		Route::get('admin_attendance', 'AdminController@adattendance')->name('ad.attendance');

		#SEARCH ATTENDANCE
		Route::get('admin_attendance_search','AdminAttSearchController@showAttendance')->name('ad.search.att');
		Route::get('admin_attendance_search_id={id}', 'AdminAttSearchController@show');
		//ada nak tambah

		#SCAN ATTENDANCE
		Route::get('admin_attendance_scanner','AdminScannerController@adScanner')->name('ad.scanner.att');
		Route::get('admin_scannedresult','AdminScannerController@adScanDetail');
		Route::get('admin_attendance_scanner_id={id}', 'AdminScannerController@adScanDetail');
		Route::get('admin_scannedresult_a', 'AdminScannerController@adScanAttend');


		#ASSIGN ATTENDANCE
		Route::get('admin_attendance_assign','AdminAssignerController@adAssign')->name('ad.assign.att');
		Route::post('admin_attendance_assign', 'AdminAssignerController@todo')->name('todoo');
		Route::post('admin_attendance_assign_saving', 'AdminAssignerController@saving')->name('saving');
		Route::get('admin_attendance_student_list', 'AdminAssignerController@view')->name('list.stud');
		Route::get('admin_attendance_student_list_mid={mid}', 'AdminAssignerController@show');
		Route::get('admin_attendance_student_list_id={sxmid}', 'AdminAssignerController@getdata');
		Route::post('admin_attendance_student_list', 'AdminAssignerController@store');
		Route::post('admin_attendance_student_list_update_id={sxmid}', 'AdminAssignerController@update');
		Route::post('admin_attendance_student_list_delete_id={sxmid}', 'AdminAssignerController@destroy');

		Route::get('admin_attendance_assign_faci','AdminAssignerController@assignFaci')->name('ad.assign.att.faci');
		Route::get('admin_attendance_assign_faci_id={mxsid}', 'AdminAssignerController@showData');
		Route::get('admin_attendance_assign_faci_tarikh={tarikh}', 'AdminAssignerController@getPlace');
		Route::get('admin_attendance_assign_faci_tarikh1={tarikh}', 'AdminAssignerController@getFaci');
		Route::post('admin_attendance_assign_faci_update_id={mxsid}', 'AdminAssignerController@storeFaci');
		Route::post('admin_attendance_assign_faci_delete_id={mxsid}', 'AdminAssignerController@destroyFaci');

		//Route::put('admin_attendance_assign_faci_id={mxsid}', 'AdminAssignerController@updateFaci');
		
		
		//Route::get('admin_attendance_assign_faci_place={id}','AdminAssignerController@getFaci');
		//Route::get('admin-attendance-assignfaci', 'AdminAssignerController@adAssignAtt')->name('ad.attAssign');
		//Route::get('admin-attendance-assignmodule', 'AdminAssignerController@adAssignAtt');

		Route::get('trial', 'AdminAssignerController@trial');
		Route::post('trial', 'AdminAssignerController@trial2')->name('try');
		Route::post('trial2', 'AdminAssignerController@trial3')->name('try2');
	

	Route::post('attendance', 'AdminController@attendancesearch')->name('ad.attendancesearch');


	#MODULE ROUTE
	Route::get('admin_module', 'AdminModuleController@adModule')->name('ad.module');
	Route::get('admin_module_id={module_id}', 'AdminModuleController@show');
	Route::post('admin_module', 'AdminModuleController@store');
	Route::post('admin_module_update_id={module_id}', 'AdminModuleController@update');
	Route::post('admin_module_delete_id={module_id}', 'AdminModuleController@destroy');

	#SURVEY MANAGER ROUTE
		#QUESTION ROUTE
		Route::get('admin_question', 'AdminSurveyController@question')->name('ad.questions');
		Route::get('admin_question_id={id}', 'AdminSurveyController@showQuest');
		Route::post('admin_question', 'AdminSurveyController@storeQuest');
		Route::post('admin_question_update_id={id}', 'AdminSurveyController@updateQuest');
		Route::post('admin_question_delete_id={id}', 'AdminSurveyController@destroyQuest');

		#SURVEY ROUTE
		Route::get('admin_survey', 'AdminSurveyController@survey')->name('ad.surveys');
		Route::get('admin_survey_id={id}', 'AdminSurveyController@showSurvey');
		Route::post('admin_survey', 'AdminSurveyController@storeSurvey');
		Route::put('admin_survey_id={id}', 'AdminSurveyController@updateSurvey');
		Route::delete('admin_survey_id={id}', 'AdminSurveyController@destroySurvey');
		Route::get('admin_surveyQ_id={id}','AdminSurveyController@surveyQuestion');
		Route::post('admin_surveyQ_id={id}', 'AdminSurveyController@surveyQuestionUpdate');

		#RESPONSE ROUTE
		Route::get('admin_responses', 'AdminSurveyController@response')->name('ad.responses');
		Route::get('admin_responses_moduleid={id}','AdminSurveyController@responsesView');

	#REPORT ROUTE
	Route::get('admin_report', 'AdminController@report')->name('ad.report');
#----------------------------------------------------------------------------------------------------#

#STAFF ROUTE
	#HOMEPAGE
	Route::get('staff_home', 'StaffController@index')->name('staff.dashboard');

	#PROFILE ROUTE
	Route::get('staff_profile', 'StaffController@staffprofile')->name('profile');
	Route::post('staff_profile', 'StaffController@stfUpdateInfo')->name('stf.updateInfo');
	
	#CHANGE PASSWORD rOUTE
	Route::get('staff_change-password', 'StaffController@passwordchange')->name('staff.edit.pass');
	Route::post('staff_change-password','StaffController@staffchangePassword')->name('staff.changePassword');
	
	#GALLERY ROUTE
	Route::get('staff_gallery', 'StaffController@gallery')->name('gallery');
	Route::get('staff_gallery_upload', 'StaffController@showupload')->name('staff.add.pict');
	Route::post('staff_gallery_upload','StaffController@uploadPost')->name('staff.upload.gambar');
	Route::get('staff_gallery_delete_id={id}', 'StaffController@delImage');

	#ATTENDANCE ROUTE (WITH SCANNER)
	Route::get('staff_attendance', 'StaffController@attendance')->name('staff.attendance');
	Route::get('staff_attendance_id={smid}', 'StaffController@show');
	Route::get('staff_scannedresult','StaffScannerController@ScanDetail');
	Route::get('staff_attendance_scanner_id={id}', 'StaffScannerController@ScanDetail');
	Route::get('staff_scannedresult_a', 'StaffScannerController@ScanAttend');
	Route::post('staff_end_ki', 'StaffController@endki')->name('end.ki');

	#MODULE ROUTE
	Route::get('staff_module', 'StaffController@module')->name('staff.module');
	Route::get('staff_module_group={module_id}', 'StaffController@showModule');
#----------------------------------------------------------------------------------------------------#

#STUDENT ROUTE
	#HOME ROUTE
	Route::get('student_home', 'StudentController@index')->name('student.dashboard');

	#PROFILE ROUTE
	Route::get('student_profile', 'StudentController@profile')->name('stprofile');
	Route::post('student_profile', 'StudentController@profileUpdate')->name('stud.updateInfo');

	#PASSWOR-CHANGER ROUTE
	Route::get('student-password-change', 'StudentController@passwordchange')->name('passchange');
	Route::post('student-changePassword','StudentController@changePassword')->name('changePassword');

	#ATTENDANCE SECTION ROUTE
		#QR ROUTE
		Route::get('student-qr', 'StudentController@qrshow')->name('qrcode');

		#ATTENDANCES ROUTE
		Route::get('student-view-attendance', 'StudentController@showattendance')->name('view.attendance');
		Route::get('student-print-attendance', 'StudentController@printRules')->name('print.att');
		Route::get('student-print-attendance/id={id}','StudentController@downloadPDF');

	#MODULE ROUTE
	Route::get('student-view-module', 'StudentController@showmodule')->name('module');

	Route::get('student-surveys', 'StudentController@showsurveys')->name('surveys');
	Route::get('student-surveys-svid={id}','StudentController@survey');
	Route::post('student-survey-soalan', 'StudentController@soalan')->name('soalan');
