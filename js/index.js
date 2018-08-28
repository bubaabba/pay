$('#myForm').on('submit', function(e){
  $('#myModal').modal('show');
  e.preventDefault();
});
$("#icon_events_header").click(function(){
    $("#content-php").load("./calc.php");    
});