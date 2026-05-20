<fieldset class="fieldset-border">
    <legend class="legend-border">विवरण</legend>
    <div class="row px-15">
        <div class="col-md-12 form-group">
            {{ html()->label('शिर्षक')->for('title') }} <span>*</span>

            {{ html()->text('title')->class('form-control')->placeholder('Title') }}

            @error('title')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="col-md-12 form-group">
            {{ html()->label('')->for('summary') }}

            {{ html()->textarea('summary')->id('summary')->class('form-control')->rows(2)->placeholder('summary goes here...') }}

            @error('summary')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="col-md-6 form-group">
            {{ html()->label('बर्ष')->for('academic_year_id') }} <span>*</span>

            {{ html()->select('academic_year_id', $data['year_options'], $data['setting']->academic_year_id)->class('form-control') }}

            @error('academic_year_id')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="col-md-6 form-group">
            {{ html()->label('प्रकार')->for('type') }} <span>*</span>

            {{ html()->select('type', $data['type_options'], 'image')->id('gallery_type')->class('form-control') }}

            @error('type')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>


        <div class="col-md-6 form-group">
            <div class="image-container">
                {{ html()->label('माध्यम')->for('image') }}

                {{ html()->file('image[]')->id('image')->multiple() }}

                @error('image')
                    <span class="text-danger"><i>{{ $message }}</i></span>
                @enderror

                <span class="text-default">
                    <p>
                        <i>Files must be less than <strong>10 MB.</strong></i><br>
                        <i>Allowed file types: <strong>png gif jpg jpeg.</strong></i>
                    </p>
                </span>
            </div>

            <div class="video-container">
                {{ html()->label('Video Link (if type is video)')->for('link') }} <span>*</span>

                {{ html()->text('link')->class('form-control')->placeholder('link') }}

                @error('link')
                    <span class="text-danger"><i>{{ $message }}</i></span>
                @enderror
            </div>
        </div>
        <div>
</fieldset>

<fieldset class="fieldset-border">
    <legend class="legend-border">वेवसाइटमा देखाउने </legend>
    <div class="row px-15">
        <div class="col-md-6 form-groiup">
            {{ html()->label('वेवसाईटमा देखाउने हो ?')->for('status') }}

            {{ html()->select('status', $data['publish_options'], 0)->class('form-control') }}

            @error('status')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="col-md-6">
            {{ html()->label('प्रकाशन मिति')->for('date') }}
            {{ html()->text('date')->id('published_date')->class('form-control') }}
            @error('date')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>
    </div>
</fieldset>
