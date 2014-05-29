$(function() {	
	//Expand ALL boxes
	$('.expand_all').click(function() {
		//find the parent divs that are NOT shown yet
		var box = $( this ).closest('.expander').not('.shown');
		box.find('.box_content').slideDown();
		box.addClass('shown');
	});
	
	//Expand one box at a time
	$('.expander h3').click(function() {
		var box = $( this ).closest('.box');	//find the parent div
		box.find('.box_content').slideToggle();
		box.toggleClass('shown');
	});
	
	//Hide all boxes on page load
	$('.expander').find('.box_content').hide();
});