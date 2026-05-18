<fieldset class="fieldset-border">
    <legend class="legend-border">कागजात प्रकार विवरण</legend>

    <div class="col-md-12 form-group">
        {{ html()->label('शीर्षक (English)')->for('title') }} <span>*</span>

        {{ html()->text('title')->class('form-control')->placeholder('Title') }}

        @error('title')
            <span class="text-danger"><i>{{ $message }}</i></span>
        @enderror
    </div>

    <div class="col-md-12 form-group">
        {{ html()->label('शीर्षक (नेपाली)')->for('title_ne') }} <span>*</span>

        {{ html()->text('title_ne')->class('form-control')->placeholder('नेपाली शीर्षक') }}

        @error('title_ne')
            <span class="text-danger"><i>{{ $message }}</i></span>
        @enderror
    </div>

    <div class="col-md-12 form-group">
        {{-- Existing image (edit only) --}}
        @isset($document_type)
            @if ($document_type->image)
                <img src="{{ asset('uploads/document_types/' . $document_type->image) }}" width="100">
            @else
                <span class="text-danger">तस्बिर छैन</span>
            @endif
            <br>
        @endisset

        {{ html()->label('तस्बिर')->for('image') }} <span>*</span>

        {{ html()->file('image')->id('image')->class('form-control') }}

        @error('image')
            <span class="text-danger"><i>{{ $message }}</i></span>
        @enderror

        <span class="text-default">
            <p>
                <i>फाइल साइज 5 MB भन्दा कम हुनुपर्छ।</i><br>
                <i>अनुमति प्राप्त प्रकार: png, gif, jpg, jpeg</i>
            </p>
        </span>
    </div>
</fieldset>

<fieldset class="fieldset-border">
    <legend class="legend-border">वेबसाइट प्रदर्शन सेटिङ</legend>

    <div class="row col-md-12">
        <div class="col-md-4 form-group">
            {{ html()->label('क्रम (Display Order)')->for('order') }} <span>*</span>

            {{ html()->number('order')->class('form-control') }}

            @error('order')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>
    </div>

    <div class="row col-md-12">
        <div class="col-md-4 form-group">
            {{ html()->label('वेबसाइटमा प्रकाशित गर्ने?')->for('status') }} <span>*</span>

            {{ html()->select('status', $data['publish_options'])->class('form-control') }}

            @error('status')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>
    </div>
</fieldset>
