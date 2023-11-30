<?php
require_once('core/database.php');

if (isset($_GET['id'])) {
    $recipeId = $_GET['id'];
    $db_server = "localhost";
    $db_user = "root";
    $db_user_pass = "root";
    $db_name = "coffee_recipes";
    $connection = db_connect($db_server, $db_user, $db_user_pass, $db_name);
    $where[] = [
        
            "column" => "id",
            "operator" => "=",
            "value" => $recipeId
        
    ];
    //  print_r($_SESSION); print_r($_POST); print_r($_FILES); exit;

    $recipes = db_select($connection, 'recipes','*',$where);
    $recipe = $recipes[0];
    $where1[] = [
        
      "column" => "id",
      "operator" => "=",
      "value" => $recipe['category_id']
    ];

    $category = db_select($connection, 'categories','*',$where1);
    $categoryName = !empty($category) ? $category[0]['category'] : 'Unknown Category';

    $brewingMethods = [
      1 => 'Decoction',
      2 => 'Infusion',
      3 => 'Gravitational feed',
      4 => 'Pressurised percolation',
    ];
    $where2[] =  array( "column" => "id", 
    "operator" => "=", 
    "value" => $recipe['user_id']);
    $user = db_select($connection, 'users', 'username', $where2);
    $username = !empty($user[0]['username']) ? $user[0]['username'] : 'Unknown User';
    //  print_r($recipes); exit;
    $where3[]=array( "column" => "recipe_id",
    "operator" => "=",
    "value" => $recipe['id']);
    $comments = db_select($connection, 'comments', '*', $where3);
    $commentCount = count($comments);
  }
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit_comment'])) {
      $comment = $_POST['comment'];
      $data = array(
        "user_id" =>  $_SESSION['current_user'],
        "recipe_id" => $recipe['id'],
        "comment" => $comment
      );
      $comment = db_insert($connection, "comments", $data);
    }
    if (isset($_POST['like'])) {
      $checkUser = array(
        "column" => "user_id",
        "operator" => "=",
        "value" => $_SESSION['current_user']
      );
      $checkRecipe= array(
        "column" => "recipe_id",
        "operator" => "=",
        "value" => $recipe['id']
      );
      $whereLikedBefore = array();
      $whereLikedBefore[] = $checkUser;
      $whereLikedBefore[] = $checkRecipe;
      $likedBefore = db_select($connection, 'likes','*',$whereLikedBefore);
      if(!$likedBefore){
        $Like = array(
          "user_id" =>  $_SESSION['current_user'],
          "recipe_id" => $recipe['id'],
        );
        $liked = db_insert($connection, 'likes', $Like);
      }
    } elseif (isset($_POST['bookmark'])) {
      $checkUser = array(
        "column" => "user_id",
        "operator" => "=",
        "value" => $_SESSION['current_user']
      );
      $checkRecipe= array(
        "column" => "recipe_id",
        "operator" => "=",
        "value" => $recipe['id']
      );
      $whereBookmarkedBefore = array();
      $whereBookmarkedBefore[] = $checkUser;
      $whereBookmarkedBefore[] = $checkRecipe;
      $BookmarkedBefore = db_select($connection, 'bookmarks','*',$whereBookmarkedBefore);
      if(!$BookmarkedBefore){
      $Bookmark = array(
        "user_id" =>  $_SESSION['current_user'],
        "recipe_id" => $recipe['id'],
      );
      $bookmarked = db_insert($connection, 'bookmarks', $Bookmark);
    }
  }
  if (isset($_POST['delete'])) {
    $checkRecipe[] = array(
      "column" => "id",
      "operator" => "=",
      "value" => $recipe['id']
    );
    $deleted = db_delete($connection, "recipes", $checkRecipe);
    header("Location: " . ROOT_PATH . "/recipes");

  }


}


?>
<section class="home-slider owl-carousel">

<div class="slider-item" style="background-image: url(assets/images/pexels-quang-nguyen-vinh-2159106.jpg);" data-stellar-background-ratio="0.5">
  <div class="overlay"></div>
  <div class="container">
    <div class="row slider-text justify-content-center align-items-center">

      <div class="col-md-7 col-sm-12 text-center ftco-animate">
        <h1 class="mb-3 mt-5 bread">Recipe Details</h1>
        <p class="breadcrumbs"><span class="mr-2"><a href="home">Home</a></span> <span class="mr-2"><a href="recipes">Recipes</a></span> <span>Recipe Details</span></p>
      </div>

    </div>
  </div>
</div>
</section>

<section class="ftco-section">
<div class="container">
 
  <div class="row">
    <div class="col-md-8 ftco-animate">
      <!-- <div class="tag-widget post-tag-container mb-5 mt-5">
        <a class="float-right" href="#"><span class="icon icon-bookmark"></span></a> 
      </div> -->
      <h2 class="mb-3"><?php echo $recipe['recipe_name']; ?></h2>
      
      <p><?php echo $recipe['instructions']; ?></p>
      <p>
        <img src="<?php echo $recipe['pic']; ?>" alt="" class="img-fluid">
      </p>
      
 <!-- Hidden input element -->
<input type="text" value="<?php echo $_SERVER['REQUEST_URI']; ?>" id="copyInput" style="position: absolute; left: -9999px; top: -9999px;">


<form method="post">
<div class="tag-widget post-tag-container mb-5 mt-5 row">
  <?php 
    if(isUserSignedIn()){ ?>
    <button type="submit" name="like" value="1" class="btn btn-primary btn-lg col" data-toggle="tooltip" data-placement="top" title="Like recipe">
    <span class="icon <?php echo !empty($liked) ? 'icon-heart' : 'icon-heart-o'; ?>" style="font-size: large;"></span>
</button>
<button type="submit" name="bookmark" value="1" class="btn btn-primary btn-lg col" data-toggle="tooltip" data-placement="top" title="Add recipe to bookmarks">
    <span class="icon <?php echo !empty($bookmarked) ? 'icon-bookmark' : 'icon-bookmark-o'; ?>" style="font-size: large;"></span>

 <?php   }?>
  
    <button id="copyButton" type="button" onclick="copyToClipboard(event)" class="btn btn-primary btn-lg col" data-toggle="tooltip" data-placement="top" title="Copy recipe link">
        <span class="icon icon-link" style="font-size: large;"></span>
    </button>
    <?php if (isUserSignedIn() && $recipe['user_id'] == $_SESSION['current_user']) { ?>
    <button type="submit" name="delete" class="btn btn-primary btn-lg col" data-toggle="tooltip" data-placement="top" title="Delete recipe">
        <span class="icon icon-delete" style="font-size: large;"></span>
    </button>
 <?php   }?>
    
</button>
</div>
</form>

      <h3 class="mb-5">Posted by</h3></h3>

      <div class="about-author d-flex mt-5">

  <div class="bio align-self-md-center mr-4">
    
    <img src="assets/images/pexels-mikhail-nilov-7683664.jpg" alt="Image placeholder" class="img-fluid rounded-circle" style="width: 100px; height: 100px;">
  </div>
  
  <div class="desc align-self-md-center">

    <h5><?php echo $username; ?></h5>
  </div>
</div>


        <?php
// Existing code...

// Fetch comments for the recipe
$where3 = [
    [
        "column" => "recipe_id",
        "operator" => "=",
        "value" => $recipe['id']
    ]
];
$comments = db_select($connection, 'comments', '*', $where3);
$commentCount = count($comments);

?>

<div class="pt-5 mt-5">
    <h3 class="mb-5"><?php echo $commentCount; ?> Comments</h3>
    <ul class="comment-list">
        <?php if ($commentCount > 0) { ?>
            <?php foreach ($comments as $comment) {
                $where4 = [
                    [
                        "column" => "id",
                        "operator" => "=",
                        "value" => $comment['user_id']
                    ]
                ];
                $user1 = db_select($connection, 'users', 'username', $where4);
                $username1 = !empty($user1[0]['username']) ? $user1[0]['username'] : 'Unknown User';
            ?>
                <li class="comment">
                    <div class="vcard bio">
                        <img src="assets/images/person_2.jpg" alt="Image placeholder">
                    </div>
                    <div class="comment-body">
                        <h3><?php echo $username1; ?></h3>
                        <div class="meta"><?php echo $comment['comment_date']; ?></div>
                        <p><?php echo $comment['comment']; ?></p>
                    </div>
                </li>
            <?php } ?>
        <?php } else { ?>
            <li class="comment">
                <p>No comments.</p>
            </li>
        <?php } ?>
    </ul>

      <?php
if (isUserSignedIn()) {
    ?>
    <div class="comment-form-wrap pt-5">
        <h3 class="mb-5">Leave a comment</h3>
        <form method="POST">
            <div class="form-group">
                <label for="message">Message</label>
                <textarea name="comment" id="message" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <input type="submit" name="submit_comment" value="Post Comment" class="btn py-3 px-4 btn-primary">
            </div>
        </form>
    </div>
    </div>
  
    <?php
}
else{
  echo '</div>';
}
?>
 

    </div> <!-- .col-md-8 -->
    <div class="col-md-4 sidebar ftco-animate">
      <div class="sidebar-box">
        <form action="#" class="search-form">
          <div class="form-group">
            <div class="icon">
              <span class="icon-search"></span>
            </div>
            <input type="text" class="form-control" placeholder="Search...">
          </div>
        </form>
      </div>

      <div class="sidebar-box ftco-animate">
        <h3>Keywords</h3>
        <div class="tagcloud">
          <a class="tag-cloud-link"><?php echo $categoryName ?></a>
         <?php foreach ($brewingMethods as $value => $method) {
          if($recipe['brewing_method'] == $value){
            echo '<a  class="tag-cloud-link">' . $method . '</a>';
          }
                }
                ?>
        </div>
      </div>


  </div>
</div>
</section> 


<script>
    function copyToClipboard(event) {
        var copyInput = document.getElementById("copyInput");
        copyInput.value = window.location.href;

        copyInput.select();
        copyInput.setSelectionRange(0, 99999);

        document.execCommand("copy");

        var copyButton = event.target;

        $(copyButton).attr("data-original-title", "Copied: " + copyInput.value).tooltip("show");
setTimeout(function() {
    $(copyButton).attr("data-original-title", "Copy recipe link").tooltip("hide");
}, 2000); // Adjust the delay duration (in milliseconds) as needed

    }
</script>