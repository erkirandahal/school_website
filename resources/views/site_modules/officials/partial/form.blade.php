<fieldset class="fieldset-border">
    <legend class="legend-border">व्यक्तिगत विवरण</legend>
    <div class="row-auto">
        <div class="col-md-4 form-group">
            {{ html()->label('पहिलो नाम')->for('first_name') }} <span>*</span>
            {{ html()->text('first_name')->class('form-control')->placeholder('Name') }}
            @error('first_name')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="col-md-4 form-group">
            {{ html()->label('बिचको नाम')->for('middle_name') }}
            {{ html()->text('middle_name')->class('form-control')->placeholder('Middle Name') }}
            @error('middle_name')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="col-md-4 form-group">
            {{ html()->label('अन्तिम नाम')->for('last_name') }} <span>*</span>
            {{ html()->text('last_name')->class('form-control')->placeholder('Last Name') }}
            @error('last_name')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="col-md-4 form-group">
            {{ html()->label('जन्म मिति (A.D.)')->for('dob') }} <span>*</span>
            {{ html()->text('dob')->id('bs_dob')->attribute('data-date-format', 'yyyy-mm-dd')->class('form-control')->placeholder('YYYY-MM-DD') }}
            @error('dob')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="col-md-4 form-group">
            {{ html()->label('लिङ्ग')->for('gender') }} <span>*</span>
            {{ html()->select('gender', $data['gender_options'])->class('form-control') }}
            @error('gender')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="col-md-4 form-group">
            {{ html()->label('फोटो')->for('image') }}
            {{ html()->file('image') }}
            @error('image')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror

            @if (isset($official) && $official->image)
                <div class="img-wrapper">
                    <img class="img-responsive" src="{{ asset('uploads/officials/' . $official->image) }}"
                        width="80px" alt="Image">
                </div>
            @endif
        </div>
    </div>
</fieldset>

<fieldset class="fieldset-border">
    <legend class="legend-border">ठेगानाको विवरण</legend>
    <div class="row-auto">
        <div class="col-md-3 form-group">
            {{ html()->label('जिल्ला')->for('district') }} <span>*</span>
            {{ html()->text('district')->class('form-control')->placeholder('District') }}
            @error('district')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="col-md-3 form-group">
            {{ html()->label('स्थानीय तहको किसिम')->for('local_level_type_id') }} <span>*</span>
            {{ html()->select('local_level_type_id', $data['lltype_options'])->class('form-control') }}
            @error('local_level_type_id')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="col-md-3 form-group">
            {{ html()->label('स्थानीय तह')->for('municipality') }} <span>*</span>
            {{ html()->text('municipality')->class('form-control')->placeholder('local level name') }}
            @error('municipality')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="col-md-3 form-group">
            {{ html()->label('वडा नं.')->for('ward_no') }} <span>*</span>
            {{ html()->number('ward_no')->class('form-control')->placeholder('Ward No.') }}
            @error('ward_no')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>
    </div>
</fieldset>

<fieldset class="fieldset-border">
    <legend class="legend-border">सम्पर्क विवरण</legend>
    <div class="row-auto">
        <div class="col-md-6 form-group">
            {{ html()->label('इमेल')->for('email') }}
            {{ html()->text('email')->class('form-control')->placeholder('email') }}
            @error('email')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="col-md-6 form-group">
            {{ html()->label('मोबाइल नं.')->for('mobile') }} <span>*</span>
            {{ html()->text('mobile')->class('form-control')->placeholder('mobile') }}
            @error('mobile')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>
    </div>
</fieldset>

<fieldset class="fieldset-border">
    <legend class="legend-border">Other Details</legend>
    <div class="row-auto">
        <div class="col-md-3 form-group">
            {{ html()->label('Year')->for('academic_year_id') }} <span>*</span>
            {{ html()->select('academic_year_id', $data['year_options'], $data['setting']->academic_year_id)->class('form-control') }}
            @error('academic_year_id')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="col-md-3 form-group">
            {{ html()->label('Department')->for('department_id') }} <span>*</span>
            {{ html()->select('department_id', $data['department_options'])->class('form-control') }}
            @error('department_id')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="col-md-3 form-group">
            {{ html()->label('Designation')->for('designation_id') }} <span>*</span>
            {{ html()->select('designation_id', $data['designation_options'])->class('form-control') }}
            @error('designation_id')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="col-md-3 form-group">
            {{ html()->label('Is working')->for('working_status') }} <span>*</span>
            {{ html()->select('working_status', $data['working_status_options'])->class('form-control') }}
            @error('working_status')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="col-md-3 form-group">
            {{ html()->label('Is teaching official')->for('is_teaching_official') }} <span>*</span>
            {{ html()->select('is_teaching_official', $data['teaching_status_options'])->class('form-control') }}
            @error('is_teaching_official')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="col-md-3 form-group">
            {{ html()->label('Date of joining')->for('joining_date') }} <span>*</span>
            {{ html()->text('joining_date')->id('joining_date')->class('form-control')->placeholder('yyyy-mm-dd') }}
            @error('joining_date')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="col-md-3 form-group">
            {{ html()->label('Date of Leaving')->for('leaving_date') }}
            {{ html()->text('leaving_date')->id('leaving_date')->class('form-control')->placeholder('yyyy-mm-dd') }}
            @error('leaving_date')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>
    </div>
</fieldset>

<fieldset class="fieldset-border">
    <legend class="legend-border">Academic Degree Details</legend>
    <div class="row-auto">
        <div class="col-md-3 form-group">
            {{ html()->label('Academic Degree')->for('degree') }}
            {{ html()->text('degree')->class('form-control')->placeholder('Degree') }}
            @error('degree')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>
    </div>
</fieldset>

<fieldset class="fieldset-border">
    <legend class="legend-border">Website Display Options</legend>
    <div class="row-auto">
        <div class="col-md-3 form-group">
            {{ html()->label('Display Order')->for('order') }} <span>*</span>
            {{ html()->number('order')->class('form-control') }}
            @error('order')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="col-md-3 form-group">
            {{ html()->label('Publish on website ?')->for('status') }} <span>*</span>
            {{ html()->select('status', $data['publish_options'], 1)->class('form-control') }}
            @error('status')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="col-md-3 form-group">
            {{ html()->label('Publish on front page ?')->for('show_on_front_page') }} <span>*</span>
            {{ html()->select('show_on_front_page', $data['yes_no_options'], 1)->class('form-control') }}
            @error('show_on_front_page')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>
    </div>
</fieldset>
