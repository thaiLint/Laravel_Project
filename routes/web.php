use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\DashboardController;

Route::resource('customers', CustomerController::class);
Route::resource('bookings', BookingController::class);
Route::resource('rooms', RoomController::class);

<<<<<<< HEAD
Route::get('/', function () {
    return view('home');
});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});


Route::get('/admin/room', function () {
    return view('admin.room');
});


Route::get('/admin/calendar', function () {
    return view('admin.calendar');
});

Route::get('/admin/customer', function () {
    return view('admin.customer');
});


Route::get('/admin/payment', function () {
    return view('admin.payment');
});


Route::get('/admin/report', function () {
    return view('admin.report');
});
=======
Route::get('/calendar', [CalendarController::class, 'index']);
Route::get('/dashboard', [DashboardController::class, 'index']);
>>>>>>> 257f029041865ecc286816787e838c779ce2fdee
