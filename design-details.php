<?php 

include("functions/functions.php");


if(isset($_POST['liked'])) {

        $postid = $_POST['postid'];
        $customer_ip = $_SERVER['REMOTE_ADDR'];
                        
        $select = "SELECT * FROM products WHERE product_id=$postid";
        $result = mysqli_query($con, $select);

        $result_row = mysqli_fetch_array($result);
        $n = $result_row['likes'];

        $result_update = "UPDATE products SET likes=$n+1 WHERE product_id=$postid";
        $result_con = mysqli_query($con, $result_update);

        $result_insert = "INSERT INTO likes (customerid,postid) VALUES('$customer_ip', '$postid')";
        $res_con = mysqli_query($con, $result_insert);
        exit();
}

if(isset($_POST['unliked'])) {

  $postid = $_POST['postid'];
  $customer_ip = $_SERVER['REMOTE_ADDR'];
   
  $select = "SELECT * FROM products WHERE product_id=$postid";
  $result = mysqli_query($con, $select);

  $result_row = mysqli_fetch_array($result);
  $n = $result_row['likes'];

  $result_insert = "DELETE FROM likes WHERE postid=$postid AND customerid=$customer_ip";
  $res_con = mysqli_query($con, $result_insert);
  exit();
  

  $result_update = "UPDATE products SET likes=$n-1 WHERE product_id=$postid";
  $result_con = mysqli_query($con, $result_update);
  exit();
  
}


?>
<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Code Inventor">
  	<meta name="keywords" content="Graphics & Web designer, HTML, CSS, JavaScript, Bootstrap">
  	<meta name="author" content="Code Inventor">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>CODE INVENTOR | Details</title>

	<link rel="stylesheet" type="text/css" href="vendor/bootstrap-3.3.7-dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="vendor/font-awesome-4.7.0/css/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="css/layout.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>

<script type="text/javascript">
  $(document).ready(function(){

    $('.like').click(function(){
        var postid = $(this).attr('id');
          
   $.ajax({

          url: 'design-details.php?id=<?php echo $pro_id; ?>',
          type: 'POST',
          async: false,
          data:{

            'liked': 1,
            'postid': postid,
            
          },
          success:function(){

          }
       });
    });


    $('.unlike').click(function(){

      var postid = $(this).attr('id');
    
    $.ajax({

          url: 'design-details.php',
          type: 'POST',
          async: false,
          data:{

            'unliked': 1,
            'postid': postid,
          },
          success:function(){

          }
       });
    });
  });
</script>



<body>
<div class="container-fluid display-table">
   <div class="row display-table-row">

<!--CONTENT-->

        <div id="home-content">
        	<div class="row">
        		<div class="col-md-12">
        			<div class="design-display">
        				<header class="clearfix">
        					<h5 class="pull-left"><strong>Design Details</strong></h5>
        					<a href="#" class="btn btn-primary btn-xs pull-right" role="button">Post your Design</a>
        				</header>
        			</div><!--design display-->	        	
        		</div><!--col-md-8-->
        	</div><!--row-->

        	<div class="display-content">
        					<div class="row">
        						<div class="col-md-6">
        				            <div class="design-image">

                              <?php
    
                                  if(isset($_GET['pro_id'])){ 
                                  
                                  $product_id = $_GET['pro_id'];
                                    
                                  $get_pro = "SELECT * FROM products where product_id='$product_id'";
                                  
                                  $run_pro = mysqli_query($con, $get_pro);
                                  
                                  while($row_pro = mysqli_fetch_array($run_pro)){
                                    
                                    $pro_id = $row_pro['product_id'];
                                    $pro_title = $row_pro['product_title'];
                                    $pro_author = $row_pro['product_author'];
                                    $pro_price = $row_pro['product_price'];
                                    $pro_image = $row_pro['product_main_image'];
                                    $pro_image1 = $row_pro['product_image_1'];
                                    $pro_image2 = $row_pro['product_image_2'];
                                    $pro_image3 = $row_pro['product_image_3'];
                                    $pro_desc = $row_pro['product_desc'];
                                    $pro_date = $row_pro['product_date'];
                                     }
                                   }
                                    ?>

                                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                          <!-- Indicators -->
                                          <ol class="carousel-indicators">
                                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                            <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                                            <li data-target="#carousel-example-generic" data-slide-to="3"></li>
                                          </ol>
  
                                          <!-- Wrapper for slides -->
                                              <div class="carousel-inner" role="listbox">
                                                <div class="item active">
                                                  <img src="design_images/<?php echo $pro_image; ?>" alt="main-image">
                                                </div>
                                                <div class="item">
                                                  <img src="design_images/<?php echo $pro_image1; ?>" alt="image-1">
                                                </div>

                                                <div class="item">
                                                  <img src="design_images/<?php echo $pro_image2; ?>" alt="image-2">
                                                </div>

                                                 <div class="item">
                                                  <img src="design_images/<?php echo $pro_image3; ?>" alt="image-3">
                                                </div>
                                               </div>

                                          <!-- Controls -->
                                          <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                          </a>
                                          <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                          </a>
                                        </div>  

                                        <div class="like text-center">


                                          <?php

                                          
                                            $customer_ip = $_SERVER['REMOTE_ADDR'];  

                                                                                  
                                              $like_select = "SELECT * FROM likes WHERE customerid='$customer_ip' AND postid='$pro_id'";

                                              $like_query = mysqli_query($con, $like_select);

                                              if(mysqli_num_rows($like_query) == 1) { ?>

                                                  <span><a href="" class="btn btn-primary unlike" id="<?php echo $pro_id; ?>"><i class="fa fa-thumbs-down" aria-hidden="true" style="background: none;"></i> Unlike</a></span>
                                            <?php } else { ?>
                                                  <span><a href="" class="btn-success like" id="<?php echo $pro_id; ?>"><i class="fa fa-thumbs-up" aria-hidden="true" style="background: none;"></i>Like</a></span>
                                            <?php } ?>
                                       </div><!--like--> 

                                    </div><!--design-image-->
        						              </div><!--col-md-6-->

                                <div class="col-md-6">
                                    <div class="details">
                                        <h1><?php echo $pro_title; ?></h1>
                                        <div class="small">
                                            <b><i>Created by <a href="#" title="View Profile"<?php echo $pro_author; ?></a></b> 
                                            <span class="pull-right date"><b> Dated: <?php echo $pro_date; ?></b></span>
                                        </div><!--small-->

                                        <div class="description">
                                          <p><?php echo $pro_desc; ?></p>

                                          <p class="price"><b>Price: <?php echo $pro_price; ?></b></p>
                                          
                                          </div><!--description-->
                                                                               
                                          <a href="checkout.php" class="btn btn-primary">Buy Now</a>
                                          <a href="home.php?add_cart=<?php echo $pro_id; ?>" class="btn btn-primary">Add to Cart</a>
                                           </div><!--details-->
                                           
                                </div><!--md-6-->
                                  
                                  </div><!--col-md-10-->
                    					  </div><!--row-->
                    				  </div><!--display-content-->
                            </div><!--home content-->
                            
       
		</div><!--col-md-10-->
	</div><!--row display-->
</div><!--container fluid-->


<script src="vendor/tether-1.3.3/dist/js/tether.min.js"></script>
<script src="vendor/bootstrap-3.3.7-dist/js/bootstrap.js"></script>
<script type="text/javascript" src="js/default.js"></script>
</body>
</html>
