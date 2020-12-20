<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage; //responsible for filesystems

use Illuminate\Support\Facades\Auth; //responsible for our authentication 

use Illuminate\Support\Facades\DB; //responsible for DB

use Validator;

use App\User;
use App\Store;
use App\Category;

use App\Exports\ExportFromView;
use Maatwebsite\Excel\Facades\Excel;


class ReportsController extends Controller
{
    

    //default selected sidebar
    public $active_parent = 'Reports';

    public $menu_group = '/reports';

    public $categories = [];
    public $stores = [];


    public function __construct(){
        $this->middleware(['auth']);
    }

    public function setActiveParent(){
        session()->flash('active_parent', $this->active_parent);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $sessionID = Auth::id();

        $search = ( request()->search ) ? request()->search : '';

        //retrieve assigned reports
        $reports = DB::select("CALL usp_getAssignedReports($sessionID, '$search')");

        //dd($reports);

        //default active sidebar
        $this->setActiveParent();

        $sub_menu = User::getSubMenu(Auth::id(), $this->menu_group);
        //dd($sub_menu);

       
        return view('reports.index', compact('reports', 'sub_menu', 'search'));

    }//END index



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $search = (request()->search) ? request()->search : '';
        $reports = DB::SELECT("SELECT * FROM permalink where family = 'Reports' 
            AND stat = 1 AND type = 'B' AND description like '%$search%'
            ORDER BY description ASC");

        return view('reports.rename', compact('reports', 'search'));

    }//END create




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        if($request->name){

            foreach($request->name as $key => $v){

                DB::table('permalink')->where('pk_permalink', $key)
                ->update(['newdescription' => $v]);

            }   
        }
        

        session()->flash('success', "Reports has been renamed!");
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        $sessionID = Auth::id(); 

        //check if report is accesible by the user
        //Administrator
        if( $sessionID == 1000 ){

            $reports = DB::select("
                SELECT a.*
                FROM permalink a 
                WHERE a.stat = 1  AND a.family = 'Reports' AND a.type <> 'A' 
                AND a.pk_permalink = '$id';
            ");

        }else{

            $reports = DB::select("

                SELECT a.*
                FROM permalink a 
                INNER JOIN useraccess b 
                ON a.pk_permalink = b.fk_permalink
                WHERE a.stat = 1  AND a.family = 'Reports' AND a.type <> 'A' 
                AND b.fk_users = '$sessionID' AND a.pk_permalink = '$id'

            ");

        }

        if( count($reports) == 0 ){
            return redirect('/404');
        }

     
        //default active sidebar
        $this->setActiveParent();

        $filters = []; //dynamic filter preferences

        $sub_menu = User::getSubMenu(Auth::id(), $this->menu_group);
        //dd($sub_menu);

        $dateFrom = ( $request->dateFrom ) ? $request->dateFrom : date('Y-m-d');
        $dateTo = ( $request->dateTo ) ? $request->dateTo : date('Y-m-d');

        $fk_stores = ( $request->fk_stores ) ? $request->fk_stores : null;
        $stores_arr =  DB::select("CALL usp_getAssignedStores($sessionID)");
        //set default store if no selected
        if($fk_stores == null  ){
            $fk_stores = ( count($stores_arr) > 0 ) ? $stores_arr[0]->pk_stores : null;
        }

        //dd($fk_stores);


        $fk_products = ( $request->fk_products ) ? $request->fk_products : null;
        $productdesc = ( $request->productdesc ) ? $request->productdesc : '';

        
        $fk_categories = ( $request->fk_categories ) ? $request->fk_categories : 'All';
        $categories_arr =  Category::getActiveCategoriesByType('products');
        $categories_desc = ( $request->categories_desc ) ? $request->categories_desc : '';


        $fk_users = ( $request->fk_users ) ? $request->fk_users : null;
        $fullname = ( $request->fullname ) ? $request->fullname : '';

        $audittype = ( $request->audittype ) ? $request->audittype : null;

        $reporttype = ( $request->reporttype ) ? $request->reporttype : 'Summary';


        $export = ( request()->export ) ? request()->export : 'false';



        $results = [];

        //check if selected report is found and accesible by the user
        if( count($reports) > 0 ){

            switch ($id) {

                //electronic stock card
                //docdate is null = beginning inventory
                case '1701':

                    //1 = dateFrom & dateTo,  2 = stores, 3 = products, 5 = category, 10 = apply filter
                    $filters = [1,2,3,10];

                    /*$catWhere = "";
                    if ($fk_categories != 'All') {
                        $catWhere = "AND b.fk_categories = '$fk_categories'";
                    }*/

                    $results = DB::select("
                        SELECT a.*, c.description as category FROM vw_electronicstockcard a
                        INNER JOIN products b 
                        ON a.pk_products = b.pk_products
                        INNER JOIN categories c 
                        ON b.fk_categories = c.pk_categories
                        WHERE ( a.fk_stores = '$fk_stores'  or '$fk_stores' = 'All' )
                        AND a.pk_products = '$fk_products'
                        AND ( a.docdate IS NULL OR ( a.docdate BETWEEN '$dateFrom 00:00:00' AND '$dateTo 23:59:59' ) )
                        AND a.type = 'inventory'
                        ORDER BY docdate
                    ");


                    if($export == 'true'){

                        return Excel::download(new ExportFromView('reports.1701-table', [
                          'results'=> $results, 
                        ]), "electronic stock card.xlsx");

                    }//END $export == 'true'
                    
                break;

                //sales ledger
                case '1702':

                    //1 = dateFrom & dateTo,  2 = stores, 4 = users, 5 = category, 9 = report type, 10 = apply filter
                    $filters = [1,2,4,5,9,10];

                    $catWhere = "";
                    if ($fk_categories != 'All') {
                        $catWhere = "AND b.fk_categories = '$fk_categories'";
                    }

                    $userWhere = "";
                    if ($fk_users != '-1' && $fk_users != '') {
                        $userWhere = "AND a.fk_createdby = '$fk_users'";
                    } else {
                        $userWhere = "AND a.fk_createdby is not null";
                    }

                    $selectDetails = '';
                    $groupDetails = '';

                    if ($reporttype == 'Details') {
                        $selectDetails = ', b.name as itemname, b.category, b.qty, b.unitprice, b.netamount as itemnetamount';
                        $groupDetails = 'ORDER BY a.pk_salesmstr ASC, a.docdate;';
                    }

                    if ($reporttype == 'Summary') {
                        $groupDetails = 'GROUP BY a.pk_salesmstr ORDER BY a.docdate ASC';
                    }

                    $results = DB::select("
                    SELECT a.pk_salesmstr, a.docdate, a.fk_stores, a.storename, a.payername,
                        a.netamount, a.totalpayment,  a.changeamount, a.cashiername,
                        CASE 
                            -- negative = sukleanan
                            -- + kay negative man ang change
                            WHEN a.changeamount < 0 THEN a.totalpayment + a.changeamount
                            ELSE a.totalpayment
                        END AS paidamount,

                        CASE 
                            -- negative change = sukleanan
                            -- + kay negative man ang change
                            WHEN a.changeamount < 0 THEN a.netamount - (a.totalpayment + a.changeamount)
                            ELSE a.netamount - a.totalpayment
                        END AS balanceamount

                        $selectDetails

                        FROM vw_salesmstr a 
                        INNER JOIN vw_salesdtl b
                        ON a.pk_salesmstr = b.fk_salesmstr
                        WHERE ( fk_stores = '$fk_stores'  or '$fk_stores' = 'All' )
                        -- AND COALESCE(a.iscancel, 0) = 0 
                        AND a.netamount > 0
                        AND a.docdate BETWEEN '$dateFrom 00:00:00' AND '$dateTo 23:59:59'
                        $userWhere
                        $catWhere 
                        $groupDetails
                    ");

                    // dd($results);

                    if($export == 'true'){

                        return Excel::download(new ExportFromView('reports.1702-table', [
                          'results'=> $results, 
                          'reporttype' => $reporttype
                        ]), "sales ledger.xlsx");

                    }//END $export == 'true'
                    
               

                break;


                //top products LIMIT 20
                case '1703':

                    //1 = dateFrom & dateTo,  2 = stores, 5 = category, 10 = apply filter
                    $filters = [1,2,5,10];

                    $catWhere = "";
                    if ($fk_categories != 'All') {
                        $catWhere = "AND a.fk_categories = '$fk_categories'";
                    }

                    $results = DB::select("
                        SELECT a.fk_products, a.name, SUM(a.qty) AS qty, a.uom, a.unitprice, a.fk_categories,  a.category,
                        SUM(a.netamount) AS netamount, b.fk_stores, b.storename
                        FROM vw_salesdtl a 
                        INNER JOIN vw_salesmstr b 
                        ON a.fk_salesmstr = b.pk_salesmstr
                        WHERE ( fk_stores = '$fk_stores'  or '$fk_stores' = 'All' )
                        AND COALESCE(b.iscancel, 0) = 0 
                        $catWhere
                        AND b.docdate BETWEEN '$dateFrom 00:00:00' AND '$dateTo 23:59:59'
                        GROUP BY a.fk_products, a.name, a.uom, a.unitprice, b.fk_stores, b.storename
                        ORDER BY netamount DESC
                        LIMIT 20

                    ");

                    if($export == 'true'){

                        return Excel::download(new ExportFromView('reports.1703-table', [
                          'results'=> $results, 
                        ]), "top products.xlsx");

                    }//END $export == 'true'

                break;


                //inventory critical level
                case '1704':

                    //2 = stores, 5 = category, 10 = apply filter
                    $filters = [2,5,10];

                    $catWhere = "";
                    if ($fk_categories != 'All') {
                        $catWhere = "AND a.fk_categories = '$fk_categories'";
                    }

                    $results = DB::select("
                        SELECT udf_getStoreName(a.fk_stores) AS 'storename', a.pk_products, a.type, a.name, a.category, 
                        a.supplier, a.qty, a.uom, a.alertqty
                        FROM vw_productsdtl a 
                        WHERE ( a.fk_storesvisibility = '$fk_stores'  or '$fk_stores' = 'All' )
                        AND ( a.fk_stores = '$fk_stores' or '$fk_stores' = 'All' )
                        AND a.stat = 1 
                        AND a.qty <= a.alertqty
                        AND a.type = 'inventory'
                        $catWhere
                        GROUP BY a.fk_stores, a.pk_products
                        ORDER BY a.storename ASC, a.name ASC
                    "); 

                    //$results = \App\ProductsMstrView::getInventoryCriticalLevel($fk_stores);

                    if($export == 'true'){

                        return Excel::download(new ExportFromView('reports.1704-table', [
                          'results'=> $results, 
                        ]), "inventory critical level.xlsx");

                    }//END $export == 'true'
                    
                break;


                //general ledger
                //notice: nag stored procedure kay mo error man sa laravel ang order by na dli completo sa select
                //adtu sa stored procedures dili rmn mo error
                case '1705':

                    ///1 = dateFrom & dateTo,  2 = stores, 10 = apply filter
                    $filters = [1,2,10];

                    //will cause exception if stores selected == equal
                    $results = DB::select("call usp_displayGenLedger('$fk_stores', '$dateFrom 00:00:00', '$dateTo 23:59:59')");

                    if($export == 'true'){

                        return Excel::download(new ExportFromView('reports.1705-table', [
                          'results'=> $results, 
                        ]), "general ledger.xlsx");

                    }//END $export == 'true'

                break;


                //inventory runnung balance
                case '1706':

                    //2 = stores, 5 = category, 10 = apply filter
                    $filters = [2,5,10];

                    $catWhere = "";
                    if ($fk_categories != 'All') {
                        $catWhere = "AND a.fk_categories = '$fk_categories'";
                    }

                    $results = DB::select("
                        SELECT a.fk_storesvisibility, a.storename, a.pk_products, a.type, a.name, a.category, 
                        a.supplier, a.qty, 
                        /*( select distinct qty from vw_productsdtl 
                            where pk_products = a.pk_products and fk_stores = a.fk_storesvisibility  
                            GROUP BY fk_stores
                        ) as qty, */
                        a.uom
                        FROM vw_productsdtl a 
                        WHERE ( a.fk_storesvisibility = '$fk_stores'  or '$fk_stores' = 'All' )
                        AND ( a.fk_storesvisibility = '$fk_stores' or '$fk_stores' = 'All' )
                        AND a.stat = 1 
                        AND a.type = 'inventory'
                        $catWhere
                        GROUP BY a.fk_storesvisibility, a.pk_products
                        ORDER BY a.name ASC, a.fk_storesvisibility
                    ");

                    //dd($results);

                    //dd($fk_stores);

                    if($export == 'true'){

                        return Excel::download(new ExportFromView('reports.1706-table', [
                          'results'=> $results, 
                        ]), "inventory running balance.xlsx");

                    }//END $export == 'true'
                    
                break;


                //cashier's report
                case '1707':

                    //1= dateFrom, dateTo, 2 = fk_stores, 4 = fk_users, 5 = category, 9 = report type, 10 = apply filter
                    $filters = [1,2,4,9,10];

                    /*$catWhere = "";
                    if ($fk_categories != 'All') {
                        $catWhere = "AND a.fk_categories = '$fk_categories'";
                    }*/

                    $storeWhere = "";
                    if ($fk_stores != 'All') {
                        $storeWhere = "AND b.fk_stores = '$fk_stores'";
                    }

                    $userWhere = "";
                    if ($fk_users != '-1' && $fk_users != '') {
                        $userWhere = "AND b.fk_createdby = '$fk_users'";
                    } else {
                        $userWhere = "AND b.fk_createdby is not null";
                    }

                    /*dd(" SELECT b.pk_salesmstr, b.fk_stores, b.storename, b.docdate, b.docno, b.payername,
                    b.netamount, b.totalpayment, b.changeamount, b.created_at, b.cashiername, b.stat, b.paymentstat
                    FROM vw_salesmstr b
                    WHERE COALESCE(b.iscancel, 0) = 0
                    AND b.docdate BETWEEN '$dateFrom 00:00:00' AND '$dateTo 23:59:59'
                    $userWhere
                    $storeWhere
                    ORDER BY b.created_at DESC");*/

                    if ($reporttype == 'Summary') {
                        
                        /*$results = DB::select("
                            SELECT b.pk_salesmstr, b.fk_stores, b.storename, b.docdate, b.docno, b.payername,
                            b.netamount, b.totalpayment, b.changeamount, b.created_at, b.cashiername, b.stat, b.paymentstat, 
                            a.fk_categories, a.category
                            FROM  vw_salesmstr b 
                            INNER JOIN vw_salesdtl a
                            ON b.pk_salesmstr = a.fk_salesmstr
                            WHERE COALESCE(b.iscancel, 0) = 0
                            AND b.docdate BETWEEN '$dateFrom 00:00:00' AND '$dateTo 23:59:59'
                            $userWhere
                            $catWhere
                            $storeWhere
                            GROUP BY b.pk_salesmstr
                            ORDER BY b.created_at DESC
                        ");*/

                        $results = DB::select("
                            SELECT b.pk_salesmstr, b.fk_stores, b.storename, b.docdate, b.docno, b.payername,
                            b.netamount, b.totalpayment, b.changeamount, b.created_at, b.cashiername, b.stat, b.paymentstat
                            FROM vw_salesmstr b
                            WHERE COALESCE(b.iscancel, 0) = 0
                            AND b.docdate BETWEEN '$dateFrom 00:00:00' AND '$dateTo 23:59:59'
                            $userWhere
                            $storeWhere
                            ORDER BY b.created_at DESC
                        ");


                    } elseif ($reporttype == 'Details') {

                        $results = DB::select("
                            SELECT b.pk_salesmstr, b.fk_stores, b.storename, b.docdate, b.docno, b.payername,
                            b.netamount, b.totalpayment, b.changeamount, b.created_at, b.cashiername, b.stat, b.paymentstat,
                            c.docdate as paydate, c.docno as paydocno, c.amount as payamount, c.remarks as payremarks
                            FROM vw_salesmstr b
                            LEFT JOIN salespayments c ON b.pk_salesmstr = c.fk_salesmstr and COALESCE(c.iscancel, 0) = 0
                            WHERE COALESCE(b.iscancel, 0) = 0
                            AND b.docdate BETWEEN '$dateFrom 00:00:00' AND '$dateTo 23:59:59'
                            $userWhere
                            $storeWhere
                            ORDER BY b.pk_salesmstr ASC, c.docdate
                        ");

                    }
                    
                    // dd($results);

                    if($export == 'true'){

                        return Excel::download(new ExportFromView('reports.1707-table', [
                          'results'=> $results, 
                          'reporttype' => $reporttype
                        ]), "cashiers report.xlsx");

                    }//END $export == 'true'

                    
                break;


                //audit trail history
                case '1708':

                    //2 = Stores, 3 = fk_products, 4 = users, 5 = category, 7 = audittype, 10 = apply filter
                    $filters = [8,2,3,4,5,10];

                    $productWhere = "";
                    if ($fk_products != '-1') {
                        $productWhere = "WHERE a.fk_products = '$fk_products'";
                    } else {
                        $productWhere = "WHERE a.fk_products is not null";
                    }

                    $storeWhere = '';
                    if( $fk_stores != 'All' ){
                        $storeWhere = "AND a.fk_stores='$fk_stores'";
                    }

                    $catWhere = "";
                    if ($fk_categories != 'All') {
                        $catWhere = "AND d.fk_categories = '$fk_categories'";
                    }

                    $userWhere = "";
                    if ($fk_users != '-1' && $fk_users != '') {
                        $userWhere = "AND a.fk_createdby = '$fk_users'";
                    } else {
                        $userWhere = "AND a.fk_createdby is not null";
                    }

                    if( $audittype == 'Qty Adjustment' ){

                        $results = DB::SELECT("SELECT a.*, (a.oldqty+a.qty) as newqty, b.name as createdBy, c.name as store, d.name as productName,
                            e.description as category
                            FROM productsqty a 
                            LEFT JOIN users b 
                            ON a.fk_createdby = b.id 
                            LEFT JOIN stores c 
                            ON a.fk_stores = c.pk_stores
                            LEFT JOIN products d 
                            ON a.fk_products = d.pk_products
                            LEFT JOIN categories e 
                            ON d.fk_categories = e.pk_categories
                            $productWhere
                            $userWhere
                            $storeWhere  
                            $catWhere
                            AND a.qty <> 0
                            ORDER BY a.fk_stores, a.created_at DESC
                            LIMIT 500
                        ");

                    }else if( $audittype == 'Price and Discounts' ){

                        $results = DB::SELECT("SELECT a.*, b.name as createdBy, c.name as store, d.name as productName, 
                            e.description as category
                            FROM products_prices_history a 
                            LEFT JOIN users b 
                            ON a.fk_createdby = b.id 
                            LEFT JOIN stores c 
                            ON a.fk_stores = c.pk_stores
                            LEFT JOIN products d 
                            ON a.fk_products = d.pk_products
                            LEFT JOIN categories e 
                            ON d.fk_categories = e.pk_categories
                            $productWhere
                            $userWhere
                            $storeWhere 
                            $catWhere
                            ORDER BY a.fk_stores, a.created_at DESC
                            LIMIT 500
                        ");


                    }

                    //dd($results);


                    if($export == 'true'){

                        return Excel::download(new ExportFromView('reports.1708-table', [
                          'results'=> $results, 
                        ]), "audit history.xlsx");

                    }//END $export == 'true'

                    
                break;

                
                default:
                   
                break;


            }//END switch

        }//END reports > 0

        //return $results;
        //
        
 

        return view('reports.show', compact('reports', 'id', 'sub_menu', 'fk_stores', 'stores_arr', 'dateFrom', 'dateTo', 'fk_products', 'productdesc', 'fk_users', 'fullname', 'audittype', 'reporttype', 'results', 'filters', 'fk_categories', 'categories_arr', 'categories_desc' ));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}//END class
