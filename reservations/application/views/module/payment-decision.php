
<?php 
header("Cache-Control: no cache");
//session_cache_limiter("private_no_expire");

if(!isset($_REQUEST['info'])){ 
//	redirect("/", 'Location');
}
	
?>
<style>
    h1.section-title{
        text-align: center;
        margin-bottom: 40px;
    }
	.payment-method{
		margin-top: 0
	}
	ul.list-inline.mx-auto.justify-content-center{
		text-align: center;
	}
	ul.list-inline.mx-auto.justify-content-center button {
	    background: transparent !important;
	    border: none !important;
	    padding: 0;
	    max-width: 170px;
	}
	ul.list-inline.mx-auto.justify-content-center button img {
	    width: 100%;
	}
	ul.list-inline.mx-auto.justify-content-center button::before {
	   display:none !important;
	}
	ul.list-inline.mx-auto.justify-content-center button:hover{
		transform: scale(1.05);
	}
</style>

<section class="payment-method section">
	 	<div class="container">
	 		<h1 class="section-title wow fadeInUpQuick">
            Choose a payment method
	        </h1>
	        <div class="d-flex">
			  <ul class="list-inline mx-auto justify-content-center">
			    <li class="list-inline-item">
			    	<form role="form" action="<?= base_url() ?>transportation/cardPayment" method="post" >
			    		<?php if(isset($_REQUEST['info'])){ ?>
			    		  <input name="info[type]" value="<?php echo $_REQUEST['info']['type'] ?>" type="hidden">
			    		  <input name="info[name]" value="<?php echo $_REQUEST['info']['name'] ?>" type="hidden">
			    		  <input name="info[email]" value="<?php echo $_REQUEST['info']['email'] ?>" type="hidden">
			    		  <input name="info[phone]" value="<?php echo $_REQUEST['info']['phone'] ?>" type="hidden">
			    		  <input name="info[passengers]" value="<?php echo $_REQUEST['info']['passengers'] ?>" type="hidden">
			    		  <input name="info[hotelId]" value="<?php echo $_REQUEST['info']['hotelId'] ?>" type="hidden">
			    		  <input name="info[service]" value="<?php echo $_REQUEST['info']['service'] ?>" type="hidden">
			    		  <input name="info[arrivalDate]" value="<?php echo $_REQUEST['info']['arrivalDate'] ?>" type="hidden">
			    		  <input name="info[arrivalFlight]" value="<?php echo $_REQUEST['info']['arrivalFlight'] ?>" type="hidden">
			    		  <input name="info[departureDate]" value="<?php echo $_REQUEST['info']['departureDate'] ?>" type="hidden">
			    		  <input name="info[departureFlight]" value="<?php echo $_REQUEST['info']['departureFlight'] ?>" type="hidden">
			    		  <input name="info[adults]" value="<?php echo $_REQUEST['info']['adults'] ?>" type="hidden">
			    		  <input name="info[kids]" value="<?php echo $_REQUEST['info']['kids'] ?>" type="hidden">
			    		  <!--<input name="info[coupon_discount]" value="<?php  //$_REQUEST['info']['coupon_discount'] ?>" type="hidden">-->
			    		  <!--<input name="info[coupon_code]" value="<?php  //$_REQUEST['info']['coupon_code'] ?>" type="hidden">-->
			    		  <input name="info[comments]" value="<?php echo $_REQUEST['info']['comments'] ?>" type="hidden">
			    		  <input name="amount" value="<?php echo $_REQUEST['amount'] ?>" type="hidden">
			    		<?php } ?>
			        	<button  class="btn btn-common wow bounceIn "> <img src="<?php echo base_url('assets/pay_with_card.png'); ?>" alt="Pay via card" /></button>
			        </form>
			    </li>
			    <li class="list-inline-item">
			    	<form role="form" action="<?= base_url() ?>transportation/bookPrivate" method="post" >
			    		<?php if(isset($_REQUEST['info'])){ ?>
			    		  <input name="info[type]" value="<?php echo $_REQUEST['info']['type'] ?>" type="hidden">
			    		  <input name="info[name]" value="<?php echo $_REQUEST['info']['name'] ?>" type="hidden">
			    		  <input name="info[email]" value="<?php echo $_REQUEST['info']['email'] ?>" type="hidden">
			    		  <input name="info[phone]" value="<?php echo $_REQUEST['info']['phone'] ?>" type="hidden">
			    		  <input name="info[passengers]" value="<?php echo $_REQUEST['info']['passengers'] ?>" type="hidden">
			    		  <input name="info[hotelId]" value="<?php echo $_REQUEST['info']['hotelId'] ?>" type="hidden">
			    		  <input name="info[service]" value="<?php echo $_REQUEST['info']['service'] ?>" type="hidden">
			    		  <input name="info[arrivalDate]" value="<?php echo $_REQUEST['info']['arrivalDate'] ?>" type="hidden">
			    		  <input name="info[arrivalFlight]" value="<?php echo $_REQUEST['info']['arrivalFlight'] ?>" type="hidden">
			    		  <input name="info[departureDate]" value="<?php echo $_REQUEST['info']['departureDate'] ?>" type="hidden">
			    		  <input name="info[departureFlight]" value="<?php echo $_REQUEST['info']['departureFlight'] ?>" type="hidden">
			    		  <input name="info[adults]" value="<?php echo $_REQUEST['info']['adults'] ?>" type="hidden">
			    		  <input name="info[kids]" value="<?php echo $_REQUEST['info']['kids'] ?>" type="hidden">
			    		  <!--<input name="info[coupon_discount]" value="<?php // $_REQUEST['info']['coupon_discount'] ?>" type="hidden">-->
			    		  <!--<input name="info[coupon_code]" value="<?php //echo $_REQUEST['info']['coupon_code'] ?>" type="hidden">-->
			    		  <input name="info[comments]" value="<?php echo $_REQUEST['info']['comments'] ?>" type="hidden">
			    		  <input name="amount" value="<?php echo $_REQUEST['amount'] ?>" type="hidden">
			    		<?php } ?>
			        	<button class="btn btn-common wow bounceIn"> <img src="<?php echo base_url('assets/pay_with_paypal.png'); ?>" alt="Pay via paypal" /></button>
			        </form>
			    </li>
			    
			  </ul>
			</div>
	        
	 	</div>
</section>

<script>
	window.addEventListener("pageshow", function (event) {
	var historyTraversal = event.persisted ||
		(typeof window.performance != "undefined" &&
		window.performance.navigation.type === 2);
	if (historyTraversal) {
		// Handle page restore.
	 //alert("refresh");
		window.location.reload();
	}
	});
</script>