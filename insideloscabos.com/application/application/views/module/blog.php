

<section class="classic-blog-section section-padding">
    <div class="container">
        <div class="row">
            <!-- BLog Article Section -->
            <div class="col-md-9">
                <h1 style="display:none;">Blog</h1>
                <!-- Single Blog Post -->
                <?php
                if(count($dbBlogs)>0)
                {
                foreach ($dbBlogs as $b => $blog) {
                    extract($blog);
                    ?>
                    <article class="blog-post-wrapper wow fadeIn" data-wow-delay="0.3s">
                        <!-- Author Info -->
                        <header class="author-info">                                
                            <div class="author-posted">
                                <div class="media">
                                    <div class="media-left">
                                        <a href="#"><img class="img-circle" src="<?php echo $authorImage ?>" alt="author-img"></a>
                                    </div>
                                    <div class="media-body">
                                        <span class="author-name"><a href="#"><b><?php echo $author; ?></b></a></span><br>
                                        <span class="published-time"><i class="fa fa-calendar"></i> <?php echo time_elapsed_string($createdAt); ?></span>
                                    </div>
                                </div>
                            </div>
                        </header>
                        <!-- Featured Content -->
                        <section class="featured-wrapper">
                            <a href="<?php echo site_url('blogs/' . $slug); ?>">
                                <img src="<?php echo $image; ?>" alt="<?php echo $name; ?>">
                            </a>
                        </section>
                        <!-- Post Content -->
                        <section class="blog-post-content">
                            <div>
                                <h2 class="blog-post-title"><a href="<?php echo site_url('blogs/' . $slug) ?>"><?php echo $name; ?> </a></h2>
                            </div>
                            <div class="blog-post">
                                <p><?php echo $shortDesc; ?></p>
                            </div>
                            <div class="text-right">  
                                <a href="<?php echo site_url('blogs/' . $slug); ?>" class="btn btn-common btn-xs text-uppercase">Read more</a>
                            </div>
                        </section>
                        <!-- Footer -->
                        <footer class="blog-post-footer clearfix">
                            <!-- Post Meta -->
                            <ul class="post-meta pull-sm-left">
                                <li>
                                    <span><a class="sharer button" data-sharer="facebook" data-url="<?php echo site_url('blogs/' . $slug) ?>"  href="javascript:void(0)"><i class="fa fa-facebook mr-5"></i>Facebook</a></span>
                                </li>
                                <li>
                                    <span><a class="sharer button" data-sharer="linkedin" data-url="<?php echo site_url('blogs/' . $slug) ?>" href="javascript:void(0)"><i class="fa fa-linkedin mr-5"></i> Linkedin</a></span>
                                </li>
                                <li>
                                    <span><a href="javascript:void(0)" class="sharer button" data-sharer="twitter" data-title="<?php echo $name; ?>" data-hashtags="<?php echo $name; ?>" data-url="<?php echo site_url('blogs/' . $slug) ?>"><i class="fa fa-twitter mr-5"></i> Twitter</a></span>
                                </li>
                            </ul>
                            <div class="pull-sm-right emailtofrnd">
                                <img src="<?php echo base_url('assets/loader.gif'); ?>" alt="loader-img" id="loaderblogEmailForm<?php echo $id; ?>" class="in-hidden"/>
                                <form class="form-inline blogEmailForm" action="<?php echo site_url('blogs/sendFriend') ?>" method="post" id="blogEmailForm<?php echo $id; ?>">
                                    <div class="form-group">                                            
                                        <input type="hidden" value="<?php echo $id; ?>" name="blogId" class="form-control" >

                                        <input name="email" type="email" class="form-control" id="" placeholder="Email to a Friend" required>
                                        <button type="submit" class="btn btn-common btn-xs text-uppercase"><i class="fa fa-send"></i></button>
                                    </div>
                                </form>
                            </div>
                        </footer>
                    </article>
                    <!-- Slider Post -->
                <?php } ?>
                <!-- Video Post -->



                <!-- Blog Pagination -->
                <div class="blog-pagination clearfix wow fadeIn" data-wow-delay="0.3s">
                    <nav aria-label="..." class="">
                        <?php echo $pagination; ?>

                    </nav>
                </div>
                <?php } else{ ?>
                <div>No blogs found.</div>
                    <?php } ?>
            </div>
            <!-- End -->

            <!-- Blog Sidebar Section -->
            <div class="col-md-3">
                <div class="sidebar-area">
                    <!-- Search Bar -->
                    <aside class="widget search-bar wow fadeIn" data-wow-delay="0.3s">
                        <form>
                            <input placeholder="Search" class="form-control" type="text" name="search" value="<?php echo $search; ?>">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </aside>
                    <!-- Text Widgets -->
                    <aside class="widget text-widgets wow fadeIn" data-wow-delay="0.3s">
                        <h2 class="widget-title">Inside Los Cabos</h2>
                        <p>Our service includes "Buena Vista", "Los Barriles", "La Paz", "Todos Santos", "Cerritos", "San Jose del Cabo", "Touristic Corridor" & of course "Cabo San Lucas".</p>
                    </aside>
                    <!-- Recent Post Widgets -->
                    <aside class="widget popular-post wow fadeIn " data-wow-delay="0.3s">
                        <h2 class="widget-title">Recent Post</h2>
                        <ul>
                            <?php
                            if (count($dbRecBlogs) > 0) {
                                foreach ($dbRecBlogs as $key => $recBlog) {
                                    ?>
                                    <li>
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="<?php echo site_url('blogs/' . $recBlog['slug']) ?>"><img class="" src="<?php echo $recBlog['authorImage']; ?>" alt="<?php echo $recBlog['slug']; ?>"></a>
                                            </div>
                                            <div class="media-body">
                                                <h4><a href="<?php echo site_url('blogs/' . $recBlog['slug']) ?>"><?php echo $recBlog['name']; ?> </a></h4>
                                                <span class="published-time"><i class="fa fa-calendar"></i><?php echo time_elapsed_string($recBlog['createdAt']); ?></span>
                                            </div>
                                        </div>
                                    </li>
                                <?php }
                            } ?>
                            
                        </ul>
                    </aside>
                    <!-- Category -->

                    <!-- Subscribe Widget -->
                    <aside class="widget subscribe-widget wow fadeIn" data-wow-delay="0.3s">
                        <h2 class="widget-title">Subscribe</h2>
                        <div class="subscribe-area">
                            <p>Subscribe to our news latter to get regular update and blog posts.</p>
                            <form  name="subscribeFormBlog" id="subscribeFormBlog" action="<?php echo site_url('home/subscribe') ?>" method="post">
                                <div class="input-group">
                                    <input name="info[semail]" class="form-control input-block-level" placeholder="hello@youremail.com" type="email" required>
                                </div>
                                <button type="submit" class="mt-10 btn btn-common btn-block">Subscribe</button>
                            </form>
                        </div>
                    </aside>
                    <!-- Tag Cloud -->
                    <aside class="widget tag-cloud wow fadeIn" data-wow-delay="0.3s" >
                        <h2 class="widget-title">Tag clouds</h2>
                        <div class="clearfix">
                            <ul>
                                <?php 
                                 
                                if(count($tagsArr)>0){?>
                                <?php foreach ($tagsArr as $key => $tag){ ?>
                                <li><a href="<?php echo site_url('blogs?tag='.$tag)?>"><?php echo ucwords($tag);?></a></li>
                                <?php }} ?>
                                
                            </ul>
                        </div>
                    </aside>
                </div>
            </div>
            <!-- End -->
        </div>
    </div>
</section>
<script type="text/javascript" src="<?php echo base_url('assets/js/sharer.min.js') ?>"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $(".blogEmailForm").submit(function () {

            var form = $(this);
            form.id = $(this).attr('id');
            var formData = $(this).serialize();
            $("#" + form.id + "").find("button[type=submit]").prop("disabled", true);
            $("#my" + form.id).remove();
            $("#loader" + form.id).show();
            console.log(formData);
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                cache: false,
                dataType: 'json',
                data: formData,
                success: function (response, textStatus, jqXHR) {
                    $("#loader" + form.id).hide();
                    console.log("response", response);
                    if (response.status == 200)
                    {
                        $("#" + form.id)[0].reset();
                    }
                    var msg = msgDiv(response.status, response.message, form.id);
                    $("#" + form.id + "").find("button[type=submit]").after(msg);
//        $(msg).insertAfter("#" + form.id + "Btn");
                    $("#" + form.id + "").find("button[type=submit]").prop("disabled", false);
                },
                error: function (errorResponse, textStatus, errorThrown) {
                    console.log("errorResponse", errorResponse);
                    var msg = msgDiv(errorResponse.status, errorResponse.statusText, form.id);
                    $(msg).insertBefore("#" + form.id);
                    $("#" + form.id + "").find("button[type=submit]").prop("disabled", false);
                    $("#loader" + form.id).hide();
                }
            });
            return false;
        });
    })
</script>
