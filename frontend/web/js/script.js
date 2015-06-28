$(document).ready(function(){
  $('.clear').click(function(){
    var form = $(this).closest('form');
    form.find('input[type!="hidden"]').attr('value','');
    var select = form.find('select');
    select.children('option').removeAttr('selected');
    select.children('option').eq(0).select();
  });
});