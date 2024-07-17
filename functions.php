<?php

function getTasksFromStatusId($statusId = 1)
{
    global $db;
    $tasks = $db->prepare("SELECT *,tasks.id AS task_id FROM tasks 
                   INNER JOIN staff ON tasks.staff_id=staff.id
                   WHERE tasks.status_id=:status_id");
    $tasks->execute(array(
        'status_id' => $statusId
    ));
    return $tasks->fetchAll(PDO::FETCH_ASSOC);
}

function getStaffs()
{
    global $db;
    return $db->query("SELECT id,staff_name FROM staff")->fetchAll();
}
function getStaffByName($staffName)
{
    global $db;
    $tasks = $db->prepare("SELECT id,staff_name FROM staff WHERE staff_name=:staff_name");
    $tasks->execute(array(
        'staff_name' => $staffName
    ));
    return $tasks->fetch(PDO::FETCH_ASSOC);
}
function getStaffByID($staffID)
{
    global $db;
    $tasks = $db->prepare("SELECT id,staff_name FROM staff WHERE id=:id");
    $tasks->execute(array(
        'id' => $staffID
    ));
    return $tasks->fetch(PDO::FETCH_ASSOC);
}

function getTaskByID($taskID)
{
    global $db;
    $data = $db->prepare("SELECT tasks.*, staff.staff_name, status.status
    FROM tasks
    INNER JOIN staff ON tasks.staff_id = staff.id
    INNER JOIN status ON tasks.status_id = status.id
    WHERE tasks.id = :id");
    $data->execute(array(
        'id' => $taskID
    ));
    return $data->fetch(PDO::FETCH_ASSOC);
}

function getStatuses()
{
    global $db;
    return $db->query("SELECT id,status FROM status WHERE id != 4")->fetchAll();
}
