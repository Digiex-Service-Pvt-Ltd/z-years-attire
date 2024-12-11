@extends('../admin.layouts.main')

@section('maincontent')

@push('PAGE_ASSETS_CSS')
<style>
  
</style>
@endpush
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Manage Product</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.product.list') }}">Product</a></li>
          <li class="breadcrumb-item active">Varient</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
  <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3">
          <div class="col-lg-12">
            <div class="list-group">
                <a href="{{ route('admin.product.edit', $product->id) }}" class="list-group-item list-group-item-action">Edit Product</a>
                <a href="{{ route('admin.product.varient', $product->id) }}" class="list-group-item list-group-item-action active" aria-current="true" disabled>Manage Varients</a>
                <a href="{{ route('admin.product.images', $product->id) }}" class="list-group-item list-group-item-action">Upload Images</a>
                <a href="{{ route('admin.product.meta', $product->id)}}" class="list-group-item list-group-item-action">Manage Meta Details</a>
            </div>
           
          </div>
          <div class="col-lg-12 pt-3">
            <div class="card">
              <div class="card-body">
                <div class="col-md-12" id="ingsec">
                    @if($product->image!="")
                        <img src="{{ asset( config('constants.PRODUCT_IMAGE_PATH').$product->image ) }}" alt="{{ $product->product_name }}" class="img-thumbnail">
                    @else
                        <img src="{{ asset('admin/img/no-image.jpg') }}" alt="{{ $product->product_name }}" class="img-thumbnail">
                    @endif
                </div>
              </div>
            </div>
          </div>


        </div>
        <div class="col-lg-9">

          <div class="card card-secondary card-outline">
            <div class="card-body">
              <h4>{{ $product->product_name }}</h4>
              <p class="h5"><span class="text-primary"> Price</span> &#8377 {{ $product->price }}</p>

              @if($product->status=="1")
              <span class="badge badge-success user-select-none" data-toggle="tooltip" data-placement="left" title="Product is already Published">Published</span>
              @else
              <span class="badge badge-secondary user-select-none" data-toggle="tooltip" data-placement="left" title="Please Published The Product ">Unpublished</span>
             @endif
              
                  <div class="card bg-light mt-5 ">
                    <div class="card-header">
                      Create Varient Products selecting with different sizes and colors available within the boxes.
                    </div>
                    <div class="card-body">

                      <div class="row">
                        <form id="frmVar" name="frmVar" action="{{ route('admin.product.varient.add', $product->id) }}" method="POST">
                          @csrf
                          <input type="hidden" name="vardtls" id="varDtl">
                        </form>
                        @php //echo "<pre>"; print_r($ex_comb); @endphp
                        @if(!empty($combinations))
                          @foreach($combinations as $size=>$color)
                            @php 
                              $sizeArr = explode('@', $size);
                              $size_id = $sizeArr[0];
                              $size_text = $sizeArr[1];
                            @endphp
                            <div class="col-lg-6">
                                <div class="card">
                                  <div class="card-header">
                                    Size: {{ $size_text }}
                                  </div>
                                  <div class="card-body">
                                      <div class="pdiv">
                                        @foreach($color as $colArr)
                                       
                                            @if( !empty($ex_comb) && in_array( $size_id."#".$colArr["color_attribute_id"], $ex_comb) )
                                            <div class="box-tick" style="background-color: {{ $colArr["color_code"] }}">
                                            <div class="box-tick-color"></div>  
                                            </div>
                                            @else
                                              <a href="javascript:void(0)" class="varClass" title="{{ $colArr["color_text"] }}" s-id="{{ $size_id }}" col-id="{{ $colArr["color_attribute_id"] }}"><div class="box" style="background-color: {{ $colArr["color_code"] }}"></div></a>
                                            @endif  
                                        @endforeach
                                      </div>
                                  </div>
                                </div>
                              </div>    
                          @endforeach
                        @else
                            <h3>No combination exists.</h3>
                        @endif
                      </div>
                        

                    </div>  
                  </div>

                  <div class="card bg-light text-center mt-5">
                    <div class="card-body">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th style="width:25%">Varients</th>
                            <th>SKU Code</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th style="width:13%">Status</th>
                            <th colspan="2">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @if(!empty($varient_products))
                            @foreach($varient_products as $varient)
                              <tr>
                                <th scope="col">
                                  @if(!empty($varient->varient_attributes))
                                  <div class="pdiv">
                                    @foreach ($varient->varient_attributes as $vattr)
                                      <div class="box-attr"><p>{{ $vattr->attribute_values->value_name }}</p></div>
                                    @endforeach
                                  </div>
                                  @endif
                                </th>
                                <th scope="col">
                                  <input type="text" class="form-control text-center" id="sku_{{ $varient->id }}" value="{{ $varient->sku_code }}">
                                </th>
                                <th scope="col">
                                  <input type="text" class="form-control text-center" id="price_{{ $varient->id }}" value="{{ $varient->price }}">
                                </th>
                                <th scope="col">
                                  <input type="text" class="form-control text-center" id="stock_{{ $varient->id }}" value="{{ $varient->stock_qty }}">
                                </th>
                                <th>
                                  <select id="vrstatus_{{ $varient->id }}" class="custom-select">
                                    <option value="0" {{ ($varient->status=="0") ? 'selected="selected"' : "" }} >Inactive</option>
                                    <option value="1" {{ ($varient->status=="1") ? 'selected="selected"' : "" }} >Active</option>
                                  </select>
                                </th>
                                <th scope="col">
                                  <button type="button" class="btn btn-primary varUp" vid={{ $varient->id }}><i class="far fa-edit"></i></button>
                                </th>
                                <th>
                                  <button type="button" class="btn btn-danger varDelete" vid={{ $varient->id }}><i class="far fa-trash-alt"></i></button>
                                </th>
                              </tr>
                            @endforeach
                          @else
                              <tr><td colspan="4">No varient found.</td></tr>
                          @endif
                        </tbody>
                      </table>

                    </div>
                  </div>
                  <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.product.list')}}" class="btn btn-secondary ml-2"><i class="fa fa-angle-left" aria-hidden="true"></i>&nbsp; Back To List</a>
                  </div>
             
            </div>
          </div>


        </div>
      </div>
    
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@push('PAGE_ASSETS_JS')
<script>
  jQuery(document).ready(function () {

    //Add Varient
    $('.varClass').on('click', function(e){
      e.preventDefault();

      Swal.fire({
        title: "Are you sure to create a varient with this combination?",
        text: "After creation you need to enter stock quantity from the below listing.",
        icon: "info",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, do it!"
      }).then( (result)=>{

        if(result.isConfirmed) {
          let size_value_id = $(this).attr('s-id');
          let color_value_id = $(this).attr('col-id');
          let combination = size_value_id+","+color_value_id;
          $('#varDtl').val(combination);
          $('#frmVar').submit();
        }

      });
      

    })

    //Update Varient
    $('.varUp').on('click', function(e){
        e.preventDefault();
        let thisObj = $(this);
        let varientId = thisObj.attr('vid');
        let vSKU = $('#sku_'+varientId).val();
        let vPrice = $('#price_'+varientId).val();
        let vStock= $('#stock_'+varientId).val();
        let vStatus= $('#vrstatus_'+varientId ).val();

        thisObj.attr('disabled', true);
        let urlP = "{{ route('admin.product.varient.update', 'urlpath') }}";
        urlP = urlP.replace('urlpath', varientId);
        $.ajax({
              url: urlP,
              type: 'POST',
              data: {sku:vSKU, price: vPrice, stock:vStock, status:vStatus},
              success: function(response) {
                  
                  if(response.status === "success"){
                    thisObj.attr('disabled', false);
                    toastr.success('Success', response.msg);
                      
                  }
                  else{
                    thisObj.attr('disabled', false);
                      toastr.error('Product',response.msg);
                  }
                  
              },
              error: function(err) {
                  console.log(err.responseText);
                  console.log(typeof(responseText) );
                  toastr.error('Product', err.responseText.message);
                  
              },
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });


    })

    //Delete varient
    $('.varDelete').on('click', function(e){
        e.preventDefault();
        Swal.fire({
        title: "Are you sure to delete the varient?",
        text: "This item will be deleted from the product listing section.",
        icon: "info",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, do it!"
      }).then( (result)=>{

        if(result.isConfirmed) {
          let thisObj = $(this);
          let varientId = thisObj.attr('vid');

          thisObj.attr('disabled', true);
          let urlP = "{{ route('admin.product.varient.delete', 'urlpath') }}";
          urlP = urlP.replace('urlpath', varientId);

          $.ajax({
              url: urlP,
              type: 'POST',
              data: {},
              success: function(response) {
                  
                  if(response.status == "success"){
                    thisObj.attr('disabled', false);
                    toastr.success('Success', response.msg);
                      
                  }
                  else{
                    thisObj.attr('disabled', false);
                      toastr.error('Product',response.msg);
                  }

                  window.location.href = "{{ route('admin.product.varient', $product->id) }}";
                  
              },
              error: function(err) {
                  toastr.error('Product', err.responseText.message);
                  
              },
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });


        }

      });
        
    })
    

  })
     
</script>
@endpush
    
@endsection