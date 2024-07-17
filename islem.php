<?php
require_once 'db.php';
include 'functions.php';

if (isset($_POST['insert_staff']) && isset($_POST['staff_name']) && !empty($_POST['staff_name'])) {
   $checkStaffIsExist = getStaffByName($_POST['staff_name']);
   if ($checkStaffIsExist) {
      header("Location:index.php?user_var=yes");
      exit;
   }
   $save = $db->prepare("INSERT INTO staff SET staff_name=:staff_name");
   $insert = $save->execute(array(
      'staff_name' => $_POST['staff_name']
   ));
   if ($insert) {
      header("Location:index.php?durum=ok");
      exit();
   } else {
      header("Location:index.php?durum=no");
      exit;
   }
}


if (isset($_POST['insert_task'])) {
   if (isset($_POST['staff_id']) && isset($_POST['status_id'])) {
      $isStaffExist = $db->prepare("SELECT * from staff where id = :id");
      $isStaffExist->execute(array(
         'id' => $_POST['staff_id']
      ));
      $isStaffExistResult = $isStaffExist->fetch(PDO::FETCH_ASSOC);

      $isStatusExist = $db->prepare("SELECT * from status where id = :id");
      $isStatusExist->execute(array(
         'id' => $_POST['status_id']
      ));
      $isStatusExistResult = $isStatusExist->fetch(PDO::FETCH_ASSOC);
      if (!$isStatusExistResult || !$isStaffExistResult) {
         header("Location: index.php?status=error");
      }
      $staff_id = $_POST['staff_id'];
      $status_id = $_POST['status_id'];

      $save_task = $db->prepare("INSERT INTO tasks SET
      task_name=:task_name,
      staff_id=:staff_id,
      status_id=:status_id,
      created_date=:created_date	
   ");
      $insert = $save_task->execute(array(
         'task_name' => $_POST['task_name'],
         'staff_id' => $_POST['staff_id'],
         'status_id' => $_POST['status_id']
      ));
      if ($insert) {
         header("Location:index.php?durum=ok");
         exit();
      } else {
         header("Location:index.php?durum=no");
         exit();
      }
   } else {
      header("Location:index.php?data=no");
      exit();
   }
}


if (isset($_POST['update_task'])) {
   $update_task = $db->prepare("UPDATE tasks SET
   task_name=:task_name,
   staff_id=:staff_id,
   status_id=:status_id,
   created_date=:created_date	
    WHERE id = :task_id
");
   $update = $update_task->execute(array(
      'task_name' => $_POST['task_name'],
      'staff_id' => $_POST['staff_id'],
      'status_id' => $_POST['status_id'],
      'created_date' => $_POST['created_date'],
      'task_id' => $_POST['task_id']
   ));
   if ($update) {
      header("Location:index.php?durum=ok");
      exit();
   } else {
      header("Location:index.php?durum=no");
   }
}

if (isset($_GET['type']) && $_GET['type'] == 'delete_task' && isset($_GET['id'])) {
   $delete_task = $db->prepare("DELETE FROM tasks WHERE id = :id");
   $delete = $delete_task->execute(array(
      'id' => $_GET['id']
   ));
   if ($delete) {
      header("Location: index.php?durum=ok");
      exit();
   } else {
      header("Location: index.php?durum=no");
      exit();
   }
}
if (isset($_GET['type']) && $_GET['type'] == 'archive_task' && isset($_GET['id'])) {
   $archive_task = $db->prepare("UPDATE tasks SET status_id = 4 WHERE id = :id");
   $archive = $archive_task->execute(array(
      'id' => $_GET['id']
   ));
   if ($archive) {
      header("Location: index.php?durum=ok");
      exit();
   } else {
      header("Location: index.php?durum=no");
      exit();
   }
}

header("Location: index.php?islem_return=ok");
exit();
