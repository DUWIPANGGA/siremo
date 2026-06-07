Route::get('/mobil', [MobilController::class,'index']);
Route::post('/login', [AuthController::class,'login']);
Route::post('/sewa', [SewaController::class,'store']);