<html>
<body>
    <img src="<?= site_url("assets/img/newlogo.jpg") ?>" alt="Insideloscabos" />
    <div><strong>Dear <?= htmlspecialchars($recipientName) ?>,</strong><br/>
    Your booking has been done successfully for hotel - <?= htmlspecialchars(
      $hotelName
    ) ?> for <?= htmlspecialchars($t) ?> with <?= SITE_NAME ?>.
    Please check the following booking details</div>
    <p>You have successfully booked for Private Transportation- Our confirmation system will send you an email from: <a href="mailto:no_reply@insideloscabos.com">no_reply@insideloscabos.com</a> with your confirmation transportation voucher with all details and map. Please be aware that some Antivirus send our email to the Spam!</p>
    <table rules="all" style="border-color: #666;" cellpadding="10">
        <tr><td><strong>Paypal Transaction Id:</strong></td><td><?= strip_tags(
          $info["transactionId"]
        ) ?></td></tr>
        <tr><td><strong>Booking Date:</strong></td><td><?= date(
          "d/m/Y",
          strtotime($info["createdAt"])
        ) ?></td></tr>
        <tr style="background: #eee;"><td><strong>Name:</strong></td><td><?= strip_tags(
          $info["name"]
        ) ?></td></tr>
        <tr><td><strong>Email:</strong></td><td><?= strip_tags(
          $info["email"]
        ) ?></td></tr>
        <tr><td><strong>Phone:</strong></td><td><?= strip_tags(
          $info["phone"]
        ) ?></td></tr>
        <tr><td><strong>Passengers:</strong></td><td><?= strip_tags(
          $info["passengers"]
        ) ?></td></tr>
        <tr><td><strong>Hotel:</strong></td><td><?= htmlspecialchars(
          $hotelName
        ) ?></td></tr>
        <tr><td><strong>Type Of Services:</strong></td><td><?= htmlspecialchars(
          $info["service"]
        ) ?></td></tr>
        <tr><td><strong>Arrival Date:</strong></td><td><?= strip_tags(
          $arrivalDate
        ) ?></td></tr>
        <tr><td><strong>Arrival Flight Info:</strong></td><td><?= strip_tags(
          $info["arrivalFlight"]
        ) ?></td></tr>
        <?php if ($service == "round trip"): ?>
            <tr><td><strong>Departure Date:</strong></td><td><?= strip_tags(
              $departureDate
            ) ?></td></tr>
            <tr><td><strong>Departure Flight Info:</strong></td><td><?= strip_tags(
              $info["departureFlight"]
            ) ?></td></tr>
        <?php endif; ?>
        <?php if ($type == "private_transport"): ?>
            <tr><td><strong>Adults:</strong></td><td><?= strip_tags(
              $adults
            ) ?></td></tr>
            <tr><td><strong>Kids:</strong></td><td><?= strip_tags(
              $kids
            ) ?></td></tr>
        <?php endif; ?>
        <tr><td><strong>Comments:</strong></td><td><?= htmlentities(
          $info["comments"]
        ) ?></td></tr>
        <?php if (!empty($info["couponCode"])): ?>
            <tr><td><strong>Coupon Code:</strong></td><td><?= strip_tags(
              $info["couponCode"]
            ) ?></td></tr>
            <tr><td><strong>Coupon Cost:</strong></td><td>$<?= strip_tags(
              $info["couponAmount"]
            ) ?></td></tr>
        <?php endif; ?>
        <?php if (!empty($info["discount"])): ?>
            <tr><td><strong>Discount:</strong></td><td><?= strip_tags(
              $info["discount"]
            ) ?>%</td></tr>
            <tr><td><strong>Discount Cost:</strong></td><td>$<?= strip_tags(
              $info["discountCost"]
            ) ?></td></tr>
        <?php endif; ?>
        <tr><td><strong>Booking Amount:</strong></td><td>$<?= strip_tags(
          $info["finalAmount"]
        ) ?></td></tr>
        <tr><td><strong>Booking Status:</strong></td><td><?= strip_tags(
          $info["bookStatus"]
        ) ?></td></tr>
        <?php if (!empty($info["festiveCouponCode"])): ?>
            <tr><td><strong>Festive Coupon Code:</strong></td><td><?= strip_tags(
              $info["festiveCouponCode"]
            ) ?></td></tr>
        <?php endif; ?>
        <tr style="background: #eee;"><td><strong>Booking Id:</strong></td><td><?= strip_tags(
          $info["bookingId"]
        ) ?></td></tr>
    </table>
    <div>You will receive your confirmation transportation voucher from: no_reply@insideloscabos.com</div>
    <div>Regards,<br/><strong><?= SITE_NAME ?></strong></div>
    <img src="<?= site_url("assets/img/newlogo.jpg") ?>" alt="Insideloscabos" />
    <p>How to find us at Los Cabos Airport:</p>
    <p>How to find us at Terminal 1: Go to the sign that says "Group Exits"</p>
    <p>How to find us at Terminal 2 &amp; 3:</p>
    <p>As soon as you pass customs, go all the way "OUTSIDE" the building where all the transportation companies are. There you will find your Airport Rep with the sign, he is under the tent number 6.</p>
</body>
</html>