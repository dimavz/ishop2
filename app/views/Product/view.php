<!--start-breadcrumbs-->
<div class="breadcrumbs">
    <div class="container">
        <div class="breadcrumbs-main">
            <ol class="breadcrumb">
                <?php if (!empty($breadcrumbs)): ?>
                    <?php echo $breadcrumbs; ?>
                <?php endif; ?>
                <!--                <li><a href="index.html">Home</a></li>-->
                <!--                <li class="active">Single</li>-->
            </ol>
        </div>
    </div>
</div>
<!--end-breadcrumbs-->
<!--start-single-->
<div class="single contact">
    <div class="container">
        <div class="single-main">
            <!--			--><? //= debug($product);?>
            <?php $curr = \ishop\App::$properties->getProperty('currency'); ?>
            <?php $cats = \ishop\App::$properties->getProperty('categories'); ?>
            <div class="col-md-9 single-main-left">
                <div class="sngl-top">
                    <div class="col-md-5 single-top-left">
                        <div class="flexslider">
                            <ul class="slides">
                                <?php if (!empty($gallery)): ?>
                                    <?php foreach ($gallery as $item): ?>
                                        <li data-thumb="images/<?= $item->img; ?>">
                                            <div class="thumb-image">
                                                <img src="images/<?= $item->img; ?>" data-imagezoom="true"
                                                     class="img-responsive" alt=""/>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <li data-thumb="images/<?= $product->img; ?>">
                                        <div class="thumb-image">
                                            <img src="images/<?= $product->img; ?>" data-imagezoom="true"
                                                 class="img-responsive" alt=""/>
                                        </div>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <!-- FlexSlider -->

                    </div>
                    <div class="col-md-7 single-top-right">
                        <div class="single-para simpleCart_shelfItem">
                            <h2><?= $product->title; ?></h2>
                            <div class="star-on">
                                <ul class="star-footer">
                                    <li><a href="#"><i> </i></a></li>
                                    <li><a href="#"><i> </i></a></li>
                                    <li><a href="#"><i> </i></a></li>
                                    <li><a href="#"><i> </i></a></li>
                                    <li><a href="#"><i> </i></a></li>
                                </ul>
                                <div class="review">
                                    <a href="#"> 1 customer review </a>

                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <h5 class="item_price" id="base-price" data-base="<?= $product->price * $curr['value']; ?>">
                                <?= $curr['symbol_left'] ?><?= $product->price * $curr['value']; ?><?= $curr['symbol_right'] ?>
                                <?php if ($product->old_price): ?>
                                    <small>
                                        <del data-old="<?= $product->old_price * $curr['value']; ?>"><?= $curr['symbol_left'] ?><?= $product->old_price * $curr['value']; ?><?= $curr['symbol_right'] ?></del>
                                    </small>
                                <?php endif; ?>
                            </h5>
                            <?= $product->content; ?>

                            <div class="available">
                                <?php if (!empty($modifications)): ?>
                                    <ul>
                                        <li>Цвет
                                            <select>
                                                <option value="0">
                                                    Выбрать цвет
                                                </option>
                                                <?php foreach ($modifications as $mod): ?>
                                                    <option data-title="<?= $mod->title; ?>"
                                                            data-price="<?= $mod->price * $curr['value']; ?>"
                                                            value="<?= $mod->id; ?>"><?= $mod->title; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </li>
                                        <div class="clearfix"></div>
                                    </ul>
                                <?php endif; ?>
                            </div>

                            <ul class="tag-men">
                                <li><span>Категория</span>
                                    <span>: <a href="category/<?= $cats[$product->category_id]['alias']; ?>"><?= $cats[$product->category_id]['title']; ?></a></span>
                                </li>
                            </ul>
                            <div class="quantity">
                                <input type="number" size="4" value="1" name="quantity" min="1" step="1" width="4">
                                <a id="productAdd<?= $product->id; ?>" data-id="<?= $product->id; ?>"
                                   href="cart/add?id=<?= $product->id; ?>" class="add-cart item_add add-to-cart-link">ДОБАВИТЬ
                                    В КОРЗИНУ</a>
                            </div>


                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="tabs">
                    <ul class="menu_drop">
                        <li class="item1"><a href="#"><img src="images/arrow.png" alt="">Description</a>
                            <ul>
                                <li class="subitem1"><a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing
                                        elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam
                                        erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation
                                        ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</a></li>
                                <li class="subitem2"><a href="#"> Duis autem vel eum iriure dolor in hendrerit in
                                        vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla
                                        facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent
                                        luptatum zzril delenit augue duis dolore</a></li>
                                <li class="subitem3"><a href="#">Mirum est notare quam littera gothica, quam nunc
                                        putamus parum claram, anteposuerit litterarum formas humanitatis per seacula
                                        quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum
                                        clari, fiant sollemnes </a></li>
                            </ul>
                        </li>
                        <li class="item2"><a href="#"><img src="images/arrow.png" alt="">Additional information</a>
                            <ul>
                                <li class="subitem2"><a href="#"> Duis autem vel eum iriure dolor in hendrerit in
                                        vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla
                                        facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent
                                        luptatum zzril delenit augue duis dolore</a></li>
                                <li class="subitem3"><a href="#">Mirum est notare quam littera gothica, quam nunc
                                        putamus parum claram, anteposuerit litterarum formas humanitatis per seacula
                                        quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum
                                        clari, fiant sollemnes </a></li>
                            </ul>
                        </li>
                        <li class="item3"><a href="#"><img src="images/arrow.png" alt="">Reviews (10)</a>
                            <ul>
                                <li class="subitem1"><a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing
                                        elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam
                                        erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation
                                        ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</a></li>
                                <li class="subitem2"><a href="#"> Duis autem vel eum iriure dolor in hendrerit in
                                        vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla
                                        facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent
                                        luptatum zzril delenit augue duis dolore</a></li>
                                <li class="subitem3"><a href="#">Mirum est notare quam littera gothica, quam nunc
                                        putamus parum claram, anteposuerit litterarum formas humanitatis per seacula
                                        quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum
                                        clari, fiant sollemnes </a></li>
                            </ul>
                        </li>
                        <li class="item4"><a href="#"><img src="images/arrow.png" alt="">Helpful Links</a>
                            <ul>
                                <li class="subitem2"><a href="#"> Duis autem vel eum iriure dolor in hendrerit in
                                        vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla
                                        facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent
                                        luptatum zzril delenit augue duis dolore</a></li>
                                <li class="subitem3"><a href="#">Mirum est notare quam littera gothica, quam nunc
                                        putamus parum claram, anteposuerit litterarum formas humanitatis per seacula
                                        quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum
                                        clari, fiant sollemnes </a></li>
                            </ul>
                        </li>
                        <li class="item5"><a href="#"><img src="images/arrow.png" alt="">Make A Gift</a>
                            <ul>
                                <li class="subitem1"><a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing
                                        elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam
                                        erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation
                                        ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</a></li>
                                <li class="subitem2"><a href="#"> Duis autem vel eum iriure dolor in hendrerit in
                                        vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla
                                        facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent
                                        luptatum zzril delenit augue duis dolore</a></li>
                                <li class="subitem3"><a href="#">Mirum est notare quam littera gothica, quam nunc
                                        putamus parum claram, anteposuerit litterarum formas humanitatis per seacula
                                        quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum
                                        clari, fiant sollemnes </a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <?php if ($related): ?>
                    <div class="latestproducts">
                        <div class="product-one">
                            <h3>С этим товаром так же покупают:</h3>
                            <?php foreach ($related as $item): ?>
                                <div class="col-md-4 product-left p-left">
                                    <div class="product-main simpleCart_shelfItem">
                                        <a href="product/<?= $item['alias']; ?>" class="mask">
                                            <img class="img-responsive zoom-img" src="images/<?= $item['img']; ?>"
                                                 alt=""/>
                                        </a>
                                        <div class="product-bottom">
                                            <a href="product/<?= $item['alias']; ?>">
                                                <h3><?= $item['title']; ?></h3>
                                            </a>

                                            <p>Explore Now</p>
                                            <h4><a class=" item_add add-to-cart-link"
                                                   href="cart/add?id=<?= $item['id']; ?>" data-id="<?= $item['id']; ?>"><i></i></a>
                                                <span class=" item_price">
                                            <?= $curr['symbol_left'] ?><?= $item['price'] * $curr['value']; ?><?= $curr['symbol_right'] ?>

                                        </span>
                                                <?php if ($item['old_price']): ?>
                                                    <small>
                                                        <del><?= $curr['symbol_left'] ?><?= $item['old_price'] * $curr['value']; ?><?= $curr['symbol_right'] ?></del>
                                                    </small>
                                                <?php endif; ?>
                                            </h4>
                                        </div>
                                        <?php if ($item['old_price'] > 0): ?>
                                            <div class="srch">
                                            <span>
                                                <?php
                                                $procent = $item['old_price'] * $curr['value'] / 100;
                                                $skidka = ($item['old_price'] * $curr['value'] - $item['price'] * $curr['value']) / $procent;
                                                echo number_format($skidka, 1);
                                                echo "%";

                                                ?>
                                            </span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if ($viewedProducts): ?>
                    <div class="latestproducts">
                        <div class="product-one">
                            <h3>Недавно просмотренные товары:</h3>
                            <?php foreach ($viewedProducts as $item): ?>
                                <div class="col-md-4 product-left p-left">
                                    <div class="product-main simpleCart_shelfItem">
                                        <a href="product/<?= $item['alias']; ?>" class="mask">
                                            <img class="img-responsive zoom-img" src="images/<?= $item['img']; ?>"
                                                 alt=""/>
                                        </a>
                                        <div class="product-bottom">
                                            <a href="product/<?= $item['alias']; ?>">
                                                <h3><?= $item['title']; ?></h3>
                                            </a>

                                            <p>Explore Now</p>
                                            <h4><a class=" item_add add-to-cart-link"
                                                   href="cart/add?id=<?= $item['id']; ?>" data-id="<?= $item['id']; ?>"><i></i></a>
                                                <span class=" item_price">
                                            <?= $curr['symbol_left'] ?><?= $item['price'] * $curr['value']; ?><?= $curr['symbol_right'] ?>

                                        </span>
                                                <?php if ($item['old_price']): ?>
                                                    <small>
                                                        <del><?= $curr['symbol_left'] ?><?= $item['old_price'] * $curr['value']; ?><?= $curr['symbol_right'] ?></del>
                                                    </small>
                                                <?php endif; ?>
                                            </h4>
                                        </div>
                                        <?php if ($item['old_price'] > 0): ?>
                                            <div class="srch">
                                            <span>
                                                <?php
                                                $procent = $item['old_price'] * $curr['value'] / 100;
                                                $skidka = ($item['old_price'] * $curr['value'] - $item['price'] * $curr['value']) / $procent;
                                                echo number_format($skidka, 1);
                                                echo "%";

                                                ?>
                                            </span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                <?php endif; ?>


            </div>
            <div class="col-md-3 single-right">
                <div class="w_sidebar">
                    <section class="sky-form">
                        <h4>Catogories</h4>
                        <div class="row1 scroll-pane">
                            <div class="col col-4">
                                <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>All
                                    Accessories</label>
                            </div>
                            <div class="col col-4">
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Women
                                    Watches</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Kids
                                    Watches</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Men
                                    Watches</label>
                            </div>
                        </div>
                    </section>
                    <section class="sky-form">
                        <h4>Brand</h4>
                        <div class="row1 row2 scroll-pane">
                            <div class="col col-4">
                                <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>kurtas</label>
                            </div>
                            <div class="col col-4">
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Sonata</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Titan</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Casio</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Omax</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>shree</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Fastrack</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Sports</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Fossil</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Maxima</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Yepme</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Citizen</label>
                                <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Diesel</label>
                            </div>
                        </div>
                    </section>
                    <section class="sky-form">
                        <h4>Colour</h4>
                        <ul class="w_nav2">
                            <li><a class="color1" href="#"></a></li>
                            <li><a class="color2" href="#"></a></li>
                            <li><a class="color3" href="#"></a></li>
                            <li><a class="color4" href="#"></a></li>
                            <li><a class="color5" href="#"></a></li>
                            <li><a class="color6" href="#"></a></li>
                            <li><a class="color7" href="#"></a></li>
                            <li><a class="color8" href="#"></a></li>
                            <li><a class="color9" href="#"></a></li>
                            <li><a class="color10" href="#"></a></li>
                            <li><a class="color12" href="#"></a></li>
                            <li><a class="color13" href="#"></a></li>
                            <li><a class="color14" href="#"></a></li>
                            <li><a class="color15" href="#"></a></li>
                            <li><a class="color5" href="#"></a></li>
                            <li><a class="color6" href="#"></a></li>
                            <li><a class="color7" href="#"></a></li>
                            <li><a class="color8" href="#"></a></li>
                            <li><a class="color9" href="#"></a></li>
                            <li><a class="color10" href="#"></a></li>
                        </ul>
                    </section>
                    <section class="sky-form">
                        <h4>discount</h4>
                        <div class="row1 row2 scroll-pane">
                            <div class="col col-4">
                                <label class="radio"><input type="radio" name="radio" checked=""><i></i>60 % and
                                    above</label>
                                <label class="radio"><input type="radio" name="radio"><i></i>50 % and above</label>
                                <label class="radio"><input type="radio" name="radio"><i></i>40 % and above</label>
                            </div>
                            <div class="col col-4">
                                <label class="radio"><input type="radio" name="radio"><i></i>30 % and above</label>
                                <label class="radio"><input type="radio" name="radio"><i></i>20 % and above</label>
                                <label class="radio"><input type="radio" name="radio"><i></i>10 % and above</label>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--end-single-->