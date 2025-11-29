<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// =========================
// 🔐 AUTH ROUTES
// =========================
$routes->get('/', 'Auth::index');
$routes->post('register', 'Auth::register');
$routes->post('login', 'Auth::login');
$routes->get('logout', 'Auth::logout');

// =========================
// 🧭 DASHBOARD ROUTES
// =========================
$routes->get('dashboard', 'Dashboard::index', ['filter' => 'auth']);
$routes->get('dashboard/sk', 'Dashboard::sk', ['filter' => 'auth']);
$routes->get('dashboard/barangay', 'Dashboard::barangay', ['filter' => 'auth']);
$routes->get('dashboard/admin', 'Dashboard::admin', ['filter' => 'auth']);
$routes->get('dashboard/viewProposal/(:num)', 'Dashboard::viewProposal/$1');



// =========================
// 🧒 YOUTH / VOLUNTEER
// =========================
$routes->get('youth', 'Portal::youth');
$routes->post('volunteer', 'Portal::volunteer');

// =========================
// 📄 PROPOSAL ROUTES
// =========================
$routes->get('proposal/create', 'Proposal::create');
$routes->post('proposal/store', 'Proposal::store');
$routes->get('proposals/sk', 'Proposal::listSK');
$routes->get('proposals/barangay', 'Proposal::listBarangay');
$routes->get('proposal/approve/(:num)', 'Proposal::approve/$1');
$routes->get('proposal/reject/(:num)', 'Proposal::reject/$1');
$routes->get('proposals/view/(:num)', 'Proposal::view/$1');
$routes->get('proposals/load-ajax', 'Proposal::loadProposalsAjax');
$routes->get('proposals/barangay/view/(:num)', 'Proposal::barangayView/$1');

// =========================
// 🧾 RESOLUTIONS
// =========================
$routes->get('resolutions', 'Resolution::index');
$routes->post('resolutions/store', 'Resolution::store');
$routes->get('resolutions/approve/(:num)', 'Resolution::approve/$1');
$routes->get('resolutions/archive/(:num)', 'Resolution::archive/$1');
$routes->get('resolutions/print/(:num)', 'Resolution::printPDF/$1');
$routes->get('resolutions/download/(:num)', 'Resolution::downloadPDF/$1');
$routes->get('resolutions/view/(:num)', 'Resolution::view/$1');
$routes->get('resolutions/delete/(:num)', 'Resolution::delete/$1');

// =========================
// 🗓️ EVENT ROUTES
// =========================
$routes->post('event/store', 'Event::store');
$routes->get('event/approve/(:num)', 'Event::approve/$1');
$routes->get('event/register/(:num)', 'Event::register/$1');
$routes->post('event/submitRegistration', 'Event::submitRegistration');
$routes->get('event/portal', 'Event::portal');
$routes->get('event/history', 'Event::history');

// Youth event portal
$routes->get('youth', 'Youth::index');
$routes->get('event/youth', 'Event::showYouthEvents');

// =========================
// 🧑‍🤝‍🧑 SK MEMBERS
// =========================
$routes->get('sk/profile', 'SkProfileController::index');
$routes->post('skprofile/updateProfile', 'SkProfileController::updateProfile');
$routes->post('skprofile/changePassword', 'SkProfileController::changePassword');

$routes->get('skmembers', 'SKMembersController::index');
$routes->get('skmembers/create', 'SKMembersController::create');
$routes->post('skmembers/store', 'SKMembersController::store');
$routes->get('skmembers/edit/(:num)', 'SKMembersController::edit/$1');
$routes->post('skmembers/update/(:num)', 'SKMembersController::update/$1');
$routes->get('skmembers/delete/(:num)', 'SKMembersController::delete/$1');
$routes->get('skmembers/view', 'SKMembersController::view');
$routes->get('skmembers/view/(:num)', 'SKMembersController::viewProfile/$1');

$routes->get('network-logs', 'NetworkLogController::index');
$routes->post('network-logs/clear', 'NetworkLogController::clear');



// =========================
// 📊 ADMIN DASHBOARD API
// =========================
$routes->group('api', function ($routes) {
    $routes->get('users', 'AdminDashboardController::getUsers');
    $routes->get('total-users', 'AdminDashboardController::totalUsers');
    $routes->get('total-proposals', 'AdminDashboardController::totalProposals');
    $routes->get('pending-approvals', 'AdminDashboardController::pendingApprovals');
    $routes->get('approved-proposals', 'AdminDashboardController::approvedProposals');
    $routes->get('recent-activities', 'AdminDashboardController::recentActivities');
    $routes->get('latest-activities', 'AdminDashboardController::getLatestActivities');
    $routes->post('users/create', 'AdminDashboardController::createUser');
    $routes->delete('users/delete/(:num)', 'UserController::deleteUser/$1');
     // System mode
    $routes->get('system-mode', 'Api\SystemController::getMode');
    $routes->post('toggle-system-mode', 'Api\SystemController::toggleMode');
    $routes->post('api/toggle-system-mode', 'SystemController::toggleSystemMode');



});
$routes->post('network-log/record-mac', 'NetworkLogController::recordMac');

// =========================
// 🔔 NOTIFICATIONS
// =========================
$routes->get('api/notifications', 'Api::notifications');

// =========================
// 👥 USER MANAGEMENT (ADMIN)
// =========================
$routes->get('users', 'AdminDashboardController::index');
$routes->get('users/view/(:num)', 'AdminDashboardController::view/$1');
$routes->get('users/edit/(:num)', 'AdminDashboardController::edit/$1');
$routes->post('users/update/(:num)', 'AdminDashboardController::update/$1');
$routes->get('users/delete/(:num)', 'AdminDashboardController::delete/$1');

// =========================
// 💬 CHATBOT
// =========================
$routes->post('chatbot/respond', 'Chatbot::respond');
