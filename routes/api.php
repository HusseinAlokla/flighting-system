    <?php

    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\UserController;
    use App\Http\Controllers\FlightController;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Validation\ValidationException;
    use App\Models\User;
    use App\Http\Controllers\AuthController;
  


        // Publicly accessible routes
        Route::post('/login', [AuthController::class, 'login']);
        Route::get('/users/export', [UserController::class, 'export']);
        // Protected routes accessible only by authenticated users
        Route::middleware('auth:sanctum')->group(function () {
            // Get authenticated user's information
            Route::get('/user', function (Request $request) {
                return $request->user();
            });

            // Logout route
            Route::post('/logout', [AuthController::class, 'logout']);
            
            // Routes accessible by users with 'admin' role
          Route::group(['middleware' => ['role:admin']], function () {
                Route::apiResource('users', UserController::class);
            
         });

            // Routes requiring "manage flights" permission
            Route::group(['middleware' => ['permission:manage flights']], function () {
                Route::apiResource('flights', FlightController::class);
                // Any other routes requiring this permission
            });

            Route::middleware('throttle:60,1')->group(function () {
            Route::get('/passenger', function (Request $request) {
                return $request->passenger();
            });
        });
        });


       
       
