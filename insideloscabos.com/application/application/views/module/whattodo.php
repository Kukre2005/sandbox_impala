    <section class="classic-blog-section section-padding" id="blog">
            <!-- Container Starts -->
            <div class="container">       
                <!-- Row Starts -->
                <div class="row">
                    <h1 class="section-title wow fadeInUpQuick animated animated visibility">
                        What To Do
                    </h1>
                    <!--          <div class="col-md-12">
                              <p class="section-subcontent text-left">The dining scene in Los Cabos is very varied, from the high end class resturants to the less fancy but also great restaurants of both cities. The area with the best restaurants is San Jose del Cabo. Cabo San Lucas has more restaurants but they are generally more popular, more commercial. For those who love fine dining there are not so many options in Cabo San Lucas -- not as many as in San Jose. </p>
                              </div>-->
                    <?php if(count($dbActList)){
                        foreach($dbActList as $act){
                        ?>
                    <div class="col-md-12 col-sm-12 col-xs-12 custom-section">
                        <!-- Blog Item Starts -->
                        <div data-wow-delay="0.3s" class="blog-item-wrapper wow fadeIn clearfix ">
                            <div class="blog-item-img col-sm-12 col-md-6">
                                <a href="#">
                                    <img alt="whattodo-img" src="<?php echo $act['image']?>" class="img-responsive">
                                </a>   
                            </div>
                            <div class="blog-item-text col-sm-12 col-md-6">
                                <h3 class="small-title"><a href="#"><?php echo ucwords($act['name']);?></a></h3>
                                <p>
                                    <?php echo $act['description']?></p>
                            </div>
                            <div class="row clearfix">
                                <div class=" col-sm-12 blog-item-text">
                                    <div class="blog-one-footer">    
                                        <a href="<?php echo site_url('activities/'.$act['slug']);?>" target="_blank"> Check our featured Restaurants </a>  
                                       
                                    </div>
                                </div>
                            </div>
                        </div><!-- Blog Item Wrapper Ends-->
                    </div>
                    <?php }}?>


                </div><!-- Row Ends -->
            </div><!-- Container Ends -->
        </section>