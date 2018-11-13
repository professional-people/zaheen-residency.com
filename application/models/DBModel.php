<?php 
class DBModel extends CI_Model {

    //    --------------- Database Functions ---------------

    public function select($selection = array(),$table)
    {
        $select = implode(',',$selection);
        $this->db->select($select);
        $query	=	$this->db->get($table);
        $data = $query->result();
        return $data;
    }

    public function row($selection = array(), $table, $condition = array())
    {
        $select = implode(',', $selection);
        $this->db->select($select);
        $this->db->where($condition);
        $query = $this->db->get($table);
        $data = $query->row();
        return $data;
    }

    public function where($selection = array(),$table,$condition = array())
    {
        $select = implode(',',$selection);
        $this->db->select($select);
        $this->db->where($condition);
        $query	=	$this->db->get($table);
        $data   = $query->result();
        return $data;
    }

    public function json($selection = array(),$table)
    {
        $select = implode(',',$selection);
        $this->db->select($select);
        $query	=	$this->db->get($table);
        $data = $query->result();
        $response = json_encode($data);
        return $response;
    }

    public function count($selection = array(),$table,$condition = array())
    {
        $select = implode(',',$selection);
        $this->db->select($select);
        $this->db->where($condition);
        $query	=	$this->db->get($table);
        $count  = $query->num_rows();
        return $count;
    }

    public function order_by($selection = array(),$table,$order_by = array())
    {
        $select = implode(',',$selection);
        $this->db->select($select);
        $this->db->order_by($order_by[0],$order_by[1]);
        $query	=	$this->db->get($table);
        $data   =   $query->result();
        return $data;
    }

    public function join($selection = array(),$table,$join = array(),$where = array(), $order_by = array())
    {
        $select = implode(',',$selection);
        $this->db->select($select);
        $this->db->from($table);
        foreach($join as $tbl => $on)
        {
            $this->db->join($tbl, $on);
        }
        if(count($where) == 0)
        {
            $where = array('1','1');
        }
        $this->db->where($where);
        if(count($order_by) == 0)
        {
            $order_by = array('0','0');
        }
        $this->db->order_by($order_by[0],$order_by[1]);
        $query = $this->db->get();
        $data   =   $query->result();
        return $data;
    }



    //    --------------- Database Functions ---------------
	function login_check($username,$password)
	{
		$query = $this->db->get_where('nw_login',array('username'=>$username),1);
		if ($query->num_rows() > 0)
		{
            if (password_verify($password,$query->row()->password))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
		else
		{
			return false;
		}
	}

	function login_details($username)
	{
		$this->db->select('id,first_name');
		$this->db->where('username', $username);
		$query	=	$this->db->get('nw_login');
		$data	=	$query->row();
		return $data;
	}

	function profile_details($member_id)
	{
		$this->db->select('first_name,last_name,email,mobile_no');
		$this->db->where('id', $member_id);
		$query	=	$this->db->get('nw_login');
		$data	=	$query->row();
		return $data;
	}

	function profile_details_update($data)
	{
		$this->db->where('id',$this->session->userdata('login_member_id'));
		$update = $this->db->update('nw_login',$data);
		if ($update) 
		{
			return true;
		}
		else
		{
			return false;
		}
	}

    function insert($table,$data)
    {
        $insert = $this->db->insert($table,$data);
        return $insert;
    }

    function selectAll($table)
    {
        $query = $this->db->get($table);
        $data = $query->result();
        return $data;
    }

    function check_email($email)
    {
        $this->db->where('email',$email);
        $check = $this->db->get('nw_login');
        if($check->num_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    function user_details($user_id)
    {
        $this->db->where('id',$user_id);
        $info = $this->db->get('nw_users');
        return $info->row();
    }

    function update($tbl,$data,$col,$val)
    {
        $this->db->where($col, $val);
        $update = $this->db->update($tbl, $data);
        return $update;
        //return True or False
    }

//    function footer_data()
//    {
//        $this->db->where('setting_type','footer');
//        $data=$this->db->get('nw_system_settings');
//        return $data->row();
//    }

//    function active_countries()
//    {
//        $this->db->where('status','1');
//        $data=$this->db->get('nw_countries');
//        $data = $data->result();
//        return $data;
//    }
//    function active_states()
//    {
//        $this->db->where('country_id','166');
//        $data=$this->db->get('nw_states');
//        $data = $data->result();
//        return $data;
//    }
//    function active_cities()
//    {
//        $this->db->where('state_id','2728');
//        $data=$this->db->get('nw_cities');
//        $data = $data->result();
//        return $data;
//    }

}
?>