@extends('../admin.layouts.main')
@push('PAGE_ASSETS_CSS')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endpush
@section('maincontent')

<style type="text/css">
.modal-lg{ width: 960px !important; }
</style>


<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Categories</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Category</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>

<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">

        <!-- ------------------------------------------- -->
        <!-- -------- Add Category Section Start ------- -->
        <!-- ------------------------------------------- -->
        <div class="col-lg-5">
            <div class="card card-secondary card-outline">
                <div class="card-header">
                    <div class="card-title">Create Category</div>
                </div>
                
                <div class="card-body">
                <form action="{{ route('admin.category.insert') }}" method="POST" id="frmAdd" class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="text">Category Name <span class="required" aria-required="true"> * </span></label>
                                        <input type="text" class="form-control item-menu {{ ($errors->first('category_name'))?'has-error':'' }}" name="category_name" placeholder="Enter a category name" value="{{ old('category_name') }}">
                                        <span class="error-txt">{{$errors->first('category_name')}}</span>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="text">Slug Name <span class="required" aria-required="true"> * </span></label>
                                        <input type="text" class="form-control item-menu {{ ($errors->first('slug'))?'has-error':'' }}" name="slug" placeholder="Enter a slug name" value="{{ old('slug') }}">
                                        <span class="error-txt">{{$errors->first('slug')}}</span>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="target">Select Parent</label>
                                        <select name="parent_id" class="form-control item-menu">
                                            <option value="0">Leave it, if you set a parent category</option>
                                            @if(!empty($category_list))
                                                @foreach ($category_list as $cat)
                                                    <option value="{{ $cat->id }}" {{ (old('parent_id') == $cat->id)?'selected="selected"':'' }} >{{ $cat->category_name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="target">Choose Image</label>
                                        <input type="file" class="form-control" name="image" id="image">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="href">Mark as Featured Category? <span class="required" aria-required="true"> * </span></label>
                                        <select name="is_featured" class="form-control item-menu">
                                            <option value="">Select an option</option>
                                            <option value="1" {{ (old('is_featured') == "1") ? 'selected="selected"' : '' }} >Yes</option>
                                            <option value="0" {{ (old('is_featured') == "0") ? 'selected="selected"' : '' }}>No</option>
                                        </select>
                                        <span class="error-txt">{{ $errors->first('is_featured') }}</span>
                                        <small style="color:#a99a92"><strong>Featured category will display at the home page of the site.</strong></small>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="target">Filtering Search </label>
                                        <select class="form-control selectpicker" id="fsa" name="filtering_attribute_search[]" multiple>
                                            @foreach ($attributes as $attribute)
                                                <option value="{{ $attribute->id }}">{{ $attribute->attribute_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="target">Status <span class="required" aria-required="true"> * </span></label>
                                        <select name="status" class="form-control item-menu {{ ($errors->first('status'))?'has-error':'' }}">
                                            <option value="">Select a status</option>
                                            <option value="1" {{ (old('status')=='1')?'selected="selected"':'' }}>Active</option>
                                            <option value="0" {{ ( old('status')=='0' )?'selected="selected"':'' }}>Inactive</option>
                                        </select>
                                        <span class="error-txt">{{ $errors->first('status') }}</span>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="target">Meta Title</label>
                                        <textarea class="form-control" name="meta_title" cols="10" rows="2">{{ old('meta_title') }}</textarea> 
                                        <span>{{ $errors->first('meta_title') }}</span>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="target">Meta Keywords</label>
                                        <textarea class="form-control" name="meta_keywords" cols="10" rows="2">{{ old('meta_keywords') }}</textarea> 
                                        <span>{{ $errors->first('meta_keywords') }}</span>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="target">Meta Description</label>
                                        <textarea class="form-control" name="meta_description" cols="10" rows="2">{{ old('meta_description') }}</textarea> 
                                        <span>{{ $errors->first('meta_description') }}</span>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                        <div class="form-actions text-center">
                            <button class="btn btn-success" type="submit" name="submit" value="submit"><i class="fa fa-check"></i> Submit</button>
                            <a href="{{ route('admin.category.list') }}"><button class="btn btn-danger" type="button"><i class="fa fa-close"></i> Cancel</button>
                            </a>
                        </div>
                    </form>
                </div>    
            </div>
        </div>
        
        <!-- ------------------------------------------- -->
        <!-- -------- Add Category Section End --------- -->
        <!-- ------------------------------------------- -->

        <!-- ------------------------------------------- -->
        <!-- ------- List Category Section Start ------- -->
        <!-- ------------------------------------------- -->  
      <div class="col-lg-7">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Category Listing</div>
            </div>
            <div class="card-body">
                @if(!empty($listCategory))
                    <div class="col-lg-12">
                        <ul id="myEditor" class="sortableLists list-group"></ul>
                    </div>
                    <div class="col-lg-12">
                        <button id="btnSaveChanges" type="button" class="btn btn-success pull-right" style="margin-top: 10px;"><i class="fas fa-check-square"></i> Save Changes</button>
                        <form id="frmSaveChng" action="{{ route('admin.category.savechanges') }}" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" id="outputStr" name="output_string" >
                        </form>
                    </div>
                @else
                    <p style="text-align: center; margin:22px;"><span style="font-size: 20px; color:#cccccc">No data found.</span></p>
                @endif
            </div>
        </div>
      </div>
        <!-- ------------------------------------------- -->
        <!-- ------- List Category Section End --------- -->
        <!-- ------------------------------------------- -->


    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content --> 


<!-- ############################################### -->
<!-- ######## Modal is defined to edit menu ######## -->
<div class="modal fade mdlclass" id="recordModal" tabindex="-1" aria-labelledby="recordModalLabel" aria-hidden="true"></div>
<!-- ################# Modal End ################### -->
<!-- ############################################### -->



@push('PAGE_ASSETS_JS')

<script type="text/javascript" src="{{ asset('bootstrap-iconpicker/js/jquery-menu-editor.js') }}"></script>
<!-- Bootstrap-Iconpicker Bundle -->
<script type="text/javascript" src="{{ asset('bootstrap-iconpicker/js/bootstrap-iconpicker.bundle.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>


<script>
    jQuery(document).ready(function () {

        $('#fsa').selectpicker();
        
        //$('#route_name, #parent_id').select2();
        var arrayjson = {!! json_encode($listCategory) !!}
        
        // sortable list options
        var sortableListOptions = {
            maxLevel: 1,
            placeholderCss: {'background-color': "#cccccc"}
        };

        var editor = new MenuEditor('myEditor', {listOptions: sortableListOptions});
        editor.setData(arrayjson);
        editor.setForm($('#frmAdd'));

        $('#btnSaveChanges').on('click', function(){
            var str = editor.getString();
            $("#outputStr").val(str);
            $('#frmSaveChng').submit();
        });

        //Edit Menu Row
        $('.btnEditNew').on('click', function(e){
            e.preventDefault();
            let catID = $(this).closest('li').attr('data-id');
            //alert(catID);
            //Get menu details respect to menu id
            $.ajax({
                    url: 'category/' + catID,
                    type: 'GET',
                    success: function(data) {
                        //console.log(data);
                        $('#recordModal').html(data);
                        $('#recordModal').modal('show');
                    },
                    error: function() {
                        alert('Failed to fetch record data.');
                    }
            });
            
        });

        
        

        //-----------------------------------------------------//

        //Delete Menu Row
        $('.btnRemoveNew').on('click', function(e){
            
            e.preventDefault();
            let catID = $(this).closest('li').attr('data-id');

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
                        url: '{!! route('admin.category.delete') !!}',
                        type: 'POST',
                        data: {catId:catID},
                        success: function(response) {
                            console.log(response);
                            if(response.response_code == 200){
                                toastr.success('Category', response.message);
                                window.location.href = "{{ url('admin/category')  }}";
                            }
                            else{
                                toastr.danger('Category',response.message);
                            }
                            
                        },
                        error: function() {
                            toastr.danger('Category', 'Failed to delete record.');
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                }      


            });

        });

        //-----------------------------------------------------//



        
    });
</script>
@endpush

@endsection