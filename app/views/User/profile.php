<!--start-breadcrumbs-->
<div class="breadcrumbs">
    <div class="container">
        <div class="breadcrumbs-main">
            <ol class="breadcrumb">
                <li><a href="<?= PATH ?>">Главная</a></li>
                <li>Профиль пользователя <?php if(!empty($_SESSION['user'])): ?><?=$_SESSION['user']['name']?><?php endif; ?></li>
            </ol>
        </div>
    </div>
</div>
<!--end-breadcrumbs-->
<!--prdt-starts-->
<div class="prdt">
    <div class="container">
        <div class="prdt-top">
            <div class="col-md-12">
                <div class="product-one login">
                    <div class="register-top heading">
                        <h2>Профиль пользователя <?php if(!empty($_SESSION['user'])): ?><?=$_SESSION['user']['name']?><?php endif; ?></h2>
                    </div>
<?php if(!empty($_SESSION['user'])): ?>
    <div class="profile-info">
        <div class="col-md-6 account-left">
            <div class="form-group">
                <label for="login">Логин:</label>
                <input type="text" name="login" id="login" value="<?=$_SESSION['user']['login']?>">
            </div>
            <div class="form-group">
                <label for="name">Имя:</label>
                <input type="text" name="name" id="name" value="<?=$_SESSION['user']['name']?>">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" name="email" id="email" value="<?=$_SESSION['user']['email']?>">
            </div>
            <div class="form-group">
                <label for="address">Адрес:</label>
                <input type="text" name="address" id="address" value="<?=$_SESSION['user']['address']?>">
            </div>
        </div>
    </div>
<?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!--product-end-->