<div class="form-group">
    <input type="submit" value="{{ $name }}" class="btn btn-primary btn-block">    
    @if (isset($helper))
    <small class="form-text text-muted">{{ $helper }}</small>
    @endif
</div>