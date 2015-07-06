
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</head>
<body>
	<script>
	  window.fbAsyncInit = function() {
	    FB.init({
	      appId      : '671523772980607',
	      xfbml      : true,
	      version    : 'v2.3'
	    });
	  };

	  (function(d, s, id){
	     var js, fjs = d.getElementsByTagName(s)[0];
	     if (d.getElementById(id)) {return;}
	     js = d.createElement(s); js.id = id;
	     js.src = "//connect.facebook.net/en_US/sdk.js";
	     fjs.parentNode.insertBefore(js, fjs);
	   }(document, 'script', 'facebook-jssdk'));

	  /* 4-16 character summoner name use Riot API to check after checking DB first */
	</script>	
	<div>
		<input type="text" id="name" />
		<select>
		  <option value="bronze">Bronze</option>
		  <option value="silver">Silver</option>
		  <option value="gold">Gold</option>
		  <option value="platinum">Platinum</option>
		  <option value="diamond">Diamond</option>
		</select>
		<select>
		  <option value="i">I</option>
		  <option value="ii">II</option>
		  <option value="iii">III</option>
		  <option value="iv">IV</option>
		  <option value="v">V</option>
		</select>
		<button id="search_button">Search</button>
	</div>
	

</body>
</html>