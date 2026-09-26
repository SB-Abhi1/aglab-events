<?php

use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| AG-Lab (SUST) - Events & Activities Module
| Member 2 Task: Events & Activities (Database design) - Full CRUD
*/

Route::redirect('/', '/events');

Route::resource('events', EventController::class);
