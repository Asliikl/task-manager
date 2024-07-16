<?php
require_once 'db.php';

if (isset($_POST['insert_staff'])) {
   $save = $db->prepare("INSERT into staff set
    staff_name=:staff_name
   ");
   $insert = $save->execute(array(
      // !!!!sağ taraf takma isim
      'staff_name' => $_POST['staff_name']
   ));
   if ($save) {
      header("Location:index.php?durum=ok");
      exit();
   } else {
      header("Location:index.php?durum=no");
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
      //formda 1-2-3-4 id li gösteririp elle 999 yazar post eder. bunu önlemek için güvenliğini böyle yapman lazım
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
         'status_id' => $_POST['status_id'],
         'created_date' => $_POST['created_date']
      ));
      if ($save_task) {
         header("Location:index.php?durum=ok");
         exit();
      } else {
         header("Location:index.php?durum=no");
      }
   } else {
      echo "there is no such data";
   }
}


if (isset($_POST['update_task'])) {
   //gelen staff id ve status id yi veritabanında sorgula, eğer yoksa hata verdir.
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
