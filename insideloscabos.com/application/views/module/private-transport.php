<link type="text/css" href="<?php echo base_url('assets/js/datetimepicker/bootstrap-datetimepicker.css') ?>" rel="stylesheet" />


<section class="quick-section section">

    <h1 class="quick-title wow fadeInDownBig white">Book The Best Private Transportation </h1>

    <div class="form-section new-comment  wow fadeInDownBig">

        <div class="container quick-container">			

            <div class="col-md-4">

                <div class="form-group">

                    <label for="Passangers-Range" class="form-label">Resort</label>

                    <select class="form-control" id="hotel" name="info[hotel]">

                        <option value="">Select your resort</option>

                        <?php foreach ($dbHotels as $hotel) { ?>

                            <option value="<?php echo $hotel['id']; ?>"><?php echo $hotel['name']; ?></option>

                        <?php } ?>



                    </select>

                </div>

            </div>

            <div class='col-md-2'>

                <div class="form-group">

                    <label for="From" class="form-label">Arrival </label>

                    <div class='input-group date' id='datepicker6'>

                        <input type='text' class="form-control" />

                        <span class="input-group-addon">

                            <span class="fa fa-calendar"></span>

                        </span>

                    </div>

                </div>

            </div>

            <div class='col-md-2'>

                <div class="form-group">

                    <label for="username" class="form-label">Departure</label>

                    <div class='input-group date' id='datepicker7'>

                        <input type='text' class="form-control" />

                        <span class="input-group-addon">

                            <span class="fa fa-calendar"></span>

                        </span>

                    </div>

                </div>

            </div>

            <div class="col-md-2">

                <div class="form-group">

                    <label for="username" class="form-label">Passenger Range</label>

                    <select class="form-control">

                        <option value="1">1-5</option>

                        <option value="2">6-10</option>

                        <option value="3">10-15</option>

                    </select>

                </div>

            </div>               

            <div class="col-md-2 mt-30">

                <button type="submit" class="btn btn-common submit-btn"><i class="fa fa-paper-plane-o mr-5"></i>Submit</button>    

            </div>

        </div>

    </div>

</section>



<section class="weekly-offer  section">

    <div class="container wow fadeInRight">

        <h2 class="section-title wow fadeInUpQuick">

            Weekly Best Offer

        </h2>

        <div class="weekly-offer-div">

            <a href="#">

                <label>Monday</label>

                <label>21 Feb</label>

                <label class="offer-price">702 USD</label>

            </a>

        </div>

        <div class="weekly-offer-div">

            <a href="#">

                <label>Tuesday</label>

                <label>22 Feb</label>

                <label class="offer-price">720 USD</label>

            </a>

        </div>

        <div class="weekly-offer-div">

            <a href="#">

                <label>Wednesday</label>

                <label>23 Feb</label>

                <label class="offer-price">730 USD</label>

            </a>

        </div>

        <div class="weekly-offer-div">

            <a href="#">

                <label>Thursday</label>

                <label>24 Feb</label>

                <label class="offer-price">800 USD</label>

            </a>

        </div>

        <div class="weekly-offer-div">

            <a href="#">

                <label>Friday</label>

                <label>25 Feb</label>

                <label class="offer-price">820 USD</label>

            </a>

        </div>

        <div class="weekly-offer-div">

            <a href="#">

                <label>Saturday</label>

                <label>26 Feb</label>

                <label class="offer-price">830 USD</label>

            </a>

        </div>

        <div class="weekly-offer-div">

            <a href="#">

                <label>Sunday</label>

                <label>27 Feb</label>

                <label class="offer-price">850 USD</label>

            </a>

        </div>

    </div>   

</section>



<section class="section-padding" >

    <!-- Container Starts -->

    <div class="container">

        <div class="row">                  

            <div class="col-md-12  col-xs-12 wow  fadeInRight " data-wow-delay=".3s">

                <div class="content-inner">

                    <h2 class="quick-title wow fadeInLeftBig ">Cabo Private Transportation</h2>

                    <p>
                        Are you looking for the best <strong>transportation in Los Cabos?</strong> If you are, <strong>Inside Los Cabos</strong> is here to help you with the best and the most comfortable, air-conditioned <strong>airport transportation service!</strong> No delays, no sharing with strangers, no stops, and no hassles while riding in Los Cabos. You get professional bilingual chauffeurs to your <strong>Cabo hotel</strong>, condo, or private residence. Best pricing, with everyday discounts, and services are guaranteed!
                    </p>

                    <p>
                        Whether you are on a <strong>family trip</strong> or a <strong>business trip</strong>, you can trust our <strong>Cabo San Lucas</strong> and <strong>San Jose Del Cabo airport transportation</strong> as we prioritize your satisfaction before anything. 
                    </p>

                    <p>
                        Our service includes:
                    </p>

                    <p>
                        <i class="fa fa-check" style="color:green;"></i>
                        Personalized attention
                    </p>
                    <p>
                        <i class="fa fa-check" style="color:green;"></i>
                        Arrival flight monitoring
                    </p>
                    <p>
                        <i class="fa fa-check" style="color:green;"></i>
                        Reliable and professional customer service
                    </p>
                    <p>
                        <i class="fa fa-check" style="color:green;"></i>
                        Economical - that means no hidden fees!
                    </p>
                    <p>
                        <i class="fa fa-check" style="color:green;"></i>
                        Total privacy - that means no one else inside the vehicle but you and your guests
                    </p>
                    <p>
                        <i class="fa fa-check" style="color:green;"></i>
                        No stops on the way
                    </p>
                    <p>
                        <i class="fa fa-check" style="color:green;"></i>
                        A/C vehicles of recent models
                    </p>
                    <p>
                        <i class="fa fa-check" style="color:green;"></i>
                        No timeshare invitations, only first-class service
                    </p>

                    <p>
                        Vehicles are also available at daily or hourly rates for all your transportation needs.
                        Only the <strong>best airport transport services in Los Cabos</strong> are available with Inside Los Cabos, like <strong>private transfers, VIP first-class transportation</strong>, and more!
                    </p>                         

                </div>

            </div>

        </div>
         
        <div class="row">
            <div class="col-12 col-md-4 vehicle-card">
                <div class="vehicle-img text-center">
                    <img class="img-fluid" src="<?php echo base_url('assets/img/suv.webp'); ?>" width="100%" height="100%" alt="Suv vehicle">
                </div>

                <div class="vehicle-content text-center">
                    <h4 class="section-title">
                        Suburban <br>
                        <small class="text-muted d-block">The luxury choice</small>
                    </h4>

                    <p>
                        This vehicle is available for 1 to 5 passengers, has space for one large suitcase per passenger, and includes A/C and amenities per passenger.
                    </p>
                </div>
            </div>
                
            <div class="col-12 col-md-4 vehicle-card">
                <div class="vehicle-img text-center">
                    <img class="img-fluid" src="<?php echo base_url('assets/img/hiace.webp'); ?>" width="100%" height="100%" alt="Urban vehicle">
                </div>

                <div class="vehicle-content text-center">
                    <h4 class="section-title">
                        Hiace Van <br>
                        <small class="text-muted d-block">The family's choice</small>
                    </h4>

                    <p>
                        This vehicle is available for 1 to 10 passengers, has space for one large suitcase per passenger, and includes A/C and amenities per passenger.
                    </p>
                </div>
            </div>

            <div class="col-12 col-md-4 vehicle-card">
                <div class="vehicle-img text-center">
                    <img class="img-fluid" src="<?php echo base_url('assets/img/sprinter.webp'); ?>" width="100%" height="100%" alt="Sprinter vehicele">
                </div>

                <div class="vehicle-content text-center">
                    <h4 class="section-title">
                        Sprinter <br>
                        <small class="text-muted d-block">The group's choice </small>
                    </h4>

                    <p>
                        This vehicle is available for 1 to 15 passengers, has space for one medium suitcase per passenger, and includes A/C and amenities per passenger.
                    </p>
                </div>
            </div>
        </div><!-- /.row -->

    </div>

    <!-- Container Ends -->

</section>



<section class="pb-50 form-main">

    <div class="container">

        <div class="row">

            <!-- BLog Article Section -->

            <div class="col-md-12">

                <!-- Private Transfer Section -->                                               

                <div class="new-comment trip-form clearfix wow fadeInUp" data-wow-delay="0.3s">

                    

                    <h3 class="small-title">Private Transportation Hassle Free 
                    <div class="offerText pull-right">
                        <!-- <h4>February in Los Cabos! <span>FebY18</span> And get <span>
                        5% </span> off </h4> -->
                    </div>
                    </h3>

                    <?php if ($mstatus == 'error') { ?><div class="alert alert-danger"><?php echo $msg; ?></div><?php } ?>
                   
                    <form  action="/payment-method" name="privateTransForm" id="privateTransForm" class="mt-30 shake" role="form" method="post" novalidate="true" class="mt-20">

                        <input type="hidden" id="type" name="info[type]" value="private_transport"/>

                        <input type="hidden" name="amount" id="cost" value="0"/>

                        <div class="row">

                            <div class="col-md-4">

                                <div class="form-group">

                                    <label class="form-label" for="name">Name</label>

                                    <input placeholder="Full Name" id="name" name="info[name]"  class="form-control" value="<?php echo (isset($info['name'])) ? $info['name'] : @$_GET['name']; ?>" type="text">

                                    <?php echo form_error('info[name]'); ?>

                                </div>

                            </div>

                            <!-- /.col-md-6  -->

                            <div class="col-md-4">

                                <div class="form-group">

                                    <label class="form-label" for="Email">Email</label>

                                    <input placeholder="Email Address" id="email"  name="info[email]"  class="form-control" value="<?php echo (isset($info['email'])) ? $info['email'] :  @$_GET['email']; ?>" type="email"/>

                                    <?php echo form_error('info[email]'); ?>

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="form-group">

                                    <label class="form-label" for="Phone">Phone</label>

                                    <input placeholder="Phone" id="Phone"   name="info[phone]" class="form-control" value="<?php echo (isset($info['phone'])) ? $info['phone'] : ''; ?>" type="text" />

                                    <?php echo form_error('info[phone]'); ?>

                                </div>

                                </div>

                        </div>

                        <div class="row">

                            <div class="col-md-4">

                                <div class="form-group">

                                    <label class="form-label" for="Passangers-Range">Passenger Range</label>

                                    <select class="form-control"  id="passangers_range" name="info[passengers]" onchange="setCost()">

                                        <option value="1-5" <?php echo (isset($info['passengers']) && $info['passengers'] == '1-5') ? 'selected' : ''; ?>>1-5 Passengers (Suv)</option>

                                        <option value="6-10" <?php echo (isset($info['passengers']) && $info['passengers'] == '6-10') ? 'selected' : ''; ?>>6-10 Passengers (Van)</option>

                                        <option value="11-15" <?php echo (isset($info['passengers']) && $info['passengers'] == '11-15') ? 'selected' : ''; ?>>11-15 Passengers (Sprinter)</option>

                                    </select>

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="form-group">

                                    <label class="form-label" for="resrot">Resort</label>

                                    <select class="form-control"  id="hotelId" name="info[hotelId]" onchange="setCost(event)">

                                        <option value="">Select your resort</option>

                                        <?php foreach ($dbHotels as $hotel) { ?>

                                            <option value="<?php echo $hotel['id']; ?>" <?php echo (isset($info['hotelId']) && $info['hotelId'] == $hotel['id']) ? 'selected' : ''; ?>><?php echo $hotel['name']; ?></option>

                                        <?php } ?>



                                    </select>

                                    <?php echo form_error('info[hotelId]'); ?>

                                </div>

                                </div>

                                <div class="col-md-4">

                                <div class="form-group">

                                    <label class="form-label" for="Passangers-Range">Trip Type</label>
                                    <?php
                                        $is_round_trip = '';
                                        $is_one_way = '';
                                        if(isset($info['service']) && $info['service'] == 'round_trip')
                                        {
                                            $is_round_trip = 'selected';
                                        }
                                        if(isset($_GET['trip_type']) && $_GET['trip_type'] == 'round_trip')
                                        {
                                            $is_round_trip = 'selected';
                                        }
                                        if(isset($info['service']) && $info['service'] == 'one_way')
                                        {
                                            $is_one_way = 'selected';
                                        }
                                        if(isset($_GET['trip_type']) && $_GET['trip_type'] == 'one_way')
                                        {
                                            $is_one_way = 'selected';
                                        }
                                    ?>
                                    <select class="form-control"  id="trip_type"  name="info[service]"  onchange="showDep(this.value);setCost();">

                                        <option value="round_trip" <?php echo $is_round_trip; ?>>Round trip</option>

                                        <option value="one_way" <?php echo $is_one_way; ?>>One Way</option>

                                        

                                    </select>

                                </div>

                                </div>

                        </div>

                        <div class="row">

                            <div class="col-md-3">

                                <div class="form-group">

                                    <label class="form-label" for="arrival_date">Arrival Date Time </label>

                                    <input placeholder="(DD/MM/YYYY, HH:MM, AM/PM)" readonly id="arrival_date" name="info[arrivalDate]" onchange="setCost(event)" value="<?php echo (isset($info['arrivalDate'])) ? $info['arrivalDate'] : '' ?>"  class="form-control mdate" type="text"/>

                                    <?php echo form_error('info[arrivalDate]'); ?>

                                </div>

                            </div>

                            <div class="col-md-3">

                                <div class="form-group">

                                    <label class="form-label" for="arrival_date">Arrival Flight Number </label>

                                    <input placeholder="(Ex: ABC#2185)" id="arrival_flight" name="info[arrivalFlight]"   class="form-control" value="<?php echo (isset($info['arrivalFlight'])) ? $info['arrivalFlight'] : ''; ?>" type="text"/>

                                    <?php echo form_error('info[arrivalFlight]'); ?>

                                </div>

                            </div>

                            <div class="col-md-3">

                                <div class="form-group">

                                    <label class="form-label" for="arrival_date">Departure  Date Time </label>

                                    <input placeholder="(DD/MM/YYYY, HH:MM, AM/PM)" readonly id="departure_date" name="info[departureDate]"  value="<?php echo (isset($info['departureDate'])) ? $info['departureDate'] : '' ?>" class="form-control mdate" type="text"/>

                                    <?php echo form_error('info[departureDate]'); ?>

                                </div>

                                </div>


                                <div class="col-md-3">

                                <div class="form-group">

                                    <label class="form-label" for="arrival_date">Departure Flight Number  </label>

                                    <input placeholder="(Ex: ABC#2185)" id="departure_flight" name="info[departureFlight]"  class="form-control" value="<?php echo (isset($info['departureFlight'])) ? $info['departureFlight'] : ''; ?>" type="text"/>

                                    <?php echo form_error('info[arrivalFlight]'); ?>

                                </div>

                                </div>

                        </div>

                        <div class="row">

                            <div class="col-md-3">

                                <div class="form-group">

                                    <label class="form-label" for="Adults">Adults</label>

                                    <input placeholder="Adults" id="adults" name="info[adults]"  class="form-control" value="<?php echo (isset($info['adults'])) ? $info['adults'] : ''; ?>" type="number" min="1" max="15"/>

                                    <?php echo form_error('info[adults]'); ?>

                                </div>

                            </div>

                            <div class="col-md-3">

                                <div class="form-group">

                                    <label class="form-label" for="Kids">Kids</label>

                                    <input placeholder="Kids" id="kids"  name="info[kids]"  class="form-control" value="<?php echo (isset($info['kids'])) ? $info['kids'] : ''; ?>"  type="number" min="0" max="14"/>

                                    <?php echo form_error('info[kids]'); ?>

                                </div>

                            </div>

                            <div class="col-md-3 hidden <?php echo IS_OFFER_HIDE; ?>">

                                <div class="form-group">

                                    <label class="form-label" for="comments">Coupon Code</label>
                                    <input type="hidden" name="info[coupon_discount]" id="coupon_discount" value="">
                                    <input placeholder="Coupon Code" id="coupon_code" name="info[coupon_code]" class="form-control" value="<?php echo (isset($info['coupon_code'])) ? $info['coupon_code'] : @$_GET['coupon_code']; ?>" type="text"/>

                                    <?php echo form_error('info[coupon_code]'); ?>
                                    <p class="coupon-success-msg hide-class green_color"></p>
                                </div>

                                </div>

                                <div class="col-md-6 apply-btn-section">

                                <div class="form-group">

                                    <label class="form-label hidden <?php echo IS_OFFER_HIDE; ?>" for="coupon-btn">&nbsp;&nbsp;</label>

                                    <button class="btn btn-common apply-coupon-code hidden <?php echo IS_OFFER_HIDE; ?>"  main="0" type="button"><i class="fa fa-gift mr-5"></i>Apply Coupon</button>
                                    <button class="btn btn-common remove-coupon-code hide-class hidden <?php echo IS_OFFER_HIDE; ?>" type="button"><i class="fa fa-times mr-5"></i>Remove Coupon</button>
                                    <div class="amount"><i class="fa fa-usd mr-5"></i><span  id="amount">0</span> </div>
                                    <span id="choose_arrival_day">Choose your arrival day to find out our amazing discount prices!!</span>
                                    <span id="discounted_message"></span>
                                </div>

                                </div>

                        </div>


                        <div class="row">

                            <div class="col-md-12">

                                <div class="form-group">

                                    <label class="form-label" for="comments">Comments</label>

                                    <textarea placeholder="Type message here" id="comments" name="info[comments]"  rows="3"  class="form-control textarea_background"><?php echo (isset($info['comments'])) ? $info['comments'] : ''; ?></textarea>

                                    <?php echo form_error('info[comments]'); ?>

                                </div>

                            </div>


                        </div>

                        <div class="row">
                        <div class="col-md-12">

                        <button class="btn btn-common" id="privateTransFormBtn" type="submit"><i class="fa fa-paper-plane-o mr-5"></i>Book Now</button>

                        <img src="<?php echo base_url('assets/loader.gif'); ?>" alt="cabo private transportation" id="loaderprivateTransForm" class="in-hidden"/>

                        </div>
                        </div>

                        

                        <!-- /.col-md-12 -->



                    </form>

                </div>





            </div>

            <!-- End -->

        </div>

    </div>

</section>







<section class="private-extra section">

    <div class="container">          

        <div class="row">                

            <div class="col-md-4 wow fadeInLeft">

                <div class="inner-extra">

                    <h6>Is your hotel or villa not listed?</h6>

                    <p>Please contact us at:</p>

                    <p class="call-toll-free"><i class="fa fa-envelope mr-5"></i> info@insideloscabos.com </p>

                    <p>We'll be happy to help you.</p>

                </div>

            </div>

            <div class="col-md-4 wow fadeInUp">

                <div class="inner-extra">

                    <h6>If you book our airport </h6>

                    <p>transportation, you get a </p>

                    <p class="call-toll-free">GRAND DISCOUNT </p>

                    <p>on our featured activities and transfers!</p>

                </div>

            </div>

            <div class="col-md-4 wow fadeInRight">

                <div class="inner-extra">

                    <h6>Need further information? </h6>

                    <p>Please contact us at: </p>

                    <p class="call-toll-free"><i class="fa fa-envelope mr-5"></i> info@insideloscabos.com </p>

                    <p>Or chat with us through our Live Chat!</p>

                </div>





            </div>

        </div>

</section>


<style>
html body .amount {
    background: #fbad1b none repeat scroll 0 0;
    color: #005790;
    font-size: 20px;
    font-weight: bold;
    padding: 7px 12px;
    right: 0;
    text-align: center;
    width: auto;
    display: inline-block;
    position: relative;
    top: 4px;
    border-radius: 5px;
    height: 40px;
}
#choose_arrival_day{
    display:none;
    margin-left: 20px;
    font-weight: bold;
    color: #f00;
}
#discounted_message {
    font-weight: bold;
    display:none;
    margin-left: 20px;
}
</style>


<script type="text/javascript" src="<?php echo base_url('assets/js/datetimepicker/bootstrap-datetimepicker.js') ?>"></script>

<?php
    $calendarToday = getdate();
    $calendarYear =  $calendarToday["year"];
    $calendarMonth = $calendarToday["mon"] - 1;
    $calendarDay = $calendarToday["mday"] + 1;
?>

<script type="text/javascript">

                                        
                                        $(function () {

                                            $('.mdate').datetimepicker({

                                                ignoreReadonly: true,

                                                format: 'dd/mm/yyyy H:ii p',

                                                formatTime: 'H:ii p',

                                                formatDate: 'dd/mm/yyyy',

                                                minDate: new Date(<?php echo $calendarYear . ", " . $calendarMonth . ", " . $calendarDay; ?>), 

                                                defaultTime: new Date(<?php echo $calendarYear . ", " . $calendarMonth . ", " . $calendarDay; ?>),

                                                startDate: new Date(<?php echo $calendarYear . ", " . $calendarMonth . ", " . $calendarDay; ?>)

                                            }).on('changeDate', function (e) {

                                                $(this).datetimepicker('hide');

                                            });


<?php if (isset($info['passengers']) && !empty($info['passengers']) && isset($info['hotelId']) && !empty($info['hotelId'])) { ?>

                                                setCost();

<?php } ?>

                                        });

                                       



</script>

