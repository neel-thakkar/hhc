<?php
	if(isset($_POST["hName"])){
		
			$hName = $_POST["hName"];
	}else{
		$hName = 0;
		
	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Hamilton Health Center</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type='text/javascript' src='https://www.bing.com/api/maps/mapcontrol?key=ApTlz3zPznydG714QvW8vKPY96K-xMAnUwmoTfZXBXFlvR2CMNKfXjHfw-ykCp19&callback=loadMapScene' async defer></script>
	<script type='text/javascript'>
	
		var hospitals = [{"objid":"1","name":"Juravinski Cancer Centre","addr":"699 Concession Street","city":"HAMILTON","phone":"(905) 521-2100","type":"N\/A","latitude":"43.240102736704635","longitude":"-79.84658516395245"},{"objid":"2","name":"Chedoke Hospital","addr":"565 Sanatorium Road","city":"HAMILTON","phone":"(905) 521-2100","type":"N\/A","latitude":"43.238561228664494","longitude":"-79.91710035478114"},{"objid":"3","name":"Hamilton General Hospital","addr":"237 Barton Street East","city":"HAMILTON","phone":"(905) 527-4322","type":"N\/A","latitude":"43.26194143120613","longitude":"-79.85433161542542"},{"objid":"4","name":"Juravinski Hospital","addr":"711 Concession Street","city":"HAMILTON","phone":"(905) 527-4322","type":"N\/A","latitude":"43.24013072756382","longitude":"-79.84500442878306"},{"objid":"5","name":"Mcmaster University Medical Centre","addr":"1200 Main Street West","city":"HAMILTON","phone":"(905) 521-2100","type":"N\/A","latitude":"43.25961289621226","longitude":"-79.91762702390393"},{"objid":"6","name":"St. Joseph's Hospital - Charlton Campus","addr":"50 Charlton Avenue East","city":"HAMILTON","phone":"(905) 522-4941","type":"N\/A","latitude":"43.248604890980836","longitude":"-79.87092405415079"},{"objid":"7","name":"St. Peter's Hospital","addr":"88 Maplewood Avenue","city":"HAMILTON","phone":"(905) 777-3837","type":"Chronic Care","latitude":"43.24475398423596","longitude":"-79.83686635075972"},{"objid":"8","name":"St. Joseph's Centre For Mountain Health Services - West 5th Campus","addr":"100 West 5th Street","city":"HAMILTON","phone":"(905) 388-2511","type":"Psychiatric","latitude":"43.24233812377529","longitude":"-79.88312181245138"},{"objid":"9","name":"St. Joseph's Hospital - Urgent Care At King Campus","addr":"2757 King Street East","city":"HAMILTON","phone":"(905) 573-4813","type":"Urgent Care","latitude":"43.22172114705383","longitude":"-79.77384588448024"}];
		var hName = "<?php echo $hName ?>";
		var infobox;
		
		function loadMapScene()
		{
			var map = new Microsoft.Maps.Map(document.getElementById('bm'),{});
				infoBox = new Microsoft.Maps.Infobox(map.getCenter(),{visible:false,maxHeight: 6000});
				infoBox.setMap(map);
			
			
					if(hName == 0){
						alert("Please select the hospital before submitting");
						
					}else{
							var pushPin = new Microsoft.Maps.Pushpin(new Microsoft.Maps.Location(hospitals[hName-1].latitude, hospitals[hName-1].longitude), { text: 'H', title: 'Centers', subTitle: '' });
				
							pushPin.Title = hospitals[hName-1].name;
					
							pushPin.Description = hospitals[hName-1].addr + "<br/>" + hospitals[hName-1].city + "<br/>" + '<a href="tel:hospitals[hName-1].phone">'+hospitals[hName-1].phone+'</a>' + "<br/>" + '<a href="https://www.bing.com/maps/directions?cp='+hospitals[hName-1].latitude+'~'+hospitals[hName-1].longitude+'&amp;sty=r&amp;lvl=11&amp;rtp=~pos.'+hospitals[hName-1].latitude+'_'+hospitals[hName-1].longitude+'____&amp;FORM=MBEDLD" target="_blank">Get Directions</a>';
						
							Microsoft.Maps.Events.addHandler(pushPin, 'click', displayInfoBox);
					
							map.entities.push(pushPin);
					}
						
				
				
				
			
			var pL = document.getElementById("printLoc");
			if(navigator.geolocation){
				navigator.geolocation.getCurrentPosition(printPos,printError);
			}else{
				pL.innerHTML = "Geolocation cannot be accessed with this browser";
			}
			
			function printPos(position)
			{
				var userLoc = new Microsoft.Maps.Location(
					position.coords.latitude,
					position.coords.longitude);		
				var userPin = new Microsoft.Maps.Pushpin(userLoc,{icon: 'pin1.png', anchor: new Microsoft.Maps.Point(12,39)});
				userPin.Title = "Current Location";
				userPin.Description = "";
				Microsoft.Maps.Events.addHandler(userPin, 'click', displayInfoBox);
				map.entities.push(userPin);
				map.setView({center: userLoc, zoom: 14});
				pL.innerHTML = "Latitude: " + position.coords.latitude + "<br/>Longitude: " + position.coords.longitude;
			}
			function printError(error) 
			{
				switch(error.code) {
					case error.PERMISSION_DENIED:
						pL.innerHTML = "The Location acquisition process failed because the document does not have permission to use the Geolocation API."
						break;
					case error.POSITION_UNAVAILABLE:
						pL.innerHTML = "GPS Co-ordinates Unavailable!! Default Values used."
						break;
					case error.TIMEOUT:
						pL.innerHTML = "The request to get user location timed out."
						break;
					case error.UNKNOWN_ERROR:
						pL.innerHTML = "An unknown error occurred."
						break;
				}
			}
			
		}
		function displayInfoBox(e)
		{
			infoBox.setOptions({location: e.target.getLocation(),visible: true, title: e.target.Title, description: e.target.Description});
		}
		
	</script>
	<style>
		#bm{
			width: 80%;
			float:center;
			margin-left:auto;
			margin-right:auto;
			text-align:center;
			display:inline-block;
		}
		@media only screen and (max-width: 700px){
			#bm{
				width: 95%;
				float: none;
			}
		}
	</style>
</head>

<body>

	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				
				<a class="pull-left" href="#"><img class="img-fluid" src="hhc.png" ></a>
				
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<div class="page-header no-padding no-margin" style="margin-top:80px;"><h1 class="text-center">Welcome to HHC Search Application</h1></div>
				
				
			</div>
		</div>
	</nav>
	<nav class="navbar fixed-bottom navbar-light bg-light">
		<a href="tel:911" class="btn btn-danger btn-lg btn-block" role="button" aria-pressed="true">Emergency</a>
		<h2>
		
		<form method="post" action="fast.php">
				<select class="text-center col-lg-6 col-md-6 col-sm-6 col-sm-offset-3 col-xs-6 col-xs-offset-3" name= "hName" id="hName">
					<option disabled selected value>Select a Hospital for more Info</option>
					<option value='1'>Juravinski Cancer Centre</option>
					<option value='2'>Chedoke Hospital</option>
					<option value='3'>Hamilton General Hospital</option>
					<option value='4'>Juravinski Hospital</option>
					<option value='5'>Mcmaster University Medical Centre</option>
					<option value='6'>St. Joseph's Hospital - Charlton Campus</option>
					<option value='7'>St. Peter's Hospital</option>
					<option value='8'>St. Joseph's Centre For Mountain Health Services</option>
					<option value='9'>St. Joseph's Hospital - Urgent Care At King Campus</option>
				</select>
				<button type="submit">Submit</button>
		</form>
		
		</h2>
	</nav>
	<div class="container"><div class="row"><div id='bm' class="col-sm-6" style='width: 100%; height: 350px; border: 3px solid;'></div></div></div>
	<div class="container text-center">
    
	<p><br/></p>
	
	<p id='printLoc'></p>
	
	<div  style="white-space: nowrap; margin:auto; text-align: center; width: 800px; padding: 6px 0;">
		<a class="text-center" id="dirMapLink" target="_blank" href="https://www.bing.com/maps/directions?FORM=MBEDLD">Get Directions</a>
	</div>
	</div>
	
	<script type='text/javascript' src='https://www.bing.com/api/maps/mapcontrol?key=ApTlz3zPznydG714QvW8vKPY96K-xMAnUwmoTfZXBXFlvR2CMNKfXjHfw-ykCp19&callback=loadMapScene' async defer></script>
</body>
</html>