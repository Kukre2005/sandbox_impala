

<!-- Page Header -->

<!-- Page Header End -->

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
                You have successfully booked for <?php echo $transport_type;?>- Our confirmation system will send you an email from: no_reply@impalacabo.com with your confirmation transportation voucher with all details, please be aware that some Antivirus send our email to the Spam!</p>

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
                <p>How to find us at Los Cabos Airport:</p>
                <p>How to find us at Terminal 1: Go to the sign that says "Group Exits"</p>
                <p>How to find us at Terminal 2 & 3:</p>
                <p>As soon as you pass customs, go all the way "OUTSIDE" the building  where all the transportation companies are. There you will find your Airport Rep with the sign, he is under the tent number 6...</p>
                </div>
                <?php } ?>
            <a class="btn btn-primary" href="<?php echo $startOver;?>">Return to <?php echo $returnText;?></a>
            </div>


        </div>
    </div>
</section>

