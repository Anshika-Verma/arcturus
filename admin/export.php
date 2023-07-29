<?php
    error_reporting(0);

    include '../assets/file/connection.php';
    include '../assets/file/db_functions.php';
    
    header("Content-Type: application/xls");
    header("Pragma: no-cache"); 
    header("Expires: 0");

    if($_GET['type'] == 'complaints'){
        header("Content-Disposition: attachment; filename=complaints.xls");  

        echo '<table border="1">';
            //make the column headers what you want in whatever order you want
                
        
        echo '<tr>
                <th>शिकायत संख्या</th>
                <th>शिकायत आईडी</th>
                <th>शिकायत प्राप्ति दिनांक</th>
                <th>तहसील</th>
                <th>विकासखंड </th>
                <th>ग्राम पंचायत </th>
                <th>शिकायत का प्रकार </th>
                <th>शिकायतकर्ता का नाम  </th>
                <th>शिकायतकर्ता का मोबाईल नम्बर</th>
                <th>ई-मेल</th>
                <th>आंवटित अधिकारी का नाम</th>
                <th>अधिकारी का मोबाईल नम्बर</th>
                <th>शिकायत का स्टेटस</th>
            </tr>';
            
            $query = "SELECT * FROM complaint_table WHERE delete_flag = 0 ";

            if($_GET['tehsil_id'] != ''){
                $tehsilId = $_GET['tehsil_id'];
                
                if($tehsilId != 'all'){
                    $query .= " AND  tehsil_id = '$tehsilId' ";
                }
            }

            if($_GET['block_id'] != ''){
                $blockId = $_GET['block_id'];
                if($blockId != 'all'){
                    $query .= " AND  block_id = '$blockId' ";
                }
            }

            if($_GET['department_id'] != ''){
                $departmentId = $_GET['department_id'];
                if($departmentId != 'all'){
                    $query .= " AND  department_id = '$departmentId' ";
                }
            }

            if($_GET['from_date'] != ''){
                $from_date = $_GET['from_date'];
                $query .= " AND  DATE(create_date) >= '$from_date' ";
            }

            if($_GET['to_date'] != ''){
                $to_date = $_GET['to_date'];
                $query .= " AND  DATE(create_date) <= '$to_date' ";
            }

            if($_GET['status'] != ''){
                if($_GET['status'] != 'all'){
                    if($_GET['status'] == 'pending'){
                        $query .= " AND  admin_status = 0 AND status_flag = 0 ";
                    }

                    if($_GET['status'] == 'solved'){
                        $query .= "AND (admin_status = 1 OR user_review = 1) ";
                    }

                    if($_GET['status'] == 'pending_review'){
                        $query .= " AND user_review = 0 AND admin_status = 0 AND status_flag != 0 ";
                    }
                }
            }

            if($_GET['user_status'] != ''){
                if($_GET['user_status'] != 'all'){
                    if($_GET['user_status'] == 'satisfied'){
                        $query .= " AND  user_review = 1 AND admin_status = 0";
                    }

                    if($_GET['user_status'] == 'not_satisfied'){
                        $query .= " AND user_review = 2 AND admin_status = 0 ";
                    }
                }
            }

            $query .= " ORDER BY id DESC ";
            $result = mysqli_query($conn,$query);
            $count = 0;
            if ($result) {
                while($array = mysqli_fetch_array($result)){

                    $tehsilId = $array['tehsil_id'];
                    $tehsilArray = json_decode(get_data_from_id($tehsilId,'tehsil_table',$conn),true);

                    $blockId = $array['block_id'];
                    $blockArray = json_decode(get_data_from_id($blockId,'block_table',$conn),true);


                    if($array['department_id'] == 0 || $array['department_id'] == '' || $array['department_id'] == NULL){
                        $department = '-' ;
                    }
                    else{
                        $departmentId = $array['department_id'];
                        $departmentArray = json_decode(get_data_from_id($departmentId,'department_table',$conn),true);
                        $department = $departmentArray['department_name'];
                    }

                    if($array['complaint_type_id'] == 0 || $array['complaint_type_id'] == '' || $array['complaint_type_id'] == NULL){
                        $complaintType = '-' ;
                    }
                    else{
                        $complaintId = $array['complaint_type_id'];
                        $complaintArray = json_decode(get_data_from_id($complaintId,'complaint_type_table',$conn),true);
                        $complaintType = $complaintArray['type_complaint'];
                    }

                    $userId = $array['user_id'];
                    $userArray = json_decode(get_data_from_id($userId,'user_table',$conn),true);
                    $userName = $userArray['full_name'];

                    if($userArray['email'] == '' || $userArray['email'] == NULL){
                        $email = '-';
                    }
                    else{
                        $email = " ".$userArray['email']." ";
                    }

                    if($userArray['mobile'] == '' || $userArray['mobile'] == NULL){
                        $mobile = "-";
                    }
                    else{
                        $mobile = " ".$userArray['mobile']." ";
                    }

                    if($array['officer_id'] == 0 || $array['officer_id'] == NULL){
                        $officerName = '-';
                    }
                    else{
                        $officerArray = json_decode(get_data_from_id($array['officer_id'], 'user_table',$conn),true);
                        $officerName = $officerArray['full_name'];
                    }

                    if($array['status_flag'] != 0){
                        if($array['user_review'] == 1 && $array['admin_status'] == 0 || $array['admin_status'] == 1){
                            $status = 'निस्तारित';
                        }
                        elseif($array['user_review'] == 2 || $array['admin_status'] == 2){
                            $status = 'नोट रिसॉल्व्ड';
                        }
                        elseif($array['user_review'] == 0){
                            $status = 'पेंडिंग फॉर रिव्यू';
                        }
                    }
                    elseif($array['status_flag'] == 0){
                            $status = 'लंबित';
                    }
                    
                    $count++;
                    echo "
                        <tr>
                            <td>".$count."</td>
                            <td>".$array['complaint_id']."</td>
                            <td>".date("d/m/Y", strtotime($array['create_date']))."</td>
                            <td>".$tehsilArray['tehsil_name']."</td>
                            <td>".$blockArray['block_name']."</td>
                            <td>".$department."</td>
                            <td>".$complaintType."</td>
                            <td>".$userName."</td>
                            <td>".$mobile."</td>
                            <td>".$email."</td>
                            <td>".$officerName."</td>
                            <td>".$officerArray['mobile']."</td>
                            <td>".$status."</td>
                        </tr>";
                }
            }

        echo '</table>';
    }

    if($_GET['type'] == 'officers'){
        header("Content-Disposition: attachment; filename=officers.xls");  

        echo '<table border="1">
            <tr>
                <th>क्र0सं0</th>
                <th>अधिकारी का नाम</th>
                <th>अधिकारी का पदनाम </th>
                <th>अधिकारी का मोबाईल नम्बर</th>
                <th>ई-मेल  </th>
                <th>सुपर वाईजर का नाम </th>
                <th>सुपरवाईजर का मोबाईल नम्बर</th>
                <th>ई-मेल</th>
                <th>आंवटित ग्राम पंचायत</th>
                <th>कुल प्राप्त शिकायतें </th>
                <th>कुल लंबित शिकायतें </th>
                <th>कुल निस्तारित शिकायतें </th>
                <th>प्रतिक्रिया हेतु लंबित शिकाय</th>
            </tr>';
            
            $getQuery = "SELECT * FROM user_table WHERE delete_flag = '0' AND access_token ='officer' ";
            $getResult = mysqli_query($conn, $getQuery);
            $getCount = 0;

            if(mysqli_num_rows($getResult) > 0){
                while($getArray = mysqli_fetch_array($getResult)){
                    $getCount++;

                    if($getArray['email'] == '' || $getArray['email'] == NULL){
                        $email = '-';
                    }
                    else{
                        $email = " ".$getArray['email']." ";
                    }

                    $linkQuery = "SELECT * FROM link_officer_table WHERE officer_id = '".$getArray['id']."'";
                    $linkResult = mysqli_query($conn, $linkQuery);
                    $linkCount = mysqli_num_rows($linkResult);

                    if($getArray['supervisor_id'] != '' || $getArray['supervisor_id'] != NULL){
                        $supervisorArray = json_decode(get_data_from_id($getArray['supervisor_id'],'user_table',$conn),true);
                        $supervisorName = $supervisorArray['full_name'];
                        $supervisorMobile = $supervisorArray['mobile'];
                        if($supervisorArray['email'] == '' || $supervisorArray['email'] == NULL){
                            $supervisorEmail = '-';
                        }
                        else{
                            $supervisorEmail = " ".$supervisorArray['email']." ";
                        }
                    }
                    else{
                        $supervisorEmail = '';
                        $supervisorName = '';
                        $supervisorMobile = '';
                    }

                    $linkOfficerQuery = " SELECT GROUP_CONCAT(' ',department_table.department_name) as department, link_officer_table.officer_id, department_table.id, department_table.delete_flag, department_table.department_name FROM `link_officer_table` JOIN department_table ON link_officer_table.department_id = department_table.id WHERE department_table.delete_flag = 0 AND link_officer_table.delete_flag = 0 AND officer_id = '".$getArray['id']."' GROUP BY officer_id ";
                    $linkOfficerResult = mysqli_query($conn, $linkOfficerQuery);
                    
                    if(mysqli_num_rows($linkOfficerResult) > 0){
                        while($linkOfficerArray = mysqli_fetch_array($linkOfficerResult)){
                            $department = $linkOfficerArray['department'];
                        }
                    }
                    else{
                        $department = '-';
                    }

                    $complaintsQuery = " SELECT GROUP_CONCAT(id) as complaint_id FROM `complaint_table` WHERE officer_id = '".$getArray['id']."' ";
                    $complaintResult = mysqli_query($conn, $complaintsQuery);
                    $complaintArray = mysqli_fetch_array($complaintResult);
                    $complaintId =  $complaintArray['complaint_id'];

                    if($complaintId != NULL){
                        $solvedQuery = " SELECT COUNT(id) as solved FROM complaint_table WHERE (id IN (".$complaintId.") OR officer_id = '".$getArray['id']."') AND (admin_status = 1 OR (status_flag IN (0,1,2) AND user_review = 1))";

                        $totalQuery = " SELECT COUNT(id) as total FROM complaint_table WHERE (id IN (".$complaintId.") OR officer_id = '".$getArray['id']."')";
                        
                        $pendingQuery = " SELECT COUNT(id) as pending FROM complaint_table WHERE (id IN (".$complaintId.") OR officer_id = '".$getArray['id']."') AND  (status_flag = 0 AND admin_status = 0)";

                        $unsolvedQuery = " SELECT COUNT(id) as unsolved FROM complaint_table WHERE (id IN (".$complaintId.") OR officer_id = '".$getArray['id']."') AND ((admin_status = 2) OR (status_flag = 2 AND user_review = 0)) ";

                        $reviewQuery = " SELECT COUNT(id) as review FROM complaint_table WHERE (id IN (".$complaintId.") OR officer_id = '".$getArray['id']."') AND user_review = 0 AND admin_status = 0 AND status_flag != 0 ";
                    }
                    else{
                        $solvedQuery = " SELECT COUNT(id) as solved FROM complaint_table WHERE (officer_id = '".$getArray['id']."') AND (admin_status = 1 OR (status_flag IN (0,1,2) AND user_review = 1))";

                        $totalQuery = " SELECT COUNT(id) as total FROM complaint_table WHERE (officer_id = '".$getArray['id']."')";
                        
                        $pendingQuery = " SELECT COUNT(id) as pending FROM complaint_table WHERE (officer_id = '".$getArray['id']."') AND  (status_flag = 0 AND admin_status = 0)";

                        $unsolvedQuery = " SELECT COUNT(id) as unsolved FROM complaint_table WHERE (officer_id = '".$getArray['id']."') AND ((admin_status = 2) OR (status_flag = 2 AND user_review = 0)) ";

                        $reviewQuery = " SELECT COUNT(id) as review FROM complaint_table WHERE officer_id = '".$getArray['id']."' AND user_review = 0 AND admin_status = 0 AND status_flag != 0 ";
                    }

                    $result = mysqli_query($conn, $solvedQuery);
                    $totalResult = mysqli_query($conn, $totalQuery);
                    $pendingResult = mysqli_query($conn, $pendingQuery);
                    $unsolvedResult = mysqli_query($conn, $unsolvedQuery);
                    $reviewResult = mysqli_query($conn, $reviewQuery);

                    $totalArray = mysqli_fetch_array($totalResult);
                    $solvedArray = mysqli_fetch_array($result);
                    $pendingArray = mysqli_fetch_array($pendingResult);
                    $unsolvedArray = mysqli_fetch_array($unsolvedResult);
                    $reviewArray = mysqli_fetch_array($reviewResult);

                    echo "<tr>
                            <td>".$getCount."</td>
                            <td>".$getArray['full_name']."</td>
                            <td>".$getArray['designation']."</td>
                            <td>".$getArray['mobile']."</td>
                            <td>".$email."</td>
                            <td>".$supervisorName."</td>
                            <td>".$supervisorMobile."</td>
                            <td>".$supervisorEmail."</td>
                            </td>
                            <td>".$department."</td>
                            <td>".$totalArray['total']."</td>
                            <td>".$pendingArray['pending']."</td>
                            <td>".$solvedArray['solved']."</td>
                            <td>".$reviewArray['review']."</td>
                        </tr>";
                }
            }

        echo '</table>';
    }

    if($_GET['type'] == 'attendance'){
        header("Content-Disposition: attachment; filename=officers-attendance.xls");  

        $from_date_temp = $_GET['from_date'];
        $to_date_temp = $_GET['to_date'];

        $from_date = $_GET['from_date'];
        $to_date = $_GET['to_date'];

        echo "<table border='1'>";
            echo"<tr>
                <th rowspan = '2'>अधिकारी का नाम</th>
                <th rowspan = '2'>मोबाइल नंबर</th>
                <th rowspan = '2'>पदनाम </th>";
                while ($from_date <= $to_date) {
                    echo" <th colspan='4'>उपस्थिति दिनांक <br>".date('d-m-Y', strtotime($from_date))."</th>";

                    $from_date = date('Y-m-d', strtotime("+1 day", strtotime($from_date)));
                }
            echo"</tr>";

            $from_date = $from_date_temp;

            echo"<tr>";
                while ($from_date <= $to_date) {
                    echo" <th>कार्यालय आने का समय</th>
                        <th>कार्यालय आने का स्थान</th>
                        <th>कार्यालय जाने का समय</th>
                        <th>कार्यालय जाने का स्थान</th>";

                    $from_date = date('Y-m-d', strtotime("+1 day", strtotime($from_date)));
                }
            echo"</tr>";

            $from_date = $from_date_temp;
            
            $selectQuery = " SELECT GROUP_CONCAT(id) as officerId from user_table WHERE access_token = 'officer' AND delete_flag = 0 ";
            $selectResult = mysqli_query($conn, $selectQuery);
            $selectArray = mysqli_fetch_array($selectResult);
            
            $officerId = $selectArray['officerId'];
            $officer_id = explode(',', $officerId);

            foreach ($officer_id as $key => $value) {
                $officerArray = json_decode(get_data_from_id($value, 'user_table', $conn), true);
                
                echo "<tr>
                        <td>".$officerArray['full_name']."</td>
                        <td>".$officerArray['mobile']."</td>
                        <td>".$officerArray['designation']."</td>";

                        while ($from_date <= $to_date) {
                            $query = "SELECT * FROM attendance_table WHERE attendance_date = '$from_date' AND officer_id = '$value' ";
                            $result = mysqli_query($conn, $query);

                            if(mysqli_num_rows($result) > 0){
                                $array = mysqli_fetch_array($result);
                                    
                                if($array['in_time'] != '' || $array['in_time'] != NULL){
                                    echo"<td>".date('g:i a', strtotime($array['in_time']))."</td>
                                        <td>".$array['in_time_location']."</td>";
                                }
                                else{
                                    echo "<td> N/A</td>";
                                }
                                if($array['out_time'] != '' || $array['out_time'] != NULL){
                                    echo "<td>".date('g:i a', strtotime($array['out_time']))."</td>
                                    <td>".$array['out_time_location']."</td>";
                                }
                                else{
                                    echo "<td> N/A</td>
                                    <td> N/A</td>";
                                }
                            }
                            else{
                                echo "<td> N/A</td>
                                    <td> N/A</td>
                                    <td> N/A</td>
                                    <td> N/A</td>";
                            }
                           
                            $from_date = date('Y-m-d', strtotime("+1 day", strtotime($from_date)));
                        }
                
                echo "</tr>";

                $from_date = $from_date_temp;
            }

        echo "</table>";
    }

    exit();

?>