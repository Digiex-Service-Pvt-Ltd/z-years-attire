@extends('../admin.layouts.main')

@section('maincontent')


<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Change Password</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item">Change Password</li>
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
      <div class="col-lg-6">
        <div class="card card-secondary card-outline">
          <div class="card-body">
            <form action="{{ route('admin.changepassword.submit') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="exampleInputPassword1">Old Password</label>
                    <input type="password" name="old_password" class="form-control {{($errors->first('old_password'))?'has-error':''}}" id="exampleInputPassword1">
                    <span class="error-txt">{{$errors->first('old_password')}}</span>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword2">New Password</label>
                    <input type="password" name="new_password" class="form-control {{($errors->first('new_password'))?'has-error':''}}" id="exampleInputPassword2">
                    <span class="error-txt">{{$errors->first('new_password')}}</span>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword1">Confirm Password</label>
                  <input type="password" name="new_password_confirmation" class="form-control {{($errors->first('new_password_confirmation'))?'has-error':''}}" id="exampleInputPassword1">
                  <span class="error-txt">{{$errors->first('new_password_confirmation')}}</span>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
          </div>
        </div><!-- /.card -->
      </div>
      <!-- /.col-md-6 -->
      <div class="col-lg-6">
        <div class="card ">
          <div class="card-header">
            <h5 class="m-0">Password Genarator</h5>
          </div>
          <form class="container">
              <div class="form-group">
                <div class="custom-control custom-checkbox my-1 mr-sm-2">
                    <input type="checkbox" class="custom-control-input" id="customControlInline-1">
                    <label class="custom-control-label" for="customControlInline-1">Case sensitivity:<span style="font-weight: 400"> A mix of uppercase (A–Z) and lowercase (a–z) letters<span></label>
                  </div>
              </div>
              <div class="form-group">
                <div class="custom-control custom-checkbox my-1 mr-sm-2">
                    <input type="checkbox" class="custom-control-input" id="customControlInline-2">
                    <label class="custom-control-label" for="customControlInline-2">Symbols:<span style="font-weight: 400"> Special characters like !, @, $, %, ^, &, *, +, #<span></label>
                </div>
              </div>
              <div class="form-group">
                <div class="custom-control custom-checkbox my-1 mr-sm-2">
                    <input type="checkbox" class="custom-control-input" id="customControlInline-3">
                    <label class="custom-control-label" for="customControlInline-3">Numbers:<span style="font-weight: 400"> Digits 0–9 <span></label>
                </div>
              </div>
              <div class="form-group">
                <div class="custom-control custom-checkbox my-1 mr-sm-2">
                    <input type="checkbox" class="custom-control-input" id="customControlInline-4">
                    <label class="custom-control-label" for="customControlInline-4">Length:<span style="font-weight: 400"> At least 12 characters, but 14 or more is better<span></label>
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Genarate</button>
          </form>
            <div class="col-auto my-1">
                <input type="text" class="form-control" placeholder="generated password">
            </div>
        </div>
      </div>
      <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->   
    
@endsection