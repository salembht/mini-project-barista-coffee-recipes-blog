<?php
require_once('core/database.php');
// Retrieve all recipes
$db_server = "localhost";
$db_user = "root";
$db_user_pass = "root";
$db_name = "coffee_recipes";
$connection = db_connect($db_server, $db_user, $db_user_pass, $db_name);

// Retrieve current user's ID from session or wherever it is stored
$currentUserId = $_SESSION['current_user'];

// Create the SQL query to select bookmarked recipes
$query = "SELECT r.* FROM recipes r
          JOIN bookmarks b ON r.id = b.recipe_id
          WHERE b.user_id = $currentUserId";

// Execute the query
$result = mysqli_query($connection, $query);

// Fetch all the rows as an associative array
$bookmarkedRecipes = mysqli_fetch_all($result, MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['unbookmark'])) {
        $recipeId = $_POST['recipe_id'];
        $checkBookmark[] = array(
            "column" => "recipe_id",
            "operator" => "=",
            "value" => $recipeId
          );
          $deleted = db_delete($connection, "bookmarks", $checkBookmark);
          header("Location: " . ROOT_PATH . "/bookmarks");
          exit();
    }
}
?>
<section class="home-slider owl-carousel">

<div class="slider-item" style="background-image: url(assets/images/pexels-karolina-grabowska-5426978.jpg);" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
  <div class="container">
    <div class="row slider-text justify-content-center align-items-center">

      <div class="col-md-7 col-sm-12 text-center ftco-animate">
          <h1 class="mb-3 mt-5 bread">Bookmarks</h1>
          <p class="breadcrumbs"><span class="mr-2"><a href="home">Home</a></span> <span>Bookmarks</span></p>
      </div>

    </div>
  </div>
</div>
</section>
<div >

<section class="ftco-section">
<div class="container">
<?php if (empty($bookmarkedRecipes)) { ?>
                <p class="text-center" style="font-size:20px;">No Bookmarks. To add one go to <a href="recipes">Recipes Page</a></p>
            <?php } else { ?>
  
      <div class="row d-flex">

      <?php foreach ($bookmarkedRecipes as $recipe) {
            // Retrieve user information based on user_id
            $where[] =  array( "column" => "id", 
            "operator" => "=", 
            "value" => $recipe['user_id']);
            $user = db_select($connection, 'users', 'username', $where);
            $username = !empty($user[0]['username']) ? $user[0]['username'] : 'fatima';
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
                    <a href="recipe_details.php?id=<?php echo $recipe['id']; ?>" class="block-20" style="background-image: url('<?php echo $recipe['pic']; ?>');"></a>
                    <div class="text py-4 d-block">
                        <div class="meta">
                            <div><a><?php echo $recipe['post_date']; ?></a></div>
                            <div><a> <?php echo $username; ?></a></div>
                            <div><a class="meta-chat"><span class="icon-chat"></span> <?php echo $commentCount[0]['count']; ?></a></div>
                            <div><a class="meta-chat"><span class="icon-heart"></span> <?php echo $likeCount[0]['count']; ?></a></div>                        
                        </div>
                        <h3 class="heading mt-2"><a><?php echo $recipe['recipe_name']; ?></a></h3>

                        <p><?php  echo $truncatedInstructions; ?></p>
                        <form method="POST">
                            <input type="hidden" name="recipe_id" value="<?php echo $recipe['id']; ?>">
                            <button type="submit" name="unbookmark" class="btn btn-primary btn-lg col">Unbookmark</button>
                        </form>
                    </div>
                </div>
               
            </div>
            <?php } ?>
    
    </div>
    <?php } ?>

    </div>


    <script>
	  var currentPage = document.getElementById("bookmarks");
	  currentPage.classList.add("active");
	  </script>