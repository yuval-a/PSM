<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale;
use App\Http\Resources\Sale as SaleResource;
use GuzzleHttp\Client;
use Carbon\Carbon;

class SaleController extends Controller
{
    // this function generates a new PayMe API Sale, using data from the request object
    static public function generateSale(Request $request) {
        $client = new \GuzzleHttp\Client(['base_uri' => 'https://preprod.paymeservice.com', 'http_errors' => false]);

        $response = $client->post('/api/generate-sale', [
            'json' => [
                'seller_payme_id'=> "MPL14985-68544Z1G-SPV5WK2K-0WJWHC7N",
                // Multiply by 100, to convert to "cents"
                'sale_price'=> $request->sale_price * 100,
                'currency'=> $request->currency,
                'product_name'=> $request->product_name,
                'installments'=> 1,
                'language'=> "en"

            ]
        ]);
        
        return json_decode($response->getBody());
    }

    public function index()
    {
        return SaleResource::collection(Sale::paginate(10));
    }

    public function store(Request $request)
    {
        // call PayMe API to generate a new "sale"
        $sale_data = SaleController::generateSale($request);
        if ($sale_data->status_code == 1)
            return response()->json([
                'success' => false,
                'message' => $sale_data->status_error_details
            ]);

        // Save a new sale to our DB
        $sale = Sale::create([
            'sale_time' => Carbon::now(),
            'sale_number' => $sale_data->payme_sale_code,
            'description' => $request->product_name,
            // Price in "cents"
            'amount' => $request->sale_price * 100,
            'currency'=> $request->currency,
            'payment_link' => $sale_data->sale_url
        ]);

        return response()->json([
            'success' => true,
            'sale' => $sale
        ]);
    }
}
