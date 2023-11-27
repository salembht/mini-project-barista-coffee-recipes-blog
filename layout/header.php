

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Barista - Coffee Recipes</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">

    <link rel="stylesheet" href="assets/css/aos.css">

    <link rel="stylesheet" href="assets/css/ionicons.min.css">

    <link rel="stylesheet" href="assets/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="assets/css/jquery.timepicker.css">

    
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/icomoon.css">
    <link rel="stylesheet" href="assets/css/style.css">

	<link rel="apple-touch-icon" sizes="180x180" href="assets/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="assets/images//favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="assets/images//favicon-16x16.png">
	<link rel="manifest" href="assets/images//site.webmanifest">


  </head>
  <body>
  	<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="<?php echo ROOT_PATH; ?>">Barista<small> Recipes</small></a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>
	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item active"><a href="<?php echo ROOT_PATH; ?>" class="nav-link">Home</a></li>
			  <li class="nav-item "><a href="add_recipe" class="nav-link">Add Recipe</a></li>
	          <li class="nav-item"><a href="recipes" class="nav-link">Recipes</a></li>
			  <li class="nav-item"><a href="bookmarks" class="nav-link">Bookmarks</a></li>


	          <li class="nav-item"><a href="contact" class="nav-link">Contact</a></li>

			  <?php if(!isUserSignedIn()){ ?>
				<li class="nav-item cart"><a href="signin" class="nav-link"><span class="icon icon-sign-in"></span></a></li>
                            <?php }else{ ?>
								<li class="nav-item cart"><a href="signout" class="nav-link"><span class="icon icon-sign-out"></span></a></li>
                            <?php } ?>
	        </ul>
	      </div>
		  </div>
	  </nav>