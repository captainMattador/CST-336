<?php 
    session_start();
    if( !isset($_SESSION['currentUser']) )
        header('location: login.php');

    require 'model/sock-inventory.php';
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
                <h2>Inventory of Socks <span>( <?= $prodCount ?> Products ), Highest Priced Product: $<?= $maxPrice ?></span></h2>
                <a href="insert-page.php" title="Insert New Item">Insert New Item</a>
            </div>

            <div class="page-status">
                <?php if(isset($status)): ?>
                <p><?= $status ?></p>
                <?php endif; ?> 
            </div>

            <div class="tables">
                
                <form method="POST">
                <table class="filters">
                    <tr>
                        <td>
                            <?php if($color > 0): ?>
                                <label>Color:</label>
                                <select id="color" name="color">
                                    <option value="" selected>-Color-</option>
                                    <?php foreach ($color as $vale): ?>
                                    <option value="<?=$vale['color']?>"><?=$vale['color']?></option>
                                    <?php endforeach;?>
                                </select>
                            <?php endif; ?> 
                        </td>
                        <td>
                            <?php if($style > 0): ?>
                                <label>Style:</label>
                                <select id="style" name="style">
                                    <option value="" selected>-Style-</option>
                                    <?php foreach ($style as $vale): ?>
                                    <option value="<?=$vale['style']?>"><?=$vale['style']?></option>
                                    <?php endforeach;?>
                                </select>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($price > 0): ?>
                                <label>Price:</label>
                                <select id="price" name="price">
                                    <option value="" disabled selected>-Price-</option>
                                    <?php foreach ($price as $vale): ?>
                                    <option value="<?=$vale['price']?>"><?=$vale['price']?></option>
                                    <?php endforeach;?>
                                </select>
                            <?php endif; ?>
                        </td>
                        <td>
                            <label>Sort:</label>
                            <select id="sort" name="sort">
                                <option value="ASC" <?php if($sortBy == 'ASC') echo "selected" ?>>Low to High</option>
                                <option value="DESC" <?php if($sortBy == 'DESC') echo "selected" ?>>High to Low</option>
                            </select>
                        </td>
                        <td>
                            <input type="submit" name="filterBTN" value="Filter">
                        </td>
                    </tr>
                </table>
                </form>

                <!-- print out all the inventory if they exist-->
                <table class="main-table">
                <tr>
                    <th>Product ID</th>
                    <th>Description</th>
                    <th>Color</th>
                    <th>Style</th>
                    <th>Price</th>
                    <th></th>
                </tr>
                <?php if($socks > 0): ?> 
                <?php foreach ($socks as $sock): ?>

                <tr>
                    <td><?php echo $sock['productId']; ?></td>
                    <td><?php echo $sock['description']; ?></td>
                    <td><?php echo $sock['color']; ?></td>
                    <td><?php echo $sock['style']; ?></td>
                    <td><?php echo $sock['price']; ?></td>
                    <td>
                        <form method="POST" action="product-page.php">
                            <input type="hidden" name="productId" value="<?=$sock['productId']; ?>">
                            <input type="submit" name="viewBTN" value="View Product">
                        </form>
                    </td>
                </tr>

                <?php endforeach;?> 
                <?php endif; ?>
                </table>

            </div>

        </section>

    </body>
</html>
