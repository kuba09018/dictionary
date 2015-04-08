<?php require '/application.php'; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>The HTML5 Herald</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="container">
<div class="row">
    <div class="col-xs-12">
        <h1>Word count list</h1>
        <table class="table table-striped table-bordered">
            <tr>
                <th>Word</th>
                <th>Count</th>
                <th></th>
            </tr>
            <?php
            $i = 0 ;
            foreach ($words as $row) {
                if(200==$i) {
                    break;
                }
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['count'] . "</td>";
                echo "<td>";
                echo "<a class='glyphicon glyphicon-pencil'></a> ";
                echo "<a class='glyphicon glyphicon-remove'></a></td>";
                echo "</tr>";
            }
            $i++;
            ?>
        </table>
    </div>
</div>
</body>
</html>