<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\homeController;

// APPLICANT USE
    use App\Http\Controllers\ApplicantsController;
// APPLICANT USE

// EMPLOYEES USE
    use App\Http\Controllers\EmployeesController;
// EMPLOYEES USE

// ADMINISTRATOR USE
    use App\Http\Controllers\AdminController;
// ADMINISTRATOR USE

// RECRUITER USE
    use App\Http\Controllers\RecruiterController;
// RECRUITER USE


// Route::domain('tarana.mleystock-pile.com')->group(function()
// APPLICANT ROUTES
    // APPLICANT CREDENTIALS
        Route::get('applicantLoginFunction', [ApplicantsController::class,'applicantLoginFunction'])->name('login');
    // APPLICANT CREDENTIALS

    // APPLICANT DASHBOARD ROUTES
        // ROUTES
            Route::get('applicantsAuthentication', [ApplicantsController::class,'applicantsAuthentication'])->name('applicantsAuthentication');
            Route::get('applicantSignUp', [ApplicantsController::class,'applicantSignUp'])->name('applicantSignUp');
            Route::get('applicantLogout', [ApplicantsController::class,'applicantLogout'])->name('applicantLogout');
            Route::middleware(['auth:applicantsModel', 'single.user'])->group(function () {
                Route::get('applicantDashboardRoutes', [ApplicantsController::class,'applicantDashboardRoutes'])->name('applicantDashboardRoutes');
                Route::get('upcomingOperationRoutes', [ApplicantsController::class,'upcomingOperationRoutes'])->name('upcomingOperationRoutes');
                Route::get('applicantAccountRoutes', [ApplicantsController::class,'applicantAccountRoutes'])->name('applicantAccountRoutes');
                Route::get('applicationScheduleRoutes', [ApplicantsController::class,'applicationScheduleRoutes'])->name('applicationScheduleRoutes');
                Route::get('applicantCompletedRoutes', [ApplicantsController::class,'applicantCompletedRoutes'])->name('applicantCompletedRoutes');
                Route::get('applicantCredentialsRoutes', [ApplicantsController::class,'applicantCredentialsRoutes'])->name('applicantCredentialsRoutes');
            });
        // ROUTES

        // FETCH
            // GET
                Route::get('applicantOperation', [ApplicantsController::class,'applicantOperation']);
                Route::get('totalUpcomingOperationForApp', [ApplicantsController::class,'totalUpcomingOperationForApp']);
                Route::get('totalInvitationOperationForApp', [ApplicantsController::class,'totalInvitationOperationForApp']);
                Route::get('totalScheduledOperationForApp', [ApplicantsController::class,'totalScheduledOperationForApp']);
                Route::get('applicantInvitationForApp', [ApplicantsController::class,'applicantInvitationForApp']);
                Route::get('applicantApply', [ApplicantsController::class,'applicantApply']);
                Route::get('cancelApply', [ApplicantsController::class,'cancelApply']);
                Route::get('applicantScheduled', [ApplicantsController::class,'applicantScheduled']);
                Route::get('getApplicantData', [ApplicantsController::class,'getApplicantData']);
                Route::get('declinedInvitation', [ApplicantsController::class,'declinedInvitation']);
                Route::get('backOutOperation', [ApplicantsController::class,'backOutOperation']);
                Route::get('acceptInvitation', [ApplicantsController::class,'acceptInvitation']);
                Route::get('coWorkers', [ApplicantsController::class,'coWorkers']);
                Route::get('applicantCompletedOperation', [ApplicantsController::class,'applicantCompletedOperation']);
            // GET

            // POST
                Route::post('editApplicantInfo', [ApplicantsController::class,'editApplicantInfo']);
                Route::post('submitApplicantId', [ApplicantsController::class,'submitApplicantId']);
                Route::post('applicantSignUpFunction', [ApplicantsController::class,'applicantSignUpFunction']);
                Route::post('updateUsersPassword', [ApplicantsController::class,'updateUsersPassword']);
            // POST
        // FETCH
    // APPLICANT DASHBOARD ROUTES
// APPLICANT ROUTES

// EMPLOYEES ROUTES
    Route::get('employeesLoginRoutes', [EmployeesController::class,'employeesLoginRoutes'])->name('login');
    Route::get('/', [homeController::class,'tarana'])->name('tarana');
    Route::get('termsandcondition', [homeController::class,'termsandcondition'])->name('termsandcondition');
    Route::get('privacypolicy', [homeController::class,'privacypolicy'])->name('privacypolicy');
    Route::get('forgotPassword', [homeController::class,'forgotPassword'])->name('forgotPassword');
    Route::get('employeesLogoutFunction', [EmployeesController::class,'employeesLogoutFunction'])->name('employeesLogoutFunction');
    Route::get('resetPassword', [homeController::class,'resetPassword'])->name('resetPassword');
    Route::post('resetPasswordFunction', [homeController::class,'resetPasswordFunction'])->name('resetPasswordFunction');
    Route::post('newPasswordFunction', [homeController::class,'newPasswordFunction'])->name('newPasswordFunction');
    Route::post('employeesLoginFunction', [EmployeesController::class,'employeesLoginFunction']);
// EMPLOYEES ROUTES

// ADMINISTRATOR ROUTES
    // ROUTES
        Route::middleware(['auth:employeesModel'])->group(function () {
            Route::get('adminDashboardRoutes', [AdminController::class,'adminDashboardRoutes'])->name('adminDashboardRoutes');
            Route::get('adminOperationRoutes', [AdminController::class,'adminOperationRoutes'])->name('adminOperationRoutes');
            Route::get('adminEmployeesRoutes', [AdminController::class,'adminEmployeesRoutes'])->name('adminEmployeesRoutes');
            Route::get('adminScheduleRoutes', [AdminController::class,'adminScheduleRoutes'])->name('adminScheduleRoutes');
            Route::get('inactiveEmployees', [AdminController::class,'inactiveEmployees'])->name('inactiveEmployees');
            Route::get('adminApplicantsRoutes', [AdminController::class,'adminApplicantsRoutes'])->name('adminApplicantsRoutes');
            Route::get('inactiveApplicants', [AdminController::class,'inactiveApplicants'])->name('inactiveApplicants');
            Route::get('blockedApplicants', [AdminController::class,'blockedApplicants'])->name('blockedApplicants');
            Route::get('utilizedApplication', [AdminController::class,'utilizedApplication'])->name('utilizedApplication');
            Route::get('adminManageAccount', [AdminController::class,'adminManageAccount'])->name('adminManageAccount');
            Route::get('adminCompletedOperation', [AdminController::class,'adminCompletedOperation'])->name('adminCompletedOperation');
            Route::get('adminCredentials', [AdminController::class,'adminCredentials'])->name('adminCredentials');
            Route::get('utilizedAppRecruiter', [AdminController::class,'utilizedAppRecruiter'])->name('utilizedAppRecruiter');
            Route::get('adminOldApplicantsRoutes', [AdminController::class,'adminOldApplicantsRoutes']);
            Route::get('inactiveOldApplicantsRoutes', [AdminController::class,'inactiveOldApplicantsRoutes']);
            Route::get('blockedOldApplicantsRoutes', [AdminController::class,'blockedOldApplicantsRoutes']);
            Route::get('adminBackOutArchiveRoutes', [AdminController::class,'adminBackOutArchiveRoutes']);
            Route::get('adminDeclinedArchiveRoutes', [AdminController::class,'adminDeclinedArchiveRoutes']);
            Route::get('adminBlockedArchiveRoutes', [AdminController::class,'adminBlockedArchiveRoutes']);
            Route::get('adminCancelOperationArchiveRoutes', [AdminController::class,'adminCancelOperationArchiveRoutes']);
        });
    // ROUTES

    // FETCH DATA
        // GET
                Route::get('getOperationData', [AdminController::class,'getOperationData']);
                Route::get('getCompletedOperationData', [AdminController::class,'getCompletedOperationData']);
                Route::get('showCertainOperation', [AdminController::class,'showCertainOperation']);
                Route::get('getAllEmployeesData', [AdminController::class,'getAllEmployeesData']);
                Route::get('getInactiveEmployees', [AdminController::class,'getInactiveEmployees']);
                Route::get('getCertainEmployee', [AdminController::class,'getCertainEmployee']);
                Route::get('deactivateEmployee', [AdminController::class,'deactivateEmployee']);
                Route::get('activateEmployee', [AdminController::class,'activateEmployee']);
                Route::get('getAdminAllApplicantsData', [AdminController::class,'getAdminAllApplicantsData']);
                Route::get('viewApplicants', [AdminController::class,'viewApplicants']);
                Route::get('deactivateApplicants', [AdminController::class,'deactivateApplicants']);
                Route::get('activateApplicant', [AdminController::class,'activateApplicant']);
                Route::get('blockedApplicant', [AdminController::class,'blockedApplicant']);
                Route::get('getInactiveApplicantsData', [AdminController::class,'getInactiveApplicantsData']);
                Route::get('getBlockedApplicants', [AdminController::class,'getBlockedApplicants']);
                Route::get('getCurrentlyUtilizing', [AdminController::class,'getCurrentlyUtilizing']);
                Route::get('getPersonalInfo', [AdminController::class,'getPersonalInfo']);
                Route::get('totalUpcomingOperation', [AdminController::class,'totalUpcomingOperation']);
                Route::get('totalCompletedOperation', [AdminController::class,'totalCompletedOperation']);
                Route::get('totalForeman', [AdminController::class,'totalForeman']);
                Route::get('totalApplicants', [AdminController::class,'totalApplicants']);
                Route::get('visualization', [AdminController::class,'visualization']);
                Route::get('cancelOperation', [AdminController::class,'cancelOperation']);
                Route::get('doneOperation', [AdminController::class,'doneOperation']);
                Route::get('showApplicantOnCertainOperation', [AdminController::class,'showApplicantOnCertainOperation']);
                Route::get('unblockApplicant', [AdminController::class,'unblockApplicant']);
                Route::get('unutilizedApplicant', [AdminController::class,'unutilizedApplicant']);
                Route::get('getEmpCurrentlyUtilizing', [AdminController::class,'getEmpCurrentlyUtilizing']);
                Route::get('unutilizedEmployee', [AdminController::class,'unutilizedEmployee']);
                Route::get('getAdminAllOldApplicantsData', [AdminController::class,'getAdminAllOldApplicantsData']);
                Route::get('getInactiveOldApplicantsData', [AdminController::class,'getInactiveOldApplicantsData']);
                Route::get('getBlockedOldApplicantsData', [AdminController::class,'getBlockedOldApplicantsData']);
                Route::get('downloadExcel', [AdminController::class,'downloadExcel']);
                Route::get('getBackOutArchivedForAdmin', [AdminController::class,'getBackOutArchivedForAdmin']);
                Route::get('getDeclinedArchivedForAdmin', [AdminController::class,'getDeclinedArchivedForAdmin']);
                Route::get('getArchivedBlockedApplicantsForAdmin', [AdminController::class,'getArchivedBlockedApplicantsForAdmin']);
                Route::get('getCancelOperationData', [AdminController::class,'getCancelOperationData']);
                Route::get('printProjectWorker/{id}', [AdminController::class,'printProjectWorker']);
                Route::get('printCompanyEmployee/{id}', [AdminController::class,'printCompanyEmployee']);
                Route::get('printCompletedOperation/{id}', [AdminController::class,'printCompletedOperation']);
                Route::get('cancelOperationReason', [AdminController::class,'cancelOperationReason']);
                Route::get('blockedReason', [AdminController::class,'blockedReason']);
                Route::get('printOperation/{id}', [AdminController::class,'printOperation']);
                Route::get('adminFormedGroup/', [AdminController::class,'adminFormedGroup']);
                Route::get('getHighestRating/', [AdminController::class,'getHighestRating']);
                Route::get('mostCommonCargo/', [AdminController::class,'mostCommonCargo']);
        // GET

        // POST
            Route::post('addOperation', [AdminController::class,'addOperation']);
            Route::post('updateOperation', [AdminController::class,'updateOperation']);
            Route::post('addEmployee', [AdminController::class,'addEmployee']);
            Route::post('generateOperationId', [AdminController::class,'generateOperationId']);
            Route::post('employeesImport', [AdminController::class,'employeesImport']);
            Route::post('operationImport', [AdminController::class,'operationImport']);
            Route::post('updateEmployees', [AdminController::class,'updateEmployees']);
            Route::post('updateAdminAccount', [AdminController::class,'updateAdminAccount']);
            Route::post('updateUsersPassword', [AdminController::class,'updateUsersPassword']);
        // POST
    // FETCH DATA
// ADMINISTRATOR ROUTES

// RECRUITER ROUTES
    // ROUTES
        Route::middleware(['auth:employeesModel'])->group(function () {
            Route::get('recruiterDashboardRoutes', [RecruiterController::class,'recruiterDashboardRoutes'])->name('recruiterDashboardRoutes');
            Route::get('recruiterOperationRoutes', [RecruiterController::class,'recruiterOperationRoutes'])->name('recruiterOperationRoutes');
            Route::get('recruitApplicantsRoutes', [RecruiterController::class,'recruitApplicantsRoutes'])->name('recruitApplicantsRoutes');
            Route::get('recruitRecommendedRoutes', [RecruiterController::class,'recruitRecommendedRoutes'])->name('recruitRecommendedRoutes');
            Route::get('recruiterApplicantRoutes', [RecruiterController::class,'recruiterApplicantRoutes'])->name('recruiterApplicantRoutes');
            Route::get('recruiterOnCallWorkerRoutes', [RecruiterController::class,'recruiterOnCallWorkerRoutes'])->name('recruiterOnCallWorkerRoutes');
            Route::get('recruitedApplicants', [RecruiterController::class,'recruitedApplicants'])->name('recruitedApplicants');
            Route::get('recruiterAcceptInvitationRoutes', [RecruiterController::class,'recruiterAcceptInvitationRoutes'])->name('recruiterAcceptInvitationRoutes');
            Route::get('recruiterDetailsRoutes', [RecruiterController::class,'recruiterDetailsRoutes'])->name('recruiterDetailsRoutes');
            Route::get('recruiterCompletedRoutes', [RecruiterController::class,'recruiterCompletedRoutes'])->name('recruiterCompletedRoutes');
            Route::get('recruiterFormedGroupRoutes', [RecruiterController::class,'recruiterFormedGroupRoutes'])->name('recruiterFormedGroupRoutes');
            Route::get('recruiterApplicantsBackoutRoutes', [RecruiterController::class,'recruiterApplicantsBackoutRoutes'])->name('recruiterApplicantsBackoutRoutes');
            Route::get('recruiterApplicantDeclinedRoutes', [RecruiterController::class,'recruiterApplicantDeclinedRoutes'])->name('recruiterApplicantDeclinedRoutes');
            Route::get('recruiterCredentials', [RecruiterController::class,'recruiterCredentials'])->name('recruiterCredentials');
            Route::get('recruiterBackOutArchiveRoutes', [RecruiterController::class,'recruiterBackOutArchiveRoutes'])->name('recruiterBackOutArchiveRoutes');
            Route::get('recruiterDeclinedArchiveRoutes', [RecruiterController::class,'recruiterDeclinedArchiveRoutes'])->name('recruiterDeclinedArchiveRoutes');
            Route::get('submitAttendance/{id}', [RecruiterController::class,'submitAttendance'])->name('submitAttendance');
        });
    // ROUTES

    // FETCH DATA
        // GET
            Route::get('recruiterScheduleOperation', [RecruiterController::class,'recruiterScheduleOperation']);
            Route::get('recruiterPendingOperation', [RecruiterController::class,'recruiterPendingOperation']);
            Route::get('recruiterBackOutInvitation', [RecruiterController::class,'recruiterBackOutInvitation']);
            Route::get('recruiterDeclinedInvitaion', [RecruiterController::class,'recruiterDeclinedInvitaion']);
            Route::get('recruiterOperation', [RecruiterController::class,'recruiterOperation']);
            Route::get('recruiterCompleted', [RecruiterController::class,'recruiterCompleted']);
            Route::get('getApplicants', [RecruiterController::class,'getApplicants']);
            Route::get('getAllApplicantsData', [RecruiterController::class,'getAllApplicantsData']);
            Route::get('getAllOnCallWorkers', [RecruiterController::class,'getAllOnCallWorkers']);
            Route::get('getEmployeesData', [RecruiterController::class,'getEmployeesData']);
            Route::get('getCertainApplicants', [RecruiterController::class,'getCertainApplicants']);
            Route::get('applicantsOnOperation', [RecruiterController::class,'applicantsOnOperation']);
            Route::get('fetchApplicantLastname', [RecruiterController::class,'fetchApplicantLastname']);
            Route::get('applicantOnCertainOperation', [RecruiterController::class,'applicantOnCertainOperation']);
            Route::get('cancelRecommendation', [RecruiterController::class,'cancelRecommendation']);
            Route::get('showOperationDetails', [RecruiterController::class,'showOperationDetails']);
            Route::get('showOperationDetails2', [RecruiterController::class,'showOperationDetails2']);
            Route::get('recruitRecommendedApplicant', [RecruiterController::class,'recruitRecommendedApplicant']);
            Route::get('recruitApplicants', [RecruiterController::class,'recruitApplicants']);
            Route::get('cancelRecruitment', [RecruiterController::class,'cancelRecruitment']);
            Route::get('applicantExperience', [RecruiterController::class,'applicantExperience']);
            Route::get('overallRatingPerWorker', [RecruiterController::class,'overallRatingPerWorker']);
            Route::get('totalBackOutPerWorker', [RecruiterController::class,'totalBackOutPerWorker']);
            Route::get('totalDeclinedPerWorker', [RecruiterController::class,'totalDeclinedPerWorker']);
            Route::get('totalNotAttend', [RecruiterController::class,'totalNotAttend']);
            Route::get('recruiterFormedGroup', [RecruiterController::class,'recruiterFormedGroup']);
            Route::get('pendingInvitationContent', [RecruiterController::class,'pendingInvitationContent']);
            Route::get('applicantBackoutContent', [RecruiterController::class,'applicantBackoutContent']);
            Route::get('applicantDeclinedContent', [RecruiterController::class,'applicantDeclinedContent']);
            Route::get('deleteBackOut', [RecruiterController::class,'deleteBackOut']);
            Route::get('archiveBackOut', [RecruiterController::class,'archiveBackOut']);
            Route::get('deleteDeclined', [RecruiterController::class,'deleteDeclined']);
            Route::get('archiveDeclined', [RecruiterController::class,'archiveDeclined']);
            Route::get('deleteInvitation', [RecruiterController::class,'deleteInvitation']);
            Route::get('printAttendance/{id}', [RecruiterController::class,'printAttendance']);
            Route::get('totalApplicantOfCertainOperation', [RecruiterController::class,'totalApplicantOfCertainOperation']);
            Route::get('totalRecommendedApplicantsOfCertainOperation', [RecruiterController::class,'totalRecommendedApplicantsOfCertainOperation']);
            Route::get('totalApplicantsWhoAcceptInvitation', [RecruiterController::class,'totalApplicantsWhoAcceptInvitation']);
            Route::get('badgeForTotalApplicants', [RecruiterController::class,'badgeForTotalApplicants']);
            Route::get('badgeForRecommendApplicants', [RecruiterController::class,'badgeForRecommendApplicants']);
            Route::get('badgeAcceptInvitation', [RecruiterController::class,'badgeAcceptInvitation']);
            Route::get('badgeForAll', [RecruiterController::class,'badgeForAll']);
            Route::get('confirmationPassword', [RecruiterController::class,'confirmationPassword']);
            Route::get('cancelRecruitmentAndRecommendation', [RecruiterController::class,'cancelRecruitmentAndRecommendation']);
            Route::get('totalRecruitedApplicants', [RecruiterController::class,'totalRecruitedApplicants']);
            Route::get('badgeForRecruitedApplicants', [RecruiterController::class,'badgeForRecruitedApplicants']);
            Route::get('searchCompleted', [RecruiterController::class,'searchCompleted']);
            Route::get('backOutReason', [RecruiterController::class,'backOutReason']);
            Route::get('declinedReason', [RecruiterController::class,'declinedReason']);
            Route::get('getBackOutArchivedForRecruiter', [RecruiterController::class,'getBackOutArchivedForRecruiter']);
            Route::get('getDeclinedArchivedForRecruiter', [RecruiterController::class,'getDeclinedArchivedForRecruiter']);
            Route::get('getSchedPerApplicant', [RecruiterController::class,'getSchedPerApplicant']);
            Route::get('inviteProjectWorker', [RecruiterController::class,'inviteProjectWorker']);
            Route::get('fetchOperation', [RecruiterController::class,'fetchOperation']);
        // GET

        // POST
            Route::post('submitApplicantAttendance',[RecruiterController::class,'submitApplicantAttendance']);
            Route::post('editRecruiterInfo', [RecruiterController::class,'editRecruiterInfo']);
            Route::post('updateUsersPassword', [RecruiterController::class,'updateUsersPassword']);
        // POST
    // FETCH DATA
// RECRUITER ROUTES
// });
