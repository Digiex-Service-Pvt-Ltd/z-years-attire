<div class="col-md-6 form-group">
    <input type="{{ $type }}" name="{{ $name }}" class="form-control" placeholder="{{ $placeholderText }}" value="{{ old($name) }}">
    <span class="text-danger">{{ $errors->first($name) }}</span>
</div>