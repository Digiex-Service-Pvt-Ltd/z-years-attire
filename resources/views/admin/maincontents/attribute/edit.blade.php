@extends('../admin.layouts.main')

@section('maincontent')

@push('PAGE_ASSETS_CSS')
@endpush
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Attribute</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.attribute.list') }}">Attribute</a></li>
          <li class="breadcrumb-item active">Edit Attribute</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <form name="frmedt" action="{{ route('admin.attribute.update', $attribute_details->id) }}" method="POST">
      {{ csrf_field() }}
      <div class="row">
        <div class="col-lg-7">
          <div class="card card-secondary card-outline">
            <div class="card-header">
                <div class="card-title">Edit Attribute</div>
            </div>
            <div class="card-body">
               
                  <div class="form-group">
                    <label for="pagetitle">Attribute Name</label>
                    <input type="text" class="form-control {{($errors->first('attribute_name'))?'has-error':''}}" id="pagetitle" name="attribute_name" value="{{ $attribute_details->attribute_name }}" placeholder="Enter the attribute name">
                    <span class="error-txt">{{$errors->first('attribute_name')}}</span>
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
    
@endsection