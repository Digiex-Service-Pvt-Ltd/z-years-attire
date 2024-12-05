@extends('../admin.layouts.main')

@section('maincontent')

@push('PAGE_ASSETS_CSS')
@endpush
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Attribute Value</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.attributeValue.list', [$value_details->attribute_id, $value_details->id]) }}">Value</a></li>
          <li class="breadcrumb-item active">Edit Value</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <form name="frmedt" action="{{ route('admin.attributeValue.update', [$value_details->attribute_id, $value_details->id]) }}" method="POST">
      {{ csrf_field() }}
      <div class="row">
        <div class="col-lg-7">
          <div class="card card-secondary card-outline">
            <div class="card-header">
                <div class="card-title">Edit Value</div>
            </div>
            <div class="card-body">
               
                  <div class="form-group">
                    <label for="pagetitle">Value Name <span class="required" aria-required="true"> * </span></label>
                    <input type="text" class="form-control {{($errors->first('value_name'))?'has-error':''}}" id="pagetitle" name="value_name" value="{{ $value_details->value_name }}" placeholder="Enter the value name">
                    <span class="error-txt">{{$errors->first('value_name')}}</span>
                  </div>

                  @if($value_details->attribute_id == 1)
                    <div class="form-group">
                        <label for="pagetitle">Hexa Color Code</label>
                        <input type="text" class="form-control {{($errors->first('hexa_color_code'))?'has-error':''}}" id="pagetitle" name="hexa_color_code" value="{{ $value_details->hexa_color_code }}" placeholder="Enter a color hexa code.">
                    </div>
                  @endif

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