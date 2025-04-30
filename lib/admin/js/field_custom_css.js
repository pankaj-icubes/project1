jQuery(document).ready(function($)
{
var updateCss = function(){
    $("#cssdata").val(editor.getSession().getValue());}
    $("BoatRental-options-form").submit(updateCss);
});

var editor = ace.edit("customcss");
// editor.setTheme("ace/theme/monokai");
editor.session.setMode("ace/mode/css");