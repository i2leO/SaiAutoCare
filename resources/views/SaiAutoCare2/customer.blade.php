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
<style type="text/css">
  @media print {
    .table {
        background-color: white;  
        color: black;
        border-color: black;

    } 
     table {
        border: 1px solid black;
    }
    th, td {
       border: 1px solid black;
    }
 
    /* More print styles */
  /* ...style="background-color: black;color: white" */
}
</style>
<section class="container-fluid" >
  <!-- For Session Message -->
    <div class="row">
      <!-- left column -->
      <div class="col-lg-12 col-sm-12">
        <!-- general form elements -->
        <div class="card box-primary">
          <div class="card-header with-border text-center">
            <h4 class="box-title text-primary ">Please Fill Up Customers Details</h4>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          @if(session()->has('message.level'))
          <div class="card-body">

            <div class="alert alert-{{ session('message.level') }} alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <div class="alert-icon icon-part-{{ session('message.level') }}">
                <i class="fa fa-{{ session('message.icon') }}"></i>
              </div>
              <div class="alert-message">
                <span>  {!! session('message.content') !!}</span>
              </div>
            </div>
             
              
          
          </div>
           @endif
        </div>
      </div>
    </div>
  <!-- For Session Message -->
    <div class="row">
      <div  class="col-lg-12 text-center" style="display:{{ isset($id)?'block':'none' }}">
                      
                             <button type="button" class="btn btn-light waves-effect waves-light" data-toggle="modal" data-target="#modal-animation-3"><i class="fa fa-plus">Add Customer</i></button>
                        
      </div> 
 
       <div class="modal fade" id="modal-animation-3">
                  <div class="modal-dialog modal-lg " >
                     {{ Form::open(['url' => 'SaiAutoCare/customer/add','files' => 'true' ,'enctype' => 'multipart/form-data', 'autocomplete' => 'OFF']) }} 
                    {{ csrf_field() }}
                    {{ Form::hidden('id', isset($id) ? $id :'', []) }} 
                    <div class="modal-content animated zoomInUp">
                      <div class="modal-header">
                        <h5 class="modal-title">Customers Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                            <div class="row">
                    <div class="col-md-6">
                    <div class="form-groupp">
                    <label class="form-col-form-label" for="name">Customer Name</label>
                    {{Form::text('customer_name', isset($customer_name)?$customer_name: '', ['class' => 'form-control form-control ','id'=>'customer_name','required', 'placeholder' => '  Name']  )}}
                    <div class="invalid-feedback">
                    {{ $errors->has('customer_name') ? $errors->first('name', ':message') : '' }}
                    </div>
                    </div>
                    </div>
                {{--   </div>

  
                  <div class="row"> --}}
                    <div class="col-md-6">
                    <div class="form-group">
                    <label class="form-col-form-label" for="customer_contact_number">Contact Number</label>
                    {{Form::number('customer_contact_number',isset($customer_contact_number)?$customer_contact_number: '', ['class' => 'form-control form-control ', 'placeholder' => 'Mobile Number'] )}}
                    <div class="invalid-feedback">
                    {{ $errors->has('mob_num') ? $errors->first('mob_num', ':message') : '' }}
                    </div>
                    </div>
                    </div> 
                  </div>
                   <div class="row">
                    <div class="col-md-6">
                    <div class="form-group">
                    <label class="form-col-form-label" for="customer_contact_number">Alternate Contact Number</label>
                    {{Form::number('customer_contact_number',isset($customer_alt_number)?$customer_alt_number: '', ['class' => 'form-control form-control ', 'placeholder' => 'Mobile Number'] )}}
                    <div class="invalid-feedback">
                    {{ $errors->has('customer_alt_number') ? $errors->first('customer_alt_number', ':message') : '' }}
                    </div>
                    </div>
                    </div> 
                 {{--  </div>
                  <div class="row"> --}}
                    <div class="col-md-6">
                    <div class="form-group">
                    <label class="form-col-form-label" for="customer_email">Email</label>
                    {{Form::text('customer_email',isset($customer_email)?$customer_email: '', ['class' => 'form-control form-control ', 'placeholder' => 'Email'] )}}
                    <div class="invalid-feedback">
                    {{ $errors->has('customer_email') ? $errors->first('customer_email', ':message') : '' }}
                    </div>
                    </div>
                    </div> 
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                      <label class="form-col-form-label" for="customer_gstin">GSTIN</label>
                      {{Form::text('customer_gstin',isset($customer_gstin)?$customer_gstin: '', ['class' => 'form-control form-control ', 'placeholder' => 'GSTIN'] )}}
                      <div class="invalid-feedback">
                      {{ $errors->has('customer_gstin') ? $errors->first('customer_gstin', ':message') : '' }}
                      </div>
                    </div>
                    </div> 
                 {{--  </div>
                  <div class="row"> --}}
                    <div class="col-md-6">
                    <div class="form-group">
                    <label class="form-col-form-label" for="customer_address">Address</label>
                    {{Form::textarea('customer_address',isset($customer_address)?$customer_address: '', ['class' => 'form-control form-control ', 'style'=>'height:75px','placeholder' => 'Address'] )}}
                    <div class="invalid-feedback">
                    {{ 
                    $errors->has('customer_address') ? $errors->first('customer_address', ':message') : '' }}
                    </div>
                    </div>
                    </div> 
                  </div>
                      </div>
                      <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Close</button> --}}
                         <button type="submit" class="btn btn-sm btn-primary" name=""> <i class="fa fa-dot-circle-o"></i>Add</button> 
                <button type="reset" class="btn btn-sm btn-danger" name=""> <i class="fa fa-ban"></i> Reset</button> 
                      </div>
                    </div>
                    {{Form::close()}}
                  </div>
        </div>


        <div class="col-lg-12" >
{{--           {{ Form::open(['url' => 'SaiAutoCare/customer/add','files' => 'true' ,'enctype' => 'multipart/form-data', 'autocomplete' => 'OFF']) }} 
 --}}
          {{ isset($id)?Form::open(['url' => 'SaiAutoCare/customer/update','files' => 'true' ,'enctype' => 'multipart/form-data', 'autocomplete' => 'OFF']) : Form::open(['url' => 'SaiAutoCare/customer/add','files' => 'true' ,'enctype' => 'multipart/form-data', 'autocomplete' => 'OFF']) }} 


          {{ csrf_field() }}
          {{ Form::hidden('id', isset($id) ? $id :'', []) }} 
          <div class="card">
            <div class="card-header text-uppercase">Customer Details</div>
            <div class="card-body">
                  <div class="row">
                    <div class="col-md-4">
                    <div class="form-groupp">
                    <label class="form-col-form-label" for="name">Customer Name</label>
                    {{Form::text('customer_name', isset($customer_name)?$customer_name: '', ['class' => 'form-control form-control ','id'=>'customer_name','required', 'placeholder' => '  Name']  )}}
                    <div class="invalid-feedback">
                    {{ $errors->has('customer_name') ? $errors->first('name', ':message') : '' }}
                    </div>
                    </div>
                    </div>
                 {{--  </div>  
                  <div class="row"> --}}
                    <div class="col-md-4">
                    <div class="form-group">
                    <label class="form-col-form-label" for="customer_contact_number">Contact Number</label>
                    {{Form::number('customer_contact_number',isset($customer_contact_number)?$customer_contact_number: '', ['class' => 'form-control form-control ', 'placeholder' => 'Mobile Number'] )}}
                    <div class="invalid-feedback">
                    {{ $errors->has('mob_num') ? $errors->first('mob_num', ':message') : '' }}
                    </div>
                    </div>
                    </div> 
                 {{--  </div>
                   <div class="row"> --}}
                    <div class="col-md-4">
                    <div class="form-group">
                    <label class="form-col-form-label" for="customer_contact_number">Alternate Contact Number</label>
                    {{Form::number('customer_alt_number',isset($customer_alt_number)?$customer_alt_number: '', ['class' => 'form-control form-control ', 'placeholder' => 'Mobile Number'] )}}
                    <div class="invalid-feedback">
                    {{ $errors->has('customer_alt_number') ? $errors->first('customer_alt_number', ':message') : '' }}
                    </div>
                    </div>
                    </div> 
                 {{--  </div>
                  <div class="row"> --}}
                    <div class="col-md-4">
                    <div class="form-group">
                    <label class="form-col-form-label" for="customer_email">Email</label>
                    {{Form::text('customer_email',isset($customer_email)?$customer_email: '', ['class' => 'form-control form-control ', 'placeholder' => 'Email'] )}}
                    <div class="invalid-feedback">
                    {{ $errors->has('customer_email') ? $errors->first('customer_email', ':message') : '' }}
                    </div>
                    </div>
                    </div> 
                 {{--  </div>
                  <div class="row"> --}}
               
                    <div class="col-md-4">
                      <div class="form-group">
                      <label class="form-col-form-label" for="customer_gstin">GSTIN</label>
                      {{Form::text('customer_gstin',isset($customer_gstin)?$customer_gstin: '', ['class' => 'form-control form-control ', 'placeholder' => 'GSTIN'] )}}
                      <div class="invalid-feedback">
                      {{ $errors->has('customer_gstin') ? $errors->first('customer_gstin', ':message') : '' }}
                      </div>
                    </div>
                    </div> 
                  {{-- </div>
                  <div class="row"> --}}
                    <div class="col-md-4">
                    <div class="form-group">
                    <label class="form-col-form-label" for="customer_address">Address</label>
                    {{Form::textarea('customer_address',isset($customer_address)?$customer_address: '', ['class' => 'form-control form-control ', 'style'=>'height:75px','placeholder' => 'Address'] )}}
                    <div class="invalid-feedback">
                    {{ 
                    $errors->has('customer_address') ? $errors->first('customer_address', ':message') : '' }}
                    </div>
                    </div>
                    </div> 
                  </div>
            </div>

            <div class="card-footer">
                <div class="row">
                <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-sm btn-primary" name=""> <i class="fa fa-dot-circle-o"></i>{{isset($id) ? 'Update' :'Add' }}</button> 
                <button type="reset" class="btn btn-sm btn-danger" name=""> <i class="fa fa-ban"></i> Reset</button> 
                </div>
              </div>                
            </div>

          </div>
          {{Form::close()}}
        </div>


<div class="col-lg-12">
  <div class="card">
    <div class="card-header text-uppercase">Customer Details</div>
    <div class="card-body">


    <div class="row">
        <div class="col-sm-12" class="text-center">
          {{ Form::open(['url' => 'SaiAutoCare/customer/search','files' => 'true' ,'enctype' => 'multipart/form-data', 'autocomplete' => 'OFF']) }} 
          <div class="row">
            <div class="col-sm-2">
            <div class="form-group">
            <label for="id-6">Customer Id</label>
            {{Form::text('id', isset($id)?$id: '', ['class' => 'form-control form-control-rounded ','id'=>'id', 'placeholder' => 'Customer Id']  )}}
            </div>
            </div>
            <div class="col-sm-2">

            <div class="form-group">
            <label for="input-6">Customer Name</label>
            {{Form::text('customer_name', isset($customer_name)?$customer_name: '', ['class' => 'form-control form-control-rounded','id'=>'customer_name', 'placeholder' => ' Customer Name']  )}}
            </div>

            </div> 
            <div class="col-sm-2">
            <div class="form-group">
            <label for="mob_num">Mobile Number</label>
            <input type="text"  id="customer_contact_number" class="form-control form-control-rounded" name="customer_contact_number">
            </div>
            </div>
          {{-- </div>
          <div class="row"> --}}
            <div class="col-sm-2">
            <div class="form-group">
            <label for="input-6">From Date</label>
             <input type="text"  id="autoclose-datepicker_from" class="form-control form-control-rounded datepicker" name="created_at_to">
            </div>
            </div>
            <div class="col-sm-2">
            <div class="form-group">
            <label for="input-6">To Date</label>
           
             <input type="text"  id="autoclose-datepicker_to" class="form-control form-control-rounded datepicker" name="created_at_from">
            </div>
            </div>
            <div class="col-sm-2">
            <div class="form-group">
            <label for="input-6">Email</label>
            <input type="text"  id="customer_email" class="form-control form-control-rounded" name="customer_email">
            </div>
            </div>

          </div> 
          <div class="row">
            <div class="col-sm-12 text-center">
            <input type="submit" name="search" class="btn btn-warning btn-round waves-effect waves-light m-1" value="Search">
            </div>
            </div>
          {{Form::close()}}
        </div>
      </div>


      

    </div>

    </div>
  </div>
  </div>


      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <i class="fa fa-align-justify"></i> Customer Details
            </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="datable_1" class="table table-bordered" >
                <thead>
                  <tr>
                    <th >Customer Id</th>
                    <th >Customer Name</th>
                    <th >Mobile Number</th>
                    <th >Email</th>
                    {{-- <th >Address</th> --}}
                    <th >GSTIN</th>
                    <th >Created Date</th>
                    {{-- <th >Updated Date</th> --}}
                    <th  style="white-space: nowrap">Action</th>
                  </tr>
                </thead>
                <tbody>


                @foreach($customer as $key => $value)
                  <tr>
                    <td>{{ $value['id'] }}</td>
                    <td>{{ $value['customer_name'] }}</td>
                    <td>{{ $value['customer_contact_number'] }}</td>
                    <td>{{ $value['customer_email'] }}</td>
                    <td>{{ $value['customer_gstin'] }}</td>
                    <td>{{ $value['created_at'] }}</td>
                    <td style="white-space: nowrap">
                        <a data-toggle="modal" id="{{ $value['id'] }}" data-target="#myModal"  class="btn btn-success openPayentModel btn-sm"><i class="fa fa-credit-card" aria-hidden="true"></i></a> 
                    <a href="{{ url('/')}}/SaiAutoCare/customer/add/{{ $value['id'] }}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a> 
                    <a href="{{ url('/')}}/SaiAutoCare/customer/trash/{{ $value['id']}} " class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?');"><i class="fa fa-remove"></i></a>
                    </td>
                  </tr>  
                @endforeach
                </tbody>
              </table>
              <div class="col-lg-12 text-center">

              </div>
            </div>
          </div>
          </div>
          </div>

       </div>
    
     <!--End Row-->
    

 


  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
           <h4 class="modal-title text-primary">Customer Payment For Customer ID:<p id="CustomerSpan"></p> </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
         
        </div>
        <div class="modal-body">
          {{-- <form  id="formId" action="{{  url('/') }}/ajax/submitCustomerPaymentDetail" method="POST"> --}}
             {{ csrf_field() }}
          <table class="table">
            <thead>
              <tr>
                <th style="display:none" >Credit/Debit</th>
                <th>Amount</th>               
                <th>Payment Date</th>
                 <th>Payment Type</th>
                <th>Payment Discription</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td style="display:none">
                  <select name="creditDebit" class="form-control" style="display:none">
                    <option value="0" selected>Credit</option>
                    <option value="1">Debit</option>                  
                  </select>
                  <input type="hidden" name="customerId">
                </td>
                <td><input type="number" class="form-control" step="any" name="amount"></td>
                <td><input type="text" class="form-control datepicker" id="payementDate"  name="payment_date"></td>
                <td> {{Form::select('payment_type',['1'=>'By Cash','2'=>'By Internate Banking','3'=>'By Cheque'],isset($payment_type)?$payment_type: '', ['class' => 'form-control form-control '] )}} </td>
                <td >{{Form::textarea('comments', isset($comments)?$comments: '', ['class' => 'form-control ', 'id' => 'comments',"style"=>"height: 40px;"])}}
                      </td> 
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <td></td>
                <td></td>
                <td><input type="button" id="payment" class="btn btn-sm btn-success" value="submit"></td>
                <td> 
                  {{-- <button type="reset" class="btn btn-sm btn-danger" name=""> <i class="fa fa-ban"></i> Reset</button>  --}}
                </td>
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
                  
  
</section>
<script src="{{ asset('alerts-boxes/js/sweetalert.min.js') }}"></script>
<script type="text/javascript">
  // $('#autoclose-datepicker_to').datepicker({
   //      autoclose: true,
   //      todayHighlight: true
   //    });
   // $('#autoclose-datepicker_from').datepicker({
   //      autoclose: true,
   //      todayHighlight: true
   //    });
$(document).ready(function(){
    $('.datepicker').datepicker({
       format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true,
        endDate: '+0d',
      });

    $(document).on('click', '.openPayentModel', function(){  
          var customerId = $(this).attr('id');
          $('[name="customerId"]').val(customerId);
            $('#CustomerSpan').val(customerId);
          
      }); 


//     $(document).on("click","#payment",function(){
//   var frm = $('#formId');
//         frm.submit(function (e) {
//             e.preventDefault();
//             $.ajax({
//                 type: frm.attr('method'),
//                 url:  frm.attr('action'),
//                 data: frm.serialize(),
//                 success: function (data) {
//                   if(data==1)
//                   {
//                     swal("Good job!", "Payment Discription  Successfully Added. You Can Check in  Log Section", "success");
//                      // $('#formId')[0].reset();
//                   }
//                   else
//                   {
//                     swal("Somthing Wrong!", "OOHooooo!!!!!", "error");
//                   }
//                 },
//                 error: function (data) {
//                   swal("Somthing Wrong!", "OOHooooooooooo!!!!", "error");
//                 },
//             });
//         });
// })


     $(document).on("click","#payment",function(){
 
      var creditDebit = $('[name^=creditDebit]').val();
      var customerId = $('[name^=customerId]').val();
      var amount = $('[name^=amount]').val();
      var payment_date = $('[name^=payment_date]').val();
      var payment_type = $('[name^=payment_type]').val();
      var comments = $('[name^=comments]').val();
      if(amount=="")
           {
             swal("warning!", "Please enter Amount", "");
           }
           else
           {
            $.ajax({
              type:"POST",
              url: "{{  url('/') }}/ajax/submitCustomerPaymentDetail",
              data:{
                    "_token": "{{ csrf_token() }}",
                    creditDebit : creditDebit, 
                    customerId : customerId,
                    amount : amount,
                    payment_date : payment_date,
                    payment_type : payment_type,
                    comments : comments,
              },
              dataType : 'html',
              cache: false,
              success: function(data){
                 if(data==1)
                        {
                          swal("Good job!", "Payment Discription  Successfully Added. You Can Check in  Log Section", "success");
                           // $('#formId')[0].reset();
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
          }
     }); 


})
 


   // $('#default-datatable').DataTable();


   //     var table = $('#example').DataTable( {
   //      lengthChange: false,
   //      buttons: [ 'copy', 'excel', 'pdf', 'print', 'colvis' ]
   //    } );
 
   //   table.buttons().container()
   //      .appendTo( '#example_wrapper .col-md-6:eq(0)' );
</script>

@endsection