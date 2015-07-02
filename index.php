<html>
<head>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

<style>
.i_serious {
	float: left;
	margin:10px;
}
.button{
    background: url(/images/open.png) repeat-x;
	width:23px;
	height:22px;
}
#i7{
	background: url(/images/i7.png) repeat-x;
	width:90px;
	height:23px;
}

</style>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

<script>
$(document).ready(function(){
	var xmlhttp = new XMLHttpRequest();
	
	$("#invisibleCPU").hide();
	$("#i_serious").hide();
	$("#invisibleRAM").hide();
	$('#invisibleHD').hide();
	$('#invisibleEmmc').hide();
	$('#invisibleSSD').hide();
	
	$("#ToggleIntel").click(function(){
		$("#invisibleCPU").toggle();
	}
	);
	$("#ToggleIntelCore").click(function(){
			$("#i_serious").toggle();
	});
	
	
	$("#ToggleRAM").click(function(){
		$("#invisibleRAM").toggle();
	}
	);
		
		
	$('#ToggleHD').click(function(){
		$('#invisibleHD').toggle();
	}
	)
	$('#ToggleEmmc').click(function(){
		$('#invisibleEmmc').toggle();
	}
	)
	$('#ToggleSSD').click(function(){
		$('#invisibleSSD').toggle();
	}
	)
	
	
	
	$("#search").click(function(){
		var values=$("#key_words").val();
		
		
        xmlhttp.onreadystatechange = function() {
			
            if (xmlhttp.readyState == 4) {
				
				var return_value = xmlhttp.responseText;
				document.getElementById("text").innerHTML= return_value ;
				
            }
        }
		
        xmlhttp.open("GET", "handler?value=" + values, true);
        xmlhttp.send(); 
		return false;
	});
	
	
		
	$("#i7").click(function() {		
        xmlhttp.onreadystatechange = function() {
		
            if (xmlhttp.readyState == 4) {
				var cpu = xmlhttp.responseText;
				document.getElementById("text").innerHTML= cpu;
            }
        }
        xmlhttp.open("GET", "handler?q=I7", true);
        xmlhttp.send();
		return false;
	});
	
	
		
		
	
});
</script>
</head>
<body style="background:#F8F8F8">


<div class="container">
  <div class="jumbotron">
    <h1>Compare you items</h1>
    <p>Sources come from PB technology and JB-HiFi</p> 
  </div>
  <div class="row">
    <div class="col-md-4" style="background:#E8E8E8">
		<form>
			Search: <input id="key_words" type="text" name="title"/>
			<br><br>
			<input type=submit id="search" value=Submit /> 
		</form>
	</div>
    <div class="col-md-8" style="background-color:lavenderblush;">
		<span>CPU:</span>
		<div class="container">
			<span id="ToggleIntel"><button class="button"></button></span><span>Intel</span>
			<div class="container">
				<div id="invisibleCPU">
					<span ><button id="ToggleIntelCore" class="button"></button></span><span>Intel Core</span>
					<div class="container">
						<div id=i_serious>
							<button id="i7"></button>
							<span id="i5">i5</span>
							<span id="i3">i3</span>
						</div>
					</div>
					<span><button class="button"></button></span><span>Intel Celeron</span>
				</div>
			</div>
			<span><button class="button"></button></span><span>AMD</span>
		</div>	
		
		<span>RAM:</span>
		<div class="container">
			<span ><button id="ToggleRAM" class="button"></button></span><span>RAM</span>
			<div class="container">
				<div id="invisibleRAM">
						<div>
							<span id="2GB">2GB</span>
							<span id="4GB">4GB</span>
							<span id="6GB">6GB</span>
							<span id="8GB">8GB</span>
							<span id="16GB">16GB</span>
						</div>
				</div>
			</div>
		</div>	
		
		
		<span>Storage:</span>
		<div class="container">
			<span ><button id="ToggleHD" class="button"></button></span><span>Hard Drive</span>
			<div class="container">
				<div id="invisibleHD">
					<div>
						<span id="320GB">320GB</span>
						<span id="500GB">500GB</span>
						<span id="750GB">750GB</span>
						<span id="1TB">1TB</span>
					</div>
				</div>
			</div>
			<span ><button id="ToggleEmmc" class="button"></button></span><span>Emmc</span>
			<div class="container">
				<div id="invisibleEmmc">
					<div>
						<span id="32GB">32GB</span>
					</div>
				</div>
			</div>
			<span><button id="ToggleSSD" class="button"></button></span><span>SSD</span>
			<div class="container">
				<div id="invisibleSSD">
					<div>
						<span id="16GB">16GB</span>
						<span id="80GB">80GB</span>
					</div>
				</div>
			</div>
		</div>	
		
		
		
	</div>
    <div class="container">
		<p id="text" style="background-color:#b0c4de;"></p>
	</div>
  </div>
</div>


</body>
</html>



