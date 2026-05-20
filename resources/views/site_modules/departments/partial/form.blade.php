<fieldset class="fieldset-border">
    <legend class="legend-border">विवरण</legend>

    <div class="col-md-12 form-group">
        {{ html()->label('शाखाको नाम (English)')->for('title') }} <span>*</span>

        {{ html()->text('title')->class('form-control')->placeholder('Title') }}

        @if ($errors)
            <span class="text-danger"><i>{{ $errors->first('title') }}</i></span>
        @endif
    </div>
    <div class="col-md-12 form-group">
        {{ html()->label('शाखाको नाम (नेपाली)')->for('title_np') }} <span>*</span>

        {{ html()->text('title_np')->class('form-control')->placeholder('Title (नेपाली)') }}

        @if ($errors)
            <span class="text-danger"><i>{{ $errors->first('title_np') }}</i></span>
        @endif
    </div>
</fieldset>

<fieldset class="fieldset-border">
    <legend class="legend-border">प्रणालीको लागि अन्य आवश्यक विवरण</legend>

    <div class="row col-md-12">
        <div class="col-md-4 form-group">
            {{ html()->label('देखाउने क्रम दिनुहोस')->for('order') }} <span>*</span>

            {{ html()->number('order')->class('form-control') }}

            @if ($errors)
                <span class="text-danger"><i>{{ $errors->first('order') }}</i></span>
            @endif
        </div>
    </div>

    <div class="row col-md-12">
        <div class="col-md-4 form-group">
            {{ html()->label('वेवसाइटमा देखाउने हो ?')->for('status') }} <span>*</span>

            {{ html()->select('status', $data['publish_options'])->class('form-control') }}

            @if ($errors)
                <span class="text-danger"><i>{{ $errors->first('status') }}</i></span>
            @endif
        </div>
    </div>
</fieldset>
