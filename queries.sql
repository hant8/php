/* Запрос на получение всех существующих проектов */

SELECT * FROM `mydeal_master`.`projects`;


/* Запрос на получение всех существующих задач */

SELECT * FROM `mydeal_master`.`tasks`;

/* Запрос на получение всех существующих пользователей */

SELECT * FROM `mydeal_master`.`users`;

/* Добавление пользователя */

INSERT INTO `mydeal_master`.`users` (`id`, `name`, `email`, `password`, `date_register`) VALUES
(3, 'Игорь', 'nortung3@bk.ru', '$2y$10$mcwm.CgO.FLZKdUix9xT9.TmXOQtAXXGqrI75eB6bYMoNZG3dDIKm', '2022-09-01 15:25:32');

/* Добавление проекта */

INSERT INTO `mydeal_master`.`projects` (`id`, `user_id`, `name`) VALUES
(6, 3, 'Спорт');

/* Добавление задачи */

INSERT INTO `mydeal_master`.`tasks` (`id`, `user_id`, `project_id`, `name`, `date`, `completed`, `file`, `date_register`) VALUES
(7, 1, 4, 'Заказать пиццу', NULL, 0, NULL, '2022-09-01 15:24:54');

/* Получить список всех проектов одного пользователя */

SELECT 
	`projects`.`name` as `project_name`
FROM 
	`mydeal_master`.`projects`
LEFT JOIN `users` ON `projects`.`user_id` = `users`.`id`
WHERE `users`.`id` = 1;
 
/* Получить список всех задач одного пользователя */

SELECT 
	`tasks`.`name` as `task_name`
FROM 
	`mydeal_master`.`tasks`
LEFT JOIN `users` ON `tasks`.`user_id` = `users`.`id`
WHERE `users`.`id` = 1;

/* Пометить задачу как выполненную */

UPDATE `mydeal_master`.`tasks` SET `completed` = 1 WHERE `id`= 1;

/* Обновить название задачи по её идентификатору */

UPDATE `mydeal_master`.`tasks` SET name = 'Поиграть в футбол' WHERE `id` = 6;




