<?php
$isFormData = false;
if(!empty($_SESSION['singup_form_data'])){
    $isFormData = true;
    $formData = $_SESSION['singup_form_data'];
//    debug($formData);
}
    ?>
<!--start-breadcrumbs-->
<div class="breadcrumbs">
    <div class="container">
        <div class="breadcrumbs-main">
            <ol class="breadcrumb">
                <li><a href="<?= PATH ?>">Главная</a></li>
                <li>Регистрация</li>
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
                <div class="product-one signup">
                    <div class="register-top heading">
                        <h2>РЕГИСТРАЦИЯ</h2>
                    </div>

                    <div class="register-main">
                        <div class="col-md-6 account-left">
                            <form method="post" action="user/signup" id="signup" data-toggle="validator" role="form">
                                <div class="form-group has-feedback">
                                    <label for="login">Логин</label>
                                    <input type="text" pattern="^[_A-z0-9]{1,}$" name="login" class="form-control"
                                           id="login" placeholder="Login" value="<?php echo !empty($isFormData)? $formData['login']:'' ?>" required>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    <div class="help-block with-errors">Разрешены только символы, цифры и знак
                                        подчёркивания
                                    </div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="pasword">Пароль</label>
                                    <input type="password" name="password" class="form-control" id="pasword"
                                           placeholder="Password" value="<?php echo !empty($isFormData)? $formData['password']:'' ?>"
                                           data-error="Пароль должен содержать минимум 5 символов" data-minlength="5"
                                           required>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    <div class="help-block with-errors">Пароль должен содержать минимум 5 символов</div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="name">Имя</label>
                                    <input type="text" pattern="^[A-zА-я]{2,}$" name="name" class="form-control"
                                           id="name" placeholder="Имя" data-minlength="2" maxlength="50"
                                           data-error="Имя должно содержать только буквы. Минимум 2 буквы" value="<?php echo !empty($isFormData)? $formData['name']:'' ?>" required>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    <div class="help-block with-errors">Имя должно содержать только буквы</div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="email">Email</label>
                                        <input type="email" name="email" class="form-control" id="email"
                                               placeholder="Email" data-error="Этот email не является валидным"
                                               value="<?php echo !empty($isFormData)? $formData['email']:'' ?>" required>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group has-feedback">
                                    <label for="address">Адрес</label>
                                    <input type="text" name="address" class="form-control" id="address"
                                           placeholder="Address" value="<?php echo !empty($isFormData)? $formData['address']:'' ?>" required>
                                    <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                                    <div class="help-block with-errors">Адрес обязателен к заполнению</div>
                                </div>
                                <button type="submit" class="btn btn-default">Зарегистрировать</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--product-end-->
<?php if($isFormData){
    unset($_SESSION['singup_form_data']);
}
    ?>
