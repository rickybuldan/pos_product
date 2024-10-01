<?php

namespace App\Http\Controllers;

use App\Helpers\Master;
use App\Models\Pengadaan;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    //

    public function based(Request $request){
        $MasterClass = new Master();

        $checkAuth = $MasterClass->AuthenticatedView($request->route()->uri());
        
        if($checkAuth['code'] == $MasterClass::CODE_SUCCESS){
            $roled = $MasterClass->getSession('role_id');
            if($roled == 11){
                return redirect('/home');
            }
            return redirect('/dashboard');
        }else{
            return redirect('/home');
        }
    }
    public function dashboard(Request $request){
        $MasterClass = new Master();

        $checkAuth = $MasterClass->AuthenticatedView($request->route()->uri());
        
        if($checkAuth['code'] == $MasterClass::CODE_SUCCESS){
           
            $javascriptFiles = [
                asset('action-js/global/global-action.js'),
                asset('action-js/dashboard-action.js'),
            ];
        
            $cssFiles = [
                asset('template/globalcss/global.css'),
                // asset('css/custom.css'),
            ];
            $baseURL = url('/');
            $varJs = [
                'const baseURL = "' . $baseURL . '"',
            ];


            $menuData = $checkAuth['data'][0];
            $data = [
                'javascriptFiles' => $javascriptFiles,
                'cssFiles' => $cssFiles,
                'varJs'=> $varJs,
                'title' => ucwords(strtolower($menuData->header_menu)),
                'subtitle' => $menuData->menu_name,
                // Menambahkan base URL ke dalam array
            ];
        
            return view('pages.admin.dashboard')
                ->with($data);
        }else{
            return redirect('/login');
        }
    }
    
    public function userlist(Request $request){

        $MasterClass = new Master();

        $checkAuth = $MasterClass->AuthenticatedView($request->route()->uri());

        if($checkAuth['code'] == $MasterClass::CODE_SUCCESS){


            $javascriptFiles = [
                asset('action-js/global/global-action.js'),
                // asset('action-js/generate/generate-action.js'),
                asset('action-js/user/userlist-action.js'),
            ];
        
            $cssFiles = [
                asset('template/globalcss/global.css'),
                // asset('css/custom.css'),
            ];
            $baseURL = url('/');
            $varJs = [
                'const baseURL = "' . $baseURL . '"',
            ];

            $menuData = $checkAuth['data'][0];
    
            $data = [
                'javascriptFiles' => $javascriptFiles,
                'cssFiles' => $cssFiles,
                'varJs'=> $varJs,
                'title' => ucwords(strtolower($menuData->header_menu)),
                'subtitle' => $menuData->menu_name,
                 // Menambahkan base URL ke dalam array
            ];
        
            return view('pages.admin.users.userlist')
                ->with($data);
        }else{
            return redirect('/login');
        }
    }

    public function userrole(Request $request){

        $MasterClass = new Master();

        $checkAuth = $MasterClass->AuthenticatedView($request->route()->uri());
        
        if($checkAuth['code'] == $MasterClass::CODE_SUCCESS){
        

            $javascriptFiles = [
                asset('action-js/global/global-action.js'),
                asset('action-js/user/userrole-action.js'),
            ];
        
            $cssFiles = [
                asset('template/globalcss/global.css'),
                // asset('css/custom.css'),
            ];
            $baseURL = url('/');
            
            $varJs = [
                'const baseURL = "' . $baseURL . '"',
            ];

            $menuData = $checkAuth['data'][0];
            $data = [
                'javascriptFiles' => $javascriptFiles,
                'cssFiles' => $cssFiles,
                'varJs'=> $varJs,
                'title' => ucwords(strtolower($menuData->header_menu)),
                'subtitle' => $menuData->menu_name,
                // Menambahkan base URL ke dalam array
            ];

            return view('pages.admin.users.userrole')
            ->with($data);
            
        }else{
            return redirect('/login');
        }
    
        
    }

    public function transaction(Request $request){
        $MasterClass = new Master();

        $checkAuth = $MasterClass->AuthenticatedView($request->route()->uri());
        
        if($checkAuth['code'] == $MasterClass::CODE_SUCCESS){
           
            $javascriptFiles = [
                asset('action-js/global/global-action.js'),
                asset('action-js/transaction/transaction-action.js'),
                // asset('action-js/generate/generate-action.js'),
            ];
        
            $cssFiles = [
                asset('template/globalcss/global.css'),
                // asset('css/custom.css'),
            ];
            $baseURL = url('/');
            $varJs = [
                'const baseURL = "' . $baseURL . '"',
            ];

            $menuData = $checkAuth['data'][0];
            $data = [
                'javascriptFiles' => $javascriptFiles,
                'cssFiles' => $cssFiles,
                'varJs'=> $varJs,
                'title' => ucwords(strtolower($menuData->header_menu)),
                'subtitle' => $menuData->menu_name,
                // Menambahkan base URL ke dalam array
            ];
        
            return view('pages.admin.transaction.transaction')
                ->with($data);
        }else{
            return redirect('/login');
        }
    }

    public function report(Request $request){
        $MasterClass = new Master();

        $checkAuth = $MasterClass->AuthenticatedView($request->route()->uri());
        
        if($checkAuth['code'] == $MasterClass::CODE_SUCCESS){
           
            $javascriptFiles = [
                asset('action-js/global/global-action.js'),
                asset('action-js/report/report-action.js'),
                // asset('action-js/generate/generate-action.js'),
            ];
        
            $cssFiles = [
                // asset('css/main.css'),
                // asset('css/custom.css'),
            ];
            $baseURL = url('/');
            $varJs = [
                'const baseURL = "' . $baseURL . '"',
            ];

            $menuData = $checkAuth['data'][0];
            $data = [
                'javascriptFiles' => $javascriptFiles,
                'cssFiles' => $cssFiles,
                'varJs'=> $varJs,
                'title' => ucwords(strtolower($menuData->header_menu)),
                'subtitle' => $menuData->menu_name,
                // Menambahkan base URL ke dalam array
            ];
        
            return view('pages.admin.report.report')
                ->with($data);
        }else{
            return redirect('/login');
        }
    }
}


