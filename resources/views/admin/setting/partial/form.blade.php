<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {{ html()->label('बर्ष')->for('academic_year_id') }} <span>*</span>
            {{ html()->select('academic_year_id', $year_options)->class('form-control') }}
            @error('academic_year_id')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="form-group">
            {{ html()->label('स्थानीय तह')->for('municipality') }} <span>*</span>
            {{ html()->text('municipality')->class('form-control')->placeholder('Local Level') }}
            @error('municipality')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="form-group">
            {{ html()->label('विद्यालयको नाम')->for('office') }} <span>*</span>
            {{ html()->text('office')->class('form-control')->placeholder('Office') }}
            @error('office')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="form-group">
            {{ html()->label('ठेगाना')->for('office_address') }} <span>*</span>
            {{ html()->text('office_address')->class('form-control')->placeholder('Office Address') }}
            @error('office_address')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="form-group">
            {{ html()->label('प्रदेश')->for('province_name') }} <span>*</span>
            {{ html()->text('province_name')->class('form-control')->placeholder('Province Name') }}
            @error('province_name')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="form-group">
            {{ html()->label('जिल्ला')->for('district_name') }} <span>*</span>
            {{ html()->text('district_name')->class('form-control')->placeholder('district') }}
            @error('district_name')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="form-group">
            {{ html()->label('सम्पर्क नं.')->for('phone') }} <span>*</span>
            {{ html()->text('phone')->class('form-control')->placeholder('Phone') }}
            @error('phone')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="form-group">
            {{ html()->label('इमेल')->for('email') }} <span>*</span>
            {{ html()->email('email')->class('form-control')->placeholder('example@gmail.com') }}
            @error('email')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>
    </div>

    <div class="col-md-6">

        <div class="form-group">
            {{ html()->label('लोगो')->for('logo') }}
            {{ html()->file('logo') }}
            @error('logo')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror

            @if (isset($setting) && $setting->logo)
                <div class="mt-1">
                    <img class="img-responsive" src="{{ asset('uploads/setting/' . $setting->logo) }}" height="100"
                        width="100" alt="LOGO">
                </div>
            @endif
        </div>

        <div class="form-group">
            {{ html()->label('वेवसाइटको लागि लोगो')->for('local_logo') }}
            {{ html()->file('local_logo') }}
            @error('local_logo')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror

            @if (isset($setting) && $setting->local_logo)
                <div class="mt-1">
                    <img class="img-responsive" src="{{ asset('uploads/setting/' . $setting->local_logo) }}"
                        height="100" width="100" alt="LOCAL LOGO">
                </div>
            @endif
        </div>

        <div class="form-group">
            {{ html()->label('Favicon')->for('favicon') }}
            {{ html()->file('favicon') }}
            @error('favicon')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror

            @if (isset($setting) && $setting->favicon)
                <div class="mt-1">
                    <img class="img-responsive" src="{{ asset('uploads/setting/' . $setting->favicon) }}"
                        height="100" width="100" alt="FAVICON">
                </div>
            @endif
        </div>

        <div class="form-group">
            {{ html()->label('प्रणालीको नाम')->for('system_name') }} <span>*</span>
            {{ html()->text('system_name')->class('form-control')->placeholder('System Name') }}
            @error('system_name')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="form-group">
            {{ html()->label('प्रणालीको सानो नाम')->for('system_short_name') }} <span>*</span>
            {{ html()->text('system_short_name')->class('form-control')->placeholder('System Short Name') }}
            @error('system_short_name')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

        <div class="form-group">
            {{ html()->label('स्लोगन')->for('tag_line') }} <span>*</span>
            {{ html()->text('tag_line')->class('form-control')->placeholder('System Short Name') }}
            @error('tag_line')
                <span class="text-danger"><i>{{ $message }}</i></span>
            @enderror
        </div>

    </div>
</div>
