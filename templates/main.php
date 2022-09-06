<section class="content__side">
    <h2 class="content__side-heading">Проекты</h2>

    <nav class="main-navigation">
        <ul class="main-navigation__list">
            <?php
            if(!empty($projects)){

            foreach ($projects as $project) {

                $count = list_count($tasks, $project['project_name']);
                // Ищем активные проект
                $active_project = (isset($project_active) && ($project_active == $project['project_id']))?' main-navigation__list-item--active' : '';
                ?>
                <li class='main-navigation__list-item'>
                <? echo "<a class='main-navigation__list-item-link $active_project' href='index.php?project_active={$project['project_id']}'>{$project['project_name']}</a>";?>
                    <span class='main-navigation__list-item-count'><? echo $count; ?></span>
                </li>

            <? }
            } ?>
        </ul>
    </nav>

    <a class="button button--transparent button--plus content__side-button" href="pages/form-project.html" target="project_add">Добавить проект</a>
</section>

<main class="content__main">
    <h2 class="content__main-heading">Список задач</h2>

    <form class="search-form" action="index.php" method="post" autocomplete="off">
        <input class="search-form__input" type="text" name="" value="" placeholder="Поиск по задачам">

        <input class="search-form__submit" type="submit" name="" value="Искать">
    </form>

    <div class="tasks-controls">
        <nav class="tasks-switch">
            <a href="" class="tasks-switch__item tasks-switch__item--active">Все задачи</a>
            <a href="" class="tasks-switch__item">Повестка дня</a>
            <a href="" class="tasks-switch__item">Завтра</a>
            <a href="" class="tasks-switch__item">Просроченные</a>
        </nav>

        <label class="checkbox">
            <!--добавить сюда атрибут "checked", если переменная $show_complete_tasks равна единице-->
            <input class="checkbox__input visually-hidden show_completed" type="checkbox" <?php echo $show_complete_tasks === 1 ? 'checked' : ''; ?>>
            <span class="checkbox__text">Показывать выполненные</span>
        </label>
    </div>

    <table class="tasks">

        <?php
        if(!empty($tasks)){
        
        foreach ($tasks as $task) {

            if(isset($project_active) && $project_active != $task['project_id']){
                continue;
            }

            /* Пропускаем выполненые задачи если чекбокс неактивен */
            if ($show_complete_tasks === 0 && $task['task_completed'] == true) {continue;}
            /* Флаг на установку специального класса задачам которым осталось меньше 24 часов до выполнения */
            $flag = hours24($task['task_date'], $task['task_completed']);
            ?>
            <tr class='tasks__item task <? echo $task['task_completed'] == true ? ' task--completed ' : ''; echo $flag ;?>'>


                <td class='task__select'>
                    <label class='checkbox task__checkbox'>
                        <input class='checkbox__input visually-hidden task__checkbox' type='checkbox' value='1'>
                        <span class='checkbox__text'><? echo $task['task_name']; ?></span>
                    </label>
                </td>

                <td class='task__file'>
                    <a class='download-link' href='#'>Home.psd</a>
                </td>

                <td class='task__date'><? echo $task['task_date']; ?></td>
            </tr>
    <?  }
        }?>
    </table>
</main>