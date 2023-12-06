<?php
require_once('core/database.php');
// Retrieve all recipes
$db_server = "localhost";
$db_user = "root";
$db_user_pass = "root";
$db_name = "coffee_recipes";
$connection = db_connect($db_server, $db_user, $db_user_pass, $db_name);

$sql = "SELECT * FROM recipes ORDER BY id DESC LIMIT 3";
$result = $connection->query($sql);

// Check if there are any rows returned
if ($result->num_rows > 0) {
    // Initialize the $recipes array
    $recipes = array();

    // Loop through each row and add it to the $recipes array
    while ($row = $result->fetch_assoc()) {
        $recipes[] = $row;
    }
}    
//   print_r($recipes); exit;
// $connection->close();

?>
<section class="home-slider owl-carousel">
      <div class="slider-item" style="background-image: url(assets/images/bg_1.jpg);">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

            <div class="col-md-8 col-sm-12 text-center ftco-animate">
            	<span class="subheading">Welcome</span>
              <h1 class="mb-4">Unlock the World of Coffee Flavors</h1>
              <p class="mb-4 mb-md-5">We believe that being a barista is more than just making a great cup of coffee; it's a passion, an art form, and a community.</p>
              <p><a href="signup" class="btn btn-primary p-3 px-xl-4 py-xl-3">Join Us</a> <a href="recipes" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">View Recipes</a></p>
            </div>

          </div>
        </div>
      </div>

      <div class="slider-item" style="background-image: url(assets/images/pexels-lood-goosen-1235717.jpg );">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

            <div class="col-md-8 col-sm-12 text-center ftco-animate">
            	<span class="subheading">Welcome</span>
              <h1 class="mb-4">Brew and Discover</h1>
              <p class="mb-4 mb-md-5">We believe that being a barista is more than just making a great cup of coffee; it's a passion, an art form, and a community.</p>
              <p><a href="signup" class="btn btn-primary p-3 px-xl-4 py-xl-3">Join Us</a> <a href="recipes" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">View Recipes</a></p>
            </div>

          </div>
        </div>
      </div>

      <div class="slider-item" style="background-image: url(assets/images/pexels-leonardo-vazquez-3742854\ \(1\).jpg);">
      	<div class="overlay"></div>
        <div class="container">
          <div class="row slider-text justify-content-center align-items-center" data-scrollax-parent="true">

            <div class="col-md-8 col-sm-12 text-center ftco-animate">
            	<span class="subheading">Welcome</span>
              <h1 class="mb-4">Sip, Savor, and Create</h1>
              <p class="mb-4 mb-md-5">We believe that being a barista is more than just making a great cup of coffee; it's a passion, an art form, and a community.</p>
              <p><a href="signup" class="btn btn-primary p-3 px-xl-4 py-xl-3">Join Us</a> <a href="recipes" class="btn btn-white btn-outline-white p-3 px-xl-4 py-xl-3">View Recipes</a></p>
            </div>

          </div>
        </div>
      </div>
    </section>

    <section class="ftco-intro" >
    	<div class="container-wrap">
    		<div class="wrap d-md-flex align-items-xl-end">
	    		<div class="info" style="width: 100% !important; margin-top: 112px;">
	    					<div class="text text-center">
	    						<h2 class="">Elevate Your Coffee Experience </h2>
	    						<p class=""> Coffee Recipes Made Extraordinary</p>
	    					</div>  		   				
	    			</div>
	    		</div>
    		</div>
    	</div>
    </section>

    <section class="ftco-about d-md-flex">
    	<div class="one-half img" style="background-image: url(assets/images/about.jpg);"></div>
    	<div class="one-half ftco-animate">
    		<div class="overlap">
	        <div class="heading-section ftco-animate ">
	        	<span class="subheading">Insight</span>
	          <h2 class="mb-4">Our Purpose</h2>
	        </div>
	        <div>
				<p>Barista Blog is for coffee recipes, where coffee experts and lovers will share their knowledge, techniques, and insider tips to help you elevate your coffee game. So, whether you're looking to enhance your skills, expand your knowledge, or simply indulge in the world of specialty coffee, our Barista Blog is here to inspire, educate, and connect coffee enthusiasts from around the globe.</p>
	  			</div>
  			</div>
    	</div>
    </section>

    <section class="ftco-section ftco-services">
    	<div class="container">
    		<div class="row">
          <div class="col-md-4 ftco-animate">
            <div class="media d-block text-center block-6 services">
              <div class="icon d-flex justify-content-center align-items-center mb-5">
              	<span class="flaticon-choices"></span>
				
              </div>
              <div class="media-body">
                <h3 class="heading">Various categories</h3>
                <p>You can embark on a delightful journey of flavors, discovering the diverse world of coffee categories adds depth and excitement to your coffee-drinking experience.</p>
              </div>
            </div>      
          </div>
          <div class="col-md-4 ftco-animate">
            <div class="media d-block text-center block-6 services">
              <div class="icon d-flex justify-content-center align-items-center mb-5">
			  <span class="flaticon-coffee-cup"></span>
			 </div>
              <div class="media-body">
                <h3 class="heading">Bookmarks</h3>
                <p>Bookmarks provide users with a convenient way to save and access their favorite content within an application. </p>
              </div>
            </div>      
          </div>
          <div class="col-md-4 ftco-animate">
            <div class="media d-block text-center block-6 services">
              <div class="icon d-flex justify-content-center align-items-center mb-5">
              	<span class="flaticon-coffee-bean"></span></div>
              <div class="media-body">
                <h3 class="heading">Coffee Blends</h3>
                <p>Where recipes come to life, showcasing the expertise and creativity of roasters.  Let your taste buds embark on a flavorful adventure with every sip.</p>
              </div>
            </div>    
          </div>
        </div>
    	</div>
    </section>

    <section class="ftco-section">
    	<div class="container">
    		<div class="row align-items-center">
    			<div class="col-md-6 pr-md-5">
    				<div class="heading-section text-md-right ftco-animate">
	          	<span class="subheading">Discover</span>
	            <h2 class="mb-4">All Recipes</h2>
	            <p class="mb-4">Discover the latest trends in the coffee industry, stay updated on cutting-edge brewing methods, and gain insights into the nuances of different coffee beans and roasts. From in-depth brewing tutorials to equipment reviews and industry news, our Barista Blog is your trusted companion in your pursuit of coffee excellence.</p>
	            <p><a href="recipes" class="btn btn-primary btn-outline-primary px-4 py-3">View Full Recipes</a></p>
	          </div>
    			</div>
    			<div class="col-md-6">
    				<div class="row">
    					<div class="col-md-6">
    						<div class="menu-entry">
		    					<a href="#" class="img" style="background-image: url(assets/images/menu-1.jpg);"></a>
		    				</div>
    					</div>
    					<div class="col-md-6">
    						<div class="menu-entry mt-lg-4">
		    					<a href="#" class="img" style="background-image: url(assets/images/menu-2.jpg);"></a>
		    				</div>
    					</div>
    					<div class="col-md-6">
    						<div class="menu-entry">
		    					<a href="#" class="img" style="background-image: url(assets/images/menu-3.jpg);"></a>
		    				</div>
    					</div>
    					<div class="col-md-6">
    						<div class="menu-entry mt-lg-4">
		    					<a href="#" class="img" style="background-image: url(assets/images/menu-4.jpg);"></a>
		    				</div>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </section>

    <section class="ftco-counter ftco-bg-dark img" id="section-counter" style="background-image: url(assets/images/bg_2.jpg);" data-stellar-background-ratio="0.5">
			<div class="overlay"></div>
      <div class="container">
        <div class="row justify-content-center">
        	<div class="col-md-10">
        		<div class="row">
		          <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center">
		              <div class="text">
		              	<div class="icon"><span class="flaticon-coffee-cup"></span></div>
		              	<strong class="number" data-number="200">0</strong>
		              	<span>Recipes</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center">
		              <div class="text">
		              	<div class="icon"><span class="flaticon-coffee-cup"></span></div>
		              	<strong class="number" data-number="85">0</strong>
		              	<span>Comments</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center">
		              <div class="text">
		              	<div class="icon"><span class="flaticon-coffee-cup"></span></div>
		              	<strong class="number" data-number="1067">0</strong>
		              	<span>Visitors</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-6 col-lg-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center">
		              <div class="text">
		              	<div class="icon"><span class="flaticon-coffee-cup"></span></div>
		              	<strong class="number" data-number="50">0</strong>
		              	<span>Users</span>
		              </div>
		            </div>
		          </div>
		        </div>
		      </div>
        </div>
      </div>
    </section>


    <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section ftco-animate text-center">
            <h2 class="mb-4">Recent from recipes</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
          </div>
        </div>
        <div class="row d-flex">
		<?php foreach ($recipes as $recipe) {
            // Retrieve user information based on user_id
            $where[] =  array( "column" => "id", 
            "operator" => "=", 
            "value" => $recipe['user_id']);
            $user = db_select($connection, 'users', 'username', $where);
            $username = !empty($user[0]['username']) ? $user[0]['username'] : 'samaha';
            $instructions = $recipe['instructions'];
                    $characterLimit = 100; // Set the desired character limit
                    $truncatedInstructions = strlen($instructions) > $characterLimit ? substr($instructions, 0, $characterLimit) . '...' : $instructions;
          $where1 = array(
            array(
                "column" => "recipe_id",
                "operator" => "=",
                "value" => $recipe['id']
            )
        );
        $commentCount = db_select($connection, 'comments', 'COUNT(*) AS count', $where1);
    
        // Retrieve like count for the recipe
        $where2 = array(
            array(
                "column" => "recipe_id",
                "operator" => "=",
                "value" => $recipe['id']
            )
        );
        $likeCount = db_select($connection, 'likes', 'COUNT(*) AS count', $where2);
            ?>
          <div class="col-md-4 d-flex ftco-animate">
          	<div class="blog-entry align-self-stretch">
              <a href="recipe_details.php?id=<?php echo $recipe['id']; ?>" class="block-20" style="background-image: url('<?php echo $recipe['pic']; ?>');">
              </a>
              <div class="text py-4 d-block">
              	<div class="meta">
                  <div><a ><?php echo $recipe['post_date']; ?></a></div>
                  <div><a ><?php echo $username; ?></a></div>
				  <div><a class="meta-chat"><span class="icon-chat"></span> <?php echo $commentCount[0]['count']; ?></a></div>
                  <div><a class="meta-chat"><span class="icon-heart"></span> <?php echo $likeCount[0]['count']; ?></a></div>                                    </div>
                <h3 class="heading mt-2"><a href="#"><?php echo $recipe['recipe_name']; ?></a></h3>
				<p><?php  echo $truncatedInstructions; ?></p>
              </div>
            </div>
          </div>
		  <?php } ?>

        
        </div>
      </div>
    </section>
	<script>
	  var currentPage = document.getElementById("home");
	  currentPage.classList.add("active");
	  </script>