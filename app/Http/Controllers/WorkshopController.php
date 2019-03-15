<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Workshop;
use App\Product;
use App\Service; 
use DB; 
use App\WorkshopProduct;
use App\WorkshopService;
use App\Modal;
use App\Brand;
use App\ServiceType;
use App\HeaderLink;
use Mail;
use App\Mail\SendMailToCustomer;
use App\Jobs\SendEMailJob;
use App\Customer;
use App\CustomerDebitLog;
use App\VehicleDetail;
use Auth;
use App\WorkshopProductsEstimated;

class WorkshopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
         $viewData['header_link'] =  HeaderLink::where("menu_id",'3')->select("link_title","link_name")->orderBy('id','desc')->get();
    }
    public function save(Request $request, $id = null)
    {
        $viewData['pageTitle'] = 'Add Workshop'; 
        $viewData['product'] = Product::pluck('product_name', 'id');
        $viewData['service'] = Service::pluck('service_name', 'id');
        $viewData['model_select'] = Modal::pluck('model_name', 'id');
        $viewData['brand_select'] = Brand::pluck('brand_name', 'id');
        $viewData['ServiceType'] = ServiceType::pluck('service_type_name', 'id');
        $viewData['registered_vehicle_select'] = VehicleDetail::pluck('vehicle_reg_number', 'vehicle_reg_number');
        $viewData['customerNameSelect'] = Customer::pluck('customer_name', 'id');
        $viewData['header_link'] =  HeaderLink::where("menu_id",'3')->select("link_title","link_name")->orderBy('id','desc')->get();
        // This if condition for fill detail for update otherwise for save and update 
        if(isset($id) && $id != null ){
            $getFormAutoFillup = Workshop::whereId($id)->first()->toArray();
              $viewData['workshopProductData']= WorkshopProduct::where('workshop_id','=',$id)->get();
              $viewData['workshopServiceData']= WorkshopService::where('workshop_id','=',$id)->get();
            return view('SaiAutoCare.workshop.add', $viewData)->with($getFormAutoFillup);
        }
        else if((!isset($id) && $id == null) && !$request->isMethod('post') )
        {
            return view('SaiAutoCare.workshop.add', $viewData);
        }
        else {
             // This if condition for fill detail for  update otherwise for  save 
            if ($request->isMethod('post')){
                $getFormAutoFillup = array();               
                if(isset($request->id) && $request->id != null) 
                {
                    if ($request->isMethod('post')){
                        $PartyManage=    request()->except(['_token','service_id','product_id','service_quantity','product_quantity','service_type','service_price','product_price','workshop_product_brand','workshop_product_model','workshop_service_brand','workshop_service_model','service_type_id']);
                       
                        if(Workshop::where([['id', '=', $request->id]])->update($PartyManage)){

 
                              $workshopProductData= WorkshopProduct::where('workshop_id','=',$request->id)->get();
                              foreach ($workshopProductData as $key => $value) {
                                    $stock_out=$value['product_quantity'];
                                    $product_id=$value['product_id'];
                                    $stock_available=$value['stock_available'];
                                     
                                    $productDetail=Product::whereId($product_id)->first()->toArray();
                                    $productStockOut=$productDetail['stock_out'];
                                    $productStockAvailable=$productDetail['stock_available'];
                                    $productManame['stock_out']=$productStockOut-$stock_out;
                                    $productManame['stock_available']=$productStockAvailable+ $stock_available;
                                    Product::where([['id', '=',$product_id]])->update($productManame);
                              }

                            WorkshopProduct::where('workshop_id',$request->id)->forceDelete();
                            WorkshopService::where('workshop_id',$request->id)->forceDelete();
                             if(isset($request->product_id) && $request->product_id[0]!=null)
                            {
                                for($i=0; $i < count($request->product_id); $i++){

                                        $WorkshopProduct= new WorkshopProduct();
                                        $WorkshopProduct->workshop_id  = $request->id;
                                        $WorkshopProduct->product_id  = $request->product_id[$i];
                                        $WorkshopProduct->product_quantity  = $request->product_quantity[$i];
                                        $WorkshopProduct->product_price = $request->product_price[$i];
                                        $WorkshopProduct->workshop_product_brand    = $request->workshop_product_brand[$i];
                                        $WorkshopProduct->workshop_product_model    = $request->workshop_product_model[$i];    
                                        $WorkshopProduct->save();

                                    $productDetail=Product::whereId($request->product_id[$i])->first()->toArray();
                                    $productStockOut=$productDetail['stock_out'];
                                     if($productStockOut==null)
                                    {
                                        $productStockOut=0;
                                    }
                                    $productStockAvailable=$productDetail['stock_available'];
                                    $productManame['stock_out']=$productStockOut+$request->product_quantity[$i];
                                    $productManame['stock_available']=$productStockAvailable-$request->product_quantity[$i];
                                    Product::where([['id', '=',$request->product_id[$i]]])->update($productManame);

                               } 
                            }   
                        for($i=0; $i < count($request->service_id); $i++){

                                $WorkshopService= new WorkshopService();
                                $WorkshopService->workshop_id    = $request->id;
                                $WorkshopService->service_id    = $request->service_id[$i];
                                $WorkshopService->service_type_id   = $request->service_type_id[$i];            
                                $WorkshopService->service_quantity    = $request->service_quantity[$i];
                                $WorkshopService->service_price    = $request->service_price[$i];
                                $WorkshopService->workshop_service_brand  = $request->brand;
                                $WorkshopService->workshop_service_model  = $request->model_number;
                                $WorkshopService->save();
                        }
                        if($request->is_complete==1)
                        {
                             // Mail::to($request->email)->send(new SendMailToCustomer($request->id));
                              // Mail::to($request->email)->send($this->viewIndivisual($request->id));
                            //   SendEMailJob::dispatch($request->email,$request->id)
                            // ->delay(now()->addSeconds(5));
                        }
                       
                            $request->session()->flash('message.level', 'success');
                            $request->session()->flash('message.content', ' updated Successfully!');
                        }
                    }
                    $viewData['workshopId'] = $request->id;
                     return redirect('/SaiAutoCare/workshop/add/'.$request->id);
                }
                else
                {
                    

                    $PartyManage =  request()->except(['_token','registered_vehicle','service_id','product_id','status','service_quantity','product_quantity','service_type','service_price','product_price','workshop_product_brand','workshop_product_model','workshop_service_brand','workshop_service_model','service_type_id','product_price_es','workshop_product_brand_es','workshop_product_model_es','workshop_service_brand_es','product_id_es','product_quantity_es']);
                     if(!isset($request->customer_id)) 
                       {
                            $CustomerSave= new Customer();
                            $CustomerSave->customer_name    = $request->name;
                            $CustomerSave->customer_contact_number    = $request->mobile;
                            $CustomerSave->customer_alt_number   = $request->landline;     
                            $CustomerSave->customer_email    = $request->email;
                            $CustomerSave->customer_address=$request->address;
                            $CustomerSave->customer_gstin    = $request->gst_no;
                            $CustomerSave->created_by=Auth::user()->id;
                            $CustomerSave->save();
                            $PartyManage['customer_id']= $CustomerSave->id;
                       }   
                    $PartyManage['status']="pending";
                    $PartyManage = new Workshop($PartyManage);
                    if($PartyManage->save()){

                        // $unit_price_exit=DB::table('purchases')->where('id', $request->product_id)->value('unit_price_exit');
                        // $gstForPurchase=DB::table('purchases')->where('id', $request->product_id)->value('gst');
                        // $price=DB::table('services')->where('id', $request->service_id)->value('price');
                        // $gstForService=DB::table('services')->where('id', $request->service_id)->value('gst');
                         if(isset($request->product_id) && $request->product_id[0]!=null)
                        {
                            for($i=0; $i < count($request->product_id); $i++){

                                    $WorkshopProduct= new WorkshopProduct();
                                    $WorkshopProduct->workshop_id  = $PartyManage->id;
                                    $WorkshopProduct->product_id  = $request->product_id[$i];
                                    $WorkshopProduct->product_quantity  = $request->product_quantity[$i];
                                    $WorkshopProduct->product_price = $request->product_price[$i];
                                    $WorkshopProduct->workshop_product_brand    = $request->workshop_product_brand[$i];
                                    $WorkshopProduct->workshop_product_model    = $request->workshop_product_model[$i];    
                                    $WorkshopProduct->save();

                                $productDetail=Product::whereId($request->product_id[$i])->first()->toArray();
                                $productStockOut=$productDetail['stock_out'];
                                if($productStockOut==null)
                                {
                                    $productStockOut=0;
                                }
                                $productStockAvailable=$productDetail['stock_available'];
                                $productManame['stock_out']=$productStockOut+$request->product_quantity[$i];
                                $productManame['stock_available']=$productStockAvailable-$request->product_quantity[$i];
                                Product::where([['id', '=',$request->product_id[$i]]])->update($productManame);

                           } 
                       }
                        if(isset($request->product_id_es[0]) && $request->product_id_es[0]!='')
                        {
                          for($i=0; $i < count($request->product_id_es); $i++){

                                    $WorkshopProduct_es= new WorkshopProductsEstimated();
                                    $WorkshopProduct_es->workshop_id_es  = $PartyManage->id;
                                    $WorkshopProduct_es->product_id_es  = $request->product_id_es[$i];
                                    $WorkshopProduct_es->product_quantity_es  = $request->product_quantity_es[$i];
                                    $WorkshopProduct_es->product_price_es = $request->product_price_es[$i];
                                    $WorkshopProduct_es->workshop_product_brand_es    = $request->workshop_product_brand_es[$i];
                                    $WorkshopProduct_es->workshop_product_model_es    = $request->workshop_product_model_es[$i];    
                                    $WorkshopProduct_es->save();

                            }   
                        }
                       

                        for($i=0; $i < count($request->service_id); $i++){

                                $WorkshopService= new WorkshopService();
                                $WorkshopService->workshop_id    = $PartyManage->id;
                                $WorkshopService->service_id    = $request->service_id[$i];
                                $WorkshopService->service_type_id   = $request->service_type_id[$i];            
                                $WorkshopService->service_quantity    = $request->service_quantity[$i];
                                $WorkshopService->service_price    = $request->service_price[$i];
                                $WorkshopService->workshop_service_brand  =  $request->brand;
                                $WorkshopService->workshop_service_model  =  $request->model_number;
                                $WorkshopService->save();
                        }
                       
                       if(!isset($request->registered_vehicle)) 
                       {
                            $VehicleDetail= new VehicleDetail();
                            if(isset($CustomerSave->id))
                            {
                                 $VehicleDetail->customer_id    = $CustomerSave->id;
                            }
                            else
                            {
                                 $VehicleDetail->customer_id    = $request->customer_id;
                            }
                           
                            $VehicleDetail->workshop_id    = $PartyManage->id;
                            $VehicleDetail->vehicle_reg_number   = $request->vehicle_reg_number;     
                            $VehicleDetail->model_year    = $request->model_year;
                            $VehicleDetail->brand    =$request->brand;
                            $VehicleDetail->vin    = $request->vin;
                            $VehicleDetail->fuel_type    = $request->fuel_type;
                            $VehicleDetail->engine_number   =$request->engine_number;            
                            $VehicleDetail->company_name    = $request->company_name;
                            $VehicleDetail->reg_number    = $request->reg_number;
                            $VehicleDetail->odometer_reading    = $request->odometer_reading;
                            $VehicleDetail->color    = $request->color;
                            $VehicleDetail->due_in    = $request->due_in;
                            $VehicleDetail->due_out    = $request->due_out;
                            $VehicleDetail->key_number    = $request->key_number;
                            
                            $VehicleDetail->model_number    = $request->model_number;
                            $VehicleDetail->advisor    = $request->advisor;
                            $VehicleDetail->notes    = $request->notes;
                            $VehicleDetail->save();
                       }  
                      

                        $CustomerDebitLog= new CustomerDebitLog();
                        $CustomerDebitLog->workshop_id    = $PartyManage->id;
                       
                         if(isset($CustomerSave->id))
                        {
                             $CustomerDebitLog->customer_id    = $CustomerSave->id;
                        }
                        else
                        {
                             $CustomerDebitLog->customer_id    = $request->customer_id;
                        }
                        $CustomerDebitLog->credit   = $request->paid_price;            
                        $CustomerDebitLog->comments    = $request->notes;
                        $CustomerDebitLog->is_debit    = 0;
                        $CustomerDebitLog->save();
                        // SendEMailJob::dispatch($request->email,$PartyManage->id)
                            // ->delay(now()->addSeconds(5));
                         // Mail::to($request->email)->send(new SendMailToCustomer($PartyManage->id));
                        
                        $request->session()->flash('message.level', 'success');
                        $request->session()->flash('message.content', ' Saved Successfully!');
                    }
                    $viewData['registered_vehicle_select'] = VehicleDetail::pluck('vehicle_reg_number', 'vehicle_reg_number');
                     $viewData['workshopId'] = $PartyManage->id;
                    return view('SaiAutoCare.workshop.add', $viewData);
                }
            }
        }
    }

   // this is for search 
    public function view(Request $request)
    {
           $viewData['header_link'] =  HeaderLink::where("menu_id",'3')->select("link_title","link_name")->orderBy('id','desc')->get();
        $viewData['model_select'] = Modal::pluck('model_name', 'id');
        $viewData['brand_select'] = Brand::pluck('brand_name', 'id');
         $viewData['customerNameSelect'] = Customer::pluck('customer_name', 'id');
        if($request->isMethod('post')) 
        {
            $viewData['pageTitle'] = 'Add Party';           
            $workshop= DB::table('workshops');
            $workshop->leftJoin('modals','modals.id','=','workshops.model_number');
            $workshop->leftJoin('brands','brands.id','=','workshops.brand');
            $getFormAutoFillup=$request->all();
            $workshop->where('workshops.deleted_at','=',null);
            if($request->has('id') && $request->id !=''){
                $workshop->where('workshops.id', '=', $request->id);
            }
            if($request->has('customer_id') && $request->customer_id !=''){
                $workshop->where('workshops.customer_id', '=', $request->customer_id);
            }
            if($request->has('created_at_from') && $request->created_at_from !=''){
                $workshop->whereDate('workshops.created_at', '<=', $request->created_at_from);
            }
            if($request->has('created_at_to') && $request->created_at_to !=''){
                $workshop->whereDate('workshops.created_at', '>=', $request->created_at_to);
            }
            if($request->has('mobile') && $request->mobile !=''){
                $workshop->where('workshops.mobile', '=', $request->mobile);
            }
            if($request->has('email') && $request->email !=''){
                $workshop->where('workshops.email', '=', $request->email);
            }
            if($request->has('vehicle_reg_number_for_search') && $request->vehicle_reg_number_for_search !=''){
                $workshop->where('workshops.vehicle_reg_number', 'like', '%'.$request->vehicle_reg_number_for_search.'%');
            }
             if($request->has('brand') && $request->brand !=''){
                $workshop->where('workshops.brand', '=', $request->brand);
            }
             if($request->has('model_number') && $request->model_number !=''){
                 $workshop->where('workshops.model_number', '=', $request->model_number);
            }
            $workshop->select('workshops.*','brands.brand_name as company_name_from_brand','modals.model_name as modelNumber');
            $workshop->orderBy('id','desc');
            $workshop= $workshop->get();
            $viewData['workshop']=json_decode(json_encode($workshop), true);
            return view('SaiAutoCare.workshop.search', $viewData)->with($getFormAutoFillup);

        }else
        {
            $viewData['pageTitle'] = 'Workshop Details';           
            $workshop= DB::table('workshops');
            $workshop->leftJoin('modals','modals.id','=','workshops.model_number');
            $workshop->leftJoin('brands','brands.id','=','workshops.brand');
            $workshop->where('workshops.deleted_at','=',null);
            $workshop->select('workshops.*','brands.brand_name as company_name_from_brand','modals.model_name as modelNumber');
            $workshop->orderBy('workshops.id','desc');
            $workshop= $workshop->get();
            $viewData['workshop']=json_decode(json_encode($workshop), true);
        //  $workshop= DB::table('workshops');
            //$workshop->orderBy('id','desc');
            //$workshop= $workshop->get();
            //$viewData['workshop']=json_decode(json_encode($workshop), true);
            return view('SaiAutoCare.workshop.search', $viewData);
        }
      
    }
    public function trash(Request $request,$id)
    {
           $viewData['header_link'] =  HeaderLink::where("menu_id",'3')->select("link_title","link_name")->orderBy('id','desc')->get();
            $viewData['model_select'] = Modal::pluck('model_name', 'id');
        $viewData['brand_select'] = Brand::pluck('brand_name', 'id');
        if(($id!=null) && (Workshop::where('id',$id)->delete())){
            $request->session()->flash('message.level', 'warning');
            $request->session()->flash('message.content', 'Workshop was Trashed!');
            $viewData['pageTitle'] = 'Workshop';        
            $viewData['workshop'] = Workshop::paginate(10);
            return view('SaiAutoCare.workshop.search', $viewData);
        }else{
            session()->flash('status', ['danger', 'Operation was Failed!']);
            $viewData['pageTitle'] = 'Workshop';        
            $viewData['workshop'] = Workshop::paginate(10);
            return view('SaiAutoCare.workshop.search', $viewData);
       }
    
    }
    public function trashedList()
    {
           $viewData['header_link'] =  HeaderLink::where("menu_id",'3')->select("link_title","link_name")->orderBy('id','desc')->get();

         $TrashedParty = Workshop::orderBy('deleted_at', 'desc')->onlyTrashed()->simplePaginate(10);
         return view('SaiAutoCare.workshop.delete', compact('TrashedParty', 'TrashedParty'));
      
    }
    public function permanemetDelete(Request $request,$id)
    {
           $viewData['header_link'] =  HeaderLink::where("menu_id",'3')->select("link_title","link_name")->orderBy('id','desc')->get();
        if(($id!=null) && (Workshop::where('id',$id)->forceDelete())){
            $request->session()->flash('message.level', 'warning');
            $request->session()->flash('message.content', "Workshop was deleted Permanently and Can't rollback in Future!"); 
        }else{
            session()->flash('status', ['danger', 'Operation was Failed!']);
       }

         $TrashedParty = Workshop::orderBy('deleted_at', 'desc')->onlyTrashed()->simplePaginate(10);
         return view('SaiAutoCare.workshop.delete', compact('TrashedParty', 'TrashedParty'));
    }
    public function viewIndivisual($id)
    {
        $viewData['header_link'] =  HeaderLink::where("menu_id",'3')->select("link_title","link_name")->orderBy('id','desc')->get();
        $getIndivisualWorkshopDetail = Workshop::whereId($id)->first()->toArray();
  
        if($getIndivisualWorkshopDetail['is_workshop'] == 1)
        {
             $brandName=Brand::whereId($getIndivisualWorkshopDetail['brand'])->first()->toArray();
            $model_number=Modal::whereId($getIndivisualWorkshopDetail['model_number'])->first()->toArray();
            
            $viewData['brandName']=$brandName['brand_name'];
            $viewData['model_numberName']=$model_number['model_name'];
        }
       

        $workshop_products_estimateds = DB::table('workshop_products_estimateds')
        ->join('products','products.id','=','workshop_products_estimateds.product_id_es')
        ->select('products.product_name','workshop_products_estimateds.product_quantity_es','workshop_products_estimateds.product_price_es as ProductWorkshopPrice','products.hsn as ProductHsn','products.unit_price_exit as UnitExitPrice','products.gst as ProductGst')
        ->where('workshop_id_es',$getIndivisualWorkshopDetail['id'])->get();


        $WorkshopProduct = DB::table('workshop_products')
        ->join('products','products.id','=','workshop_products.product_id')
        ->select('products.product_name','workshop_products.product_quantity','workshop_products.product_price as ProductWorkshopPrice','products.hsn as ProductHsn','products.unit_price_exit as UnitExitPrice','products.gst as ProductGst')
        ->where('workshop_id',$getIndivisualWorkshopDetail['id'])->get();
        $WorkshopService = DB::table('workshop_services')
        ->join('services','services.id','=','workshop_services.service_id')
        ->where('workshop_id',$getIndivisualWorkshopDetail['id'])->get();
        $viewData['WorkshopProduct']=$WorkshopProduct;
        $viewData['WorkshopService']=$WorkshopService;
        $viewData['workshop_products_estimateds']=$workshop_products_estimateds;
        $viewData['workshopId']="";
        return view('SaiAutoCare.workshop.view',$viewData)->with($getIndivisualWorkshopDetail);
    }
    public function viewByWorkshop($id)
    {
           $viewData['header_link'] =  HeaderLink::where("menu_id",'3')->select("link_title","link_name")->orderBy('id','desc')->get();
        $getIndivisualWorkshopDetail = Workshop::whereId($id)->first()->toArray();
        $WorkshopProduct = DB::table('workshop_products')
        ->join('products','products.id','=','workshop_products.product_id')
        ->where('workshop_id',$getIndivisualWorkshopDetail['id'])->get();

        $WorkshopService = DB::table('workshop_services')
        ->join('services','services.id','=','workshop_services.service_id')
        ->where('workshop_id',$getIndivisualWorkshopDetail['id'])->get();
        $viewData['WorkshopProduct']=$WorkshopProduct;
        $viewData['WorkshopService']=$WorkshopService;
        $viewData['workshopId']="";
        return view('SaiAutoCare.workshop.view',$viewData)->with($getIndivisualWorkshopDetail);
    }

} 
