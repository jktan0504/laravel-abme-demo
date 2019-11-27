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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/send/email', 'API\Emails\FaultCallServiceReportController@sendReportMails');

/**
 *
 * FRS API - V1
 *
 **/
Route::group(['prefix' => 'v1'], function()
{
    /**
    *
    *  Roles @ Permission
    *
    */
    Route::group(['prefix' => 'roles', 'middleware' => 'auth:api'], function()
    {
        // UserGroup
        Route::apiResource('usergroup', 'API\Roles\UserGroupController', ['only'=>['index', 'store', 'show', 'destroy']]);

        // UserGroup Update
        Route::post('usergroup/update/{id}', 'API\Roles\UserGroupController@update');

        // User Access Right
        Route::apiResource('useraccessright', 'API\Roles\UserAccessRightController', ['only'=>['index', 'store', 'show', 'destroy']]);

        // User Access Right Update
        Route::post('useraccessright/update/{id}', 'API\Roles\UserAccessRightController@update');

        // User Access Right show all
        Route::get('useraccessrights', 'API\Roles\UserAccessRightController@showallpermissions');

        // User Has Access Right
        Route::apiResource('userhasaccessright', 'API\Roles\UserHasAccessRightController', ['only'=>['index', 'store', 'show', 'destroy']]);

        // TODO: using this now for get the whole user groups with access right
        // User Has Access Right
        Route::get('getalluserhasaccessrights', 'API\Roles\UserHasAccessRightController@getAllUserGroupsWithAccessRigths');


        // User Has Access Right Update
        Route::post('userhasaccessright/update/{id}', 'API\Roles\UserHasAccessRightController@update');

        // TODO: using this now for update the whole user groups with access right
        // User Has Access Right
        Route::post('updatealluserhasaccessrights', 'API\Roles\UserHasAccessRightController@updateAllUserGroupAccessRight');


    });

    /**
    *
    *  Station Main -- USING THIS FOR PRODUCTION
    *
    */
    Route::group(['prefix' => 'station-main', 'middleware' => 'auth:api'], function()
    {
        // ==============
        // Station
        Route::apiResource('station', 'API\Stations\Station\StationMainController', ['only'=>['index', 'store', 'show', 'destroy']]);

        // Station Type Update
        Route::post('station/update/{id}', 'API\Stations\Station\StationMainController@update');


    });

    /**
    *
    *  Stations -- DEPRECATED -- NOT USING FOR PRODUCTION
    *
    */
    Route::group(['prefix' => 'stations', 'middleware' => 'auth:api'], function()
    {
        // Brand
        Route::apiResource('brand', 'API\Stations\Brand\BrandController', ['only'=>['index', 'store', 'show', 'destroy']]);

        // Brand Update
        Route::post('brand/update/{id}', 'API\Stations\Brand\BrandController@update');

        // ==============
        // Equipment Type
        Route::apiResource('equipmenttype', 'API\Stations\EquipmentType\EquipmentTypeController', ['only'=>['index', 'store', 'show', 'destroy']]);

        // Equipment Type Update
        Route::post('equipmenttype/update/{id}', 'API\Stations\EquipmentType\EquipmentTypeController@update');

        // Equipment Sub Type
        Route::apiResource('equipmentsubtype', 'API\Stations\EquipmentType\EquipmentSubTypeController', ['only'=>['index', 'store', 'show', 'destroy']]);

        // Equipment Sub Type Update
        Route::post('equipmentsubtype/update/{id}', 'API\Stations\EquipmentType\EquipmentSubTypeController@update');

        // ==============
        // Floor
        Route::apiResource('floor', 'API\Stations\Floor\FloorController', ['only'=>['index', 'store', 'show', 'destroy']]);

        // Floor Update
        Route::post('floor/update/{id}', 'API\Stations\Floor\FloorController@update');

        // ==============
        // Grease Type
        Route::apiResource('greasetype', 'API\Stations\Grease\GreaseTypeController', ['only'=>['index', 'store', 'show', 'destroy']]);

        // Grease Type Update
        Route::post('greasetype/update/{id}', 'API\Stations\Grease\GreaseTypeController@update');

        // ==============
        // Location
        Route::apiResource('location', 'API\Stations\Locations\LocationController', ['only'=>['index', 'store', 'show', 'destroy']]);

        // Location Type Update
        Route::post('location/update/{id}', 'API\Stations\Locations\LocationController@update');

        // ==============
        // Motor Brand
        Route::apiResource('motorbrand', 'API\Stations\MotorBrand\MotorBrandController', ['only'=>['index', 'store', 'show', 'destroy']]);

        // Motor Brand Type Update
        Route::post('motorbrand/update/{id}', 'API\Stations\MotorBrand\MotorBrandController@update');

        // ==============
        // Panel Type
        Route::apiResource('paneltype', 'API\Stations\PanelType\PanelTypeController', ['only'=>['index', 'store', 'show', 'destroy']]);

        // Panel Type Update
        Route::post('paneltype/update/{id}', 'API\Stations\PanelType\PanelTypeController@update');

        // ==============
        // Station
        Route::apiResource('station', 'API\Stations\Station\StationController', ['only'=>['index', 'store', 'show', 'destroy']]);

        // Station Type Update
        Route::post('station/update/{id}', 'API\Stations\Station\StationController@update');


    });

    /**
    *
    *  MailBox
    *
    */
    Route::group(['prefix' => 'mailbox', 'middleware' => 'auth:api'], function()
    {
        // MailBox Group
        Route::apiResource('group', 'API\MailBox\MailBoxGroup\MailBoxGroupController', ['only'=>['index', 'store', 'show', 'destroy']]);

        // MailBox Group Update
        Route::post('group/update/{id}', 'API\MailBox\MailBoxGroup\MailBoxGroupController@update');

        // MailBox List
        Route::apiResource('list', 'API\MailBox\MailBoxList\MailBoxListController', ['only'=>['index', 'store', 'show', 'destroy']]);

        // MailBox List Update
        Route::post('list/update/{id}', 'API\MailBox\MailBoxList\MailBoxListController@update');

    });


    /**
    *
    *  User Team Groups
    *
    */
    Route::group(['prefix' => 'team-group', 'middleware' => 'auth:api'], function()
    {
        // TEAM
        Route::apiResource('team', 'API\UserGroups\Team\TeamController', ['only'=>['index', 'store', 'show', 'destroy']]);

        // TEAM Update
        Route::post('team/update/{id}', 'API\UserGroups\Team\TeamController@update');

        // USERGROUP
        Route::apiResource('group', 'API\UserGroups\UserGroup\UserGroupController', ['only'=>['index', 'store', 'show', 'destroy']]);

        // USERGROUP Update
        Route::post('group/update/{id}', 'API\UserGroups\UserGroup\UserGroupController@update');

    });

    /**
    *
    *  User Groups
    *
    */
    Route::group(['prefix' => 'usergroups', 'middleware' => 'auth:api'], function()
    {
        // USERS
        // USER API
        Route::apiResource('user', 'API\UserGroups\User\UserController', ['only'=>['index', 'store', 'show', 'destroy']]);

        // USER Update
        Route::post('user/update/{id}', 'API\UserGroups\User\UserController@update');

        // USER Check Username
        Route::get('users/checkusername', 'API\UserGroups\User\UserController@checkUsername');

        // GET ALL USERS
        Route::get('getallusers', 'API\UserGroups\User\UserController@getAllUsers');


    });

    /**
    *
    *  Auth User / Author Group
    *
    */
    Route::group(['prefix' => 'auth'], function()
    {
        Route::group(['prefix' => 'user', 'middleware' => 'auth:api'], function(){
            Route::get('getdetails', 'API\UserGroups\User\Auth\UserAuthenticateController@getUserDetails');

            Route::post('updatedetails', 'API\UserGroups\User\Auth\UserAuthenticateController@updateUserDetails');
        });
    });


    /**
    *
    *  Report Services
    *
    */
    Route::group(['prefix' => 'reportservices', 'middleware' => 'auth:api'], function()
    {
        // ====================
        // Field Visit
        // Field Visit Category
        Route::apiResource('fieldvisitcategory', 'API\ReportServices\FieldVisitService\Category\FieldVisitCategoryController', ['only'=>['index', 'store', 'show', 'destroy']]);

        // Field Visit Category Update
        Route::post('fieldvisitcategory/update/{id}', 'API\ReportServices\FieldVisitService\Category\FieldVisitCategoryController@update');


        // Field Visit
        Route::apiResource('fieldvisit', 'API\ReportServices\FieldVisitService\FieldVisitController', ['only'=>['index', 'store', 'show', 'destroy']]);

        // Field Visit Submit Real Form
        Route::post('fieldvisit/submit', 'API\ReportServices\FieldVisitService\FieldVisitController@submitRealForm');

        // Field Visit Update
        Route::post('fieldvisit/update/{id}', 'API\ReportServices\FieldVisitService\FieldVisitController@update');

        // Fault Call Month / Year Summary Report
       Route::get('fieldvisits/get-month-year-report', 'API\ReportServices\FieldVisitService\FieldVisitController@reportSummaryByMonthYear');

        // ====================
        // Fault Call
        // Fault Call
        Route::apiResource('faultcall', 'API\ReportServices\FaultCallService\FaultCallController', ['only'=>['index', 'store', 'show', 'destroy']]);

       
        // Fault Call  Update
        Route::post('faultcall/update/{id}', 'API\ReportServices\FaultCallService\FaultCallController@update');

        // Fault Call Bulk Update Sbst Sign
        Route::post('bulk-update-frs-sbst-sign', 'API\ReportServices\FaultCallService\FaultCallController@bulkUpdateFormSbstSign');

        // Fault Call Month / Year Summary Report
       Route::get('faultcalls/get-month-year-report', 'API\ReportServices\FaultCallService\FaultCallController@reportSummaryByMonthYear');

        // Report Format API
        Route::get('faultcall-reportformat', 'API\ReportServices\FaultCallService\FaultCallController@getReportFormat');


    });
    // No Middleware For FRS
    Route::group(['prefix' => 'app'], function()
    {
        // Fault Call Acknowledge Report
        Route::group(['prefix' => 'frs'], function(){
            Route::post('acknowledge', 'API\ReportServices\FaultCallService\FaultCallController@acknowledgeReport');
            Route::get('getreport', 'API\ReportServices\FaultCallService\FaultCallController@getReportByReportNoWithoutAuth');
        });
    });

    // Shorten Link
    Route::group(['prefix' => 'links'], function()
    {
        // Fault Call Acknowledge Report
        Route::apiResource('shortenlink', 'API\Links\ShortenLink\ShortenLinkController', ['only'=>['index', 'store', 'show', 'destroy']]);
    });

     
     

    /**
    *
    *  CommzGate / SMS
    *
    */
    Route::group(['prefix' => 'commzgate'], function()
    {
        Route::group(['prefix' => 'sms', 'middleware' => 'auth:api'], function(){

            // SMS Setting API SOURCE
            Route::apiResource('settings', 'API\SMS\SmsMainSettingController', ['only'=>['index', 'store', 'show', 'destroy']]);

            // SMS Setting Update
            Route::post('settings/update/{id}', 'API\SMS\SmsMainSettingController@update');

            // SMS Service API SOURCE
            Route::apiResource('service', 'API\SMS\MainSmsController', ['only'=>['index', 'store', 'show', 'destroy']]);

            // SMS Service Update
            Route::post('service/update/{id}', 'API\SMS\MainSmsController@update');

            // Receive All Messages From Mode
            Route::post('all-sms', 'API\SMS\MainSmsController@receiveAllMessagesFromMode');

            // Send One Message to One Receipt
            Route::post('single-receipient', 'API\SMS\MainSmsController@sendToSingleReceipientMsg');

            // Send One Message to User (Station Master)
            Route::post('single-station-master', 'API\SMS\MainSmsController@sendToStationMaster');
        });
    });

    /**
    *
    *  Notifications
    *
    */
    Route::group(['prefix' => 'notifications'], function()
    {
        Route::group(['prefix' => 'db', 'middleware' => 'auth:api'], function(){

            // NOTIFICATION API SOURCE
            Route::apiResource('service', 'API\Notifications\NotificationMainController', ['only'=>['index', 'store', 'show', 'destroy']]);

            // NOTIFICATION Update
            Route::post('service/update/{id}', 'API\Notifications\NotificationMainController@update');

            // READ NOTIFICATION AND GET REPORT
            Route::get('read-notification', 'API\Notifications\NotificationMainController@readNotificationAndFormDetails');

            // DELETE NOTIFICATION
            Route::post('delete-notification', 'API\Notifications\NotificationMainController@destroyByUUID');
        });
    });


});
