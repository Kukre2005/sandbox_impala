<section><br/><br/><br/><br/>
		<div class="container">
			<div class="row">
                <h1 style="display:none;">Offers</h1>
				<?php if(!empty($coupons)) { $i = 1; foreach($coupons as $c) { if($i % 2 != 0){ ?>
					<div class="offerBox">
						<div class="col-sm-6"><h3 class="offerTitle"><?php echo ($c['transportation_type'] == 0) ? 'Private Transportation' : 'Cabo Shuttle'; ?> Offers in LOS CABOS</h3></div><div class="col-sm-6"><strong class="pull-right">Valid From <?php echo $c['start_date']; ?> To <?php echo $c['end_date']; ?></strong></div><br><br>
						<div class="col-sm-3">
							<div class="offerImg">
								<?php if(!empty($c['discount_image'])) { ?>
									<img src="<?php echo base_url().$c['discount_image']; ?>" alt="discount-img" class="img-thumbnail">
								<?php } else { ?>
									<img src="<?php echo base_url(); ?>assets/img/noimagefound.jpg" alt="discount-no-image" class="img-thumbnail">
								<?php } ?>
							</div>
						</div>
						<div class="col-sm-9">
							<div class="row">
								<div class="col-sm-12">
									<div class="offerText">
										<h4><?php echo $c['title']; ?> <span><?php echo $c['coupon_code']; ?></span> And get <span>
										<?php 
											if($c['coupon_type'] == 0){
												echo "$".$c['coupon_amount'];
											}else{
												echo $c['coupon_amount']."%";
											}
										?>
										</span> off <a href="javascript:void(0);" main="<?php echo $c['id']; ?>" code="<?php echo $c['coupon_code']; ?>" transport="<?php echo $c['transportation_type']; ?>" title="Book Now" class="bookNow-btn">Book Now</a></h4>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="valueBox">
									<div class="col-sm-3 ourValues">
											<i class="fa fa-calendar"></i>
											<h3>Available <span>24*7</span></h3>
									</div>
									<div class="col-sm-3 ourValues">
											<i class="fa fa-money"></i>
											<h3>Lowest <span>Pricing</span></h3>
									</div>
									<div class="col-sm-3 ourValues">
											<i class="fa fa-suitcase"></i>
											<h3>No Suitcases limitation <span>per vehicle</span></h3>
									</div>
									<div class="col-sm-3 ourValues">
											<i class="fa fa-clock-o"></i>
											<h3>Estimated Time <span>Varies</span></h3>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php }else{ ?>
					<div class="offerBox">
						<div class="col-sm-6"><h3 class="offerTitle"><?php echo ($c['transportation_type'] == 0) ? 'Private Transportation' : 'Cabo Shuttle'; ?> Offers in LOS CABOS</h3></div><div class="col-sm-6"><strong class="pull-right">Valid From <?php echo $c['start_date']; ?> To <?php echo $c['end_date']; ?></strong></div><br><br>
						<div class="col-sm-9">
							<div class="row">
								<div class="col-sm-12">
									<div class="offerText">
										<h4><?php echo $c['title']; ?> <span><?php echo $c['coupon_code']; ?></span> And get <span>
											<?php 
												if($c['coupon_type'] == 0){
													echo "$".$c['coupon_amount'];
												}else{
													echo $c['coupon_amount']."%";
												}
											?>
										</span> off <a href="javascript:void(0);" main="<?php echo $c['id']; ?>" code="<?php echo $c['coupon_code']; ?>" transport="<?php echo $c['transportation_type']; ?>" title="Book Now" class="bookNow-btn">Book Now</a></h4>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="valueBox">
									<div class="col-sm-3 ourValues">
											<i class="fa fa-user-o"></i>
											<h3>Max 15 People <span>per vehicle</span></h3>
									</div>
									<div class="col-sm-3 ourValues">
											<i class="fa fa-money"></i>
											<h3>Lowest <span>Pricing</span></h3>
									</div>
									<div class="col-sm-3 ourValues">
											<i class="fa fa-suitcase"></i>
											<h3>No Suitcases limitation <span>per vehicle</span></h3>
									</div>
									<div class="col-sm-3 ourValues">
											<i class="fa fa-clock-o"></i>
											<h3>Estimated Time <span>Varies</span></h3>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="offerImg">
								<?php if(!empty($c['discount_image'])) { ?>
									<img src="<?php echo base_url().$c['discount_image']; ?>" alt="discount-image" class="img-thumbnail">
								<?php } else { ?>
									<img src="<?php echo base_url(); ?>assets/img/noimagefound.jpg" alt="discount-no-image" class="img-thumbnail">
								<?php } ?>
							</div>
						</div>
					</div>
				<?php } $i++; } } else {  ?>
					<center><div class="well"> 
						Offers not found
					</div></center>
				<?php } ?>
			</div>
			
			<div class="row">
				<div class="textPart">
					<div class="col-sm-12">
						<?php echo (!empty($discount_content)) ? $discount_content['description'] : ''; ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<script type="text/javascript">
		$(document).ready(function(){
			$('body').on('click','.bookNow-btn',function(){
				var coupon_code = $(this).attr('code');
				var transport = $(this).attr('transport');
				var redirectURL = "<?php echo base_url(); ?>";
				if(transport == 0){
					redirectURL += "private-transportation";
				}else{
					redirectURL += "cabo-shuttle";
				}
				redirectURL += "?coupon_code=" + coupon_code;
				console.log('redirectURL',redirectURL);
				window.location.href = redirectURL;
			});
		});
	</script>