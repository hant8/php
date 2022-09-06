<section class="content__side">
  <p class="content__side-info">Если у вас уже есть аккаунт, авторизуйтесь на сайте</p>

  <a class="button button--transparent content__side-button" href="form-authorization.html">Войти</a>
</section>

<main class="content__main">
  <h2 class="content__main-heading">Регистрация аккаунта</h2>

  <form class="form" action="register.php" method="post" autocomplete="off">
    <div class="form__row">
      <label class="form__label" for="email">E-mail <sup>*</sup></label>

      <input class="form__input <? echo isset($errors['errorEmail'])|| (isset($errors['errorNoEmail'])) || (isset($errors['errorEmailUniqe']))? ' form__input--error' : ''; ?>" type="text" name="email" id="email" value="<? echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" placeholder="Введите e-mail" minlength="5">
      <?php

      if (isset($errors['errorEmail'])) {
        echo "<p class = 'form__message'>{$errors['errorEmail']}</p>";
        unset($errors['errorEmail']);
      }
      if (isset($errors['errorNoEmail'])) {
        echo "<p class = 'form__message'>{$errors['errorNoEmail']}</p>";
        unset($errors['errorNoEmail']);
      }
      if (isset($errors['errorEmailUniqe'])) {
        echo "<p class = 'form__message'>{$errors['errorEmailUniqe']}</p>";
        unset($errors['errorEmailUniqe']);
      }
      if (isset($_SESSION['email'])) {
        unset($_SESSION['email']);
      }
      ?>
    </div>

    <div class="form__row">
      <label class="form__label" for="password">Пароль <sup>*</sup></label>

      <input class="form__input <? echo isset($errors['errorPassword']) ? ' form__input--error' : ''; ?>" type="password" name="password" id="password" value="<? echo isset($_SESSION['password']) ? $_SESSION['password'] : ''; ?>" placeholder="Введите пароль" minlength="5">
      <?php

      if (isset($errors['errorPassword'])) {
        echo "<p class = 'form__message'>{$errors['errorPassword']}</p>";
        unset($errors['errorPassword']);
      }
      if (isset($_SESSION['password'])) {
        unset($_SESSION['password']);
      }
      ?>
    </div>

    <div class="form__row">
      <label class="form__label" for="name">Имя <sup>*</sup></label>

      <input class="form__input <? echo isset($errors['errorName']) ? ' form__input--error' : ''; ?>" type="text" name="name" id="name" value="<? echo isset($_SESSION['name']) ? $_SESSION['name'] : ''; ?>" placeholder="Введите имя" minlength="5">
      <?php

      if (isset($errors['errorName'])) {
        echo "<p class = 'form__message'>{$errors['errorName']}</p>";
        unset($errors['errorName']);
      }
      if (isset($_SESSION['name'])) {
        unset($_SESSION['name']);
      }
      ?>
    </div>

    <div class="form__row form__row--controls">
      <? if (isset($errors)) {
        echo "<p class='error-message'>Пожалуйста, исправьте ошибки в форме</p>";
      } ?>
      <input class="button" type="submit" name="submit" value="Зарегистрироваться">
    </div>
  </form>
</main>