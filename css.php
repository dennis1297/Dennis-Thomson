<script src="https://apis.google.com/js/api:client.js"></script>

<link rel="stylesheet" href="<?php echo URL?>css/bootstrap.min.css">

<link rel="stylesheet" href="<?php echo URL?>css/fontawesome.min.css">

<link rel="stylesheet" href="<?php echo URL?>css/owl.carousel.min.css">

<link rel="stylesheet" href="<?php echo URL?>css/owl.theme.default.min.css">

<link rel="stylesheet" href="<?php echo URL?>css/style.css">

<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">

<script src="<?php echo URL?>js/jquery.min.js"></script> 

<script>
var googleUser = {};
var startApp = function() {
  gapi.load('auth2', function(){
    // Retrieve the singleton for the GoogleAuth library and set up the client.
    auth2 = gapi.auth2.init({
      client_id: '740521700366-5eq0qk61crm044jcc1faefoidhn37dqs.apps.googleusercontent.com',
      cookiepolicy: 'single_host_origin',
      // Request scopes in addition to 'profile' and 'email'
      //scope: 'additional_scope'
    });
    attachSignin(document.getElementById('customgoogleBtn'));
  });
};
function attachSignin(element) {
  auth2.attachClickHandler(element, {},
    function(googleUser) {
      var profile = googleUser.getBasicProfile();
      $.ajax({
        url: "<?php echo URL?>scripts.php",
        type: "POST",
        data:  {action:"googlelogin", email:profile.getEmail(), fname:profile.getGivenName(), lname:profile.getFamilyName()},
        success: function(res){	
          if(res==1){
            window.location.href="<?php echo URL?>";
          }
          else{
            $("#login_restxt").html('<span class="err">Error google login</span>');
          }
        }
      });
    }, 
    function(error) {
      $("#login_restxt").html('<span class="err">Error google login</span>');
      //alert(JSON.stringify(error, undefined, 2));
    }
  );
} 
function signOut() {
  gapi.auth.signOut();
  window.location.href="<?php echo URL?>logout";

  var auth2 = gapi.auth2.getAuthInstance();
  auth2.signOut().then(function () {
    //console.log('User signed out.');
    window.location.href="<?php echo URL?>logout";
  });
}
</script>