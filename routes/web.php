use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\DashboardController;

Route::resource('customers', CustomerController::class);
Route::resource('bookings', BookingController::class);
Route::resource('rooms', RoomController::class);

Route::get('/calendar', [CalendarController::class, 'index']);
Route::get('/dashboard', [DashboardController::class, 'index']);