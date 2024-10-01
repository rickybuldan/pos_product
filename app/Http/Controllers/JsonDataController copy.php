<?php

// namespace App\Http\Controllers;

// use App\Models\House;
// use App\Models\Package;

// use App\Models\Pet;
// use App\Models\Transaction;
// use App\Models\TransactionDetail;
// use App\Models\UserAccess;
// use App\Models\UsersRole;
// use Illuminate\Http\Request;
// use App\Helpers\Master;
// use App\Models\User;
// use App\Models\MenusAccess;

// use Illuminate\Support\Carbon;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Str;

class JsonDataController extends Controller
{
    //

    // for list menu side bar
    public function getAccessMenu(Request $request)
    {

        $MasterClass = new Master();

        $checkAuth = $MasterClass->Authenticated($MasterClass->getSession('user_id'));

        if ($checkAuth['code'] == $MasterClass::CODE_SUCCESS) {
            try {
                if ($request->isMethod('post')) {

                    DB::beginTransaction();

                    $data = json_decode($request->getContent());
                    $status = [];
                    $role_id = $MasterClass->getSession('role_id');
                    $saved = DB::select("SELECT * FROM menus_access ma LEFT JOIN users_access ua ON ma.id = ua.menu_access_id WHERE ua.role_id =" . $role_id . " AND ua.i_view=1");

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
        } else {

            $results = [
                'code' => '403',
                'info' => "Unauthorized",
            ];

        }

        return $MasterClass->Results($results);

    }
    //USER ROLE
    public function getRoleMenuAccess(Request $request)
    {

        $MasterClass = new Master();

        $checkAuth = $MasterClass->Authenticated($MasterClass->getSession('user_id'));

        if ($checkAuth['code'] == $MasterClass::CODE_SUCCESS) {
            try {
                if ($request->isMethod('post')) {

                    $data = json_decode($request->getContent());

                    DB::beginTransaction();

                    $status = [];
                    $sql = "SELECT * FROM users_roles ur LEFT JOIN users_access ua ON ur.id = ua.role_id WHERE ua.menu_access_id=" . $data->id;
                    // dd($sql);
                    $saved = DB::select($sql);
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
        } else {

            $results = [
                'code' => '403',
                'info' => "Unauthorized",
            ];

        }

        return $MasterClass->Results($results);

    }
    public function getRole(Request $request)
    {

        $MasterClass = new Master();

        $checkAuth = $MasterClass->Authenticated($MasterClass->getSession('user_id'));

        if ($checkAuth['code'] == $MasterClass::CODE_SUCCESS) {
            try {
                if ($request->isMethod('post')) {

                    $data = json_decode($request->getContent());


                    DB::beginTransaction();

                    $status = [];

                    $saved = DB::select('SELECT * FROM users_roles ur');
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
        } else {

            $results = [
                'code' => '403',
                'info' => "Unauthorized",
            ];

        }

        return $MasterClass->Results($results);

    }
    public function saveRole(Request $request)
    {

        $MasterClass = new Master();

        $checkAuth = $MasterClass->Authenticated($MasterClass->getSession('user_id'));

        if ($checkAuth['code'] == $MasterClass::CODE_SUCCESS) {
            try {
                if ($request->isMethod('post')) {

                    $dataArray = json_decode($request->getContent());

                    DB::beginTransaction();
                    $status = [];

                    // Simpan informasi metode ke dalam database AccessUser


                    $saved = UsersRole::updateOrCreate(
                        [
                            'id' => $dataArray->rid,
                        ], // Kolom dan nilai kriteria
                        [
                            'role_name' => $dataArray->role,
                        ] // Kolom yang akan diisi
                    );
                    // dd($saved);
                    $saved = $MasterClass->checkErrorModel($saved);

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
    public function getAccessRole(Request $request)
    {

        $MasterClass = new Master();

        $checkAuth = $MasterClass->Authenticated($MasterClass->getSession('user_id'));

        if ($checkAuth['code'] == $MasterClass::CODE_SUCCESS) {
            try {
                if ($request->isMethod('post')) {

                    DB::beginTransaction();

                    $dataArray = $request->get('param_type');

                    $status = [];
                    $sql = 'SELECT ma.*  FROM menus_access ma WHERE ma.param_type ="' . $dataArray . '"';

                    $saved = DB::select($sql);
                    // $saved = MenusAccess::leftJoin()where('param_type', 'VIEW')->get();

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
        } else {

            $results = [
                'code' => '403',
                'info' => "Unauthorized",
            ];

        }

        return $MasterClass->Results($results);

    }
    public function saveUserAccessRole(Request $request)
    {

        $MasterClass = new Master();

        $checkAuth = $MasterClass->Authenticated($MasterClass->getSession('user_id'));

        if ($checkAuth['code'] == $MasterClass::CODE_SUCCESS) {
            try {
                if ($request->isMethod('post')) {

                    $dataArray = json_decode($request->getContent());

                    DB::beginTransaction();
                    $status = [];
                    // Simpan informasi metode ke dalam database AccessUser
                    foreach ($dataArray as $data) {

                        $saved = UserAccess::updateOrCreate(
                            [
                                'menu_access_id' => $data->mid,
                                'role_id' => $data->rid, // Gantilah $roleId dengan nilai yang sesuai
                            ], // Kolom dan nilai kriteria
                            [
                                'i_view' => $data->is_active,
                            ] // Kolom yang akan diisi
                        );
                        $saved = $MasterClass->checkErrorModel($saved);

                        $status = $saved;

                        if ($status['code'] != $MasterClass::CODE_SUCCESS) {
                            break;
                        }

                    }

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
    public function updateMenuAccessName(Request $request)
    {

        $MasterClass = new Master();

        $checkAuth = $MasterClass->Authenticated($MasterClass->getSession('user_id'));

        if ($checkAuth['code'] == $MasterClass::CODE_SUCCESS) {
            try {
                if ($request->isMethod('post')) {

                    $mid = $request->get('mid');
                    $headmenu = $request->get('nhead');
                    $menuname = $request->get('nmenu');

                    DB::beginTransaction();
                    // dd($mid);

                    $status = [];
                    // Simpan informasi metode ke dalam database AccessUser

                    $saved = MenusAccess::where([
                        'id' => $mid,
                    ])->update([
                                'header_menu' => $headmenu,
                                'menu_name' => $menuname,
                            ]);


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

                    // dd($results);

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

    //USER LIST
    public function getUserList(Request $request)
    {

        $MasterClass = new Master();

        $checkAuth = $MasterClass->Authenticated($MasterClass->getSession('user_id'));

        if ($checkAuth['code'] == $MasterClass::CODE_SUCCESS) {
            try {
                if ($request->isMethod('post')) {

                    DB::beginTransaction();


                    $status = [];

                    $query = "
                        SELECT
                            us.id,
                            us.name,
                            us.email,
                            us.is_active,
                            us.role_id,
                            ur.role_name 
                        FROM
                            users us
                            LEFT JOIN users_roles ur ON us.role_id = ur.id
                        
                    ";

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
        } else {

            $results = [
                'code' => '403',
                'info' => "Unauthorized",
            ];

        }

        return $MasterClass->Results($results);

    }

    public function saveUser(Request $request)
    {

        $MasterClass = new Master();

        $checkAuth = $MasterClass->Authenticated($MasterClass->getSession('user_id'));

        if ($checkAuth['code'] == $MasterClass::CODE_SUCCESS) {
            try {
                if ($request->isMethod('post')) {

                    DB::beginTransaction();

                    $data = json_decode($request->getContent());

                    $status = [];
                    if ($data->password) {

                        $saved = User::updateOrCreate(
                            [
                                'id' => $data->id,
                            ],
                            [
                                'name' => $data->name,
                                'email' => $data->email,
                                'role_id' => $data->role_id,
                                'password' => Hash::make($data->password),
                                'is_active' => $data->is_active,
                            ] // Kolom yang akan diisi
                        );

                    } else {

                        $saved = User::updateOrCreate(
                            [
                                'id' => $data->id,
                            ],
                            [
                                'name' => $data->name,
                                'email' => $data->email,
                                'role_id' => $data->role_id,
                                'is_active' => $data->is_active,
                            ] // Kolom yang akan diisi
                        );

                    }

                    $saved = $MasterClass->checkErrorModel($saved);

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

    public function deleteUser(Request $request)
    {

        $MasterClass = new Master();

        $checkAuth = $MasterClass->Authenticated($MasterClass->getSession('user_id'));

        if ($checkAuth['code'] == $MasterClass::CODE_SUCCESS) {
            try {
                if ($request->isMethod('post')) {

                    DB::beginTransaction();

                    $data = json_decode($request->getContent());

                    $status = [];

                    $saved = User::where('id', $data->id)->delete();

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

    // transaction
    public function saveTransaction(Request $request)
    {

        $MasterClass = new Master();

        $checkAuth = $MasterClass->Authenticated($MasterClass->getSession('user_id'));

        if ($checkAuth['code'] == $MasterClass::CODE_SUCCESS) {
            try {
                if ($request->isMethod('post')) {

                    DB::beginTransaction();

                    $data = json_decode($request->getContent());

                    $status = [];

                    $nowdate = now();
                    $notrx = Transaction::generateNoTransaction($nowdate);

                    $transaction = Transaction::create([
                        'customer_name' => $data->name,
                        'transaction_start_date' => $data->date,
                        'transaction_type' => $data->transaction_type,
                        'no_transaction' => $notrx,
                        'address' => $data->address,
                        'created_by' => $MasterClass->getSession('user_id'),
                        'phone' => $data->phone,
                        'price_total' => $data->price_total,
                        'status' => 20
                    ]);

                    $saved1 = $MasterClass->checkErrorModel($transaction);

                    foreach ($data->data_pet as $pet) {
                        $detailTransac = TransactionDetail::create([
                            'transaction_id' => $transaction->id,
                            'package_id' => $pet->package,
                            'karyawan_id' => $pet->karyawan_id,
                            'pet_name' => $pet->name,
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
        } else {

            $results = [
                'code' => '403',
                'info' => "Unauthorized",
            ];

        }

        return $MasterClass->Results($results);

    }

    public function saveTransactionPenitipan(Request $request)
    {

        $MasterClass = new Master();

        $checkAuth = $MasterClass->Authenticated($MasterClass->getSession('user_id'));

        if ($checkAuth['code'] == $MasterClass::CODE_SUCCESS) {
            try {
                if ($request->isMethod('post')) {

                    DB::beginTransaction();

                    $data = json_decode($request->getContent());

                    $status = [];

                    $nowdate = now();
                    $notrx = Transaction::generateNoTransaction($nowdate);
                    $data->date = Carbon::parse($data->date)->format('Y-m-d');
                    $data->end_date = Carbon::parse($data->end_date)->format('Y-m-d');

                    $transaction = Transaction::create([
                        'customer_name' => $data->name,
                        'transaction_start_date' => $data->date,
                        'transaction_end_date' => $data->end_date,
                        'transaction_type' => $data->transaction_type,
                        'no_transaction' => $notrx,
                        'address' => $data->address,
                        'created_by' => $MasterClass->getSession('user_id'),
                        'phone' => $data->phone,
                        'price_total' => $data->price_total,
                        'status' => 20
                    ]);

                    $saved1 = $MasterClass->checkErrorModel($transaction);

                    foreach ($data->data_pet as $pet) {
                        $detailTransac = TransactionDetail::create([
                            'transaction_id' => $transaction->id,
                            'package_id' => $pet->package,
                            'house_id' => $pet->house,
                            'pet_name' => $pet->name,
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
        } else {

            $results = [
                'code' => '403',
                'info' => "Unauthorized",
            ];

        }

        return $MasterClass->Results($results);

    }

    public function loadGlobal(Request $request)
    {

        $MasterClass = new Master();

        $checkAuth = $MasterClass->Authenticated($MasterClass->getSession('user_id'));

        if ($checkAuth['code'] == $MasterClass::CODE_SUCCESS) {
            try {
                if ($request->isMethod('post')) {

                    DB::beginTransaction();


                    $status = [];

                    $data = json_decode($request->getContent());

                    $query = "
                        SELECT
                            *
                        FROM

                    " . $data->tableName;

                    $whereClause = isset($data->where) ? " WHERE " . $data->where : "";
                    
                    if ($whereClause) {
                        $query = $query . " WHERE " . $data->where;
                    }
                    if($data->tableName == 'transactions'){
                        $query = $query . " ORDER BY created_at DESC";
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
        } else {

            $results = [
                'code' => '403',
                'info' => "Unauthorized",
            ];

        }

        return $MasterClass->Results($results);

    }
    // dashboard
    public function getOverviewProfit(Request $request)
    {

        $MasterClass = new Master();

        $checkAuth = $MasterClass->Authenticated($MasterClass->getSession('user_id'));

        if ($checkAuth['code'] == $MasterClass::CODE_SUCCESS) {
            try {
                if ($request->isMethod('post')) {

                    DB::beginTransaction();


                    $status = [];


                    $query = "
                    SELECT
                        'Grooming' AS transaction_category,
                        COALESCE ( COUNT(*), 0 ) AS transaction_count,
                        COALESCE ( SUM( price_total ), 0 ) AS total_price 
                    FROM
                        transactions 
                    WHERE
                        transaction_type = 'GR'AND status = 10 UNION ALL
                    SELECT
                        'Penitipan' AS transaction_category,
                        COALESCE ( COUNT(*), 0 ) AS transaction_count,
                        COALESCE ( SUM( price_total ), 0 )
                        AS total_price 
                    FROM
                        transactions 
                    WHERE
                        transaction_type = 'PN' AND status = 10 UNION ALL
                    SELECT
                        'Other' AS transaction_category,
                        COALESCE ( COUNT(*), 0 ) AS transaction_count,
                        COALESCE ( SUM( price_total ), 0 ) AS total_price 
                    FROM
                        transactions 
                    WHERE
                        transaction_type NOT IN ( 'GR', 'PN' ) AND status = 10;
                    ";




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
        } else {

            $results = [
                'code' => '403',
                'info' => "Unauthorized",
            ];

        }

        return $MasterClass->Results($results);

    }

    public function getOverviewTransaction(Request $request)
    {

        $MasterClass = new Master();

        $checkAuth = $MasterClass->Authenticated($MasterClass->getSession('user_id'));

        if ($checkAuth['code'] == $MasterClass::CODE_SUCCESS) {
            try {
                if ($request->isMethod('post')) {

                    DB::beginTransaction();


                    $status = [];


                    // $query = "
                    // SELECT
                    //     all_days.day_of_week,
                    //     COALESCE(COUNT(transactions.id), 0) AS transaction_count,
                    //     COALESCE(SUM(transactions.price_total), 0) AS total_price
                    // FROM
                    //     (
                    //         SELECT 'Monday' AS day_of_week, 1 AS day_order
                    //         UNION SELECT 'Tuesday', 2
                    //         UNION SELECT 'Wednesday', 3
                    //         UNION SELECT 'Thursday', 4
                    //         UNION SELECT 'Friday', 5
                    //         UNION SELECT 'Saturday', 6
                    //         UNION SELECT 'Sunday', 7
                    //     ) AS all_days
                    // LEFT JOIN
                    //     transactions ON DAYNAME(transactions.transaction_start_date) = all_days.day_of_week
                    //     AND MONTH(transactions.transaction_start_date) = MONTH(CURRENT_DATE)
                    //     AND YEAR(transactions.transaction_start_date) = YEAR(CURRENT_DATE)
                    // GROUP BY
                    //     all_days.day_of_week, all_days.day_order
                    // ORDER BY
                    //     all_days.day_order;
                    // ";
                    $query = "
                        SELECT
                            all_days.day_of_week,
                            COALESCE(COUNT(CASE WHEN transactions.status = 10 THEN transactions.id END), 0) AS success_count,
                            COALESCE(SUM(CASE WHEN transactions.status = 10 THEN transactions.price_total END), 0) AS success_total,
                            COALESCE(COUNT(CASE WHEN transactions.status = 50 THEN transactions.id END), 0) AS failed_count,
                            COALESCE(SUM(CASE WHEN transactions.status = 50 THEN transactions.price_total END), 0) AS failed_total
                        FROM
                            (
                                SELECT 'Monday' AS day_of_week, 1 AS day_order
                                UNION SELECT 'Tuesday', 2
                                UNION SELECT 'Wednesday', 3
                                UNION SELECT 'Thursday', 4
                                UNION SELECT 'Friday', 5
                                UNION SELECT 'Saturday', 6
                                UNION SELECT 'Sunday', 7
                            ) AS all_days
                        LEFT JOIN
                            transactions ON DAYNAME(transactions.created_at) = all_days.day_of_week
                            AND MONTH(transactions.created_at) = MONTH(CURRENT_DATE)
                            AND YEAR(transactions.created_at) = YEAR(CURRENT_DATE)
                        GROUP BY
                            all_days.day_of_week, all_days.day_order
                        ORDER BY
                            all_days.day_order
                    ";



                    $saved = DB::select($query);
                    $saved = $MasterClass->checkErrorModel($saved);

                    // $response = [
                    //     [
                    //         'name' => 'Transaksi Success',
                    //         'data' => array_map(function ($item) {
                    //             return [
                    //                 'day_of_week' => $item->day_of_week,
                    //                 'count' => $item->success_count,
                    //                 'total' => $item->success_total,
                    //             ];
                    //         }, $saved['data']),
                    //     ],
                    //     [
                    //         'name' => 'Transaksi Failed',
                    //         'data' => array_map(function ($item) {
                    //             return [
                    //                 'day_of_week' => $item->day_of_week,
                    //                 'count' => $item->failed_count,
                    //                 'total' => $item->failed_total,
                    //             ];
                    //         }, $saved[]),
                    //     ],
                    // ];
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
        } else {

            $results = [
                'code' => '403',
                'info' => "Unauthorized",
            ];

        }

        return $MasterClass->Results($results);

    }

    public function getOverviewLastTransaction(Request $request)
    {

        $MasterClass = new Master();

        $checkAuth = $MasterClass->Authenticated($MasterClass->getSession('user_id'));

        if ($checkAuth['code'] == $MasterClass::CODE_SUCCESS) {
            try {
                if ($request->isMethod('post')) {

                    DB::beginTransaction();


                    $status = [];

                    $query = "
                    SELECT
                        t.*,
                        u.name,
                        td.pet_name
                    FROM
                        transactions t
                        LEFT JOIN transaction_details td ON td.transaction_id = t.id
                        LEFT JOIN users u ON u.id = td.karyawan_id
                    WHERE t.`status` = 10 AND t.transaction_type = 'GR'
                    ORDER BY t.updated_at DESC
                    ";

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
        } else {

            $results = [
                'code' => '403',
                'info' => "Unauthorized",
            ];

        }

        return $MasterClass->Results($results);

    }

    // package

    public function savePackage(Request $request)
    {

        $MasterClass = new Master();

        $checkAuth = $MasterClass->Authenticated($MasterClass->getSession('user_id'));

        if ($checkAuth['code'] == $MasterClass::CODE_SUCCESS) {
            try {
                if ($request->isMethod('post')) {

                    DB::beginTransaction();

                    $image = $request->file('image');
                    $imagePath = null;
                    
                    if($image){
                        $imagePath = $image->store('images', 'public');
                    }

                    $data = json_decode($request->input('data'));
                    
                    $status = [];


                    $saved = Package::updateOrCreate(
                        [
                            'id' => $data->id,
                        ],
                        [
                            'package_name' => $data->package_name,
                            'category' => $data->category,
                            'price' => $data->price,
                            'file_path' => $imagePath,
                            'desc' => $data->desc,
                        ] // Kolom yang akan diisi
                    );

                    $saved = $MasterClass->checkErrorModel($saved);

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

    public function saveHouse(Request $request)
    {

        $MasterClass = new Master();

        $checkAuth = $MasterClass->Authenticated($MasterClass->getSession('user_id'));

        if ($checkAuth['code'] == $MasterClass::CODE_SUCCESS) {
            try {
                if ($request->isMethod('post')) {

                    DB::beginTransaction();

                    $data = json_decode($request->getContent());

                    $status = [];


                    $saved = House::updateOrCreate(
                        [
                            'id' => $data->id,
                        ],
                        [
                            'house_name' => $data->house_name,

                            'desc' => $data->desc,
                        ] // Kolom yang akan diisi
                    );


                    $saved = $MasterClass->checkErrorModel($saved);

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

    public function savePet(Request $request)
    {

        $MasterClass = new Master();

        $checkAuth = $MasterClass->Authenticated($MasterClass->getSession('user_id'));

        if ($checkAuth['code'] == $MasterClass::CODE_SUCCESS) {
            try {
                if ($request->isMethod('post')) {

                    DB::beginTransaction();

                    $data = json_decode($request->getContent());

                    $status = [];


                    $saved = Pet::updateOrCreate(
                        [
                            'id' => $data->id,
                        ],
                        [
                            'pet_name' => $data->pet_name,

                        ] // Kolom yang akan diisi
                    );


                    $saved = $MasterClass->checkErrorModel($saved);

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

    public function loadStatusHouse(Request $request)
    {

        $MasterClass = new Master();

        $checkAuth = $MasterClass->Authenticated($MasterClass->getSession('user_id'));

        if ($checkAuth['code'] == $MasterClass::CODE_SUCCESS) {
            try {
                if ($request->isMethod('post')) {

                    DB::beginTransaction();


                    $status = [];

                    // $data = json_decode($request->getContent());

                    $query = "
                    SELECT
                        h.*,
                        COALESCE((
                            SELECT
                                'Booked'
                            FROM
                                transaction_details td
                            JOIN transactions t ON
                                td.transaction_id = t.id AND t.status NOT IN (10, 50) AND CURRENT_DATE BETWEEN t.transaction_start_date AND t.transaction_end_date
                            WHERE
                                td.house_id = h.id
                        ), 'Open') AS status
                    FROM
                        houses h
                    ";

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
        } else {

            $results = [
                'code' => '403',
                'info' => "Unauthorized",
            ];

        }

        return $MasterClass->Results($results);

    }

    public function changeStatusTransaction(Request $request)
    {

        $MasterClass = new Master();

        $checkAuth = $MasterClass->Authenticated($MasterClass->getSession('user_id'));

        if ($checkAuth['code'] == $MasterClass::CODE_SUCCESS) {
            try {
                if ($request->isMethod('post')) {

                    DB::beginTransaction();

                    $data = json_decode($request->getContent());

                    $status = [];

                    $saved = Transaction::where([
                        'id' => $data->id
                    ])->update([
                                'status' => $data->status,
                                'description' => isset($data->desc) ? $data->desc : "",
                            ]);

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

    public function assignKaryawanTransaction(Request $request)
    {
        $MasterClass = new Master();

        $checkAuth = $MasterClass->Authenticated($MasterClass->getSession('user_id'));

        if ($checkAuth['code'] == $MasterClass::CODE_SUCCESS) {
            try {
                if ($request->isMethod('post')) {

                    DB::beginTransaction();

                    $data = json_decode($request->getContent());

                    $status = [];

                    $saved = Transaction::where([
                        'id' => $data->id
                    ])->update([
                                'status' => $data->status,
                                'karyawan_id' => $data->karyawan_id,
                            ]);

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
