<?php extract($dbBlog); ?>
<section class="classic-blog-section section-padding">
    <div class="container">
        <div class="row">
            <!-- BLog Article Section -->
            <div class="col-md-12">
                <!-- Single Blog Post -->
                <article class="blog-post-wrapper wow fadeIn" data-wow-delay="0.3s">
                    <!-- Author Info -->
                    <header class="author-info">                                
                        <div class="author-posted">
                            <div class="media">
                                <div class="media-left">
                                    <a href="#"><img class="img-circle" src="<?php echo $authorImage ?>" alt="blog-author"></a>
                                </div>
                                <div class="media-body">
                                    <span class="author-name"><a href="#"><b><?php echo ucwords($author); ?></b></a></span><br>
                                    <span class="published-time"><i class="fa fa-calendar"></i> <?php echo time_elapsed_string($createdAt); ?></span>
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- Featured Content -->
                    <section class="featured-wrapper">
                        <a href="#">
                            <img src="<?php echo $image; ?>" alt="<?php echo $name; ?>">
                        </a>
                    </section>
                    <!-- Post Content -->
                    <section class="blog-post-content">
                        <div>
                            <h1 class="blog-post-title"><a href="#"><?php echo $name; ?></a></h1>
                        </div>
                        <div class="blog-post clearfix">
                            <?php echo html_entity_decode($description); ?>
                        </div>
                    </section>                            
                </article>
                <section class="about-author-section mt-10">
                    <!--<div class="media wow fadeIn " data-wow-delay="0.3s">
                        <div class="media-left">
                            <a href="#"><img class="img-circle " src="<?php echo base_url('assets');?>/img/blog/avatar/avatarBig1.jpg" alt=""></a>
                        </div>
                        <div class="media-body">
                            <h4>About Writter</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis cumque, quo omnis rem eum ipsam qui. Tempore perspiciatis unde architecto quia, enim consectetur accusamus quasi omnis voluptatibus aliquid rem mollitia incidunt quibusdam eum, sit magnam, repellendus minima nihil iusto vitae ratione dicta, iste. Vitae, architecto.</p>
                        </div>
                    </div>-->
                    <footer class="blog-post-footer clearfix">
                        <!-- Post Meta -->
                        <ul class="post-meta">
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
                    </footer>
                    <!--                    <div class="author-footer text-sm-center">
                                             <a class="wow bounceIn" data-wow-delay="0.4s" href="#"><i class="fa fa-facebook icon-box icon-sm"></i></a>
                                                    <a class="wow bounceIn" data-wow-delay="0.5s" href="#" ><i class="fa fa-twitter icon-box icon-sm"></i></a>
                                                    <a class="wow bounceIn" data-wow-delay="0.6s" href="#"><i class="fa fa-google-plus icon-box icon-sm"></i></a>
                                                    <a class="wow bounceIn" data-wow-delay="0.7s" href="#"><i class="fa fa-github icon-box icon-sm"></i></a>
                                                    <a class="wow bounceIn" data-wow-delay="0.8s" href="#" ><i class="fa fa-dribbble icon-box icon-sm"></i></a>
                                                    <a class="wow bounceIn" data-wow-delay="0.9s" href="#"><i class="fa fa-behance icon-box icon-sm"></i></a>
                                        </div>-->
                </section>
                <!-- Slider Post -->
                <div class="similar-post mt-30 clearfix">
                    <h3 class="small-title mb-40 wow fadeIn " data-wow-delay="0.3s">Similar Post</h3>
                    <?php if(count($dbRelBlog)> 0 ){ ?>
                    <?php foreach($dbRelBlog as $relBlog){ ?>
                    <div class="col-md-3 no-pdl wow fadeIn " data-wow-delay="0.4s" >
                        <a href="<?php echo site_url('blogs/'.$relBlog['slug'])?>"><img src="<?php echo $relBlog['image'];?>" alt="<?php echo $relBlog['image'];?>" class=""></a>
                        <a href="<?php echo site_url('blogs/'.$relBlog['slug'])?>"><h2><?php echo $relBlog['name']?></h2></a>
                    </div>
                    <?php } ?>
                        <?php } ?>
                </div>
                <div class="comments-area clearfix mt-50 wow fadeInUp" data-wow-delay="0.3s">
                    <h3 class="small-title"><i class="fa fa-comment"></i> Comments</h3>
                    <ul class="media-left comment-list mt-30">
                        
                    </ul>
                    <div id="commentLoader" class="in-hidden" align="center"><img src="<?php echo base_url('assets/loader.gif'); ?>" alt="loader-img" /></div>
                    <div id="loadMoreBtn"  class="in-hidden" align="center"><button class="btn btn-common" onclick="loadComments()" id="loadMore" >Load More</button></div>
                    <div class="new-comment mt-50">
                        <h3 class="small-title">Post new Comment</h3>
                        <form class="mt-30" action="<?php echo site_url('blogs/saveComment') ?>" id="formComment" name="formComment" method="post">
                            <input type="hidden" name="blogId" value="<?php echo $id; ?>"/> 
                            <div class="row">
                                <div class="col-md-4 ">
                                    <div class="form-group">
                                        <label class="sr-only" for="username">Name</label>
                                        <input placeholder="Full Name" id="fullNsame" name="fullName" required="" class="form-control" type="text">
                                    </div>
                                </div><!-- /.col-md-4  -->
                                <div class="col-md-4 ">
                                    <div class="form-group">
                                        <label class="sr-only" for="useremail">Email</label>
                                        <input placeholder="Email Address" id="email" name="email"  required="" class="form-control" type="email">
                                    </div>
                                </div><!-- /.col-md-4  -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="sr-only" for="userurl">Website</label>
                                        <input placeholder="Your Website" id="website" name="website" required="" class="form-control" type="url">
                                    </div>
                                </div>
                            </div><!-- /.col-md-4  -->  
                            <div class="form-group">
                                <label class="sr-only" for="usermessage">Message</label>
                                <textarea placeholder="Type here message" id="message" name="message" rows="7" required="" class="form-control"></textarea>
                            </div> 
                            <button class="btn btn-common" id="formCommentBtn" type="submit"><i class="fa fa-comment"></i> Post Comment</button>
                            <img alt="loader-img" src="<?php echo base_url('assets/loader.gif'); ?>" id="loaderformComment" class="in-hidden"/>
                        </form>
                    </div>
                </div>

            </div>
            <!-- End -->
        </div>
    </div>
</section>
<script type="text/javascript" src="<?php echo base_url('assets/js/sharer.min.js') ?>"></script>
<script type="text/javascript">
    var comPage = 1;
    loadComments();
    function loadComments()
        {
            
            $('#commentLoader').show();
            $.ajax({
                url: '<?php echo site_url('blogs/loadComments') ?>',
                type: 'POST',
                dataType: "json",
                data: 'blogId=<?php echo $id; ?>&page=' + comPage,
                cache: false,
                success: function (response) {
                    $('#commentLoader').hide();
                    if (response.count == 0)
                    {
                        $('#loadMoreBtn').hide();
                    }else{
                        comPage++;
                        $('#loadMoreBtn').show();
                    }
                    $('.comment-list').append(response.html);
                }

            })
        }
        
        
         $("#blogEmailForm").submit(function () {
            var form = $(this);
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
                    $(msg).insertAfter("#" + form.id + "Btn");
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
        
</script>

