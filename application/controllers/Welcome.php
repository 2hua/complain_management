<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('ComplainModel');
	}
	public function index($status="")
	{
		$data['status']=$status;
		$data['allStates'] = $this->ComplainModel->getAllStates();
		$this->load->view('admin/header');
		$this->load->view('admin/dashboard',$data);
		$this->load->view('admin/footer');
	}
	public function book_complain()
	{

         //$this->load->library('form_validation');
		 
		 $this->form_validation->set_rules('phoneNo', 'Phone Number', 'required|min_length[10]|max_length[10]');
		 $this->form_validation->set_rules('city', 'City', 'required');
		 $this->form_validation->set_rules('site', 'Site', 'required');
		 $this->form_validation->set_rules('issueDesc', 'Issue-Description', 'required');
		 
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('admin/header');
			$this->load->view('admin/dashboard');
			$this->load->view('admin/footer');
		}
		else
		{
			$status=$this->ComplainModel->insertUserData();
			if($status>0){
				 redirect('/welcome/index/successful');
			}
			else
			{
				 redirect('/welcome/index/unsuccessful');
			}
		}
	}
	public function site_view(){
		$data['allStates'] = $this->ComplainModel->getAllStates();
		$this->load->view('admin/header');
		$this->load->view('admin/site',$data);
		$this->load->view('admin/footer');
	}
	public function getCitiesByStateId(){
		$cities = $this->ComplainModel->getCitiesByStateId();
		die(json_encode(array('msg'=>$cities,'status'=>'success')));
	}
	public function getSitesByCityId()
	{
		$sites=$this->ComplainModel->getSiteByCityId();
		die(json_encode(array('msg'=>$sites,'status'=>'success')));
	}
	public function add_site()
	{
		$this->ComplainModel->insertSite();
		header("Location:".base_url('index.php/welcome/area_view'));
		
	}
	public function supervisor_view()
	{
			$this->load->view('admin/header');
			$this->load->view('admin/supervisor');
			$this->load->view('admin/footer');
	}
	public function add_supervisor()
	{
		$this->ComplainModel->insertSupervisor();
		header("Location:".base_url('index.php/welcome/supervisor_view'));
		
	}
	
}
