
@extends('../admin.layouts.main')

@section('maincontent')


<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Attributes</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
          <li class="breadcrumb-item active">Attributes</li>
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

          <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col">Attribute Name</th>
                <th scope="col" class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              @if(!empty($attributes))
                @php $sl_no = 1; @endphp
                @foreach($attributes as $attribute)
                  <tr>
                    <th scope="row" class="text-center">{{ $sl_no }}</th>
                    <td>{{ $attribute->attribute_name }}</td>
                    <td class="text-center">
                      <div class="dropdown show">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                          <a class="dropdown-item" href="{{ route('admin.attribute.edit', $attribute->id) }}">Edit</a>
                          <a class="dropdown-item" href="{{ route('admin.attributeValue.list', $attribute->id) }}">Manage Values</a>
                          {{-- <a class="dropdown-item delRow" href="javascript:void(0)" data-url="" >Delete</a> --}}
                        </div>
                      </div>
                    </td>
                  </tr>
                  @php $sl_no++ @endphp
                @endforeach
              @else
                <tr>
                  <td scope="row" colspan="5">No records found.</td>
                </tr>
              @endif
            </tbody>
          </table>
        
      </div>

      <div class="col-lg-6">
        <div class="card card-secondary card-outline">
            <div class="card-header">
                <div class="card-title">Add Attribute</div>
            </div>
            <div class="card-body">
                <form name="frmadd" action="{{ route('admin.attribute.add') }}" method="POST">
                {{ csrf_field() }}
                    <div class="form-group">
                        <label for="pagetitle">Page Title</label>
                        <input type="text" class="form-control {{($errors->first('attribute_name'))?'has-error':''}}" id="pagetitle" name="attribute_name" value="{{ old('attribute_name') }}" placeholder="Enter the attribute name.">
                        <span class="error-txt">{{$errors->first('attribute_name')}}</span>
                    </div>
                    <button class="btn btn-primary" type="submit" name="submit" value="submit"><i class="fa fa-check"></i> Submit</button>
                </form>
            </div>
        </div>
      </div> 

    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->   
@push('PAGE_ASSETS_JS')
  {{-- <script>
    $(document).on('click', '.delRow', function(e){
      let obj = $(this);
      let rowURL = obj.data('url');

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
             
              $.ajax({
                    url: rowURL,
                    type: 'DELETE',
                    dataType: 'json',
                    success: function(response) {
                      if(response.status == "success"){
                        toastr.success('Page Management', response.msg);
                        window.location.href = "{{ url('admin/attributes')  }}";
                      }
                      else{
                        toastr.error('Page Management', response.msg);
                      }
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
        }      


      } );
      
    })
  </script> --}}
@endpush    
@endsection