<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Paystack</title>


  <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'>

      <link rel="stylesheet" href="css/style.css">


</head>

<body>

  <div class="wrapper">

  <span class="progress-up"></span>

  <div class="wrap-holder">
    <h3><span></span> </h3>
    <p>        <strong>  </strong>       </p>
    <form class="form-inline" action="cal.php" method="POST" onsubmit="openModal()" id="myForm">
      <div class="form-group">
        <div class="input-group">
          <div class="input-group-addon">₦</div>
          <input type="text" class="form-control" id="amount" name="amt" placeholder="Amount">
        </div>
      </div>
      <button class = "btn btn-primary" data-toggle = "modal" data-target = "#myModal" id="<?php echo $data->custumerdetails?>" onclick="showDetails(event);">
       Submit
       </button>
    </form>

    <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button"  class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Transaction Summary</h4>
      </div>
      <div class="modal-body">
            <p>Charges: <span id="charges"></span><p>
            <p>Amount: <span id="amount_val"></span><p>
            <p>Reference: <span id="refrence"></span><p>
            <p>Total: <span id="total"></span><p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="pay" class = "btn btn-primary">Pay</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
<!--   <script src='https://js.paystack.co/v2/popup.js'></script>
 -->    <script  src="js/pay.js"></script>

  <script src="https://js.paystack.co/v1/inline.js"></script>

    <script  src="js/index.js"></script>
    
    <script>



  function payWithPaystack(){
    var handler = PaystackPop.setup({
      key: 'pk_test_cdba68f46af8f67fd0d6ae6403e78869fe0d18bf',
      email: 'customer@email.com',
      amount: window.total,
      ref:  window.ref,
      //''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
      metadata: {
         custom_fields: [
            {
                display_name: "Mobile Number",
                variable_name: "mobile_number",
                value: "+2348012345678"
            }
         ]
      },
      callback: function(response){
          alert('success. transaction ref is ' + response.reference);

          var url = '/cal.php';
          //send an jax request to your server , when the request hits your server , then you make a call to your database to save it . 
          var options = {
            data: {ref: ref},
            success: function(){

            },
            error: function(){

            }
          }
          $.ajax(url, options);
      },
      onClose: function(){
          alert('window closed');
      }
    });
    handler.openIframe();
  }


      document.getElementById('pay').onclick = function(){
        payWithPaystack();
      }

</script>


  </div>
</div>

<script>
  function showDetails(e){
    e.preventDefault();
    var customerDetails = document.getElementById('amount').value;

    console.log(customerDetails )
    $.ajax ({
      url: "cal.php",
      method: "POST",
      data: {"amt": customerDetails},
      success: function(response) {

        console.log(response);

       var data = JSON.parse(response);

       $("#charges").text(data.charges);
       $("#amount_val").text(data.amount);
       $("#total").text(data.total);
       $("#refrence").text(data.ref);


             window.total = data.total * 100;
             window.ref=data.ref
      }


     });

    }


</script>

</body>

</html>
