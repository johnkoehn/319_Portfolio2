$( document ).ready(function() {
	
drawing = false;
ctx = $('#drawCanvas')[0].getContext('2d');
ctx.lineWidth = 5;
	
$('#drawCanvas').mousedown(function(e)
{
	console.log('here');
	drawing = true;
	curX = e.pageX - this.offsetLeft;
	curY = e.pageY - this.offsetTop;
	ctx.beginPath();
	ctx.moveTo(curX, curY);
	
});

$('#drawCanvas').mouseup(function(e)
{
	drawing = false;
});

$('#drawCanvas').mousemove(function(e)
{
	if(drawing)
	{
		curX = e.pageX - this.offsetLeft;
		curY = e.pageY - this.offsetTop;
		ctx.lineTo(curX, curY);
		ctx.stroke();
	}
});

$('#drawCanvas').mouseleave(function(e)
{
	drawing = false;
});

$('#sizeSlider').mousemove(function(e)
{
	$('#slider').html($('#sizeSlider').val());
	ctx.lineWidth = $('#sizeSlider').val();
});

$('#black').click(function(e)
{
	ctx.strokeStyle = "Black";
});

$('#blue').click(function(e)
{
	ctx.strokeStyle = "MediumBlue";
});

$('#red').click(function(e)
{
	ctx.strokeStyle = "Red";
});

$('#green').click(function(e)
{
	ctx.strokeStyle = "Lime";
});

$('#rainbow').click(function(e)
{
	var canvas = $('#drawCanvas')[0];
	//gradient on canvas dimensions
	var grad= ctx.createLinearGradient(0, 0, canvas.width, canvas.height);
	grad.addColorStop(1/7, '#FF0000');
	grad.addColorStop(2/7, '#FF7F00');
	grad.addColorStop(3/7, '#FFFF00');
	grad.addColorStop(4/7, '#00FF00');
	grad.addColorStop(5/7, '#0000FF');
	grad.addColorStop(6/7, '#4B0082');
	grad.addColorStop(7/7, '#8F00FF');

	ctx.strokeStyle = grad;
});

$('#setCust').click(function(e)
{
	var red = parseInt($('#custRed').val());
	var blue = parseInt($('#custBlue').val());
	var green = parseInt($('#custGreen').val());
	var t1 = Number.isInteger(red);
	if(Number.isInteger(red) && Number.isInteger(blue) && Number.isInteger(green))
	{
		if(red > 255)
		{
			red = 255;
		}
		else if(red < 0)
		{
			red = 0;
		}
		if(blue > 255)
		{
			blue = 255;
		}
		else if(blue < 0)
		{
			blue = 0;
		}
		if(green > 255)
		{
			green = 255;
		}
		else if(green < 0)
		{
			green = 0;
		}
		
		var custom = "rgb(" + red + "," + green + "," + blue + ")";
		//couldn't get jquery.css() to work
		document.getElementById("colorTest").style = "fill:" + custom + ";";
		ctx.strokeStyle = custom;
	}
	else
	{
		console.log("Did not receive Integer value for one of custom color text fields.");
	}
});

});


