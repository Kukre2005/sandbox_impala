<section class="gallery-page">
        <div class="container">
            <h1 class="quick-title">Our Gallery</h1>

            
             <div class="row">

                <?php if(!empty($gallery)) { foreach($gallery as $g) { ?>
                    <div class="col-sm-3 col-xs-12">
                        <div class="gallery-image">
                            <span class="g-image">
                                <a class="example-image-link" href="<?php echo base_url().$g['original_image']; ?>" data-lightbox="example-set"><img class="example-image" src="<?php echo base_url().$g['thumbnail_image']; ?>" alt="gallery-img"/></a>
                            </span>
                        </div>
                    </div>
                <?php } } ?>

            </div> 

        </div>
    </section>