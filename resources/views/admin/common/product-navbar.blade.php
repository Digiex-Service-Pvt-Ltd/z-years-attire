<div class="list-group">
    <a href="{{ route('admin.product.edit', $product->id) }}" class="list-group-item list-group-item-action {{request()->is('admin/product/edit*')?'active': ''}}" aria-current="true" disabled>Edit Product</a>
    <a href="{{ route('admin.product.varient', $product->id) }}" class="list-group-item list-group-item-action {{request()->is('admin/product/varient*')?'active': ''}}">Manage Varients</a>
    <a href="{{ route('admin.product.images', $product->id) }}" class="list-group-item list-group-item-action {{request()->is('admin/product/images*')?'active': ''}}">Upload Images</a>
    <a href="{{ route('admin.product.meta', $product->id)}}" class="list-group-item list-group-item-action {{request()->is('admin/product/meta*')?'active': ''}}">Manage Meta Details</a>
</div>