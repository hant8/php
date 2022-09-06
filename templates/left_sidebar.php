<section class="content__side">
    <h2 class="content__side-heading">Проекты</h2>

    <nav class="main-navigation">
        <ul class="main-navigation__list">
            <?php
            if (!empty($projects)) {

                foreach ($projects as $project) {

                    $count = list_count($tasks, $project['project_name']);
                    // Ищем активные проект
                    $active_project = (isset($_GET['project_active']) && ($project_active == $project['project_id'])) ? ' main-navigation__list-item--active' : '';

            ?>
                    <li class='main-navigation__list-item'>
                        <? echo "<a class='main-navigation__list-item-link $active_project' href='index.php?project_active={$project['project_id']}'>{$project['project_name']}</a>"; ?>
                        <span class='main-navigation__list-item-count'><? echo $count; ?></span>
                    </li>

            <? }
            } ?>
        </ul>
    </nav>

    <a class="button button--transparent button--plus content__side-button" href="addproject.php">Добавить проект</a>
</section>