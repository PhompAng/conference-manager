@extends('home')
@section('body')
    @if(!isset($conf->paper_deadline) || \Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($conf->paper_deadline)))
        <h1 class="text-center">Time Up!!</h1>
    @elseif($conf->areas == null || $conf->areas == '')
        <h1 class="text-center">Areas is Empty</h1>
    @else
        <form id="form" action="{{ URL::to($prefix.'/paper') }}" method="POST" enctype="multipart/form-data" role="form" class="form-horizontal">

            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('title') ? ' has-error':'' }}">
                <div class="row">
                    <div class="col-md-12">
                        <label for="title" class="col-md-2 control-label">Title <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></label>

                        <div class="col-md-10">
                            <input type="text" id="title" class="form-control" name="title" value="{{ old('title') }}" required autofocus>

                            @if($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group{{ $errors->has('abstract') ? ' has-error':'' }}">
                <div class="row">
                    <div class="col-md-12">
                        <label for="abstract" class="col-md-2 control-label">Abstract <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></label>

                        <div class="col-md-10">
                            <textarea id="abstract" class="form-control" name="abstract" required>{{ old('abstract') }}</textarea>

                            @if($errors->has('abstract'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('abstract') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group{{ $errors->has('area') ? " has-error":"" }}">
                <div class="row">
                    <div class="col-md-12">
                        <label for="area" class="col-md-2 control-label">Area <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></label>

                        <div class="col-md-10">
                            <select id="area" class="form-control" name="area" required>
                                @foreach($conf->areas as $area)
                                    <option value="{{$area}}" {{old('area') == $area ? "selected":""}}>{{$area}}</option>
                                @endforeach
                            </select>
                        </div>
                        @if($errors->has('area'))
                            <span class="help-block">
                            <strong>{{ $errors->first('area') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group{{ $errors->has('topics') ? " has-error":"" }}">
                <div class="row">
                    <div class="col-md-12">
                        <label for="topics" class="col-md-2 control-label">
                            Keywords <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup>
                        </label>

                        <div class="col-md-10">
                            <select id="topics" class="form-control" name="topics[]" required multiple>
                            </select>
                        </div>
                        @if($errors->has('topics'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('topics') }}</strong>
                                </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group{{ $errors->has('file') ? " has-error":"" }}">
                <div class="row">
                    <div class="col-md-12">
                        <label for="file" class="col-md-2 control-label">File <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></label>

                        <div class="col-md-10">
                            <div class="input-group">
                                <label class="input-group-btn">
                                <span class="btn btn-primary">
                                    Browse&hellip; <input type="file" id="file" name="file" style="display: none;">
                                </span>
                                </label>
                                <input type="text" class="form-control" readonly>
                            </div>
                            <span class="help-block">
                                <strong>PDF File only</strong>
                            @if($errors->has('file'))
                                <strong>{{ $errors->first('file') }}</strong>
                            @endif
                            </span>
                        </div>

                    </div>
                </div>
            </div>

            {{--@if(isset($presentation))--}}
                <div class="form-group{{ $errors->has('presentation') ? " has-error":"" }}">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="presentation" class="col-md-2 control-label">Presentation <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></label>

                            <div class="col-md-10">
                                <label class="radio-inline">
                                    <input type="radio" name="presentation" id="presentation1" value="1" {{old('presentation') == 1 ? "checked":""}} required> Oral Presentation
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="presentation" id="presentation2" value="2" {{old('presentation') == 2 ? "checked":""}} required> Poster
                                </label>
                                @if($errors->has('presentation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('presentation') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            {{--@endif--}}

            <div class="form-group{{ $errors->has('authors_name') || $errors->has('authors_affiliation') || $errors->has('authors_country') || $errors->has('authors_email') || $errors->has('author_co_author') ? " has-error":"" }}">
                <div class="row">
                    <div class="col-md-12">
                        <label for="authors" class="col-md-2 control-label">Authors <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></label>

                        <div class="col-md-10">
                            <div class="well authors">
                                <div class="author_data">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="authors_name" class="col-md-2 control-label">Name <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></label>
                                                <div class="col-md-10">
                                                    <input id="authors_name" name="authors_name[]" type="text" class="form-control" value="{{App\User::getAcademicPosition($user->academic_position)}} {{App\User::getTitle($user->title)}} {{$user->name}} {{$user->family_name}} " required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="authors_affiliation" class="col-md-2 control-label">Affiliation  <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></label>
                                                <div class="col-md-10">
                                                    <input id="authors_affiliation" name="authors_affiliation[]" type="text" class="form-control" value="{{$user->affiliation}}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="authors_country" class="col-md-2 control-label">Country  <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></label>
                                                <div class="col-md-10">
                                                    <select class="form-control" name="authors_country[]" required>
                                                        <option value="Afghanistan" {{$user->country == "Afghanistan" ? "selected":""}}>Afghanistan</option>
                                                        <option value="Aland Islands" {{$user->country == "Aland Islands" ? "selected":""}}>Aland Islands</option>
                                                        <option value="Albania" {{$user->country == "Albania" ? "selected":""}}>Albania</option>
                                                        <option value="Algeria" {{$user->country == "Algeria" ? "selected":""}}>Algeria</option>
                                                        <option value="American Samoa" {{$user->country == "American Samoa" ? "selected":""}}>American Samoa</option>
                                                        <option value="Andorra" {{$user->country == "Andorra" ? "selected":""}}>Andorra</option>
                                                        <option value="Angola" {{$user->country == "Angola" ? "selected":""}}>Angola</option>
                                                        <option value="Anguilla" {{$user->country == "Anguilla" ? "selected":""}}>Anguilla</option>
                                                        <option value="Antarctica" {{$user->country == "Antarctica" ? "selected":""}}>Antarctica</option>
                                                        <option value="Antigua" {{$user->country == "Antigua" ? "selected":""}}>Antigua</option>
                                                        <option value="Argentina" {{$user->country == "Argentina" ? "selected":""}}>Argentina</option>
                                                        <option value="Armenia" {{$user->country == "Armenia" ? "selected":""}}>Armenia</option>
                                                        <option value="Aruba" {{$user->country == "Aruba" ? "selected":""}}>Aruba</option>
                                                        <option value="Australia" {{$user->country == "Australia" ? "selected":""}}>Australia</option>
                                                        <option value="Austria" {{$user->country == "Austria" ? "selected":""}}>Austria</option>
                                                        <option value="Azerbaijan" {{$user->country == "Azerbaijan" ? "selected":""}}>Azerbaijan</option>
                                                        <option value="Bahamas" {{$user->country == "Bahamas" ? "selected":""}}>Bahamas</option>
                                                        <option value="Bahrain" {{$user->country == "Bahrain" ? "selected":""}}>Bahrain</option>
                                                        <option value="Bangladesh" {{$user->country == "Bangladesh" ? "selected":""}}>Bangladesh</option>
                                                        <option value="Barbados" {{$user->country == "Barbados" ? "selected":""}}>Barbados</option>
                                                        <option value="Barbuda" {{$user->country == "Barbuda" ? "selected":""}}>Barbuda</option>
                                                        <option value="Belarus" {{$user->country == "Belarus" ? "selected":""}}>Belarus</option>
                                                        <option value="Belgium" {{$user->country == "Belgium" ? "selected":""}}>Belgium</option>
                                                        <option value="Belize" {{$user->country == "Belize" ? "selected":""}}>Belize</option>
                                                        <option value="Benin" {{$user->country == "Benin" ? "selected":""}}>Benin</option>
                                                        <option value="Bermuda" {{$user->country == "Bermuda" ? "selected":""}}>Bermuda</option>
                                                        <option value="Bhutan" {{$user->country == "Bhutan" ? "selected":""}}>Bhutan</option>
                                                        <option value="Bolivia" {{$user->country == "Bolivia" ? "selected":""}}>Bolivia</option>
                                                        <option value="Bosnia" {{$user->country == "Bosnia" ? "selected":""}}>Bosnia</option>
                                                        <option value="Botswana" {{$user->country == "Botswana" ? "selected":""}}>Botswana</option>
                                                        <option value="Bouvet Island" {{$user->country == "Bouvet Island" ? "selected":""}}>Bouvet Island</option>
                                                        <option value="Brazil" {{$user->country == "Brazil" ? "selected":""}}>Brazil</option>
                                                        <option value="British Indian Ocean Trty." {{$user->country == "British Indian Ocean Trty." ? "selected":""}}>British Indian Ocean Trty.</option>
                                                        <option value="Brunei Darussalam" {{$user->country == "Brunei Darussalam" ? "selected":""}}>Brunei Darussalam</option>
                                                        <option value="Bulgaria" {{$user->country == "Bulgaria" ? "selected":""}}>Bulgaria</option>
                                                        <option value="Burkina Faso" {{$user->country == "Burkina Faso" ? "selected":""}}>Burkina Faso</option>
                                                        <option value="Burundi" {{$user->country == "Burundi" ? "selected":""}}>Burundi</option>
                                                        <option value="Caicos Islands" {{$user->country == "Caicos Islands" ? "selected":""}}>Caicos Islands</option>
                                                        <option value="Cambodia" {{$user->country == "Cambodia" ? "selected":""}}>Cambodia</option>
                                                        <option value="Cameroon" {{$user->country == "Cameroon" ? "selected":""}}>Cameroon</option>
                                                        <option value="Canada" {{$user->country == "Canada" ? "selected":""}}>Canada</option>
                                                        <option value="Cape Verde" {{$user->country == "Cape Verde" ? "selected":""}}>Cape Verde</option>
                                                        <option value="Cayman Islands" {{$user->country == "Cayman Islands" ? "selected":""}}>Cayman Islands</option>
                                                        <option value="Central African Republic" {{$user->country == "Central African Republic" ? "selected":""}}>Central African Republic</option>
                                                        <option value="Chad" {{$user->country == "Chad" ? "selected":""}}>Chad</option>
                                                        <option value="Chile" {{$user->country == "Chile" ? "selected":""}}>Chile</option>
                                                        <option value="China" {{$user->country == "China" ? "selected":""}}>China</option>
                                                        <option value="Christmas Island" {{$user->country == "Christmas Island" ? "selected":""}}>Christmas Island</option>
                                                        <option value="Cocos (Keeling) Islands" {{$user->country == "Cocos (Keeling) Islands" ? "selected":""}}>Cocos (Keeling) Islands</option>
                                                        <option value="Colombia" {{$user->country == "Colombia" ? "selected":""}}>Colombia</option>
                                                        <option value="Comoros" {{$user->country == "Comoros" ? "selected":""}}>Comoros</option>
                                                        <option value="Congo" {{$user->country == "Congo" ? "selected":""}}>Congo</option>
                                                        <option value="Congo, Democratic Republic of the" {{$user->country == "Congo, Democratic Republic of the" ? "selected":""}}>Congo, Democratic Republic of the</option>
                                                        <option value="Cook Islands" {{$user->country == "Cook Islands" ? "selected":""}}>Cook Islands</option>
                                                        <option value="Costa Rica" {{$user->country == "Costa Rica" ? "selected":""}}>Costa Rica</option>
                                                        <option value="Cote d'Ivoire" {{$user->country == "Cote d'Ivoire" ? "selected":""}}>Cote d'Ivoire</option>
                                                        <option value="Croatia" {{$user->country == "Croatia" ? "selected":""}}>Croatia</option>
                                                        <option value="Cuba" {{$user->country == "Cuba" ? "selected":""}}>Cuba</option>
                                                        <option value="Cyprus" {{$user->country == "Cyprus" ? "selected":""}}>Cyprus</option>
                                                        <option value="Czech Republic" {{$user->country == "Czech Republic" ? "selected":""}}>Czech Republic</option>
                                                        <option value="Denmark" {{$user->country == "Denmark" ? "selected":""}}>Denmark</option>
                                                        <option value="Djibouti" {{$user->country == "Djibouti" ? "selected":""}}>Djibouti</option>
                                                        <option value="Dominica" {{$user->country == "Dominica" ? "selected":""}}>Dominica</option>
                                                        <option value="Dominican Republic" {{$user->country == "Dominican Republic" ? "selected":""}}>Dominican Republic</option>
                                                        <option value="Ecuador" {{$user->country == "Ecuador" ? "selected":""}}>Ecuador</option>
                                                        <option value="Egypt" {{$user->country == "Egypt" ? "selected":""}}>Egypt</option>
                                                        <option value="El Salvador" {{$user->country == "El Salvador" ? "selected":""}}>El Salvador</option>
                                                        <option value="Equatorial Guinea" {{$user->country == "Equatorial Guinea" ? "selected":""}}>Equatorial Guinea</option>
                                                        <option value="Eritrea" {{$user->country == "Eritrea" ? "selected":""}}>Eritrea</option>
                                                        <option value="Estonia" {{$user->country == "Estonia" ? "selected":""}}>Estonia</option>
                                                        <option value="Ethiopia" {{$user->country == "Ethiopia" ? "selected":""}}>Ethiopia</option>
                                                        <option value="Falkland Islands (Malvinas)" {{$user->country == "Falkland Islands (Malvinas)" ? "selected":""}}>Falkland Islands (Malvinas)</option>
                                                        <option value="Faroe Islands" {{$user->country == "Faroe Islands" ? "selected":""}}>Faroe Islands</option>
                                                        <option value="Fiji" {{$user->country == "Fiji" ? "selected":""}}>Fiji</option>
                                                        <option value="Finland" {{$user->country == "Finland" ? "selected":""}}>Finland</option>
                                                        <option value="France" {{$user->country == "France" ? "selected":""}}>France</option>
                                                        <option value="French Guiana" {{$user->country == "French Guiana" ? "selected":""}}>French Guiana</option>
                                                        <option value="French Polynesia" {{$user->country == "French Polynesia" ? "selected":""}}>French Polynesia</option>
                                                        <option value="French Southern Territories" {{$user->country == "French Southern Territories" ? "selected":""}}>French Southern Territories</option>
                                                        <option value="Futuna Islands" {{$user->country == "Futuna Islands" ? "selected":""}}>Futuna Islands</option>
                                                        <option value="Gabon" {{$user->country == "Gabon" ? "selected":""}}>Gabon</option>
                                                        <option value="Gambia" {{$user->country == "Gambia" ? "selected":""}}>Gambia</option>
                                                        <option value="Georgia" {{$user->country == "Georgia" ? "selected":""}}>Georgia</option>
                                                        <option value="Germany" {{$user->country == "Germany" ? "selected":""}}>Germany</option>
                                                        <option value="Ghana" {{$user->country == "Ghana" ? "selected":""}}>Ghana</option>
                                                        <option value="Gibraltar" {{$user->country == "Gibraltar" ? "selected":""}}>Gibraltar</option>
                                                        <option value="Greece" {{$user->country == "Greece" ? "selected":""}}>Greece</option>
                                                        <option value="Greenland" {{$user->country == "Greenland" ? "selected":""}}>Greenland</option>
                                                        <option value="Grenada" {{$user->country == "Grenada" ? "selected":""}}>Grenada</option>
                                                        <option value="Guadeloupe" {{$user->country == "Guadeloupe" ? "selected":""}}>Guadeloupe</option>
                                                        <option value="Guam" {{$user->country == "Guam" ? "selected":""}}>Guam</option>
                                                        <option value="Guatemala" {{$user->country == "Guatemala" ? "selected":""}}>Guatemala</option>
                                                        <option value="Guernsey" {{$user->country == "Guernsey" ? "selected":""}}>Guernsey</option>
                                                        <option value="Guinea" {{$user->country == "Guinea" ? "selected":""}}>Guinea</option>
                                                        <option value="Guinea-Bissau" {{$user->country == "Guinea-Bissau" ? "selected":""}}>Guinea-Bissau</option>
                                                        <option value="Guyana" {{$user->country == "Guyana" ? "selected":""}}>Guyana</option>
                                                        <option value="Haiti" {{$user->country == "Haiti" ? "selected":""}}>Haiti</option>
                                                        <option value="Heard" {{$user->country == "Heard" ? "selected":""}}>Heard</option>
                                                        <option value="Herzegovina" {{$user->country == "Herzegovina" ? "selected":""}}>Herzegovina</option>
                                                        <option value="Holy See" {{$user->country == "Holy See" ? "selected":""}}>Holy See</option>
                                                        <option value="Honduras" {{$user->country == "Honduras" ? "selected":""}}>Honduras</option>
                                                        <option value="Hong Kong" {{$user->country == "Hong Kong" ? "selected":""}}>Hong Kong</option>
                                                        <option value="Hungary" {{$user->country == "Hungary" ? "selected":""}}>Hungary</option>
                                                        <option value="Iceland" {{$user->country == "Iceland" ? "selected":""}}>Iceland</option>
                                                        <option value="India" {{$user->country == "India" ? "selected":""}}>India</option>
                                                        <option value="Indonesia" {{$user->country == "Indonesia" ? "selected":""}}>Indonesia</option>
                                                        <option value="Iran (Islamic Republic of)" {{$user->country == "Iran (Islamic Republic of)" ? "selected":""}}>Iran (Islamic Republic of)</option>
                                                        <option value="Iraq" {{$user->country == "Iraq" ? "selected":""}}>Iraq</option>
                                                        <option value="Ireland" {{$user->country == "Ireland" ? "selected":""}}>Ireland</option>
                                                        <option value="Isle of Man" {{$user->country == "Isle of Man" ? "selected":""}}>Isle of Man</option>
                                                        <option value="Israel" {{$user->country == "Israel" ? "selected":""}}>Israel</option>
                                                        <option value="Italy" {{$user->country == "Italy" ? "selected":""}}>Italy</option>
                                                        <option value="Jamaica" {{$user->country == "Jamaica" ? "selected":""}}>Jamaica</option>
                                                        <option value="Jan Mayen Islands" {{$user->country == "Jan Mayen Islands" ? "selected":""}}>Jan Mayen Islands</option>
                                                        <option value="Japan" {{$user->country == "Japan" ? "selected":""}}>Japan</option>
                                                        <option value="Jersey" {{$user->country == "Jersey" ? "selected":""}}>Jersey</option>
                                                        <option value="Jordan" {{$user->country == "Jordan" ? "selected":""}}>Jordan</option>
                                                        <option value="Kazakhstan" {{$user->country == "Kazakhstan" ? "selected":""}}>Kazakhstan</option>
                                                        <option value="Kenya" {{$user->country == "Kenya" ? "selected":""}}>Kenya</option>
                                                        <option value="Kiribati" {{$user->country == "Kiribati" ? "selected":""}}>Kiribati</option>
                                                        <option value="Korea" {{$user->country == "Korea" ? "selected":""}}>Korea</option>
                                                        <option value="Korea (Democratic)" {{$user->country == "Korea (Democratic)" ? "selected":""}}>Korea (Democratic)</option>
                                                        <option value="Kuwait" {{$user->country == "Kuwait" ? "selected":""}}>Kuwait</option>
                                                        <option value="Kyrgyzstan" {{$user->country == "Kyrgyzstan" ? "selected":""}}>Kyrgyzstan</option>
                                                        <option value="Lao" {{$user->country == "Lao" ? "selected":""}}>Lao</option>
                                                        <option value="Latvia" {{$user->country == "Latvia" ? "selected":""}}>Latvia</option>
                                                        <option value="Lebanon" {{$user->country == "Lebanon" ? "selected":""}}>Lebanon</option>
                                                        <option value="Lesotho" {{$user->country == "Lesotho" ? "selected":""}}>Lesotho</option>
                                                        <option value="Liberia" {{$user->country == "Liberia" ? "selected":""}}>Liberia</option>
                                                        <option value="Libyan Arab Jamahiriya" {{$user->country == "Libyan Arab Jamahiriya" ? "selected":""}}>Libyan Arab Jamahiriya</option>
                                                        <option value="Liechtenstein" {{$user->country == "Liechtenstein" ? "selected":""}}>Liechtenstein</option>
                                                        <option value="Lithuania" {{$user->country == "Lithuania" ? "selected":""}}>Lithuania</option>
                                                        <option value="Luxembourg" {{$user->country == "Luxembourg" ? "selected":""}}>Luxembourg</option>
                                                        <option value="Macao" {{$user->country == "Macao" ? "selected":""}}>Macao</option>
                                                        <option value="Macedonia" {{$user->country == "Macedonia" ? "selected":""}}>Macedonia</option>
                                                        <option value="Madagascar" {{$user->country == "Madagascar" ? "selected":""}}>Madagascar</option>
                                                        <option value="Malawi" {{$user->country == "Malawi" ? "selected":""}}>Malawi</option>
                                                        <option value="Malaysia" {{$user->country == "Malaysia" ? "selected":""}}>Malaysia</option>
                                                        <option value="Maldives" {{$user->country == "Maldives" ? "selected":""}}>Maldives</option>
                                                        <option value="Mali" {{$user->country == "Mali" ? "selected":""}}>Mali</option>
                                                        <option value="Malta" {{$user->country == "Malta" ? "selected":""}}>Malta</option>
                                                        <option value="Marshall Islands" {{$user->country == "Marshall Islands" ? "selected":""}}>Marshall Islands</option>
                                                        <option value="Martinique" {{$user->country == "Martinique" ? "selected":""}}>Martinique</option>
                                                        <option value="Mauritania" {{$user->country == "Mauritania" ? "selected":""}}>Mauritania</option>
                                                        <option value="Mauritius" {{$user->country == "Mauritius" ? "selected":""}}>Mauritius</option>
                                                        <option value="Mayotte" {{$user->country == "Mayotte" ? "selected":""}}>Mayotte</option>
                                                        <option value="McDonald Islands" {{$user->country == "McDonald Islands" ? "selected":""}}>McDonald Islands</option>
                                                        <option value="Mexico" {{$user->country == "Mexico" ? "selected":""}}>Mexico</option>
                                                        <option value="Micronesia" {{$user->country == "Micronesia" ? "selected":""}}>Micronesia</option>
                                                        <option value="Miquelon" {{$user->country == "Miquelon" ? "selected":""}}>Miquelon</option>
                                                        <option value="Moldova" {{$user->country == "Moldova" ? "selected":""}}>Moldova</option>
                                                        <option value="Monaco" {{$user->country == "Monaco" ? "selected":""}}>Monaco</option>
                                                        <option value="Mongolia" {{$user->country == "Mongolia" ? "selected":""}}>Mongolia</option>
                                                        <option value="Montenegro" {{$user->country == "Montenegro" ? "selected":""}}>Montenegro</option>
                                                        <option value="Montserrat" {{$user->country == "Montserrat" ? "selected":""}}>Montserrat</option>
                                                        <option value="Morocco" {{$user->country == "Morocco" ? "selected":""}}>Morocco</option>
                                                        <option value="Mozambique" {{$user->country == "Mozambique" ? "selected":""}}>Mozambique</option>
                                                        <option value="Myanmar" {{$user->country == "Myanmar" ? "selected":""}}>Myanmar</option>
                                                        <option value="Namibia" {{$user->country == "Namibia" ? "selected":""}}>Namibia</option>
                                                        <option value="Nauru" {{$user->country == "Nauru" ? "selected":""}}>Nauru</option>
                                                        <option value="Nepal" {{$user->country == "Nepal" ? "selected":""}}>Nepal</option>
                                                        <option value="Netherlands" {{$user->country == "Netherlands" ? "selected":""}}>Netherlands</option>
                                                        <option value="Netherlands Antilles" {{$user->country == "Netherlands Antilles" ? "selected":""}}>Netherlands Antilles</option>
                                                        <option value="Nevis" {{$user->country == "Nevis" ? "selected":""}}>Nevis</option>
                                                        <option value="New Caledonia" {{$user->country == "New Caledonia" ? "selected":""}}>New Caledonia</option>
                                                        <option value="New Zealand" {{$user->country == "New Zealand" ? "selected":""}}>New Zealand</option>
                                                        <option value="Nicaragua" {{$user->country == "Nicaragua" ? "selected":""}}>Nicaragua</option>
                                                        <option value="Niger" {{$user->country == "Niger" ? "selected":""}}>Niger</option>
                                                        <option value="Nigeria" {{$user->country == "Nigeria" ? "selected":""}}>Nigeria</option>
                                                        <option value="Niue" {{$user->country == "Niue" ? "selected":""}}>Niue</option>
                                                        <option value="Norfolk Island" {{$user->country == "Norfolk Island" ? "selected":""}}>Norfolk Island</option>
                                                        <option value="Northern Mariana Islands" {{$user->country == "Northern Mariana Islands" ? "selected":""}}>Northern Mariana Islands</option>
                                                        <option value="Norway" {{$user->country == "Norway" ? "selected":""}}>Norway</option>
                                                        <option value="Oman" {{$user->country == "Oman" ? "selected":""}}>Oman</option>
                                                        <option value="Pakistan" {{$user->country == "Pakistan" ? "selected":""}}>Pakistan</option>
                                                        <option value="Palau" {{$user->country == "Palau" ? "selected":""}}>Palau</option>
                                                        <option value="Palestinian Territory, Occupied" {{$user->country == "Palestinian Territory, Occupied" ? "selected":""}}>Palestinian Territory, Occupied</option>
                                                        <option value="Panama" {{$user->country == "Panama" ? "selected":""}}>Panama</option>
                                                        <option value="Papua New Guinea" {{$user->country == "Papua New Guinea" ? "selected":""}}>Papua New Guinea</option>
                                                        <option value="Paraguay" {{$user->country == "Paraguay" ? "selected":""}}>Paraguay</option>
                                                        <option value="Peru" {{$user->country == "Peru" ? "selected":""}}>Peru</option>
                                                        <option value="Philippines" {{$user->country == "Philippines" ? "selected":""}}>Philippines</option>
                                                        <option value="Pitcairn" {{$user->country == "Pitcairn" ? "selected":""}}>Pitcairn</option>
                                                        <option value="Poland" {{$user->country == "Poland" ? "selected":""}}>Poland</option>
                                                        <option value="Portugal" {{$user->country == "Portugal" ? "selected":""}}>Portugal</option>
                                                        <option value="Principe" {{$user->country == "Principe" ? "selected":""}}>Principe</option>
                                                        <option value="Puerto Rico" {{$user->country == "Puerto Rico" ? "selected":""}}>Puerto Rico</option>
                                                        <option value="Qatar" {{$user->country == "Qatar" ? "selected":""}}>Qatar</option>
                                                        <option value="Reunion" {{$user->country == "Reunion" ? "selected":""}}>Reunion</option>
                                                        <option value="Romania" {{$user->country == "Romania" ? "selected":""}}>Romania</option>
                                                        <option value="Russian Federation" {{$user->country == "Russian Federation" ? "selected":""}}>Russian Federation</option>
                                                        <option value="Rwanda" {{$user->country == "Rwanda" ? "selected":""}}>Rwanda</option>
                                                        <option value="Saint Barthelemy" {{$user->country == "Saint Barthelemy" ? "selected":""}}>Saint Barthelemy</option>
                                                        <option value="Saint Helena" {{$user->country == "Saint Helena" ? "selected":""}}>Saint Helena</option>
                                                        <option value="Saint Kitts" {{$user->country == "Saint Kitts" ? "selected":""}}>Saint Kitts</option>
                                                        <option value="Saint Lucia" {{$user->country == "Saint Lucia" ? "selected":""}}>Saint Lucia</option>
                                                        <option value="Saint Martin (French part)" {{$user->country == "Saint Martin (French part)" ? "selected":""}}>Saint Martin (French part)</option>
                                                        <option value="Saint Pierre" {{$user->country == "Saint Pierre" ? "selected":""}}>Saint Pierre</option>
                                                        <option value="Saint Vincent" {{$user->country == "Saint Vincent" ? "selected":""}}>Saint Vincent</option>
                                                        <option value="Samoa" {{$user->country == "Samoa" ? "selected":""}}>Samoa</option>
                                                        <option value="San Marino" {{$user->country == "San Marino" ? "selected":""}}>San Marino</option>
                                                        <option value="Sao Tome" {{$user->country == "Sao Tome" ? "selected":""}}>Sao Tome</option>
                                                        <option value="Saudi Arabia" {{$user->country == "Saudi Arabia" ? "selected":""}}>Saudi Arabia</option>
                                                        <option value="Senegal" {{$user->country == "Senegal" ? "selected":""}}>Senegal</option>
                                                        <option value="Serbia" {{$user->country == "Serbia" ? "selected":""}}>Serbia</option>
                                                        <option value="Seychelles" {{$user->country == "Seychelles" ? "selected":""}}>Seychelles</option>
                                                        <option value="Sierra Leone" {{$user->country == "Sierra Leone" ? "selected":""}}>Sierra Leone</option>
                                                        <option value="Singapore" {{$user->country == "Singapore" ? "selected":""}}>Singapore</option>
                                                        <option value="Slovakia" {{$user->country == "Slovakia" ? "selected":""}}>Slovakia</option>
                                                        <option value="Slovenia" {{$user->country == "Slovenia" ? "selected":""}}>Slovenia</option>
                                                        <option value="Solomon Islands" {{$user->country == "Solomon Islands" ? "selected":""}}>Solomon Islands</option>
                                                        <option value="Somalia" {{$user->country == "Somalia" ? "selected":""}}>Somalia</option>
                                                        <option value="South Africa" {{$user->country == "South Africa" ? "selected":""}}>South Africa</option>
                                                        <option value="South Georgia" {{$user->country == "South Georgia" ? "selected":""}}>South Georgia</option>
                                                        <option value="South Sandwich Islands" {{$user->country == "South Sandwich Islands" ? "selected":""}}>South Sandwich Islands</option>
                                                        <option value="Spain" {{$user->country == "Spain" ? "selected":""}}>Spain</option>
                                                        <option value="Sri Lanka" {{$user->country == "Sri Lanka" ? "selected":""}}>Sri Lanka</option>
                                                        <option value="Sudan" {{$user->country == "Sudan" ? "selected":""}}>Sudan</option>
                                                        <option value="Suriname" {{$user->country == "Suriname" ? "selected":""}}>Suriname</option>
                                                        <option value="Svalbard" {{$user->country == "Svalbard" ? "selected":""}}>Svalbard</option>
                                                        <option value="Swaziland" {{$user->country == "Swaziland" ? "selected":""}}>Swaziland</option>
                                                        <option value="Sweden" {{$user->country == "Sweden" ? "selected":""}}>Sweden</option>
                                                        <option value="Switzerland" {{$user->country == "Switzerland" ? "selected":""}}>Switzerland</option>
                                                        <option value="Syrian Arab Republic" {{$user->country == "Syrian Arab Republic" ? "selected":""}}>Syrian Arab Republic</option>
                                                        <option value="Taiwan" {{$user->country == "Taiwan" ? "selected":""}}>Taiwan</option>
                                                        <option value="Tajikistan" {{$user->country == "Tajikistan" ? "selected":""}}>Tajikistan</option>
                                                        <option value="Tanzania" {{$user->country == "Tanzania" ? "selected":""}}>Tanzania</option>
                                                        <option value="Thailand" {{$user->country == "Thailand" ? "selected":""}}>Thailand</option>
                                                        <option value="The Grenadines" {{$user->country == "The Grenadines" ? "selected":""}}>The Grenadines</option>
                                                        <option value="Timor-Leste" {{$user->country == "Timor-Leste" ? "selected":""}}>Timor-Leste</option>
                                                        <option value="Tobago" {{$user->country == "Tobago" ? "selected":""}}>Tobago</option>
                                                        <option value="Togo" {{$user->country == "Togo" ? "selected":""}}>Togo</option>
                                                        <option value="Tokelau" {{$user->country == "Tokelau" ? "selected":""}}>Tokelau</option>
                                                        <option value="Tonga" {{$user->country == "Tonga" ? "selected":""}}>Tonga</option>
                                                        <option value="Trinidad" {{$user->country == "Trinidad" ? "selected":""}}>Trinidad</option>
                                                        <option value="Tunisia" {{$user->country == "Tunisia" ? "selected":""}}>Tunisia</option>
                                                        <option value="Turkey" {{$user->country == "Turkey" ? "selected":""}}>Turkey</option>
                                                        <option value="Turkmenistan" {{$user->country == "Turkmenistan" ? "selected":""}}>Turkmenistan</option>
                                                        <option value="Turks Islands" {{$user->country == "Turks Islands" ? "selected":""}}>Turks Islands</option>
                                                        <option value="Tuvalu" {{$user->country == "Tuvalu" ? "selected":""}}>Tuvalu</option>
                                                        <option value="Uganda" {{$user->country == "Uganda" ? "selected":""}}>Uganda</option>
                                                        <option value="Ukraine" {{$user->country == "Ukraine" ? "selected":""}}>Ukraine</option>
                                                        <option value="United Arab Emirates" {{$user->country == "United Arab Emirates" ? "selected":""}}>United Arab Emirates</option>
                                                        <option value="United Kingdom" {{$user->country == "United Kingdom" ? "selected":""}}>United Kingdom</option>
                                                        <option value="United States" {{$user->country == "United States" ? "selected":""}}>United States</option>
                                                        <option value="Uruguay" {{$user->country == "Uruguay" ? "selected":""}}>Uruguay</option>
                                                        <option value="US Minor Outlying Islands" {{$user->country == "US Minor Outlying Islands" ? "selected":""}}>US Minor Outlying Islands</option>
                                                        <option value="Uzbekistan" {{$user->country == "Uzbekistan" ? "selected":""}}>Uzbekistan</option>
                                                        <option value="Vanuatu" {{$user->country == "Vanuatu" ? "selected":""}}>Vanuatu</option>
                                                        <option value="Vatican City State" {{$user->country == "Vatican City State" ? "selected":""}}>Vatican City State</option>
                                                        <option value="Venezuela" {{$user->country == "Venezuela" ? "selected":""}}>Venezuela</option>
                                                        <option value="Vietnam" {{$user->country == "Vietnam" ? "selected":""}}>Vietnam</option>
                                                        <option value="Virgin Islands (British)" {{$user->country == "Virgin Islands (British)" ? "selected":""}}>Virgin Islands (British)</option>
                                                        <option value="Virgin Islands (US)" {{$user->country == "Virgin Islands (US)" ? "selected":""}}>Virgin Islands (US)</option>
                                                        <option value="Wallis" {{$user->country == "Wallis" ? "selected":""}}>Wallis</option>
                                                        <option value="Western Sahara" {{$user->country == "Western Sahara" ? "selected":""}}>Western Sahara</option>
                                                        <option value="Yemen" {{$user->country == "Yemen" ? "selected":""}}>Yemen</option>
                                                        <option value="Zambia" {{$user->country == "Zambia" ? "selected":""}}>Zambia</option>
                                                        <option value="Zimbabwe" {{$user->country == "Zimbabwe" ? "selected":""}}>Zimbabwe</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="authors_email" class="col-md-2 control-label">E-mail  <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></label>
                                                <div class="col-md-10">
                                                    <input id="authors_email" name="authors_email[]" type="email" class="form-control" value="{{$user->email}}" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                {{--<label for="authors_email" class="col-md-2 control-label">Co Author </label>--}}
                                                <div class="col-md-10 col-md-offset-2">
                                                    <label class="checkbox-inline">
                                                        <input name="authors_co_author[]" type="checkbox" class="co_author" value="1"> Co-author
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <button id="add_author" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Add Author</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-2 col-md-offset-5">
                    <button id="submit" type="submit" class="btn btn-primary">
                        Submit
                    </button>
                </div>
            </div>
        </form>
    @endif
@endsection

@section('script')
    <script type="text/javascript">
        $(function() {
            var author_count = 1;

            function disable_author_add() {
                if (author_count >= 4) {
                    $("#add_author").addClass('disabled');
                    $("#add_author").prop('disabled', true);
                } else {
                    $('#add_author.disabled').removeClass('disabled');
                    $("#add_author").prop('disabled', false);
                }
            }

            // We can attach the `fileselect` event to all file inputs on the page
            $(document).on('change', ':file', function() {
                var input = $(this),
                    numFiles = input.get(0).files ? input.get(0).files.length : 1,
                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                input.trigger('fileselect', [numFiles, label]);
            });

            // We can watch for our custom `fileselect` event like this
            $(document).ready( function() {
                $(':file').on('fileselect', function(event, numFiles, label) {

                    var input = $(this).parents('.input-group').find(':text'),
                        log = numFiles > 1 ? numFiles + ' files selected' : label;

                    if( input.length ) {
                        input.val(log);
                    } else {
                        if( log ) alert(log);
                    }

                });

                $("#topics").select2({
                    tags: true,
                    tokenSeparators: [',', ' ']
                });
                $("#area").select2();


                $("#add_author").click(function (e) {
                    $(".author_data")
                        .first()
                        .clone()
                        .insertBefore('#add_author')
                        .append('<a href="#" class="btn btn-danger author_remove" style="margin-bottom: 10px;"><i class="fa fa-trash-o"></i> Remove </a>')
                        .find(':input')
                        .prop('checked', false)
                        .not(':button, :submit, :reset, :hidden, :radio, :checkbox')
                        .val('')
                        .parent()
                        .find('select')
                        .prop('selectedIndex', 227);
                    author_count++;
                    disable_author_add();
                });

                $('.authors').on('click', '.author_remove', function (e) {
                    e.preventDefault();
                    $(this).closest('.author_data').remove();
                    author_count--;
                    disable_author_add();
                });

                $('form').submit(function (e) {
                    $('input[type=checkbox]:not(:checked)').each(function () {
                        console.log(this);
                        $(this).prop("checked", true).val(0);
                    });
                });

            });

        });
    </script>
@endsection
