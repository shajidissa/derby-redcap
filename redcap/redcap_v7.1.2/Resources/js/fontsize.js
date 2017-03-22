$(function()
{
	// Set original font increment and tags to change
	var fontSizeCookie = getCookie('fontsize');
	var fontIncreaseIncrement = (fontSizeCookie != null && fontSizeCookie != "" && fontSizeCookie != 0) ? fontSizeCookie : 0;
	var fontIncreaseTags = 'a, p, h3, span, select, input, textarea, .note, .labelrc, .data, .labelmatrix, .data_matrix,.headermatrix td, #surveytitle, .header, .sliderlabels td, '
						 + '.sldrmsg, #surveyinstructions p, .popup-contents td, #return_instructions, .exittext, button.rc-autocomplete, .choicevert, choicehoriz';
	// Increase Font Size
	$('.increaseFont').click(function(){
		changeFont(fontIncreaseTags, 1.2);
		// Increase global value of font
		fontIncreaseIncrement++;
		// Set cookie
		setCookie('fontsize',fontIncreaseIncrement,1);
	});
	// Decrease Font Size
	$('.decreaseFont').click(function(){
		changeFont(fontIncreaseTags, 1/1.2);
		// Decrease global value of font
		fontIncreaseIncrement--;
		// Set cookie
		setCookie('fontsize',fontIncreaseIncrement,1);
	});
	// If cookie is already set for font size change, then resize again at page load
	if (fontIncreaseIncrement != 0) {
		if (fontIncreaseIncrement > 0) {
			for (i=1; i <= fontIncreaseIncrement; i++) {
				changeFont(fontIncreaseTags, 1.2);
			}
		} else {
			for (i=1; i <= Math.abs(fontIncreaseIncrement); i++) {
				changeFont(fontIncreaseTags, 1/1.2);
			}
		}
	}
});