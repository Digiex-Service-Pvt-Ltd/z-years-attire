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
            @if( Session::has('error') )
             <p class="alert alert-danger">{{ Session::get('error') }}</p>
            @endif
            <form action="{{ route('admin.changepassword.submit') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="opss">Old Password</label>
                    <input type="password" name="old_password" class="form-control {{($errors->first('old_password'))?'has-error':''}}" id="opss">
                    <span class="error-txt">{{$errors->first('old_password')}}</span>
                </div>

                <div class="form-group">
                    <label for="npass">New Password</label>
                    <input type="password" name="new_password" class="form-control {{($errors->first('new_password'))?'has-error':''}}" id="npass">
                    <span class="error-txt">{{$errors->first('new_password')}}</span>
                </div>

                <div class="form-group">
                  <label for="cpass">Confirm Password</label>
                  <input type="password" name="new_password_confirmation" class="form-control {{($errors->first('new_password_confirmation'))?'has-error':''}}" id="cpass">
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
            <div class="container">
              <ul class="list-group list-group-flush">
                <li class="list-group-item">
                  <div class="custom-control custom-checkbox my-1 mr-sm-2">
                    <input type="checkbox" class="custom-control-input" id="i1" name="chk" value="ABCDEFGHIJKLMNOPQRSTUVWXYZ">
                    <label class="custom-control-label font-weight-normal text-muted" for="i1"><span class="text-dark">UpperCase Letter</span> -  A mix of uppercase (A–Z) letters</label>
                  </div>
                </li>
                <li class="list-group-item">
                  <div class="custom-control custom-checkbox my-1 mr-sm-2">
                    <input type="checkbox" class="custom-control-input" id="i2" name="chk" value="abcdefghijklmnopqrst">
                    <label class="custom-control-label font-weight-normal text-muted" for="i2"><span class="text-dark">LowerCase Letter</span> - A mix of lowercase (a–z) letters</label>
                </div>
                </li>
                <li class="list-group-item">
                  <div class="custom-control custom-checkbox my-1 mr-sm-2">
                    <input type="checkbox" class="custom-control-input" id="i3" name="chk" value="-+*()_%$=#!{}@~[]">
                    <label class="custom-control-label font-weight-normal text-muted" for="i3"><span class="text-dark">Symbols</span> - Special characters like !, @, $, %, ^, &, *, +, #</label>
                </div>
                </li>
                <li class="list-group-item">
                  <div class="custom-control custom-checkbox my-1 mr-sm-2">
                    <input type="checkbox" class="custom-control-input" id="i4" name="chk" value="0123456789">
                    <label class="custom-control-label font-weight-normal text-muted" for="i4"><span class="text-dark">Numbers</span> - Digits 0–9</label>
                </div>
                </li>
                <li class="list-group-item">
                  <div class="d-flex align-items-center justify-content-center">
                    <button type="submit" class="btn btn-outline-secondary" id="gn_btn">Genarate Secure Password to Protect Your Account</button>
                  </div>
                </li>
              </ul>
              
            </div>

            <div id="result" class="input-group mb-3 col-auto my-1 text-center" style="display:none">
              <div id="gentext" class="form-control border-secondary h-100" style="font-weight: 500; font-size:25px;"></div>
              <div class="input-group-append">
                <button id="copy_text" class="btn btn-outline-secondary" type="button">Copy</button>
              </div>
            </div>
        </div>
      </div>
      <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->   

@push('PAGE_ASSETS_JS')
<script>
$(document).ready(function(){

  $('#gn_btn').on('click', function(e){
    e.preventDefault();
    $('#result').show();
    let str = "";
    let numLength = 10;
    let password = "";
    $('input[name="chk"]:checked').each(function(){
      let value = this.value;
      str += value;
    })

    if(str=="")
    {
        $('input[name="chk"]').each(function(){
        let value = this.value;
        str += value;
      })
    }

    for(i=0; i<numLength; i++){
      let index = Math.floor(Math.random() * str.length);
      password += str[index];
    }
    
    $('#gentext').text(password);

  })


  $('#copy_text').on('click', function(){
    const copyText = document.getElementById('gentext').textContent;
    navigator.clipboard.writeText(copyText)
    .then(() => {$('#result').hide();}
)
    .catch(err => console.error('Failed to copy text: ', err));
    })
})
</script>
@endpush
@endsection