<?php

// PLACE NON PROTECTED ROUTES HERE -- START
Route::get('/', 'HomeController@index');
// Route::get('/home', 'HomeController@home');
Route::get('/employer','HomeController@employer');
Route::get('/howitworks', 'HomeController@howitworks');
Route::get('/whychooseproveek', 'HomeController@whychooseproveek');
Route::get('/pricing', 'HomeController@pricing');
Route::get('/login', 'HomeController@login');

Route::post('/doLogin', 'HomeController@doLogin');
Route::get('/register', 'HomeController@register');
Route::post('/doRegisterIndi', 'HomeController@doRegisterIndi');
Route::post('/doRegisterComp', 'HomeController@doRegisterComp');
Route::post('/doRegisterTaskminator', 'HomeController@doRegisterTaskminator');
Route::get('/chainRegion', 'HomeController@chainRegion');
Route::get('/chainCity', 'HomeController@chainCity');
Route::get('/chainProvince', 'HomeController@chainProvince');
Route::get('/regTaskminator', 'HomeController@regTaskminator');
Route::post('/regTaskminator', 'HomeController@regTaskminator');
Route::get('/regClientIndi', 'HomeController@regClientIndi');
Route::get('/regClientComp', 'HomeController@regClientComp');
Route::post('/regClientComp', 'HomeController@regClientComp');
Route::get('/getProfilePercentage/{id}', 'HomeController@getProfilePercentage');
Route::get('/SLFACTVT={time}={userid}', 'HomeController@SLFACTVT');
Route::get('/ACTVTACCT={userid}', 'HomeController@ACTVTACCT');
Route::get('/VRFYACCT={code}', 'HomeController@VRFYACCT');
Route::get('/RESENDVALIDATION={userid}', 'HomeController@RESENDVALIDATION');
Route::post('/CHKRGWRKR', 'HomeController@CHKRGWRKR');
Route::get('/CHAINREG', 'HomeController@CHAINREG');
Route::post('/ContactUs', 'HomeController@ContactUs');

Route::get('/LOCCHAIN:{chainType}:{locationID}', 'HomeController@LOCCHAIN');
Route::get('/CHAINCATEGORYANDSKILL:{categoryID}', 'HomeController@CHAINCATEGORYANDSKILL');


Route::post('/regWorker', 'HomeController@regWorker');
Route::post('/regEmployer', 'HomeController@regEmployer');

Route::get('/regClient', function() {
    return View::make('reg-client');
});

// SEARCH ROUTE TEST
Route::get('/searchform', 'searchTestController@index');

Route::get('/logout', 'HomeController@logout');
Route::get('/changePassword', 'HomeController@changePassword');
Route::post('/forgotPassword', 'HomeController@changePassword');
Route::post('/changePassword', 'HomeController@changePassword');
Route::get('/activateChangePass/{confirmationCode}', 'HomeController@activateChangePass');
Route::get('/activateResetPass/{confirmationCode}', 'HomeController@activateResetPass');
Route::post('/confirmReset', 'HomeController@confirmReset');
Route::post('/confirmChange', 'HomeController@confirmChange');
Route::post('/chainCategoryItems', 'HomeController@chainCategoryItems');
// Route::get('/profile/{id}', 'HomeController@profile'); --- old profile page



// CHIKKA SMS ROUTES -- START
Route::post('/taskminator/receive', 'SMSAPIController@receive'); //register  http://yourserver.com/yourapp/receive  on the message receiver on API dashboard
Route::post('/taskminator/notify', 'SMSAPIController@notify'); //http://yourserver.com/yourapp/notify for the delivery notification
// CHIKKA SMS ROUTES -- END

// PLACE NON PROTECTED ROUTES HERE -- END

Route::group(array('before' => 'auth'), function(){
    Route::get('/editProfile', 'HomeController@editProfile');
    Route::post('/uploadProfilePic', 'HomeController@uploadProfilePic');
    Route::get('/getNotification', 'HomeController@getNotification');
    Route::get('/showAllNotif', 'HomeController@showAllNotif');
    Route::get('/messages', 'HomeController@messages');
    Route::get('/getMessages/{threadcode}', 'HomeController@getMessages');
    Route::post('/sendMsg', 'HomeController@sendMsg');
    Route::get('/checkMsgs={threadcode}', 'HomeController@checkMsgs');
    Route::get('/checkMsgThread={threadcode}', 'HomeController@checkMsgThread');
    Route::get('/checkMsgCount', 'HomeController@checkMsgCount');

    Route::post('/CHNGPSS', 'HomeController@CHNGPSS');

    Route::post('/DEACACCT', 'HomeController@DEACACCT');

    // ADMIN MESSAGING FUNCTION -- START
    Route::get('/admessages', 'HomeController@adminMessages');
    Route::post('/SENDMSGTOADMIN', 'HomeController@SENDMSGTOADMIN');
    Route::get('/WGTCHT={adminId}', 'HomeController@WGTCHT');
    Route::get('/WGTMSG={userid}', 'HomeController@WGTMSG');
    // ADMIN MESSAGING FUNCTION -- END
});

Route::group(array('before' => 'ADMIN-ONLY'), function(){
    // SYSTEM SETTINGS ROUTE
    Route::get('/SYSTEMSETTINGS', 'AdminController@SYSTEMSETTINGS');
    Route::post('/doSYSTEMSETTINGS','AdminController@doSYSTEMSETTINGS');
    Route::get('/DELETEDOC:{docID}', 'AdminController@DELETEDOC');
    Route::get('/DISABLEDOC:{doctypeID}', 'AdminController@DISABLEDOC');
    Route::get('/ENABLEDOC:{doctypeID}', 'AdminController@ENABLEDOC');
    Route::post('/SYS_ADD_DOC', 'AdminController@SYS_ADD_DOC');
    Route::get('/COMPANYDOCUMENTS', 'AdminController@COMPANYDOCUMENTS');
    Route::get('/WORKERDOCUMENTS', 'AdminController@WORKERDOCUMENTS');

    // SKILLS ROUTE
    Route::get('/customSkills', 'AdminController@customSkills');
    Route::get('/DELCSTSKLL={skillID}', 'AdminController@DELCSTSKLL');

    // JOB ADS ROUTES
    Route::get('/showJobAds', 'AdminController@showJobAds');
    Route::get('/ADMIN_jobDetails={job_id}', 'AdminController@ADMIN_jobDetails');
    Route::get('/ADMINJbSrch:{keyword}:{regcode}:{citycode}:{hiringType}:{orderBy}:{category}:{skill}:{customSkill}', 'AdminController@ADMINJbSrch');
    Route::get('/ADMIN_DELETEJOB={jobId}', 'AdminController@ADMINJbSrch');

    // SKILLS ROUTE
    Route::get('/skills', 'AdminController@skills');

    // CMS ROUTE
    Route::get('/cms', 'AdminController@cms');

    // THE ROLE BASED ROUTES FOR ADMINISTRATORS GOES HERE
    Route::get('/admin', 'AdminController@index');
    Route::get('/userList', 'AdminController@userList');
    Route::get('/userListTaskminators', 'AdminController@userListTaskminators');
    Route::get('/UsrAccntLstCMPNY', 'AdminController@UsrAccntLstCMPNY');
//    Route::get('/userListClientIndi', 'AdminController@userListClientIndi');
//    Route::get('/userListClientComp', 'AdminController@userListClientComp');
    Route::get('/adminActivate/{id}', 'AdminController@adminActivate');
    Route::get('/viewUserProfile/{id}', 'AdminController@viewUserProfile');

//    Route::get('/pendingTskmntr', 'AdminController@pendingTskmntr');
//    Route::get('/pendingClientIndi', 'AdminController@pendingClientIndi');
//    Route::get('/pendingClientComp', 'AdminController@pendingClientComp');
//    Route::get('/pendingTskmntr=search={searchBy}={searchWord}', 'AdminController@pendingTskmntrSearch');
//    Route::get('/pendingClientIndi=search={searchBy}={searchWord}', 'AdminController@pendingClientIndiSearch');
//    Route::get('/pendingClientComp=search={searchBy}={searchWord}', 'AdminController@pendingClientCompSearch');

//    Route::get('/categoryAndSkills', 'AdminController@categoryAndSkills');
    Route::get('/adminDeactivate/{id}', 'AdminController@adminDeactivate');
    Route::get('/AT_{role}', 'AdminController@auditTrail');
    Route::get('/userAuditTrail_{id}', 'AdminController@userAuditTrail');
    Route::get('/admin/taskDetails/{taskid}', 'AdminController@taskDetails');
    Route::get('/viewRatings={tskmntrId}', 'AdminController@viewRatings');
    Route::get('/taskListBidding', 'AdminController@taskListBidding');
    Route::get('/taskListBidding=search={searchBy}={searchWord}={workTimeValue}={status}', 'AdminController@taskListBiddingSearch');
    Route::get('/taskListAuto', 'AdminController@taskListAuto');
    Route::get('/taskListAuto=search={searchBy}={searchWord}={workTimeValue}={status}', 'AdminController@taskListAutoSearch');
    Route::get('/taskListDirect', 'AdminController@taskListDirect');
    Route::get('/taskListDirect=search={searchBy}={searchWord}={workTimeValue}={status}', 'AdminController@taskListDirectSearch');

//    Route::post('/userListTaskminators=search', 'AdminController@adminTskmntrSearch');
    Route::get('/searchWorker:{acctStatus}:{rating}:{hiring}:{orderBy}:{keyword}', 'AdminController@searchWorker');

    Route::post('/userListClientIndi=search', 'AdminController@adminClientIndiSearch');
    Route::post('/userListClientComp=search', 'AdminController@adminClientCompSearch');
    Route::post('/pendingTskmntr=search', 'AdminController@pendingTskmntrsSearch');
    Route::post('/pendingClientIndi=search', 'AdminController@pendingClientIndiSearch');
    Route::post('/pendingClientComp=search', 'AdminController@pendingClientCompSearch');
//    Route::post('/taskListBidding=search', 'AdminController@taskListBiddingSearch');
//    Route::post('/taskListAuto=search', 'AdminController@taskListAutoSearch');
    Route::post('/taskListDirect=search', 'AdminController@taskListDirectSearch');
    Route::get('/viewUsersTasks/{clientid}', 'AdminController@viewUsersTasks');
    Route::post('/viewUsersTasks=search', 'AdminController@viewUsersTasksSearch');
    Route::get('/userListTaskminators=search={searchBy}={searchWord}', 'AdminController@userListTaskminatorsSearch');
    Route::get('/userListClientIndi=search={searchBy}={searchWord}', 'AdminController@userListClientIndiSearch');
    Route::get('/userListClientComp=search={searchBy}={searchWord}', 'AdminController@userListClientCompSearch');
    Route::post('/newSkill', 'AdminController@newSkill');
    Route::post('/newCategory', 'AdminController@newCategory');
    Route::get('/deleteCategory={categorycode}', 'AdminController@deleteCategory');
    Route::get('/deleteSkill={skillcode}', 'AdminController@deleteSkill');
    Route::get('/adminDoSearch', 'searchTestController@doSearch');
//    Route::get('/jobAds={adType}', 'AdminController@jobAds');
    Route::get('/search_PUSR={keyword}={acctType}={orderBy}', 'AdminController@search_PUSR');
//    Route::get('/pendingUserSearch={searchBy}={searchUserType}={searchVal}', 'AdminController@pendingUserSearch');

    Route::post('/adminSearchChatUser', 'AdminController@adminSearchChatUser');
    Route::get('/getCHAT={with_userId}', 'AdminController@getCHAT');
    Route::post('/ADMINSENDMESSAGE', 'AdminController@ADMINSENDMESSAGE');

    Route::get('/ADMINGETNEWMSG={userid}={senderid}', 'AdminController@ADMINGETNEWMSG');
    Route::get('/adminMessages', 'TaskminatorController@adminMessages');
    Route::get('/ADMINNavSearch={keyword}', 'AdminController@ADMINNavSearch');
});

Route::group(array('before' => 'TASKMINATOR-ONLY'), function(){
    // DOCUMENTS MODULE
    Route::get('/editDocuments', 'TaskminatorController@editDocuments');
    Route::get('/DELETE_DOC_{docID}', 'TaskminatorController@DELETE_DOC');
    Route::post('/doUploadDocumentsWRKR', 'TaskminatorController@doUploadDocumentsWRKR');

    // JOBS MODULE ROUTES -- START by JAN SARMIENTO
    Route::get('/jbdtls={jobId}', 'TaskminatorController@jbdtls');
//    Route::get('/APPLYFRJB:{jobId}', 'TaskminatorController@APPLYFRJB');
    Route::post('/APPLYFRJB', 'TaskminatorController@APPLYFRJB');
    Route::get('/CNCLAPPLCTN:{jobId}', 'TaskminatorController@CNCLAPPLCTN');
    Route::get('/WRKR_APPLCTNS', 'TaskminatorController@WRKR_APPLCTNS');
    Route::get('/WRKR_INVTS', 'TaskminatorController@WRKR_INVTS');
    Route::post('/ADDOWNSKILL', 'TaskminatorController@ADDOWNSKILL');
    Route::get('/RMVCSTMSKLL={custom_skill_id}', 'TaskminatorController@RMVCSTMSKLL');
    // JOBS MODULE ROUTES -- END by JAN SARMIENTO

    // THE ROLE BASED ROUTES FOR TASKMINATORS GOES HERE
    Route::get('/tskmntr/taskSearch', 'TaskminatorController@taskSearch');

    // SEARCH ROUTES by Jan Sarmiento
    Route::get('/jobSearch:{keyword}:{workDuration}:{region}:{city}:{category}:{skill}:{orderBy}', 'TaskminatorController@jobSearch');
   // Route::post('/tskmntr/doTaskSearch', 'TaskminatorController@doTaskSearch');
   // Route::get('/tskmntr/doTaskSearch={workingTime}={searchField}={searchCity}={searchWord}={rateRange}={rangeValue}', 'TaskminatorController@doTaskSearch');

    Route::get('/tskmntr/currentTask', 'TaskminatorController@currentTask');
    Route::get('/bidPTIME/{id}', 'TaskminatorController@bidPtime');
    Route::get('/bidFTIME/{id}', 'TaskminatorController@bidFtime');
    Route::post('/initBid', 'TaskminatorController@initBid');
    Route::post('/doUploadDocuments', 'TaskminatorController@doUploadDocuments');
    Route::get('/taskDetails_{id}', 'TaskminatorController@taskDetails');
    Route::get('/tskmntr_taskOffers', 'TaskminatorController@tskmntr_taskOffers');
    Route::get('/tskmntr_taskBids', 'TaskminatorController@tskmntr_taskBids');
    Route::get('/tskmntr_onGoing', 'TaskminatorController@tskmntr_onGoing');
    Route::get('/tskmntr_completed', 'TaskminatorController@tskmntr_completed');
    Route::get('/cancelBid/{id}', 'TaskminatorController@cancelBid');
    Route::get('/viewClient_{id}', 'TaskminatorController@viewClient');
    Route::get('/confirmOffer/{taskid}', 'TaskminatorController@confirmOffer');
    Route::get('/denyOffer/{taskid}', 'TaskminatorController@denyOffer');
    Route::get('/editPersonalInfo', 'TaskminatorController@editPersonalInfo');
    Route::get('/editContactInfo', 'TaskminatorController@editContactInfo');
    Route::get('/editSkillInfo', 'TaskminatorController@editSkillInfo');
    Route::post('/doEditPersonalInfo', 'TaskminatorController@doEditPersonalInfo');
    Route::post('/doEditContactInfo', 'TaskminatorController@doEditContactInfo');
    Route::post('/doEditSkillInfo', 'TaskminatorController@doEditSkillInfo');
    Route::get('/removeSkill={taskitemId}', 'TaskminatorController@removeSkill');
    Route::get('/editPass', 'TaskminatorController@editPass');
    Route::post('/doEditPass', 'TaskminatorController@doEditPass');

    // sms verification
    Route::get('/doVerifyMobileNumber', 'TaskminatorController@doVerifyMobileNumber');
    Route::post('/verifyPin', 'TaskminatorController@verifyPin');
    Route::get('/sendVerificationCode', 'TaskminatorController@sendVerificationCode');
    Route::get('/workerDoSearch', 'searchTestController@workerDoSearch');
    Route::get('/WSRCH={keyword}', 'TaskminatorController@WSRCH');
});

Route::group(array('before' => 'CLIENT-ONLY'), function(){
    // DOCUMENTS
    Route::get('/editDocumentsCMP', 'ClientIndiController@editDocumentsCMP');
    Route::post('/doUploadDocumentsCMP', 'ClientIndiController@doUploadDocumentsCMP');

    // MULTIPLE INVITE ROUTES
    Route::post('/SENDMULTIPLEINVITE', 'ClientIndiController@SENDMULTIPLEINVITE');

    // BOOKMARK ROUTES
    Route::get('/ADD_BOOKMARK:{worker_id}', 'ClientIndiController@ADD_BOOKMARK');
    Route::get('/REMOVE_BOOKMARK:{book}', 'ClientIndiController@REMOVE_BOOKMARK');
    Route::get('/bookmarkedUsers', 'ClientIndiController@bookmarkedUsers');

    // NEW PROVEEK MODEL ROUTES FOR JOBS -- START
    Route::get('/createJob', 'ClientIndiController@createJob');
    Route::post('/doCreateJob', 'ClientIndiController@doCreateJob');
    Route::get('/jobDetails={jobId}', 'ClientIndiController@jobDetails');
    Route::get('/jobs', 'ClientIndiController@jobs');
    Route::get('/editJob={jobId}', 'ClientIndiController@editJob');
    Route::post('/doEditJob', 'ClientIndiController@doEditJob');
    Route::get('/WRKRSRCH:{jobId}:{categoryCode}:{skillCode}:{customSkill}', 'ClientIndiController@WRKRSRCH');
    Route::get('/SNDINVT:{invitedId}:{jobId}', 'ClientIndiController@SNDINVT');
    Route::post('/DOSNDINVT', 'ClientIndiController@DOSNDINVT');
    Route::get('/cancelInvite:{jobID}:{workerID}', 'ClientIndiController@cancelInvite');
    Route::get('/ShowInvited:{jobId}', 'ClientIndiController@ShowInvited');
    Route::get('/addToCart={worker_id}', 'ClientIndiController@addToCart');
    Route::get('/GET_CART_CONTENTS', 'ClientIndiController@GET_CART_CONTENTS');
    Route::post('/doCheckout', 'ClientIndiController@doCheckout');
    Route::get('/JOB_DELETECUSTSKILL={custom_skill_id}', 'ClientIndiController@JOB_DELETECUSTSKILL');
    Route::get('/checkouts', 'ClientIndiController@checkouts');
    Route::get('/removeCartItem:{cartID}', 'ClientIndiController@removeCartItem');
    Route::get('/deleteJob={cartID}', 'ClientIndiController@deleteJob');
    Route::post('/INVITEMULTIJOB', 'ClientIndiController@INVITEMULTIJOB');
    // NEW PROVEEK MODEL ROUTES FOR JOBS -- END

    // THE ROLE BASED ROUTES FOR CLIENT GOES HERE
    Route::get('/createTask', 'ClientIndiController@createTask');
    Route::post('/createTask', 'ClientIndiController@doCreateTask');
    Route::get('/editTask/{id}', 'ClientIndiController@editTask');
    Route::get('/deleteTask/{id}', 'ClientIndiController@deleteTask'); // this is actually "CANCEL" task
    Route::post('/doEditTask', 'ClientIndiController@doEditTask');
    Route::get('/tasks', 'ClientIndiController@tasks');
    Route::get('/taskDetails/{id}', 'ClientIndiController@taskDetails');
    Route::get('/hireTskmntr/{userid}/{taskid}', 'ClientIndiController@hireTskmntr');
    Route::get('/tskmntrSearch', 'ClientIndiController@tskmntrSearch');
    Route::get('/doTskmntrSearch={searchField}={searchKeyword}={city}', 'ClientIndiController@doTskmntrSearch');
    Route::get('/viewTaskminator_{id}', 'ClientIndiController@viewTaskminator');
    Route::get('/directHire_{id}', 'ClientIndiController@directHire');
    Route::get('/doDirectHire_{taskminatorid}.{taskid}', 'ClientIndiController@doDirectHire');
    Route::get('/retractOffer/{taskId}/{tskmntrId}', 'ClientIndiController@retractOffer');
    Route::get('/completeTask/taskid:{taskid}', 'ClientIndiController@completeTask');
    Route::post('/rateTaskminator', 'ClientIndiController@rateTaskminator');
    Route::get('/accomplishedTasks', 'ClientIndiController@accomplishedTasks');
    Route::get('/cancelledTasks', 'ClientIndiController@cancelledTasks');
    Route::get('/automaticSearch/{taskId}', 'ClientIndiController@automaticSearch');
    Route::get('/automaticOffer/{taskId}={userid}', 'ClientIndiController@automaticOffer');
    Route::get('/cltEditPersonalInfo', 'ClientIndiController@cltEditPersonalInfo');
    Route::get('/cltEditContactInfo', 'ClientIndiController@cltEditContactInfo');
    Route::get('/cltEditAcctInfo', 'ClientIndiController@cltEditAcctInfo');
    Route::post('/doCltEditPersonalInfo', 'ClientIndiController@doCltEditPersonalInfo');
    Route::post('/doCltEditContactInfo', 'ClientIndiController@doCltEditContactInfo');
    Route::post('/doCltEditIndiContactInfo', 'ClientIndiController@doCltEditIndiContactInfo');
    Route::post('/doCltEditPass', 'ClientIndiController@doCltEditPass');
    Route::post('/doCltIndiEditPersonalInfo', 'ClientIndiController@doCltIndiEditPersonalInfo');

    Route::get('/compDoSearch', 'searchTestController@compDoSearch');
    Route::get('/CISRCH/{prog}={keyword}', 'ClientIndiController@CISRCH');

    Route::get('/SRCHWRKRSKLL={categoryId}={skillId}', 'ClientIndiController@SRCHWRKRSKLL');
    Route::get('/SKILLCATCHAIN={categoryId}', 'ClientIndiController@SKILLCATCHAIN');
});

Route::get('/TESTINGROUTE', 'HomeController@TESTINGROUTE'); // TESTING

Route::get('/{username}', 'HomeController@toProfile'); // new profile page viewer

// THIS FUNCTION IS FOR ROUTE PROTECTION - IT REDIRECTS THE SYSTEM WHEN cTHE ROUTE/METHOD IS NOT FOUND AND/OR DOESN'T EXIST - Jan Sarmiento
//App::missing(function(){
//    return View::make('ERRORPAGE');
//});

// THIS FUNCTION REDIRECTS USER TO INDEX or '/' IF THE PAGE MAKES AN ERROR - Jan Sarmiento
//App::error(function(Exception $exception, $code){
//    return View::make('ERRORPAGE');
//});