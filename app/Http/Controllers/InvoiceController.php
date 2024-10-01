<?php

namespace App\Http\Controllers;

use App\Helpers\Master;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{

    public function invoice(Request $request)
    {
        $MasterClass = new Master();
        try {
            if ($request->isMethod('post')) {

                $noinvoice = $request->get('noinvoice');

                DB::beginTransaction();
                // dd($mid);

                $status = [];
                $sql = "SELECT
                            t.*,
                            td.quantity,
                            td.sub_total,
                            td.unit_price,
                            p.product_name,
                            DATE_FORMAT(t.created_at, '%d-%b-%Y, %h.%i%p') AS created_date_formatted,
                            us.name as kasir
                        FROM
                            transactions t
                            LEFT JOIN transaction_details td ON td.id_transaction = t.id
                            LEFT JOIN products p ON p.prod_code = td.kd_product
                            LEFT JOIN users us ON us.id = t.created_by
                        WHERE t.no_transaction ='" . $noinvoice . "'";
            
                $saved = DB::select($sql);
                $saved = $MasterClass->checkErrorModel($saved);

                $status = $saved;

                $results = [
                    'code' => $status['code'],
                    'info' => $status['info'],
                    'data' => $status['data'],
                ];

                return $MasterClass->Results($results);

            } else {
                $noinvoice = $request->query('noinvoice');

                $javascriptFiles = [
                    asset('action-js/global/global-action.js'),
                    // asset('action-js/generate/generate-action.js'),
                    asset('action-js/invoice/invoice-action.js'),
                ];

                $cssFiles = [
                    // asset('css/main.css'),
                    // asset('css/custom.css'),
                ];
                $baseURL = url('/');
                $varJs = [
                    'const baseURL = "' . $baseURL . '"',
                    'const no_invoice = "' . $noinvoice . '"',
                ];


                $data = [
                    'javascriptFiles' => $javascriptFiles,
                    'cssFiles' => $cssFiles,
                    'varJs' => $varJs,
                    'title' => "Invoice",
                    'subtitle' => "Detail Invoice",
                    // Menambahkan base URL ke dalam array
                ];

                return view('pages.admin.invoice.invoice')
                    ->with($data);
            }
        } catch (\Exception $e) {
            // Roll back the transaction in case of an exception
            $results = [
                'code' => '102',
                'info' => $e->getMessage(),
            ];

        }




    }

}
