<!DOCTYPE html>

<html>

<head>

	<script src="{{ asset('js/jQuery.min.js') }}"></script>

	 <link rel="stylesheet" href="{{ asset('bootstrap-4.1.3/dist/css/bootstrap.css') }}">  

	    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	     <meta name="discription" content="Ashutosh Kumar Choubey (Full Stack Application Developer)" />

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

<style>

.grid-container {

	display: grid;

	display: inline-grid;

	grid-template-columns: auto auto auto;

	grid-column-gap: 50px;

}

.grid-container2 {

	display: grid;

	display: inline-grid;

	grid-template-columns: 5% 30% 10%  33% 2%;

	grid-column-gap: 4%;

}

.grid-container3 {

	display: grid;

	display: inline-grid;

	grid-template-columns: 30% 10% 10% 30%;

	grid-column-gap: 5%;

}

.grid-item {

  /*padding: 20px;*/

  font-size: 30px;

  text-align: center;

}

p.word-wrap{

	 word-break: keep-all;

}

.logo

{

border-radius: 15px 50px;

  /*border-radius: 25px;*/

  background-position: left top;

  background-repeat: repeat;

  padding: 15px; 

 /* width: 200px;

  height: 150px; */

    /*background-image: linear-gradient(to bottom right, #867f7f, #c8c8d0);*/

    /*color: skyblue;*/

    color: black;



}

.footer {

   position: fixed;

   left: 0;

   bottom: 0;

   width: 100%;

   /*text-align: center;*/

}

</style>

<title>Workshop Detail</title>

</head>

<body>

	<section style="margin-left: 30px;margin-right: 30px; margin-top: 30px">
		<div style="height:80px;width:100% ;background-color: white;" class="grid-container">

			<div  class="grid-item">

				&nbsp;

			</div>

			<div  class="grid-item " align="right">

				{{-- <div style="width:270px;text-shadow: 3px 2px red;" align="right" class="logo"><b><i>Sai Auto Care</i></b></div> --}}

				<div style="width:100%;text-shadow: 3px 2px red;" class="logo"><b><i>Sai Auto Care</i></b></div>

			</div>

			{{-- <div  class="grid-item word-wrap" style="word-break: break-all;font-size: 15px;">

				2376, Puri Bypass NH, Badagada, <br>

				 Bhubaneswar-751019

			</div>
 --}}
			

		</div>

		<div style="height:80px;width:100% ;background-color: white;" class="grid-container">

			<div  class="grid-item">

				&nbsp;

			</div>

			<div  class="grid-item word-wrap" style="word-break: break-all;font-size: 15px;">

				2376, Puri Bypass NH, Badagada, <br>

				 Bhubaneswar-751019

			</div>

			<div  class="grid-item word-wrap" style="word-break: break-all;font-size: 15px;">

				&nbsp;

			</div>

			

		</div>



		<div style="width:100% ;background-color: white;" class="grid-container2"  >

			

			<div  class="grid-item" style="font-size: 17px" align="left">

				<table>

					<tr align="left">

						<td  style="white-space: nowrap">E-Mail</td>

						<td>:&nbsp;</td>

						<td align="left">saiautocare18@gmail.com</td>

					</tr>

					<tr  align="left">

						<td  style="white-space: nowrap">Phone Number</td>

						<td>:&nbsp;</td>

						<td align="left">07683855014</td>

					</tr>

					<tr  align="left">

						<td  style="white-space: nowrap">Alt Phone Number</td>

						<td>:&nbsp;</td>

						<td align="left">09437284700</td>

					</tr>

					<tr>

						<td colspan="3">&emsp;</td>

					</tr>

				</table>

			</div>
			<div  class="grid-item">&emsp;</div>

			<div  class="grid-item">&emsp;</div>
			<div  class="grid-item">&emsp;</div>

			<div  class="grid-item word-wrap" style="font-size: 17px" align="right">

				<table align="right">

					<tr  align="left">

						<td  style="white-space: nowrap">Dealer State</td>

						<td>:&nbsp;</td>

						<td align="left">Orissa/OR</td>

					</tr>

					<tr  align="left">

						<td  style="white-space: nowrap">GSTIN</td>

						<td>:&nbsp;</td>

						<td align="left">21ASGPA9327Q1Z1</td>

					</tr>

					<tr  align="left">

						<td  style="white-space: nowrap">C.I.N. No.</td>

						<td>:&nbsp;</td>

						<td align="left">09437284700</td>

					</tr>

					<tr>

						<td colspan="3">&emsp;</td>

					</tr>



				</table>

				

			</div>

			

		</div>

		<hr>

		<div style="width:100% ;background-color: white;font-size: 19px" align="center"  ><b>Tax Invoice</b></div>

		<hr>

		<div style="width:100% ;background-color: white;" class="grid-container3" align="center"  >

			<div  class="grid-item" style="font-size: 18px">

						<table >

								<tr>

							   		<td>&nbsp;</td>

							   		<td style="white-space: nowrap" align="left">Customer Id</td>

							   		<td>:&nbsp;</td>

							   		<td align="left">{{ strtotime($created_at) }}-{{ $customer_id }}</td>

							   		<td>&nbsp;</td>

							   	</tr>

								<tr>

							   		<td>&nbsp;</td>

							   		<td style="white-space: nowrap" align="left">Customer Name</td>

							   		<td>:&nbsp;</td>

							   		<td align="left">{{ $name }}</td>

							   		<td>&nbsp;</td>

							   	</tr>

							   	<tr>

							   		<td>&nbsp;</td>

							   		<td style="white-space: nowrap" align="left">Reference</td>

							   		<td>:&nbsp;</td>

							   		<td align="left">{{ $reference }}</td>

							   		<td>&nbsp;</td>

							   	</tr>

							   	<tr>

							   		<td>&nbsp;</td>

							   		<td style="white-space: nowrap" align="left">Company</td>

							   		<td>:&nbsp;</td>

							   		<td align="left">{{ $company }}</td>

							   		<td>&nbsp;</td>

							   	</tr>

							   	<tr>

							   		<td>&nbsp;</td>

							   		<td style="white-space: nowrap" align="left">Email</td>

							   		<td>:&nbsp;</td>

							   		<td align="left">{{ $email }}</td>

							   		<td>&nbsp;</td>

							   	</tr>

							   	<tr>

							   		<td>&nbsp;</td>

							   		<td style="white-space: nowrap" align="left">Mobile Number</td>

							   		<td>:&nbsp;</td>

							   		<td align="left">{{ $mobile }}</td>

							   		<td>&nbsp;</td>

							   	</tr>

							   	<tr>

							   		<td>&nbsp;</td>

							   		<td style="white-space: nowrap" align="left">Alt. Mobile Number</td>

							   		<td>:&nbsp;</td>

							   		<td align="left">{{ $landline }}</td>

							   		<td>&nbsp;</td>

							   	</tr>

							   	<tr>

							   		<td>&nbsp;</td>

							   		<td style="white-space: nowrap" align="left">GST Number</td>

							   		<td>:&nbsp;</td>

							   		<td align="left">{{ $gst_no }}</td>

							   		<td>&nbsp;</td>

							   	</tr>

							   	<tr>

							   		<td>&nbsp;</td>

							   		<td style="white-space: nowrap" align="left">Address</td>

							   		<td>:&nbsp;</td>

							   		<td align="left">{{ $address }}</td>

							   		<td>&nbsp;</td>

							   	</tr>

							   	<tr>

							   		<td>&nbsp;</td>

							   		<td style="white-space: nowrap" align="left">Advance Received</td>

							   		<td>:&nbsp;</td>

							   		<td align="left">{{ number_format($paid_price,2) }}</td>

							   		<td>&nbsp;</td>

							   	</tr>
							   		<tr>

							   		<td>&nbsp;</td>

							   		<td style="white-space: nowrap" align="left">Paid Amount</td>

							   		<td>:&nbsp;</td>

							   		<td align="left">{{ number_format($installmentPayment,2) }}</td>

							   		<td>&nbsp;</td>

							   	</tr>
							   	

							   	@php

							   	if(isset($due_out))

							   	{

							   		$middle = strtotime($due_out);  

							   		$new_date = date('d/m/Y', $middle);

							   	}

							   	else{

							   		$new_date ="";

							   	}	

							   	if(isset($due_in))

							   	{

							   		$due_in = strtotime($due_in);  

							   		$due_in = date('d/m/Y', $due_in);

							   	}

							   	else{

							   		$due_in ="";

							   	}

							   	if(isset($reg_number))

							   	{

							   		$reg_number = strtotime($reg_number);  

							   		$reg_number = date('d/m/Y', $reg_number);

							   	}

							   	else{

							   		$reg_number ="";

							   	}	



							   	 							   

									$middle = strtotime(now());  

							   		// $new_date = date('d/m/Y', $middle);

									if($is_workshop==1 )

									{

								  	@endphp

							   	</tr>

							   		<tr>

							   		<td>&nbsp;</td>

							   		<td style="white-space: nowrap" align="left">Due Out</td>

							   		<td>:&nbsp;</td>

							   		<td align="left">{{ $new_date }}</td>

							   		<td>&nbsp;</td>

							   	</tr>

								@php

								}

								@endphp

						</table>

			</div>

			<div  class="grid-item">&emsp;</div>

			<div  class="grid-item">&emsp;</div>

			<div  class="grid-item" style="font-size: 18px">

				@php

				if($is_workshop==1 )

				{

				@endphp

							<table >

								<tr>

							   		<td>&nbsp;</td>

							   		<td style="white-space: nowrap" align="left">Job Id</td>

							   		<td>:&nbsp;</td>

							   		<td align="left">SAC-{{ $id }}-{{  date('Y', $middle) }}</td>

							   		<td>&nbsp;</td>

							   	</tr>

								<tr>

							   		<td>&nbsp;</td>

							   		<td style="white-space: nowrap" align="left">Vehicle Regitration Number</td>

							   		<td>:&nbsp;</td>

							   		<td align="left">{{ $vehicle_reg_number }}</td>

							   		<td>&nbsp;</td>

							   	</tr>

							   	<tr>

							   		<td>&nbsp;</td>

							   		<td style="white-space: nowrap" align="left">Model Year</td>

							   		<td>:&nbsp;</td>

							   		<td  align="left">{{ $model_year }}</td>

							   		<td>&nbsp;</td>

							   	</tr>

							   	<tr>

							   		<td>&nbsp;</td>

							   		<td style="white-space: nowrap" align="left">Brand</td>

							   		<td>:&nbsp;</td>

							   		<td  align="left">{{ $brandName }}</td>

							   		<td>&nbsp;</td>

							   	</tr>

							   	<tr>

							   		<td>&nbsp;</td>

							   		<td style="white-space: nowrap" align="left">Model</td>

							   		<td>:&nbsp;</td>

							   		<td  align="left">{{ $model_numberName }}</td>

							   		<td>&nbsp;</td>

							   	</tr>

							   	<tr>

							   		<td>&nbsp;</td>

							   		<td style="white-space: nowrap" align="left">Chasis Number</td>

							   		<td  align="left">:&nbsp;</td>

							   		<td  align="left">{{ $vin }}</td>

							   		<td>&nbsp;</td>

							   	</tr>

							   	<tr>

							   		<td>&nbsp;</td>

							   		<td style="white-space: nowrap" align="left">Fuel Type</td>

							   		<td>:&nbsp;</td>

							   		<td  align="left">{{ $fuel_type }}</td>

							   		<td>&nbsp;</td>

							   	</tr>

							   

							   	<tr>

							   		<td>&nbsp;</td>

							   		<td style="white-space: nowrap" align="left">Engine Number</td>

							   		<td>:&nbsp;</td>

							   		<td  align="left">{{ $engine_number }}</td>

							   		<td>&nbsp;</td>

							   	</tr>	

							   	<tr>

							   		<td>&nbsp;</td>

							   		<td style="white-space: nowrap" align="left">Vehicle Company Name</td>

							   		<td>:&nbsp;</td>

							   		<td  align="left">{{ $company_name }}</td>

							   		<td>&nbsp;</td>

							   	</tr>

							   	<tr>

							   		<td>&nbsp;</td>

							   		<td style="white-space: nowrap" align="left">Registerd Date</td>

							   		<td>:&nbsp;</td>

							   		<td  align="left">{{ $reg_number }}</td>

							   		<td>&nbsp;</td>

							   	</tr>	

							   	</tr>

							   		<tr>

							   		<td>&nbsp;</td>

							   		<td style="white-space: nowrap" align="left">Odometer Reading</td>

							   		<td>:&nbsp;</td>

							   		<td  align="left">{{ $odometer_reading }}</td>

							   		<td>&nbsp;</td>

							   	</tr>

							   	</tr>

							   		<tr>

							   		<td>&nbsp;</td>

							   		<td style="white-space: nowrap" align="left">Color</td>

							   		<td>:&nbsp;</td>

							   		<td  align="left">{{ $color }}</td>

							   		<td>&nbsp;</td>

							   	</tr>

							   </tr>

							   		<tr>

							   		<td>&nbsp;</td>

							   		<td style="white-space: nowrap" align="left">Key Number</td>

							   		<td>:&nbsp;</td>

							   		<td  align="left">{{ $key_number }}</td>

							   		<td>&nbsp;</td>

							   	</tr>

							   	</tr>

							   		<tr>

							   		<td>&nbsp;</td>

							   		<td style="white-space: nowrap"  align="left">Due In</td>

							   		<td>:&nbsp;</td>

							   		<td  align="left">{{ $due_in }}</td>

							   		<td>&nbsp;</td>

							   	</tr>

						</table>

					@php

				}

				@endphp	

			</div>

		</div>

		@php

				if($is_workshop==1 )

									{

								  	@endphp

		<div  style="width:100% ;background-color: white;">

			<div style="border: 1px solid #5d5a5a;"><b>Note: </b>{{ $notes }}<br></div>

			<div style="border: 1px solid  #5d5a5a;"><b>Submited Part: </b>{{ $submited_part }}<br></div>			

		</div>

		@php

				}

								  	@endphp

		<hr>

		<div  style="width:100% ;background-color: white;">

			<table border="1"  width="100%">

				@php

							$total_service_price=0;

							$total_product_price=0;

							$grandTotal=0;

							$total_Tax_Amount=0;

							$serviceGstPrice=0;

							@endphp

				@php

				if($is_workshop==1 )

									{

								  	@endphp

				<tr><td>

					<div align="center"><b> Services Details </b></div>

					<table    width="100%" border="1" >

						<thead>

							<tr>

								<th>Service Name</th>

								{{-- <th>Service Quantity</th> --}}

								<th>Price</th>

								<th>GST %</th>

								<th>GST</th>

								<th>Total Price</th>

							</tr>

						</thead>

						<tbody>

							

							@foreach($WorkshopService as $value)

							<tr>

								<td>{{  $value->service_name }}</td>

								{{-- <td>{{  $value->service_quantity }}</td>													 --}}

								<td>{{  $value->service_price }}</td>

								<td>18</td>

								<td>{{ (($value->service_price*18)/100)*$value->service_quantity }}</td>

								<td>{{ (($value->service_price+(($value->service_price)*18)/100)*$value->service_quantity) }}</td>

							</tr>

							@php

								// $total_service_price+=$value->service_price*$value->service_quantity;

								// $gstPrice=$value->service_price*$value->service_quantity-(($value->service_price+(($value->service_price)*18)/100)*$value->service_quantity);

							$total_service_price+=(($value->service_price+(($value->service_price)*18)/100)*$value->service_quantity);

							$serviceGstPrice+= (($value->service_price*18)/100)*$value->service_quantity;

							@endphp

							@endforeach

						</tbody>

						<tfoot>

							<tr><td colspan="5" align="right" >Total Service GST : {{ $serviceGstPrice }}</td></tr>

							<tr><td colspan="5" align="right" >Total Service Price : {{ $total_service_price }}</td></tr>

							

						</tfoot>

					</table>

				</td></tr>

				@php

				}

			   @endphp

				<tr><td>

					<div align="center"><b> Spare Details </b></div>

					<table    width="100%" border="1">						

						<thead>

							<tr>

								<th>Spare Name</th>

								<th>HSN</th>

								<th>Unit Price</th>

								<th>GST %</th>

								<th>Product Price</th>

								<th>Quantity</th>								

								<th>Total Price</th>

							</tr>

						</thead>

						<tbody>

							@foreach($WorkshopProduct as $value)

							<tr>

								<td>{{ $value->product_name }}</td>

								<td>{{ $value->ProductHsn }}</td>

								<td>{{ $value->UnitExitPrice }}</td>

								<td>{{ $value->ProductGst }}</td>

								<td>{{ $value->ProductWorkshopPrice }} </td>

								<td>{{ $value->product_quantity }} </td>								

								<td>{{ $value->ProductWorkshopPrice*$value->product_quantity }}</td>

							</tr>

							@php

							$total_Tax_Amount+=($value->ProductWorkshopPrice-$value->UnitExitPrice)* $value->product_quantity;

							$total_product_price+=$value->ProductWorkshopPrice*$value->product_quantity;

							@endphp

							@endforeach
							


						@if($is_complete==0)

						
							@foreach($workshop_products_estimateds as $value)

							<tr>

								<td>{{ $value->product_name }}</td>

								<td>{{ $value->ProductHsn }}</td>

								<td>{{ $value->UnitExitPrice }}</td>

								<td>{{ $value->ProductGst }}</td>

								<td>{{ $value->ProductWorkshopPrice }} </td>

								<td>{{ $value->product_quantity_es }} </td>								

								<td>{{ $value->ProductWorkshopPrice*$value->product_quantity_es }}</td>

							</tr>

							@php

							$total_Tax_Amount+=($value->ProductWorkshopPrice-$value->UnitExitPrice)* $value->product_quantity_es;

							$total_product_price+=$value->ProductWorkshopPrice*$value->product_quantity_es;

							@endphp

							@endforeach
							@endif

						</tbody>

						<tfoot>

							<tr><td colspan="7" align="right" >Total Spare GST Amount : {{ $total_Tax_Amount }}</td></tr>

							<tr><td colspan="7" align="right" >Total Spare Price : {{ $total_product_price }}</td></tr>

						</tfoot>

				</table>

				</td></tr>

				<tr><td>

					<table    width="100%" border="1">	

						<tr><td colspan="5" align="right" ><b>Grand Total GST :</b> {{ $total_Tax_Amount+$serviceGstPrice }}</td>					
						@php

						 $balancePrice = ($total_product_price+$total_service_price)-($installmentPayment+$paid_price);

						@endphp

						<tr><td colspan="5" align="right" ><b>Grand Total Price :</b> {{ $total_product_price+$total_service_price }}</td></tr>
						<tr><td colspan="5" align="right" ><b>Paid :</b> {{ $installmentPayment+$paid_price }}</td></tr>
						<tr><td colspan="5" align="right" ><b>Discount :</b> {{ $discount_price }}</td></tr>
						<tr><td colspan="5" align="right" ><b>Balance :</b> {{ $balancePrice-$discount_price }}</td></tr>




						

						{{-- @if($is_workshop==1)
						<tr><td colspan="5" align="right" ><b>Remaning Price :</b>({{ $total_product_price }}+{{ $total_service_price }})-({{ isset($installmentPayment)?$installmentPayment:0 }}+{{ $paid_price }})= {{ ($total_product_price+$total_service_price)-($installmentPayment+$paid_price) }}</td>
						</tr>
						@else
							<tr><td colspan="5" align="right" ><b>Remaning Price :</b>({{ $total_product_price }})-({{ isset($installmentPayment)?$installmentPayment:0 }}+{{ $paid_price }})= {{ ($total_product_price+$total_service_price)-($installmentPayment+$paid_price) }}</td>
							</tr>
						@endif --}}

				</table>

				</td></tr>

				<tfoot>

					@php

use NumberToWords\NumberToWords;



$numberToWords = new NumberToWords();



$numberTransformer = $numberToWords->getNumberTransformer('en');

$forPay=($total_product_price+$total_service_price)-($installmentPayment+$paid_price)

					@endphp

					<tr><td colspan="5"  ><p><b>Rupees:</b> {{ $numberTransformer->toWords($forPay) }}

						@php

						if($is_complete==0)

						{

							echo "<b>(Estimated Price)</b>";

						}

						@endphp

					</p>

						{{-- <p colspan="1" align="right" ><b>Invoice Amount:</b> {{ $total_product_price+$total_service_price }}</p> --}}

					</tr>

				</tfoot>

			</table>

		</div>

		<div  style="height:60px;width:100% ;background-color: white;">

			&nbsp;

		</div>

		

		

	</section>

	<div  style="width:100% ; position: fixed left: 0;bottom: 0; width: 100%;" align="right">

			<div style="width:100%; float: right;" align="right"><small>Printed Date :{{ date("Y/m/d") }}</small></div>

		</div>

</body>

<script src="{{ asset('bootstrap-4.1.3/dist/js/bootstrap.js') }}"></script>
<script type="text/javascript">
	 $.ajax({
        type:"POST",
        url: "{{url('/')}}/ajax/updateWorkshopBalance",
        data:{
          "_token": "{{ csrf_token() }}",
          workshop_id:{{ $id }},
          balance : {{ $balancePrice-$discount_price }},
          grandTotal : {{ $total_product_price+$total_service_price }}
        },
        dataType : 'html',
        cache: false,
        success: function(data){
        console.log("Workshop Balance Updated Successfully")
        }
      });
</script>

</html>

