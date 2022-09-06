<main class="content__main">
        <h2 class="content__main-heading">Добавление проекта</h2>

        <form class="form"  action="addproject.php" method="post" autocomplete="off">
          <div class="form__row">
            <label class="form__label" for="project_name">Название <sup>*</sup></label>

            <input class="form__input <? echo isset($errors['errorProjectName']) || isset($errors['errorProjectUnique'])? ' form__input--error' : ''; ?> type="text" name="project_name" id="project_name" value="<? echo isset($_SESSION['projectName'])? $_SESSION['projectName'] : ''; ?>" placeholder="Введите название проекта">
            <?php
            if (isset($errors['errorProjectName'])) {
              echo "<p class = 'form__message'>{$errors['errorProjectName']}</p>";
              unset($errors['errorProjectName']);
            }
            if (isset($errors['errorProjectUnique'])) {
              echo "<p class = 'form__message'>{$errors['errorProjectUnique']}</p>";
              unset($errors['errorProjectUnique']);
            }
            if (isset($_SESSION['projectName'])) {
              unset($_SESSION['projectName']);
            }
            ?>
          </div>

          <div class="form__row form__row--controls">
            <input class="button" type="submit" name="addproject" value="Добавить">
          </div>
        </form>
</main>