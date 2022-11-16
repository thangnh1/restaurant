<?php 
include('../db/connect.php');
?>
<section id="menu" class="menu section-pading">

        <div class="container">
            <div class="row">
                <div class="title">
                    <h2>MENU LIST</h2>
                </div>
            </div>
            <div class="row">
                <div class="detail">
                    <div id="id03" class="detail-modal1">
                        <span onclick="document.getElementById('id03').style.display='none'" class="close" title="Close Modal">&times;</span>
                        <div class="detail-items">
                            <div class="detail-img">
                                <img src="../image/background.jpg" alt="">
                            </div>
                            <div class="detail-info">
                                <h2>PASTA</h2>
                                <h3>PRICE: 50$</h3>
                                <label for="">QUANTITY: <input type="number"></label>
                                <h3>DETAIL : <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse ex incidunt magnam vero similique modi quaerat nihil earum cum sapiente, ab tempora deserunt nisi non perferendis odio totam, cupiditate possimus.</p>
                                </h3>
                                <a href="#" class="btn-cart m-b-20">
                                    ADD TO CART <i class="fas fa-cart-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="menu-title">
                    <?php
                    $sql_category = mysqli_query($con, "SELECT * FROM tbl_category ORDER BY id  ASC");
                    ?>

                    <?php
                    while ($row_category = mysqli_fetch_array($sql_category)) {
                    ?>
                        <button class="menu-button" data-title="<?php echo $row_category['id'] ?>"><?php echo $row_category['category_name'] ?></button>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <?php
            $sql_category = mysqli_query($con, "SELECT * FROM tbl_category");
            ?>
            <?php
            while ($row_category = mysqli_fetch_array($sql_category)) {
            ?>
                <div class="menu-content " id="<?php echo $row_category['id'] ?>">
                    <?php
                    $id = $row_category['id'];
                    $sql_product = mysqli_query($con, "SELECT * FROM tbl_product WHERE category_id = $id ");
                    ?>
                    <?php
                    while ($row_product = mysqli_fetch_array($sql_product)) {
                    ?>
                        <div class="list-items">
                            <div class="list-item">
                                <img src="../image/<?php echo $row_product['image'] ?>" alt="">
                                <button class="menu-item-name" onclick="document.getElementById('id03').style.display='block'" style="width:100%;"><?php echo $row_product['name'] ?></button>
                            </div>
                            <div class="list-price">
                                <p><?php echo $row_product['price'] ?>$</p>
                            </div>
                            <a href="addproduct.php?action=add&sanpham_id=<?php echo $row_product['id'] ?>"><i class="fas fa-plus"></i></a>
                        </div>
                    <?php
                    }
                    ?>

                </div>


            <?php
            }
            ?>
        </div>

    </section>