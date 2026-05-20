<div class="form-group">
    {{ html()->label('पद (English)')->for('name') }} <span>*</span>

    {{ html()->text('name')->class('form-control')->placeholder('Name')->autofocus() }}

    @error('name')
        <span class="text-danger"><i>{{ $message }}</i></span>
    @enderror
</div>
<div class="form-group">
    {{ html()->label('पद (नेपाली)')->for('name') }} <span>*</span>

    {{ html()->text('name_np')->class('form-control')->placeholder('Name')->autofocus() }}

    @error('name_np')
        <span class="text-danger"><i>{{ $message }}</i></span>
    @enderror
</div>

<div class="form-group">
    {{ html()->label('Order')->for('order') }} <span>*</span>

    {{ html()->number('order')->class('form-control')->placeholder('order') }}

    @error('order')
        <span class="text-danger"><i>{{ $message }}</i></span>
    @enderror
</div>
