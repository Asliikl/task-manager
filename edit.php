<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Three Panels Layout</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    require_once "db.php";
    require "functions.php";



    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $task_id = $_GET['id'];

        $datacek = getTaskByID($task_id);
        if (!$datacek) {
            header('Location: index.php');
            exit();
        }
    } else {
        echo "Task ID is missing.";
        exit();
    }
    ?>

    <div class="container">
        <div class="editPanel">
            <div class="addTask">
                <form method="post" action="islem.php">
                    <label for="staff_id">Select Staff</label>
                    <select name="staff_id">
                        <?php
                        foreach (getStaffs() as $staff) { ?>
                            <option <?php if ($staff['id'] == $datacek['staff_id']) { ?> selected <?php } else { ?><?php } ?> value="<?php echo $staff['id'] ?>"> <?php echo $staff['staff_name'] ?></option>
                        <?php } ?>
                    </select>
                    <label for="task">Task Name</label>
                    <textarea name="task_name" rows="4"><?php echo $datacek['task_name'] ?></textarea>
                    <label for="status">Select Status</label>
                    <select name="status_id">
                        <?php
                        foreach (getStatuses() as $status) : ?>
                            <option <?php if ($status['id'] == $datacek['status_id']) { ?> selected <?php } else { ?><?php } ?> value="<?= $status['id'] ?>"><?= $status['status'] ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="hidden" name="task_id" value="<?php echo $datacek['id']; ?>">
                    <button type="submit" name="update_task">Update</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>