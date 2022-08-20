<?php

$result = $conn->query($sql);

        if ($result->num_rows > 0) {
            
            echo "<table>
            <tr class='assignedHeader'>
           
             <th>Reg. No.</th>
            <th>Nursery Name</th>
            <th>Y.o.E</th>
            <th>Contact Person</th>
            <th>Phone number</th>
            <th>County</th>
            <th>Date Applied</th>
            <th>Purpose</th>
            <th>Capacity</th>";
            
            
            echo "</tr>";
         
    
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                
    
              
    
                    echo "<tr class='mainContent'>";
                  
                    echo "<td class='kef'><div class='tdDiv'></div><span>" . $row['reg_num'] . "</span></td>"; 
                    echo "<td name='nurseryName' class='nursery'><div class='tdDiv'></div><span>" . $row['nursery_name'] . "</span></td>";
                    echo "<td>" . $row['YoE'] . "</td>";
                    echo "<td class='manager'> <div class='tdDiv'></div><span>" . $row['manager'] . "</span></td>";
                    echo "<td class='hdn'>" . $row['manager_phone'] . "</td>";
                    // echo "<td class='hdn'>" . $row['address'] . "</td>";
               
                    
                    echo "<td class='county'> <div class='tdDiv'></div><span>" . $row['county'] . "</span></td>";
                    // echo "<td class='hdn'>" . $row['email'] . "</td>";
                   
                    echo "<td class='date hdn'>" . $row['application date'] . "</td>";
                    echo "<td class='hdn'>" . $row['purpose'] . "</td>";
                    echo "<td class='hdn'>" . $row['capacity'] . "</td>";
                  
                    
                    // echo "<td class='status' name='nurseryStatus'><div class='tdDiv'></div><span>" . $row['status'] . "</span></td>";
                    
                    echo "</tr>";
               
                    $i++;
    
            }
            echo "</table>";
            echo "<div class='countContain'><span class='count'>Total Count: <span>$i</span></span></div>";
           
        } else {
            echo "<div class='no_result'></div><h3 class='no_result'>No data found!</h3>";
        }
        $conn -> close();
?>