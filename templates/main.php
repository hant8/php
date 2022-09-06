<main class="content__main">
    <h2 class="content__main-heading">Список задач</h2>

    <form class="search-form" action="index.php" method="GET" autocomplete="off">
        <input class="search-form__input" type="text" name="search" value="" placeholder="Поиск по задачам">

        <input class="search-form__submit" type="submit" name="" value="Искать">
    </form>

    <div class="tasks-controls">
        <nav class="tasks-switch">
            <a href="index.php?sort=all" class="tasks-switch__item <? if(isset($_REQUEST['sort']) && $_REQUEST['sort'] === 'all'){ echo ' tasks-switch__item--active';}?>">Все задачи</a>
            <a href="index.php?sort=today" class="tasks-switch__item <? if(isset($_REQUEST['sort']) && $_REQUEST['sort'] === 'today'){ echo ' tasks-switch__item--active';}?>">Повестка дня</a>
            <a href="index.php?sort=tomorrow" class="tasks-switch__item <? if(isset($_REQUEST['sort']) && $_REQUEST['sort'] === 'tomorrow'){ echo ' tasks-switch__item--active';}?>">Завтра</a>
            <a href="index.php?sort=overdue" class="tasks-switch__item <? if(isset($_REQUEST['sort']) && $_REQUEST['sort'] === 'overdue'){ echo ' tasks-switch__item--active';}?>">Просроченные</a>
        </nav>

        <label class="checkbox">
            <!--добавить сюда атрибут "checked", если переменная $show_complete_tasks равна единице-->
            <input class="checkbox__input visually-hidden show_completed" type="checkbox" <?php echo $show_complete_tasks === 1 ? 'checked' : ''; ?>>
            <span class="checkbox__text">Показывать выполненные</span>
        </label>
    </div>

    <table class="tasks">

        <?php
        if(!empty($tasks) || !empty($search)){

            if(isset($search) && is_string($search)){
                echo $search;
            }else{
                $tasks = $search ?? $tasks;
                foreach ($tasks as $task) {

                    if(isset($_GET['project_active']) && $project_active != $task['project_id']){
                        continue;
                    }
                    /* Пропускаем выполненые задачи если чекбокс неактивен */
                    if ($show_complete_tasks === 0 && $task['task_completed'] == true) {continue;}
                    if(isset($_GET['sort'])){ /* Определяем сортировку */
        
                        $сurrently = date('Y-m-d');
                        switch ($_GET['sort']) {
                            case 'today':
                                $time_sort = $сurrently;
                            break;
                            case 'tomorrow':
                                $time_sort = date_create($сurrently);
                                date_modify($time_sort, '1 day');
                                $time_sort = date_format($time_sort, 'Y-m-d');
                            break;
                            case 'overdue':
                                $time_sort = date_create($сurrently);
                                date_modify($time_sort, '-1 day');
                                $time_sort = date_format($time_sort, 'Y-m-d');
                                $time_sort = strtotime($time_sort);
                            break;
                        }
                        if($_GET['sort'] === 'today' && $time_sort !== $task['task_date']){
                            continue;
                        }elseif($_GET['sort'] === 'tomorrow' && $time_sort !== $task['task_date']){
                            continue;
                        }elseif($_GET['sort'] === 'overdue' && ($time_sort < strtotime($task['task_date']) || empty($task['task_date']))){
                            continue;
                        }
        
                    }    
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
                            <a class='download-link' href='<?{ echo $task['task_file'];}?>'><?{ echo $task['task_file'];}?></a>
                        </td>
    
                        <td class='task__date'><? $task_date = date_create($task['task_date']);
                        echo date_format($task_date, 'd.m.Y'); ?></td>
                    </tr>
            <?  }
            }
        }?>
    </table>
</main>