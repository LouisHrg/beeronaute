<div class="form-group">
    {{ Form::label($displayname, null, ['class' => 'control-label']) }}
    <div id="customcontent" name="{{ $name }}" value="{{ $value }}"></div>
    @if (isset($helper))
    <small class="form-text text-muted">{{ $helper }}</small>
    @endif
</div>