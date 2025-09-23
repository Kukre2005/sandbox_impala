 <section class="classic-blog-section section-padding" id="blog">
      <!-- Container Starts -->
      <div class="container">       
        <!-- Row Starts -->
        <div class="row">
          <h1 class="section-title wow fadeInUpQuick animated animated visibility">
            Todos Santos Tours
          </h1>
<!--          <div class="col-md-12">
          <p class="section-subcontent text-left">The dining scene in Los Cabos is very varied, from the high end class resturants to the less fancy but also great restaurants of both cities. The area with the best restaurants is San Jose del Cabo. Cabo San Lucas has more restaurants but they are generally more popular, more commercial. For those who love fine dining there are not so many options in Cabo San Lucas -- not as many as in San Jose. </p>
          </div>-->
          <div class="col-md-12 col-sm-12 col-xs-12 custom-section">
            <!-- Blog Item Starts -->
            <div data-wow-delay="0.3s" class="blog-item-wrapper wow fadeIn animated clearfix animated about_html">
              <div class="blog-item-img col-sm-12 col-md-6">
                  <img alt="todos santos tours" src="assets/img//1.webp" class="img-responsive">
              </div>
              <div class="blog-item-text col-sm-12 col-md-6">
                <h3 class="small-title">Todos Santos</h3>
                <p>
            If you want to enjoy the best that Los Cabos has to offer, you should definitely take our advice and visit the “Magic town” of Todos Santos by choosing our Todos Santos tours.  Todos Santos; an oasis in the middle of the desert, a mix of tropical paradise, Mexican heritage and old traditional architecture to amazing you and make your trip a memorable one.
                </p>        
                <p>Todos Santos is a small getaway town one hour away from the fast Cabo lifestyle, its tranquility and relax atmosphere is awaiting. We drive, while you enjoy the one-hour scenic route along the Pacific shore, this is an 4-hour private tour Los Cabos the best of it is, that it is completely private with your private tour guide, private chauffeur. </p>                
              </div>
              <p>
                You and your friends will be able to see all the beautiful places just the way you want to while traveling in our Taxis Cabo San Lucas. Take your everlasting photos, especially of the evening sunset, visit with fisherman taste the fresh seafood and drink your favorite Mexican drinks and enjoy to the fullest with us!
                </p>
         
            </div><!-- Blog Item Wrapper Ends-->
          </div>
          
          <div class="col-md-12 col-sm-12 col-xs-12 custom-section">
            <!-- Blog Item Wrapper Start-->
            <div data-wow-delay="0.6s" class="blog-item-wrapper wow fadeIn animated animated clearfix about_html_3">
               <div class="blog-item-text col-sm-12 col-md-12">
                <h3 class="small-title">Private Tours: **October – March</h3>
                <p>
                Every year between late October and mid-March thousands of gray whales make their annual migration through the Pacific Ocean, off the coast of Baja California. It is a spectacular event when they pass immediately in front of Todos Santos. The whales migrate 5,000 miles from the cold waters of Alaska’s Bering Sea to the warm water of the Baja Peninsula. This is the longest known mammal migration in the world. For years, these great animals had been hunted nearly to extinction and have just barely survived as a species. Due to some recovery, during these months it is possible to see these magnificent creatures and experience one of the world’s most memorable wildlife adventures. In Todos Santos it is common to see them ‘breach’ (perform an acrobatic jump) or just ‘spy-hop’ (come straight out of the water like a periscope of a submarine) a short distance from the shore. 
                </p>  
                <p>
                InsideLosCabos understands the importance of family and friends enjoying special moments that will only be shared within, for this reason we only offer private transportation and tours.You will really enjoy the scenic drive to the Magical Todos Santos! 
                </p>            
                </div>
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
                    <p>Dial to our toll free number:</p>
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
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Quote -  <?php echo "Tour"; ?></h4>
                </div>
                <div class="modal-body new-comment trip-form">
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
                                <!--  <label for="Type-service" class="form-label">Type of service</label> -->
                                   <select class="form-control" id="actId" name="info[actId]">
                                    <option value="8" selected>Todos Santos</option>
                                    <option value="7">City Tour</option>
                                    
                                </select>
                            </div>
                        </div>
                        <input  class="form-control" name="info[resturant]" id="resturant" value="TOUR" type="hidden">
                        <div class="col-md-6">
                            <div class="form-group">
                                <!-- <label class="form-label" for="Passangers-Range">Hotel</label> -->
                                <input class="form-control" name="info[reservationDate]" id="reservationDate" placeholder="Reservation date" type="date">
                            </div>
                        </div>

                    </div>  
                    <!-- <div class="row"> 
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="arrival_date" class="form-label">Arrival Flight Info:
Airline, Flight Number and Time)</label>
                                <input class="form-control" name="info[resturant]" id="resturant" placeholder="TOUR" type="text">
                            </div>
                        </div>

                    </div> -->
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