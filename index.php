<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Three Panels Layout</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <div class="panel">
            <div class="div1">
                <form action="">
                    <label for="staff">Select Staff</label>
                    <select name="staff" id="staff">
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>

                    <label for="task">Task Name</label>
                    <textarea name="task" id="task" placeholder="up to 100 characters" rows="4"></textarea>

                    <label for="status">Select Status</label>
                    <select name="status" id="status">
                        <option value="1">TO DO</option>
                        <option value="2">IN PROGRESS</option>
                        <option>DONE</option>
                    </select>

                    <button type="submit">Save</button>
                </form>
            </div>
            <div class="div2">
                <form action="">
                    <label for="">Add Name Staff</label>
                    <input type="text">
                    <button type="submit">Save</button>
                </form>
            </div>
        </div>
        <div class="panel mid-panel">
            <div>
                <p style="background-color:#007bff;">TO DO</p>
                <div class="div2">
                    <div>Staff<a href="">1</a><a href="">2</a><a href="">3</a></div>
                    <div>task</div>
                    <div>Created Date</div>
                </div>

            </div>
            <div>
                <p style="background-color:#28a745;">IN PROGRESS</p>
                <div class="div2">
                    <div>Staff<a href="">1</a><a href="">2</a><a href="">3</a></div>
                    <div>task</div>
                    <div>Created Date</div>
                </div>
            </div>
            <div>
                <p style="background-color:#707070;">DONE</p>
                <div class="div2">
                    <div>Staff<a href="">1</a><a href="">2</a><a href="">3</a></div>
                    <div>task</div>
                    <div>Created Date</div>
                </div>
            </div>
        </div>
        <div class="panel">
            <button type="submit">Show Archieve</button>
            <div class="div1">DONE + ARCHIEVE</div>
            <div class="div2">
                <table>
                    <tr>Top 5 Staff </tr>
                    <td>Ahmet Yılmaz</td>
                </table>
            </div>
        </div>
    </div>
</body>

</html>