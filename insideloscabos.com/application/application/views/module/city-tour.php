       <section class="classic-blog-section section-padding" id="blog">
      <!-- Container Starts -->
      <div class="container">       
        <!-- Row Starts -->
        <div class="row">
          <h1 class="section-title wow fadeInUpQuick animated animated visibility">
           Los Cabos City Tour
          </h1>
<!--          <div class="col-md-12">
          <p class="section-subcontent text-left">The dining scene in Los Cabos is very varied, from the high end class resturants to the less fancy but also great restaurants of both cities. The area with the best restaurants is San Jose del Cabo. Cabo San Lucas has more restaurants but they are generally more popular, more commercial. For those who love fine dining there are not so many options in Cabo San Lucas -- not as many as in San Jose. </p>
          </div>-->
          <div class="col-md-12 col-sm-12 col-xs-12 custom-section">
            <!-- Blog Item Starts -->
            <div data-wow-delay="0.3s" class="blog-item-wrapper wow fadeIn animated clearfix animated about_html">
              <div class="blog-item-img col-sm-12 col-md-6">
                  <img alt="cabo san lucas tours" src="assets/img//2.webp" class="img-responsive">
              </div>
              <div class="blog-item-text col-sm-12 col-md-6">
                <h3 class="small-title">City Tour</h3>
                <p>
                    With our Los Cabos city tours, you can relax in an air-conditioned comfort as your private driver takes you to explore the highlights of Los Cabos. We will take you to the places, you want to see. Just ask your driver to stop when you want no matter what is the time, and skip over things that don't interest you. This is an especially designed tour option for cruise passengers who are interested in seeing San Jose del Cabo.
                </p>       
              </div>
              <p>Travel up the Los Cabos corridor to the cozy town of San Jose Del Cabo with our exceptional drivers and get the best Cabo taxi from airport services at the lowest cost possible. Stop on the way at places like Playa Chileno or Playa Santa Maria for a cool off, or the Glass Blowing Factory to see local glass being made. See Cactus World or the new marina in San Jose del Cabo. Explore the colorful colonial town square in San Jose del Cabo at your own pace, including the mission, the art galleries, the city hall, and of course, you'll want to sample some of the very cozy restaurants or bars here.</p>     
              <p>
                End at Cabo San Lucas city tour where you can see the mansions of Pedregal, the flea market or other sights. End at the marina walk or Medano beach where you can relax, shop, eat and drink, or take a glass bottom boat out to Lovers Beach if you have time. Whether you are with your family or with your friends, we make your experience way better than you think.
                </p>
                <p>                   
                    InsideLosCabos understands the importance of family and friends enjoying special moments that will only be shared within, for this reason, we only offer private transportation and tours to our valuable clients.
                </p>
         
                <div class="row clearfix">
                <div class=" col-sm-12 blog-item-text">
                              <div class="blog-one-footer">    
                                   <a data-toggle="modal" data-target="#quoteModal" class="pull-right btn btn-common white">Get a Quote</a>                                 
                              </div>
                 </div>
              </div>

         
            </div><!-- Blog Item Wrapper Ends-->
          </div>
          
        
        </div><!-- Row Ends -->
      </div><!-- Container Ends -->
    </section>
      <section class="private-extra section">
            <div class="container">          
            <div class="row">                
                <div class="col-md-4 wow fadeInLeft animated visibility">
                  <div class="inner-extra">
                    <h6>Private 6 hour tour Includes:</h6>
                    <p>A professional tour chaffeur</p>
                    <p> Round trip A/C New Vehicles.</p>
                    <p>Bottle of water & Soda.</p>
                </div>
                </div>
                <div class="col-md-4 wow fadeInUp animated visibility">
                  <div class="inner-extra">
                    <h6>When booking your Airport </h6>
                    <p>Transportation get a </p>
                    <p class="call-toll-free">GREAT DISCOUNT </p>
                    <p>On our featured activities transfers!</p>
                </div>
                </div>
                <div class="col-md-4 wow fadeInRight animated visibility">
                  <div class="inner-extra">
                    <h6>If you want further information </h6>
                    <p>please contact us at: </p>
                    <p class="call-toll-free"><i class="fa fa-envelope mr-5"></i> info@insideloscabos.com </p>
                    <p>Or our Live Chat!</p>
                </div>
                
               
            </div>
            </div>
        </div>
        </section>
        <form data-toggle="validator" action="<?php echo site_url('activities/saveQuote') ?>" name="quoteForm" id="quoteForm" class="contactForm mt-30 shake" role="form" method="post" novalidate="true">
    <div class="modal fade bs-example-modal-lg" id="quoteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Quote -  <?php echo "Tour"; ?></h4>
                </div>
                <div class="modal-body">
                    <div class="row" id="msgRow">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <!--  <label class="" for="name">Name</label> -->
                                <input  name="info[name]" class="form-control" id="name" placeholder="Your Name" type="text">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <!--  <label class="" for="email">Email</label> -->
                                <input data-error="Please enter your Email"  name="info[email]" class="form-control" id="email" placeholder="Your Email" type="text">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <!--  <label class="" for="Phone">Phone</label> -->
                                <input data-error="Please enter your Phone no."  name="info[phone]" class="form-control" id="Phone" placeholder="Your Phone no." type="text">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <select class="form-control" id="hotel" name="info[hotelId]">
                                    <option value="">Select your resort</option>
                                    <?php foreach ($dbHotels as $hotel) { ?>
                                        <option value="<?php echo $hotel['id']; ?>"><?php echo $hotel['name']; ?></option>
                                    <?php } ?>

                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>    
                   <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                               <select class="form-control" id="actId" name="info[actId]">
                                    <option value="8" >Todos Santos</option>
                                    <option value="7" selected>City Tour</option>
                                    
                                </select>
                                
                            </div>
                        </div>
                       <input class="form-control" name="info[resturant]" id="resturant" value="TOUR" type="hidden">
                        <div class="col-md-6">
                            <div class="form-group">
                                <!-- <label class="form-label" for="Passangers-Range">Hotel</label> -->
                                <input class="form-control" name="info[reservationDate]" id="reservationDate" placeholder="Reservation date" type="date">
                            </div>
                        </div>

                    </div> 
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <!--  <label class="" for="name">Name</label> -->
                                <input  name="info[adults]" class="form-control" id="adults" placeholder="ADULTS"  type="number" min="1" max="15">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group ">
                                <!--  <label class="" for="email">Email</label> -->
                                <input  name="info[kids]" class="form-control" id="kids" placeholder="KIDS"  type="number" min="0" max="14">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">   
                        <div class="col-md-12">
                            <div class="form-group">
                                <!-- <label class="" for="Comments">Comments</label> -->
                                <textarea data-error="Write your Comments"  name="info[comments]" class="form-control" id="Comments" rows="4" placeholder="Your Comments"></textarea>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-common" id="quoteFormBtn">Submit</button>
                    <button type="button" class="btn btn-common" data-dismiss="modal" id="cancelQuote">Cancel</button>
                    <img src='<?php echo base_url('assets/loader.gif'); ?>' alt="loader-img" id='loaderquoteForm' class='loaderImg in-hidden'/>
                </div>
            </div>
        </div>
    </div>
</form>