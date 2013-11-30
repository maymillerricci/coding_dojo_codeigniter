<?php 
//MODEL
	class User_model extends CI_Model
	{
		public function db_get_user($user)
		{
			return $this->db->where('email', $user['email'])
							->get("users")
							->row();
		}

		public function db_register_user($user)
		{
			$user['created_at'] = date('Y-m-d H:i:s', time());
			$user['updated_at'] = date('Y-m-d H:i:s', time());
			$this->db->insert('users', $user);
		}
	}
?>