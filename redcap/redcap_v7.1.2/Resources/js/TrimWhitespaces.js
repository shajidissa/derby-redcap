// On pageload
$(function(){

  'use strict';

  function closeTrimBox(){
    $('.trim-alert-box').remove();
    $('.formtbody input').removeClass('alert');
  }

  function trimWhiteSpaces(input, str){
    var newValue = str.trim();
    $(input).val(newValue);
    closeTrimBox();
  }

  function checkUnwantedSpaces(e){
    var input = e.target;
    var str = $(input).val();
    //if input is empty do nothing
    if(str != ''){
      var array = str.split(''),
          first = array.shift(),
          last = array.pop();
      var pos = $(e.target).offset();
      last = (last == undefined ? '' : last);
      if( first === ' ' || last === ' ' || first.match(/\n/g) || last.match(/\n/g) ){
        $(input).addClass('alert').addClass('asked');
        //build jquery object
        var $trimBox =  $('<div>',{
          'class': 'trim-alert-box',
          text: 'This field\'s value contains extra spaces at the beginning or end. Would you like to remove them?',
          style: 'top: '+(pos.top+25)+'px; left: '+pos.left+'px'
        }),
        $close = $('<span>',{
          'class': 'trim-close-btn',
          text: 'x'
        }).bind('click', closeTrimBox),
        $confirmBtn = $('<button>',{
          'class': 'trim-confirm-btn',
          text: 'Yes'
        }).bind('click', function(){
            trimWhiteSpaces(input, str);
        }),
        $cancelBtn = $('<button>',{
          'class': 'trim-cancel-btn',
          text: 'Cancel'
        }).bind('click', closeTrimBox);
        //append elements
        $trimBox.append($close).append($confirmBtn).append($cancelBtn);
        $('body').append($trimBox);
      }
    }
  }

  //call the checkUnwantedSpaces function on blur if input and does not have class asked
  $('input[type=text]:not(.asked)').on('blur', function(e){
    if (!$(e.target).hasClass('asked')){
      checkUnwantedSpaces(e);
    }
  });

});
