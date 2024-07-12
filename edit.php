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
    include "db.php";
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
        </div>


    </div>
</body>

</html>