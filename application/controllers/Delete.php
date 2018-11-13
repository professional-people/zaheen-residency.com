<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delete extends CI_Controller {
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

    public function delete_isp_service()
    {
        if ($_SERVER["REQUEST_METHOD"] == 'POST' && !empty($this->input->post('delete_id')))
        {
            $this->db->where('id', $this->input->post('delete_id'));
            $delete = $this->db->delete('nw_isp_service');
            if($delete)
            {
                $this->session->set_flashdata('msg','ISP service deleted Successfully.');
                redirect(base_url() . 'list-isp-services');
            }
        }
    }

    public function delete_user_service()
    {
        if ($_SERVER["REQUEST_METHOD"] == 'POST' && !empty($this->input->post('delete_id')))
        {
            $this->db->where('id', $this->input->post('delete_id'));
            $delete = $this->db->delete('nw_user_service');
            if($delete)
            {
                $this->session->set_flashdata('msg','User service deleted Successfully.');
                redirect(base_url() . 'list-user-services');
            }
        }
    }
}
