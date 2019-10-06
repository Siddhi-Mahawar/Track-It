<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title></title>
  <link rel="stylesheet" href="">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>

  <script>
    // initialize and setup facebook js sdk
    window.fbAsyncInit = function() {
        FB.init({
          appId      : '701595690266031',
          xfbml      : true,
          version    : 'v4.0'
        });
    };
    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    
    // login with facebook with extra permissions
    function login() {
      FB.login(function(response) {
        
      }, {scope: 'email'});
    }
    
    // getting basic user info
    function getInfo() {
      console.log("a  aaa");
      FB.api('/me', 'GET', {fields: 'first_name,last_name,name,id,email'}, function(response) {
        setval(response.email,response.name,response.first_name,response.last_name);
      });
    }

    function setval(a,b,c,d) {
          jQuery.ajax({
              type: "POST",
              url: 'fb_backend.php',
              dataType: 'json',
              data: {arguments: [a,b,c,d]},
              success: function(data)
                      {
                          console.log(data);
                          alert("hey");
                      }
          });

}
    function sleep (time) {
      return new Promise((resolve) => setTimeout(resolve, time));
    }
    function getStatus() {
      FB.getLoginStatus(function(response) {
        console.log(response.status);
         if (response.status === 'connected') {
             getInfo();
         } else{
          login();
         }
       });
    }
    window.onload=function(){
    	FB.init({
          appId      : '701595690266031',
          xfbml      : true,
          version    : 'v4.0'
        });
      getStatus();  
      sleep(10000).then(() => {
          window.location='home.php';
      });
    };
  </script>

</body>
</html>