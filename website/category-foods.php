<?php
include_once('../partials/menu.php');

use Website\Category;
use Website\Food;

if (isset($_GET['category_id'])) {
    $id = $_GET['category_id'];

    $displayCategory = new Category();
    $displayFood = new Food();
    $dataFood = $displayFood->displayCategor_Foods($id);
    $dataCat = $displayCategory->displayCategoryById($id);
} else {
    header("location:website-page.php");
}
?>
<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">
        <h2>Foods on <a href="#" class="text-white">"<?php echo $dataCat['title'] ?>"</a></h2>
    </div>
</section>
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>
        <?php
        if ($dataFood) {
            foreach ($dataFood as $value) {
        ?>
                <form class="addToCartForm" method="post">
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                            if ($value['image_name'] == '') {
                                echo "<div class='error'> Image Not Available</div>";
                            } else {
                            ?>
                                <img src="../images/food/<?php echo $value['image_name']; ?>" class="img-responsive img-curve">
                        </div>

                        <div class="food-menu-desc no-border">
                            <h4><?php echo $value['title']; ?></h4>
                            <input type="number" name="food_quantity" min="1" value="1">
                            <input type="text" class="food-price" value="<?= '$ ' . $value['price']; ?>">
                            <p class="food-detail">
                                <?php echo $value['description']; ?>
                            </p>
                            <br>
                            <input type="hidden" name="food_id" value="<?= $value['id'] ?>">
                            <input type="hidden" name="food_title" value="<?= $value['title'] ?>">
                            <input type="hidden" name="food_price" value="<?= $value['price'] ?>">
                            <input type="hidden" name="add_to_cart">
                            <button type="submit" class="btn btn-primary">Add To cart</button>
                        </div>
                    </div>
                </form>
    <?php
                            }
                        }
                    } else {
                        echo "<div class='error'> Food Not Added</div>";
                    }
    ?>
    </div>
    <div class="clearfix"></div>
    </div>
    <script src="../jsFiles/addToCart.js"></script>
</section>
<!-- fOOD Menu Section Ends Here -->
<?php
include_once('../partials/footer.php');
?>