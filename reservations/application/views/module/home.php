<link type="text/css" href="<?php echo base_url('assets/js/datetimepicker/bootstrap-datetimepicker.css') ?>" rel="stylesheet" />
<section class="middleContent aboutdesc">
	<div class="container">
      <div class="row">		
		<div class="col-md-8 col-sm-12">
			
				<div class="about_sec_head">
					<h2>We are Impala</h2>
				</div>
				<div class="descriptions">
					<p>A Touristic Ground Transportation Company, an experienced, honest and dedicated transportation services company offering airport shuttles, VIP and private transportation.</p>
					<p>We always have in mind your safety (all our cars are checked periodically and have full insurance), comfort (all our cars have air conditioning and bottled water on board)</p>
					<p>Impala is a Ground Transportation Company, passionate, savvy travel specialists since 2004. We design travel solutions inspired by your travel needs. Experience the difference of our exclusive access, powerful industry recognition and obsession with customer service.we invite you to put your email and your code in order to complete your reservation.... </p>
				</div>
			
		</div>
		<div class="col-md-4 col-sm-12">
			<div class="spl_logo">
				<a href="<?php echo base_url(); ?>"><img src="<?php echo base_url('assets/images/logo.jpg')?>"/></a>
			</div>
		</div>
      </div>
    </div></section>
	<section id="formHolder">
		<div class="container">
		<?php if ($mstatus == 'error') { ?><div class="alert alert-danger"><?php echo $msg; ?></div><?php } ?>
		<?php //print_r($loginData); ?>
			<?php if (count($loginData) == 0) { ?>
				<div class="loginFformWrap">
					<h4>Impala Login</h4>
					<form action="<?php echo site_url('transportation/login')?>" method="post" class="loginForm" id="loginForm">
						<div class="otherFileds">
							<div class="form-group col-md-12">
								<label for="email">Email address:</label>
								<input type="email" class="form-control" id="email" name="info[email]">
							</div>
							<div class="form-group col-md-12">
								<label for="code">Code</label>
								<input type="text" class="form-control" id="code" name="info[code]">
							</div>
							<div class="form-group col-md-12 col-xs-12">
								
								<div class="g-recaptcha" data-sitekey="6Le6rVQUAAAAAOsFndx1ueoPnu37nY7wYk_gjN0m"></div>
								<label id="captcha-error" class="verror" for="captcha" ></label>
							</div>
							<div class="form-group col-md-12 col-sm-12 col-xs-12 text-center">
							<button type="submit" class="btn btn-default">Login Now</button>
							</div>
						</div>
					</form>	 
			</div>
			<?php 
			if(isset($_GET['type'])){
				//redirect('http://localhost/reservations/');
				//redirect($this->uri->uri_string());
			}
	} else { ?>
				

		<?php echo validation_errors(); ?>
                        <?php
                            // echo site_url("transportation/bookPrivate"); 
                        ?>
						<div class="mainBookingForm">
                        <form  action="<?php echo site_url("transportation/paymentMethods") ?>" name="privateTransForm" id="privateTransForm" class="shake" role="form" method="post" novalidate="true">
						<div class="row">
                            
                        <input type="hidden" name="amount" id="cost" value="0"/>
				<div class="form-group col-md-12 col-sm-12 col-xs-12 select_type_block">
					
					<div class="row">
						<div class="col-md-8">
							<h4>Select Transport Type </h4>
							<div class="select_type_block_wrap">
								<div class="radioBlock radio1">
									<?php $tempdisableCabo = (isset($disableCabo)) ? $disableCabo : ''; ?>
									<label><input type="radio" id="cabo_shuttle" <?php echo $tempdisableCabo; ?> name="info[type]" onchange="setHotels()"  class="" value="cabo_shuttle" > 
									<span>Cabo Shuttle</span></label>
								</div>
									<?php $tempdisablePrivate = (isset($disablePrivate)) ? $disablePrivate : ''; ?>
								<div class="radioBlock radio2">
									<label><input type="radio" id="private_transport"  <?php echo $tempdisablePrivate; ?> name="info[type]" onchange="setHotels()" checked class="" value="private_transport" >  
									<span>Private Transportation</span></label>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<h4>Estimated Cost </h4>
							<div class="totalCostingWrap">
								<span class="amount" >$<span id="amount">0</span></span>
							</div>
							<style>
								#errorInfo{
									display:none;
									margin-top: 15px;
									color: red;    								
								}
							</style>
							<span id="errorInfo">
								<!--<b>Passenger Range</b> or <br/> <span></span> is not available!-->
								The Type of Service is not available.
							</span>
						</div>
					</div>
					<div>
					<?php echo form_error('info[type]'); ?>
					</div>
				</div>	
			  <div class="col-md-12 otherFileds">
			  	<div class="detailsBox">
				  	<h4>Personal Details</h4>
					<div class="row">
						<div class="form-group col-md-4 col-sm-6 col-xs-6">
							<label for="Name">Full Name</label>
							<input id="name" name="info[name]"  class="form-control" value="<?php echo (isset($info['name'])) ? $info['name'] : @$_GET['name']; ?>" type="text">
							<?php echo form_error('info[name]'); ?>
						</div>
						<div class="form-group col-md-4 col-sm-6 col-xs-6">
							<label for="email">Email address:</label>
							<input id="email" readonly name="info[email]"  class="form-control" value="<?php echo (isset($info['email'])) ? $info['email'] : @$_GET['email']; ?>" type="email"/>
							<?php echo form_error('info[email]'); ?>
						</div>
						<div class="form-group col-md-4 col-sm-6 col-xs-6">
							<label for="Phone">Phone</label>
							<input id="Phone"   name="info[phone]" class="form-control" value="<?php echo (isset($info['phone'])) ? $info['phone'] : ''; ?>" type="text" />
							<?php echo form_error('info[phone]'); ?>
						</div>
					</div>
			  	</div>
				<div class="detailsBox">
					<h4>Passenger Details</h4>
					<div class="row">	
						<div class="form-group col-md-4 col-sm-6 col-xs-6">
							<label for="passanger-range">Passanger Range</label>
							<input placeholder="#Passengers"  onchange="setCost()" id="passangers_range_cabo_shuttle" style = "display:<?php echo $info['type'] == 'cabo_shuttle' ? 'block' : 'none'; ?>" step="1" pattern="[0-9]" name="info[passengers]" min="1" max="15" class="form-control" value="1" type="number" >
							<select  class="form-control ttt" style = "display:<?php echo $info['type'] == 'private_transport' ? 'block' : 'none'; ?>" id="passangers_range_private_transport" name="info[passengers]" onchange="setCost()">
							
								<option value="1-5" <?php echo (isset($info['passengers']) && $info['passengers'] == '1-5') ? 'selected' : ''; ?>>1-5 Passengers</option>
								<option value="6-10" <?php echo (isset($info['passengers']) && $info['passengers'] == '6-10') ? 'selected' : ''; ?>>6-10 Passengers</option>
								<option value="11-15" <?php echo (isset($info['passengers']) && $info['passengers'] == '11-15') ? 'selected' : ''; ?>>11-15 Passengers</option>
							</select>                 
						</div>
						<div class="form-group col-md-4 col-sm-6 col-xs-6">
							<label for="start-location">Resort</label>
							<select class="form-control"  id="hotelId" name="info[hotelId]" onchange="setCost()">
													
								<?php foreach ($dbHotels as $hotel) { ?>
									<option value="<?php echo $hotel['id']; ?>" <?php echo (isset($info['hotelId']) && $info['hotelId'] == $hotel['id']) ? 'selected' : ''; ?>><?php echo $hotel['name']; ?></option>
								<?php 	} ?>

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
						<!-- HERE -->
						<div id="showAdult" >
							<div class="form-group col-md-4 col-sm-6 col-xs-6 mt-30">
								<label for="adults">Adults</label>
								
								<input id="adults" name="info[adults]"  class="form-control" value="<?php echo (isset($info['adults'])) ? $info['adults'] : ''; ?>" type="number" min="1" max="15"/>

								<?php echo form_error('info[adults]'); ?>
							</div>
							<div class="form-group col-md-3 col-sm-6 col-xs-6 mt-30">
								<label for="kids">Kids</label>
								
								<input id="kids"  name="info[kids]"  class="form-control" value="<?php echo (isset($info['kids'])) ? $info['kids'] : ''; ?>"  type="number" min="0" max="14"/>

								<?php echo form_error('info[kids]'); ?>
							</div>
						</div>

					</div>
				</div>
				<div class="detailsBox">
					<h4>Flight Details</h4>
					<div class="row">	
						<div class="form-group col-md-3 col-sm-6 col-xs-6">
							<label for="resort">Arrival Date Time</label>
							<!-- <input type="text" class="form-control" id="resort" placeholder="(DD//MM//YY) (HH/MM/SS)"> -->
							<input readonly id="arrival_date" name="info[arrivalDate]" onchange="setCost()" value="<?php echo (isset($info['arrivalDate'])) ? $info['arrivalDate'] : '' ?>"  class="form-control mdate" type="text"/>
												<?php echo form_error('info[arrivalDate]'); ?>
						</div>
						<div class="form-group col-md-3 col-sm-6 col-xs-6">
							<label for="resort">Arrival Flight Number</label>
							<!-- <input type="text" class="form-control" id="resort" placeholder="(Ex: ABC#2185)"> -->
							<input id="arrival_flight" name="info[arrivalFlight]"   class="form-control" value="<?php echo (isset($info['arrivalFlight'])) ? $info['arrivalFlight'] : ''; ?>" type="text"/>
												<?php echo form_error('info[arrivalFlight]'); ?>
							</div>
							<div id="departure">
						<div class="form-group col-md-3 col-sm-6 col-xs-6">
							<label for="resort">Departure Date Time</label>
							<!-- <input type="text" class="form-control" id="resort" placeholder="(DD//MM//YY) (HH/MM/SS)"> -->
							<input readonly id="departure_date" name="info[departureDate]"  value="<?php echo (isset($info['departureDate'])) ? $info['departureDate'] : '' ?>" class="form-control mdate" type="text"/>
												<?php echo form_error('info[departureDate]'); ?>
						</div>
						<div class="form-group col-md-3 col-sm-6 col-xs-6">
							<label for="resort">Departure Flight Number</label>
							<!-- <input type="text" class="form-control" id="resort" placeholder="(Ex: ABC#2185)"> -->
							<input  id="departure_flight" name="info[departureFlight]"  class="form-control" value="<?php echo (isset($info['departureFlight'])) ? $info['departureFlight'] : ''; ?>" type="text"/>
												<?php echo form_error('info[arrivalFlight]'); ?>
						</div>
						</div>
					</div>
				</div>
				<!-- <div id="showAdult" > -->
			  <!-- <div class="form-group col-md-4 col-sm-6 col-xs-6">
				<label for="adults">Adults</label>
				
				<input id="adults" name="info[adults]"  class="form-control" value="<?php echo (isset($info['adults'])) ? $info['adults'] : ''; ?>" type="number" min="1" max="15"/>

				<?php //echo form_error('info[adults]'); ?>
			  </div>
			  <div class="form-group col-md-3 col-sm-6 col-xs-6">
				<label for="kids">Kids</label>
				
				<input id="kids"  name="info[kids]"  class="form-control" value="<?php echo (isset($info['kids'])) ? $info['kids'] : ''; ?>"  type="number" min="0" max="14"/>

				<?php //echo form_error('info[kids]'); ?>
			  </div> -->
			  <!-- </div> -->
			  <!-- <div class="col-md-1 col-sm-1 col-xs-1">
			  <label></label>
				<span class="amount" >$<span id="amount">0</span></span>
			  </div> -->
			  	<div class="detailsBox nopaddingtop">
					<h4>Additional Comments</h4>
					<div class="row">	
						<div class="form-group col-md-12 col-sm-12 col-xs-12">
							<label for="Comments">Comments</label>
							<textarea id="comments" name="info[comments]"  rows="3"  class="form-control"><?php echo (isset($info['comments'])) ? $info['comments'] : ''; ?></textarea>
												<?php echo form_error('info[comments]'); ?>
						</div>
					</div>
				</div>
			  <div class="form-group col-md-12 col-sm-12 col-xs-12 mb-0">
				<button type="submit" class="btn btn-default" id="privateTransFormBtn"><i class="fa  fa-paper-plane"></i>Book Now</button>
				<button type="button" class="btn btn-default"  id="cancelFormBtn" onclick="cancelBook()" >Cancel</button>
				<img src="<?php echo base_url('assets/loader.gif'); ?>" alt="loader-img" id="loaderprivateTransForm" class="in-hidden"/>
			  </div>
			  </div>
		</div>
			</form> 
		</div>
		
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
																								$(this).parents(".form-group").addClass("focused");

                                            });


<?php if (isset($info['passengers']) && !empty($info['passengers'])) { ?>
setCost();
<?php 
} ?>

<?php if (isset($info['passengers']) && !empty($info['passengers']) && isset($info['hotelId']) && !empty($info['hotelId'])) { ?>

                                                setCost();

<?php 
} ?>

                                        });

                                       



</script>

	<script src='https://www.google.com/recaptcha/api.js'></script>