<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link
      rel="icon"
      type="image/png"
      sizes="32x32"
      href="../images/favicon.svg"
      />

      
   
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- <link rel="stylesheet" href="form.css" > -->
        <link rel="stylesheet" href="../../dist/style.css" />
        
    <!-- <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css"> -->
    

    <title>Tree Nursery Accreditation</title>
    <script src="https://kit.fontawesome.com/c4254e24a8.js" crossorigin="anonymous"></script>
    <style>
        .container {
            color: rgba(100, 83, 83, 100%);
            margin-top: 100px;
        }

        .header {
        height: 300px;
      }
    </style>

</head>



  <body>
  <header class="header">
  <div class="header__overlay">
    <div class="header__links">
            <a href="../../">Home</a>
            <a href="./about_us.php">About Us</a>
            <a href="./nurseries.php">Certified Nurseries</a>
            <a href="./contact_us.php">Contact Us</a>
            <a href=""></a>
    </div>
    </div>
      <div class="header__mask flex-col-jcaic">
        <nav class="header__nav flex-sb-aic">
        <a href="./" class="logo"><h2 class="header__logo flex-jc-aic"><span class="header__logo__img"></span> OTNA</h2></a>
          <div class="header__menu hide-for-desktop">
            <span></span>
            <span></span>
            <span></span>
          </div>
          <div class="header__links hide-for-mobile">
            <a href="../../">Home</a>
            <a href="./about_us.php">About Us</a>
            <a href="./nurseries.php">Certified Nurseries</a>
            <a href="./contact_us.php" class="active">Contact Us</a>
          </div>
          <a href="#nurseries" class="buyer header__cta button hide-for-mobile">View Certified Nurseries</a>
        </nav>

        <p class="header__title">Contact Us</p>
        <p class="header__slogan">
          Fostering Seedling Quality for a Green Future!
        </p>
      </div>
    </header>
    <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <form role="form" method="post" id="reused_form" >
                        <div class="form-group">
                            <label for="name"> Name:</label>
                            <input type="text" class="form-control" id="name" name="name" required maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="email"> Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required maxlength="50">
                        </div>
                        <div class="form-group">
                            <label for="name"> Message:</label>
                            <textarea class="form-control" type="textarea" name="message" id="message" placeholder="Your Message Here" maxlength="6000" rows="7"></textarea>
                        </div>
                        <div class="row" style="margin-bottom:30px;">
                         
                         
                        </div>
                        <button type="submit" class="btn btn-lg btn-success " id="btnContactUs">Post &rarr;</button>
                    </form>
                    <div id="success_message" style="width:100%; height:100%; display:none; "> <h3>Sent your message successfully!</h3> </div>
                    <div id="error_message" style="width:100%; height:100%; display:none; "> <h3>Error</h3> Sorry there was an error sending your form. </div>
                </div>
            </div>
        </div><br>




    <footer class="footer flex-jc-aic">
      <span>&copy; Copyright 2022, Ericke inc.</span>
    </footer>
    <script src="../js/script.js"></script>
    <script>
      drawMobNav();
    </script>
    <script src="form.js">
$(function()
{
    function after_form_submitted(data) 
    {
        if(data.result == 'success')
        {
            $('form#reused_form').hide();
            $('#success_message').show();
            $('#error_message').hide();
        }
        else
        {
            $('#error_message').append('<ul></ul>');

            jQuery.each(data.errors,function(key,val)
            {
                $('#error_message ul').append('<li>'+key+':'+val+'</li>');
            });
            $('#success_message').hide();
            $('#error_message').show();

            //reverse the response on the button
            $('button[type="button"]', $form).each(function()
            {
                $btn = $(this);
                label = $btn.prop('orig_label');
                if(label)
                {
                    $btn.prop('type','submit' ); 
                    $btn.text(label);
                    $btn.prop('orig_label','');
                }
            });
            
        }//else
    }

	$('#reused_form').submit(function(e)
      {
        e.preventDefault();

        $form = $(this);
        //show some response on the button
        $('button[type="submit"]', $form).each(function()
        {
            $btn = $(this);
            $btn.prop('type','button' ); 
            $btn.prop('orig_label',$btn.text());
            $btn.text('Sending ...');
        });
        

                    $.ajax({
                type: "POST",
                url: 'handler.php',
                data: $form.serialize(),
                success: after_form_submitted,
                dataType: 'json' 
            });        
        
      });	
});



$(function()
{
	$('#captcha_reload').on('click',function(e)
	{
	  e.preventDefault();
	  d = new Date();
	  var src = $("img#captcha_image").attr("src");
	  src = src.split(/[?#]/)[0];
	  
	  $("img#captcha_image").attr("src", src+'?'+d.getTime());
	});
});
</script>
  </body>
</html>