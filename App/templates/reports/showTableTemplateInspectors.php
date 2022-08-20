<?php
    $result = $conn->query($sql);
  
    //echo '<h4>Pending & Assigned Nurseries</h4>';
    
    if ($result->num_rows > 0) {
        echo "<table>
        <tr class='assignedHeader'>
      
        <th>Name</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Eco-Region</th>
        
        
        </tr>";
    
        $i=1;
        while ($row = $result->fetch_assoc()) {
                echo "<tr class='mainContent'>";
                echo "<td class='mobileShowMe someDiv'><div>$i</div></td>";
                echo "<td class='name' style='text-align:center'><div class='tdDiv'></div><span>" . $row['f_name'] . " " . $row['l_name'] . "</span></td>";
                echo "<td class='phone' style='text-align:center'><div class='tdDiv'></div><span>" . $row["phone"] . "</span></td>"; 
                
                echo "<td class='email' style='text-align:center'> <div class='tdDiv'></div><span>" . $row['email'] . "</span></td>";
                echo "<td class='region' style='text-align:center'> <div class='tdDiv'></div><span>" . $row['region'] . "</span></td>";
                echo "</tr>";
                $i++;
            
        }
        echo "</table>";
        echo "<div class='reportOnly countContain'><span class='count'>Total Count: <span>$i</span></span></div>";
    } else {
        echo "<div class='no_result'></div><h3 class='no_result'>No data found!</h3>";
    }
    $conn -> close();
?>

