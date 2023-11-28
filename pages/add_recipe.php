
<section class="ftco-section">
      <div class="container">
        <div class="row">
          <div class="col ftco-animate">
						<form action="add_recipe" method="post" class="billing-form  p-3 p-md-5" >
							<h3 class="mb-5 billing-heading  text-center">My Recipe</h3>
	          	<div class="row align-items-end">
	          		<div class="col-md-6">
	                <div class="form-group">
	                	<label for="recipe_name">Recipe Name</label>
	                  <input type="text" name="recipe_name" class="form-control" placeholder="Name">
	                </div>
	              </div>
	              <div class="col-md-6">
	                <div class="form-group">
	                	<label for="category_id">Category</label>
                    <div class="select-wrap">
		                  <div class="icon"><span class="ion-ios-arrow-down"></span></div>
		                  <select name="category_id" id="" class="form-control">
		                  	<option value="1">Espresso</option>
							  <option value="2">Cappuccino</option>
							  <option value="3">Latte</option>
							  <option value="4">Flat white</option>
							  <option value="5">Americano</option>
							  <option value="6">Mocha</option>
							  <option value="7">Iced coffee</option>
							  <option value="8">Cortado</option>
							  <option value="9">Turkish coffee</option>
		                  </select>
		                </div>	               
                   </div>
                </div>
		            <div class="w-100"></div>
		            <div class="col-md-6">
		            	<div class="form-group">
	                	<label for="brewing_method">Brewing Method</label>
                    <div class="select-wrap">
		                  <div class="icon"><span class="ion-ios-arrow-down"></span></div>
		                  <select name="brewing_method" id="" class="form-control">
		                  	<option value="1">Decoction</option>
							  <option value="2">Infusion</option>
		                  	<option value="3">Gravitational feed</option>
		                  	<option value="4">Pressurised percolation</option>
						</select>
		                </div>
					</div>
		            </div>
		            <div class="col-md-6">
		            	<div class="form-group">
                    <label for="flavor">Flavor</label>

	                  <input type="text" name="flavor" class="form-control" placeholder="Caramel, Hazelnut, vanilla etc..">
	                </div>
		            </div>	            
                <div class="w-100"></div>
                <div class="col-md-12">
                  <div class="form-group ">
                    <label for="instructions">Instructions</label>
                    <textarea name="instructions" id="" cols="30" rows="7" class="form-control" placeholder="Instructions"></textarea>
                  </div>
                </div>
                <div class="col-md-12">
				<div class="form-group">
    			<label for="exampleFormControlFile1">Upload picture</label>
				<input type="file" name="pic" class="form-control-file" id="exampleFormControlFile1" accept="image/jpeg, image/png">
			</div>

                <div class="form-group text-center">
                  <input type="submit" value="Add Recipe" class="btn btn-primary py-3 px-5 mt-5">
                </div>
                </div>
              
                </div>
               
                </div>
	            </div>
	          </form>