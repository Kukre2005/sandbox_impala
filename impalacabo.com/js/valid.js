$(document).ready(function(){


  $("#adate, #dDate").datepicker({
    changeMonth: true,
    changeYear: true,
    dateFormat: "DD, d MM, yy",
    minDate: 0,
  });

  $(".yes").change(function(e){

    var conf_box = confirm("If you are attending to a wedding, \nClick [OK] to Visit Site");
    if(conf_box===true){
        location.replace("http://impalacabo.net/");
    } else {
        e.preventDefault();
        $(".no").prop("checked", true);
    }

  });
  $(".no").change(function(){
    $("#select_option + span").hide();
  });
  $(".full_name").keyup(function(){
    $(".full_name + span").hide();
    $(".full_name").css("border-color","#ffb124");
  })
  $(".userEmail").keyup(function(){
    $(".userEmail + span").hide();
    $(".userEmail").css("border-color","#ffb124");
  })
  $(".country_name").change(function(){
    $(".country_name + span").hide();
    $(".country_name").css("border-color","#ffb124");
  })
  $("#qut_form").on('submit', function(event){

      var name = $(".full_name").val();
      var email = $(".userEmail").val();
      var phone = $(".phone_number").val();
      var cont = $(".country_name").val();
      var regex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      var capres = grecaptcha.getResponse();

      if((($(".yes").is(":not(:checked)")) && ($(".no").is(":not(:checked)"))) || name.length === 0 || email.length === 0 || cont.length === 0 || capres.length === 0){

          if(($(".yes").is(":not(:checked)")) && ($(".no").is(":not(:checked)"))){
            $("#select_option + span").hide();
            $("#select_option").after('<span class="text-danger custom-text-main">Please Select any one option');
          } else {
            $("#select_option + span").hide();
          }

          if(name.length === 0){
            $(".full_name+span").hide();
            $(".full_name").after('<span class="text-danger custom-text-main">Please Enter Your Name');
            $(".full_name").css("border-color","#F00");
          } else {
              $(".full_name+span").hide();
          }

          if(email.length === 0){
            $(".userEmail+span").hide();
            $(".userEmail").after('<span class="text-danger custom-text-main">Please Enter Your Email ID');
            $(".userEmail").css("border-color","#F00");
          } else {
            $(".userEmail+span").hide();
          }

          if(cont === "0"){
            $(".country_name+span").hide();
            $(".country_name").after('<span class="text-danger custom-text-main">Please Enter Your Country Name');
            $(".country_name").css("border-color","#F00");
          } else {
                  $(".country_name+span").hide();
          }

          if(capres.length === 0){
            $(".captchablock + span").hide();
            $(".captchablock").after('<span class="text-danger custom-text-main">Please Verify Yourself');
          } else {
            $(".captchablock+span").hide();
          }

          $(".sendData + .row").hide();
          $(".sendData").after('<div class="row"><div class="col-lg-12 text-danger custom-text">Please fill in all mandatory fields marked with an asterisk (*)</div></div>');


        event.preventDefault();

      } else if(regex.test(email) === false){
          $(".userEmail+span").hide();
          $(".userEmail").after('<span class="text-danger custom-text-main">Please Enter Correct Email ID');
          $(".sendData + span").hide();
            $(".sendData").after('<span class="text-danger custom-text-main">Please Fill the fields</span>')

        event.preventDefault();
      }

  });

});
