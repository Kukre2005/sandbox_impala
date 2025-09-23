
<section class="classic-blog-section section-padding" id="blog">
    <!-- Container Starts -->
    <div class="container">       
        <!-- Row Starts -->
        <div class="row">
            <h1 class="section-title wow fadeInUpQuick animated visibility">
                <?php echo ucwords($dbActList['name']); ?>
            </h1>
            <div class="col-md-12">
                <p class="section-subcontent text-left" ><?php echo $dbActList['description']; ?></p>
            </div>
            <?php foreach ($dbSubAct as $subAct) { ?>
                <div class="col-md-12 col-sm-12 col-xs-12 custom-section">
                    <!-- Blog Item Starts -->
                    <div data-wow-delay="0.3s" class="blog-item-wrapper wow fadeIn animated clearfix about_html">
                        <div class="blog-item-img col-sm-12 col-md-6">
                            <a href="javascript:void(0);">
                                <img alt="<?php echo ucwords($subAct['name']); ?>" src="<?php echo $subAct['image'] ?>">
                            </a>   
                        </div>
                        <div class="blog-item-text col-sm-12 col-md-6">
                            <h3 class="small-title"><a href="javascript:void(0);"><?php echo ucwords($subAct['name']); ?></a></h3>
                            <p>
                                <?php echo $subAct['description']; ?>
                            </p>                
                        </div>
                        <div class="row clearfix">
                            <div class=" col-sm-12 blog-item-text">
                                <div class="blog-one-footer">    
                                    <a href="<?php echo $subAct['website'] ?>" target="_blank"><?php echo $subAct['website'] ?></a>  
                                    <a>Phone: <?php echo $subAct['phone'] ?></a>   
                                    <a data-toggle="modal" data-target="#quoteModal" class="pull-right btn btn-common white">Get a Quote</a>                    
                                </div>
                            </div>
                        </div>
                    </div><!-- Blog Item Wrapper Ends-->
                </div>
            <?php } ?>
<?php if (strtolower($dbActList['name']) == 'fishing'){ ?>
              <div class="col-md-12 col-sm-12 col-xs-12 custom-section">
            <!-- Blog Item Wrapper Starts-->
            <div data-wow-delay="0.9s" class="blog-item-wrapper clearfix wow fadeIn animated about_html">
              <div class="blog-item-img col-sm-12 clearfix section_height">
                <a href="javascript:void(0);">
                  <img alt="fishing-calendar" src="<?php echo base_url('assets/img/fishing/fishing-calender.webp')?>" class="img-responsive">
                </a>
              </div>
              
               
            </div><!-- Blog Item Wrapper Ends-->
          </div>
<?php } ?>




        </div><!-- Row Ends -->
    </div><!-- Container Ends -->
</section>
<form data-toggle="validator" action="<?php echo site_url('activities/saveQuote') ?>" name="quoteForm" id="quoteForm" class="contactForm mt-30 shake" role="form" method="post" novalidate="true">
    <div class="modal fade bs-example-modal-lg" id="quoteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Quote -  <?php echo ucwords($dbActList['name']); ?></h4>
                </div>
                <div class="modal-body">
                    <div class="row" id="msgRow">
                        <div class="col-md-6">
                            <div class="form-group ">
                                <!--  <label class="" for="name">Name</label> -->
                                <input type="hidden" name="info[actId]" value="<?php echo $dbActList['id']?>">
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
                                <!-- <select name="info[service]" id="trip_type" class="form-control">
                                    <option value="round_trip">Round trip</option>
                                    <option value="one_way">One Way</option>
                                </select> -->
                                <input class="form-control" name="info[resturant]" id="resturant" placeholder="<?php echo ucwords($dbActList['name']); ?>" type="text">
                            </div>
                        </div>
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
                                <input  name="info[kids]" class="form-control" id="kids" placeholder="KIDS" type="number" min="0" max="14">
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

