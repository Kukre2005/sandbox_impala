<?php if(count($dbComments)>0){
     foreach ($dbComments as $comment){
         extract($comment);
    ?>
<li class="media">
                            <div class="media-left">
                                <a href="#"><img class=" img-circle" src="<?php echo base_url('assets/img/blog/comment_avatar/avatar1.jpg');?>" alt="ajax-avatar"></a>
                            </div>
                            <div class="media-body">
                                <div class="commentor-info">
                                    <div class="comment-author">
                                        <a href="#"><?php echo $fullName;?></a>
                                        <span class="published-time"><i class="fa fa-calendar"></i><?php echo time_elapsed_string($createdAt)?></span>
                                    </div>
                                    <p><?php echo $message;?></p>
                                </div>

                            </div>
                        </li>
     <?php  } ?>
<?php  }else{ ?>
                        <li  class="media"><?php echo ($page == 1)?"No comments found":"No more comments found."?></li>     
<?php } ?>

