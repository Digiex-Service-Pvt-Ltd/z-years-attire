
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header bg-secondary">       
            <h5 class="modal-title card-mychange" id="recordModalLabel">Uploaded Images</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            
        </div>
        <div class="modal-body">
            @if(!empty($varient_product) && $varient_product->productImages->isNotEmpty())
                <div class="row">
                    @foreach($varient_product->productImages as $image)
                            <div class="col-lg-3 p-2 text-center" id="">
                                <div class="image-container">
                                    <img class="responsive-image" src="{{ asset( config('constants.PRODUCT_IMAGE_PATH').$image->image_name ) }}" alt="{{ $image->image_name }}" class="img-thumbnail">
                                </div>
                                <button class="btn btn-outline-danger mt-1 dtlimg" imgId="{{ $image->id }}"><i class="fa fa-trash"></i>  Delete Image</button>
                            </div>
                    @endforeach
                </div>
            @else
                <a href="{{ route('admin.product.image',{$product_id})}}" class="text-center text-secondary">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                    No Image Found Please Add Image
                </a>
            @endif

        </div>
    </div>
  </div>

<script>
// Image Delete function
jQuery(document).ready(function () {
      $('.dtlimg').on('click', function(e){


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

                    e.preventDefault();
                    let thisObj = $(this);
                    let imageId = thisObj.attr('imgid');
                    thisObj.attr('disabled', true);
                    
                    $.ajax({
                          url: "{{ route('admin.product.images.delete') }}",
                          type: 'POST',
                          data: {imageId: imageId},
                          success: function(response) {
                              
                              if(response.status == "success"){
                                thisObj.attr('disabled', false);
                                thisObj.parent().remove();
                                toastr.success('Success', response.msg);
                                
                              }
                              else{
                                thisObj.attr('disabled', false);
                                  toastr.error('Product',response.msg);
                              }
                              
                          },
                          error: function(err) {
                              console.log(err.responseText);
                              console.log(typeof(responseText) );
                              toastr.error('Product', err.responseText.message);
                              
                          },
                          headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          }
                      });


                  }

                })
      })       
  })


</script>
