<section>
    <div class="container">
 <h3>Изменение регистрационных данных</h3> 
<div class="row">
<div class="col-md-3 account">
</div>
</div>
<form method="post" name="registration" action="">

<div class="row">
  <div class="col-md-3">
  <label for="name">Ваш логин (Не менее 2-х символов)</label>
  </div>
  <div class="col-md-9">
  <input type="text" name="name" id="name" placeholder="Обязательно" value="<?= $var['name'] ?>" required> <span class="error"><?= $var['nameError'] ?></span>
  </div>
</div>

<div class="row">
  <div class="col-md-3">
  <label for="email">Ваш e-mail</label> 
  </div>
  <div class="col-md-9">
  <input type="email" name="email" id="email" placeholder="Обязательно" value="<?= $var['email'] ?>" required> <span class="error"><?= $var['emailError'] ?></span>
  </div>
</div>

<div class="row">
  <div class="col-md-3">
  <label for="password1">Новый пароль (Не менее 2-х символов)</label>
  </div>
  <div class="col-md-9">
  <input type="password" name="password1" id="password1" placeholder="Обязательно" value="" required> <span class="error"><?= $var['passwordErrorLength'] ?></span>
  </div>
</div>

<div class="row">
  <div class="col-md-3">
  <label for="password2">Повторите пароль</label>
  </div>
  <div class="col-md-9">
  <input type="password" name="password2" id="password2" placeholder="Обязательно" value="" required> <span class="error"><?= $var['passwordErrorMatch'] ?></span>
  </div> 
</div>

<div class="row last"> 
  <div class="col-md-3">
    Запомнить <input name="remember" type="checkbox" value="1">
   </div>
  <div class="col-md-9">
  <input type="submit" name="submit-reg" value="Сохранить личные настройки"> 
  <b><?= $var['regSuccessfully'] ?></b>
  </div>
</div>
<br>
</form>
</div>
</section>