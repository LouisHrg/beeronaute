<div class="form-group">
    {{ Form::label($displayname, null, ['class' => 'control-label']) }}
    <textarea id="customcontent" name="{{ $name }}" >{{ $value }}</textarea> 
    @if (isset($helper))
    <small class="form-text text-muted">{{ $helper }}</small>
    @endif
</div>