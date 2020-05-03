<!--banner-starts-->
<div class="bnr" id="home">
    <div  id="top" class="callbacks_container">
        <ul class="rslides" id="slider4">
            <li>
                <img src="images/bnr-1.jpg" alt=""/>
            </li>
            <li>
                <img src="images/bnr-2.jpg" alt=""/>
            </li>
            <li>
                <img src="images/bnr-3.jpg" alt=""/>
            </li>
        </ul>
    </div>
    <div class="clearfix"> </div>
</div>
<!--banner-ends-->
<?php if($brands):?>
<?php //debug($brands);?>
<!--about-starts-->
<div class="about">
    <div class="container">
        <div class="about-top grid-1">
            <?php foreach ($brands as $brand):?>
            <div class="col-md-4 about-left">
                <figure class="effect-bubba">
                    <img class="img-responsive" src="images/<?=$brand->img;?>" alt=""/>
                    <figcaption>
                        <h2><?=$brand->title;?></h2>
                        <p><?=$brand->description;?></p>
                    </figcaption>
                </figure>
            </div>
            <?php endforeach;?>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--about-end-->
<?php endif;?>
<!--product-starts-->
<?php if($hits):?>
    <?php $curr = \ishop\App::$properties->getProperty('currency');?>
<div class="product">
    <div class="container">
        <div class="product-top">
            <div class="product-one">
	            <?php foreach ($hits as $product):?>
                <div class="col-md-3 product-left">
                    <div class="product-main simpleCart_shelfItem">
                        <a href="product/<?= $product->alias; ?>" class="mask"><img class="img-responsive zoom-img" src="images/<?= $product->img; ?>" alt="" /></a>
                        <div class="product-bottom">
                            <h3><a href="product/<?= $product->alias; ?>"><?= $product->title; ?></a></h3>
                            <p>Узнайте Сейчас</p>
                            <h4>
                                <a class="add-to-cart-link" href="cart/add?id=<?= $product->id; ?>"><i></i></a>
                                <span class=" item_price"><?= $curr['symbol_left'] ?><?= $product->price * $curr['value']; ?><?= $curr['symbol_right'] ?></span>
                                <?php if($product->old_price): ?>
                                    <small><del><?= $curr['symbol_left'] ?><?= $product->old_price* $curr['value']; ?><?= $curr['symbol_right'] ?></del></small>
                                <?php endif; ?>
                            </h4>
                        </div>
	                    <?php if($product->old_price): ?>
                        <div class="srch">
                            <span><?php
                                $procent = $product->old_price* $curr['value']/100;
	                            $skidka = ($product->old_price* $curr['value'] - $product->price* $curr['value'])/$procent;
                                echo number_format($skidka,1 ); ?>%</span>
                        </div>
	                    <?php endif; ?>
                    </div>
                </div>
	            <?php endforeach;?>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<?php endif;?>
<!--product-end-->