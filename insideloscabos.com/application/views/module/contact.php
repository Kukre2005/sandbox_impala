<!-- Page Header -->

<!-- Page Header End -->
<section class="contact-section">
    <div class="container">
        <div class="row">

            <div class="col-md-4">
                <div class="contact-detail">
                    <div class="contact-info2 mt-20">
                        <h2 class="small-title">Contact Info</h2>
                        <ul class="contact-info2">
                            <li>
                                <p>
                                    <strong>
                                        <i class="fa fa-clock-o"></i> Experts ready to help :</strong>Mon–Sun 8am-6pm</p>
                            </li>
                            <!--<li>
                                <p>
                                    <strong>
                                        <i class="fa fa-phone"></i> Toll Free:</strong> 1-877-401-1796</p>
                            </li>-->
                            <li>
                                <p>
                                    <strong>
                                        <i class="fa fa-envelope"></i> Mail Us:</strong>
                                    <a href="mailto:info@insideloscabos.com">info@insideloscabos.com </a>
                                </p>
                            </li>
                            <li>
                                <p>
                                    <strong>
                                        <i class="fa fa-envelope"></i> Mail Us:</strong>
                                    <a href="mailto:info@insideloscabos.com">Reservations@insideloscabos.com </a>
                                </p>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-sm-8">
                <div class="map-iframe">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d117619.81781430988!2d-109.98677748917937!3d22.890517359487678!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x86af4af0e08bce1d%3A0x5d839be8d2ba8a04!2sinside+los+cabos!3m2!1d22.890532699999998!2d-109.91673709999999!5e0!3m2!1sen!2sin!4v1519229428234"
                        width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>

            <div class="col-sm-12">
                <p class="contact-text">We are the specialist in Las Cabos who can make your Holidays the best memories ever! Do not hesitate to contact our staff at anytime and get the best transportation and assistance. You can also mail us if you encounter any trouble on the way.</p>
            </div>


        </div>
    </div>
</section>
<section class="contact2-section section">
    <div class="container">

        <div class="row">
            <div data-wow-delay="0.3s" class="col-md-12 new-comment trip-form">
                <h1 class="section-title">CONTACT WITH US</h1>
                <!-- <p class="section-subcontent mb-30">At vero eos et accusamus et iusto odio dignissimos ducimus qui <br> blanditiis praesentium</p> -->
                <form action="<?php echo site_url("home/saveContact ")?>" name="contactForm" id="contactForm" class="mt-30 shake" role="form"
                    method="post" novalidate="true">
                    <div class="row">
                        <div class="col-md-1"></div>

                        <div class="col-md-10">
                            <div class="row">
                                <div class="form-group col-sm-4">
                                    <label class="" for="name">Name</label>
                                    <input type="text" required="" name="info[name]" class="form-control" id="name" placeholder="Your Name">
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-sm-4">
                                    <label class="" for="email">Email</label>
                                    <input type="email" data-error="Please enter your Email" required="" name="info[email]" class="form-control" id="email" placeholder="Your Email">
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-sm-4">
                                    <label class="" for="Phone">Phone</label>
                                    <input type="text" data-error="Please enter your Phone no." required="" name="info[phone]" class="form-control" id="Phone"
                                        placeholder="Your Phone no.">
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-sm-4">
                                    <label class="" for="Phone">Passenger</label>
                                    <input type="text" data-error="Please enter your Passangers no." required="" name="info[passengers]" class="form-control"
                                        id="Passangers" placeholder="Your Passangers no.">
                                    <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group col-sm-4">
                                    <label class="form-label" for="Passangers-Range">Hotel</label>
                                    <select class="form-control" id="hotel" name="info[hotelId]">
                                        <option value="">Select your resort</option>
                                        <?php foreach ($dbHotels as $hotel) { ?>
                                        <option value="<?php echo $hotel['id'];?>">
                                            <?php echo $hotel['name'];?>
                                        </option>
                                        <?php } ?>

                                    </select>
                                </div>

                                <div class="form-group col-sm-4">
                                    <label for="Type-service" class="form-label">Type of service</label>
                                    <select name="info[service]" id="trip_type" class="form-control">
                                        <option value="round_trip">Round trip</option>
                                        <option value="one_way">One Way</option>
                                    </select>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="arrival_date" class="form-label">Arrival Flight Info: Airline, Flight Number and Time)</label>
                                    <input type="text" class="form-control" name="info[arrivalFlight]" required="" id="arrival_date" placeholder="Arrival date">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="arrival_date" class="form-label">Departure Flight Info: Airline, Flight Number and Time</label>
                                    <input type="text" class="form-control" required="" name="info[departureFlight]" id="departure_flight" placeholder="Departure Flight Info">
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="" for="Comments">Comments</label>
                                        <textarea data-error="Write your Comments" required="" name="info[comments]" class="form-control" id="Comments" rows="7"
                                            placeholder="Your Comments"></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="" for="Comments">Captcha</label>
                                        <!--<p><a href="<?php // echo $this->recaptcha->recaptcha_get_signup_url(); ?>" >Get your API Code HERE</a></p>-->
                                        <div id="createCaptcha">
                                            <?php  //echo $recaptcha_html; ?>
                                            <div class="g-recaptcha" data-sitekey="6LcEYGAUAAAAAB61kERIxR4KKrSleeOnCPQNEdA1"></div>
                                        </div>


                                    </div>
                                </div>

                                <div class="form-group col-xs-12">
                                    <button type="submit" name="submit" id="contactFormBtn" class="btn btn-common seo-common-btn">
                                        <i class="fa fa-envelope"></i> Submit</button>
                                    <img src='assets/loader.gif' alt="loader-img" id='loadercontactForm' class='loaderImg in-hidden' />
                                </div>

                            </div>
                        </div>


                        <div class="col-md-1"></div>

                    </div>

                </form>
            </div>


        </div>
    </div>
</section>
