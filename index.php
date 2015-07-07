
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
	<form id="match_maker">
		Summoner Name:
		<input type="text" id="name" />
		<br>
		Region:
		<select id="region">
			<option value="na">NA</option>
			<option value="br">BR</option>
			<option value="eune">EUNE</option>
			<option value="euw">EUW</option>
			<option value="kr">KR</option>
			<option value="oce">OCE</option>
			<option value="tr">TR</option>
			<option value="ru">RU</option>
		</select>
		<br>
		League:
		<select id="league">
		  <option value="bronze">Bronze</option>
		  <option value="silver">Silver</option>
		  <option value="gold">Gold</option>
		  <option value="platinum">Platinum</option>
		  <option value="diamond">Diamond</option>
		</select>
		<br>
		Rank:
		<select id="rank">
		  <option value="1">I</option>
		  <option value="2">II</option>
		  <option value="3">III</option>
		  <option value="4">IV</option>
		  <option value="5">V</option>
		</select>
		<br>
		Position: 
		<select id="position">
			<option value="top">Top</option>
			<option value="jungle">Jungle</option>
			<option value="middle">Middle</option>
			<option value="marksman">Marksman</option>
			<option value="support">Support</option>
		</select>
		<button id="search_button">Search</button>
	</form>
	<div id="status_text"></div>
<script>
var submit = "", 
	id = "",
	name = "",  
	region = "",
	position = "", 
	league = "", 
	rank = "";

function htmlEncode(value){
  //create a in-memory div, set it's inner text(which jQuery automatically encodes)
  //then grab the encoded contents back out.  The div never exists on the page.
  return $('<div/>').text(value).html();
}

function htmlDecode(value){
  return $('<div/>').html(value).text();
}

function findPartner(id, n, re, l, ra, p) {
	$.ajax({
		type: "GET",
		url: "find_partner.php",
		data: {
			id: id,
			n: n,
			re: re,
			l: l,
			ra: ra,
			p: p
		},
		success: function(data) {
			console.log("success find_partner");
			$('#status_text').html('Finding duo partner..');
		}
	});
}

$("#search_button").click(function() {
	var retval = false;
	region = $("#region").val();
	name = $("#name").val();
	name = htmlEncode(name);
	region = htmlEncode(region);

	if(!retval) {
		$.ajax({
			url: "https://na.api.pvp.net/api/lol/"+region+"/v1.4/summoner/by-name/"+name+"?api_key=0ec9b3d1-8199-45f8-b312-3028da32969c", 
			error: function(data, statusText, xhr) {
				if(xhr.status !== 200) {
					$("#name").val('');
					$('#status_text').html('Summoner name not found!');
				}
			},
			success: function(data) {
				for(var a in data) {
					name = data[a].name;
					id = data[a].id;
					break;
				}

				league = $("#league").val();
				rank = $("#rank").val();
				position = $("#position").val();

				league = htmlEncode(league);
				rank = htmlEncode(rank);
				position = htmlEncode(position);

				findPartner(id, name, region, league, rank, position);

			}
		});	
	}
	return false;
});

</script>
</body>
</html>