<?php

namespace App\Http\Controllers;

use App\Helpers\Master;
use App\Models\Cart;
use App\Models\Pengadaan;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{

    public function home(Request $request)
    {

        $javascriptFiles = [
            asset('action-js/global/global2-action.js'),
            asset('action-js/global/home-action.js')
            // asset('action-js/generate/generate-action.js'),
            // asset('action-js/masterdata/house-action.js'),
        ];

        $cssFiles = [
            // asset('css/main.css'),
            // asset('css/custom.css'),
        ];
        $userId = Auth::id();
        $baseURL = url('/');
        $varJs = [
            'const baseURL = "' . $baseURL . '"',
            'const uid = "' . $userId . '"',
        ];


        $data = [
            'javascriptFiles' => $javascriptFiles,
            'cssFiles' => $cssFiles,
            'varJs' => $varJs,
            'title' => "Home",
            'subtitle' => "Index",
            // Menambahkan base URL ke dalam array
        ];

        return view('pages.landing2.home')
            ->with($data);

    }

    // rajaongkir
    public function loadProvinces(Request $request)
    {

        $MasterClass = new Master();


        try {
            if ($request->isMethod('get')) {

                DB::beginTransaction();


                $status = [];

                $response = Http::withHeaders([
                    'key' => 'd3e05c8c3582deda2a7e74b630825127' // Ganti dengan kunci API yang sesuai
                ])->get('https://api.rajaongkir.com/starter/province');
        
                if ($response->failed()) {
                    $saved['code']= $MasterClass::CODE_FAILED;
                    $saved['info']= "Error: " . $response->status();
                }else{
                    $res = json_decode($response->body());
                    $saved['code']= $MasterClass::CODE_SUCCESS;
                    $saved['info']= $MasterClass::INFO_SUCCESS;
                    $saved['data']= $res->rajaongkir->results;
                }
                
            
                $status = $saved;

                // if($status['code'] == $MasterClass::CODE_SUCCESS){
                //     DB::commit();
                // }else{
                //     DB::rollBack();
                // }

                $results = [
                    'code' => $status['code'],
                    'info' => $status['info'],
                    'data' => $status['data'],
                ];



            } else {
                $results = [
                    'code' => '103',
                    'info' => "Method Failed",
                ];
            }
        } catch (\Exception $e) {
            // Roll back the transaction in case of an exception
            $results = [
                'code' => '102',
                'info' => $e->getMessage(),
            ];

        }

        return $MasterClass->Results($results);

    }

    public function loadCities(Request $request)
    {

        $MasterClass = new Master();


        try {
            if ($request->isMethod('post')) {

                DB::beginTransaction();


                $status = [];
                $data   = json_decode($request->getContent());
                
                $response = Http::withHeaders([
                    'key' => 'd3e05c8c3582deda2a7e74b630825127' // Ganti dengan kunci API yang sesuai
                ])->get('https://api.rajaongkir.com/starter/city?province='.$data->province);
        
                if ($response->failed()) {
                    $saved['code']= $MasterClass::CODE_FAILED;
                    $saved['info']= "Error: " . $response->status();
                }else{
                    $res = json_decode($response->body());
                    $saved['code']= $MasterClass::CODE_SUCCESS;
                    $saved['info']= $MasterClass::INFO_SUCCESS;
                    $saved['data']= $res->rajaongkir->results;
                }
                
            
                $status = $saved;

                // if($status['code'] == $MasterClass::CODE_SUCCESS){
                //     DB::commit();
                // }else{
                //     DB::rollBack();
                // }

                $results = [
                    'code' => $status['code'],
                    'info' => $status['info'],
                    'data' => $status['data'],
                ];



            } else {
                $results = [
                    'code' => '103',
                    'info' => "Method Failed",
                ];
            }
        } catch (\Exception $e) {
            // Roll back the transaction in case of an exception
            $results = [
                'code' => '102',
                'info' => $e->getMessage(),
            ];

        }

        return $MasterClass->Results($results);

    }

    public function checkCost(Request $request)
    {

        $MasterClass = new Master();


        try {
            if ($request->isMethod('post')) {

                DB::beginTransaction();

                $status = [];
                $data   = json_decode($request->getContent());
                $data   = $data->obj;
                // dd($data);

                $response = Http::asForm()->withHeaders([
                    'content-type' => 'application/x-www-form-urlencoded',
                    'key' => 'd3e05c8c3582deda2a7e74b630825127',
                ])->post('https://api.rajaongkir.com/starter/cost', 
                [
                    'origin' => $data->origin,          // ID kota/kabupaten asal (contoh: Jakarta)
                    'destination' => $data->destination,     // ID kota/kabupaten tujuan (contoh: Bandung)
                    'weight' => $data->weight,           // Berat kiriman dalam gram
                    'courier' => $data->courier          // Kode kurir (contoh: jne, tiki, pos)
                ]);
              
                if ($response->failed()) {
                    $saved['code']= $MasterClass::CODE_FAILED;
                    $saved['info']= "Error: " . $response->status();
                    $saved['data']= null;
                }else{
                    $res = $response->json();
                   
                    $saved['code']= $MasterClass::CODE_SUCCESS;
                    $saved['info']= $MasterClass::INFO_SUCCESS;
                    $saved['data']= $res['rajaongkir']['results'];
                }
            
                $status = $saved;

                // if($status['code'] == $MasterClass::CODE_SUCCESS){
                //     DB::commit();
                // }else{
                //     DB::rollBack();
                // }

                $results = [
                    'code' => $status['code'],
                    'info' => $status['info'],
                    'data' => $status['data'],
                ];



            } else {
                $results = [
                    'code' => '103',
                    'info' => "Method Failed",
                ];
            }
        } catch (\Exception $e) {
            // Roll back the transaction in case of an exception
            $results = [
                'code' => '102',
                'info' => $e->getMessage(),
            ];

        }

        return $MasterClass->Results($results);

    }

    // end rajaongkir

    public function checkout(Request $request)
    {
        if(Auth::check()){
            $javascriptFiles = [
                asset('action-js/global/global2-action.js'),
                asset('action-js/global/checkout-action.js')
                // asset('action-js/generate/generate-action.js'),
                // asset('action-js/masterdata/house-action.js'),
            ];

            $cssFiles = [
                // asset('css/main.css'),
                // asset('css/custom.css'),
            ];
            $userId = Auth::id();
            $baseURL = url('/');
            $varJs = [
                'const baseURL = "' . $baseURL . '"',
                'const uid = "' . $userId . '"',
            ];


            $data = [
                'javascriptFiles' => $javascriptFiles,
                'cssFiles' => $cssFiles,
                'varJs' => $varJs,
                'title' => "Checkout",
                'subtitle' => "Index",
                // Menambahkan base URL ke dalam array
            ];

            return view('pages.landing2.checkout')
                ->with($data);
        }
    
        return redirect('/login');
        
    }
    // method action db
    public function loadGlobal(Request $request)
    {

        $MasterClass = new Master();


        try {
            if ($request->isMethod('post')) {

                DB::beginTransaction();


                $status = [];

                $data   = json_decode($request->getContent());
                $query  = "
                            SELECT
                                *
                            FROM " . $data->tableName;
                $tab    = "carts";
                
                if (str_contains($data->tableName, $tab) == true) {
                    $query = "
                                SELECT
                                    c.*,
                                    p.price,
                                    p.product_name,
                                    p.file_path,
                                    p.stock,
                                    (p.weight * c.qty) weight

                                FROM " . $data->tableName;
                }

                $whereClause = isset($data->where) ? " WHERE " . $data->where : "";

                if ($whereClause) {
                    $query = $query . " WHERE " . $data->where;
                }

                $saved = DB::select($query);
                $saved = $MasterClass->checkErrorModel($saved);

                $status = $saved;

                // if($status['code'] == $MasterClass::CODE_SUCCESS){
                //     DB::commit();
                // }else{
                //     DB::rollBack();
                // }

                $results = [
                    'code' => $status['code'],
                    'info' => $status['info'],
                    'data' => $status['data'],
                ];



            } else {
                $results = [
                    'code' => '103',
                    'info' => "Method Failed",
                ];
            }
        } catch (\Exception $e) {
            // Roll back the transaction in case of an exception
            $results = [
                'code' => '102',
                'info' => $e->getMessage(),
            ];

        }



        return $MasterClass->Results($results);

    }

    public function saveTransaction(Request $request)
    {

        $MasterClass = new Master();


        try {
            if ($request->isMethod('post')) {

                DB::beginTransaction();

                $data = json_decode($request->input('data'));

                $status = [];

                $image = $request->file('image');
                $imagePath = null;
                
                if($image){
                    $imagePath = $image->store('images', 'public');
                }

                $nowdate = now();
                $notrx = Transaction::generateNoTransaction($nowdate);
                $createdBy = !empty($data->uid) ? $data->uid : null;
                $transaction = Transaction::create([
                    'customer_name' => $data->name,
                    'transaction_start_date' => $data->date,
                    'transaction_type' => $data->transaction_type,
                    'no_transaction' => $notrx,
                    'address' => $data->address,
                    'created_by' => $createdBy,
                    'phone' => $data->phone,
                    'price_total' => $data->price_total,
                    'bukti' => $imagePath,
                    'status' => 40,
                ]);

                $saved1 = $MasterClass->checkErrorModel($transaction);

                foreach ($data->data_pet as $pet) {
                    $detailTransac = TransactionDetail::create([
                        'transaction_id' => $transaction->id,
                        'package_id' => $pet->package,
                        'pet_name' => $pet->name,
                        'karyawan_id' => $pet->karyawan_id,
                        'pet_type' => $pet->type,
                    ]);

                    $saved2 = $MasterClass->checkErrorModel($detailTransac);
                }

                $status = $saved2;
                

                if ($status['code'] == $MasterClass::CODE_SUCCESS) {
                    DB::commit();
                    
                } else {
                    DB::rollBack();
                }
                $status = $saved1;
                $results = [
                    'code' => $status['code'],
                    'info' => $status['info'],
                    'data' => $status['data'],
                ];

            } else {
                $results = [
                    'code' => '103',
                    'info' => "Method Failed",
                ];
            }
        } catch (\Exception $e) {
            // Roll back the transaction in case of an exception
            $results = [
                'code' => '102',
                'info' => $e->getMessage(),
            ];

        }



        return $MasterClass->Results($results);

    }

    public function loadProductSell(Request $request)
    {

        $MasterClass = new Master();


        try {
            if ($request->isMethod('post')) {

                DB::beginTransaction();


                $status = [];

                $data   = json_decode($request->getContent());
                $type   = $data->type;
                $query  = ' SELECT 
                                COALESCE(SUM(DISTINCT td.id_product), 0) AS total_sold,
                                p.*
                            FROM
                                products p
                            LEFT JOIN transaction_details td ON td.id_product = p.id
                            GROUP BY p.id
                            ORDER BY total_sold DESC';
                
                if($type == 'new'){
                    $query  = ' SELECT *
                                    FROM products
                                    WHERE YEAR(created_at) = YEAR(CURRENT_DATE)
                                    AND MONTH(created_at) = MONTH(CURRENT_DATE);
                                    ORDER BY id DESC';
                }

                $saved = DB::select($query);
                $saved = $MasterClass->checkErrorModel($saved);

                $status = $saved;

                // if($status['code'] == $MasterClass::CODE_SUCCESS){
                //     DB::commit();
                // }else{
                //     DB::rollBack();
                // }

                $results = [
                    'code' => $status['code'],
                    'info' => $status['info'],
                    'data' => $status['data'],
                ];



            } else {
                $results = [
                    'code' => '103',
                    'info' => "Method Failed",
                ];
            }
        } catch (\Exception $e) {
            // Roll back the transaction in case of an exception
            $results = [
                'code' => '102',
                'info' => $e->getMessage(),
            ];

        }

        return $MasterClass->Results($results);

    }

    public function saveCart(Request $request)
    {

        $MasterClass = new Master();

        try {
            if ($request->isMethod('post')) {

                DB::beginTransaction();

                // $data = json_decode($request->input('data'));
                $data           = json_decode($request->getContent());
                $status         = [];
                $query          = "SELECT * FROM carts WHERE id_product =".$data->id_product." AND id_user =".$data->id_user;
                $getSameProduct = DB::select($query);
                $getResults     = $MasterClass->checkErrorModel($getSameProduct);
                $qty            = $data->qty;
               
                if(count($getResults['data']) > 0){
                    $qty = $getResults['data'][0]->qty;
                    $qty += $data->qty ;
                };

                $saved = Cart::updateOrCreate(
                    [
                        'id_product' => $data->id_product,
                        'id_user'   => $data->id_user
                    ],
                    [
                        'id_product'    => $data->id_product,
                        'id_user'       => $data->id_user,
                        'qty'           => $qty,
                    ]
                );

                $saved  = $MasterClass->checkErrorModel($saved);
                $status = $saved;
                
                if ($status['code'] == $MasterClass::CODE_SUCCESS) {
                    DB::commit();
                    
                } else {
                    DB::rollBack();
                }

                $results = [
                    'code' => $status['code'],
                    'info' => $status['info'],
                    'data' => $status['data'],
                ];

            } else {
                $results = [
                    'code' => '103',
                    'info' => "Method Failed",
                ];
            }
        } catch (\Exception $e) {
            // Roll back the transaction in case of an exception
            $results = [
                'code' => '102',
                'info' => $e->getMessage(),
            ];

        }



        return $MasterClass->Results($results);

    }

    public function loadCart(Request $request)
    {

        $MasterClass = new Master();


        try {
            if ($request->isMethod('post')) {

                DB::beginTransaction();

                $status = [];

                $data   = json_decode($request->getContent());
                $type   = $data->type;
                $query  = ' SELECT 
                                COALESCE(SUM(DISTINCT td.id_product), 0) AS total_sold,
                                p.*
                            FROM
                                products p
                            LEFT JOIN transaction_details td ON td.id_product = p.id
                            GROUP BY p.id
                            ORDER BY total_sold DESC';

                $saved = DB::select($query);
                $saved = $MasterClass->checkErrorModel($saved);

                $status = $saved;

                // if($status['code'] == $MasterClass::CODE_SUCCESS){
                //     DB::commit();
                // }else{
                //     DB::rollBack();
                // }

                $results = [
                    'code' => $status['code'],
                    'info' => $status['info'],
                    'data' => $status['data'],
                ];



            } else {
                $results = [
                    'code' => '103',
                    'info' => "Method Failed",
                ];
            }
        } catch (\Exception $e) {
            // Roll back the transaction in case of an exception
            $results = [
                'code' => '102',
                'info' => $e->getMessage(),
            ];

        }

        return $MasterClass->Results($results);

    }

    public function deleteGlobal(Request $request)
    {

        $MasterClass = new Master();

        $checkAuth = $MasterClass->Authenticated($MasterClass->getSession('user_id'));

        if ($checkAuth['code'] == $MasterClass::CODE_SUCCESS) {
            try {
                if ($request->isMethod('post')) {

                    DB::beginTransaction();

                    $data = json_decode($request->getContent());

                    $status = [];

                    $saved = DB::table($data->tableName)->where('id', $data->id)->delete();

                    $saved = $MasterClass->checkerrorModelUpdate($saved);

                    $status = $saved;

                    if ($status['code'] == $MasterClass::CODE_SUCCESS) {
                        DB::commit();
                    } else {
                        DB::rollBack();
                    }

                    $results = [
                        'code' => $status['code'],
                        'info' => $status['info'],
                        'data' => $status['data'],
                    ];



                } else {
                    $results = [
                        'code' => '103',
                        'info' => "Method Failed",
                    ];
                }
            } catch (\Exception $e) {
                // Roll back the transaction in case of an exception
                $results = [
                    'code' => '102',
                    'info' => $e->getMessage(),
                ];

            }
        } else {

            $results = [
                'code' => '403',
                'info' => "Unauthorized",
            ];

        }

        return $MasterClass->Results($results);

    }

    

}



