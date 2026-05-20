<fieldset class="fieldset-border">
    <legend class="legend-border">विवरण</legend>

    <div class="col-md-12 form-group">
        {{ html()->label('प्रकार')->for('type') }} <span>*</span>

        {{ html()->select('type', $data['type_options'])->class('form-control') }}

        @error('type')
            <span class="text-danger"><i>{{ $message }}</i></span>
        @enderror
    </div>

    <div class="col-md-12 form-group">
        {{ html()->label('शिर्षक')->for('title') }}

        {{ html()->text('title')->class('form-control')->placeholder('Title') }}

        @error('title')
            <span class="text-danger"><i>{{ $message }}</i></span>
        @enderror
    </div>

    <div class="col-md-12 form-group">
        {{ html()->label('iFrame')->for('iframe') }} <span>*</span>

        {{ html()->textarea('iframe')->class('form-control')->placeholder('<iframe>') }}

        @error('iframe')
            <span class="text-danger"><i>{{ $message }}</i></span>
        @enderror
    </div>
</fieldset>

<fieldset class="fieldset-border">
    <legend class="legend-border">वेवसाइटको लागि विवरण</legend>

    <div class="row col-md-12">
        <div class="col-md-4 form-group">
            {{ html()->label('वेवसाइटमा देखाउने हो ?')->for('status') }} <span>*</span>

            {{ html()->select('status', $data['publish_options'])->class('form-control') }}

            @error('status')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>
    </div>
</fieldset>
