{{-- /*
 *  File Name              :
 *  Type                   :   
 *  Description            :   
 *  Author                 : Ashtosh Kumar Choubey
 *  Contact                : 9658476170
 *  Email                  : ashutoshphoenixsoft@gmail.com
 *  Date                   : 12/12/2018  
 *  Modified By            :       
 *  Date of Modification   :     
 *  Purpose of Modification: 
 * 
 */ --}}
@extends('samples') 
@section('content')

<section class="content" style="margin-left: 20px;margin-right: 20px;">
  <div class="row">
      <div class="col-sm-12" >
         {{ Form::open(['url' => 'SaiAutoCare/workshop/search','files' => 'true' ,'enctype' => 'multipart/form-data', 'autocomplete' => 'OFF']) }} 
        <div class="card">
          <div class="card-body">
          <div class="table-responsive">
          <table class="table table-sm">
            <tr>
              <td>Job/Workshop Id</td>
              <td>:</td>
              <td><!-- <input type="text" class="form-control-sm" name="id"> -->
                  {{Form::text('id', isset($id)?$id: '', ['class' => 'form-control-sm form-control-sm ','id'=>'id', 'placeholder' => '  Job Id']  )}}
              </td>
              <td>&emsp;&emsp;</td>
              <td>Customer Name</td>
              <td>:</td>
              <td><!-- <input type="text" class="form-control-sm" name="name"></td> -->
                {{Form::text('name', isset($name)?$name: '', ['class' => 'form-control-sm form-control-sm ','id'=>'name', 'placeholder' => '  Job Name']  )}}
              <td></td>
            </tr>
            <tr>
              <td>From Date</td>
              <td>:</td>
              <td><input type="date" class="form-control-sm" name="created_at_to"></td>
              <td>&emsp;&emsp;</td>
              <td>To Date</td>
              <td>:</td>
             
              <td><input type="date" class="form-control-sm" name="created_at_from"></td>
              <td></td>
            </tr>
            <tr>
              <td>Mobile Number</td>
              <td>:</td>
              <td><input type="text" class="form-control-sm" name="mobile"></td>
              <td>&emsp;&emsp;</td>
              <td>Email</td>
              <td>:</td>
              <td><input type="text"  class="form-control-sm" name="email"></td>
              <td></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td colspan="2">Vehicle Registration Number</td>
              <td>:</td>
              <td><input type="text" class="form-control-sm" name="vehicle_reg_number_for_search"></td>
              <td>&emsp;&emsp;</td>
            </tr>
            <tr>
              <td colspan="8" class="text-center"><input type="submit" name="search" class="btn btn-primary" value="Search"></td>
            </tr>
          </table>
          </div>
           {{Form::close()}}
        </div>
      </div>
       </div> 
  </div>
   <div class="row">
      <!-- left column -->
      <div class="col-md-12 col-sm-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <!-- /.box-header -->
          <!-- form start -->
          <div class="box-body">
            @if ($errors->any())
            <ul class="alert alert-danger" style="list-style:none">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
            </ul>
            @endif
            @if(session()->has('message.level'))
            <div class="alert alert-{{ session('message.level') }} alert-dismissible" onload="javascript: Notify('You`ve got mail.', 'top-right', '5000', 'info', 'fa-envelope', true); return false;">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4><i class="icon fa fa-check"></i> {{ ucfirst(session('message.level')) }}!</h4>
              {!! session('message.content') !!}
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>

  <div class="row" >
    <div class="col-sm-12" id="HideForShowProduct">
        <div class="card">
          <div class="card-header">
            <i class="fa fa-align-justify"></i> Workshop Detail
          </div>
          <div class="card-body table-responsive" style="font-size: 13px;padding-left:10px;vertical-align:middle;">
            <table id="datable_1" class="table  table-hover  " style="font-size: 13px;display:table-cell;" >
              <thead class="thead-dark">
                <tr>
                  <th  style="white-space: nowrap">Job Id</th>
                  <th style="white-space: nowrap"style="white-space: nowrap" >Customer Name</th>
                  <th  style="white-space: nowrap">Mobile</th>
                  <th style="white-space: nowrap" >Email</th>
                  <!-- <th style="white-space: nowrap" >Address</th> -->
                  <th style="white-space: nowrap">Vehicle Reg. Number</th>
                  <!-- <th width="30%">Model Year</th> -->
                  <th style="white-space: nowrap">Company Name</th>
                  <th style="white-space: nowrap">Model Name</th>
                  <!-- <th width="30%">VIN</th>
                  <th width="30%">Reg Number</th>
                  <th width="30%">Odometer Reading</th>
                  <th width="30%">Color</th>
                  <th width="30%">Fuel Type</th>
                  <th width="30%">Engine Number</th>
                  <th width="30%">Key Number</th> -->
                  <th style="white-space: nowrap">Due In</th>
                  <th style="white-space: nowrap">due Out</th>
                  <th style="white-space: nowrap">Status</th>
                  <!-- <th width="30%">Advisor</th> -->
                  <th style="white-space: nowrap">Notes</th>
                  <th style="white-space: nowrap">Created Date</th>
                  <!-- <th width="30%">Updated Date</th> -->
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach($workshop as $key => $value)
                <tr>
                  <td>{{ $value['id'] }}</td>
                  <td>{{ $value['name'] }}</td>
                 <!--  <td>{{ $value['reference'] }}</td>
                  <td>{{ $value['company'] }}</td>
                  <td>{{ $value['gst_no'] }}</td> -->
                  <td>{{ $value['mobile'] }}</td>
                  <td>{{ $value['email'] }}</td>
                 <!--  <td>{{ $value['address'].",
                  ".$value['city'].",
                  ".$value['state'].",
                  ".$value['pin'] }}</td> -->
                  <td>{{ $value['vehicle_reg_number'] }}</td>
                  <!-- <td>{{ $value['model_year'] }}</td> -->
                  <td>{{ $value['company_name'] }}</td>
                  <td>{{ $value['model_number'] }}</td>
                 <!--  <td>{{ $value['vin'] }}</td>
                  <td>{{ $value['reg_number'] }}</td>
                  <td>{{ $value['odometer_reading'] }}</td>
                  <td>{{ $value['color'] }}</td>
                  <td>{{ $value['fuel_type'] }}</td>
                  <td>{{ $value['engine_number'] }}</td>
                  <td>{{ $value['key_number'] }}</td> -->
                  <td>{{ $value['due_in'] }}</td>
                  <td>{{ $value['due_out'] }}</td>
                  <td>{{ $value['status'] }}</td>
                  <!-- <td>{{ $value['advisor'] }}</td> -->
                  <td>{{ $value['notes'] }}</td>
                  <td>{{ $value['created_at'] }}</td>
                  <!-- <td>{{ $value['updated_at'] }}</td>/SaiAutoCare/sale/edit/{id} -->
                  <td style="white-space: nowrap">
                     

                    <a target="blank" href="{{ url('/')}}/SaiAutoCare/workshop/view/{{ $value['id'] }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                    @if($value['is_workshop']==1)
                   <a href="{{ url('/')}}/SaiAutoCare/workshop/add/{{ $value['id'] }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a> 
                   @else
                   <a data-toggle="modal" id="{{ $value['id'] }}" data-target="#myModal1"  class="btn btn-success openPayentModel btn-sm"><i class="fa fa-undo" aria-hidden="true"></i></a> 
                     <a href="{{ url('/')}}/SaiAutoCare/sale/edit/{{ $value['id'] }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a> 

                     @endif
                      <a href="{{ url('/')}}/SaiAutoCare/workshop/trash/{{ $value['id']}} " class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?');"><i class="fa fa-remove"></i></a>
                  </td>
                </tr>  
                @endforeach 
              </tbody>
            </table>
            <div class="col-lg-12 text-center">
              
            </div>
            <!-- <li><a href="#" id="json"> <i class="fa fa-print"></i> JSON</a></li>
                                <li><a href="#" onclick="$('#table').tableExport({type:'json',escape:'false'});"><img src="images/json.jpg" width="24px">JSON (ignoreColumn)</a></li> -->
           <!--  <p class="lead"><button id="json" class="btn btn-primary">TO JSON</button> <button id="csv" class="btn btn-info">TO CSV</button>  <button id="pdf" class="btn btn-danger">TO PDF</button></p> -->
          </div>
        </div>
    </div>
    <div class="col-sm-12" id="HideForShowProduct2" style="display: none">
      <div class="card">
        <div class="card-header"></div>
        <div class="card-body">
               <table class="table">
                <thead>
                    <tr>
                      <th>Id</th>
                      <th>Workshop Id</th>
                      <th>Spare Name</th>
                      <th>Product Quantity</th>
                      <th>Product Price</th>
                      <th>Action</th>
                    </tr> 
                  </thead>
                  <tbody id="productDetail">
                   
                  </tbody>
                  <tfoot>
                    <tr><td colspan="5"><input type="button" id="closeProdultDetail" class="btn btn-primary" value="close"></td></tr>
                  </tfoot>
              </table>
          
        </div>
        <div class="card-footer"></div>
      </div>
    </div>
    
  </div>
  <div class="row">
    
    
  </div>
                  
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
           <h4 class="modal-title text-primary">Sales Return</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
         
        </div>
        <div class="modal-body">
          {{-- <form  id="formId" action="{{  url('/') }}/ajax/submitSupplierDetail" method="POST"> --}}
             {{ csrf_field() }}
          <table class="table">
            <thead>
              <tr>
                <th>Quantity</th>
                <th>Discription</th>
              </tr>
            </thead>
            <tbody>
              <tr>
               
                  <input type="hidden" name="PurchaseId">
               
                <td><input type="number" class="form-control" step="any" name="amount"></td>
                <td >{{Form::textarea('comments', isset($comments)?$comments: '', ['class' => 'form-control ', 'id' => 'comments',"style"=>"height: 40px;"])}}
                      </td> 
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <td></td>
                <td></td>
                <td><input type="submit" id="payment" class="btn btn-sm btn-success"></td>
                <td></td>
              </tr>
            </tfoot>
            
          </table>
          {{-- </form> --}}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <!---- Model end --->
</section>

<script src="{{ asset('alerts-boxes/js/sweetalert.min.js') }}"></script>
<script type="text/javascript">


  $(document).ready(function() {
    $(document).on('click','#closeProdultDetail',function()
    {
           $('#HideForShowProduct2').hide();
              $('#HideForShowProduct').show();
              $('#productDetail').html("");
    })

$(document).on('click', '.openPayentModelForProduct', function(){  
          var PurchaseId = $(this).attr('id');
          $('[name="PurchaseId"]').val(PurchaseId)
      }); 

  $(document).on('click', '.openPayentModel', function(){  
          var workshopId = $(this).attr('id');
        //  $('[name="PurchaseId"]').val(PurchaseId)

          $.ajax({
            type:"POST",
            url: "{{  url('/') }}/ajax/getWorkshopReport",
            data:{
                  "_token": "{{ csrf_token() }}",
                  workshopId : workshopId
            },
            dataType : 'html',
            cache: false,
            success: function(data){
              $('#HideForShowProduct2').show();
              $('#HideForShowProduct').hide();
         workshop_Product=JSON.parse(data);
              for (index = 0; index < workshop_Product.length; ++index) {
$('#productDetail').append("<tr>\
  <td>"+workshop_Product[index]['workshop_id']+"</td>\
  <td>"+workshop_Product[index]['workshop_id']+"</td>\
  <td>"+workshop_Product[index]['product_name']+"</td>\
  <td>"+workshop_Product[index]['product_quantity']+"</td>\
  <td>"+workshop_Product[index]['UnitExitPrice']+"</td>\
   <td><a data-toggle=\"modal\" id=\""+workshop_Product[index]['WorkshopProId']+"\" data-target=\"#myModal\"  class=\"btn btn-success openPayentModelForProduct btn-sm\"><i class=\"fa fa-undo\" aria-hidden=\"true\"></i></a> </th>\
  </tr>"
  );

              //  thisSelf.parent().parent().find('[name^=model_number]').append(
               
              // );  

            }
                    },
                    error: function (data) {
                      swal("Somthing Wrong!", "OOHooooooooooo!!!!", "error");
                    }
            
            
          });


      }); 


  $(document).ready(function() {

   $(document).on("click","#payment",function(){
 
      var quantity = $('[name^=amount]').val();
      var PurchaseId = $('[name^=PurchaseId]').val();
      var comments = $('[name^=comments]').val();

      $.ajax({
        type:"POST",
        url: "{{  url('/') }}/ajax/submitSaleReturn",
        data:{
              "_token": "{{ csrf_token() }}",
              saleId : PurchaseId,
              quantity : quantity,
              comments : comments,
        },
        dataType : 'html',
        cache: false,
        success: function(data){
           if(data==1)
                  {
                    swal("Good job!", "Purchase Returned Successfully . Now Quantity Has Been decrimented", "success");
                      $('[name^=PurchaseId]').val("");
                      $('[name^=comments]').val("");
                  }
                  else
                  {
                    swal("Somthing Wrong!", "OOHooooo!!!!!", "error");
                  }
                },
                error: function (data) {
                  swal("Somthing Wrong!", "OOHooooooooooo!!!!", "error");
                }
        
        
      });
     });
      
  
} );
} );

</script>
@endsection