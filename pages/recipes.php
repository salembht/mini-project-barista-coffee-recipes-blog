<?php
require_once('core/database.php');
// Retrieve all recipes
$db_server = "localhost";
$db_user = "root";
$db_user_pass = "root";
$db_name = "coffee_recipes";
$connection = db_connect($db_server, $db_user, $db_user_pass, $db_name);

$recipes = db_select($connection, 'recipes');


// Retrieve category counts

$sql = "SELECT categories.category AS category_name, COUNT(recipes.id) AS count
FROM categories
LEFT JOIN recipes ON categories.id = recipes.category_id
GROUP BY categories.id";

$result = mysqli_query($connection, $sql);

$categoryCounts = [];

while ($row = mysqli_fetch_assoc($result)) {
    $categoryCounts[] = $row;
}

?>



<section class="home-slider owl-carousel">

<div class="slider-item" style="background-image: url(assets/images/pexels-arshad-sutar-1749303.jpg);" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
  <div class="container" style="max-width: 1315px;">
    <div class="row slider-text justify-content-center align-items-center">

      <div class="col-md-7 col-sm-12 text-center ftco-animate">
          <h1 class="mb-3 mt-5 bread">Recipes</h1>
          <p class="breadcrumbs"><span class="mr-2"><a href="home">Home</a></span> <span>Recipes</span></p>
      </div>

    </div>
  </div>
</div>
</section>
<div >


<section class="ftco-section">
<div class="container" style="max-width: 1350px;">
  <div class="row">
    <aside class="col-md-2 mt-5 pt-5">
      <div class="container" >
        <h3>Categories</h3>
        <ul class="nav flex-column ">
        <?php foreach ($categoryCounts as $category) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><?php echo $category['category_name']; ?>
                                <span class="badge badge-light badge-pill m-sm-2"><?php echo $category['count']; ?></span>
                            </a>
                        </li>
                    <?php } ?>
        </ul>
      </div>
    </aside>
    
    <div class="col-md-9">
      <div class="row mb-4 p-3">
        <div class="col">
          <div class="dropdown">
            <button type="button" class="btn btn-primary dropdown-toggle " data-toggle="dropdown">
              Sort by
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#">Latest</a>
              <a class="dropdown-item" href="#">Oldest</a>
            </div>
          </div>

        </div>
        <div class="col">
          <form>
          <div class="input-group ">
            <input type="text" class="form-control" placeholder="Search">
            <div class="input-group-append">
              <button class="btn btn-primary" type="submit">Go</button>
            </div>
          </div>
        </form>
          
        </div>

        

      </div>
      <div class="row d-flex">

      <?php foreach ($recipes as $recipe) {
            // Retrieve user information based on user_id
            $where[] =  array( "column" => "id", 
            "operator" => "=", 
            "value" => $recipe['user_id']);
            $user = db_select($connection, 'users', 'username', $where);
            $username = !empty($user[0]['username']) ? $user[0]['username'] : 'Unknown User';
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
                            <div><a><?php echo $recipe['post_date']; ?></a></div>
                            <div><a> <?php echo $username; ?></a></div>
                         
                            <div><a class="meta-chat"><span class="icon-chat"></span> <?php echo $commentCount[0]['count']; ?></a></div>
                            <div><a class="meta-chat"><span class="icon-heart"></span> <?php echo $likeCount[0]['count']; ?></a></div>                        
                          </div>
                        <h3 class="heading mt-2"><a><?php echo $recipe['recipe_name']; ?></a></h3>

                        <p><?php  echo $truncatedInstructions; ?></p>
                    </div>
                </div>
            </div>
        <?php } ?>


    </div>








    <div class="row mt-5">
      <div class="col text-center">
        <div class="block-27">
          <ul>
            <!-- Pagination code -->
            <ul>
              <li><a href="#">&lt;</a></li>
              <li class="active"><span>1</span></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#">4</a></li>
              <li><a href="#">5</a></li>
              <li><a href="#">&gt;</a></li>
            </ul>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
</div>






</div>


<script>
	  var currentPage = document.getElementById("recipes");
	  currentPage.classList.add("active");
	  </script>