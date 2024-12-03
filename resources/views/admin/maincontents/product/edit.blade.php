@extends('../admin.layouts.main')

@section('maincontent')

@push('PAGE_ASSETS_CSS')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
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
          <li class="breadcrumb-item active">Edit Product</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <form name="frmadd" action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
      {{ csrf_field() }}
      <input type="hidden" id="exnm" name="existing_img" value="{{ $product->image }}" >
      <div class="row">
        <div class="col-lg-3">
          <div class="col-lg-12">
            <div class="list-group">
                <a href="{{ route('admin.product.edit', $product->id) }}" class="list-group-item list-group-item-action active" aria-current="true" disabled>Edit Product</a>
                <a href="{{ route('admin.product.varient', $product->id) }}" class="list-group-item list-group-item-action">Manage Varients</a>
                <a href="javascript:void(0)" class="list-group-item list-group-item-action">Upload Images</a>
                <a href="javascript:void(0)" class="list-group-item list-group-item-action">Manage Meta Details</a>
            </div>
           
          </div>
          <div class="col-lg-12 pt-3">
            <div class="card">
              <div class="card-body">
                <div class="col-md-12" id="ingsec">
                    @if($product->image!="")
                        <img src="{{ asset( config('constants.PRODUCT_IMAGE_PATH').$product->image ) }}" alt="{{ $product->product_name }}" class="img-thumbnail">
                        <button type="button" class="btn btn-primary" id="dtimg"><i class="fa fa-times"></i> Remove Image</button>
                        @else
                        <img src="{{ asset('admin/img/no-image.jpg') }}" alt="{{ $product->product_name }}" class="img-thumbnail">
                    @endif
                </div>
              </div>
            </div>
          </div>


        </div>
        <div class="col-lg-9">

          <div class="card">
            <div class="card-body">
               
                  <div class="form-group">
                    <label for="ptitle">Product Name <span class="required" aria-required="true"> * </span></label>
                    <input type="text" class="form-control {{($errors->first('product_name'))?'has-error':''}}" id="ptitle" name="product_name" value="{{ $product->product_name }}" placeholder="Enter a name of the product.">
                    <span class="error-txt">{{$errors->first('product_name')}}</span>
                  </div>

                  <div class="form-group">
                    <label for="slugnm">Slug Name <span class="required" aria-required="true"> * </span></label>
                    <input type="text" class="form-control {{($errors->first('slug'))?'has-error':''}}" id="slugnm" name="slug" value="{{ $product->slug }}" placeholder="Enter slug name">
                    <span class="error-txt">{{$errors->first('slug')}}</span>
                    <small id="emailHelp" class="form-text text-muted">This field is unique, should be a string, lower case and without space. For Ex: embroidered-boat-neck-kurta</small>
                  </div>

                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="slugnm">SKU Code </label>
                        <input type="text" class="form-control" name="sku_code" value="{{ $product->sku_code }}" placeholder="Enter a product SKU code">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="pagetitle">Price <span class="required" aria-required="true"> * </span></label>
                        <input type="text" class="form-control {{($errors->first('price'))?'has-error':''}}" name="price" value="{{ $product->price }}" placeholder="Base Price">
                        <span class="error-txt">{{$errors->first('price')}}</span>
                      </div>
                    </div>
                  </div>

                  

                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="slugnm">Select Categories <span class="required" aria-required="true"> * </span></label>
                        <select class="form-control selectpicker" id="catid" data-live-search="true" title="Choose atleast one" name="categories[]" multiple>
                          @foreach ($categories as $category)
                              @php $selected = (in_array($category->id, $assign_categories) ? 'selected="selected"':'') @endphp
                              <option value="{{ $category->id }}" {{ $selected }} >{{ $category->category_name }}</option>
                          @endforeach
                        </select>
                        <span class="error-txt">{{$errors->first('categories')}}</span>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="pagetitle">Upload Image</label>
                        <input type="file" class="form-control" name="image" id="image">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="pagetitle">Page Description</label>
                    <textarea name="description" class="form-control" cols="5" rows="10">{{ $product->description }}</textarea>
                  </div>
                    

                  <button class="btn btn-primary" type="submit" name="submit" value="submit"><i class="fa fa-check"></i> Submit</button>
                
            </div>
          </div>


        </div>
      </div>





    </form>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@push('PAGE_ASSETS_JS')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script>
  jQuery(document).ready(function () {
  
      $('#catid').selectpicker();
  
     //Remove Image
     $('#dtimg').on('click', function(e){
      e.preventDefault();
      Swal.fire({
                  title: "Are you sure?",
                  text: "You won't be able to revert this!",
                  icon: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#3085d6",
                  cancelButtonColor: "#d33",
                  confirmButtonText: "Yes, delete it!"
              }).then( (result)=>{
  
                  if(result.isConfirmed) {
                      let product_id = {{ $product->id }};
                      let image_name = $('#exnm').val();
                      $.ajax({
                          url: "{{ route('admin.product.delete_image') }}",
                          type: 'POST',
                          data: {proId:product_id, imgname: image_name},
                          success: function(response) {
                              console.log(response);
                              if(response.status == "success"){
                                  $('#exnm').val('');
                                  toastr.success('Success', response.msg);
                                  $('#ingsec').html('<img src="{{ asset("admin/img/no-image.jpg") }}" alt="{{ $product->product_name }}" class="img-thumbnail">');
                              }
                              else{
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
  
                  }      
  
  
              });
  
     });
  
  });
  </script>
@endpush
    
@endsection