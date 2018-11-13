<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('DBModel');
    }

//	------------------- Function to load View with default Data -------------------
    public function viewpoint($view, $data = array())
    {
        $this->db->select('hostel_id,hostel_name');
        $query = $this->db->get('hostel_info');
        $top_hostels = $query->result();

        $qry = $this->db->query
        ("
          SELECT `full_title`, COUNT(`id`) AS `notification`,`missing_date` FROM notifications
          WHERE `status` = '1'
          GROUP BY `notification_for`,`missing_date`
        ");
        $notifications = $qry->result();

        $current_uri = $this->uri->segment(1);
        if ($this->uri->segment(2) != "") {
            $parms = '/'.$this->uri->segment(2);
        } else {
            $parms='';
        }
        $restricted_uri = array
        (
            'update-hostel-info','update-room-info','update-worker-info','update-member-info','update-outside-mess',
            'update-outside-mess'
        );
        if (in_array($current_uri,$restricted_uri)) {
            $uri = '0';
        } else {
            $uri = $current_uri.$parms;
        }

        $this->load->view($view,array_merge(
            array
            (
                'top_hostels'   =>  $top_hostels,
                'current_uri'   =>  $uri,
                'notifications' =>  $notifications
            ),$data));
    }

    public function hostel_session_data() {
        if($this->session->userdata('hostel_session_id')){
            $id = $this->session->userdata('hostel_session_id');
            return $id;
        } else {
            $id = 0;
            return $id;
        }
    }

    public function encrypt_url($string)
    {
        $encryption = $this->encryption->encrypt($string);
        $encrypt = strtr($encryption, array('+' => '.', '=' => '-', '/' => '~'));
        return $encrypt;
    }

    public function decrypt_url($string)
    {
        $decryption = strtr($string, array('.' => '+', '-' => '=', '~' => '/'));
        $decrypt = $this->encryption->decrypt($decryption);
        return $decrypt;
    }

//	------------------- End -------------------

    public function login()
    {
        if ($this->session->has_userdata('login_status')) {
            redirect(base_url() . 'dashboard');
        } else {
            $this->load->view('login_form');
        }
    }

    public function login_check()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        if ($this->DBModel->login_check($username, $password)) {
            $data = $this->DBModel->login_details($username);
            $this->db->select('hostel_id');
            $query = $this->db->get('hostel_info');
            $hostelSessionId = $query->row();
            $session_values = array
            (
                'login_member_id'   => $data->id,
                'login_status'      => '1',
                'member_name'       => $data->first_name,
                'hostel_session_id' => $hostelSessionId->hostel_id,
            );
            $this->session->set_userdata($session_values);
            redirect(base_url() . 'dashboard');
        } else {
            $this->session->set_flashdata('error', 'Username or Password Incorrent.');
            redirect(base_url() . 'main/login');
        }
    }

    public function logout()
    {
        $session_values = array('login_member_id', 'login_status');
        $this->session->unset_userdata($session_values);
        redirect(base_url() . 'login');
    }

    //	------------------- End Login -------------------

    public function index()
    {
        $this->load->view('login_form');
    }

    public function dashboard()
    {
        $hostelId = $this->session->userdata('hostel_session_id');
        $this->db->select('hostel_name');
        $this->db->where('hostel_id',$this->session->userdata('hostel_session_id'));
        $hostelQuery = $this->db->get('hostel_info');
        $activeHostel = $hostelQuery->row();

        $queryActiveMembers = $this->db->query("SELECT `member_id` FROM `member_info` WHERE `status` = '1' AND `hostel_id` = '$hostelId'");
        $activeMembers = $queryActiveMembers->num_rows();

        $queryActiveMess = $this->db->query("SELECT `mess_id` FROM `mess_members` WHERE `status` = '1'");
        $activeMess = $queryActiveMess->num_rows();

        $this->viewpoint('dashboard',
            [
                'activeHostel'  =>  substr($activeHostel->hostel_name,0,10),
                'activeMembers' =>  $activeMembers,
                'activeMess'    =>  $activeMess,
                'active_menu'   =>  'dashboard'
            ]);
    }

    public function profile()
    {
        $this->db->select('username,first_name,last_name,email,mobile_no');
        $qry = $this->db->get('nw_login');
        $profile_data = $qry->row();
        $this->viewpoint('profile', array('profile_data' => $profile_data));
    }

    public function update_profile_details()
    {
        $profile_data = array
        (
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'mobile_no' => $this->input->post('mobile_no')
        );
        $result = $this->DBModel->profile_details_update($profile_data);
        if ($result) {
            $this->session->set_flashdata('msg', 'Profile Update Successfully.');
            redirect(base_url() . 'main/profile');
        } else {

        }
    }

    public function add_new_hostel()
    {
        $this->viewpoint('add_new_hostel',['active_menu'   =>  'hostel_setup']);
    }

    public function update_hostel_info($hostel_id)
    {
        $hostel_id = $this->decrypt_url($hostel_id);
        $query = $this->db->query("SELECT * FROM `hostel_info` WHERE `hostel_id` = '$hostel_id'");
        $hostelInfo = $query->row();
        $hostelInfo->hostel_id = $this->encrypt_url($hostelInfo->hostel_id);

        $this->db->select('*');
        $this->db->where('hostel_id',$hostel_id);
        $query = $this->db->get('hostel_expense');
        $hostelExpense = $query->result();
        $this->viewpoint('add_new_hostel', ['hostelInfo' => $hostelInfo, 'hostelExpense' => $hostelExpense]);
    }

    public function list_hostels()
    {
        $this->db->select('*');
        $this->db->order_by('hostel_id','DESC');
        $table = $this->db->get('hostel_info');
        $listOfhostels = $table->result();
        foreach ($listOfhostels as $listHostel) {
            $listHostel->hostel_id = $this->encrypt_url($listHostel->hostel_id);
        }
        $this->viewpoint('list_hostels',
            [
                'listOfHostels' => $listOfhostels,
                'hostel_json' => json_encode($listOfhostels),
                'active_menu'   =>  'hostel_setup'
            ]);
    }

    public function show_add_new_member_page()
    {
        $id = $this->hostel_session_data();

        $this->db->select('room_id,room_title,rent_per_head');
        $this->db->where('hostel_id',$id);
        $rooms_query = $this->db->get('rooms_info');
        $rooms = $rooms_query->result();

        $this->viewpoint('add_new_member', ['rooms' => $rooms,'rooms_json_date'=>json_encode($rooms)]);
    }

    public function show_list_members_page()
    {
        $id = $this->hostel_session_data();
        $where = "1=1";
        if (isset($_SERVER['REQUEST_METHOD']) == 'POST') {
            if (!empty($this->input->post('member_name'))) {
                $member_name = $this->input->post('member_name');
                $where .= " AND `mi`.`member_name` LIKE '%$member_name%'";
            }

            if (!empty($this->input->post('room_no'))) {
                $room_no = $this->input->post('room_no');
                $where .= " AND `mi`.`room_id` = '$room_no'";
            }
        }

        $this->db->select('room_id,room_title');
        $this->db->where('hostel_id',$id);
        $rooms_query = $this->db->get('rooms_info');
        $rooms = $rooms_query->result();

        $qry = $this->db->query
        ("
            SELECT `mi`.*, `ri`.* 
            FROM `member_info` AS `mi`
            INNER JOIN `rooms_info` AS `ri`
            ON `mi`.`room_id` = `ri`.`room_id`
            WHERE `mi`.`hostel_id` = '$id' AND $where
            ORDER BY `mi`.`status` DESC
        ");
        $members = $qry->result();
        foreach ($members as $member) {
            $member->member_id = $this->encrypt_url($member->member_id);
        }
        $membersJsonData = json_encode($members);
        $this->viewpoint('list_members',
            [
                'members'           => $members,
                'membersJsonData'   => $membersJsonData,
                'member_name'       => $this->input->post('member_name'),
                'room_no'           => $this->input->post('room_no'),
                'active_menu'       => 'hostel_members',
                'rooms'             => $rooms
            ]);
    }

    public function show_update_member_info_page($member_id = '')
    {
        $id = $this->hostel_session_data();
        $hostelMemberId = $this->decrypt_url($member_id);

        $this->db->select('room_id,room_title,rent_per_head');
        $this->db->where('hostel_id',$id);
        $roomsQuery = $this->db->get('rooms_info');
        $rooms = $roomsQuery->result();

        $this->db->select('*');
        $this->db->where('member_id',$hostelMemberId);
        $memberQuery = $this->db->get('member_info');
        $releatedMember = $memberQuery->row();
        $releatedMember->member_id = $this->encrypt_url($releatedMember->member_id);

        $this->viewpoint('add_new_member',
            [
                'releatedMember'    => $releatedMember,
                'rooms'             => $rooms,
                'rooms_json_date'   => json_encode($rooms)
            ]);
    }

    public function show_add_new_room_page()
    {
        $this->db->select('facility_id,facility_title');
        $facilityQuery = $this->db->get('hostel_facilities');
        $allFacilities = $facilityQuery->result();
        $this->viewpoint('add_new_room', ['allFacilities' => $allFacilities]);
    }

    public function show_list_rooms_page()
    {
        $id = $this->hostel_session_data();
        $query = $this->db->query
        ("
            SELECT `ri`.* , `hf`.* 
            FROM `rooms_info` AS `ri` 
            LEFT JOIN `hostel_facilities` AS `hf` 
            ON `ri`.`facility_id` = `hf`.`facility_id`
            WHERE `ri`.`hostel_id` = '$id'
            ORDER BY `ri`.`room_title` ASC
        ");
        $listOfRooms = $query->result();
        foreach ($listOfRooms as $listRoom) {
            $listRoom->room_id = $this->encrypt_url($listRoom->room_id);
        }
        $this->viewpoint('list_rooms', ['listOfRooms' => $listOfRooms,'active_menu' => 'hostel_setup']);
    }

    public function show_update_room_page($room_id)
    {
        $roomId = $this->decrypt_url($room_id);

        $this->db->select('hostel_id,hostel_name');
        $hostelQuery = $this->db->get('hostel_info');
        $allHostels = $hostelQuery->result();

        $this->db->select('facility_id,facility_title');
        $facilityQuery = $this->db->get('hostel_facilities');
        $allFacilities = $facilityQuery->result();

        $this->db->select('*');
        $this->db->where('room_id',$roomId);
        $roomQuery = $this->db->get('rooms_info');
        $relatedRoom = $roomQuery->row();
        $relatedRoom->room_id = $this->encrypt_url($relatedRoom->room_id);

        $this->viewpoint('add_new_room',
            [
                'allHostels'     => $allHostels,
                'allFacilities' => $allFacilities,
                'relatedRoom'   => $relatedRoom
            ]);
    }

    public function show_hostel_payment_page()
    {
        $id = $this->hostel_session_data();
        $this->db->select('room_id, room_title');
        $this->db->where('hostel_id',$id);
        $roomsQuery = $this->db->get('rooms_info');
        $rooms = $roomsQuery->result();
        $month = date("m");
        $year = date("Y");
        $where      = "`mi`.`hostel_id` = '$id' ";

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->input->post('search')) {
                if ($this->input->post('room') != '') {
                    $room_id = $this->input->post('room');
                    $where.= "AND `mi`.`room_id` = '$room_id' ";
                }

                if ($this->input->post('name') != '') {
                    $name = $this->input->post('name');
                    $where.= "AND `mi`.`member_name` LIKE '%$name%' ";
                }

                if ($this->input->post('status') != '') {
                    $status = $this->input->post('status');
                    $where.= "AND `rp`.`status` = '$status' ";
                }

                if ($this->input->post('month') != '') {
                    $month = $this->input->post('month');
                    $where.= "AND MONTH(`rp`.`rent_month`) = '$month' ";
                } else {
                    $where.= "AND MONTH(`rp`.`rent_month`) = '$month' ";
                }

                if ($this->input->post('year') != '') {
                    $year = $this->input->post('year');
                    $where.= "AND YEAR(`rp`.`rent_month`) = '$year' ";
                } else {
                    $where.= "AND YEAR(`rp`.`rent_month`) = '$year'";
                }
            }
        } else {
            $where.= "AND MONTH(`rp`.`rent_month`) = '$month' AND YEAR(`rp`.`rent_month`) = '$year'";
        }

        $min_date = date("Y-m-d",strtotime($year.'-'.$month.'-01'));
        $max_date = date("Y-m-d",strtotime($year.'-'.$month.'-'.cal_days_in_month(CAL_GREGORIAN,$month,$year)));

        $qry  = $this->db->query
        ("
            SELECT `mi`.`member_name`,`mi`.`rent`, `ri`.`room_title`, `rp`.*
            FROM `rent_payments` AS `rp`
            INNER JOIN `member_info` AS `mi`
            ON `rp`.`member_id` = `mi`.`member_id`
            INNER JOIN `rooms_info` AS `ri`
            ON `mi`.`room_id` = `ri`.`room_id`
            WHERE $where
        ");
        $payments = $qry->result();
        foreach ($payments as $pay) {
            $pay->id = $this->encrypt_url($pay->id);
        }
        $this->viewpoint('hostel_payment',
            [
                'payments'  =>  $payments,
                'rooms'     =>  $rooms,
                'month'     =>  $month,
                'year'      =>  $year,
                'min_date'  =>  $min_date,
                'max_date'  =>  $max_date,
                'active_menu' => 'payments'
            ]);
    }

    public function show_bill_payment_page()
    {
        $id = $this->hostel_session_data();
        $this->db->select('room_id, room_title');
        $this->db->where('hostel_id',$id);
        $roomsQuery = $this->db->get('rooms_info');
        $rooms = $roomsQuery->result();
        $month = date("m");
        $year = date("Y");
        $room_id = '';

        $where      = "`ri`.`hostel_id` = '$id' ";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->input->post('search')) {
                if ($this->input->post('room') != '') {
                    $room_id = $this->input->post('room');
                    $where.= "AND `ri`.`room_id` = '$room_id' ";
                }
                if ($this->input->post('month') != '') {
                    $month = $this->input->post('month');
                    $where.= "AND MONTH(`bp`.`sheet_for_month`) = '$month'";
                } else {
                    $where.= "AND MONTH(`bp`.`sheet_for_month`) = '$month'";
                }
                if ($this->input->post('year') != '') {
                    $year = $this->input->post('year');
                    $where.= "AND YEAR(`bp`.`sheet_for_month`) = '$year'";
                } else {
                    $where.= "AND YEAR(`bp`.`sheet_for_month`) = '$year'";
                }
            }
        } else {
            $where.= "AND MONTH(`bp`.`sheet_for_month`) = '$month' AND YEAR(`bp`.`sheet_for_month`) = '$year' ";
        }

        $min_date = date("Y-m-d",strtotime($year.'-'.$month.'-01'));
        $max_date = date("Y-m-d",strtotime($year.'-'.$month.'-'.cal_days_in_month(CAL_GREGORIAN,$month,$year)));

        $billQuery = $this->db->query
        ("
            SELECT `bpp`.`meter_reading` AS `last_reading`,`bp`.*, `f`.*,`ri`.`room_title`,
            `ri`.`bill_amount`,`ri`.`bill_type`,`bp`.`unit_amount`
            FROM `bill_payment` AS `bp`
            INNER JOIN `hostel_facilities` AS `f` ON `bp`.`facility_id` = `f`.`facility_id`
            INNER JOIN `rooms_info` AS `ri` ON `ri`.`room_id` = `bp`.`room_id`
            LEFT JOIN  `bill_payment` AS `bpp` ON `bpp`.`room_id` = `bp`.`room_id`
            WHERE $where 
            AND `bpp`.`sheet_for_month` = DATE_ADD(`bp`.`sheet_for_month`, INTERVAL -1 MONTH)
       ");
        $payments = $billQuery->result();
        $this->viewpoint('bill_payments',
            [
                'payments'   => $payments,
                'rooms'     => $rooms,
                'month'     => $month,
                'year'      => $year,
                'room_id'   => $room_id,
                'min_date'  => $min_date,
                'max_date'  => $max_date,
                'active_menu' => 'payments'
            ]);
    }

    public function show_expense_list_page($type)
    {
        $query = $this->db->query("SELECT * FROM `expense_types` WHERE `status` = '1' AND `type` = '$type'");
        $expenseTypes = $query->result();
        $this->viewpoint('expense_list',
            [
                'expenseTypes' => $expenseTypes,
                'month' =>  date('m'),
                'year'  =>  date('Y'),
                'type'  =>  $type
            ]);
    }

    public function show_daily_expense_page()
    {
        $id = $this->hostel_session_data();
        $month = date('m');
        $year = date('Y');
        $type = "1=1";
        $type_id = "";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!empty($this->input->post('month'))) {
                $month = $this->input->post('month');
            }

            if (!empty($this->input->post('year'))) {
                $year = $this->input->post('year');
            }

            if (!empty($this->input->post('type'))) {
                $type_id = $this->input->post('type');
                $type = "`et`.`expense_type_id` = '$type_id'";
            }
        }

        $this->db->select('*');
        $qry = $this->db->get('expense_types');
        $types = $qry->result();

        $query = $this->db->query
        ("
            SELECT `et`.`title`,`el`.`expense_title`,`el`.`expense_list_id`,`el`.`expense_month`,
            SUM(`ed`.`item_price`) AS `total`
            FROM `expense_list` AS `el` 
            LEFT JOIN `expense_types` AS `et`
            ON `el`.`expense_type_id` = `et`.`expense_type_id`
            LEFT JOIN `expense_details` AS `ed`
            ON `ed`.`expense_list_id` = `el`.`expense_list_id`
            WHERE `el`.`hostel_id` = '$id' AND MONTH(`expense_month`) = '$month' AND YEAR(`expense_month`) = '$year'
            AND `et`.`type` = 'daily' AND $type 
            GROUP BY `el`.`expense_list_id`
            ORDER BY `el`.`expense_list_id` DESC
        ");
        $expenses = $query->result();
        $this->viewpoint('daily_expense',
            [
                'expenses'  => $expenses,
                'month'     => $month,
                'year'      => $year,
                'types'     => $types,
                'type_id'   => $type_id,
                'exp_date'      =>  $year.'-'.$month.'-01',
                'active_menu' => 'expense'
            ]);
    }

    public function show_update_expense_list_page($type, $expenseId)
    {
        $query = $this->db->query("SELECT * FROM `expense_types` WHERE `status` = '1' AND `type` = '$type'");
        $expenseTypes = $query->result();

        $qry = $this->db->query("SELECT * FROM `expense_list` WHERE `expense_list_id` = '$expenseId'");
        $expense = $qry->row();

        $month = date('m',strtotime($expense->expense_month));
        $year = date('Y',strtotime($expense->expense_month));;

        $this->viewpoint('expense_list',
            [
                'expense'       =>  $expense,
                'expenseTypes'  =>  $expenseTypes,
                'month'         =>  $month,
                'year'          =>  $year,
                'type'          =>  $type,
                'list_id'       =>  $expenseId
            ]);
    }

    public function view_expense_list_items($expenseId) {
        $this->db->select('*');
        $this->db->where('expense_list_id',$expenseId);
        $qry = $this->db->get('expense_details');
        $cookingExpenseData = $qry->result();

        header('Content-Type: application/json');
        echo json_encode($cookingExpenseData);
    }


    public function delete_cooking_expense_item() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $deleteId = $this->input->post('delete_id');
            $this->db->select('cooking_expense_id');
            $this->db->where('id',$deleteId);
            $data = $this->db->get('cooking_expense_details');
            $parentId = $data->row();

            $this->db->where('id' , $deleteId);
            $this->db->delete('cooking_expense_details');
            $this->session->set_flashdata('msg', 'Item delete successfully.');
            redirect(base_url() . 'update-cooking-expense/'.$parentId->cooking_expense_id);
        }
    }

    public function show_add_mess_page() {
        $this->viewpoint('mess');
    }

    public function show_list_outside_mess() {
        if (isset($_SERVER['REQUEST_METHOD']) == 'POST') {
            $keyword = $this->input->post('keyword');
            $where = "`name` LIKE '%$keyword%'";
        } else {
            $where = "1=1";
        }
        $query = $this->db->query
        ("
            SELECT * FROM `mess_members` WHERE $where 
            ORDER BY `status` DESC, `created_at` DESC
        ");
        $mess = $query->result();
        foreach ($mess as $m) {
            $m->mess_id = $this->encrypt_url($m->mess_id);
        }
        $this->viewpoint('list_outside_mess',
            [
                'mess' => $mess,
                'keyword'=>$this->input->post('keyword'),
                'active_menu' => 'mess_members'
            ]);
    }

    public function show_update_outside_mess_page($messId) {
        $messId = $this->decrypt_url($messId);
        $query = $this->db->query
        ("
            SELECT * FROM `mess_members` WHERE `mess_id` = '$messId'
        ");
        $mess = $query->row();
        $mess->mess_id = $this->encrypt_url($mess->mess_id);
        $this->viewpoint('mess',['mess' => $mess]);
    }

    public function delete_hostel_expense_item() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $deleteId = $this->input->post('delete_id');
            $this->db->select('hostel_id');
            $this->db->where('hostel_expense_id',$deleteId);
            $data = $this->db->get('hostel_expense');
            $parentId = $data->row();
            $encryptId = $this->encrypt_url($parentId->hostel_id);

            $this->db->where('hostel_expense_id' , $deleteId);
            $this->db->delete('hostel_expense');
            $this->session->set_flashdata('msg', 'Hostel Expense delete successfully.');
            redirect(base_url() . 'update-hostel-info/'.$encryptId);
        }
    }

    public function show_mess_payment_page() {
        $where      = "1 = 1 ";
        $month = date("m");
        $year = date("Y");
        $name = '';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->input->post('search')) {
                if ($this->input->post('name') != '') {
                    $name = $this->input->post('name');
                    $where.= "AND `mm`.`name` LIKE '%$name%' ";
                }

                if ($this->input->post('status') != '') {
                    $status = $this->input->post('status');
                    $where.= "AND `mp`.`pay_status` = '$status' ";
                }

                if ($this->input->post('month') != '') {
                    $month = $this->input->post('month');
                    $where.= "AND MONTH(`mp`.`sheet_for_month`) = '$month' ";
                } else {
                    $where.= "AND MONTH(`mp`.`sheet_for_month`) = '$month' ";
                }

                if ($this->input->post('year') != '') {
                    $year = $this->input->post('year');
                    $where.= "AND YEAR(`mp`.`sheet_for_month`) = '$year'";
                } else {
                    $where.= "AND YEAR(`mp`.`sheet_for_month`) = '$year'";
                }
            }
        } else {
            $where.= "AND MONTH(`mp`.`sheet_for_month`) = '$month' AND YEAR(`mp`.`sheet_for_month`) = '$year'";
        }
        $messPaymentQuery = $this->db->query
        ("
          SELECT `mm`.`name`,`mm`.`start_date`, `mm`.`end_date`,`mm`.`mess_charges`,`mp`.`amount_paid`,
          `mp`.`payment_date`,`mp`.`pay_status`,`mp`.`id`,`mm`.`mess_details`,`mm`.`mobile_no`,`mm`.`mess_id`
          FROM `mess_payment` AS `mp`
          INNER JOIN `mess_members` AS `mm`
          ON `mp`.`mess_id` = `mm`.`mess_id`
          WHERE $where AND `mm`.`status` = '1'
        ");
        $messPayments = $messPaymentQuery->result();
        foreach ($messPayments as $pay) {
            $pay->mess_id = $this->encrypt_url($pay->mess_id);
            $pay->id = $this->encrypt_url($pay->id);
        }
        $this->viewpoint('mess_payments',
            [
                'payments'      =>  $messPayments,
                'forMonth'      =>  $month,
                'forYear'       =>  $year,
                'name'          => $name,
                'active_menu'   => 'mess_members'
            ]);
    }

    public function show_monthly_expense_page()
    {
        $id = $this->hostel_session_data();
        $where = "`he`.`hostel_id` = ".$id." ";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $month = $this->input->post('month');
            $year  = $this->input->post('year');
            $where .= "AND MONTH(`expense_month`) = '$month' AND YEAR(`expense_month`) = '$year' ";
        } else {
            $month = date("m");
            $year  = date("Y");
            $where .= "AND MONTH(`expense_month`) = '$month' AND YEAR(`expense_month`) = '$year' ";
        }
        $query = $this->db->query
        ("
            SELECT `hme`.*, `he`.*
            FROM `hostel_monthly_expense` AS `hme`
            INNER JOIN `hostel_expense` AS `he`
            ON `hme`.`hostel_expense_id` = `he`.`hostel_expense_id`
            WHERE $where
        ");
        $monthlyExpense = $query->result();
        $this->viewpoint('monthly_expense',
            [
                'monthlyExpense'    => $monthlyExpense,
                'forMonth'          => $month,
                'forYear'           => $year,
                'active_menu'   => 'expense'

            ]);
    }

    public function create_new_monthly_expense_sheet() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $hostelId = $this->input->post('hostel_id');
            $sheetDate = $this->input->post('sheet_date');
            $where = "1 = 1 ";
            if($hostelId != "") {
                $where.="AND `hostel_id` = '$hostelId'";
            }
            $query = $this->db->query("SELECT `hostel_expense_id`,`hostel_id` FROM `hostel_expense` WHERE $where");
            $data = $query->result();
            foreach ($data as $monthlyExpense) {
                $dataArray = array
                (
                    'hostel_expense_id'     => $monthlyExpense->hostel_expense_id,
                    'hostel_id'             => $monthlyExpense->hostel_id,
                    'expense_month'         => $sheetDate,
                );
                $this->db->insert('hostel_monthly_expense',$dataArray);
            }
            redirect(base_url() . 'mothly-expense');
        }
    }

    public function switch_hostel(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $hostelId = $this->input->post('active_hostel_id');
            $uri = $this->input->post('redirect_uri');
            $this->session->set_userdata('hostel_session_id', $hostelId);
            redirect(base_url() . $uri);
        }
    }

    public function show_list_worker_page(){
        $id = $this->hostel_session_data();
        $this->db->select('*');
        $this->db->where('hostel_id',$id);
        $query = $this->db->get('hostels_worker');
        $listOfWorkers = $query->result();
        foreach ($listOfWorkers as $list)  {
            $list->worker_id = $this->encrypt_url($list->worker_id);
        }
        $this->viewpoint('list_workers',['listOfWorkers'=>$listOfWorkers,'active_menu' => 'hostel_setup']);
    }

    public function show_add_new_worker_page(){
        $this->viewpoint('add_new_worker');
    }

    public function show_update_worker_page($workerId){
        $workerId = $this->decrypt_url($workerId);
        $this->db->select('*');
        $this->db->where('worker_id',$workerId);
        $query = $this->db->get('hostels_worker');
        $relatedWorkers = $query->row();
        $relatedWorkers->worker_id = $this->encrypt_url($relatedWorkers->worker_id);
        $this->viewpoint('add_new_worker',['relatedWorkers'=>$relatedWorkers]);
    }

    public function show_worker_expense_page(){
        $id = $this->hostel_session_data();
        $where = "`hw`.`hostel_id` = ".$id." ";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $month = $this->input->post('month');
            $year  = $this->input->post('year');
            $where .= "AND MONTH(`expense_month`) = '$month' AND YEAR(`expense_month`) = '$year' ";
        } else {
            $month = date("m");
            $year  = date("Y");
            $where .= "AND MONTH(`we`.`expense_month`) = '$month' AND YEAR(`we`.`expense_month`) = '$year' ";
        }

        $min_date = date("Y-m-d",strtotime($year.'-'.$month.'-01'));
        $max_date = date("Y-m-d",strtotime($year.'-'.$month.'-'.cal_days_in_month(CAL_GREGORIAN,$month,$year)));

        $query = $this->db->query
        ("
            SELECT `hw`.*, `we`.*
            FROM `hostels_worker` AS `hw`
            INNER JOIN `worker_expense` AS `we`
            ON `hw`.`hostel_id` = `we`.`hostel_id`
            WHERE $where
        ");
        $workerExpense = $query->result();
        foreach ($workerExpense as $exp) {
            $exp->id = $this->encrypt_url($exp->id);
        }
        $this->viewpoint('worker_expense',
            [
                'workerExpense' =>  $workerExpense,
                'forMonth'      =>  $month,
                'forYear'       =>  $year,
                'min_date'      =>  $min_date,
                'max_date'      =>  $max_date,
                'active_menu'   => 'expense'
            ]);
    }

    public function view_income_statement() {
        if (isset($_SERVER['REQUEST_METHOD']) == 'POST') {
            $id = $this->hostel_session_data();
            $startDate = $this->input->post('start_date');
            $endDate = $this->input->post('end_date');

            $dailyExpenseQuery = $this->db->query
            ("
                SELECT SUM(`ed`.`item_price`) AS `daily_expense` FROM `expense_details` AS `ed`
                INNER JOIN `expense` AS `e`
                ON `ed`.`expense_id` = `e`.expense_id
                WHERE `e`.`hostel_id` = '$id'
                AND `ed`.`item_date` >= '$startDate'
                AND `ed`.`item_date` <= '$endDate'
            ");
            $countDailyExpense = $dailyExpenseQuery->row();

            $monthlyExpenseQuery = $this->db->query
            ("
                SELECT SUM(`hme`.`amount`) AS `monthly_expense` FROM `hostel_monthly_expense` AS `hme`
                WHERE `hme`.`hostel_id` = '$id'
                AND `hme`.`expense_month` >= '$startDate'
                AND `hme`.`expense_month` <= '$endDate'
            ");
            $countMonthlyExpense = $monthlyExpenseQuery->row();

            $workerExpenseQuery = $this->db->query
            ("
                SELECT SUM(`we`.`paid_amount`) AS `worker_expense` FROM `worker_expense` AS `we`
                WHERE `we`.`hostel_id` = '$id'
                AND `we`.`expense_month` >= '$startDate'
                AND `we`.`expense_month` <= '$endDate'
            ");
            $countWorkerExpense = $workerExpenseQuery->row();

            $rentIcomeQuery = $this->db->query
            ("
                SELECT SUM(`rp`.`paid_amount`) AS `rent_income` FROM `rent_payments` AS `rp`
                INNER JOIN `member_info` AS `mi`
                ON `rp`.`member_id` = `mi`.`member_id`
                WHERE `mi`.`hostel_id` = '$id'
                AND `rp`.`rent_month` >= '$startDate'
                AND `rp`.`rent_month` <= '$endDate'
            ");
            $rentIncome = $rentIcomeQuery ->row();

            $billIcomeQuery = $this->db->query
            ("
                SELECT SUM(`bp`.`paid_amount`) AS `bill_income` FROM `bill_payment` AS `bp`
                INNER JOIN `rooms_info` AS `ri`
                ON `bp`.`room_id` = `ri`.`room_id`
                WHERE `ri`.`hostel_id` = '$id'
                AND `bp`.`sheet_for_month` >= '$startDate'
                AND `bp`.`sheet_for_month` <= '$endDate'
            ");
            $billIncome = $billIcomeQuery ->row();

            $this->viewpoint('income_statement',
                [
                    'dailyExpense'      =>  $countDailyExpense->daily_expense,
                    'monthlyExpense'    =>  $countMonthlyExpense->monthly_expense,
                    'workerExpense'     =>  $countWorkerExpense->worker_expense,
                    'rentIncome'        =>  $rentIncome->rent_income,
                    'billIncome'        =>  $billIncome->bill_income,
                    'startDate'         =>  $startDate,
                    'endDate'           =>  $endDate,
                    'active_menu'       =>  'income_statement'
                ]);
        } else {
            $this->viewpoint('income_statement',['active_menu' => 'income_statement']);
        }
    }

    public function get_worker_expense_log($expense_id, $month, $year){
        $expense_id = $this->decrypt_url($expense_id);
        $log_qry = $this->db->query
        ("
            SELECT `amount`,`operation`,`paid_date` FROM `worker_expense_log`
            WHERE MONTH(`paid_date`) = '$month' AND YEAR(`paid_date`) = '$year'
            AND `expense_id` = '$expense_id'
        ");
        $log = $log_qry->result();
        header('Content-Type: application/json');
        echo json_encode($log);
    }

    public function notifications_updater($notify, $table, $cols = array(), $month, $year){
        if ($month == 1) {
            $month = 12;
            $year = $year -1;
        } else {
            $month = $month - 1;
        }
        $last_date = $year.'-'.$month.'-01';
        $query = $this->db->query
        ("
          SELECT * FROM `$table` 
          WHERE MONTH(`$cols[0]`) = '$month'
          AND YEAR(`$cols[0]`) = '$year'
          AND `$cols[1]` != '1'
        ");
        $result = $query->result();
        foreach ($result as $res) {
            $data = array
            (
                'notification_for'  =>  $notify,
                'missing_id'        =>  $res->$cols[2],
                'missing_date'      =>  $last_date,
                'status'            =>  '1',
            );
            $this->db->insert('notifications',$data);
        }
    }

    public function show_mess_expense_page()
    {
        $id = $this->hostel_session_data();
        $month = date('m');
        $year = date('Y');
        $type = "1=1";
        $type_id = "";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!empty($this->input->post('month'))) {
                $month = $this->input->post('month');
            }

            if (!empty($this->input->post('year'))) {
                $year = $this->input->post('year');
            }

            if (!empty($this->input->post('type'))) {
                $type_id = $this->input->post('type');
                $type = "`et`.`expense_type_id` = '$type_id'";
            }
        }

        $this->db->select('*');
        $this->db->where('type','mess');
        $this->db->where('status','1');
        $qry = $this->db->get('expense_types');
        $types = $qry->result();

        $query = $this->db->query
        ("
            SELECT `et`.`title`,`el`.`expense_title`,`el`.`expense_list_id`,`el`.`expense_month`,
            SUM(`ed`.`item_price`) AS `total`
            FROM `expense_list` AS `el` 
            LEFT JOIN `expense_types` AS `et`
            ON `el`.`expense_type_id` = `et`.`expense_type_id`
            LEFT JOIN `expense_details` AS `ed`
            ON `ed`.`expense_list_id` = `el`.`expense_list_id`
            WHERE `el`.`hostel_id` = '$id' AND MONTH(`expense_month`) = '$month' AND YEAR(`expense_month`) = '$year'
            AND `et`.`type` = 'mess' AND $type 
            GROUP BY `el`.`expense_list_id`
            ORDER BY `el`.`expense_list_id` DESC
        ");
        $expenses = $query->result();
        $this->viewpoint('mess_expense',
            [
                'expenses'  => $expenses,
                'month'     => $month,
                'year'      => $year,
                'types'     => $types,
                'type_id'   => $type_id,
                'active_menu' => 'mess_members'
            ]);
    }

    public function view_mess_statement() {
        if (isset($_SERVER['REQUEST_METHOD']) == 'POST') {
            $startDate = $this->input->post('start_date');
            $endDate = $this->input->post('end_date');

            $messExpenseQuery = $this->db->query
            ("
                SELECT SUM(`item_price`) AS `mess_expense` FROM `expense_details`
                WHERE `expense_list_id` = '0'
                AND `item_date` >= '$startDate'
                AND `item_date` <= '$endDate'
            ");
            $messExpense = $messExpenseQuery->row();

            $messIcomeQuery = $this->db->query
            ("
                SELECT SUM(`amount_paid`) AS `mess_income` FROM `mess_payment`
                WHERE `sheet_for_month` >= '$startDate'
                AND `sheet_for_month` <= '$endDate'
            ");
            $messIncome = $messIcomeQuery->row();

            $this->viewpoint('mess_statement',
                [
                    'messExpense'   =>  $messExpense->mess_expense,
                    'messIncome'    =>  $messIncome->mess_income,
                    'startDate'     =>  $startDate,
                    'endDate'       =>  $endDate,
                    'active_menu'   =>  'mess_members'
                ]);
        } else {
            $this->viewpoint('mess_statement',['active_menu' => 'income_statement']);
        }
    }

    public function remove_entry($redirect, $del, $tbl, $col) {
        $del = $this->decrypt_url($del);
        $this->db->where($col, $del);
        $this->db->delete($tbl);
        $this->session->set_flashdata('msg', 'Entry deleted successfully.');
        redirect(base_url() . $redirect);
    }
}


