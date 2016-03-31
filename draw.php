<html>
<head>
<title> 
	Draw
</title>

<?php
session_start();
//check is session is going
if(!isset($_SESSION['user']))
{
	header("Location:login.php");
}

$new = false;
if(array_key_exists('title', $_GET))
{
	$new = true;
}

?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script>
<script type = "text/javascript" src = "./port2.js"></script>
</head>

<body>
	<form>
	Title:<input type="text" id="title" name="title" style="margin-left:55px" value="<?php if($new) { echo $_GET['title']; }?>">  </input><br /> <br />
	</form>
	<div id="pageContainer" style="min-width: 1333px;">

	<div id = "canvas" style="float:left;">
		<canvas id = "drawCanvas" width = "900" height = "600" style = "border:1px solid #d3d3d3;"></canvas>
		<p>
			Click and drag to draw! 
			<input type = "button" id = "save" value = "Save" style="float:right"/>
            <input type = "button" id = "home" value = "Home" style="float:right; margin-right:5px;"> </input>
            <input type = "button" id = "logout" value = "Logout" style="float:right; margin-right:5px;"> </input>
		</p>
		
	</div>
	
	<div id ="penSize" style=" height: 100px;">	
		<p>&#8194; Pen Size: <span id="slider">5</span></p>&#8194;
		<input type = "range" id="sizeSlider" min="1" max="20" value="5" style="width: 200px;" />
	</div>
	
	<div id="presetBlock" style="height: 100px;">
		<p>&#8194; Preset Pen Colors:</p>&#8194;
		<input type = "button" id = "black" value = "Black"/>
		<input type = "button" id = "blue" value = "Blue"/>
		<input type = "button" id = "red" value = "Red"/>
		<input type = "button" id = "green" value = "Green"/>
		<input type = "button" id = "rainbow" value = "Rainbow"/>
	</div>
	
	<div id="customColor" style="height:100px;">
		<p style="height:20px;">
			&#8194;
			Create Your Own Pen Color:
			<svg width="20" height="20">
				<rect id = "colorTest" width="20" height="20" style="fill:rgb(0,0,0);">
				Sorry, your browser does not support inline SVG.  
			</svg>
		</p>
		<p>
			&#8194;
			R(0,255)
			<input type = "text" id = "custRed" value = "0" style="width: 40px;"/>
			G(0,255)
			<input type = "text" id = "custGreen" value = "0" style="width: 40px;"/>
			B(0,255)
			<input type = "text" id = "custBlue" value = "0" style="width: 40px;"/>
			<input type = "button" id = "setCust" value = "Set Color"/>
		</p>
	</div>
	
	<div id="eraser" style="height:100px;">
	
		&#8194;
		<input type = "button" id = "eraserButton" value = "Eraser"/>
		
		<input type = "button" id = "clear" value = "Clear All" style="margin-left: 100px"/>
	
	</div>
</div>	
	<div id="info" style="color:red"> </div>
<script>

$(document).ready(function()
{
	var logout = $("#logout");
	var home = $("#home");
	var save = $("#save");
	var title = $("#title");
	var canvas = $("#drawCanvas");
	var ctx = $('#drawCanvas')[0].getContext('2d');
	var info = $("#info");
	
	logout.click (function()
	{
		$.get("logout.php");
		window.location.href = "login.php";
	});
	
	home.click (function()
	{
		window.location.href = "home.php";
	});
	
	save.click (function()
	{
		if(title.val() != "")
		{
			var dataURL = canvas.get(0).toDataURL();
			$.post("save.php", {dataURL : dataURL, title : title.val()}, function(data)
				{
					info.html(data);
				});
		}
		else
		{
			alert("Please enter a title!");
		}
		
	});
	
    var result = "<?php if(isset($_GET['title']))
    {echo $_GET['title']; 
    }?>";
	if(result != '')
	{
		$.get("loadImage.php", {title : result}, function(data)
			{
				if(data != "")
				{
					console.log("hi");
					var img1 = new Image();
					img1.src = "images/" + data + ".png?dummy=<?php echo rand(); ?>";

					img1.onload = function()
					{
						ctx.drawImage(img1, 0, 0);
					};
				}
			});
	}
	
});

</script>
</html>