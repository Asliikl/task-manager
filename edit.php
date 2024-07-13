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

    $data = $db->prepare("SELECT tasks.*, staff.staff_name, status.status
    FROM tasks
    INNER JOIN staff ON tasks.staff_id = staff.id
    INNER JOIN status ON tasks.status_id = status.id
    WHERE tasks.id = :id");
    $data->execute(array(
        'id' => $_GET['id']
    ));
    $datacek = $data->fetch(PDO::FETCH_ASSOC);
    if (!$datacek) {
        header('Location: index.php');
    }
    ?>

    <div class="container">
        <div class="editPanel">
            <div class="addTask">
                <form method="post" action="islem.php">
                    <label for="staff_id">Select Staff</label>
                    <select name="staff_id">
                        <?php
                        $data = $db->query("SELECT * FROM staff")->fetchAll();
                        foreach ($data as $row) { ?>
                            <option <?php if ($row['id'] == $datacek['staff_id']) { ?> selected <?php } else { ?><?php } ?> value="<?php echo $row['id'] ?>"> <?php echo $row['staff_name'] ?></option>
                        <?php } ?>
                    </select>
                    <label for="task">Task Name</label>
                    <textarea name="task_name" rows="4"><?php echo $datacek['task_name'] ?></textarea>
                    <label for="status">Select Status</label>
                    <select name="status_id">
                        <?php
                        $statuses = $db->query("SELECT * FROM status")->fetchAll();
                        foreach ($statuses as $status) : ?>
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