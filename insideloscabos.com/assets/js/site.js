var loader = "<div align='center'><img src='" + site_url() +
  "/assets/loader.gif' id='loaderImg' class='loaderImg'/></div>";
function msgDiv(a, b, c) {
  if (b != "" && a != "") {
    return '<div class="alert alert-' + (a == 200 ? "success" : "danger") +
      '" id="my' + c +
      '" > <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">\u00d7</a> <strong>' +
      (a == 200 ? "Success" : "Error") + "! </strong>" + b + "</div>";
  }
}
$(document).ready(function () {
  localStorage.removeItem("isCouponApplied");
  $("#subscribeForm").validate(
    {
      rules: {
        "info[sname]": { required: true, alpha: true, minlength: 3 },
        "info[semail]": { required: true, email: true },
      },
      messages: {
        "info[sname]": { required: "Please enter your name" },
        "info[semail]": {
          required: "Please enter your email",
          email: "Please enter valid email",
        },
      },
      submitHandler: function (a) {
        console.log("form", a);
        $("#" + a.id + "").find("button[type=submit]").prop("disabled", true);
        $("#my" + a.id).remove();
        $(loader).insertBefore("#" + a.id);
        $.ajax(
          {
            url: a.action,
            cache: false,
            type: a.method,
            data: $(a).serialize(),
            dataType: "json",
            success: function (b) {
              $("#loaderImg").remove();
              console.log("response", b);
              b.status == 200 && $("#" + a.id)[0].reset();
              b = msgDiv(b.status, b.message, a.id);
              $(b).insertBefore("#" + a.id);
              $("#" + a.id + "").find("button[type=submit]").prop(
                "disabled",
                false,
              );
              grecaptcha.reset()
            },
            error: function (b) {
              console.log("errorResponse", b);
              b = msgDiv(b.status, b.statusText, a.id);
              $(b).insertBefore("#" + a.id);
              $("#" + a.id + "").find("button[type=submit]").prop(
                "disabled",
                false,
              );
              $("#loaderImg").remove();
            },
          },
        );
        return false;
      },
    },
  );
  $("#subscribeFormBlog").submit(function () {
    var a = $(this);
    a.id = a.attr("id");
    $("#" + a.id + "").find("button[type=submit]").prop("disabled", true);
    $("#my" + a.id).remove();
    $(loader).insertBefore("#" + a.id);
    $.ajax(
      {
        url: a.action,
        cache: false,
        type: a.method,
        data: $(a).serialize(),
        dataType: "json",
        success: function (b) {
          $("#loaderImg").remove();
          console.log("response", b);
          b.status == 200 && $("#" + a.id)[0].reset();
          b = msgDiv(b.status, b.message, a.id);
          $(b).insertBefore("#" + a.id);
          $("#" + a.id + "").find("button[type=submit]").prop(
            "disabled",
            false,
          );
        },
        error: function (b) {
          console.log("errorResponse", b);
          b = msgDiv(b.status, b.statusText, a.id);
          $(b).insertBefore("#" + a.id);
          $("#" + a.id + "").find("button[type=submit]").prop(
            "disabled",
            false,
          );
          $("#loaderImg").remove();
        },
      },
    );
    return false;
  });
  $("#contactForm").validate({
    errorPlacement: function (a, b) {
      if (b[0].id == "recaptcha_response_field") {
        console.log(b);
        $("#recaptcha_widget_div").after(a);
      } else a.insertAfter(b);
    },
    rules: {
      "info[name]": { required: true, alpha: true, minlength: 3 },
      "info[email]": { required: true, email: true },
      "info[phone]": {
        required: true,
        number: true,
        minlength: 10,
        maxlength: 12,
      },
      "info[passengers]": { required: true, number: true },
      "info[hotelId]": { required: true },
      "info[service]": { required: true },
      "info[arrivalFlight]": { required: true },
      "info[departureFlight]": { required: true },
      "info[comments]": { required: true },
      recaptcha_response_field: { required: true },
    },
    messages: {
      "info[name]": { required: "Please enter your name" },
      "info[email]": {
        required: "Please enter your email",
        email: "Please enter valid email",
      },
      "info[phone]": {
        required: "Please enter your phone",
        number: "Digits only",
        minlength: "Please enter valid phone no",
        maxlength: "Please enter valid phone no",
      },
      "info[passengers]": {
        required: "Please enter no of passengers",
        number: "Digits only",
      },
      "info[hotelId]": { required: "Please select your resort" },
      "info[service]": { required: "Please select type of service" },
      "info[arrivalFlight]": { required: "Please enter arrival flight detail" },
      "info[departureFlight]": {
        required: "Please enter departure flight detail",
      },
      "info[comments]": { required: "Please enter comments" },
      recaptcha_response_field: { required: "Please enter captcha" },
    },
    submitHandler: function (a) {
      $("#" + a.id + "").find("button[type=submit]").prop("disabled", true);
      $("#my" + a.id).remove();
      $("#loader" + a.id).show();
      $.ajax(
        {
          url: a.action,
          cache: false,
          type: a.method,
          data: $(a).serialize(),
          dataType: "json",
          success: function (b) {
            $("#loader" + a.id).hide();
            console.log("response", b);
            if (b.status == 200) {
              $("#" + a.id)[0].reset();
              jQuery("#recaptcha_reload").click();
            }
            b = msgDiv(
              b.status,
              (b.status == 200)
                ? "Thanks for contacting us, our support team will get back to you shortly."
                : b.message,
              a.id,
            );
            $(b).insertAfter("#" + a.id + "Btn");
            $("#" + a.id + "").find("button[type=submit]").prop(
              "disabled",
              false,
            );
          },
          error: function (b) {
            console.log("errorResponse", b);
            b = msgDiv(b.status, b.statusText, a.id);
            $(b).insertBefore("#" + a.id);
            $("#" + a.id + "").find("button[type=submit]").prop(
              "disabled",
              false,
            );
            jQuery("#recaptcha_reload").click();
            $("#loader" + a.id).hide();
          },
        },
      );
      return false;
    },
  });
  $("#formComment").validate(
    {
      rules: {
        fullName: { required: true, minlength: 3, alpha: true },
        email: { required: true, email: true },
        website: { required: true, url: true },
        message: { required: true },
      },
      messages: {
        fullName: { required: "Please enter your name" },
        email: {
          required: "Please enter your email",
          email: "Please enter valid email",
        },
        website: { required: "Please enter your phone" },
        message: { required: "Please enter message" },
      },
      submitHandler: function (a) {
        $("#" + a.id + "").find("button[type=submit]").prop("disabled", true);
        $("#my" + a.id).remove();
        $("#loader" + a.id).show();
        $.ajax(
          {
            url: a.action,
            cache: false,
            type: a.method,
            data: $(a).serialize(),
            dataType: "json",
            success: function (b) {
              $("#loader" + a.id).hide();
              console.log("response", b);
              b.status == 200 && $("#" + a.id)[0].reset();
              b = msgDiv(b.status, b.message, a.id);
              $(b).insertAfter("#" + a.id + "Btn");
              $("#" + a.id + "").find("button[type=submit]").prop(
                "disabled",
                false,
              );
            },
            error: function (b) {
              console.log("errorResponse", b);
              b = msgDiv(b.status, b.statusText, a.id);
              $(b).insertBefore("#" + a.id);
              $("#" + a.id + "").find("button[type=submit]").prop(
                "disabled",
                false,
              );
              $("#loader" + a.id).hide();
            },
          },
        );
        return false;
      },
    },
  );
  $("#quoteForm").validate(
    {
      ignore: ".ignore",
      rules: {
        "info[name]": { required: true, alpha: true, minlength: 3 },
        "info[email]": { required: true, email: true },
        "info[phone]": {
          required: true,
          number: true,
          minlength: 10,
          maxlength: 12,
        },
        "info[reservationDate]": { required: true },
        "info[hotelId]": { required: true },
        "info[service]": { required: true },
        "info[resturant]": { required: true },
        "info[adults]": {
          required: true,
          number: true,
          minlength: 1,
          maxlength: 2,
        },
        "info[kids]": {
          required: true,
          number: true,
          minlength: 1,
          maxlength: 2,
        },
        "info[comments]": { required: true },
      },
      messages: {
        "info[name]": { required: "Please enter your name" },
        "info[email]": {
          required: "Please enter your email",
          email: "Please enter valid email",
        },
        "info[phone]": {
          required: "Please enter your phone",
          number: "Digits only",
          minlength: "Please enter valid phone no",
          maxlength: "Please enter valid phone no",
        },
        "info[reservationDate]": { required: "Please enter reservation date" },
        "info[hotelId]": { required: "Please select your resort" },
        "info[service]": { required: "Please select type of service" },
        "info[resturant]": { required: "Please enter restaurant" },
        "info[adults]": { required: "Please enter number of adults" },
        "info[kids]": { required: "Please enter number of kids" },
        "info[comments]": { required: "Please enter comments" },
      },
      submitHandler: function (a) {
        $("#" + a.id + "").find("button[type=submit]").prop("disabled", true);
        $("#my" + a.id).remove();
        $("#loader" + a.id).show();
        $.ajax(
          {
            url: a.action,
            cache: false,
            type: a.method,
            data: $(a).serialize(),
            dataType: "json",
            success: function (b) {
              $("#loader" + a.id).hide();
              console.log("response", b);
              var c = msgDiv(b.status, b.message, a.id);
              $(c).insertBefore("#msgRow");
              $("#" + a.id + "").find("button[type=submit]").prop(
                "disabled",
                false,
              );
              if (b.status == 200) {
                $("#" + a.id)[0].reset();
                setTimeout(function () {
                  $("#quoteModal").modal("hide");
                }, 1E3);
              }
            },
            error: function (b) {
              console.log("errorResponse", b);
              b = msgDiv(b.status, b.statusText, a.id);
              $(b).insertBefore("#msgRow");
              $("#" + a.id + "").find("button[type=submit]").prop(
                "disabled",
                false,
              );
              $("#loader" + a.id).hide();
            },
          },
        );
        return false;
      },
    },
  );
  jQuery.validator.addMethod("checkPass", function () {
    var a = $("#passangers_range").val();
    console.log("$('#type').val()", $("#type").val());
    if ($("#type").val() == "private_transport") {
      a = a.split("-");
      var b = parseInt(a[0]);
      a = parseInt(a[1]);
    } else b = a;
    var c = parseInt($("#adults").val()) + parseInt($("#kids").val());
    console.log("total", c);
    console.log("maxval", a);
    console.log("minval", b);
    if (c < b || c > a) {
      console.log(
        "Total number of adults and kids must be greater than " + b +
          " and less then or equal to " + a + ".",
      );
      return false;
    }
    return true;
  }, "Total number of adults and kids does not match with passenger range");
  $("#privateTransForm").validate(
    {
      errorElement: "span",
      rules: {
        "info[name]": { required: true, minlength: 3, alpha: true },
        "info[email]": { required: true, email: true },
        "info[phone]": {
          required: true,
          number: true,
          minlength: 10,
          maxlength: 12,
        },
        "info[hotelId]": { required: true },
        "info[passengers]": { required: true },
        "info[service]": { required: true },
        "info[arrivalFlight]": { required: true, nowhitespace: true },
        "info[departureFlight]": {
          required: function () {
            if ($("#trip_type").val() == "round_trip") return true;
            return false;
          },
        },
        "info[arrivalDate]": { required: true },
        "info[departureDate]": {
          required: function () {
            if ($("#trip_type").val() == "round_trip") return true;
            return false;
          },
          greaterThan: "#arrival_date",
        },
        "info[comments]": { required: true },
        "info[adults]": {
          required: function () {
            if ($("#type").val() == "private_transport") return true;
            return false;
          },
          number: true,
          minlength: 1,
          maxlength: 2,
          checkPass: function () {
            if ($("#type").val() == "private_transport") {
              console.log("checkPass", $("#type").val());
              return true;
            }
            return false;
          },
        },
        "info[kids]": {
          required: function () {
            if ($("#type").val() == "private_transport") return true;
            return false;
          },
          number: true,
          minlength: 1,
          maxlength: 2,
        },
      },
      messages: {
        "info[name]": { required: "Please enter your name" },
        "info[email]": {
          required: "Please enter your email",
          email: "Please enter valid email",
        },
        "info[phone]": {
          required: "Please enter your phone",
          number: "Digits only",
          minlength: "Please enter valid phone no",
          maxlength: "Please enter valid phone no",
        },
        "info[hotelId]": { required: "Please select your resort" },
        "info[service]": { required: "Please select type of service" },
        "info[passengers]": { required: "Please enter no of passengers" },
        "info[arrivalFlight]": {
          required: "Please enter arrival flight detail",
          alphanumeric: true,
        },
        "info[departureFlight]": {
          required: "Please enter departure flight detail",
          alphanumeric: true,
        },
        "info[arrivalDate]": { required: "Please enter arrival date" },
        "info[departureDate]": {
          required: "Please enter departure date",
          greaterThan: "Must be greater than arrival date",
        },
        "info[comments]": { required: "Please enter comments" },
        "info[adults]": { required: "Please enter no of adults" },
        "info[kids]": { required: "Please enter no of kids" },
      },
      submitHandler: function (a) {
        $("#loader" + a.id).show();
        $("#my" + a.id).remove();
        $("#" + a.id + "").find("button[type=submit]").prop("disabled", true);
        a.submit();
      },
    },
  );
  $("body").on("click", ".apply-coupon-code", function () {
    if (
      $("#arrival_date").val() != "" && $("#arrival_date").val() != undefined &&
      $("#arrival_date").val() != null
    ) {
      removeCost();
    }
    let tripCost = parseNumber($("#cost").val());
    let transportationType = parseInt($(this).attr("main"));
    let couponCode = $("#coupon_code").val();
    if (tripCost > 0) {
      if (couponCode == "" || couponCode == null || couponCode == undefined) {
        alert("Please enter coupon code");
        return false;
      }
      $.ajax(
        {
          url: site_url() + "/welcome/checkCouponCode",
          data: "coupon_code=" + couponCode + "&transportationType=" +
            transportationType,
          type: "POST",
          cache: false,
          dataType: "json",
          success: function (d) {
            if (d.type == 1) {
              var discount_amount = 0;
              if (d.coupon_type == 0) {
                discount_amount = parseNumber(d.coupon_amount);
              } else {
                let cd =
                  (parseNumber(tripCost * parseNumber(d.coupon_amount)) / 100);
                discount_amount = cd.toFixed(2);
              }
              localStorage.setItem("isCouponApplied", 1);
              console.log("discount_amount", discount_amount);
              let final_trip_cost = parseNumber(tripCost - discount_amount)
                .toFixed(2);
              console.log("final_trip_cost", final_trip_cost);
              $("#cost").val(final_trip_cost);
              $("#amount").text(final_trip_cost);
              $("#coupon_code").attr("readonly", true);
              $("#coupon_discount").val(discount_amount);
              $(".coupon-success-msg").removeClass("hide-class").text(
                "Coupon applied successfully (Discount amount $" +
                  discount_amount + ")",
              );
              $(".remove-coupon-code").removeClass("hide-class");
              $(".apply-coupon-code").addClass("hide-class");
            } else {
              localStorage.removeItem("isCouponApplied");
              alert(d.msg);
              return false;
            }
          },
          error: function () {
            localStorage.removeItem("isCouponApplied");
            alert("Error occured !");
            return false;
          },
        },
      );
    } else {
      localStorage.removeItem("isCouponApplied");
      alert("First please select trip resort");
      return false;
    }
  });
  $("body").on("click", ".remove-coupon-code", function () {
    let coupon_discount = parseFloat($("#coupon_discount").val()).toFixed(2);
    let tripCost = parseFloat($("#cost").val()).toFixed(2);
    console.log("coupon_discount", coupon_discount);
    console.log("tripCost", tripCost);
    var final_trip_cost = 0;
    final_trip_cost = parseFloat(
      parseFloat(coupon_discount) + parseFloat(tripCost),
    ).toFixed(2);
    console.log("final_trip_cost", final_trip_cost);
    $("#cost").val(final_trip_cost);
    $("#amount").text(final_trip_cost);
    $("#coupon_code").attr("readonly", false);
    $("#coupon_discount").val("");
    $("#coupon_code").val("");
    $(".coupon-success-msg").addClass("hide-class").text("");
    $(".remove-coupon-code").addClass("hide-class");
    $(".apply-coupon-code").removeClass("hide-class");
    localStorage.removeItem("isCouponApplied");
    var a = $("#passangers_range").val(),
      b = $("#hotelId").val(),
      c = $("#type").val(),
      e = $("#trip_type").val(),
      f = $("#couponCode").val(),
      g = $("#arrival_date").val();
    if (b != "") {
      a = "type=" + c + "&passengers=" + a + "&hotelId=" + b + "&service=" + e +
        "&couponCode=" + f + "&arrivalDate=" + g;
      $.ajax(
        {
          url: site_url() + "/transportation/getCost",
          data: a,
          type: "POST",
          cache: false,
          dataType: "json",
          success: function (d) {
            $("#amount").html(d.cost);
            $("#cost").val(d.cost);
          },
          error: function () {
            $("#amount").html("0");
            $("#cost").val("0");
          },
        },
      );
    } else {
      $("#amount").html("0");
      $("#cost").val("0");
    }
  });
});
function site_url() {
  var a = location.protocol + "//" + location.host, b = "";
  if (a == "http://localhost") {
    b = window.location.pathname;
    var c = b.split("/")[0];
    c = c == "" ? "/" + b.split("/")[1] : c;
    b = a + c;
  } else b = document.location.origin;
  console.log("site_url", b);
  return b;
}
function showDep(a) {
  a == "round_trip" ? $("#departure").show() : $("#departure").hide();
}
function parseNumber(number) {
  if (number != "" && number != null && number != undefined) {
    if (Number.isInteger(number)) {
      return number;
    } else {
      return parseFloat(parseFloat(number).toFixed(2));
    }
  } else return 0;
}
function removeCost() {
  let currentCost = parseNumber($("#cost").val());
  var a = $("#passangers_range").val(),
    b = $("#hotelId").val(),
    c = $("#type").val(),
    e = $("#trip_type").val(),
    f = $("#couponCode").val(),
    g = $("#arrival_date").val();
  if (b != "") {
    a = "type=" + c + "&passengers=" + a + "&hotelId=" + b + "&service=" + e +
      "&couponCode=" + f + "&arrivalDate=" + g;
    $.ajax(
      {
        url: site_url() + "/transportation/getCost",
        data: a,
        type: "POST",
        cache: false,
        async: false,
        dataType: "json",
        success: function (d) {
          $("#amount").html(currentCost + parseNumber(d.discount));
          $("#cost").val(currentCost + parseNumber(d.discount));
        },
        error: function () {
          $("#amount").html(currentCost);
          $("#cost").val(currentCost);
        },
      },
    );
  } else {
    $("#amount").html(currentCost);
    $("#cost").val(currentCost);
  }
}
function setCost(event) {
  let isCouponApplied = localStorage.getItem("isCouponApplied");
  if (
    isCouponApplied != "" && isCouponApplied != undefined &&
    isCouponApplied != null && isCouponApplied == 1
  ) {
    return false;
  }
  var a = $("#passangers_range").val(),
    b = $("#hotelId").val(),
    c = $("#type").val(),
    e = $("#trip_type").val(),
    f = $("#couponCode").val(),
    g = $("#arrival_date").val();
  console.log("arrival_date" + g);
  $(".remove-coupon-code").trigger("click");
  if (b != "") {
    a = "type=" + c + "&passengers=" + a + "&hotelId=" + b + "&service=" + e +
      "&couponCode=" + f + "&arrivalDate=" + g;
    $.ajax(
      {
        url: site_url() + "/transportation/getCost",
        data: a,
        type: "POST",
        cache: false,
        dataType: "json",
        success: function (d) {
          if (
            event.target.id == "hotelId" && jQuery("#arrival_date").val() == ""
          ) {
            jQuery("#choose_arrival_day").show();
          } else {
            jQuery("#choose_arrival_day").hide();
          }
          if (d.discount) {
            jQuery("#discounted_message").html(
              `You are receiving ${d.discount}% discount!!`,
            );
            jQuery("#discounted_message").show();
          } else {
            jQuery("#discounted_message").html(``);
            jQuery("#discounted_message").hide();
          }

          $("#amount").html(d.cost);
          $("#cost").val(d.cost);
        },
        error: function () {
          $("#amount").html("0");
          $("#cost").val("0");
        },
      },
    );
  } else {
    $("#amount").html("0");
    $("#cost").val("0");
  }
}
