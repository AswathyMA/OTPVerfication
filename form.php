<!DOCTYPE html>
<html lang="en">
<head>
  <title>OTP Verification</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  
<style>
  #snackbar {
    visibility: hidden;
    /* Hidden by default. Visible on click */
    min-width: 250px;
    /* Set a default minimum width */
    margin-left: -125px;
    /* Divide value of min-width by 2 */
    background-color: #21c62c;
    /* Black background color */
    color: #fff;
    /* White text color */
    text-align: center;
    /* Centered text */
    border-radius: 2px;
    /* Rounded borders */
    padding: 16px;
    /* Padding */
    position: fixed;
    /* Sit on top of the screen */
    z-index: 1;
    /* Add a z-index if needed */
    left: 50%;
    /* Center the snackbar */
    bottom: 30px;
    /* 30px from the bottom */
    border-radius: 10px;
}

/* Show the snackbar when clicking on a button (class added with JavaScript) */

#snackbar.show {
    visibility: visible;
    /* Show the snackbar */
    /* Add animation: Take 0.5 seconds to fade in and out the snackbar. 
However, delay the fade out process for 2.5 seconds */
    -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
    animation: fadein 0.5s, fadeout 0.5s 2.5s;
}
</style>
</head>

<body>

<div class="container otp-success" id="otp-success" style="border-radius: 10px;background-color: darkcyan;font-family: -webkit-body;color: aliceblue;padding-top: 30px;margin-top: 25px;width: 785px;border-bottom-right-radius: 8px;padding-bottom: 40px;padding-left: 125px;">
  <h2 style="text-align: -webkit-center;padding-bottom: 10px;">OTP VERIFICATION</h2>
  <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data" id="otp-form">
    <div class="form-group">
      <label class="col-sm-2" for="name">User Name:</label>
      <div class="col-sm-4">
        <input type="text" class="form-control" id="name" placeholder="Enter user name" name="name" required="">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2" for="mob">Mobile:</label>
      <div class="col-sm-4">          
        <input type="number" class="form-control" id="mob" placeholder="Enter mobile number" name="mob" required="">
      </div>
      <div class="col-sm-4">          
        <button type="submit" name="sendotp" id="sendotp"  class="btn btn-success send-otp">Send OTP</button>
      </div>
    </div>   
  </form>
  <div class="form-group enter-otp">
  <label class="col-sm-2" for="otp" style="margin-left: -14px;">OTP</label>
    <div class="col-sm-4" style="padding-left: 34px;">
    <input type="number" class="form-control" id="otp" placeholder="Enter OTP" name="otp" style="margin-left: -15px;width: 195px;;" required="">
    </div>
  <div class="col-sm-4" style="padding-left: 28px;">
    <button type="button" class="btn btn-primary verify-otp disabled" id="verify-otp" onclick="verifyOTP()" >Verify OTP</button>
  </div>
  </div>
  </div>
<div id="snackbar"><span class="snackbar_span"></span></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="jquery.cookie.js"></script>
<script>

$("#otp-form").submit(function(e) {

    var form = $(this);
    var url = form.attr('action');

    $.ajax({
           type: "POST",
           url: "submit.php",
           data: form.serialize(), // serializes the form's elements.
           success: function(data)
           {
              console.log(data);
              $('.snackbar_span').html("OTP send successfully !!")
              showSnackbar();
              $('#verify-otp').removeClass("disabled");
           },
           error: function (errorXHR, errorStatus, errorThrown) {
              $('.snackbar_span').html("Something went wrong !. Try again"); 
              $('#snackbar').css('background-color', '#F44336');            
              showSnackbar();
            }
         });

    e.preventDefault(); // avoid to execute the actual submit of the form.
});

function  verifyOTP(){
  $otp = $('#otp').val();
  if ($.cookie("otp") == $otp){
    $('.snackbar_span').html("OTP verified successfully !!")
    showSnackbar();
  }
  else{
    $('.snackbar_span').html("Something went wrong !. Try again"); 
    $('#snackbar').css('background-color', '#F44336');            
    showSnackbar();
  }
}

function showSnackbar() {
  try {
    /** [ Get the snackbar DIV ] */
    var x = document.getElementById("snackbar")

    /** [ Add the "show" class to DIV ] */
    x.className = "show";

    /** [  After 3 seconds, remove the show class from DIV ] */
    setTimeout(function () {
      x.className = x.className.replace("show", "");
    }, 3000);
  } catch (e) {
    console.log("Error:" + e)
  }
}
</script>
</body>
</html>
