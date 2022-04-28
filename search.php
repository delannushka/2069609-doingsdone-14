<?php

$sql = 'SELECT t.name as task_name, p.name as project_name, p.id as project_id,' .
    ' t.due_date as task_date, t.status as task_status, t.link_to_file as path'
    . ' FROM tasks t JOIN projects p ON t.project_id = p.id WHERE MATCH(t.name) AGAINST(?)';
$stmt = db_get_prepare_stmt($link, $sql, [$search]);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
if ($result) {
    $tasks = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if (count($tasks) !== 0) {
            $content = include_template('main.php', [
                'tasks' => $tasks,
                'projects' => $projects,
                'show_complete_tasks' => $show_complete_tasks,
                'current_project_id' => $current_project_id
            ]);
    }
} else {
    $error = mysqli_error($link);
    $content = include_template('error.php', ['error' => $error]);
}
