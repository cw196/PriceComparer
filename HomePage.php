<!DOCTYPE html>
<html lang="en">
<head>
  <title>PriceCompare(JB HI-FI)</title>
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
  <script>
	$(document).ready(function(){
		var xmlhttp = new XMLHttpRequest();
		var i7 = "";
		var i5 = "";
		var i3 = "";
		var Intel_Celeron = "";
		var AMD = "";
		var GB2 = "";
		var GB4 = "";
		var GB6 = "";
		var GB8 = "";
		var GB16 = "";
		var S320GB = "";
		var S500GB = "";
		var S750GB = "";
		var S1TB = "";
		var S32GB = "";
		var S16GB = "";
		var S80GB = "";
		var keywords = "";
		var sql = "select * from my_database where";
		
		//CPU Toggle
		$("#CPU").click(function(){
			$( this ).toggleClass("btn btn-primary btn-xs");
			$("#CPU_Toggle").toggle();
		});
		$("#Intel").click(function(){
			$( this ).toggleClass("btn btn-primary btn-xs");
			$("#Intel_Toggle").toggle();
		});
		$("#Intel_Core").click(function(){
			$( this ).toggleClass("btn btn-primary btn-xs");
			$("#Intel_Core_Toggle").toggle();
		});
		
		//RAM Toggle
		$("#RAM").click(function(){
			$( this ).toggleClass("btn btn-primary btn-xs");
			$("#RAM_Toggle").toggle();
		});
		
		//Storage Toggle
		$("#Storage").click(function(){
			$( this ).toggleClass("btn btn-primary btn-xs");
			$("#Storage_Toggle").toggle();
		});
		$("#Hard_Drive").click(function(){
			$( this ).toggleClass("btn btn-primary btn-xs");
			$("#Hard_Drive_Toggle").toggle();
		});
		$("#Emmc").click(function(){
			$( this ).toggleClass("btn btn-primary btn-xs");
			$("#Emmc_Toggle").toggle();
		});
		$("#SSD").click(function(){
			$( this ).toggleClass("btn btn-primary btn-xs");
			$("#SSD_Toggle").toggle();
		});
		
		
		
		
		
		//select cpu
		var i7_click = 0;
		$("#i7").click(function() {		
			$( this ).toggleClass("btn btn-primary btn-xs");
			i7_click++;
			if(i7_click%2!=0){
				i7="i7";
			}else{
				i7="";
			}
			connect();
			return false;
		});
		var i5_click = 0;
		$("#i5").click(function() {		
			$( this ).toggleClass("btn btn-primary btn-xs");
			i5_click++;
			if(i5_click%2!=0){
				i5="i5";
			}else{
				i5="";
			}
			connect();
			return false;
		});
		var i3_click = 0;
		$("#i3").click(function() {		
			$( this ).toggleClass("btn btn-primary btn-xs");
			i3_click++;
			if(i3_click%2!=0){
				i3="i3";
			}else{
				i3="";
			}
			connect();
		});
		var Intel_Celeron_click = 0;
		$("#Intel_Celeron").click(function() {		
			$( this ).toggleClass("btn btn-primary btn-xs");
			Intel_Celeron_click++;
			if(Intel_Celeron_click%2!=0){
				Intel_Celeron="Intel_Celeron";
			}else{
				Intel_Celeron="";
			}
			connect();
		});
		var AMD_click = 0;
		$("#AMD").click(function() {		
			$( this ).toggleClass("btn btn-primary btn-xs");
			AMD_click++;
			if(AMD_click%2!=0){
				AMD="AMD";
			}else{
				AMD="";
			}
			connect();
		});
		
		
		
		//select ram
		var GB2_click = 0;
		$("#2GB").click(function() {		
			$( this ).toggleClass("btn btn-primary btn-xs");
			GB2_click++;
			if(GB2_click%2!=0){
				GB2="2GB";
			}else{
				GB2="";
			}
			connect();
		});
		var GB4_click = 0;
		$("#4GB").click(function() {		
			$( this ).toggleClass("btn btn-primary btn-xs");
			GB4_click++;
			if(GB4_click%2!=0){
				GB4="4GB";
			}else{
				GB4="";
			}
			connect();
		});
		var GB6_click = 0;
		$("#6GB").click(function() {		
			$( this ).toggleClass("btn btn-primary btn-xs");
			GB6_click++;
			if(GB6_click%2!=0){
				GB6="6GB";
			}else{
				GB6="";
			}
			connect();
		});
		var GB8_click = 0;
		$("#8GB").click(function() {		
			$( this ).toggleClass("btn btn-primary btn-xs");
			GB8_click++;
			if(GB8_click%2!=0){
				GB8="8GB";
			}else{
				GB8="";
			}
			connect();
		});
		var GB16_click = 0;
		$("#16GB").click(function() {		
			$( this ).toggleClass("btn btn-primary btn-xs");
			GB16_click++;
			if(GB16_click%2!=0){
				GB16="16GB";
			}else{
				GB16="";
			}
			connect();
		});
		
		var S320GB_click = 0;
		$("#S320GB").click(function() {		
			$( this ).toggleClass("btn btn-primary btn-xs");
			S320GB_click++;
			if(S320GB_click%2!=0){
				S320GB="320GB";
			}else{
				S500GB="";
			}
			connect();
		});
		
		var S500GB_click = 0;
		$("#S500GB").click(function() {		
			$( this ).toggleClass("btn btn-primary btn-xs");
			S500GB_click++;
			if(S500GB_click%2!=0){
				S500GB="500GB";
			}else{
				S500GB="";
			}
			connect();
		});
		
		var S750GB_click = 0;
		$("#S750GB").click(function() {		
			$( this ).toggleClass("btn btn-primary btn-xs");
			S750GB_click++;
			if(S750GB_click%2!=0){
				S750GB="750GB";
			}else{
				S750GB="";
			}
			connect();
		});
		
		var S1TB_click = 0;
		$("#S1TB").click(function() {		
			$( this ).toggleClass("btn btn-primary btn-xs");
			S1TB_click++;
			if(S1TB_click%2!=0){
				S1TB="1TB";
			}else{
				S1TB="";
			}
			connect();
		});
		
		var S32GB_click = 0;
		$("#S32GB").click(function() {		
			$( this ).toggleClass("btn btn-primary btn-xs");
			S32GB_click++;
			if(S32GB_click%2!=0){
				S32GB="32GB";
			}else{
				S32GB="";
			}
			connect();
		});
		
		var S16GB_click = 0;
		$("#S16GB").click(function() {		
			$( this ).toggleClass("btn btn-primary btn-xs");
			S16GB_click++;
			if(S16GB_click%2!=0){
				S16GB="16GB";
			}else{
				S16GB="";
			}
			connect();
		});
		
		var S80GB_click = 0;
		$("#S80GB").click(function() {		
			$( this ).toggleClass("btn btn-primary btn-xs");
			S80GB_click++;
			if(S80GB_click%2!=0){
				S80GB="80GB";
			}else{
				S80GB="";
			}
			connect();
		});
		
		
		//get results from database
		$("#search").click(function() {		
			
			keywords=$("#keywords").val();
			xmlhttp.onreadystatechange = function() {
			
			if (xmlhttp.readyState == 4) {
				var result = xmlhttp.responseText;
				document.getElementById("content").innerHTML= result;
				}
			}
			xmlhttp.open("GET", "handler?i7="+i7+"&i5="+i5+"&i3="+i3
						+"&GB2="+GB2+"&GB4="+GB4+"&GB6="+GB6+"&GB8="+GB8+"&GB16="+GB16
						+"&S320GB="+S320GB+"&S500GB="+S500GB+"&750GB="+S750GB+"&S1TB="+S1TB+"&S32GB="+S32GB+"&S16GB="+S16GB+"&S80GB="+S80GB+"&keywords="+keywords, true);
			xmlhttp.send();
			return false;
			
		});
		
		
		function connect(){
			keywords=$("#keywords").val();
			xmlhttp.onreadystatechange = function() {
			
			if (xmlhttp.readyState == 4) {
				var result = xmlhttp.responseText;
				document.getElementById("content").innerHTML= result;
				}
			}
			xmlhttp.open("GET", "handler?i7="+i7+"&i5="+i5+"&i3="+i3+"&Intel_Celeron="+Intel_Celeron+"&AMD="+AMD
									+"&GB2="+GB2+"&GB4="+GB4+"&GB6="+GB6+"&GB8="+GB8+"&GB16="+GB16
									+"&S320GB="+S320GB+"&S500GB="+S500GB+"&S750GB="+S750GB+"&S1TB="+S1TB+"&S32GB="+S32GB+"&S16GB="+S16GB+"&S80GB="+S80GB+"&keywords="+keywords, true);
			xmlhttp.send();
			return false;
			
		}
	}
	);
  </script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">PriceCompare</a>
    </div>
    <div>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>
  
<div class="container">
  <div class="jumbotron">
    <h1>PriceCompare</h1> 
    <p>Help you compare laptop price from JB HI-FI to PB technology</p> 
  </div>
  <div class="row">
    <div class="col-sm-3">
		<ul class="list-group">
			<li class="list-group-item list-group-item-info">Search your item here:</li>
			<li class="list-group-item">
				<div class="form-group">
					<label for="key words">Key words:</label>
					<input id="keywords" type="text" class="form-control" id="key words" placeholder="Enter your keywords">
				</div>
			</li>
			<li class="list-group-item list-group-item-info">Refine by</li>
			<li class="list-group-item">
				<!--CPU Toggle-->
				<div style="margin:5px">
					<button id="CPU" type="button" class="btn btn-default btn-xs">CPU</button>
					<div id="CPU_Toggle" class="container" style="margin:5px;display:none">
						<span><button id="Intel" type="button" class="btn btn-default btn-xs">Intel</button></span>
						<div id="Intel_Toggle" class="container" style="margin:5px;display:none">
							
							<span><button id="Intel_Core" type="button" class="btn btn-default btn-xs">Intel Core</button></span>
							<div id="Intel_Core_Toggle" class="container" style="margin:5px;display:none">
									<button id="i7" type="button" class="btn btn-default btn-xs">I7</button>
									<button id="i5" type="button" class="btn btn-default btn-xs">I5</button>
									<button id="i3" type="button" class="btn btn-default btn-xs">I3</button>
							</div>
							<span><button id="Intel_Celeron" type="button" class="btn btn-default btn-xs">Intel Celeron</button></span>
							
						</div>
						<span><button id="AMD" type="button" class="btn btn-default btn-xs">AMD</button></span>
					</div>	
				</div>
				<!--RAM Toggle-->
				<div style="margin:5px">
					<button id="RAM" type="button" class="btn btn-default btn-xs">RAM</button>
					<div id="RAM_Toggle" class="container" style="margin:5px;display:none">
						<span><button id="2GB" type="button" class="btn btn-default btn-xs">2GB</button></span>
						<span><button id="4GB" type="button" class="btn btn-default btn-xs">4GB</button></span>
						<span><button id="6GB" type="button" class="btn btn-default btn-xs">6GB</button></span>
						<span><button id="8GB" type="button" class="btn btn-default btn-xs">8GB</button></span>
						<span><button id="16GB" type="button" class="btn btn-default btn-xs">16GB</button></span>
					</div>
				</div>
				<!--Storage-->
				<div style="margin:5px">
					<button id="Storage" type="button" class="btn btn-default btn-xs">Storage</button>
					<div id="Storage_Toggle" class="container" style="margin:5px;display:none">
						<span><button id="Hard_Drive" type="button" class="btn btn-default btn-xs">Hard Drive</button></span>
						<div id="Hard_Drive_Toggle" class="container" style="margin:5px;display:none">
								<button id="S320GB" type="button" class="btn btn-default btn-xs">320GB</button>
								<button id="S500GB" type="button" class="btn btn-default btn-xs">500GB</button>
								<button id="S750GB" type="button" class="btn btn-default btn-xs">750GB</button>
								<button id="S1TB" type="button" class="btn btn-default btn-xs">1TB</button>
						</div>
						<span ><button id="Emmc" type="button" class="btn btn-default btn-xs">Emmc</button></span>
						<div id="Emmc_Toggle" class="container" style="margin:5px;display:none">
								<button id="S32GB" type="button" class="btn btn-default btn-xs">32GB</button>
						</div>
						<span><button id="SSD" type="button" class="btn btn-default btn-xs">SSD</button></span>
						<div id="SSD_Toggle" class="container" style="margin:5px;display:none">
							
								<button id="S16GB" type="button" class="btn btn-default btn-xs">16GB</button>
								<button id="S80GB" type="button" class="btn btn-default btn-xs">80GB</button>
						
						</div>
					</div>	
				</div>
			</li>
			
			<a id="search" href="#" class="list-group-item active">
			<div  style="margin-left:39%">
				<span >Search</span>
			</div></a>
		</ul>
    </div>
    <div class="col-sm-9">
		<div class="well well-lg">
      <p id="content">The result will be displayed after you put information in the refine section.</p>
		</div>
    </div>
  </div>
</div>

</body>
</html>
