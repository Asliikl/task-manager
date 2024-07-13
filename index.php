<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Three Panels Layout</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <?php
    include "db.php";
    /*
        if($_GET['durum']=="ok"){
            echo "Succesful save";
        }
        else{
            echo "Failed save";
        }
    */
    ?>
    <div class="container">
        <div class="panel">
            <div class="addTask">
                <form method="post" action="islem.php">
                    <label for="staff_id">Select Staff</label>
                    <select name="staff_id">
                        <?php
                        $data = $db->query("SELECT * FROM staff")->fetchAll();
                        foreach ($data as $row) { ?>
                            <option value="<?php echo $row['id'] ?>"> <?php echo $row['staff_name'] ?></option>
                        <?php } ?>

                    </select>

                    <label for="task">Task Name</label>
                    <textarea name="task_name" id="task" placeholder="up to 100 characters" rows="4"></textarea>

                    <label for="status">Select Status</label>
                    <select name="status_id">
                        <?php
                        $statuses = $db->query("SELECT * FROM status")->fetchAll();
                        foreach ($statuses as $status) : ?>
                            <option value="<?= $status['id'] ?>"><?= $status['status'] ?></option>
                        <?php endforeach; ?>
                    </select>

                    <button type="submit" name="insert_task">Save</button>
                </form>
            </div>
            <div class="addStaff">
                <form action="islem.php" method="POST">
                    <label for="">Add Name Staff</label>
                    <input type="text" name="staff_name" placeholder="">
                    <button type="submit" name="insert_staff">Save</button>
                </form>
            </div>
        </div>

        <div class="panel mid-panel">
            <div>
                <p style="background-color:#007bff;">TO DO</p>
                <div class="taskStatus">
                    <?php
                    $status_data = $db->prepare("SELECT *,tasks.id as task_id from tasks 
                    inner join staff ON tasks.staff_id=staff.id
                    WHERE tasks.status_id='1'");
                    $status_data->execute();
                    while ($statusdatacek = $status_data->fetch(PDO::FETCH_ASSOC)) { ?>
                        <div class="statusContent">
                            <div class="stafName"><?php echo $statusdatacek['staff_name'] ?>
                                <div class="actions">
                                    <a href="edit.php?id=<?php echo $statusdatacek['task_id'] ?>"><i class="fa fa-edit" style="color: green;"></i></a>
                                    <a href=""><i class="fa fa-remove" style="color: red;"></i></a>
                                    <a href=""><i class="fa fa-archive"></i></a>
                                </div>
                            </div>
                            <div class="taskContent"><?php echo $statusdatacek['task_name'] ?></div>
                            <div class="date">Created Date: <?php echo $statusdatacek['created_date'] ?> &nbsp;</div>
                        </div>
                    <?php } ?>
                </div>
            </div>


            <div>
                <p style="background-color:#28a745;">IN PROGRESS</p>
                <div class="taskStatus">
                    <?php
                    $status_data = $db->prepare("SELECT *,tasks.id as task_id from tasks 
                   inner join staff ON tasks.staff_id=staff.id
                   WHERE tasks.status_id='2'");
                    $status_data->execute();
                    while ($statusdatacek = $status_data->fetch(PDO::FETCH_ASSOC)) { ?>
                        <div class="statusContent">
                            <div class="stafName"><?php echo $statusdatacek['staff_name'] ?>
                            <div class="actions">
                                    <a href="edit.php?id=<?php echo $statusdatacek['task_id'] ?>"><i class="fa fa-edit" style="color: green;"></i></a>
                                    <a href=""><i class="fa fa-remove" style="color: red;"></i></a>
                                    <a href=""><i class="fa fa-archive"></i></a>
                                </div></div>
                            <div class="taskContent"><?php echo $statusdatacek['task_name'] ?>
                            </div>
                            <div class="date">Created Date: <?php echo $statusdatacek['created_date'] ?> &nbsp;</div>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div>
                <p style="background-color:#707070;">DONE</p>
                <div class="taskStatus">
                    <?php
                    $status_data = $db->prepare("SELECT *,tasks.id as task_id from tasks 
                    inner join staff ON tasks.staff_id=staff.id
                    WHERE tasks.status_id='3'");
                    $status_data->execute();
                    while ($statusdatacek = $status_data->fetch(PDO::FETCH_ASSOC)) { ?>
                        <div class="statusContent">
                            <div class="stafName"><?php echo $statusdatacek['staff_name'] ?>
                                <div class="actions">
                                    <a href="edit.php?id=<?php echo $statusdatacek['task_id'] ?>"><i class="fa fa-edit" style="color: green;"></i></a>
                                    <a href="islem.php?id=<?php echo $statusdatacek['task_id'] ?>&type=delete_task"><i class="fa fa-remove" style="color: red;"></i></a>
                                    <a href=""><i class="fa fa-archive"></i></a>
                                </div>
                            </div>
                            <div class="taskContent"><?php echo $statusdatacek['task_name'] ?>
                            </div>
                            <div class="date">Created Date: <?php echo $statusdatacek['created_date'] ?> &nbsp;</div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="panel">
            <button type="submit">Show Archieve</button>
            <div class="addTask">DONE + ARCHIEVE</div>
            <div class="addStaff">
                <table>
                    <tr>Top 5 Staff </tr>
                    <td>Ahmet Yılmaz</td>
                </table>
            </div>
        </div>
    </div>
</body>

</html>