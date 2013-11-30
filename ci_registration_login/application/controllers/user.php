<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//CONTROLLER
class User extends CI_Controller {

	//constructor
	public function __construct()
	{
		parent::__construct();
		$this->encrypt->set_cipher(MCRYPT_BLOWFISH);
	}

	//register view
	public function index()
	{
		$this->load->view('register');
	}

	//profile view
	public function profile()
	{
		//if logged in load profile view, otherwise stay on index
		//avoids errors when using back button or going straight there with url
		if(isset($this->session->userdata['logged_in']))
		{
			$this->load->view('profile');
		}
		else
		{
			redirect(base_url());
		}	
	}

	//function to get post data from login form
	public function get_user_input()
	{
		$user_details = $this->input->post();
		return $user_details;
	}

	//function to load user model and query database for user info 
	public function get_user_info($user_param)
	{
		$this->load->model('User_model');
		$user = $this->User_model->db_get_user($user_param);
		return $user;
	}

	//function to go to profile page upon success
	public function success($user_param)
	{
		$this->session->set_userdata('user_session', $user_param);
		$this->session->set_userdata('logged_in', true);
		redirect(base_url('user/profile'));
	}

	//LOGIN
	public function process_login()
	{
		//get post data from login form
		$user_details = $this->get_user_input();

		//error if email is blank
		if(empty($user_details['email']))
		{
			$this->session->set_userdata('error_login', "Please enter an email.");
			redirect(base_url());
		}

		//load user model and query database for user info 
		$user = $this->get_user_info($user_details);

		//error if email is not in database
		if(!$user)
		{
			$this->session->set_userdata('error_login', "No user with this email exists.");
			redirect(base_url());
		}

		//error if email and password don't match
		elseif($this->encrypt->decode($user->password) != $user_details['password'])
		{
			$this->session->set_userdata('error_login', "Email and password do not match.");
			redirect(base_url());
		}

		//success if username and password match
		elseif($this->encrypt->decode($user->password) == $user_details['password'])
		{
			//success
			$this->success($user);
		}
	}

	//REGISTER
	public function process_register()
	{
		//get post data from login form
		$user_details = $this->get_user_input();

		//load user model and query database for user info 
		$user = $this->get_user_info($user_details);

		//form validation
		$this->load->library('form_validation');
		$this->form_validation->set_rules('first_name', 'first name', 'required');
		$this->form_validation->set_rules('last_name', 'last name', 'required');
		$this->form_validation->set_rules('email', 'email', 'valid_email|required');
		$this->form_validation->set_rules('password', 'password', 'min_length[8]|required');
		//if form is not valid
		if(($this->form_validation->run() == false) || $user)
		{
			//set session data with error messages
			$this->session->set_userdata('error_first_name', form_error('first_name'));
			$this->session->set_userdata('error_last_name', form_error('last_name'));
			//error if email already in database
			if($user)
			{
				$this->session->set_userdata('error_email', 'A user with this email address already exists.');
			}
			else
			{
				$this->session->set_userdata('error_email', form_error('email'));
			}
			$this->session->set_userdata('error_password', form_error('password'));
			$this->session->set_userdata('error_main', 'Please correct the below information.');
			redirect(base_url());
		}
		else
		{
			$user_details['password'] = $this->encrypt->encode($user_details['password']);

			//add user to database
			$this->User_model->db_register_user($user_details);

			//query db to retrieve all user details
			$user = $this->User_model->db_get_user($user_details);

			//success
			$this->success($user);
		}
	}

	//LOGOUT
	public function process_logout()
	{
		$this->session->sess_destroy();
		redirect(base_url());
	}
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */