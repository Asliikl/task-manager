<!DOCTYPE html>
<html>

<head>
    <title>Archived Tasks</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f2f2f2;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .archiveStatus {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .archiveContent {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }

        .archiveContent:last-child {
            border-bottom: none;
        }

        .stafName {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .taskContent {
            margin-bottom: 5px;
        }

        .date {
            color: #666;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
        }
    </style>
</head>

<?php
    include 'db.php';
    $archived_tasks = $db->prepare("SELECT *, tasks.id as task_id FROM tasks 
                                    INNER JOIN staff ON tasks.staff_id = staff.id
                                    WHERE tasks.status_id = :status_id");
    $archived_tasks->execute(array(
        'status_id' => 4
    ));
?>

<body>
    <h1>Archived Tasks</h1>
    <div class="archiveStatus">
        <table>
            <thead>
                <tr>
                    <th>Staff Name</th>
                    <th>Task Name</th>
                    <th>Created Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($statusdatacek = $archived_tasks->fetch(PDO::FETCH_ASSOC)) { ?>
                    <tr class="archiveContent">
                        <td class="stafName"><?php echo $statusdatacek['staff_name'] ?></td>
                        <td class="taskContent"><?php echo $statusdatacek['task_name'] ?></td>
                        <td class="date"><?php echo $statusdatacek['created_date'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>

</html>