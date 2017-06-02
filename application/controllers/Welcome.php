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
	 /*
		status: 2->in process
		status: 1->close
		status: 0->yet to assign
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->model('ComplainModel');
	}
	public function index()
	{
		
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
				 $this->session->set_flashdata('ticket_success','Records Inserted Sucessfully');
			}
			else
			{
				 $this->session->set_flashdata('ticket_error','Oops Something goes wrong');
			}
			redirect('/welcome/index/');
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
	public function getTicketsBySiteId()
	{
		$tickets=$this->ComplainModel->getTicketsBySiteId();
		die(json_encode(array('msg'=>$tickets,'status'=>'success')));
	}
	public function getSupervisorByTicketId()
	{
		$supervisor=$this->ComplainModel->getSupervisorByTicketId();
		die(json_encode(array('msg'=>$supervisor,'status'=>'success')));
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
	public function allocate_supervisor_view()
	{
		$data['allSupervisors'] = $this->ComplainModel->getAllSupervisors();
		$data['alltickets']=$this->ComplainModel->getAllTickets();
		$data['allStates'] = $this->ComplainModel->getAllStates();		
		$this->load->view('admin/header');
		$this->load->view('admin/allocate_supervisor',$data);
		$this->load->view('admin/footer');
	}
	public function add_allocate_supervisor()
	{
		$success_status = $this->ComplainModel->allocateSupervisor();
		if($success_status>0){
				 $this->session->set_flashdata('allocate_msg','Ticket Assign Successfully');
			}
			else
			{
				 $this->session->set_flashdata('allocate_msg_error','Ticket Already Assigned');
			}
	//	header("Location:".base_url('index.php/welcome/allocate_supervisor_view'));
	redirect('/welcome/allocate_supervisor_view/');
	}
	public function technician_view()
	{
			$this->load->view('admin/header');
			$this->load->view('admin/technician');
			$this->load->view('admin/footer');
	}
	public function add_technician()
	{
		$this->ComplainModel->insertTechnician();
		header("Location:".base_url('index.php/welcome/technician_view'));
		
	}
	public function allocate_technician_view()
	{
		$data['allTechnicians'] = $this->ComplainModel->getAllTechnicians();
		$data['allTickets']=$this->ComplainModel->getAllTicketsTech();
		$this->load->view('admin/header');
		$this->load->view('admin/allocate_technician',$data);
		$this->load->view('admin/footer');
	}
	public function add_allocate_technician()
	{
		$success_status_tech = $this->ComplainModel->allocateTechnician();
		if($success_status_tech>0){
				 $this->session->set_flashdata('allocate_msg_tech','Ticket Assign Successfully');
			}
			else
			{
				 $this->session->set_flashdata('allocate_msg_error_tech','Ticket Already Assigned');
			}
	//	header("Location:".base_url('index.php/welcome/allocate_supervisor_view'));
	redirect('/welcome/allocate_technician_view/');
	}
	public function techComment_view()
	{
			$data['allTickets']=$this->ComplainModel->getAllTicketsTechComment();
			$this->load->view('admin/header');
			$this->load->view('admin/techComment',$data);
			$this->load->view('admin/footer');
	}
	public function add_comment()
	{
		$success_status_issue = $this->ComplainModel->insertComment();
		if($success_status_issue>0){
				 $this->session->set_flashdata('allocate_msg_issue','Issue Comment inserted successfully Successfully');
			}
			else
			{
				 $this->session->set_flashdata('allocate_msg_error_issue','Oops issue_comment cant be insert');
			}
	//	header("Location:".base_url('index.php/welcome/allocate_supervisor_view'));
	redirect('/welcome/techComment_view/');
	}
	public function supervisorComment_view()
	{
			$data['allTickets']=$this->ComplainModel->getAllTicketsSupervisorComment();
			$data['allSupervisors'] = $this->ComplainModel->getAllSupervisors();
			$this->load->view('admin/header');
			$this->load->view('admin/supervisorComment',$data);
			$this->load->view('admin/footer');
	}
	public function add_supervisor_comment()
	{
		$sucess_status_issue_supervisor = $this->ComplainModel->insertCommentSupervisor();
		if($sucess_status_issue_supervisor>0){
				 $this->session->set_flashdata('allocate_msg_issue_supervisor','Issue Comment inserted successfully Successfully');
			}
			else
			{
				 $this->session->set_flashdata('allocate_msg_error_issue_supervisor','Oops issue_comment cant be insert');
			}
	//	header("Location:".base_url('index.php/welcome/allocate_supervisor_view'));
	//redirect('/welcome/supervisorComment_view/');
	}
	public function ticket_report()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/ticket_report');
		$this->load->view('admin/footer');
	}
}
