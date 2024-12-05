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
          <li class="breadcrumb-item active">Create Product</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <form name="frmadd" action="{{ route('admin.product.store.main') }}" method="POST" enctype="multipart/form-data">
      {{ csrf_field() }}

      <div class="row">
        <div class="col-lg-3">

          <div class="list-group">
              <button type="button" class="list-group-item list-group-item-action active" aria-current="true" disabled>
                  Main Product
              </button>
              <button type="button" class="list-group-item list-group-item-action" disabled>Manage Varients</button>
              <button type="button" class="list-group-item list-group-item-action" disabled>Upload Images</button>
              <button type="button" class="list-group-item list-group-item-action" disabled>Manage Meta Details</button>
          </div>

        </div>
        <div class="col-lg-9">

          <div class="card card-secondary card-outline">
            <div class="card-body">
               
                  <div class="form-group">
                    <label for="ptitle">Product Name <span class="required" aria-required="true"> * </span></label>
                    <input type="text" class="form-control {{($errors->first('product_name'))?'has-error':''}}" id="ptitle" name="product_name" value="{{ old('product_name') }}" placeholder="Enter a name of the product.">
                    <span class="error-txt">{{$errors->first('product_name')}}</span>
                  </div>

                  <div class="form-group">
                    <label for="slugnm">Slug Name <span class="required" aria-required="true"> * </span></label>
                    <input type="text" class="form-control {{($errors->first('slug'))?'has-error':''}}" id="slugnm" name="slug" value="{{ old('slug') }}" placeholder="Enter slug name">
                    <span class="error-txt">{{$errors->first('slug')}}</span>
                    <small id="emailHelp" class="form-text text-muted">This field is unique, should be a string, lower case and without space. For Ex: embroidered-boat-neck-kurta</small>
                  </div>

                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="slugnm">SKU Code </label>
                        <input type="text" class="form-control" name="sku_code" value="{{ old('sku_code') }}" placeholder="Enter a product SKU code">
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label for="pagetitle">Price <span class="required" aria-required="true"> * </span></label>
                        <input type="text" class="form-control {{($errors->first('price'))?'has-error':''}}" name="price" value="{{ old('price') }}" placeholder="Base Price">
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
                              <option value="{{ $category->id }}">{{ $category->category_name }}</option>
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
                    <textarea name="description" class="form-control" cols="5" rows="10">{{ old('description') }}</textarea>
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
@endpush

<script>
  jQuery(document).ready(function () {
    $('#catid').selectpicker();
  });
</script>
    
@endsection