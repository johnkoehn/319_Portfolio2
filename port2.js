$( document ).ready(function() {
	
drawing = false;
ctx = $('#drawCanvas')[0].getContext('2d');
	
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

/*
var img1 = new Image();
img1.src = "images/56fb6643d72e8.png";

img1.onload = function()
{
	ctx.drawImage(img1, 0, 0);
};*/

});

