@extends('../admin.layouts.main')

@section('maincontent')

@push('PAGE_ASSETS_CSS')

@endpush
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Create Page</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.pages.index') }}">Static Pages</a></li>
          <li class="breadcrumb-item active">Create Page</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <form name="frmadd" action="{{ route('admin.pages.store') }}" method="POST">
      {{ csrf_field() }}
      <div class="row">
        <div class="col-lg-7">
          <div class="card">
            <div class="card-header">
                <div class="card-title">Create a Page</div>
            </div>
            <div class="card-body">
               
                  <div class="form-group {{($errors->first('page_title'))?'has-error':''}}">
                    <label for="pagetitle">Page Title</label>
                    <input type="text" class="form-control" id="pagetitle" name="page_title" value="{{ old('page_title') }}" placeholder="Enter page title">
                    <span class="error-txt">{{$errors->first('page_title')}}</span>
                  </div>

                  <div class="form-group {{($errors->first('page_title'))?'has-error':''}}">
                    <label for="slugnm">Slug Name</label>
                    <input type="text" class="form-control" id="slugnm" name="slug" value="{{ old('slug') }}" placeholder="Enter slug name">
                    <span class="error-txt">{{$errors->first('slug')}}</span>
                    <small id="emailHelp" class="form-text text-muted">This field is unique, should be a string, lower case and without space. For Ex: about-us, our-teams etc.</small>
                  </div>

                  <div class="form-group">
                    <label for="pagetitle">Page Description</label>
                    <textarea name="page_content" class="form-control" cols="5" rows="10">{{ old('page_content') }}</textarea>
                  </div>

                  <div class="form-group {{($errors->first('status'))?'has-error':''}}">
                    <label for="pagetitle">Status</label>
                    <select name="status" class="form-control">
                      <option value="">Select an option</option>
                      <option value="active" {{ old('status') == "active" ? "selected='selected'" : ""   }} >Active</option>
                      <option value="inactive" {{ old('status') == "inactive" ? "selected='selected'" : ""   }} >Inactive</option>
                    </select>
                    <span class="error-txt">{{$errors->first('status')}}</span>
                  </div>
                
            </div>
          </div>  
        </div>

        <div class="col-lg-5">
          <div class="card">
            <div class="card-header">
                <div class="card-title">Manage Meta Contents</div>
            </div>
            <div class="card-body">

                <div class="form-group">
                  <label for="metatitle">Meta Title</label>
                  <input type="text" class="form-control" id="metatitle" name="meta_title" value="{{ old('meta_title') }}" placeholder="Enter a meta title">
                </div>
                <div class="form-group">
                  <label for="metakeywords">Meta Keywords</label>
                  <input type="text" class="form-control" id="metakeywords" name="meta_keywords" value="{{ old('meta_keywords') }}" placeholder="Enter meta keywords">
                </div>
                <div class="form-group">
                  <label for="metadesc">Meta Description</label>
                  <input type="text" class="form-control" id="metadesc" name="meta_description" value="{{ old('meta_title') }}" placeholder="Enter meta description">
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