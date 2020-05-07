<?php
    include_once "DBConnector.php";
    include "user.php";
    $cnew= new user("","","","","","");
    $result=$cnew->readAll();
?>
<html>
    <head>
        <title>All Records</title>
    </head>
    <body>
        <?php
if (mysqli_num_rows($result) > 0) {
?>
        <table align="center">
            <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>City</th>
            <th>Username</th>
           </tr>
                <?php

                   
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . "</td>";
                            echo "<td>" . $row["first_name"] . "</td>";
                            echo "<td>" . $row["last_name"] . "</td>";
                            echo "<td>" . $row["user_city"] . "</td>";
                            echo"<td>".$row["username"]."</td>";
                            echo "</tr>";
                        }
                    }
                ?>

        </table>
    </body>
</html> 