 <section class="testimonial-page">
        <div class="container">
            <h1 class="quick-title wow fadeInLeftBig  animated visibility">Client's Testimonial</h1>


            <?php if(!empty($testimonials)) { $i = 1; foreach($testimonials as $t) { 

                $pull_class  = '';
                $arrow_class = 'arrow-left';
                if($i%2 == 0)
                {
                  $pull_class  = 'pull-right';
                  $arrow_class = 'arrow-right';  
                }
            ?>

                <div class="row">
                    <div class="col-sm-2 col-xs-12 <?php echo $pull_class; ?>">
                        <div class="customer-image">
                            <span class="c-image">
                                <img src="<?php echo base_url().$t['user_thumbnail_image']; ?>" alt="testimonial-img">
                            </span>
                            <h3><?php echo $t['username']; ?> <b><?php echo $t['user_location']; ?></b></h3>
                        </div>
                    </div>

                    <?php if($i%2 == 0) {
                        echo '<div class="col-sm-2 col-xs-12"></div>';
                    }
                    ?>

                    <div class="col-sm-8 col-xs-12">
                        <div class="testimonial-text <?php echo $arrow_class; ?>">
                            <div class="t-text">
                                <p><?php echo $t['descprition']; ?></p>
                            </div>
                        </div>
                    </div>

                    <?php if($i%2 != 0) {
                        echo '<div class="col-sm-2 col-xs-12"></div>';
                    }
                    ?>

                </div>

            <?php  $i++; } } ?>

            <!-- <div class="row">
                <div class="col-sm-12 col-xs-12">
                    <div class="pagination">
                        <a href="#">&laquo;</a>
                        <a href="#"  class="active">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#">4</a>
                        <a href="#">5</a>
                        <a href="#">6</a>
                        <a href="#">&raquo;</a>
                    </div>
                </div>
            </div> -->

        </div>
    </section>