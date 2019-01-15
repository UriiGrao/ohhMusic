$(document).ready(iniciar);
function iniciar() {
   $(".editShow").click(showModifyX);
   $(".formFanC").hide();
   $(".imgClose").click(showModifyX);
   $(".editShow").click(hideEdit);
}
function showModifyX(){
   $(".formFanC").toggle();
   $(".editShow").toggle();
   
}
function hideEdit(){
   $(".editShow").hide();
   $(".modify").hide();
}