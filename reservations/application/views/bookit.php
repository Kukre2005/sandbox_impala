<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('include/head', array('')); ?>
<style type="text/css">.verror{color:red;}
        </style>
    <body>
<!-- Page Header End -->

<section class="contact2-section section">
    <div class="container">

        <div class="row">
            <div data-wow-delay="0.3s" class="col-md-12 wow bounceInLeft " >
                <h1 class="section-title">BOOK IT</h1>
                <p class="section-subcontent mb-30">Please fill out the form below and our representatives will get back to you within 24 hours. If you have any questions or need assistance, please email us at info@impalacabo.com or contact us at:1312 2056458</p>
                <form  action="<?php echo site_url("home/saveBookit")?>" name="bookForm" id="bookForm" class="mt-30 shake" role="form" method="post" novalidate="true">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group ">
                                <label class="" for="name">Full Name</label>
                                <input type="text"  required="" name="info[name]" class="form-control" id="name" placeholder="Your Name">
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group ">
                                <label class="" for="email">Email</label>
                                <input type="email" data-error="Please enter your Email" required="" name="info[email]" class="form-control" id="email" placeholder="Your Email">
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group">
                                <label class="" for="Phone">Phone</label>
                                <input type="text" data-error="Please enter your Phone no." required="" name="info[phone]" class="form-control" id="Phone" placeholder="Your Phone no.">
                                <div class="help-block with-errors"></div>
                            </div>

                            <div class="form-group">
                                <label class="" for="Phone">Where are you staying?</label>
                                <input type="text" data-error="Please enter your Passangers no." required="" name="info[staying]" class="form-control" id="staying" placeholder="Where are you">
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <label class="" for="Phone">Trip Type</label>
                                 <select class="form-control"  id="trip_type"  name="info[service]"  >
                                        <option value="round_trip" >Round trip</option>
                                        <option value="one_way" >One Way</option>
                                        
                                    </select> 
                                <div class="help-block with-errors"></div>
                            </div>
                            
                             <!-- /.col-md-6  -->
                        
                                <div class="form-group">
                                    <label class="form-label" for="arrival_date">Arrival Date Time (DD/MM/YYYY, HH:MM, AM/PM)</label>
                                    <input placeholder="Arrival date" readonly id="arrival_date" name="info[arrivalDate]"  value=""  class="form-control mdate" type="text"/>
                                    
                                </div>
                            
                            <!-- /.col-md-6  -->
                                <div class="form-group">
                                    <label class="form-label" for="arrival_date">Arrival Flight Number (Ex: ABC#2185)</label>
                                    <input placeholder="Arrival Flight Info" id="arrival_flight" name="info[arrivalFlight]"   class="form-control" value="" type="text"/>
                                    
                                </div>
                            
<div class="form-group">
                                    <label class="form-label" for="arrival_date">Departure  Date Time (DD/MM/YYYY, HH:MM, AM/PM)</label>
                                    <input placeholder="Departure date" readonly id="departure_date" name="info[departureDate]"  value="" class="form-control mdate" type="text"/>
                                    
                                </div>
                            
                            <!-- /.col-md-6  -->
                                <div class="form-group">
                                    <label class="form-label" for="arrival_date">Departure Flight Number (Ex: ABC#2185)</label>
                                    <input placeholder="Departure Flight Info" id="departure_flight" name="info[departureFlight]"  class="form-control" value="" type="text"/>
                                    
                                </div>
                            <div class="form-group">
                                    <label class="form-label" for="Adults">Adults</label>
                                    <input placeholder="Adults" id="adults" name="info[adults]"  class="form-control" value="" type="number" min="1" max="15"/>
                                    
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="Kids">Kids</label>
                                    <input placeholder="Kids" id="kids"  name="info[kids]"  class="form-control" value=""  type="number" min="0" max="14"/>
                                    <?php echo form_error('info[kids]'); ?>
                                </div>
                                
                            <div class="form-group">
                                <label class="form-label" for="Passangers-Range">Your Country</label>
                                <select id="countries" class="form-control" name="info[country]">
            <option>Select Country</option>
            <option value="Afghanistan">Afghanistan</option>
            <option value="Åland_Islands">a Islands</option>
            <option value="Albania">Albania</option>
            <option value="Algeria">Algeria</option>
            <option value="American_Samoa">American Samoa</option>
            <option value="Andorra">Andorra</option>
            <option value="Angola">Angola</option>
            <option value="Anguilla">Anguilla</option>
            <option value="Antarctica">Antarctica</option>
            <option value="Antigua_And_Barbuda">Antigua and Barbuda</option>
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
            <option value="Belarus">Belarus</option>
            <option value="Belgium">Belgium</option>
            <option value="Belize">Belize</option>
            <option value="Benin">Benin</option>
            <option value="Bermuda">Bermuda</option>
            <option value="Bhutan">Bhutan</option>
            <option value="Bolivia">Bolivia</option>
            <option value="Bosnia_And_Herzegovina">Bosnia and Herzegovina</option>
            <option value="Botswana">Botswana</option>
            <option value="Bouvet_Island">Bouvet Island</option>
            <option value="Brazil">Brazil</option>
            <option value="British_Indian_Ocean_Territory">British Indian Ocean Territory</option>
            <option value="Brunei_Darussalam">Brunei Darussalam</option>
            <option value="Bulgaria">Bulgaria</option>
            <option value="Burkina_Faso">Burkina Faso</option>
            <option value="Burundi">Burundi</option>
            <option value="Cambodia">Cambodia</option>
            <option value="Cameroon">Cameroon</option>
            <option value="Canada">Canada</option>
            <option value="Cape_Verde">Cape Verde</option>
            <option value="Cayman_Islands">Cayman Islands</option>
            <option value="Central_African_Republic">Central African Republic</option>
            <option value="Chad">Chad</option>
            <option value="Chile">Chile</option>
            <option value="China">China</option>
            <option value="Christmas_Island">Christmas Island</option>
            <option value="Cocos_(Keeling)_Islands">Cocos (Keeling) Islands</option>
            <option value="Colombia">Colombia</option>
            <option value="Comoros">Comoros</option>
            <option value="Congo">Congo</option>
            <option value="Congo,_The_Democratic_Republic_Of_The">Congo, The Democratic Republic of The</option>
            <option value="Cook_Islands">Cook Islands</option>
            <option value="Costa_Rica">Costa Rica</option>
            <option value="Cote_D'ivoire">Cote D'ivoire</option>
            <option value="Croatia">Croatia</option>
            <option value="Cuba">Cuba</option>
            <option value="Cyprus">Cyprus</option>
            <option value="Czech_Republic">Czech Republic</option>
            <option value="Denmark">Denmark</option>
            <option value="Djibouti">Djibouti</option>
            <option value="Dominica">Dominica</option>
            <option value="Dominican_Republic">Dominican Republic</option>
            <option value="Ecuador">Ecuador</option>
            <option value="Egypt">Egypt</option>
            <option value="El_Salvador">El Salvador</option>
            <option value="Equatorial_Guinea">Equatorial Guinea</option>
            <option value="Eritrea">Eritrea</option>
            <option value="Estonia">Estonia</option>
            <option value="Ethiopia">Ethiopia</option>
            <option value="Falkland_Islands_(Malvinas)">Falkland Islands (Malvinas)</option>
            <option value="Faroe_Islands">Faroe Islands</option>
            <option value="Fiji">Fiji</option>
            <option value="Finland">Finland</option>
            <option value="France">France</option>
            <option value="French_Guiana">French Guiana</option>
            <option value="French_Polynesia">French Polynesia</option>
            <option value="French_Southern_Territories">French Southern Territories</option>
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
            <option value="Guinea-bissau">Guinea-bissau</option>
            <option value="Guyana">Guyana</option>
            <option value="Haiti">Haiti</option>
            <option value="Heard_Island_And_Mcdonald_Islands">Heard Island and Mcdonald Islands</option>
            <option value="Holy_See_(Vatican_City_State)">Holy See (Vatican City State)</option>
            <option value="Honduras">Honduras</option>
            <option value="Hong_Kong">Hong Kong</option>
            <option value="Hungary">Hungary</option>
            <option value="Iceland">Iceland</option>
            <option value="India">India</option>
            <option value="Indonesia">Indonesia</option>
            <option value="Iran,_Islamic_Republic_Of">Iran, Islamic Republic of</option>
            <option value="Iraq">Iraq</option>
            <option value="Ireland">Ireland</option>
            <option value="Isle_Of_Man">Isle of Man</option>
            <option value="Israel">Israel</option>
            <option value="Italy">Italy</option>
            <option value="Jamaica">Jamaica</option>
            <option value="Japan">Japan</option>
            <option value="Jersey">Jersey</option>
            <option value="Jordan">Jordan</option>
            <option value="Kazakhstan">Kazakhstan</option>
            <option value="Kenya">Kenya</option>
            <option value="Kiribati">Kiribati</option>
            <option value="Korea,_Democratic_People's_Republic_Of">Korea, Democratic People's Republic of</option>
            <option value="Korea,_Republic_Of">Korea, Republic of</option>
            <option value="Kuwait">Kuwait</option>
            <option value="Kyrgyzstan">Kyrgyzstan</option>
            <option value="Lao_People's_Democratic_Republic">Lao People's Democratic Republic</option>
            <option value="Latvia">Latvia</option>
            <option value="Lebanon">Lebanon</option>
            <option value="Lesotho">Lesotho</option>
            <option value="Liberia">Liberia</option>
            <option value="Libyan_Arab_Jamahiriya">Libyan Arab Jamahiriya</option>
            <option value="Liechtenstein">Liechtenstein</option>
            <option value="Lithuania">Lithuania</option>
            <option value="Luxembourg">Luxembourg</option>
            <option value="Macao">Macao</option>
            <option value="Macedonia,_The_Former_Yugoslav_Republic_Of">Macedonia, The Former Yugoslav Republic of</option>
            <option value="Madagascar">Madagascar</option>
            <option value="Malawi">Malawi</option>
            <option value="Malaysia">Malaysia</option>
            <option value="Maldives">Maldives</option>
            <option value="Mali">Mali</option>
            <option value="Malta">Malta</option>
            <option value="Marshall_Islands">Marshall Islands</option>
            <option value="Martinique">Martinique</option>
            <option value="Mauritania">Mauritania</option>
            <option value="Mauritius">Mauritius</option>
            <option value="Mayotte">Mayotte</option>
            <option value="Mexico">Mexico</option>
            <option value="Micronesia,_Federated_States_Of">Micronesia, Federated States of</option>
            <option value="Moldova,_Republic_Of">Moldova, Republic of</option>
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
            <option value="Netherlands_Antilles">Netherlands Antilles</option>
            <option value="New_Caledonia">New Caledonia</option>
            <option value="New_Zealand">New Zealand</option>
            <option value="Nicaragua">Nicaragua</option>
            <option value="Niger">Niger</option>
            <option value="Nigeria">Nigeria</option>
            <option value="Niue">Niue</option>
            <option value="Norfolk_Island">Norfolk Island</option>
            <option value="Northern_Mariana_Islands">Northern Mariana Islands</option>
            <option value="Norway">Norway</option>
            <option value="Oman">Oman</option>
            <option value="Pakistan">Pakistan</option>
            <option value="Palau">Palau</option>
            <option value="Palestinian_Territory,_Occupied">Palestinian Territory, Occupied</option>
            <option value="Panama">Panama</option>
            <option value="Papua_New_Guinea">Papua New Guinea</option>
            <option value="Paraguay">Paraguay</option>
            <option value="Peru">Peru</option>
            <option value="Philippines">Philippines</option>
            <option value="Pitcairn">Pitcairn</option>
            <option value="Poland">Poland</option>
            <option value="Portugal">Portugal</option>
            <option value="Puerto_Rico">Puerto Rico</option>
            <option value="Qatar">Qatar</option>
            <option value="Reunion">Reunion</option>
            <option value="Romania">Romania</option>
            <option value="Russian_Federation">Russian Federation</option>
            <option value="Rwanda">Rwanda</option>
            <option value="Saint_Helena">Saint Helena</option>
            <option value="Saint_Kitts_And_Nevis">Saint Kitts and Nevis</option>
            <option value="Saint_Lucia">Saint Lucia</option>
            <option value="Saint_Pierre_And_Miquelon">Saint Pierre and Miquelon</option>
            <option value="Saint_Vincent_And_The_Grenadines">Saint Vincent and The Grenadines</option>
            <option value="Samoa">Samoa</option>
            <option value="San_Marino">San Marino</option>
            <option value="Sao_Tome_And_Principe">Sao Tome and Principe</option>
            <option value="Saudi_Arabia">Saudi Arabia</option>
            <option value="Senegal">Senegal</option>
            <option value="Serbia">Serbia</option>
            <option value="Seychelles">Seychelles</option>
            <option value="Sierra_Leone">Sierra Leone</option>
            <option value="Singapore">Singapore</option>
            <option value="Slovakia">Slovakia</option>
            <option value="Slovenia">Slovenia</option>
            <option value="Solomon_Islands">Solomon Islands</option>
            <option value="Somalia">Somalia</option>
            <option value="South_Africa">South Africa</option>
            <option value="South_Georgia_And_The_South_Sandwich_Islands">South Georgia and The South Sandwich Islands</option>
            <option value="Spain">Spain</option>
            <option value="Sri_Lanka">Sri Lanka</option>
            <option value="Sudan">Sudan</option>
            <option value="Suriname">Suriname</option>
            <option value="Svalbard_And_Jan_Mayen">Svalbard and Jan Mayen</option>
            <option value="Swaziland">Swaziland</option>
            <option value="Sweden">Sweden</option>
            <option value="Switzerland">Switzerland</option>
            <option value="Syrian_Arab_Republic">Syrian Arab Republic</option>
            <option value="Taiwan,_Province_Of_China">Taiwan, Province of China</option>
            <option value="Tajikistan">Tajikistan</option>
            <option value="Tanzania,_United_Republic_Of">Tanzania, United Republic of</option>
            <option value="Thailand">Thailand</option>
            <option value="Timor-leste">Timor-leste</option>
            <option value="Togo">Togo</option>
            <option value="Tokelau">Tokelau</option>
            <option value="Tonga">Tonga</option>
            <option value="Trinidad_And_Tobago">Trinidad and Tobago</option>
            <option value="Tunisia">Tunisia</option>
            <option value="Turkey">Turkey</option>
            <option value="Turkmenistan">Turkmenistan</option>
            <option value="Turks_And_Caicos_Islands">Turks and Caicos Islands</option>
            <option value="Tuvalu">Tuvalu</option>
            <option value="Uganda">Uganda</option>
            <option value="Ukraine">Ukraine</option>
            <option value="United_Arab_Emirates">United Arab Emirates</option>
            <option value="United_Kingdom">United Kingdom</option>
            <option value="United_States" selected="">United States</option>
            <option value="United_States_Minor_Outlying_Islands">United States Minor Outlying Islands</option>
            <option value="Uruguay">Uruguay</option>
            <option value="Uzbekistan">Uzbekistan</option>
            <option value="Vanuatu">Vanuatu</option>
            <option value="Venezuela">Venezuela</option>
            <option value="Viet_Nam">Viet Nam</option>
            <option value="Virgin_Islands,_British">Virgin Islands, British</option>
            <option value="Virgin_Islands,_U.S.">Virgin Islands, U.S.</option>
            <option value="Wallis_And_Futuna">Wallis and Futuna</option>
            <option value="Western_Sahara">Western Sahara</option>
            <option value="Yemen">Yemen</option>
            <option value="Zambia">Zambia</option>
            <option value="Zimbabwe">Zimbabwe</option>
            </select>
                            </div>

                            <div class="form-group">
                                <label class="" for="Comments">Comments</label>
                                <textarea data-error="Write your Comments" required="" name="info[comments]" class="form-control" id="Comments" rows="7" placeholder="Your Comments"></textarea>
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <label class="" for="Comments">Captcha</label>
<!--                                <p><a href="<?php echo $this->recaptcha->recaptcha_get_signup_url(); ?>" >Get your API Code HERE</a></p>-->
                                <div id="createCaptcha"><?php echo $recaptcha_html; ?></div>                            
    
                                
                            </div>
                        
                        
                    </div>
                    
                        <div class="form-group col-xs-12">
                            <button type="submit"  name="submit" id="bookFormBtn" class="btn btn-common" style="pointer-events: all; cursor: pointer;"><i class="fa fa-envelope"></i> Submit</button>
                            <img src='assets/loader.gif' id='loaderbookForm' class='loaderImg' style="display: none"/>
                        </div>
                    
                </form>
            </div>


        </div>
    </div>
</section>

<link type="text/css" href="<?php echo base_url('assets/js/datetimepicker/bootstrap-datetimepicker.css') ?>" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url('assets/js/datetimepicker/bootstrap-datetimepicker.js') ?>"></script>
<script src="<?php echo base_url('assets/jquery/jquery.validate.js') ?>"></script>
<script src="<?php echo base_url('assets/jquery/additional-methods.js') ?>"></script>
<script src="<?php echo base_url('assets/js/site.js') ?>"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.mdate').datetimepicker({
                                                ignoreReadonly: true,
                                                format: 'dd/mm/yyyy H:ii p',
                                                formatTime: 'H:ii p',
                                                formatDate: 'dd/mm/yyyy',
                                                minDate: new Date(), // it's my birthday
                                                defaultTime: new Date(),
                                                startDate: new Date()
                                            }).on('changeDate', function (e) {
                                                $(this).datetimepicker('hide');
                                            });
     $("#bookForm").validate({
        // Specify the validation rules
        errorPlacement: function(error, element) {
            if (element[0].id == 'recaptcha_response_field') {
                console.log(element);
                $('#recaptcha_widget_div').after(error);
            } else {
                error.insertAfter(element);
            }
        },
        rules: {
            "info[name]": {
                required: true,
                alpha: true,
                minlength: 3
            },
            "info[email]": {
                required: true,
                email: true
            },
            "info[phone]": {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 12
            },
            "info[staying]": {
                required: true
            },
            "info[country]": {
                required: true
            },
            "info[service]": {
                required: true
            },
            "info[arrivalFlight]": {
                required: true,
                nowhitespace: true
            },
            "info[departureFlight]": {
                required: true
            },
            "info[arrivalDate]": {
                required: true
            },
            "info[departureDate]": {
                required:false,
                greaterThan: "#arrival_date"
            },
            "info[adults]": {
                required: true,
                number: true,
                minlength: 1,
                maxlength: 2
            },
            "info[kids]": {
                required: true,
                number: true,
                minlength: 1,
                maxlength: 2
            },
            "info[comments]": {
                required: true
            },
            "recaptcha_response_field": {
                required: true
            }
        },
        // Specify the validation error messages
        messages: {
            "info[name]": {
                required: "Please enter your name"
            },
            "info[email]": {
                required: "Please enter your email",
                email: "Please enter valid email"
            },
            "info[phone]": {
                required: "Please enter your phone",
                number: "Digits only",
                minlength: "Please enter valid phone no",
                maxlength: "Please enter valid phone no"
            },
            "info[staying]": {
                required: "Please enter above field"
                
            },
            "info[country]": {
                required: "Please select your country"
            },
            "info[service]": {
                required: "Please select type of service"
            },
            "info[arrivalFlight]": {
                required: "Please enter arrival flight detail"
            },
            "info[departureFlight]": {
                required: "Please enter departure flight detail"
            },
            "info[adults]": {
                required: "Please enter no of adults"
            },
            "info[kids]": {
                required: "Please enter no of kids"
            },
            "info[comments]": {
                required: "Please enter comments"
            },
            "recaptcha_response_field": {
                required: "Please enter captcha"
            }
        },
        submitHandler: function(form) {
            $("#" + form.id + "").find("button[type=submit]").prop("disabled", true);
            $("#my" + form.id).remove();
            $("#loader" + form.id).show();
            var url = form.action;
            $.ajax({
                url: url,
                cache: false,
                type: form.method,
                data: $(form).serialize(),
                dataType: "json",
                success: function(response) {
                    $("#loader" + form.id).hide();
                    console.log("response", response);
                    if (response.status == 200) {
                        $("#" + form.id)[0].reset();
                        setTimeout(function(){
                            window.location.href="<?php echo site_url('book-it-done')?>"
                        },1000);
                    }
                    var msg = msgDiv(response.status, response.message, form.id);
                    $(msg).insertAfter("#" + form.id + "Btn");
                    $("#" + form.id + "").find("button[type=submit]").prop("disabled", false);
                },
                error: function(errorResponse) {
                    console.log("errorResponse", errorResponse);
                    var msg = msgDiv(errorResponse.status, errorResponse.statusText, form.id);
                    $(msg).insertBefore("#" + form.id);
                    $("#" + form.id + "").find("button[type=submit]").prop("disabled", false);
                    jQuery("#recaptcha_reload").click();
                    $("#loader" + form.id).hide();
                }
            });
            return false;
        }
    });
   
})

</script>
</body>
</html>
