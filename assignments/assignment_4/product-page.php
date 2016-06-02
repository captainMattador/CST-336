<?php 
    session_start();
    if( !isset($_SESSION['currentUser']) )
        header('location: login.php');

    require 'model/product.php';
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Socks Inventory</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link type="text/css" rel="stylesheet" href="../../global/css/styles.css">
        <link type="text/css" rel="stylesheet" href="media/css/styles.css">
    </head>
    <body>

         <section id="user"> 
            <div class="user-info">
                <img src="media/images/user-icon.png" width="40px" />
                <h3> Welcome <?= $_SESSION['currentUser']['first_name'] ?>!</h3>
                <p>Last logged on at <?= $_SESSION['last_login']['last_login'] ?></p>
            </div>
            <div class="user-btn">
                <a class="cta" href="logout.php" tite="Logout">Logout</a> <a class="cta" href="reset.php" tite="Reset">Reset Password</a>
            </div>
        </section>

        <section id="header"> 
            <h1>Inventory List<br><span>Socks</span></h1>
        </section>


        <section id="page-info"> 

            <div class="page-title">
                <h2>Product <?= $prodId?> </h2>
                <a href="index.php" title="Back to Inventory">Back to Inventory</a>
            </div>

            <div class="page-status">
                <?php if(isset($status)): ?>
                <p><?= $status ?></p>
                <?php endif; ?> 
            </div>

            <div class="tables">
                <?php if($socks > 0): ?> 
                <form class="product-update-btn" method="POST">
                    <input type="hidden" name="productId" value="<?php echo $prod; ?>">
                    <input type="submit" value="Delete Product" name="deleteBTN">
                </form>
                <div class="clear"></div>
                <form class="prod-form" method="POST">
                    <input type="hidden" name="productId" value="<?php echo $prod; ?>">
                    <table>
                    <tr>
                        <th>Product ID</th>
                        <th>Description</th>
                        <th>Color</th>
                        <th>Style</th>
                        <th>Price</th>
                        <th>Chicago Inventory</th>
                        <th>LA Inventory</th>
                    </tr>
               
                    <tr>
                        <td><?=$socks['productId']; ?></td>
                        <td><?=$socks['description']; ?></td>
                        <td><?=$socks['color']; ?></td>
                        <td><?=$socks['style']; ?></td>
                        <td><?=$socks['price']; ?></td>
                        <td><?=$chInventory['qty']; ?></td>
                        <td><?=$laInventory ['qty']; ?></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td><input type="text" val="" name="desc" placeholder="Update Desccription"></td>
                        <td><input type="text" value="" name="color" placeholder="Update Color"></td>
                        <td><input type="text" value="" name="style" placeholder="Update Style"></td>
                        <td><input type="text" value="" name="price" placeholder="Update Price"></td>
                        <td><input type="text" value="" name="chInvent" placeholder="Update Ch Inventory"></td>
                        <td><input type="text" value="" name="laInvent" placeholder="Update LA Inventory"></td>
                    </tr>

                    </table>
                    <input class="table-action" type="submit" value="Update" name="updateBTN">
                </form>
                <?php endif; ?>
            </div>
        </section>

    </body>
</html>
