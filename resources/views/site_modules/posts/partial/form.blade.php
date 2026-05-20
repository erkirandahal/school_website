<fieldset class="fieldset-border">
    <legend class="legend-border">विवरण</legend>
    <div class="row-auto">
        <div class="col-md-12 form-group">
            {{ html()->label('Title (शिर्षक)')->for('title') }} <span>*</span>

            {{ html()->text('title')->class('form-control')->placeholder('Title') }}

            @error('title')
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
            {{ html()->label('पोस्टको प्रकार')->for('post_category_id') }} <span>*</span>
            {{ html()->select('post_category_id', $data['post_category_options'])->class('form-control') }}
            @error('post_category_id')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="col-md-12 form-group">
            {{ html()->label('सारंश')->for('summary') }}

            {{ html()->textarea('summary')->id('summary')->rows(2)->class('form-control')->placeholder('summary goes here...') }}

            @error('summary')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="col-md-12 form-group">
            {{ html()->label('विस्तृत विवरण')->for('description') }}

            {{ html()->textarea('description')->id('editor')->class('form-control')->placeholder('description goes here...') }}

            @error('description')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="col-md-6 form-group">
            {{ html()->label('फोटो')->for('image') }}
            {{ html()->file('image')->id('image') }}
            @error('image')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
            <span class="text-default">
                <p>
                    <i>फाइल <strong>5 MB.</strong> भन्दा बढी हुन नमिल्ने</i><br>
                    <i>फाइलको प्रकार: <strong>png gif jpg jpeg.</strong></i>
                </p>
            </span>
            @if (isset($post) && $post->image)
                <a href="{{ asset('uploads/posts/' . $post->image) }}" target="_blank">
                    <div class="img-wrapper">
                        <img class="img img-responsive" src="{{ asset('uploads/posts/' . $post->image) }}"
                            alt="No Image">
                    </div>
                </a>
            @else
                <span class="text-danger">फोटो छैनt</span>
            @endif
        </div>

        <div class="col-md-6 form-group">
            {{ html()->label('काजजातहरू')->for('attachment') }}

            {{ html()->file('attachment')->id('attachment') }}

            @error('attachment')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror

            <span class="text-default">
                <p>
                    <i>फाइल <strong>5 MB.</strong> भन्दा बढी हुन नमिल्ने</i><br>
                    <i>फाइलको प्रकार: <strong>doc, docx, xls, xlsx, pdf.</strong></i>
                </p>
            </span>

            @if (isset($post) && $post->attachment)
                <a class="btn btn-sm btn-success" href="{{ asset('uploads/posts/' . $post->attachment) }}">
                    <i class="fa fa-file"></i> view
                </a>
            @else
                <span class="text-danger">कागजात छैन</span>
            @endif
        </div>
    </div>
</fieldset>

<fieldset class="fieldset-border">
    <legend class="legend-border">वेवसाइटमा राख्ने विवरण</legend>

    <div class="col-md-4 form-group">
        {{ html()->label('वेवसाइटमा देखाउने हो ?')->for('status') }} <span>*</span>

        {{ html()->select('status', $data['publish_options'])->class('form-control') }}

        @error('status')
            <span class="text-danger"><i>{{ $message }}</i></span>
        @enderror
    </div>

    <div class="col-md-4 form-group">
        {{ html()->label('पपअपमा देखाउने हो ?')->for('show_on_modal') }} <span>*</span>

        {{ html()->select('show_on_modal', [1 => 'YES', 0 => 'NO'])->class('form-control') }}

        @error('show_on_modal')
            <span class="text-danger"><i>{{ $message }}</i></span>
        @enderror
    </div>

    <div class="col-md-4 form-group">
        {{ html()->label('प्रकाशन मिति')->for('date') }} <span>*</span>

        {{ html()->text('date')->id('published_date')->class('form-control') }}

        @error('date')
            <span class="text-danger"><i>{{ $message }}</i></span>
        @enderror
    </div>
</fieldset>
