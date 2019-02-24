<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Purchase;
Use App\Service;
use DB;
use App\Brand;
use App\Modal;
use App\ServiceName;
use App\SupplierDebitLog;
use App\Customer;
use App\CustomerDebitLog;
use App\VehicleDetail;
use App\PurchaseReturn;
use Auth;
use App\Workshop;
use App\WorkshopProduct;
use App\ReturnSpareLog;

class AjaxController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    public function getProduct(Request $request)
    {
    	$productId=$request->productId;
    	return Product::whereId($productId)->first()->toArray();
    }
     public function getProductForworkshop(Request $request)
    {
        $product_id=$request->product_id;
        // DB::enableQueryLog();
        $purchase= Product::where('id',$product_id)->where('stock_in','>',0)
        ->orderBy('id','DESC')
                ->skip(0)
                ->take(1)
                 ->get();
                 // $laQuery = DB::getQueryLog();
                 // DB::disableQueryLog();
              $purchase=   json_decode(json_encode($purchase), true);
              return $purchase;
    }
    
     public function getCustomerForWorkshop(Request $request)
    {
        $customer_id=$request->customer_id;
        DB::enableQueryLog();
        $purchase= Customer::where('id',$customer_id)
        ->orderBy('id','DESC')
                ->skip(0)
                ->take(1)
                 ->get();
                 $laQuery = DB::getQueryLog();
                 DB::disableQueryLog();
              $purchase=   json_decode(json_encode($purchase), true);
              return $purchase;
    }
    public function getPurchase(Request $request)
    {
    	$product_id=$request->product_id;
        DB::enableQueryLog();
    	$purchase= Purchase::where('product_id',$product_id)
        ->orderBy('id','DESC')
                ->skip(0)
                ->take(1)
                 ->get();
                 $laQuery = DB::getQueryLog();
               //  print_r($laQuery);
                 DB::disableQueryLog();
              $purchase=   json_decode(json_encode($purchase), true);
              return $purchase;
        // ->first()->toArray();
    }
     public function getService(Request $request)
    {
    	$service_id=$request->service_id;
    	$serviceDetail = Service::whereId($service_id)
        ->orderBy('id','DESC')
                ->skip(0)
                ->take(1)
                 ->get();
                   $serviceDetail=   json_decode(json_encode($serviceDetail), true);
        return $serviceDetail;
    }
    public function getModal(Request $request)
    {
        $brandId=$request->brand;
        $allModalList= Modal::where('brand_id',$brandId)->get();
         return json_encode($allModalList);
    }
    public function getServiceThroughServiceId(Request $request)
    {
        $service_type_id=$request->service_type_id;
        $allServiceList= ServiceName::where('service_type_id',$service_type_id)->get();
         return json_encode($allServiceList);
    }
    public function getServiceTypeForWorkshop(Request $request)
    {
         $service_type=$request->service_type;
         $brand=$request->brand;
         $model=$request->model;
         $SericeName=DB::table('services')
         ->where('service_type','=',$service_type)
         ->where('brand_name','=',$brand)
         ->where('model_name','=',$model)
         ->select('services.*')->get();
         return json_encode($SericeName);   
    }
    public function getServiceTypeForWorkshopThroughModel(Request $request)
    {
         $model_number=$request->model_number;
         $brand=$request->brand;
         $SericeTypeName=DB::table('services')->join("service_types","service_types.id","=","services.service_type")
         ->where('brand_name','=',$brand)
         ->where('model_name','=',$model_number)
         ->select('service_types.id','service_types.service_type_name')
         ->distinct()
         ->get();
         return json_encode($SericeTypeName);
    }
    public function getProductThroughModelAndBrand(Request $request)
    {
        $model_number=$request->model_number;
        $brand=$request->brand;
        $Product=DB::table('products')
         ->where('company_name','=',$brand)
         ->where('model_number','=',$model_number)
         ->distinct()
         ->get();
         return json_encode($Product);
        
    }
    public function submitSupplierDetail(Request $request)
    {
            $supplierId=$request->supplierId;
            $creditDebit=$request->creditDebit;
            $amount=$request->amount;
            $payment_type=$request->payment_type;
            $comments=$request->comments;
// if($creditDebit==)
//            echo "hii";
//            exit;
            $saveSupplierDebitLog = new SupplierDebitLog;
            $saveSupplierDebitLog->purchase_invoice_id = 0;
            $saveSupplierDebitLog->supplier_id =$supplierId;
            $saveSupplierDebitLog->purchase_id =0;
            $saveSupplierDebitLog->created_at =$request->payment_date;
            $saveSupplierDebitLog->is_debit =$creditDebit;
             if($request->creditDebit==0)
            {
                 $saveSupplierDebitLog->credit = $amount;
            }
            else
            {
                $saveSupplierDebitLog->debit_amount = $amount; 
            }
            // $saveSupplierDebitLog->credit = $amount;
            $saveSupplierDebitLog->comments =$comments;
            $saveSupplierDebitLog->payment_type = $payment_type;
           if($saveSupplierDebitLog->save())
           {
            return 1;
           }
           else
           {
            return 0;
           }

    }
     public function submitCustomerPaymentDetail(Request $request)
    {
            $customerId=$request->customerId;
            $creditDebit=$request->creditDebit;
            $amount=$request->amount;
            $payment_type=$request->payment_type;
            $comments=$request->comments;
// if($creditDebit==)
//            echo "hii";
//            exit;
            $saveSupplierDebitLog = new CustomerDebitLog;
            $saveSupplierDebitLog->customer_id =$customerId;
            $saveSupplierDebitLog->workshop_id =0;
            $saveSupplierDebitLog->created_at =$request->payment_date;
            if($request->creditDebit==0)
            {
                 $saveSupplierDebitLog->credit = $amount;
            }
            else
            {
                $saveSupplierDebitLog->debit_amount = $amount; 
            }
            $saveSupplierDebitLog->is_debit =$creditDebit;
           
            $saveSupplierDebitLog->comments =$comments;
            $saveSupplierDebitLog->payment_type = $payment_type;
           if($saveSupplierDebitLog->save())
           {
           //  Mail::to($request->email)->send(new SendMailToCustomer($PartyManage->id));
            return 1;
           }
           else
           {
            return 0;
           }

    }
    public function GetVehicleDetailFromWorkshop(Request $request)
    {
        $registered_vehicle=$request->registered_vehicle;
      return  VehicleDetail::where('vehicle_reg_number','=',$registered_vehicle)->get();
    }
    public function GetVehicleRegFromWorkshop(Request $request)
    {
        $VehicleReg=DB::table('vehicle_details')->where('customer_id',$request->customer_id)
         ->get();
         return json_encode($VehicleReg);
        

    }
    public function submitPurchaseReturn(Request $request)
    {
         $purchaseDetail=Purchase::whereId($request->PurchaseId)->first()->toArray();
            $unit_price=$purchaseDetail['unit_price'];
            $quantity=$purchaseDetail['quantity'];
            $total_amount=$purchaseDetail['total_amount'];
            $gst=$purchaseDetail['gst'];
            $product_id=$purchaseDetail['product_id'];
                if($quantity>$request->quantity)
                {
                    $purchaseManame['quantity']=$quantity-$request->quantity;
                    $purchaseManame['total_amount']=$total_amount-($total_amount/$quantity)*$request->quantity;
                    $purchaseManame['is_returned']=1;
                    Purchase::where([['id', '=',$request->PurchaseId]])->update($purchaseManame);

                    $getProductDetail=Product::whereId($product_id)->first()->toArray();
                    $stock_in= $getProductDetail['stock_in'];
                    $stock_available  = $getProductDetail['stock_available'];

                    $productManage['stock_in']=$stock_in-$request->quantity;
                    $productManage['stock_available']=$stock_available-$request->quantity;
                    Product::where([['id', '=',$product_id]])->update($productManage);

                   $PurchaseReturn = new PurchaseReturn();
                   $PurchaseReturn->user_id =Auth::user()->id;
                   $PurchaseReturn->comments =$request->comments;
                   $PurchaseReturn->purchase_id =$request->PurchaseId;
                   $PurchaseReturn->quantity =$request->quantity;
                   if($PurchaseReturn->save())
                   {
                    return 1;
                   }
                   else
                   {
                    return 0;
                   }
                }
                else
                {
                    return 0;  
                }

                                     
    }
    public function getWorkshopReport(Request $request)
    {
         $workshopId=$request->workshopId;
         $WorkshopProduct = DB::table('workshop_products')
        ->join('products','products.id','=','workshop_products.product_id')
        ->select('workshop_products.id as WorkshopProId','workshop_products.workshop_id','products.product_name','workshop_products.product_quantity','workshop_products.product_price as ProductWorkshopPrice','products.hsn as ProductHsn','products.unit_price_exit as UnitExitPrice','products.gst as ProductGst')
        ->where('workshop_id',$workshopId)->get();
         return json_encode($WorkshopProduct); 
    }
     public function submitSaleReturn(Request $request)
    {
          $WorkshopDetail=WorkshopProduct::where('id','=',$request->saleId)->first()->toArray();
            $workshop_id=$WorkshopDetail['workshop_id'];
            $product_quantity=$WorkshopDetail['product_quantity'];
            // $product_price=$WorkshopDetail['product_price'];
            $product_id=$WorkshopDetail['product_id'];
                if($product_quantity>$request->quantity)
                {
                    $purchaseManame['product_quantity']=$product_quantity-$request->quantity;
                    // $purchaseManame['total_amount']=$total_amount-($total_amount/$quantity)*$request->quantity;
                    $purchaseManame['is_returned']=1;
                    WorkshopProduct::where([['id', '=',$request->saleId]])->update($purchaseManame);

                    $getProductDetail=Product::whereId($product_id)->first()->toArray();
                    $stock_out= $getProductDetail['stock_out'];
                    $stock_available  = $getProductDetail['stock_available']; 
                    $productManage['stock_out']=$stock_out-$request->quantity;
                    $productManage['stock_available']=$stock_available-$request->quantity;
                    Product::where([['id', '=',$product_id]])->update($productManage);
                   $SaledDetail = new ReturnSpareLog();
                   $SaledDetail->user_id =Auth::user()->id;
                   $SaledDetail->comments =$request->comments;
                   $SaledDetail->job_id =$workshop_id;
                   $SaledDetail->job_id =$workshop_id;
                   $SaledDetail->quantity =$request->quantity;
                   if($SaledDetail->save())
                   {
                    return 1;
                   }
                   else
                   {
                    return 0;
                   }
                }
                else
                {
                    return 0;  
                }                          
        
    }
    public function paymentForWorkshop(Request $request)
    {
        $creditDebitForWorkshop=$request->creditDebitForWorkshop;
        $workshopIdForPayment=$request->workshopIdForPayment;
        $amountForWorkshop=$request->amountForWorkshop;
        $payment_dateForWorkhop=$request->payment_dateForWorkhop;
        $payment_typeForWorkshop=$request->payment_typeForWorkshop;
        $commentsForWorkshop=$request->commentsForWorkshop;
       // $workshopDetail =DB::table('workshops')->join('customer','workshops.customer_id','=','customer.id')->get();

        $workshopDetail = DB::table('workshops');
        $workshopDetail=  $workshopDetail->leftJoin('customers','workshops.customer_id','=','customers.id')->where('workshops.id','=',$workshopIdForPayment)->select('customers.id','installmentPayment','grandTotal','balance_price')->get();
       // echo   "else if (".$workshopDetail[0]->balance_price.$workshopDetail[0]->installmentPayment.") {";
        if($workshopDetail[0]->grandTotal<$workshopDetail[0]->installmentPayment)
        {
            return "Payment Amount Can not be greater than GrandTotal";
        }
        else if ($workshopDetail[0]->balance_price<$workshopDetail[0]->installmentPayment) {
            return "Payment Amount Can not be greater than Balance";
        }
        else
        {
            Workshop::where('id', $workshopIdForPayment)
              ->update(['installmentPayment' => $amountForWorkshop+$workshopDetail[0]->installmentPayment ]);
                $saveSupplierDebitLog = new CustomerDebitLog;
                $saveSupplierDebitLog->customer_id =$workshopDetail[0]->id;
                $saveSupplierDebitLog->workshop_id =$workshopIdForPayment;
                $saveSupplierDebitLog->created_at =$request->payment_dateForWorkhop;
                if($request->creditDebitForWorkshop==0)
                {
                     $saveSupplierDebitLog->credit = $amountForWorkshop;
                }
                else
                {
                    $saveSupplierDebitLog->debit_amount = $amountForWorkshop; 
                }
                $saveSupplierDebitLog->is_debit =$creditDebitForWorkshop;           
                $saveSupplierDebitLog->comments =$commentsForWorkshop;
                $saveSupplierDebitLog->payment_type = $payment_typeForWorkshop;
               if($saveSupplierDebitLog->save())
               {

               //  Mail::to($request->email)->send(new SendMailToCustomer($PartyManage->id));
                return 1;
               }
               else
               {
                return 0;
               }
         }      
    }
    public function  updateWorkshopBalance(Request $request)
    {
         if(Workshop::where('id', $request->workshop_id)->update(['balance_price' => $request->balance,'grandTotal' => $request->grandTotal]))
         {
            return 1;
         } 
         else
         {
            return 0;
         }

    }
    public function  discountForWorkshop(Request $request)
    {
         if(Workshop::where('id', $request->workshopIdForDiscount)->update(['discount_price' => $request->amountForWorkshopDiscount]))
         {
            return 1;
         } 
         else
         {
            return 0;
         }

    }
    
}
