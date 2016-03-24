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

});

