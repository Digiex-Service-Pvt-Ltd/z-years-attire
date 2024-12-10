
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
        <h1 class="m-0">Manage Images</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.product.list') }}">Product</a></li>
          <li class="breadcrumb-item active">Images</li>
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
                <a href="{{ route('admin.product.varient', $product->id) }}" class="list-group-item list-group-item-action">Manage Varients</a>
                <a href="{{ route('admin.product.images', $product->id) }}" class="list-group-item list-group-item-action active" aria-current="true" disabled>Upload Images</a>
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

          <div class="card">
            <div class="card-body">
                  
              <h4>{{ $product->product_name }}</h4>
              <p class="h5"><span class="text-primary"> Price</span> &#8377 {{ $product->price }}</p>

                  @if($product->status=="1")
                  <span class="badge badge-success user-select-none" data-toggle="tooltip" data-placement="left" title="Product is already Published">Published</span>
                   @else
                   <span class="badge badge-secondary user-select-none" data-toggle="tooltip" data-placement="left" title="Please Published The Product ">Unpublished</span>
                  @endif
              
                  <div class="card bg-light mt-5">
                    <div class="card-header">
                      <h5>Upload images</h5>
                    </div>
                    <div class="card-body">

                      <div class="row">
                       
                        @if(!empty($product_color_attributes))
                            <div class="col-lg-12">
                              <form class="row" id="frmVar" name="frmVar" action="{{ route('admin.product.images.upload', $product->id) }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="form-group col-md-4">
                                        <label for="">Select a Color</label>
                                        <select name="color_attribute" class="form-control">
                                          <option value="">Select a Color</option>
                                          @foreach($product_color_attributes as $color_attr)
                                            <option value="{{ $color_attr->attribute_value_id }}" {{ old('color_attribute') == $color_attr->attribute_value_id ? 'selected="selected"' : '' }}>{{ $color_attr->value_name }}</option>
                                          @endforeach
                                        </select>
                                        @error('color_attribute')
                                          <span class="error-txt">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="">Browse Images</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="inputGroupFile02" name="iamges[]" multiple>
                                                <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
                                            </div>
                                        </div>
                                        @error('iamges')
                                          <span class="error-txt">{{ $message }}</span>
                                        @enderror
                                        
                                        @if($errors->has('images.*'))
                                          <ul class="text-danger">
                                            <li>Error found</li>
                                            @foreach($errors->get('images.*') as $error)
                                              <li>{{ $error[0] }}</li>
                                            @endforeach
                                          </ul>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-4 mt-4">
                                        <button class="btn btn-primary mt-2" type="submit" name="submit" value="submit" fdprocessedid="5gs6htr"><i class="fa fa-check"></i> Upload Images</button>
                                    </div>
                                </form>
                            </div> 
                        @else
                            <div class="col-lg-12"><p class="text-center">No color attributes found.</p></div>
                        @endif
                      </div>
                        

                    </div>  
                  </div>

                  <div class="card bg-light mt-5">
                    <div class="card-body">
                        <div class="card-header">


                          <div class="card-mychange">
                          <h5>Uploaded Images</h5>
                           
                          </div>
                          <div class="card-mychange">
                            <div class="card-mychangeright">
                             <p>Search by color</p> 
                              <select class="form-control" onchange="changeValue(this.value)" style="width: 50%">
                                <option value="">All</option>
                                @foreach($product_color_attributes as $color_attr)
                                  <option value="{{ $color_attr->attribute_value_id }}" {{ $color_attr->attribute_value_id == $value_id ? 'selected="selected"' : "" }} >{{ $color_attr->value_name }}</option>  
                                @endforeach
                              </select>

                            </div>
                         
                          </div>
                          
                            
                        </div>
                        <div class="card-body">

                                <div class="row">
                                  @if(!empty($list_images))
                                    @foreach($list_images as $image)
                                      <div class="col-lg-3 p-2 text-center" id="dv{{ $image->id }}">
                                        <div class="image-container">
                                              <img class="responsive-image" src="{{ asset( config('constants.PRODUCT_IMAGE_PATH').$image->image_name ) }}" alt="{{ $product->image_name }}" class="img-thumbnail">
                                        </div>
                                        <button class="btn btn-outline-danger mt-1 dtlimg" imgId="{{ $image->id }}"><i class="fa fa-trash"></i>  Delete Image</button>
                                      </div>
                                    @endforeach
                                  @else
                                    <div class="col-md-12">
                                      <p class="text-center">No Image Found</p>
                                    </div>
                                  @endif
                                  
                                </div>
                            

                        </div>
                    </div>
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
      $('.dtlimg').on('click', function(e){


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

                    e.preventDefault();
                    let thisObj = $(this);
                    let imageId = thisObj.attr('imgid');
                    thisObj.attr('disabled', true);
                    
                    $.ajax({
                          url: "{{ route('admin.product.images.delete') }}",
                          type: 'POST',
                          data: {imageId: imageId},
                          success: function(response) {
                              
                              if(response.status == "success"){
                                thisObj.attr('disabled', false);
                                thisObj.parent().remove();
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


                  }

                })
      })

            
          
  })

  function changeValue(valueId)
  {
     let url = '{{ route("admin.product.images.value", [$product->id, "VALUEID"]) }}';
     url = url.replace("VALUEID", valueId);
     //console.log(url);
     window.location.href = url;
  }
     
</script>
@endpush
    
@endsection