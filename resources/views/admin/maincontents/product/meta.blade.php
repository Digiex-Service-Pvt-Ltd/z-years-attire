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
          <li class="breadcrumb-item active">Meta Manage</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <form name="frmadd" action="{{ route('admin.product.meta.update', $product['id']) }}" method="POST">
      {{ csrf_field() }}
      <input type="hidden" name="meta_id" value="{{ !empty($meta_details) ? $meta_details['id'] : "" }}" >
      <div class="row">
        <div class="col-lg-3">
          <div class="col-lg-12">
            <div class="list-group">
                <a href="{{route('admin.product.edit',$product['id'])}}" class="list-group-item list-group-item-action" aria-current="true" disabled>Edit Product</a>
                <a href="{{route('admin.product.varient',$product['id'])}}" class="list-group-item list-group-item-action">Manage Varients</a>
                <a href="javascript:void(0)" class="list-group-item list-group-item-action">Upload Images</a>
                <a href="{{route('admin.product.meta',$product['id'])}}" class="list-group-item list-group-item-action active">Manage Meta Details</a>
            </div>
          </div>
          <div class="col-lg-12 pt-3">
            <div class="card">
              <div class="card-body">
                <div class="col-md-12" id="ingsec">
                    @if($product['image']!="")
                        <img src="{{ asset( config('constants.PRODUCT_IMAGE_PATH').$product['image'] ) }}" alt="{{ $product['product_name'] }}" class="img-thumbnail">
                    @else
                        <img src="{{ asset('admin/img/no-image.jpg') }}" alt="{{ $product['product_name'] }}" class="img-thumbnail">
                    @endif
                </div>
              </div>
            </div>
          </div>


        </div>
        <div class="col-lg-9">

          <div class="card">
            <div class="card-body">
                  <h4>{{ $product['product_name'] }}</h4>
                  <p class="h5"><span class="text-primary"> Price</span> &#8377 {{ $product['price'] }}</p>
                  <div class="form-group mt-4">
                    <label for="ptitle">Meta Title <span class="required" aria-required="true"> * </span></label>
                    <input type="text" class="form-control {{($errors->first('meta_title'))?'has-error':''}}" id="ptitle" name="meta_title" value="{{ !empty($meta_details['meta_title'] ) ? $meta_details['meta_title'] : old('meta_title') }}" placeholder="Enter a name of the product.">
                    <span class="error-txt">{{$errors->first('meta_title')}}</span>
                  </div>


                    <div class="form-group">
                        <label for="pagetitle">Meta Keywords</label>
                        <textarea name="meta_keywords" class="form-control" cols="5" rows="10">{{!empty($meta_details['meta_keywords'])? $meta_details['meta_keywords']: old('meta_keywords')}}</textarea>
                      </div>
                        


                  <div class="form-group">
                    <label for="pagetitle">Meta Description</label>
                    <textarea name="meta_description" class="form-control" cols="5" rows="10">{{!empty($meta_details['meta_description'])? $meta_details['meta_description']: old('meta_description')}}</textarea>
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

@endpush
    
@endsection