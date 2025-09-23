    <!-- Page Header End -->
        <section class="shortcode-accordion-section section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mt-50">

                        <div class="single-accordion-set wow fadeIn animated" data-wow-delay="0.9s">
                            <h1 class="section-title wow fadeInUpQuick animated visibility">
                               Things to know about Cabo and frequently asked Questions
                            </h1>
                            <div id="accordionFullWidth" class="" role="tablist" aria-multiselectable="true">
                             <?php
                             foreach($dbQa as $q=>$qaData){ ?>
                                <h3 class="small-title"><?php echo $qaData['name'];?></h3>
                                <!--1 accordion-->
                                <?php foreach($qaData['data'] as $q1=>$qa){
                                    extract($qa);
                                    ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingOneFull">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordionFullWidth" href="#collapseOneFull-<?php echo $q.$q1; ?>" aria-expanded="true" aria-controls="collapseOneFull" class="">
                                                <?php echo $qa['name'];?>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOneFull-<?php echo $q.$q1; ?>" class="panel-collapse clearfix collapse <?php echo ($q == 0 && $q1 == 0)?'in':''?>" role="tabpanel" aria-labelledby="headingOneFull" aria-expanded="true">
                                        <div class="panel-body clearfix">
                                            <?php if(!empty($image)){ ?>
                                            <div class="col-md-5">
                                                <a href="#"><img src="<?php echo $qaimage; ?>" class="img-responsive img-thumbnail" alt="qa-img"></a>
                                            </div>
                                            <?php } ?>
                                            <div class="col-md-<?php echo (!empty($image))?7:12?>">
                                                <?php echo html_entity_decode($description) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
<?php } ?>                                
                             <?php } ?>
                                <!--2 accordion-->                                
                       
                            </div>
                        </div>  
                    </div>
                </div>
            </div>

        </section>
