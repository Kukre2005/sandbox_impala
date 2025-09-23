<link type="text/css" href="<?php echo base_url('assets/js/datetimepicker/bootstrap-datetimepicker.css') ?>" rel="stylesheet" />
<section class="quick-section section seocnd_img">
    <h1 class="quick-title wow fadeInDownBig white">Book The Best Los Cabos Airport Shuttle Service </h1>
    <div class="form-section new-comment  wow fadeInDownBig">
        <div class="container quick-container">			

        </div>
    </div>
</section>
<section class="section-padding">
 <div class="container">
            <div class="row">                  
                <div class="col-md-12  col-xs-12 wow  fadeInRight " data-wow-delay=".3s">
                    <div class="content-inner">
                        <h2 class="quick-title wow fadeInLeftBig ">Cabo Shuttle Services</h2>
                        <p class="">
                            Our Los Cabos Shuttle Service is specially designed for travellers who would like to experience the best service at the lowest cost. We allow you to save your money by utilizing the share transportation with people arriving at a similar time as you, in order to keep costs down. Enjoy convenient and cost-effective shared transportation between the Los Cabos International Airport (SJD) and your hotel aboard our Shuttle. Apart from this, you can use the Los Cabos shuttle discounts and Cabo airport shuttle coupon code for getting exclusive discounts.
                        </p>
                        
                        <P>Our services includes:</P>

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
                            A/C vehicles of recent models
                        </p>
                        <p>
                            <i class="fa fa-check" style="color:green;"></i>
                            No timeshare invitations, only first-class service
                        </p>
                        <p>
                            We ensure that each booking is treated in a timely and professional manner so that you keep making us your first choice while traveling. Hence, if you are looking for accessible airport transportation, give us a call or make your reservation online in a few clicks!
                        </p>
                    </div>
                </div>
            </div>
        </div>
</section>

<section class="">
    <h2 class="h1 section-title wow fadeInUpQuick">
       Los Cabos Shuttle Service 
    </h2>
    <p class="section-subcontent">
        After arriving, you will meet your driver, who will help you load your luggage into the vehicle. Then he will take you to your hotel in an airconditioned automobile.
        <br>For more information about the airport, please go to <a href="https://www.insideloscabos.com/airport-info">Airport Info</a>
    </p>
</section>

<!-- <div class="container">
    <div class="row">
        <div class="col-sm-12">
        <div class="offerText text-center">
            <h4>February in Los Cabos! <span>FebY18</span> And get <span>
            5% </span> off </h4>
        </div>
        </div>
    </div>
</div> -->

<section class="pb-50 form-main">
    <div class="container">
        <div class="row">
            <!-- BLog Article Section -->
            <div class="col-md-12">
                <!-- Private Transfer Section -->                                               
                <div class="new-comment trip-form clearfix wow fadeInUp" data-wow-delay="0.3s">
                    
                    <h3 class="small-title">Cabo Shuttle </h3>
                    <?php echo validation_errors();?>
                    <?php if ($mstatus == 'error') { ?><div class="alert alert-danger"><?php echo $msg; ?></div><?php } ?>
                        <form  action="/payment-method" name="privateTransForm" id="privateTransForm" class="mt-30 shake" role="form" method="post" novalidate="true" class="mt-20">
                            <input type="hidden" name="info[type]" id="type" value="cabo_shuttle"/>
                        <input type="hidden" name="amount" id="cost" value="0"/>


                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="name">Name</label>
                                    <input placeholder="Full Name" id="name" name="info[name]"  class="form-control" value="<?php echo (isset($info['name'])) ? $info['name'] : @$_GET['name']; ?>" type="text">
                                    <?php echo form_error('info[name]'); ?>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="Email">Email</label>
                                    <input placeholder="Email Address" id="email"  name="info[email]"  class="form-control" value="<?php echo (isset($info['email'])) ? $info['email'] : @$_GET['email']; ?>" type="email"/>
                                    <?php echo form_error('info[email]'); ?>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="Phone">Phone</label>
                                    <input placeholder="Phone" id="Phone"   name="info[phone]" class="form-control" value="<?php echo (isset($info['phone'])) ? $info['phone'] : ''; ?>" type="text" />
                                    <?php echo form_error('info[phone]'); ?>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="Passangers-Range">Passenger Range</label>
                                    <input placeholder="#Passengers" onchange="setCost()" id="passangers_range" step="1" pattern="[0-9]"  name="info[passengers]" min="1" max="15" class="form-control" value="<?php echo (isset($info['passengers'])) ? $info['passengers'] : ''; ?>" type="number" />
                                    <?php echo form_error('info[phone]'); ?>
<!--                                    <select class="form-control"  id="passangers_range" name="info[passengers]" onchange="setCost()">
                                        <option value="1-5" <?php echo (isset($info['passengers']) && $info['passengers'] == '1-5') ? 'selected' : ''; ?>>1-5 Passengers</option>
                                        <option value="6-10" <?php echo (isset($info['passengers']) && $info['passengers'] == '6-10') ? 'selected' : ''; ?>>6-10 Passengers</option>
                                        <option value="11-15" <?php echo (isset($info['passengers']) && $info['passengers'] == '11-15') ? 'selected' : ''; ?>>11-15 Passengers</option>
                                    </select>-->
                                </div>
                            </div>
                        </div>

                            

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="arrival_date">Arrival Date Time </label>
                                    <input placeholder="(DD/MM/YYYY, HH:MM, AM/PM)" readonly id="arrival_date" name="info[arrivalDate]" onchange="setCost()" value="<?php echo (isset($info['arrivalDate'])) ? $info['arrivalDate'] : '' ?>"  class="form-control mdate" type="text"/>
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
                                    <label class="form-label" for="arrival_date">Departure Flight Number</label>
                                    <input placeholder="(Ex: ABC#2185)" id="departure_flight" name="info[departureFlight]"  class="form-control" value="<?php echo (isset($info['departureFlight'])) ? $info['departureFlight'] : ''; ?>" type="text"/>
                                    <?php echo form_error('info[arrivalFlight]'); ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="resrot">Resort</label>
                                    <select class="form-control"  id="hotelId" name="info[hotelId]" onchange="setCost()">
                                        <option value="">Select your resort</option>
                                        <?php foreach ($dbHotels as $hotel) { ?>
                                            <option value="<?php echo $hotel['id']; ?>" <?php echo (isset($info['hotelId']) && $info['hotelId'] == $hotel['id']) ? 'selected' : ''; ?>><?php echo $hotel['name']; ?></option>
                                        <?php } ?>

                                    </select>
                                    <?php echo form_error('info[hotelId]'); ?>
                                </div>
                            </div>

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
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label" for="Passangers-Range">Trip Type</label>
                                    <select class="form-control"  id="trip_type"  name="info[service]"  onchange="showDep(this.value);setCost();">
                                        <option value="round_trip" <?php echo $is_round_trip; ?>>Round trip</option>
                                        <option value="one_way" <?php echo $is_one_way; ?>>One Way</option>
                                    </select>
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
                            <div class="col-md-3 apply-btn-section">

                            <div class="form-group">

                                <label class="form-label hidden <?php echo IS_OFFER_HIDE; ?>" for="coupon-btn">&nbsp;&nbsp;</label>

                                <button class="btn btn-common apply-coupon-code hidden <?php echo IS_OFFER_HIDE; ?>"  main="1" type="button"><i class="fa fa-gift mr-5"></i>Apply Coupon</button>
                                <button class="btn btn-common remove-coupon-code hide-class hidden <?php echo IS_OFFER_HIDE; ?>" type="button"><i class="fa fa-times mr-5"></i>Remove Coupon</button>

                                <div class="amount"><i class="fa fa-usd mr-5"></i><span  id="amount">0</span> </div>

                                
                            </div>

                            </div>
                        </div>


                        <input placeholder="Adults" id="adults" name="info[adults]"  class="form-control" value="1" type="hidden" min="1" max="15"/>
                         <input placeholder="Kids" id="kids"  name="info[kids]"  class="form-control" value="1"  type="hidden" min="0" max="14"/>
<!--                            <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="Adults">Adults</label>
                                    <input placeholder="Adults" id="adults" name="info[adults]"  class="form-control" value="<?php echo (isset($info['adults'])) ? $info['adults'] : ''; ?>" type="number" min="1" max="15"/>
                                    <?php //echo form_error('info[adults]'); ?>
                                </div>
                            </div>
                             /.col-md-6  
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="Kids">Kids</label>
                                    <input placeholder="Kids" id="kids"  name="info[kids]"  class="form-control" value="<?php echo (isset($info['kids'])) ? $info['kids'] : ''; ?>"  type="number" min="0" max="14"/>
                                    <?php //echo form_error('info[kids]'); ?>
                                </div>
                            </div>
                            </div>-->
                            <!-- /.col-md-6  -->
                            <div class="row">
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="comments">Comments</label>
                                    <textarea placeholder="Type message here" id="comments" name="info[comments]"  rows="3"  class="form-control"><?php echo (isset($info['comments'])) ? $info['comments'] : ''; ?></textarea>
                                    <?php echo form_error('info[comments]'); ?>
                                </div>
                            </div>
<!--                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="Code">Coupon Code</label>
                                    <input placeholder="Coupon Code" id="couponCode"  name="info[couponCode]"  value="<?php echo (isset($info['couponCode'])) ? $info['couponCode'] : ''; ?>" onchange="setCost()" class="form-control" type="text"/>
                                </div>
                            </div>-->
                            </div>
                            <!-- /.col-md-12 -->
                            <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-common" id="privateTransFormBtn" type="submit"><i class="fa fa-paper-plane-o mr-5"></i>Book Now</button>
                                <img src="<?php echo base_url('assets/loader.gif'); ?>" alt="loader-img" id="loaderprivateTransForm" class="in-hidden"/>
                            </div>
                            </div>
                            <!-- /.col-md-12 -->
                        
                    </form>
                </div>


            </div>


        </div>
        <!-- End -->
    </div>
</div>
</section>
<!-- 
<section class="bg-img section second-img" >
    <div class="section_overlay">

      
    </div>
</section> -->

<section class="private-extra section">
    <div class="container">          
        <div class="row">                
            <div class="col-md-4 wow fadeInLeft">
                <div class="inner-extra">
                    <h6>Is your hotel or villa not listed?</h6>
                    <p>please contact us at:</p>
                    <p class="call-toll-free"><i class="fa fa-envelope mr-5"></i> info@insideloscabos.com </p>
                    <p>we'll be happy to help you.</p>
                </div>
            </div>
            <div class="col-md-4 wow fadeInUp">
                <div class="inner-extra">
                    <h6>When booking your Airport </h6>
                    <p>Transportation get a </p>
                    <p class="call-toll-free">GREAT DISCOUNT </p>
                    <p>On our featured activities transfers!</p>
                </div>
            </div>
            <div class="col-md-4 wow fadeInRight">
                <div class="inner-extra">
                    <h6>If you want further information </h6>
                    <p>please contact us at: </p>
                    <p class="call-toll-free"><i class="fa fa-envelope mr-5"></i> info@insideloscabos.com </p>
                    <p>Or our Live Chat!</p>
                </div>


            </div>
        </div>
</section>



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
                                            }).on('changeDate', function(e){
                                                $(this).datetimepicker('hide');
                                            }); 


<?php if (isset($info['passengers']) && !empty($info['passengers']) && isset($info['hotelId']) && !empty($info['hotelId'])) { ?>
                                                setCost();
<?php } ?>
                                        });
                                        


</script>

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
</style>