<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update extends CI_Controller {
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

    public function update_isp_service()
    {
        if ($_SERVER["REQUEST_METHOD"] == 'POST' && !empty($this->input->post('update_id')))
        {
            $data = array
            (
                'service_title'     =>  $this->input->post('service_title'),
                'service_charges'   =>  only_numbers($this->input->post('service_charges'))
            );
            $this->db->where('id', $this->input->post('update_id'));
            $update = $this->db->update('nw_isp_service', $data);
            if ($update)
            {
                $this->session->set_flashdata('msg','ISP service update Successfully.');
                redirect(base_url() . 'list-isp-services');
            }
        }
    }

    public function update_user_service()
    {
        if ($_SERVER["REQUEST_METHOD"] == 'POST' && !empty($this->input->post('update_id')))
        {
            $data = array
            (
                'service_title'     =>  $this->input->post('service_title'),
                'service_charges'   =>  only_numbers($this->input->post('service_charges'))
            );
            $this->db->where('id', $this->input->post('update_id'));
            $update = $this->db->update('nw_user_service', $data);
            if ($update)
            {
                $this->session->set_flashdata('msg','User service update Successfully.');
                redirect(base_url() . 'list-user-services');
            }
        }
    }
}
