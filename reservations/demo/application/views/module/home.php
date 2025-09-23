<link type="text/css" href="<?php echo base_url('assets/js/datetimepicker/bootstrap-datetimepicker.css') ?>" rel="stylesheet" />
<section class="middleContent"><div class="container">
      <div class="row">
	  <div class="col-md-12">
        <p><b>Lorem ipsum</b> dolor sit amet, consectetur adipiscing elit. Vivamus rutrum vitae neque ut mollis.<br> Maecenas blandit consectetur congue. Vivamus ullamcorper sed elit at finibus. <br>Fusce auctor tincidunt libero, sed cursus sapien tempus sed. <br>Phasellus varius eros augue, eget volutpat urna condimentum tristique.</p>
      </div>
      </div>
    </div></section>
	<section id="formHolder">
		<div class="container">
		<?php if ($mstatus == 'error') { ?><div class="alert alert-danger"><?php echo $msg; ?></div><?php } ?>
			<?php if (count($loginData) == 0) { ?>
		<form action="<?php echo site_url('transportation/login')?>" method="post" class="loginForm" id="loginForm">
			  <div class="form-group col-md-6 col-sm-6 col-xs-6">
				<label for="email">Email address:</label>
				<input type="email" class="form-control" id="email" name="info[email]" placeholder="Email Address">
			  </div>
			  <div class="form-group col-md-6 col-sm-6 col-xs-6">
				<label for="code">Code</label>
				<input type="text" class="form-control" id="code" name="info[code]" placeholder="Code">
			  </div>
			  <div class="form-group col-md-12 col-xs-12">
				
				<div class="g-recaptcha" data-sitekey="6Le6rVQUAAAAAOsFndx1ueoPnu37nY7wYk_gjN0m"></div>
				<label id="captcha-error" class="verror" for="captcha" ></label>
			  </div>
			  <div class="form-group col-md-12 col-sm-12 col-xs-12 text-center">
			  <button type="submit" class="btn btn-default">Submit</button>
			  </div>
			</form>	 
			<?php 
	} else { ?>
				

		<?php echo validation_errors(); ?>
                    
                        <form  action="<?php echo site_url("transportation/bookPrivate") ?>" name="privateTransForm" id="privateTransForm" class="mt-30 shake" role="form" method="post" novalidate="true" class="mt-20">
                            
                        <input type="hidden" name="amount" id="cost" value="0"/>
												<div class="form-group col-md-12 col-sm-12 col-xs-12">
				<label for="Name">Transport Type</label>
				<input type="radio" id="cabo_shuttle" name="info[type]"  class="" value="cabo_shuttle" checked> Cabo Shuttle
				&nbsp;<input type="radio" id="private_transport" name="info[type]"  class="" value="private_transport" > Private Transportation
                                    <?php echo form_error('info[type]'); ?>
			  </div>	
			  <div class="form-group col-md-4 col-sm-6 col-xs-6">
				<label for="Name">Name</label>
				<input placeholder="Full Name" id="name" name="info[name]"  class="form-control" value="<?php echo (isset($info['name'])) ? $info['name'] : @$_GET['name']; ?>" type="text">
                                    <?php echo form_error('info[name]'); ?>
			  </div>
			  <div class="form-group col-md-4 col-sm-6 col-xs-6">
				<label for="email">Email address:</label>
				<input placeholder="Email Address" id="email" readonly name="info[email]"  class="form-control" value="<?php echo (isset($info['email'])) ? $info['email'] : @$_GET['email']; ?>" type="email"/>
                                    <?php echo form_error('info[email]'); ?>
			  </div>
			  <div class="form-group col-md-4 col-sm-6 col-xs-6">
				<label for="Phone">Phone</label>
				<input placeholder="Phone" id="Phone"   name="info[phone]" class="form-control" value="<?php echo (isset($info['phone'])) ? $info['phone'] : ''; ?>" type="text" />
                                    <?php echo form_error('info[phone]'); ?>
			  </div>
			  <div class="form-group col-md-4 col-sm-6 col-xs-6">
				<label for="passanger-range">Passanger Range</label>
				                                   <select class="form-control"  id="passangers_range" name="info[passengers]" onchange="setCost()">
                                        <option value="1-5" <?php echo (isset($info['passengers']) && $info['passengers'] == '1-5') ? 'selected' : ''; ?>>1-5 Passengers</option>
                                        <option value="6-10" <?php echo (isset($info['passengers']) && $info['passengers'] == '6-10') ? 'selected' : ''; ?>>6-10 Passengers</option>
                                        <option value="11-15" <?php echo (isset($info['passengers']) && $info['passengers'] == '11-15') ? 'selected' : ''; ?>>11-15 Passengers</option>
                                    </select>
				</div>
			  <div class="form-group col-md-4 col-sm-6 col-xs-6">
				<label for="start-location">Resort</label>
				<select class="form-control"  id="hotelId" name="info[hotelId]" disabled onchange="setCost()">
                                        <option value="">Select your resort</option>
                                        <?php foreach ($dbHotels as $hotel) { ?>
                                            <option value="<?php echo $hotel['id']; ?>" <?php echo (isset($info['hotelId']) && $info['hotelId'] == $hotel['id']) ? 'selected' : ''; ?>><?php echo $hotel['name']; ?></option>
                                        <?php 
																																						} ?>

                                    </select>
                                    <?php echo form_error('info[hotelId]'); ?>
			  </div>
			  
				<?php
			$is_round_trip = '';
			$is_one_way = '';
			if (isset($info['service']) && $info['service'] == 'round_trip') {
				$is_round_trip = 'selected';
			}
			if (isset($_GET['trip_type']) && $_GET['trip_type'] == 'round_trip') {
				$is_round_trip = 'selected';
			}
			if (isset($info['service']) && $info['service'] == 'one_way') {
				$is_one_way = 'selected';
			}
			if (isset($_GET['trip_type']) && $_GET['trip_type'] == 'one_way') {
				$is_one_way = 'selected';
			}
			?>
			  <div class="form-group col-md-4 col-sm-6 col-xs-6">
				<label for="trip-type">Trip Type</label>
				<select class="form-control"  id="trip_type"  name="info[service]"  onchange="showDep(this.value);setCost();">
                                        <option value="round_trip" <?php echo $is_round_trip; ?>>Round trip</option>
                                        <option value="one_way" <?php echo $is_one_way; ?>>One Way</option>
                                    </select>
				</div>
			  <div class="form-group col-md-3 col-sm-6 col-xs-6">
				<label for="resort">Arrival Date Time</label>
				<!-- <input type="text" class="form-control" id="resort" placeholder="(DD//MM//YY) (HH/MM/SS)"> -->
				<input placeholder="(DD//MM//YY) (HH/MM/SS)" readonly id="arrival_date" name="info[arrivalDate]" onchange="setCost()" value="<?php echo (isset($info['arrivalDate'])) ? $info['arrivalDate'] : '' ?>"  class="form-control mdate" type="text"/>
                                    <?php echo form_error('info[arrivalDate]'); ?>
			  </div>
			  <div class="form-group col-md-3 col-sm-6 col-xs-6">
				<label for="resort">Arrival Flight Number</label>
				<!-- <input type="text" class="form-control" id="resort" placeholder="(Ex: ABC#2185)"> -->
				<input placeholder="(Ex: ABC#2185)" id="arrival_flight" name="info[arrivalFlight]"   class="form-control" value="<?php echo (isset($info['arrivalFlight'])) ? $info['arrivalFlight'] : ''; ?>" type="text"/>
                                    <?php echo form_error('info[arrivalFlight]'); ?>
				</div>
				<div id="departure">
			  <div class="form-group col-md-3 col-sm-6 col-xs-6">
				<label for="resort">Departure Date Time</label>
				<!-- <input type="text" class="form-control" id="resort" placeholder="(DD//MM//YY) (HH/MM/SS)"> -->
				<input placeholder="(DD/MM/YYYY, HH:MM, AM/PM)" readonly id="departure_date" name="info[departureDate]"  value="<?php echo (isset($info['departureDate'])) ? $info['departureDate'] : '' ?>" class="form-control mdate" type="text"/>
                                    <?php echo form_error('info[departureDate]'); ?>
			  </div>
			  <div class="form-group col-md-3 col-sm-6 col-xs-6">
				<label for="resort">Departure Flight Number</label>
				<!-- <input type="text" class="form-control" id="resort" placeholder="(Ex: ABC#2185)"> -->
				<input placeholder="(Ex: ABC#2185)" id="departure_flight" name="info[departureFlight]"  class="form-control" value="<?php echo (isset($info['departureFlight'])) ? $info['departureFlight'] : ''; ?>" type="text"/>
                                    <?php echo form_error('info[arrivalFlight]'); ?>
				</div>
				</div>
			  <div class="form-group col-md-4 col-sm-6 col-xs-6">
				<label for="adults">Adults</label>
				
				<input placeholder="Adults" id="adults" name="info[adults]"  class="form-control" value="<?php echo (isset($info['adults'])) ? $info['adults'] : ''; ?>" type="number" min="1" max="15"/>

				<?php echo form_error('info[adults]'); ?>
			  </div>
			  <div class="form-group col-md-3 col-sm-6 col-xs-6">
				<label for="kids">Kids</label>
				
				<input placeholder="Kids" id="kids"  name="info[kids]"  class="form-control" value="<?php echo (isset($info['kids'])) ? $info['kids'] : ''; ?>"  type="number" min="0" max="14"/>

				<?php echo form_error('info[kids]'); ?>
			  </div>
			  <div class="col-md-1 col-sm-1 col-xs-1">
			  <label></label>
				<span class="amount" >$<span id="amount">0</span></span>
			  </div>
			  <div class="form-group col-md-12 col-sm-12 col-xs-12">
				<label for="Comments">Comments</label>
				<textarea placeholder="Type message here" id="comments" name="info[comments]"  rows="3"  class="form-control"><?php echo (isset($info['comments'])) ? $info['comments'] : ''; ?></textarea>
                                    <?php echo form_error('info[comments]'); ?>
			  </div>
			  <div class="form-group col-md-12 col-sm-12 col-xs-12">
				<button type="submit" class="btn btn-default" id="privateTransFormBtn"><i class="fa  fa-paper-plane"></i>Book Now</button>
				<img src="<?php echo base_url('assets/loader.gif'); ?>" alt="loader-img" id="loaderprivateTransForm" class="in-hidden"/>
			  </div>
			</form> 
		
			<?php 
	} ?>
		</div>
    </section>
    
    <script type="text/javascript" src="<?php echo base_url('assets/js/datetimepicker/bootstrap-datetimepicker.js') ?>"></script>



<script type="text/javascript">

                                        jQuery(function ($) {

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





<?php if (isset($info['passengers']) && !empty($info['passengers']) && isset($info['hotelId']) && !empty($info['hotelId'])) { ?>

                                                setCost();

<?php 
} ?>

                                        });

                                       



</script>

	<script src='https://www.google.com/recaptcha/api.js'></script>