

<!-- Page Header -->

<!-- Page Header End -->
<section class="contact-section">
    <div class="contact-container">
        <div class="row">
            <div class=" wow bounceInLeft">
                <iframe src=" https://maps.googleapis.com/maps/api/staticmap?key=AIzaSyAp7f0jaYosqsLkdWtCGM8X4h9dQnyUOuE&center=22.932002772157265,-109.90948049135739&zoom=12&format=png&maptype=roadmap&style=element:geometry%7Ccolor:0x242f3e&style=element:labels.text.fill%7Ccolor:0x746855&style=element:labels.text.stroke%7Ccolor:0x242f3e&style=feature:administrative.locality%7Celement:labels.text.fill%7Ccolor:0xd59563&style=feature:poi%7Celement:labels.text.fill%7Ccolor:0xd59563&style=feature:poi.park%7Celement:geometry%7Ccolor:0x263c3f&style=feature:poi.park%7Celement:labels.text.fill%7Ccolor:0x6b9a76&style=feature:road%7Celement:geometry%7Ccolor:0x38414e&style=feature:road%7Celement:geometry.stroke%7Ccolor:0x212a37&style=feature:road%7Celement:labels.text.fill%7Ccolor:0x9ca5b3&style=feature:road.highway%7Celement:geometry%7Ccolor:0x746855&style=feature:road.highway%7Celement:geometry.stroke%7Ccolor:0x1f2835&style=feature:road.highway%7Celement:labels.text.fill%7Ccolor:0xf3d19c&style=feature:transit%7Celement:geometry%7Ccolor:0x2f3948&style=feature:transit.station%7Celement:labels.text.fill%7Ccolor:0xd59563&style=feature:water%7Celement:geometry%7Ccolor:0x17263c&style=feature:water%7Celement:labels.text.fill%7Ccolor:0x515c6d&style=feature:water%7Celement:labels.text.stroke%7Ccolor:0x17263c&size=480x360" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>

        </div>
    </div>
</section>
<section class="contact2-section section">
    <div class="container">

        <div class="row">
            <div data-wow-delay="0.3s" class="col-md-12 wow bounceInLeft " >
                <h1 class="section-title"><?php echo $paypalTitle;?></h1>
               <p class="section-subcontent mb-30"><?php echo $paypalMsg;?></p> 
                <?php if(($paypalCase == 'error')){ ?>
                
               <div class="well alert-danger" id="paypal_errors">
                <?php
                foreach($paypalErrors as $error)
                {
                    echo '<p>';
                    echo '<strong>Error Code:</strong> ' . $error[0]['L_ERRORCODE'];
                    echo '<br /><strong>Error Message:</strong> ' . $error[0]['L_LONGMESSAGE'];
                    echo '</p>';
                }
                ?>
            </div>
                <?php } 
                if($paypalCase == 'booked'){ ?>
                <div align="center">
                <h3>Dear <?php echo $name?>,</h3>
                <?php if($bookStatus == 'booked'){ ?>
<!--                <p>Thank You,<br>You have successfully booked - Booking Id - <?php echo $bookingId;?> hotel - <?php echo $hotelName;?> with <?php echo SITE_NAME;?>.Please check your mail for more details.</p>-->
                <p>Thank You,<br>
                You have successfully booked - Our confirmation system will send you an email from: no_reply@insideloscabos.com with your confirmation transportation voucher with all details, please be aware that some Antivirus send our email to the Spam!</p>
                <?php } ?>
                <div align="center">
                    <table class="table table-bordered">
                        <tr>
                            <td>Name</td><td><?php echo $name;?></td>
                            <td>Email</td><td><?php echo $email;?></td>
                        </tr>
                        <tr>
                            <td>Phone</td><td><?php echo $phone;?></td>
                            <td>Trip Type</td><td><?php echo $service;?></td>
                        </tr>
                        
                        <tr>
                            <td>Passengers</td><td><?php echo $passengers;?> Passengers</td>
                            <td>Hotel</td><td><?php echo $hotelName;?></td>
                        </tr>
                        
                        
                        <tr>
                            <td>Arrival Date</td><td><?php echo date("d/m/Y",strtotime($arrivalDate));?></td>
                            <td>Arrival Flight Detail</td><td><?php echo $arrivalFlight;?></td>
                        </tr>
                        <?php if($service == 'round trip'){?>
                        <tr>
                            <td>Departure Date</td><td><?php echo date("d/m/Y",strtotime($departureDate));?></td>
                            <td>Departure Flight Detail</td><td><?php echo $departureFlight;?></td>
                        </tr>
                        <?php } ?>
                        <?php if($type == 'private_transport'){ ?>
                        <tr>
                            <td>Adults</td><td><?php echo $adults;?></td>
                            <td>Kids</td><td><?php echo $kids;?></td>
                        </tr>
                        <?php } ?>
                        <?php if(!empty($discount)){ ?>
                        <tr>
                            <td>Discount(%)</td><td><?php echo $discount;?></td>
                            <td>Discount Cost</td><td><?php echo $discountCost;?></td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td>Comments</td><td colspan="3"><?php echo $comments;?></td>
                        </tr>
                        
                        <tr>
<!--                            <td>Coupon Code</td><td><?php echo isset($couponCode) && !empty($couponCode)?$couponCode:"No coupon code used";?></td>-->
                            <td>Booking Amount</td><td>$<?php echo $finalAmount;?></td>
                            <td>Pay Status</td><td><?php echo $payStatus;?></td>
                        </tr>
                        
                        <tr>
                            <td>Booking Date</td><td><?php echo date("d/m/Y",  strtotime($createdAt));?></td>
                            <td>Booking Status</td><td><?php echo $bookStatus;?></td>
                        </tr>
                    </table>
                    
                </div>
                </div>
                <?php } ?>
            <a class="btn btn-primary" href="<?php echo base_url(); ?>what-to-do">Return to <?php echo $returnText;?></a>
            </div>


        </div>
    </div>
</section>

