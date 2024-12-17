
<div class="modal-dialog modal-lg">
    <form id="updateForm" class="form-horizontal">
    <input type="hidden" id="cid" name="id" value="{{ $cat_details->id }}" >
    <input type="hidden" id="exnm" name="existing_img" value="{{ $cat_details->image }}" >   
    <div class="modal-content">
        <div class="modal-header bg-secondary">
            <h5 class="modal-title" id="recordModalLabel">Edit Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-body">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="text">Category Name <span class="required" aria-required="true"> * </span></label>
                                                <input type="text" class="form-control item-menu" name="category_name" id="category_name" placeholder="Enter a category name" value="{{ $cat_details->category_name }}">
                                                <span class="error-txt" id="sp_category_name"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="text">Slug Name <span class="required" aria-required="true"> * </span></label>
                                                <input type="text" class="form-control item-menu" name="slug" id="slug" placeholder="Enter a slug name" value="{{ $cat_details->slug }}">
                                                <span class="error-txt" id="sp_slug"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="target">Choose Image</label>
                                                <input type="file" class="form-control" name="image" id="image">
                                                <span class="error-txt" id="sp_image"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="href">Mark as Featured Category? <span class="required" aria-required="true"> * </span></label>
                                                <select name="is_featured" id="is_featured" class="form-control item-menu">
                                                    <option value="">Select an option</option>
                                                    <option value="1" {{ ( $cat_details->is_featured == "1") ? 'selected="selected"' : '' }} >Yes</option>
                                                    <option value="0" {{ ( $cat_details->is_featured == "0") ? 'selected="selected"' : '' }}>No</option>
                                                </select>
                                                <span class="error-txt" id="sp_is_featured"></span>
                                                <small class="text-info"><strong>Featured category will display at the home page of the site.</strong></small>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="target">Filtering Search </label>
                                                <select class="form-control selectpicker" id="fsa1" name="filtering_attribute_search[]" multiple>
                                                    @foreach ($attributes as $attribute)
                                                        @php 
                                                            $selected = "";
                                                            if(!empty($cat_details->filtering_attribute_search))
                                                            {
                                                                $fsarr = json_decode($cat_details->filtering_attribute_search);
                                                                $selected = ( in_array($attribute->id, $fsarr) ) ? 'selected="selected"' : "";
                                                            }
                                                        @endphp
                                                        <option value="{{ $attribute->id }}" {{ $selected }} >{{ $attribute->attribute_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="target">Status <span class="required" aria-required="true"> * </span></label>
                                                <select name="status" id="status" class="form-control item-menu">
                                                    <option value="">Select a status</option>
                                                    <option value="1" {{ ($cat_details->status=='1')?'selected="selected"':'' }}>Active</option>
                                                    <option value="0" {{ ($cat_details->status=='0')?'selected="selected"':'' }}>Inactive</option>
                                                </select>
                                                <span class="error-txt" id="sp_status"></span>
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                </div>
                            
                        </div>    
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="target">Meta Title</label>
                                    <textarea class="form-control" name="meta_title" cols="10" rows="2" id="">{{ $cat_details->meta_title }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="target">Meta Keywords</label>
                                    <textarea class="form-control" name="meta_keywords" cols="10" rows="2" id="">{{ $cat_details->meta_keywords }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="target">Meta Description</label>
                                    <textarea class="form-control" name="meta_description" cols="10" rows="2" id="">{{ $cat_details->meta_description }}</textarea> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="col-md-12" id="ingsec">
                                @if($cat_details->image!="")
                                    <img src="{{ asset( config('constants.CATEGORY_IMAGE_PATH').$cat_details->image ) }}" alt="{{ $cat_details->category_name }}" class="img-thumbnail">
                                    <button type="button" class="btn btn-primary" id="dtimg"><i class="fa fa-times"></i> Remove Image</button>
                                    @else
                                    <img src="{{ asset('admin/img/no-image.jpg') }}" alt="{{ $cat_details->category_name }}" class="img-thumbnail">
                                @endif
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success" id="btnsubmit" name="submit" value="submit"><i class="fa fa-check"></i> Submit</button>
            <button class="btn btn-danger" type="button"><i class="fa fa-close"></i> Cancel</button>
          </div>
    </div>
    </form>
</div>

<script>
jQuery(document).ready(function () {

    $('#fsa1').selectpicker();

    // Update the record via AJAX
    $('#updateForm').on('submit', function(e) {
        
        e.preventDefault();
        //var formData = $(this).serialize();
        let form = $("#updateForm")[0];
        let formdata = new FormData(form);
        $('#btnsubmit').prop('disabled', true);

        $.ajax({
                url: "{{ route('admin.category.update') }}",
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success: function(response) {
                    if(response.status == "success"){
                        toastr.success('Success', response.msg);
                        window.location.href = '{{ route("admin.category.list") }}';
                    }
                    else{
                        let errObj = response.errors;
                        $.each(errObj, function(key, value){
                            $('#sp_'+key).html(value[0]);
                            $('#'+key).addClass('has-error');
                        });
                    }

                    $('#btnsubmit').prop('disabled', false);
                    
                },
                error: function() {
                    $('#btnsubmit').prop('disabled', flase);
                    alert('Failed to update record.');
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

    });

   //Remove Image
   $('#dtimg').on('click', function(e){
    e.preventDefault();
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
                    let category_id = $('#cid').val();
                    let image_name = $('#exnm').val();
                    $.ajax({
                        url: "{{ route('admin.category.delete_image') }}",
                        type: 'POST',
                        data: {catId:category_id, imgname: image_name},
                        success: function(response) {
                            console.log(response);
                            if(response.status == "success"){
                                $('#exnm').val('');
                                toastr.success('Success', response.msg);
                                $('#ingsec').html('<img src="{{ asset("admin/img/no-image.jpg") }}" alt="{{ $cat_details->category_name }}" class="img-thumbnail">');
                            }
                            else{
                                toastr.error('Category',response.msg);
                            }
                            
                        },
                        error: function(err) {
                            console.log(err.responseText);
                            console.log(typeof(responseText) );
                            toastr.error('Category', err.responseText.message);
                            
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                }      


            });

   });

});
</script>
