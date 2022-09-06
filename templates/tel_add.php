<main class="content__main">
  <h2 class="content__main-heading">Добавление задачи</h2>
  <form class="form" enctype="multipart/form-data" action="add.php" method="post" autocomplete="off">
    <div class="form__row">
      <label class="form__label" for="name">Название <sup>*</sup></label>

      <input class="form__input <? echo isset($errors['errorTaskName']) ? 'form__input--error' : ''; ?>" type="text" name="name" id="name" value="<? echo isset($_SESSION['taskName']) ? "{$_SESSION['taskName']}" : ''; ?>" placeholder="Введите название">
      <?php

      if (isset($errors['errorTaskName'])) {
        echo "<p class = 'form__message'>{$errors['errorTaskName']}</p>";
        unset($errors['errorTaskName']);
      }
      if (isset($_SESSION['taskName'])) {
        unset($_SESSION['taskName']);
      }
      ?>
    </div>

    <div class="form__row">
      <label class="form__label" for="project">Проект <sup>*</sup></label>

      <select class="form__input form__input--select <? echo isset($errors['errorTaskProject']) || isset($errors['errorProject']) ? 'form__input--error' : ''; ?>" name="project" id="project">
        <option value="" selected disabled>Выберите проект</option>
        <?php
        foreach ($projects as $project) {
          echo "<option value='{$project['project_id']}'>{$project['project_name']}</option>";
        }
        ?>
      </select>
      <?php
      if (isset($errors['errorTaskProject'])) {
        echo "<p class = 'form__message'>{$errors['errorTaskProject']}</p>";
        unset($errors['errorTaskProject']);
      }
      if (isset($errors['errorProject'])) {
        echo "<p class = 'form__message'>{$errors['errorProject']}</p>";
        unset($errors['errorProject']);
      }
      ?>
    </div>

    <div class="form__row">
      <label class="form__label" for="date">Дата выполнения</label>

      <input class="form__input form__input--date <? echo isset($errors['errorTaskDateFormat']) || isset($errors['errorTaskDate']) ? 'form__input--error' : ''; ?>" type="text" name="date" id="date" value="<? echo isset($_SESSION['taskDate']) ? "{$_SESSION['taskDate']}" : ''; ?>" placeholder="Введите дату в формате ГГГГ-ММ-ДД">
      <?php

      if (isset($errors['errorTaskDateFormat'])) {
        echo "<p class = 'form__message'>{$errors['errorTaskDateFormat']}</p>";
        unset($errors['errorTaskDateFormat']);
      }
      if (isset($errors['errorTaskDate'])) {
        echo "<p class = 'form__message'>{$errors['errorTaskDate']}</p>";
        unset($errors['errorTaskDate']);
      }
      if (isset($_SESSION['taskDate'])) {
        unset($_SESSION['taskDate']);
      }

      ?>
    </div>

    <div class="form__row">
      <label class="form__label" for="file">Файл</label>

      <div class="form__input-file">
        <input class="visually-hidden" type="file" name="file" id="file" value="">

        <label class="button button--transparent" for="file">
          <span>Выберите файл</span>
        </label>
      </div>
    </div>

    <div class="form__row form__row--controls">
      <? if (isset($errors)) {
        echo "<p class='error-message'>Пожалуйста, исправьте ошибки в форме</p>";
      } ?>
      <input class="button" type="submit" name="submit" value="Добавить">
    </div>
  </form>
</main>