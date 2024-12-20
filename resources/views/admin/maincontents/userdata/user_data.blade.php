
@extends('../admin.layouts.main')

@section('maincontent')


<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Products</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
          <li class="breadcrumb-item active">Product List</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    {{-- <div class="row">
      <div class="col-lg-8">
        <form class="form-inline" action="{{ route('admin.product.list')}}" method="GET">
          <div class="form-group  ">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search" value="{{ $pname }}">
          </div>
          <select class="custom-select mr-sm-2" name="category" onchange="this.form()">
            <option value="" {{ $filterCategory == '' ? 'selected' : '' }}>Search By Category</option>
              @foreach($categories as $category)
                <option value="{{ $category->category_name }}" 
                  {{ $filterCategory == $category->category_name ? 'selected' : '' }}>
                  {{ $category->category_name }}
                </option>
              @endforeach
          </select>
          <select class="custom-select mr-sm-2" name="status" onchange="this.form()">
            <option selected value=""{{$filterStatus == '' ? 'selected':''}}>Search By Status</option>
            <option value="0"{{$filterStatus == '0' ? 'selected':''}}>Published</option>
            <option value="1"{{$filterStatus == '1' ? 'selected':''}}>Unpublished</option>
          </select>
          <button class="btn btn-outline-primary my-2 my-sm-0" type="submit" value="search">Search</button>
        </form>
      </div>
      <div class="col-lg-4">
        <a class="btn btn-outline-primary float-right" href="{{ route('admin.product.create.main') }}" role="button" style="margin-bottom: 10px;"><i class="fas fa-plus"></i> Add</a>
      </div>
    </div> --}}
    <div class="row">
      <div class="col-lg-12">

          <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col" class="text-center">#</th>
                <th scope="col">User Name</th>
                <th scope="col">User Email</th>
                <th scope="col" class="text-center">User Password</th>
              </tr>
            </thead>
            <tbody>
                @if(!empty($userdetails))
                    @php $sl_no = 1; @endphp
                    @foreach($userdetails as $user)
                        <tr>
                            <th scope="row" class="text-center">{{ $sl_no }}</th>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->password}}</td>
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

    </div>
    <!-- /.row -->
    <!-- Display pagination links -->
    {{-- <div class="d-flex justify-content-center">
      {{ $products->links() }}
    </div> --}}
  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->   
@push('PAGE_ASSETS_JS')
  <script>
    $(document).on('click', '.delRow', function(e){
      e.preventDefault();
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this product and it's varients and images!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then( (result)=>{

        if(result.isConfirmed) {

          let obj = $(this);
          let productId = obj.attr('pid');
          $('#frdt'+productId).submit();   
        }      


      } );
      
    })
  </script>

<style>
  .w-5{
    display: none
  }
  .w-4{
    display:none
  }
</style>
@endpush    
@endsection