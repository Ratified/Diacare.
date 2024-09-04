<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\HealthGoalsController;
use App\Http\Controllers\HealthRecordsController;
use App\Http\Controllers\MedicationReminderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\DoctorDashboardController;
use App\Http\Controllers\PatientDashboardController;
use App\Http\Controllers\Products\ProductController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Consultation\ConsultationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HealthTracker\HealthTrackerController;
use App\Http\Controllers\PaypalController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Route::get('/', [WelcomeController::class, 'index'])->name('welcome');


// Route::get('patient/dashboard', [PatientDashboardController::class, 'index'])
//     ->middleware(['auth', 'verified', 'role:patient'])
//     ->name('patient.dashboard');

// Route::get('/doctor/dashboard', [DoctorDashboardController::class, 'index'])
//     ->middleware(['auth', 'verified', 'role:doctor'])
//     ->name('doctor.dashboard');
    
// Route::get('/dashboard', function () {
//     $user = auth()->user();
//     if ($user->role === 'patient') {
//         return redirect()->route('patient.dashboard');
//     } elseif ($user->role === 'doctor') {
//         return redirect()->route('doctor.dashboard');
//     } else {
//         abort(403, 'Unauthorized action.');
//     }
// })->middleware(['auth', 'verified'])->name('dashboard');
// Route::get('/dashboard', [PatientDashboardController::class, 'index'])
//     ->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/dashboard', [PatientDashboardController::class, 'index'])
//     ->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/products', [ProductController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('products.show');

// Cart routes
Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

//Admin routes
// Admin Login Routes
// Route::get('/admin/login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
// Route::post('/admin/login', 'Admin\Auth\LoginController@login')->name('admin.login.submit');
// Route::post('/admin/logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

// Admin Product Routes
Route::get('/admin/products/add', [AdminController::class, 'showAddProductForm'])->name('admin.products.add');
Route::post('/admin/products', [AdminController::class, 'storeProduct'])->name('admin.products.store');
Route::get('/admin/products', [AdminController::class, 'showAllProducts'])->name('admin.products.index');
Route::get('/admin/products/{product}/edit', [AdminController::class, 'editProductPage'])->name('admin.products.editPage');  
Route::patch('/admin/products/{product}', [AdminController::class, 'updateProduct'])->name('admin.products.update');
Route::delete('/admin/products/{product}', [AdminController::class, 'deleteProduct'])->name('admin.products.delete');

//Consultation routes
Route::get('/consultation', [ConsultationController::class, 'index'])->name('consultation.index');

//Health Traker Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/health-tracker', function () {
        return view('health-tracker.index');
    })->name('health-tracker.index');

    Route::post('/health-tracker', [HealthTrackerController::class, 'store'])->name('health-tracker.store');
    Route::get('/health-records', [HealthTrackerController::class, 'getHealthRecords'])->name('health-records');
});

Route::get('/setup-profile', [DoctorController::class, 'setupProfile'])->name('setup-profile');
Route::post('/doctor/storeProfile', [DoctorController::class, 'storeProfile'])->name('doctor.storeProfile');
Route::get('/doctor/{id}/edit', [DoctorController::class, 'editProfile'])->name('doctor.editProfile');
Route::post('/doctor/{id}/update', [DoctorController::class, 'updateProfile'])->name('doctor.updateProfile');
Route::post('/doctor/{id}/delete', [DoctorController::class, 'deleteProfile'])->name('doctor.deleteProfile');
Route::get('/manage-profile', [DoctorController::class, 'manageProfile'])->name('manage-profile');
Route::get('/doctor/{id}', [DoctorController::class, 'showProfile'])->name('doctor.profile');

Route::post('/contact', [ContactController::class, 'submitForm'])->name('contact.submit');

Route::get('/all-health-records', [HealthRecordsController::class, 'index'])->name('all-health.records');

// Health Goals Routes
Route::get('/health-goals', [HealthGoalsController::class, 'index'])->middleware(['auth', 'verified'])->name('health-goals.index');
Route::get('/health-goals-create', [HealthGoalsController::class, 'showCreate'])->name('health-goals.showCreate');
Route::post('/health-goals-create', [HealthGoalsController::class, 'store'])->name('health-goals.store');
Route::get('/health-goals/{id}/edit', [HealthGoalsController::class, 'edit'])->name('health-goals.edit');
Route::put('/health-goals/{id}', [HealthGoalsController::class, 'update'])->name('health-goals.update');
Route::delete('/health-goals/{id}', [HealthGoalsController::class, 'destroy'])->name('health-goals.destroy');

// Medication Reminder Routes
Route::get('/medication-reminders', [MedicationReminderController::class, 'index'])->name('medication.reminders');
Route::get('/medication-reminders/create', [MedicationReminderController::class, 'create'])->name('medication-reminders.create');
Route::post('/medication-reminders', [MedicationReminderController::class, 'store'])->name('medication-reminders.store');
Route::get('/medication-reminders/{id}/edit', [MedicationReminderController::class, 'edit'])->name('medication-reminders.edit');
Route::put('/medication-reminders/{id}', [MedicationReminderController::class, 'update'])->name('medication-reminders.update');
Route::delete('/medication-reminders/{id}', [MedicationReminderController::class, 'destroy'])->name('medication-reminders.destroy');

Route::middleware(['auth'])->group(function (){
    Route::get('appointments/create/{doctor}', [AppointmentController::class, 'create'])->name('appointments.create');
    Route::post('appointments', [AppointmentController::class, 'store'])->name('appointments.store');
});


// Paypal Routes
Route::post('/paypal/payment', [PaypalController::class, 'payment'])->name('paypal.payment');
Route::get('/paypal/success', [PaypalController::class, 'success'])->name('paypal.success');
Route::get('/paypal/cancel', [PaypalController::class, 'cancel'])->name('paypal.cancel');