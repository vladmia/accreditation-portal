<?php

$result = $conn->query($sql);

        if ($result->num_rows > 0) {
            
            echo "<table>
            <tr class='assignedHeader'>
             <th>Reg. No.</th>
            <th>Nursery Name</th>
            <th>Y.o.E</th>
            <th>Contact Person</th>
            <th>County</th>
            <th>Subcounty</th>
            
            <th>Date Applied</th>
            <th>Inspector</th>
            <th>Date Inspected</th>
            <th>Score</th>
            <th>Rating</th>";
            echo "</tr>";
            
    
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                 
               
                $eval_id = $row['eval_id'];
                
    
                $sql_eval = "SELECT * FROM evaluators WHERE evaluators.evaluator_id = '$eval_id'";
                $result_eval = $conn->query($sql_eval);
                $eval_data = $result_eval->fetch_assoc();
                $row_name = "";
                
    
                 if (!$eval_id) {
                    $row_name = 'Unassigned';
                } else {
                    $row_name = $eval_data['f_name'] . " " . $eval_data['l_name'];
                }
    
                    echo "<tr class='mainContent'>";
                    
                    echo "<td class='kef'><div class='tdDiv'></div><span>" . $row['reg_num'] . "</span></td>"; 
                    echo "<td name='nurseryName' class='nursery'><div class='tdDiv'></div><span>" . $row['nursery_name'] . "</span></td>";
                    echo "<td>" . $row['YoE'] . "</td>";
                    echo "<td class='manager'> <div class='tdDiv'></div><span>" . $row['manager'] . "</span></td>";
                  
                    echo "<td class='county'> <div class='tdDiv'></div><span>" . $row['county'] . "</span></td>";
                    echo "<td class='hdn'>" . $row['subcounty'] . "</td>";
                    echo "<td class='date hdn'>" . $row['application date'] . "</td>";
                    echo "<td class='eval'><div class='tdDiv'></div><span>" . $row_name . "</span></td>";
                    echo "<td class='date hdn'>" . $row['inspection_date'] . "</td>";
                    echo "<td class='hdn score'>" . $row['score'] . "%</td>";
                    echo "<td class='hdn rate'>" . $row['rate'] . "-star</td>";
                    
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