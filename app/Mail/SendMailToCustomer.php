<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use DB;
use App\Workshop;
use App\Product;
use App\Service;
use App\WorkshopProduct;
use App\WorkshopService;
use App\Modal;
use App\Brand;
use App\ServiceType;

class SendMailToCustomer extends Mailable
{
    use Queueable, SerializesModels;

    /** 
     * Create a new message instance.
     *
     * @return void
     */
    public $id;
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // echo $this->content;
        $getIndivisualWorkshopDetail = Workshop::whereId($this->id)->first()->toArray();
        $WorkshopProduct = DB::table('workshop_products')
        ->join('products','products.id','=','workshop_products.product_id')
        ->where('workshop_id',$getIndivisualWorkshopDetail['id'])->get();

        $WorkshopService = DB::table('workshop_services')
        ->join('services','services.id','=','workshop_services.service_id')
        ->where('workshop_id',$getIndivisualWorkshopDetail['id'])->get();
        $viewData['WorkshopProduct']=$WorkshopProduct;
        $viewData['WorkshopService']=$WorkshopService;
        return $this->view('SaiAutoCare.workshop.view',$viewData)->with($getIndivisualWorkshopDetail);

       // return app('App\Http\Controllers\WorkshopController')->viewByWorkshop( $this->content);
        // return $this->view('emails.exception')
        //             ->with('content', $this->content);
       // return $this->view('view.name');
    }
}
