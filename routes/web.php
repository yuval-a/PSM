<?php

use App\Sale;
use App\Http\Resources\Sale as SaleResource;
use Log\Log;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('sales');
});

Route::get('/sales', function () {
    return view('sales');
});
Route::get('/sales/new', function () {
    return view('new-sale');
});
Route::get('/sales/history', function () {
    $sales =  SaleResource::collection(Sale::paginate(5));
    $sales->transform(function ($sale) {
        $sale->sale_time = (new DateTime($sale->sale_time))->format('d-m-Y H:i:s');
        $sale->amount = $sale->amount / 100;
        return (new SaleResource($sale));
    });
    return view('sale-history', [ 'sales' => $sales ]);
});

