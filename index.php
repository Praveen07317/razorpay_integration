<!DOCTYPE html>
<html lang="en">
<head>
  <title>Razorpay Payment Gateway Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body>

<div class="container-fluid p-5 bg-primary text-white text-center">
  <h1>Razorpay Payment Gateway Example</h1>
  
</div>
  
<div class="container mt-5">
  <div class="row">
     <div class="col-sm-4"></div>
    <div class="col-sm-4">
      <form>
    <input type="textbox" name="name" id="name" class="form-control" placeholder="Enter your name"/><br/><br/>
    <input type="textbox" name="amt" id="amt"  class="form-control" placeholder="Enter amt"/><br/><br/>
    <input type="button" name="btn" id="btn" class="btn btn-primary" value="Pay Now" onclick="pay_now()"/>
     </form>
    </div>
    <div class="col-sm-4"></div>
    
  </div>
</div>


<!-- //script tag start -->

<script>
    function pay_now(){
        var name=jQuery('#name').val();
        var amt=jQuery('#amt').val();
        
         jQuery.ajax({
               type:'post',
               url:'payment_process.php',
               data:"amt="+amt+"&name="+name,
               success:function(result){
                   var options = {
                        "key": "Enter Your Razorpay Key", 
                        "amount": amt*100, 
                        "currency": "INR",
                        "name": "Acme Corp",
                        "description": "Test Transaction",
                        "image": "https://image.freepik.com/free-vector/logo-sample-text_355-558.jpg",
                        "handler": function (response){
                           jQuery.ajax({
                               type:'post',
                               url:'payment_process.php',
                               data:"payment_id="+response.razorpay_payment_id,
                               success:function(result){
                                   window.location.href="thank_you.php";
                               }
                           });
                        }
                    };
                    var rzp1 = new Razorpay(options);
                    rzp1.open();
               }
           });
        
        
    }
</script>






</body>
</html>















