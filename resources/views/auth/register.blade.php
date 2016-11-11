@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-offset-0 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('econ1/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') || $errors->has('academic_position') ? ' has-error' : '' }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="title" class="col-md-4 control-label">Title <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></label>

                                    <div class="col-md-8">
                                        <label class="radio-inline">
                                            <input type="radio" name="title" value="1" required {{ old('title') == '1' ? "checked":"" }}> Dr.
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="title" value="2" required {{ old('title') == '2' ? "checked":"" }}> Mr.
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="title" value="3" required {{ old('title') == '3' ? "checked":"" }}> Ms.
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="title" value="4" required {{ old('title') == '4' ? "checked":"" }}> Mrs.
                                        </label>

                                        @if ($errors->has('title'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="academic_position" class="col-md-4 control-label">Academic Positions <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></label>

                                    <div class="col-md-8">
                                        <label class="radio-inline">
                                            <input type="radio" name="academic_position" value="1" required {{ old('academic_position') == '1' ? "checked":"" }}> Prof.
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="academic_position" value="2" required {{ old('academic_position') == '2' ? "checked":"" }}> Assoc. Prof.
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="academic_position" value="3" required {{ old('academic_position') == '3' ? "checked":"" }}> Asst. Prof.
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="academic_position" value="4" required {{ old('academic_position') == '4' ? "checked":"" }}> None
                                        </label>

                                        @if ($errors->has('academic_position'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('academic_position') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') || $errors->has('family_name') ? ' has-error' : '' }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name" class="col-md-4 control-label">First (and middle) name(s) <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></label>

                                    <div class="col-md-8">
                                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="family_name" class="col-md-4 control-label">Family Name <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></label>

                                    <div class="col-md-8">
                                        <input id="family_name" type="text" class="form-control" name="family_name" value="{{ old('family_name') }}" required autofocus>

                                        @if ($errors->has('family_name'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('family_name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('affiliation') || $errors->has('country') ? ' has-error' : '' }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="affiliation" class="col-md-4 control-label">Affiliation <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></label>

                                    <div class="col-md-8">
                                        <input id="affiliation" type="affiliation" class="form-control" name="affiliation" value="{{ old('affiliation') }}" required>

                                        @if ($errors->has('affiliation'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('affiliation') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="country" class="col-md-4 control-label">Country <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></label>

                                    <div class="col-md-8">
                                        <select class="form-control" name="country" required>
                                            <option value="Afghanistan">Afghanistan</option>
                                            <option value="Aland Islands">Aland Islands</option>
                                            <option value="Albania">Albania</option>
                                            <option value="Algeria">Algeria</option>
                                            <option value="American Samoa">American Samoa</option>
                                            <option value="Andorra">Andorra</option>
                                            <option value="Angola">Angola</option>
                                            <option value="Anguilla">Anguilla</option>
                                            <option value="Antarctica">Antarctica</option>
                                            <option value="Antigua">Antigua</option>
                                            <option value="Argentina">Argentina</option>
                                            <option value="Armenia">Armenia</option>
                                            <option value="Aruba">Aruba</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Austria">Austria</option>
                                            <option value="Azerbaijan">Azerbaijan</option>
                                            <option value="Bahamas">Bahamas</option>
                                            <option value="Bahrain">Bahrain</option>
                                            <option value="Bangladesh">Bangladesh</option>
                                            <option value="Barbados">Barbados</option>
                                            <option value="Barbuda">Barbuda</option>
                                            <option value="Belarus">Belarus</option>
                                            <option value="Belgium">Belgium</option>
                                            <option value="Belize">Belize</option>
                                            <option value="Benin">Benin</option>
                                            <option value="Bermuda">Bermuda</option>
                                            <option value="Bhutan">Bhutan</option>
                                            <option value="Bolivia">Bolivia</option>
                                            <option value="Bosnia">Bosnia</option>
                                            <option value="Botswana">Botswana</option>
                                            <option value="Bouvet Island">Bouvet Island</option>
                                            <option value="Brazil">Brazil</option>
                                            <option value="British Indian Ocean Trty.">British Indian Ocean Trty.</option>
                                            <option value="Brunei Darussalam">Brunei Darussalam</option>
                                            <option value="Bulgaria">Bulgaria</option>
                                            <option value="Burkina Faso">Burkina Faso</option>
                                            <option value="Burundi">Burundi</option>
                                            <option value="Caicos Islands">Caicos Islands</option>
                                            <option value="Cambodia">Cambodia</option>
                                            <option value="Cameroon">Cameroon</option>
                                            <option value="Canada">Canada</option>
                                            <option value="Cape Verde">Cape Verde</option>
                                            <option value="Cayman Islands">Cayman Islands</option>
                                            <option value="Central African Republic">Central African Republic</option>
                                            <option value="Chad">Chad</option>
                                            <option value="Chile">Chile</option>
                                            <option value="China">China</option>
                                            <option value="Christmas Island">Christmas Island</option>
                                            <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                            <option value="Colombia">Colombia</option>
                                            <option value="Comoros">Comoros</option>
                                            <option value="Congo">Congo</option>
                                            <option value="Congo, Democratic Republic of the">Congo, Democratic Republic of the</option>
                                            <option value="Cook Islands">Cook Islands</option>
                                            <option value="Costa Rica">Costa Rica</option>
                                            <option value="Cote d'Ivoire">Cote d'Ivoire</option>
                                            <option value="Croatia">Croatia</option>
                                            <option value="Cuba">Cuba</option>
                                            <option value="Cyprus">Cyprus</option>
                                            <option value="Czech Republic">Czech Republic</option>
                                            <option value="Denmark">Denmark</option>
                                            <option value="Djibouti">Djibouti</option>
                                            <option value="Dominica">Dominica</option>
                                            <option value="Dominican Republic">Dominican Republic</option>
                                            <option value="Ecuador">Ecuador</option>
                                            <option value="Egypt">Egypt</option>
                                            <option value="El Salvador">El Salvador</option>
                                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                                            <option value="Eritrea">Eritrea</option>
                                            <option value="Estonia">Estonia</option>
                                            <option value="Ethiopia">Ethiopia</option>
                                            <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                            <option value="Faroe Islands">Faroe Islands</option>
                                            <option value="Fiji">Fiji</option>
                                            <option value="Finland">Finland</option>
                                            <option value="France">France</option>
                                            <option value="French Guiana">French Guiana</option>
                                            <option value="French Polynesia">French Polynesia</option>
                                            <option value="French Southern Territories">French Southern Territories</option>
                                            <option value="Futuna Islands">Futuna Islands</option>
                                            <option value="Gabon">Gabon</option>
                                            <option value="Gambia">Gambia</option>
                                            <option value="Georgia">Georgia</option>
                                            <option value="Germany">Germany</option>
                                            <option value="Ghana">Ghana</option>
                                            <option value="Gibraltar">Gibraltar</option>
                                            <option value="Greece">Greece</option>
                                            <option value="Greenland">Greenland</option>
                                            <option value="Grenada">Grenada</option>
                                            <option value="Guadeloupe">Guadeloupe</option>
                                            <option value="Guam">Guam</option>
                                            <option value="Guatemala">Guatemala</option>
                                            <option value="Guernsey">Guernsey</option>
                                            <option value="Guinea">Guinea</option>
                                            <option value="Guinea-Bissau">Guinea-Bissau</option>
                                            <option value="Guyana">Guyana</option>
                                            <option value="Haiti">Haiti</option>
                                            <option value="Heard">Heard</option>
                                            <option value="Herzegovina">Herzegovina</option>
                                            <option value="Holy See">Holy See</option>
                                            <option value="Honduras">Honduras</option>
                                            <option value="Hong Kong">Hong Kong</option>
                                            <option value="Hungary">Hungary</option>
                                            <option value="Iceland">Iceland</option>
                                            <option value="India">India</option>
                                            <option value="Indonesia">Indonesia</option>
                                            <option value="Iran (Islamic Republic of)">Iran (Islamic Republic of)</option>
                                            <option value="Iraq">Iraq</option>
                                            <option value="Ireland">Ireland</option>
                                            <option value="Isle of Man">Isle of Man</option>
                                            <option value="Israel">Israel</option>
                                            <option value="Italy">Italy</option>
                                            <option value="Jamaica">Jamaica</option>
                                            <option value="Jan Mayen Islands">Jan Mayen Islands</option>
                                            <option value="Japan">Japan</option>
                                            <option value="Jersey">Jersey</option>
                                            <option value="Jordan">Jordan</option>
                                            <option value="Kazakhstan">Kazakhstan</option>
                                            <option value="Kenya">Kenya</option>
                                            <option value="Kiribati">Kiribati</option>
                                            <option value="Korea">Korea</option>
                                            <option value="Korea (Democratic)">Korea (Democratic)</option>
                                            <option value="Kuwait">Kuwait</option>
                                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                                            <option value="Lao">Lao</option>
                                            <option value="Latvia">Latvia</option>
                                            <option value="Lebanon">Lebanon</option>
                                            <option value="Lesotho">Lesotho</option>
                                            <option value="Liberia">Liberia</option>
                                            <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                            <option value="Liechtenstein">Liechtenstein</option>
                                            <option value="Lithuania">Lithuania</option>
                                            <option value="Luxembourg">Luxembourg</option>
                                            <option value="Macao">Macao</option>
                                            <option value="Macedonia">Macedonia</option>
                                            <option value="Madagascar">Madagascar</option>
                                            <option value="Malawi">Malawi</option>
                                            <option value="Malaysia">Malaysia</option>
                                            <option value="Maldives">Maldives</option>
                                            <option value="Mali">Mali</option>
                                            <option value="Malta">Malta</option>
                                            <option value="Marshall Islands">Marshall Islands</option>
                                            <option value="Martinique">Martinique</option>
                                            <option value="Mauritania">Mauritania</option>
                                            <option value="Mauritius">Mauritius</option>
                                            <option value="Mayotte">Mayotte</option>
                                            <option value="McDonald Islands">McDonald Islands</option>
                                            <option value="Mexico">Mexico</option>
                                            <option value="Micronesia">Micronesia</option>
                                            <option value="Miquelon">Miquelon</option>
                                            <option value="Moldova">Moldova</option>
                                            <option value="Monaco">Monaco</option>
                                            <option value="Mongolia">Mongolia</option>
                                            <option value="Montenegro">Montenegro</option>
                                            <option value="Montserrat">Montserrat</option>
                                            <option value="Morocco">Morocco</option>
                                            <option value="Mozambique">Mozambique</option>
                                            <option value="Myanmar">Myanmar</option>
                                            <option value="Namibia">Namibia</option>
                                            <option value="Nauru">Nauru</option>
                                            <option value="Nepal">Nepal</option>
                                            <option value="Netherlands">Netherlands</option>
                                            <option value="Netherlands Antilles">Netherlands Antilles</option>
                                            <option value="Nevis">Nevis</option>
                                            <option value="New Caledonia">New Caledonia</option>
                                            <option value="New Zealand">New Zealand</option>
                                            <option value="Nicaragua">Nicaragua</option>
                                            <option value="Niger">Niger</option>
                                            <option value="Nigeria">Nigeria</option>
                                            <option value="Niue">Niue</option>
                                            <option value="Norfolk Island">Norfolk Island</option>
                                            <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                            <option value="Norway">Norway</option>
                                            <option value="Oman">Oman</option>
                                            <option value="Pakistan">Pakistan</option>
                                            <option value="Palau">Palau</option>
                                            <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                            <option value="Panama">Panama</option>
                                            <option value="Papua New Guinea">Papua New Guinea</option>
                                            <option value="Paraguay">Paraguay</option>
                                            <option value="Peru">Peru</option>
                                            <option value="Philippines">Philippines</option>
                                            <option value="Pitcairn">Pitcairn</option>
                                            <option value="Poland">Poland</option>
                                            <option value="Portugal">Portugal</option>
                                            <option value="Principe">Principe</option>
                                            <option value="Puerto Rico">Puerto Rico</option>
                                            <option value="Qatar">Qatar</option>
                                            <option value="Reunion">Reunion</option>
                                            <option value="Romania">Romania</option>
                                            <option value="Russian Federation">Russian Federation</option>
                                            <option value="Rwanda">Rwanda</option>
                                            <option value="Saint Barthelemy">Saint Barthelemy</option>
                                            <option value="Saint Helena">Saint Helena</option>
                                            <option value="Saint Kitts">Saint Kitts</option>
                                            <option value="Saint Lucia">Saint Lucia</option>
                                            <option value="Saint Martin (French part)">Saint Martin (French part)</option>
                                            <option value="Saint Pierre">Saint Pierre</option>
                                            <option value="Saint Vincent">Saint Vincent</option>
                                            <option value="Samoa">Samoa</option>
                                            <option value="San Marino">San Marino</option>
                                            <option value="Sao Tome">Sao Tome</option>
                                            <option value="Saudi Arabia">Saudi Arabia</option>
                                            <option value="Senegal">Senegal</option>
                                            <option value="Serbia">Serbia</option>
                                            <option value="Seychelles">Seychelles</option>
                                            <option value="Sierra Leone">Sierra Leone</option>
                                            <option value="Singapore">Singapore</option>
                                            <option value="Slovakia">Slovakia</option>
                                            <option value="Slovenia">Slovenia</option>
                                            <option value="Solomon Islands">Solomon Islands</option>
                                            <option value="Somalia">Somalia</option>
                                            <option value="South Africa">South Africa</option>
                                            <option value="South Georgia">South Georgia</option>
                                            <option value="South Sandwich Islands">South Sandwich Islands</option>
                                            <option value="Spain">Spain</option>
                                            <option value="Sri Lanka">Sri Lanka</option>
                                            <option value="Sudan">Sudan</option>
                                            <option value="Suriname">Suriname</option>
                                            <option value="Svalbard">Svalbard</option>
                                            <option value="Swaziland">Swaziland</option>
                                            <option value="Sweden">Sweden</option>
                                            <option value="Switzerland">Switzerland</option>
                                            <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                            <option value="Taiwan">Taiwan</option>
                                            <option value="Tajikistan">Tajikistan</option>
                                            <option value="Tanzania">Tanzania</option>
                                            <option value="Thailand" selected="">Thailand</option>
                                            <option value="The Grenadines">The Grenadines</option>
                                            <option value="Timor-Leste">Timor-Leste</option>
                                            <option value="Tobago">Tobago</option>
                                            <option value="Togo">Togo</option>
                                            <option value="Tokelau">Tokelau</option>
                                            <option value="Tonga">Tonga</option>
                                            <option value="Trinidad">Trinidad</option>
                                            <option value="Tunisia">Tunisia</option>
                                            <option value="Turkey">Turkey</option>
                                            <option value="Turkmenistan">Turkmenistan</option>
                                            <option value="Turks Islands">Turks Islands</option>
                                            <option value="Tuvalu">Tuvalu</option>
                                            <option value="Uganda">Uganda</option>
                                            <option value="Ukraine">Ukraine</option>
                                            <option value="United Arab Emirates">United Arab Emirates</option>
                                            <option value="United Kingdom">United Kingdom</option>
                                            <option value="United States">United States</option>
                                            <option value="Uruguay">Uruguay</option>
                                            <option value="US Minor Outlying Islands">US Minor Outlying Islands</option>
                                            <option value="Uzbekistan">Uzbekistan</option>
                                            <option value="Vanuatu">Vanuatu</option>
                                            <option value="Vatican City State">Vatican City State</option>
                                            <option value="Venezuela">Venezuela</option>
                                            <option value="Vietnam">Vietnam</option>
                                            <option value="Virgin Islands (British)">Virgin Islands (British)</option>
                                            <option value="Virgin Islands (US)">Virgin Islands (US)</option>
                                            <option value="Wallis">Wallis</option>
                                            <option value="Western Sahara">Western Sahara</option>
                                            <option value="Yemen">Yemen</option>
                                            <option value="Zambia">Zambia</option>
                                            <option value="Zimbabwe">Zimbabwe</option>
                                        </select>

                                        @if ($errors->has('country'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('mobile') || $errors->has('fax') ? ' has-error' : '' }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="mobile" class="col-md-4 control-label">Mobile <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></label>

                                    <div class="col-md-8">
                                        <input id="mobile" type="mobile" class="form-control" name="mobile" value="{{ old('mobile') }}" required>

                                        @if ($errors->has('mobile'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="fax" class="col-md-4 control-label">Fax</label>

                                    <div class="col-md-8">
                                        <input id="fax" type="fax" class="form-control" name="fax" value="{{ old('fax') }}">

                                        @if ($errors->has('fax'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('fax') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') || $errors->has('username') ? ' has-error' : '' }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="username" class="col-md-4 control-label">Username <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></label>

                                    <div class="col-md-8">
                                        <input id="username" type="username" class="form-control" name="username" value="{{ old('username') }}" required>

                                        @if ($errors->has('username'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="col-md-4 control-label">E-Mail Address <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></label>

                                    <div class="col-md-8">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="password" class="col-md-4 control-label">Password <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></label>

                                    <div class="col-md-8">
                                        <input id="password" type="password" class="form-control" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="password-confirm" class="col-md-4 control-label">Confirm Password <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></label>

                                    <div class="col-md-8">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <label for="role" class="col-md-4 control-label">Login as <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></label>

                                    <div class="col-md-8">
                                        <label class="radio-inline">
                                            <input type="radio" name="role" value="1" required {{ old('role') == '1' ? "checked":"" }}> Author
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="role" value="2" required {{ old('role') == '2' ? "checked":"" }}> Reviewer
                                        </label>

                                        @if ($errors->has('role'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-5">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
