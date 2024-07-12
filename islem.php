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


// insert_task yapılacak
if (isset($_POST['insert_task'])) {
   if (isset($_POST['staff_id']) && isset($_POST['status_id'])) {
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
