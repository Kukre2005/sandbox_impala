 <section class="classic-blog-section section-padding" id="blog">
      <!-- Container Starts -->
      <div class="container">       
        <!-- Row Starts -->
        <div class="row">
          <h1 class="section-title wow fadeInUpQuick animated animated visibility">
            Services
          </h1>
<!--          <div class="col-md-12">
          <p class="section-subcontent text-left">The dining scene in Los Cabos is very varied, from the high end class resturants to the less fancy but also great restaurants of both cities. The area with the best restaurants is San Jose del Cabo. Cabo San Lucas has more restaurants but they are generally more popular, more commercial. For those who love fine dining there are not so many options in Cabo San Lucas -- not as many as in San Jose. </p>
          </div>-->
<?php if(count($dbAirport) > 0 ){ ?>
<?php foreach ($dbAirport as $key => $airport) { extract($airport);?>
<div class="col-md-12 col-sm-12 col-xs-12 custom-section">
            <!-- Blog Item Starts -->
            <div data-wow-delay="0.3s" class="blog-item-wrapper wow fadeIn animated clearfix animated about_html">
              <div class="blog-item-img col-sm-12 col-md-6">
                <a href="#">
                  <img alt="service-img" src="<?php echo $image;?>" class="img-responsive">
                </a>   
              </div>
              <div class="blog-item-text col-sm-12 col-md-6">
                <h3 class="small-title"><a href="#"><?php echo $name;?></a></h3>
                <?php echo html_entity_decode($description);?>
                
              </div>
<!--              <div class="row clearfix">
                <div class=" col-sm-12 blog-item-text">
                              <div class="blog-one-footer">    

                                   <a class="pull-right btn btn-common white" href="#" target="_blank">Get a Quote</a>                       
                              </div>
                 </div>
              </div>-->
            </div><!-- Blog Item Wrapper Ends-->
          </div>
<?php } ?>
<?php } ?>
          


        </div><!-- Row Ends -->
      </div><!-- Container Ends -->
    </section>