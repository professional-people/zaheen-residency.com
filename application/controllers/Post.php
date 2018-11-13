<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
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

    public function hostel_session_data() {
        if($this->session->userdata('hostel_session_id')){
            $id = $this->session->userdata('hostel_session_id');
            return $id;
        } else {
            $id = 0;
            return $id;
        }
    }

    public function add_new_hostel()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = array
            (
                'hostel_name'       => $this->input->post('hostel_name'),
                'no_of_rooms'       => $this->input->post('no_of_rooms'),
                'hostel_address'    => $this->input->post('hostel_address'),
                'other_description' => $this->input->post('other_description'),
                'created_at'        => date("Y-m-d h:i:s"),
                'updated_at'        => date("Y-m-d h:i:s")
            );
            $hostelIdEnc = $this->input->post('hostel_id');
            $hostel_id = $this->decrypt_url($hostelIdEnc);
            if ($hostel_id == '0') {
                $this->db->insert('hostel_info', $data);
                $hostel_id = $this->db->insert_id();
                $status = 'Insert';
            } else {
                if ($hostel_id > 0) {
                    unset($data['created_at']);
                    $this->db->where('hostel_id', $hostel_id);
                    $this->db->update('hostel_info', $data);
                    $status = 'Update';
                }
            }
            $lenght = count($this->input->post('expense_title'));
            for ($i = 0; $i < $lenght; $i++) {
                $expenseData = array
                (
                    'hostel_id'         => $hostel_id,
                    'expense_title'     => $this->input->post('expense_title')[$i],
                    'expense_details'   => $this->input->post('expense_details')[$i],
                    'created_at'        => date("Y-m-d h:i:s"),
                    'updated_at'        => date("Y-m-d h:i:s")
                );
                $hostelExpenseId = $this->input->post('hostel_expense_id')[$i];
                if ($hostelExpenseId > 0) {
                    unset($data['created_at']);
                    $this->db->where('hostel_expense_id', $hostelExpenseId);
                    $this->db->update('hostel_expense', $expenseData);
                } else {
                    $this->db->insert('hostel_expense', $expenseData);
                }
            }
            if ($status == 'Insert') {
                $this->session->set_flashdata('msg', 'Hostel Expense Insert successfully.');
                redirect(base_url() . 'list-hostels');
            } else {
                $this->session->set_flashdata('msg', 'Hostel Expense Update successfully.');
                redirect(base_url() . 'list-hostels');
            }
        }
    }

    public function save_new_member_info()
    {
        $id = $this->hostel_session_data();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $data = array
            (
                'hostel_id' => $id,
                'member_type' => $this->input->post('member_type'),
                'member_deg_comp' => $this->input->post('member_deg_comp'),
                'member_name' => $this->input->post('member_name'),
                'member_phone_no' => $this->input->post('member_phone_no'),
                'member_father_name' => $this->input->post('member_father_name'),
                'member_father_phone_no' => $this->input->post('member_father_phone_no'),
                'father_occupation' => $this->input->post('father_occupation'),
                'cnic' => $this->input->post('cnic'),
                'room_id' => $this->input->post('room_id'),
                'rent' => $this->input->post('rent'),
                'created_at' => date("Y-m-d h:i:s"),
                'updated_at' => date("Y-m-d h:i:s")
            );
            $member_id = $this->input->post('member_id');
            if ($member_id == '0') {
                $this->db->insert('member_info', $data);
                $this->session->set_flashdata('msg', 'Member information saved successfully.');
                redirect(base_url() . 'add-new-member');
            } else {
                $member_id = $this->decrypt_url($member_id);
                unset($data['created_at']);
                $this->db->where('member_id', $member_id);
                $this->db->update('member_info', $data);
                $this->session->set_flashdata('msg', 'Hostel information update successfully.');
                redirect(base_url() . 'list-members');
            }
        } else {
            redirect(base_url() . 'dashboard');
        }
    }

    public function save_room_info()
    {
        $id = $this->hostel_session_data();
        $data = array
        (
            'hostel_id'     => $id,
            'room_title'    => $this->input->post('room_title'),
            'seated'        => $this->input->post('seated'),
            'rent_per_head' => $this->input->post('rent_per_head'),
            'facility_id'   => $this->input->post('facility_id'),
            'bill_type'     => $this->input->post('bill_type'),
            'bill_amount'   => $this->input->post('bill_amount'),
            'created_at'    => date("Y-m-d h:i:s"),
            'updated_at'    => date("Y-m-d h:i:s")
        );
        $room_id = $this->input->post('room_id');
        if ($room_id == '0') {
            $this->db->insert('rooms_info', $data);
            $this->session->set_flashdata('msg', 'Room information saved successfully.');
            redirect(base_url() . 'list-rooms');
        } else {
            $room_id = $this->decrypt_url($room_id);
            unset($data['created_at']);
            $this->db->where('room_id', $room_id);
            $this->db->update('rooms_info', $data);
            $this->session->set_flashdata('msg', 'Room information update successfully.');
            redirect(base_url() . 'list-rooms');
        }
    }

    public function save_rent_payment_info()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id             =   (int)$this->input->post('id');
            $updateId       =   $this->decrypt_url($this->input->post('update_id'));
            $memberRent     =   (int)$this->input->post('member_rent') + 0;
            $paidAmount     =   (int)$this->input->post('paid_amount') + 0;
            $cashReceived   =   (int)$this->input->post('cash_received') + 0;
            $cashDate      =   $this->input->post('cash_date');
            $operation      =   $this->input->post('operation');
            if ($operation == 'add') {
                $paidAmount    =   $paidAmount + $cashReceived;
                $dueAmount     =   $memberRent - $paidAmount;
            } else {
                if ($operation == 'sub') {
                    $paidAmount    =   $paidAmount - $cashReceived;
                    $dueAmount     =   $memberRent - $paidAmount;
                }
            }
            if ($memberRent == $paidAmount) {
                $status = 1;
            } else {
                $status = 2;
            }
            $data = array
            (
                'paid_amount'   => $paidAmount,
                'cash_date'     => $cashDate,
                'status'        => $status,
            );
            $this->db->where('id', $updateId);
            $this->db->update('rent_payments', $data);

            $log = array
            (
                'rent_payment_id' =>  $updateId,
                'cash_received'   =>  $cashReceived,
                'opetaion'        =>  $operation,
                'cash_date'       =>  $cashDate,
            );
            $this->db->insert('rent_payment_log', $log);

            if ($dueAmount == 0) {
                $this->db->where(array('notification_for'=>'rent_payment','missing_id'=>$updateId));
                $this->db->delete('notifications');
            }

            header('Content-Type: application/json');
            $responseArray = array
            (
                'id'            =>  $id,
                'due_amount'    =>  $dueAmount,
                'paid_amount'   =>  $paidAmount,
                'status'        =>  $status
            );
            echo json_encode($responseArray);
        }
    }

    public function add_rent_payment_sheet()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $this->hostel_session_data();

            $month = $this->input->post('month');
            $year = $this->input->post('year');

            if ($month == 1) {
                $last_month = 12;
                $last_year = $year -1;
            } else {
                $last_month = $month - 1;
                $last_year = $year;
            }
            $last_date = $last_year.'-'.$last_month.'-01';

            $qry = $this->db->query
            ("
                SELECT `id` FROM `rent_payments` AS `rp`
                INNER JOIN `member_info` AS `mi`
                ON `mi`.`member_id` = `rp`.`member_id`
                WHERE `mi`.`hostel_id` = '$id' AND MONTH(`rp`.`rent_month`) = '$last_month'
                AND YEAR(`rp`.`rent_month`) = '$last_year'
                AND `rp`.`status` != '1'
            ");
            $result = $qry->result();
            foreach ($result as $res) {
                $data = array
                (
                    'notification_for' => 'rent_payment',
                    'full_title' => 'Rent Payment',
                    'missing_id' => $res->id,
                    'missing_date' => $last_date,
                    'status' => '1',
                );
                $this->db->insert('notifications', $data);
            }

            $members_query = $this->db->query("SELECT `member_id`,`rent` FROM `member_info` WHERE `hostel_id` = '$id'");
            $all_members = $members_query->result();
            foreach ($all_members as $emp) {
                $check_members_query = $this->db->query
                ("
                    SELECT `id` 
                    FROM `rent_payments` 
                    WHERE `member_id` = '$emp->member_id' 
                    AND MONTH(`rent_month`) = '$month' 
                    AND YEAR(`rent_month`) = '$year'
                ");
                $check_members = $check_members_query->num_rows();
                if ($check_members == 0) {
                    $data = array
                    (
                        'member_id'     => $emp->member_id,
                        'rent_month'    => $year.'-'.$month.'-01'
                    );
                    $this->db->insert('rent_payments', $data);
                }
            }
            $this->session->set_flashdata('msg', 'Rent sheet added successfully.');
            redirect(base_url() . 'hostel-payment');
        }
    }

    public function save_expense_info() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $this->hostel_session_data();
            $type = $this->input->post('type');
            $data = array
            (
                'expense_type_id'   => $this->input->post('expense_type_id'),
                'hostel_id'         => $id,
                'expense_title'     => $this->input->post('expense_title'),
                'expense_month'     => $this->input->post('year').'-'.$this->input->post('month').'-01',
                'created_at'        => date("Y-m-d h:i:s"),
                'updated_at'        => date("Y-m-d h:i:s")
            );
            $expense_list_id = $this->input->post('expense_list_id');
            if ($expense_list_id > 0) {
                unset($data['created_at']);
                $this->db->where('expense_list_id', $expense_list_id);
                $this->db->update('expense_list', $data);
                $status = 'Update';
            } else {
                $this->db->insert('expense_list', $data);
                $status = 'Insert';
            }

            if ($status == 'Update' && $type == 'mess') {
                $this->session->set_flashdata('msg', 'Mess expense list update successfully.');
                redirect(base_url() . 'mess-expense');
            } else {
                if ($status == 'Update' && $type == 'daily') {
                    $this->session->set_flashdata('msg', 'Daily expense list update successfully.');
                    redirect(base_url() . 'list-daily-expense');
                } else {
                    if ($status == 'Insert' && $type == 'mess') {
                        $this->session->set_flashdata('msg', 'Mess expense list saved successfully.');
                        redirect(base_url() . 'mess-expense');
                    } else {
                        if ($status == 'Insert' && $type == 'daily') {
                            $this->session->set_flashdata('msg', 'Daily expense list saved successfully.');
                            redirect(base_url() . 'list-daily-expense');
                        }
                    }
                }
            }
        }
    }

    public function add_mess_data()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = array
            (
                'name'          => $this->input->post('name'),
                'mobile_no'     => $this->input->post('mobile_no'),
                'address'       => $this->input->post('address'),
                'start_date'    => $this->input->post('start_date'),
                'end_date'      => $this->input->post('end_date'),
                'mess_charges'  => $this->input->post('mess_charges'),
                'mess_details'  => trim($this->input->post('mess_details')),
                'created_at'    => date('Y-m-d'),
                'updated_at'    => date('Y-m-d')
            );
            $messId = $this->decrypt_url($this->input->post('mess_id'));
            if ($messId > 0) {
                $this->db->where('mess_id',$messId);
                $this->db->update('mess_members',$data);
                $this->session->set_flashdata('msg', 'Mess information update successfully.');
                redirect(base_url() . 'list-outside-mess');
            } else {
                $this->db->insert('mess_members', $data);
                $this->session->set_flashdata('msg', 'Mess added successfully.');
                redirect(base_url() . 'list-outside-mess');
            }
        }
    }

    public function save_mess_payment_info()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id             =   (int)$this->input->post('id');
            $updateId       =   $this->decrypt_url($this->input->post('update_id'));
            $cashReceived   =   (int)$this->input->post('cash_received') + 0;
            $dueAmount      =   (int)$this->input->post('due_amount') + 0;
            $paidAmount     =   (int)$this->input->post('paid_amount') + 0;
            $paymentDate    =   $this->input->post('payment_date');
            $operation      =   $this->input->post('operation');
            if ($operation == 'add') {
                $paidAmount    =   $paidAmount + $cashReceived;
                $dueAmount     =   $dueAmount - $cashReceived;
            } else {
                if ($operation == 'sub') {
                    $paidAmount    =   $paidAmount - $cashReceived;
                    $dueAmount     =   $dueAmount + $cashReceived;
                }
            }
            if ($dueAmount == 0) {
                $status = 1;
            } else {
                $status = 2;
            }
            $data = array
            (
                'mess_id'       => $updateId,
                'amount_paid'   => $paidAmount,
                'payment_date'  => $paymentDate,
                'pay_status'    => $status
            );
            $log = array
            (
                'mess_id'       =>  $updateId,
                'cash_received' =>  $cashReceived,
                'type'          =>  $operation,
                'payment_date'  =>  $paymentDate
            );
            $this->db->insert('mess_payment_log', $log);

            $this->db->where('id', $updateId);
            $this->db->update('mess_payment', $data);

            if ($dueAmount == 0) {
                $this->db->where(array('notification_for'=>'mess_payment','missing_id'=>$updateId));
                $this->db->delete('notifications');
            }
            header('Content-Type: application/json');
            $responseArray = array
            (
                'id'            =>  $id,
                'due_amount'    =>  $dueAmount,
                'paid_amount'   =>  $paidAmount,
                'status'        =>  $status
            );
            echo json_encode($responseArray);
        }
    }

    public function add_monthly_expense_sheet() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $this->hostel_session_data();
            $sheetMonth = $this->input->post('sheet_month');
            $sheetYear  = $this->input->post('sheet_year');

            $this->db->select('hostel_expense_id,hostel_id');
            $this->db->where('hostel_id',$id);
            $monthlyExpenseQuery = $this->db->get('hostel_expense');
            $listOfMonthlyExpense = $monthlyExpenseQuery->result();
            foreach ($listOfMonthlyExpense as $monthlyExpense) {
                $data = array
                (
                    'hostel_id'         => $id,
                    'hostel_expense_id' => $monthlyExpense->hostel_expense_id,
                    'expense_month'     => $sheetYear.'-'.$sheetMonth.'-01'
                );
                $this->db->insert('hostel_monthly_expense', $data);
            }
            redirect(base_url() . 'monthly-expense');
        }
    }

    public function save_monthly_expense_info() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id             =   (int)$this->input->post('id');
            $updateId       =   (int)$this->input->post('update_id') + 0;
            $cashReceived   =   (int)$this->input->post('cash_received') + 0;
            $paidAmount     =   (int)$this->input->post('paid_amount') + 0;
            $submitDate     =   $this->input->post('submit_date');
            $operation      =   $this->input->post('operation');
            $details        =   $this->input->post('details');
            if ($operation == 'add') {
                $paidAmount    =   $paidAmount + $cashReceived;
            } else {
                if ($operation == 'sub') {
                    $paidAmount    =   $paidAmount - $cashReceived;
                }
            }
            $data = array
            (
                'amount'        => $paidAmount,
                'submit_date'   => $submitDate,
                'details'       => $details
            );
            $this->db->where('id', $updateId);
            $this->db->update('hostel_monthly_expense', $data);
            header('Content-Type: application/json');
            $responseArray = array
            (
                'id'            =>  $id,
                'paid_amount'   =>  $paidAmount
            );
            echo json_encode($responseArray);
        }
    }

    public function save_worker_info()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $this->hostel_session_data();
            $data = array
            (
                'hostel_id'         => $id,
                'worker_name'       => $this->input->post('worker_name'),
                'cnic'              => $this->input->post('cnic'),
                'mobile_no'         => $this->input->post('mobile_no'),
                'permanent_address' => $this->input->post('permanent_address'),
                'salary'            => $this->input->post('salary'),
                'created_at'        => date('Y-m-d h:i:s'),
                'updated_at'        => date('Y-m-d h:i:s')
            );
            $workerId = $this->decrypt_url($this->input->post('worker_id'));
            if ($workerId > 0) {
                unset($data['created_at']);
                $this->db->where('worker_id',$workerId);
                $this->db->update('hostels_worker',$data);
                $this->session->set_flashdata('msg', 'Worker information update successfully.');
                redirect(base_url() . 'list-workers');
            } else {
                $this->db->insert('hostels_worker', $data);
                $this->session->set_flashdata('msg', 'Worker information successfully.');
                redirect(base_url() . 'list-workers');
            }
        }
    }

    public function add_worker_expense_sheet() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $this->hostel_session_data();
            $sheetMonth = $this->input->post('sheet_month');
            $sheetYear  = $this->input->post('sheet_year');

            $this->db->select('worker_id,hostel_id');
            $this->db->where('hostel_id',$id);
            $workerQuery = $this->db->get('hostels_worker');
            $listOfworkers = $workerQuery->result();
            foreach ($listOfworkers as $listworkers) {
                $qry = $this->db->query
                ("
                    SELECT COUNT(`id`) AS `check` FROM `worker_expense` 
                    WHERE MONTH(`expense_month`) = '$sheetMonth'
                    AND  YEAR(`expense_month`) = '$sheetYear'
                    AND `worker_id` = '$listworkers->worker_id'
                    AND `hostel_id` = '$id'
                ");
                $check = $qry->row();
                if ($check->check == 0) {
                    $data = array
                    (
                        'hostel_id'     => $id,
                        'worker_id'     => $listworkers->worker_id,
                        'expense_month' => $sheetYear.'-'.$sheetMonth.'-01'
                    );
                    $this->db->insert('worker_expense', $data);
                }
            }
            $this->session->set_flashdata('msg', 'Sheet created successfully.');
            redirect(base_url() . 'worker-expense');
        }
    }

    public function save_worker_expense_info()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id             =   (int)$this->input->post('id');
            $updateId       =   $this->input->post('update_id');
            $cashPaid       =   (int)$this->input->post('cash_paid') + 0;
            $dueAmount      =   (int)$this->input->post('due_amount') + 0;
            $paidAmount     =   (int)$this->input->post('paid_amount') + 0;
            $paymentDate    =   $this->input->post('paid_date');
            $operation      =   $this->input->post('operation');

            if ($operation == 'add') {
                $paidAmount    =   $paidAmount + $cashPaid;
                $dueAmount     =   $dueAmount - $cashPaid;
            } else {
                if ($operation == 'sub') {
                    $paidAmount    =   $paidAmount - $cashPaid;
                    $dueAmount     =   $dueAmount + $cashPaid;
                }
            }
            if ($dueAmount == 0) {
                $status = 1;
            } else {
                $status = 2;
            }
            $data = array
            (
                'paid_amount'   => $paidAmount,
                'paid_date'     => $paymentDate,
                'status'        => $status
            );
            $log = array
            (
                'expense_id'    =>  $this->decrypt_url($updateId),
                'amount'        =>  $cashPaid,
                'operation'     =>  $operation,
                'paid_date'     =>  $paymentDate
            );
            $this->db->insert('worker_expense_log', $log);

            $this->db->where('id', $this->decrypt_url($updateId));
            $this->db->update('worker_expense', $data);
            header('Content-Type: application/json');
            $responseArray = array
            (
                'id'            =>  $id,
                'due_amount'    =>  $dueAmount,
                'paid_amount'   =>  $paidAmount,
                'status'        =>  $status
            );
            echo json_encode($responseArray);
        }
    }

    public function add_bill_payment_sheet() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            echo $id = $this->hostel_session_data();
            $sheetMonth = $this->input->post('sheet_month');
            $sheetYear  = $this->input->post('sheet_year');

            if ($sheetMonth == 1) {
                $last_month = 12;
                $last_year = $sheetYear -1;
            } else {
                $last_month = $sheetMonth - 1;
                $last_year = $sheetYear;
            }
            $last_date = $last_year.'-'.$last_month.'-01';

            $qry = $this->db->query
            ("
                SELECT `id` FROM `bill_payment` AS `bp`
                INNER JOIN `rooms_info` AS `ri`
                ON `bp`.`room_id` = `ri`.`room_id`
                WHERE `ri`.`hostel_id` = '$id' AND MONTH(`bp`.`sheet_for_month`) = '$last_month'
                AND YEAR(`bp`.`sheet_for_month`) = '$last_year'
                AND `bp`.`bill_status` != '1'
            ");
            $result = $qry->result();
            foreach ($result as $res) {
                $data = array
                (
                    'notification_for' => 'bill_payment',
                    'full_title' => 'Bill Payment',
                    'missing_id' => $res->id,
                    'missing_date' => $last_date,
                    'status' => '1',
                );
                $this->db->insert('notifications', $data);
            }

            $query = $this->db->query
            ("
                SELECT `f`.`facility_id`, `ri`.`room_id`,`ri`.`bill_amount`
                FROM `rooms_info` AS `ri`
                INNER JOIN `hostel_facilities` AS `f`
                ON `f`.`facility_id` = `ri`.`facility_id`
                WHERE `ri`.`hostel_id` = '$id' AND `f`.`facility_id` != '3'
            ");
            $listOfFacilities = $query->result();
            foreach ($listOfFacilities as $listFacilities) {
                $qry = $this->db->query
                ("
                  SELECT COUNT(`id`) AS `check` FROM `bill_payment` 
                  WHERE MONTH(`sheet_for_month`) = '$sheetMonth'
                  AND YEAR(`sheet_for_month`) = '$sheetYear'
                  AND `room_id` = '$listFacilities->room_id'
                ");
                $check = $qry->row();
                if ($check->check == 0) {
                    $data = array
                    (
                        'room_id'           => $listFacilities->room_id,
                        'facility_id'       => $listFacilities->facility_id,
                        'unit_amount'       => $listFacilities->bill_amount,
                        'sheet_for_month'   => $sheetYear.'-'.$sheetMonth.'-01'
                    );
                    $this->db->insert('bill_payment', $data);
                }
            }
            $this->session->set_flashdata('msg', 'Sheet created successfully.');
            redirect(base_url() . 'bill-payments');
        }
    }

    public function save_bill_payment_info() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id             =   (int)$this->input->post('id');
            $updateId       =   (int)$this->input->post('update_id') + 0;
            $meeterReading  =   (int)$this->input->post('meeter_reading') + 0;
            $unitPrice      =   (int)$this->input->post('unit_price') + 0;
            $cashReceived   =   (int)$this->input->post('cash_received') + 0;
            $paidAmount     =   (int)$this->input->post('amount_paid') + 0;
            $dueAmount      =   (int)$this->input->post('due_amount') + 0;
            $paidDate       =   $this->input->post('paid_date');
            $operation      =   $this->input->post('operation');

            if ($operation == 'add') {
                $paidAmount    =   $paidAmount + $cashReceived;
                $dueAmount     =   $dueAmount - $cashReceived;
            } else {
                if ($operation == 'sub') {
                    $paidAmount    =   $paidAmount - $cashReceived;
                    $dueAmount     =   $dueAmount + $cashReceived;
                }
            }

            if ($dueAmount == 0) {
                $status = 1;
            } else {
                $status = 2;
            }
            $data = array
            (
                'meter_reading'   => $meeterReading,
                'unit_amount'     => $unitPrice,
                'paid_amount'     => $paidAmount,
                'cash_date'       => $paidDate,
                'bill_status'     => $status
            );

            $this->db->where('id', $updateId);
            $this->db->update('bill_payment', $data);

            if ($dueAmount == 0) {
                $this->db->where(array('notification_for' => 'bill_payment', 'missing_id' => $updateId));
                $this->db->delete('notifications');
            }

            header('Content-Type: application/json');
            $responseArray = array
            (
                'id'            =>  $id,
                'due_amount'    =>  $dueAmount,
                'paid_amount'   =>  $paidAmount,
                'status'        =>  $status
            );
            echo json_encode($responseArray);
        }
    }

    public function update_user_status($tbl, $col, $colValue, $updateCol, $updateId, $reponseId) {
        $data = array
        (
            $col => $colValue
        );
        $updateId = $this->decrypt_url($updateId);
        $this->db->where($updateCol, $updateId);
        $this->db->update($tbl, $data);
        header('Content-Type: application/json');
        $responseArray = array
        (
            'id'     =>  $reponseId,
            'set'    =>  $colValue
        );
        echo json_encode($responseArray);
    }

    public function add_new_mess_sheet() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $sheetMonth = $this->input->post('sheet_month');
            $sheetYear  = $this->input->post('sheet_year');

            if ($sheetMonth == 1) {
                $last_month = 12;
                $last_year = $sheetYear -1;
            } else {
                $last_month = $sheetMonth - 1;
                $last_year = $sheetYear;
            }
            $last_date = $last_year.'-'.$last_month.'-01';

            $qry = $this->db->query
            ("
                SELECT `id` FROM `mess_payment`
                WHERE MONTH(`sheet_for_month`) = '$last_month'
                AND YEAR(`sheet_for_month`) = '$last_year'
                AND `pay_status` != '1'
            ");
            $result = $qry->result();
            foreach ($result as $res) {
                $data = array
                (
                    'notification_for' => 'mess_payment',
                    'full_title' => 'Mess Payment',
                    'missing_id' => $res->id,
                    'missing_date' => $last_date,
                    'status' => '1',
                );
                $this->db->insert('notifications', $data);
            }

            $this->db->select('mess_id');
            $this->db->where('status','1');
            $messQuery = $this->db->get('mess_members');
            $listOfmessMembers = $messQuery->result();
            foreach ($listOfmessMembers as $messMembers) {
                $mess_id = $messMembers->mess_id;
                $qry = $this->db->query
                ("
                  SELECT COUNT(`id`) AS `headcounts` FROM `mess_payment` WHERE `mess_id` = '$mess_id' 
                  AND MONTH(`sheet_for_month`) = '$sheetMonth' AND YEAR(`sheet_for_month`) = '$sheetYear'
                ");
                $check = $qry->row();
                if ($check->headcounts == 0) {
                    $data = array
                    (
                        'mess_id'           => $messMembers->mess_id,
                        'sheet_for_month'   => $sheetYear.'-'.$sheetMonth.'-01'
                    );
                    $this->db->insert('mess_payment', $data);
                }
            }
            $this->session->set_flashdata('msg', 'Sheet created successfully.');
            redirect(base_url() . 'mess-payments');
        }
    }

    public function change_password() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $old        = $this->input->post('old');
            $new        = $this->input->post('new');
            $confirm    = $this->input->post('confirm');
            $userId     = $this->session->userdata('login_member_id');
            if ($new == $confirm) {
                $this->db->select('password');
                $this->db->where('id',$userId);
                $qry = $this->db->get('nw_login');
                $passwordDb = $qry->row();
                if (password_verify($old,$passwordDb->password)) {
                    $data = array
                    (
                        'password'  => password_hash($confirm,PASSWORD_BCRYPT)
                    );
                    $this->db->where('id',$userId);
                    $this->db->update('nw_login', $data);
                    $this->session->set_flashdata('msg', 'Your password has been successfully changed.');
                    redirect(base_url() . 'profile');
                } else {
                    $this->session->set_flashdata('error', 'Incorrect password.');
                    redirect(base_url() . 'profile');
                }
            } else {
                $this->session->set_flashdata('error', 'New and Old password does not match.');
                redirect(base_url() . 'profile');
            }
        }
    }

    public function view_rent_history($year, $month, $user_id) {
        $id = $this->hostel_session_data();
        $qry  = $this->db->query
        ("
            SELECT `rpl`.`cash_received`,`rpl`.`opetaion`,`rpl`.`cash_date`
            FROM `rent_payment_log` AS `rpl`
            INNER JOIN `rent_payments` AS `rp`
            ON `rp`.`id` = `rpl`.`rent_payment_id`
            WHERE YEAR(`rpl`.`cash_date`) = '$year' AND MONTH(`rpl`.`cash_date`) = '$month'
            AND `rp`.`member_id` = '$user_id'
        ");
        $payments = $qry->result();
        header('Content-Type: application/json');
        echo json_encode($payments);
    }

    public function save_daily_expense() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $redirect = $this->input->post('redirect');
            foreach ($this->input->post('item') as $key => $value) {
                if ($this->input->post('item')[$key] != '') {
                    $data = array
                    (
                        'expense_list_id'   => $this->input->post('expense_list_id'),
                        'item_date'         => $this->input->post('item_date')[$key],
                        'item'              => $this->input->post('item')[$key],
                        'item_price'        => $this->input->post('item_price')[$key],
                        'item_detail'       => $this->input->post('item_detail')[$key]
                    );
                    $this->db->insert('expense_details', $data);
                }
            }
            $this->session->set_flashdata('msg', 'Expense added successfully.');
            if ($redirect == '0') {
                redirect(base_url() . 'mess-expense');
            } else {
                redirect(base_url() . 'list-daily-expense');
            }
        }
    }

    public function update_daily_expense_item() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $response = $this->input->post('data');
            $update_id = $response[0]['update_id'];
            $data = array
            (
                'item_date'     => $response[0]['date'],
                'item'          => $response[0]['item'],
                'item_price'    => $response[0]['price'],
                'item_detail'   => $response[0]['detail'],
            );
            $this->db->where('id',$update_id);
            $result = $this->db->update('expense_details', $data);
            echo $result;
        }
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
          SELECT `$cols[2]` AS `id` FROM `$table` 
          WHERE MONTH(`$cols[0]`) = '$month'
          AND YEAR(`$cols[0]`) = '$year'
          AND `$cols[1]` != '1'
        ");
        $result = $query->result();
        foreach ($result as $res) {
            $data = array
            (
                'notification_for'  =>  $notify,
                'missing_id'        =>  $res->id,
                'missing_date'      =>  $last_date,
                'status'            =>  '1',
            );
            $this->db->insert('notifications',$data);
        }
    }

    public function get_hostel_expense($hostel_id) {
        $hostel_id = $this->decrypt_url($hostel_id);
        $this->db->select('*');
        $this->db->where('hostel_id',$hostel_id);
        $qry = $this->db->get('hostel_expense');
        $expense = $qry->result();
        foreach ($expense as $exp) {
            $exp->hostel_id = $this->encrypt_url($exp->hostel_id);
        }
        header('Content-Type: application/json');
        echo json_encode($expense);
    }
}