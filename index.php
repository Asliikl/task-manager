<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager | Pure PHP</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <?php
    require_once "db.php";
    require "functions.php";
    ?>
    <div class="container">
        <div class="panel">
            <div class="addTask">
                <form method="post" action="islem.php">
                    <label for="staff_id">Select Staff</label>
                    <select name="staff_id">
                        <?php
                        foreach (getStaffs() as $staff) { ?>
                            <option value="<?php echo $staff['id'] ?>"> <?php echo $staff['staff_name'] ?></option>
                        <?php } ?>
                    </select>

                    <label for="task">Task Name</label>
                    <textarea name="task_name" id="task" maxlength="100" placeholder="up to 100 characters" rows="4"></textarea>

                    <label for="status">Select Status</label>
                    <select name="status_id">
                        <?php
                        foreach (getStatuses() as $status) : ?>
                            <option value="<?= $status['id'] ?>"><?= $status['status'] ?></option>
                        <?php endforeach; ?>
                    </select>

                    <button type="submit" name="insert_task">Save</button>
                </form>
            </div>
            <div class="addStaff">
                <form action="islem.php" method="POST">
                    <label for="">Add Staff</label>
                    <input type="text" name="staff_name" placeholder="Staff Name">
                    <button type="submit" name="insert_staff">Save</button>
                </form>
            </div>
        </div>

        <div class="panel mid-panel">
            <div>
                <p style="background-color:#007bff;">TO DO</p>
                <div class="taskStatus">
                    <?php
                    foreach (getTasksFromStatusId() as $todoTask) { ?>
                        <div class="statusContent">
                            <div class="staffName">
                                <?php echo $todoTask['staff_name'] ?>
                                <div class="actions">
                                    <a href="edit.php?id=<?php echo $todoTask['task_id'] ?>"><i class="fa fa-edit" style="color: green;"></i></a>
                                    <a href="islem.php?id=<?php echo $todoTask['task_id'] ?>&type=delete_task" onclick="return confirm('Are you sure you want to delete this task?');"><i class="fa fa-remove" style="color: red;"></i></a>
                                    <a href="islem.php?id=<?php echo $todoTask['task_id'] ?>&type=archive_task" onclick="return confirm('Are you sure you want to archive this task?');"><i class="fa fa-archive"></i></a>
                                </div>
                            </div>
                            <div class="taskContent"><?php echo $todoTask['task_name'] ?></div>
                            <div class="date">Created Date: <?php echo $todoTask['created_date'] ?> &nbsp;</div>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div>
                <p style="background-color:#28a745;">IN PROGRESS</p>
                <div class="taskStatus">
                    <?php
                    foreach (getTasksFromStatusId(2) as $progressTask) { ?>
                        <div class="statusContent">
                            <div class="staffName"><?php echo $progressTask['staff_name'] ?>
                                <div class="actions">
                                    <a href="edit.php?id=<?php echo $progressTask['task_id'] ?>"><i class="fa fa-edit" style="color: green;"></i></a>
                                    <a href="islem.php?id=<?php echo $progressTask['task_id'] ?>&type=delete_task" onclick="return confirm('Are you sure you want to delete this task?');"><i class="fa fa-remove" style="color: red;"></i></a>
                                    <a href="islem.php?id=<?php echo $progressTask['task_id'] ?>&type=archive_task" onclick="return confirm('Are you sure you want to archive this task?');"><i class="fa fa-archive"></i></a>
                                </div>
                            </div>
                            <div class="taskContent"><?php echo $progressTask['task_name'] ?>
                            </div>
                            <div class="date">Created Date: <?php echo $progressTask['created_date'] ?> &nbsp;</div>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div>
                <p style="background-color:#707070;">DONE</p>
                <div class="taskStatus">
                    <?php
                    foreach (getTasksFromStatusId(3) as $doneTask) { ?>
                        <div class="statusContent">
                            <div class="staffName"><?php echo $doneTask['staff_name'] ?>
                                <div class="actions">
                                    <a href="edit.php?id=<?php echo $doneTask['task_id'] ?>"><i class="fa fa-edit" style="color: green;"></i></a>
                                    <a href="islem.php?id=<?php echo $doneTask['task_id'] ?>&type=delete_task" onclick="return confirm('Are you sure you want to delete this task?');"><i class="fa fa-remove" style="color: red;"></i></a>
                                    <a href="islem.php?id=<?php echo $doneTask['task_id'] ?>&type=archive_task" onclick="return confirm('Are you sure you want to archive this task?');"><i class="fa fa-archive"></i></a>
                                </div>
                            </div>
                            <div class="taskContent"><?php echo $doneTask['task_name'] ?>
                            </div>
                            <div class="date">Created Date: <?php echo $doneTask['created_date'] ?> &nbsp;</div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="panel">
            <button type="button" onclick="window.location.href='archive.php'">Show Archive</button>
            <div class="addStaff">
                Top 5 Staff
                <hr>
                <?php
                /*$topStaffs = $db->prepare("SELECT staff.staff_name, COUNT(tasks.id) as completed_tasks
                         FROM tasks
                         INNER JOIN staff ON tasks.staff_id = staff.id
                         WHERE tasks.status_id = 3
                         GROUP BY tasks.staff_id
                         ORDER BY completed_tasks DESC
                         LIMIT 5");
                $topStaffs->execute();
                while ($topStaff = $topStaffs->fetch(PDO::FETCH_ASSOC)) { ?>
                    <ul>
                        <li><?php echo $topStaff['staff_name'] ?></li>
                    </ul>
                <?php }*/ ?>
                <?php
                $topStaffs = $db->prepare("SELECT staff.staff_name, COUNT(tasks.id) as completed_tasks
                         FROM tasks
                         INNER JOIN staff ON tasks.staff_id = staff.id
                         WHERE tasks.status_id = 3
                         GROUP BY tasks.staff_id
                         ORDER BY completed_tasks DESC
                         LIMIT 5");
                $topStaffs->execute();
                foreach ($topStaffs->fetchAll(PDO::FETCH_ASSOC) as $topStaff) { ?>
                    <ul>
                        <li><?php echo $topStaff['staff_name'] ?></li>
                    </ul>
                <?php } ?>

            </div>
        </div>
</body>

</html>