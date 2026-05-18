<fieldset class="fieldset-border">
    <legend class="legend-border">पोस्टका प्रकारहरू</legend>
    <div>
        <div class="col-md-12 form-group">
            {{ html()->label('शीर्षक')->for('title') }} <span>*</span>

            {{ html()->text('title')->class('form-control')->placeholder('शीर्षक') }}

            @error('title')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="col-md-12 form-group">

            {{ html()->label('फोटो')->for('image') }} <span>*</span>
            {{ html()->file('image')->id('image')->class('form-control') }}

            @error('image')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror

            <span class="text-default">
                <p>
                    <i>फाइल साइज अधिकतम <strong>5 MB</strong> हुनुपर्छ।</i><br>
                    <i>अनुमति प्राप्त फाइल प्रकार: <strong>png, gif, jpg, jpeg</strong></i>
                </p>
            </span>

            @if (isset($post_category) && $post_category->image)
                <div class="img-wrapper">
                    <img src="{{ asset('uploads/post_categories/' . $post_category->image) }}" width="100">
                </div>
            @else
                <span class="text-danger">तस्बिर छैन</span>
            @endif
        </div>
    </div>
</fieldset>

<fieldset class="fieldset-border">
    <legend class="legend-border">अन्य विवरण</legend>

    <div class="row-auto">
        <div class="col-md-4 form-group">
            {{ html()->label('क्रम (Dispay Order)')->for('order') }} <span>*</span>

            {{ html()->number('order')->class('form-control') }}

            @error('order')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>
    </div>

    <div class="row-auto">
        <div class="col-md-4 form-group">
            {{ html()->label('वेबसाइटमा प्रकाशित गर्ने हो?')->for('status') }} <span>*</span>

            {{ html()->select('status', $data['publish_options'])->class('form-control') }}

            @error('status')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>
    </div>
</fieldset>
