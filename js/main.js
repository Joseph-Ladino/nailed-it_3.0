$(document).ready(main);
function main() {
  var navWidth = $('#nav-bar').width();
  $('#nav-bar').hide();
  $('.nav-btn').click(navToggle);
  function navToggle() {
    if($('.nav-btn').attr('id') == "nav-open") {
      $('.nav-btn').attr('id', 'nav-closed').css('left', '-=' + navWidth).css('left', '-=0.5rem');
      $('#nav-bar').css({'display': 'none', 'width': '-=' + navWidth});
    } else {
      $('.nav-btn').attr('id', 'nav-open').css('left', '+=' + navWidth).css('left', '+=0.5rem');
      $('#nav-bar').css({'display': 'inline', 'width': '+=' + navWidth});
    }
  }
  $('#nav-bar ul li').click(function(){
    var id = $(this).attr('id');
    var open = '';
    if(id == 'nav-home') {
      open = links[0];
    } else if(id == 'nav-manage') {
      open = links[1];
    } else if(id == 'nav-changes') {
      open = links[2];
    }
    window.open(open, '_self');
  });
}
