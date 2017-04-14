<table class="fullscreen">
    <thead>
        <tr>
            <th>Number</th>
            <th>Name</th>
            <th>Address</th>
            <th>Phone No</th>
            <th>Open Hours</th>
            <th>Open Date</th>   
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <!-- php used to read this branch from the database-->
        <?php
        //is the database has no opendate on this row set open to Currently not open"

        $open = $brRow['openDate'];
        if ($open === NULL || $open === '') {
            $open = "Currently not open";
        } else {
            $date = explode('-', $open);
            $open = $date [2] . "/" . $date [1] . "/" . $date [0];
        }

        //creates a html table row to match this row on the database

        echo '<tr>';
        echo '<td>' . $brRow['branchNo'] . '</td>';
        echo '<td>' . $brRow['branchName'] . '</td>';
        echo '<td>' . $brRow['address'] . '</td>';
        echo '<td>' . $brRow['phoneNo'] . '</td>';
        echo '<td>' . $brRow['openHours'] . '</td>';
        //this row will insert the database info but an a case that there is no open date on this 
        //row it will insert Currently not open
        echo '<td>' . $open . '</td>';
        //echo '<td>' . $row['createdDate'] . '</td>';
        echo '<td><a class=" myButton small" href="editBranchForm.php?branchNo=' . $brRow['branchNo'] . '">Edit</a> </td>';
        echo '<td><a class="delete myButton small" href="deleteBranch.php?branchNo=' . $brRow['branchNo'] . '">Delete</a> </td>';
        echo '</tr>';
        ?>
    </tbody>

</table>

