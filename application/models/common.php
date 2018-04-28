<?php

Class Common extends CI_Model {

    // insert database
    function insert_data($data, $tablename) {
        if ($this->db->insert($tablename, $data)) {
            return true;
        } else {
            return false;
        }
    }

    // insert database
    function insert_data_getid($data, $tablename) {
        if ($this->db->insert($tablename, $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    // update database
    function update_data($data, $tablename, $columnname, $columnid) {
        $this->db->where($columnname, $columnid);
        if ($this->db->update($tablename, $data)) {
            return true;
        } else {
            return false;
        }
    }
    
    // update database multiple where
    function update_data_multiple_where($data,$tablename,$where)
    {
        $this->db->where($where);
        if($this->db->update($tablename,$data))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    // select data using colum id
    function select_database_id($tablename, $columnname, $columnid, $data = '*') {
        $this->db->select($data);
        $this->db->where($columnname, $columnid);
        $query = $this->db->get($tablename);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    // multiple where 
    // select data using colum id
    function select_database_by_muliple_where($tablename, $condition, $data = '*', $orderby = '', $sortby = '') {
        $this->db->select($data);
        $this->db->where($condition);
        if ($orderby != '' && $sortby != "") {
            $this->db->order_by($orderby, $sortby);
        }
        if ($orderby != "" && $sortby == '') {
            $this->db->order_by($orderby, 'ASC');
        }
        $query = $this->db->get($tablename);
        //echo $this->db->last_query(); exit;
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function get_data_all($tablename) {
        $this->db->from($tablename);
        $result = $this->db->get();
        return $result->result_array();
    }

    // delete data
    function delete_data($tablename, $columnname, $columnid) {
        $this->db->where($columnname, $columnid);
        if ($this->db->delete($tablename)) {
            return true;
        } else {
            return false;
        }
    }
    
    // delete data multiple where
    function delete_data_multiple_where($tablename,$where)
    {
        $this->db->where($where);
        if($this->db->delete($tablename))
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    // change status
    function change_status($data, $tablename, $columnname, $columnid) {
        $this->db->where($columnname, $columnid);
        if ($this->db->update($tablename, $data)) {
            return true;
        } else {
            return false;
        }
    }

    // check unique avaliblity
    function check_unique_avalibility($tablename, $columname1, $columnid1_value, $columname2 = '', $columnid2_value = '', $condition_array = array()) {
        if ($columnid2_value != '') {
            $this->db->where($columname2 . " !=", $columnid2_value);
        }
        $this->db->where($columname1, $columnid1_value);

        if (!empty($condition_array)) {
            foreach ($condition_array as $field_name => $field_value) {
                $this->db->where($field_name, $field_value);
            }
        }

        $query = $this->db->get($tablename);

        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            echo FALSE;
        }
    }

    //get all record 
    function get_all_category($tablename, $data = '*', $sortby = '', $orderby = '') {
        $this->db->select($data);
        $this->db->from($tablename);
        $this->db->where('status', 'Enable');
        $this->db->where('isdeleted', 'No');

        if ($sortby != '' && $orderby != "") {
            $this->db->order_by($sortby, $orderby);
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    //get all record 
    function get_all_record($tablename, $data = '*', $sortby = '', $orderby = '') {
        $this->db->select($data);
        $this->db->from($tablename);

        if ($sortby != '' && $orderby != "") {
            $this->db->order_by($sortby, $orderby);
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    //get record 
    function get_record($tablename, $fieldname, $value) {
        $this->db->select('*');
        $this->db->from($tablename);
        $this->db->where($fieldname, $value);

        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    //table records count
    function get_count_of_table($table) {

        $query = $this->db->get($table)->num_rows();


        return $query;
    }

    //table records count by id
    function get_count_of_table_by_id($table, $fieldname, $id) {
        $this->db->where($fieldname, $id);
        $query = $this->db->get($table)->num_rows();


        return $query;
    }

    //table records count by type
    function get_count_of_table_by_type($table, $type) {

        $this->db->where('usertype', $type);


        $query = $this->db->get($table)->num_rows();


        return $query;
    }

    //-----------------sending mail when status has been changed ---------------------//
    function mailForChangeStatus($mailformatid = "", $status = "", $data = array()) {

        $mail = $this->get_email_byid($mailformatid);
        $subject = $mail[0]['varsubject'];
        $mailformat = $mail[0]['varmailformat'];

        $sitename = $this->common->get_setting_value(1);
        $siteurl = $this->common->get_setting_value(2);
        $site_email = $this->common->get_setting_value(5);
        $this->load->library('email');

        $this->email->from($site_email, $sitename);
        $this->email->to($data[0]);
        $this->email->subject($subject);
        $mail_body = str_replace("%firstname%", ucfirst($data[1]), str_replace("%status%", $status, str_replace("%sitename%", $sitename, str_replace("%siteurl%", $siteurl, stripslashes($mailformat)))));
        $this->email->message($mail_body);
    }

    //Function for getting all Settings
    function get_all_setting($sortby = 'settingid', $orderby = 'ASC') {
        //Ordering Data
        $this->db->order_by($sortby, $orderby);

        //Executing Query
        $query = $this->db->get('setting');

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    //Getting setting value for editing By id
    function get_setting_byid($intid) {
        $query = $this->db->get_where('setting', array('settingid' => $intid));

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    //Getting setting value By id
    function get_setting_value($id) {
        $query = $this->db->get_where('setting', array('settingid' => $id));
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            return nl2br(($result[0]['settingvalue']));
        } else {
            return false;
        }
    }

    //Getting setting field name By id
    function get_setting_fieldname($intid) {
        $query = $this->db->get_where('setting', array('settingid' => $intid));

        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            return ($result[0]['title']);
        } else {
            return false;
        }
    }

    function get_email_byid($id) {

        $query = $this->db->get_where('mail_templates', array('id' => $id));

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function get_admin_detail($fields, $admin_id) {
        $this->db->select($fields);
        $this->db->where('admin_id', $admin_id);
        $query = $this->db->get('admin');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function get_admin_data($fields, $admin_id) {
        $this->db->select($fields);
        $this->db->where('admin_id', $admin_id);
        $query = $this->db->get('admin');
        if ($query->num_rows() > 0) {
            $res = $query->result_array();
            return $res[0][$fields];
        } else {
            return array();
        }
    }

    function get_mail_byid($emailid) {
        $mail = $this->db->get_where('email_format', array('emailid' => $emailid));
        if ($mail->num_rows() > 0) {
            return $mail->result_array();
        } else {
            return array();
        }
    }

    public function get_user_data() {
        $session_data = $this->session->userdata('userdata');
        $museum_id = $session_data['museum_id'];
        $this->db->select('u.*');
        $this->db->from('user u');
        $this->db->where('u.user_active !=', 'Delete');
        $this->db->where('u.museum_id', $museum_id);
        $this->db->where_not_in('u.user_login_with', 'Guest');
        $this->db->order_by('u.user_id', 'DESC');
        $result = $this->db->get();
        return $result->result_array();
    }

    public function get_user_data_by_userid($userid) {
        $this->db->select('u.*');
        $this->db->from('user u');
        $this->db->where('u.user_active !=', 'Deleted');
        $this->db->where('u.user_id', $userid);
        $result = $this->db->get();
        return $result->result_array();
    }

    function select_data_by_condition($tablename, $contition_array = array(), $data = '*', $sortby = '', $orderby = '', $limit = '', $offset = '', $join_str = array()) {
        $this->db->select($data);
        //if join_str array is not empty then implement the join query
        if (!empty($join_str)) {
            foreach ($join_str as $join) {
                if ($join['join_type'] == '') {
                    $this->db->join($join['table'], $join['join_table_id'] . '=' . $join['from_table_id']);
                } else {
                    $this->db->join($join['table'], $join['join_table_id'] . '=' . $join['from_table_id'], $join['join_type']);
                }
            }
        }

        //condition array pass to where condition
        $this->db->where($contition_array);


        //Setting Limit for Paging
        if ($limit != '' && $offset == 0) {
            $this->db->limit($limit);
        } else if ($limit != '' && $offset != 0) {
            $this->db->limit($limit, $offset);
        }
        //order by query
        if ($sortby != '' && $orderby != '') {
            $this->db->order_by($sortby, $orderby);
        }

        $query = $this->db->get($tablename);
        //if limit is empty then returns total count
        if ($limit == '') {
            $query->num_rows();
        }
        //if limit is not empty then return result array
        return $query->result_array();
    }

    public function multipleEvent($id, $status_columnname, $value, $columname, $tablename) {
        if ($value == "Enable") {
            $data = array($status_columnname => 'Enable');
            $this->db->where_in($columname, $id);
            if ($this->db->update($tablename, $data)) {
                return true;
            } else {
                return false;
            }
        }
        if ($value == "Disable") {
            $data = array($status_columnname => 'Disable');
            $this->db->where_in($columname, $id);
            if ($this->db->update($tablename, $data)) {
                return true;
            } else {
                return false;
            }
        }
        if ($value == "Delete") {
            $data = array($status_columnname => 'Delete');
            $this->db->where_in($columname, $id);
            if ($this->db->update($tablename, $data)) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function multipleDeleteEvent($id, $value, $columname, $tablename) {
        if ($value == "Delete") {
            $this->db->where_in($columname, $id);
            if ($this->db->delete($tablename)) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function check_subscription($museum_id) {

    }

    function check_user_avalibility($email, $museum_id, $userid) {
        if ($userid != '') {
            $this->db->where('user_id !=', $userid);
        }
        $this->db->where('user_email', $email);
        $this->db->where('museum_id', $museum_id);
        $this->db->where('user_active !=', 'Delete');
        $query = $this->db->get('user');
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function check_code_avalibility($code, $location_id) {
        if ($location_id != '') {
            $this->db->where('location_id !=', $location_id);
        }
        $this->db->where('museum_code', $code);
        $this->db->where('location_active !=', 'Delete');
        $query = $this->db->get('museum_location');
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function get_user_wishlist($user_id) {
        $res = array();
        $this->db->select('ml.location_name,ml.location_id, d.dept_name');
        $this->db->from('location_wishlist lw');
        $this->db->join('museum_location ml', 'ml.location_id= lw.location_id', 'left');
        $this->db->join('department d', 'd.dept_id= ml.dept_id', 'left');
        $this->db->where('ml.location_active !=', 'Delete');
        $this->db->where('lw.user_id', $user_id);
        $result = $this->db->get();
        $result = $result->result_array();
        if (!empty($result)) {
            for ($i = 0; $i < count($result); $i++) {

                $this->db->select('url');
                $this->db->from('location_media');
                $this->db->where('location_id', $result[$i]['location_id']);
                $this->db->where('media_type', "Image");
                $this->db->limit(1);
                $image = $this->db->get();
                $image = $image->result_array();


                $new_img = "";
                if (!empty($image[0]['url'])) {
                    $new_img = $image[0]['url'];
                }

                $res[] = array("location_id" => $result[$i]['location_id'],
                    "dept_name" => $result[$i]['dept_name'],
                    "location_name" => $result[$i]['location_name'],
                    "image" => $new_img,
                );
            }
        }
        return $res;
    }

    function museum_time_spent($museum_id) {
        $average_week_time = '0';
        $average_month_time = '0';
        $average_year_time = '0';

        $date = date("Y-m-d");
        $year = date("Y");
        $month = date("m");

        $res = array();
        $this->db->select('sum(time) as time, count( user_id) as user_id');
        $this->db->from('museum_total_time_spent');
        $this->db->where('museum_id', $museum_id);
        $this->db->where('year(createddate)', $year);
        $result = $this->db->get();
        $year_total_minute = $result->result_array();

        if (!empty($year_total_minute[0]['time'])) {
            //print_r($year_total_minute);
            //exit;
            $year_time = $year_total_minute[0]['time'] / 365;

            $average_year_time = $year_time / $year_total_minute[0]['user_id'];
        }
        //--------month ---- 

        $this->db->select('sum(time) as time, count( user_id) as user_id');
        $this->db->from('museum_total_time_spent');
        $this->db->where('museum_id', $museum_id);
        $this->db->where('month(createddate)', $month);
        $result = $this->db->get();
        $month_total_minute = $result->result_array();

        if (!empty($month_total_minute[0]['time'])) {
            $month_time = $month_total_minute[0]['time'] / 30;

            $average_month_time = $month_time / $month_total_minute[0]['user_id'];
        }
        //-------- week ---

        $week_data = array();
        $today = date('Y-m-d');
        $week = date("W", strtotime($today));
        $year = date("Y", strtotime($today));
        $weekdates = $this->getWeek($week, $year);
        $startdate = $weekdates['start'];
        $enddate = $weekdates['end'];


        $this->db->select('sum(time) as time, count( user_id) as user_id');
        $this->db->from('museum_total_time_spent');
        $this->db->where('createddate >=', $startdate);
        $this->db->where('museum_id', $museum_id);
        $this->db->where('createddate <=', $enddate);
        $result = $this->db->get();
        $week_total_minute = $result->result_array();

        if (!empty($week_total_minute[0]['time'])) {

            //print_r($week_total_minute);
            //exit;
            $week_time = $week_total_minute[0]['time'] / 7;

            $average_week_time = $week_time / $week_total_minute[0]['user_id'];
        }

        return $result = array("year" => $average_year_time, "month" => $average_month_time, "week" => $average_week_time);
    }

    function getWeek($week, $year) {
        $dto = new DateTime();
        $result['start'] = $dto->setISODate($year, $week, 0)->format('Y-m-d');
        $result['end'] = $dto->setISODate($year, $week, 6)->format('Y-m-d');
        return $result;
    }

    function get_beacon($tablename = 'beacon', $museum_id, $beacon_active = 'Enable', $beacon_status = 'Deallocated', $beacon_id) {
        $this->db->select('beacon_id,beacon_minor,beacon_major');

        if ($beacon_id != '') {
            $this->db->where("((beacon_museum_id='$museum_id' AND beacon_active='$beacon_active' AND beacon_status='$beacon_status' ) OR (beacon_id =  '$beacon_id'))");
        } else {
            $this->db->where('beacon_museum_id', $museum_id);
            $this->db->where('beacon_active', $beacon_active);
            $this->db->where('beacon_status', $beacon_status);
        }
        $query = $this->db->get($tablename);
//        echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function get_beacon_not_in($tablename = 'beacon', $museum_id, $beacon_active = 'Enable', $beacon_status = 'Deallocated', $beacon_id, $entry_id, $exit_id) {
        $this->db->select('beacon_id,beacon_minor,beacon_major');

        if ($beacon_id != '') {
            $this->db->where("(beacon_museum_id='$museum_id' AND beacon_active='$beacon_active' AND beacon_status='$beacon_status' OR beacon_id IN('$entry_id','$exit_id'))");
        } else {
            $this->db->where('beacon_museum_id', $museum_id);
            $this->db->where('beacon_active', $beacon_active);
            $this->db->where('beacon_status', $beacon_status);
        }
        $this->db->where_not_in('beacon_id', $beacon_id);
        $query = $this->db->get($tablename);
//        echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function get_museum() {
        $this->db->select('museum_id');
        $this->db->where('museum_active', 'Enable');
        $query = $this->db->get('museum');

        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function get_time_spent_by_hour($start_time, $end_time, $museum_id) {

        //echo "hi";
        $this->db->select('*');
        $this->db->where('start_date BETWEEN "' . $start_time . '" AND " ' . $end_time . '" ');
        $this->db->where('museum_id', $museum_id);
        $this->db->where('hour', "No");
        $query = $this->db->get('time_spent');
        // echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function get_time_spent($start_date, $museum_id) {
        $thisfunction->db->select('*');
        $this->db->where('date(start_date)', $start_date);
        $this->db->where('museum_id', $museum_id);
        $this->db->where('day', "No");
        $query = $this->db->get('time_spent');
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function get_time_spent_by_month($m, $y, $museum_id) {
        $this->db->select('*');
        $this->db->where('month(start_date)', $m);
        $this->db->where('year(start_date)', $y);
        $this->db->where('museum_id', $museum_id);
        $this->db->where('month', "No");
        $query = $this->db->get('time_spent');
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function get_time_spent_by_week($startdate, $enddate, $museum_id) {
        $this->db->select('*');
        $this->db->where('date(start_date) BETWEEN "' . $startdate . '" AND " ' . $enddate . '" ');
        $this->db->where('museum_id', $museum_id);
        $query = $this->db->get('time_spent');
        $this->db->where('week', "No");
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    function get_current_year($Y) {

        $this->db->select('*');
        $this->db->where('year', $Y);
        $query = $this->db->get('year');
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {

            $year_data = array(
                'year' => date('Y')
            );

            $this->db->insert('year', $year_data);

            $this->db->select('*');
            $this->db->where('year', $Y);
            $query = $this->db->get('year');
            //echo $this->db->last_query();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return array();
            }
        }
    }

    function get_current_week($current_week, $year_id) {

        $this->db->select('*');
        $this->db->where('week', $current_week);
        $this->db->where('year_id', $year_id);
        $query = $this->db->get('week');
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {

            $year_data = array(
                'year_id' => $year_id,
                'week' => $current_week
            );

            $this->db->insert('week', $year_data);

            $this->db->select('*');
            $this->db->where('week', $current_week);
            $this->db->where('year_id', $year_id);
            $query = $this->db->get('week');
            //echo $this->db->last_query();
            if ($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return array();
            }
        }
    }

    function update_otp_data($data, $tablename, $columnname, $columnid) {
        $this->db->where($columnname, $columnid);
        $this->db->where('user_type', 'Museum');
        if ($this->db->update($tablename, $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function get_notification_msg($museum_id) {
        $this->db->select('*');
        $this->db->from('notification');
        $this->db->where('museum_id', $museum_id);
        $this->db->order_by("id", "desc");
        $result = $this->db->get();
        return $result->result_array();
    }
    
    public function send_sms($sms_mobile, $sms_message) {
        
        $SMSgatewayUser = "empdash";
        $SMSgatewayPassword = "123456";
        $SMSgatewaySender = "CONCAB";
        $SMSgatewayPriority = "ndnd";
        $SMSgatewaySType = "normal";
        $SMSgatewayLink = 'http://bhashsms.com/api/sendmsg.php';
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $SMSgatewayLink);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "user=$SMSgatewayUser&pass=$SMSgatewayPassword&sender=$SMSgatewaySender&phone=$sms_mobile&text=$sms_message&priority=$SMSgatewayPriority&stype=$SMSgatewaySType");
        $outputsms = curl_exec($ch);
        curl_close($ch); // Close CURL

        return $outputsms;
    }

}
