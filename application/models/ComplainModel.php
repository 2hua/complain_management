<?php
class ComplainModel extends CI_model
{
	public function __construct()
	{
		$this->load->database();
	}
	public function insertUserData()
	{
		$phoneNo=$this->input->post('phoneNo');
		$city=$this->input->post('city');
		$site=$this->input->post('site');
		$issueDesc=$this->input->post('issueDesc');
			$user_data=array(
			'phone_no'=>$phoneNo,
			'city'=>$city,
			'site'=>$site,
			'issue_desc'=>$issueDesc,
			'c_created'=>date('Y-m-d h:i:s')
			);
		$status=$this->db->insert('complain_mst',$user_data);
		$id=$this->db->insert_id();
		$this->db->where('id',$id);
		$ticket_id=array(
			'ticket_id'=>$id,
			'c_updated'=>date('Y-m-d h:i:s')
		);
		$this->db->update('complain_mst',$ticket_id);
		
		return $status;
	}
	public function getAllStates(){
		$this->db->where('country_id',101);
		$states = $this->db->get('states')->result_array();
		return $states;
	}
	public function getCitiesByStateId(){
		$stateId = $this->input->post('stateId');
		$this->db->where('state_id',$stateId);
		$cities = $this->db->get('cities')->result_array();
		return $cities;
	}
	public function getSiteByCityId()
	{
		$cityId=$this->input->post('cityId');
		$this->db->where('city_id',$cityId);
		$sites=$this->db->get('sites')->result_array();
		return $sites;
	}
	public function getTicketsBySiteId()
	{
		 $siteId=$this->input->post('siteId');
		 $route=$this->input->post('route');
		 $route_state=0;
		 if($route=='supervisor')
		 {
			$route_state=0; 
		 }
		 else{
			 $route_state=2;
		 }
		$this->db->where('site',$siteId);
		$this->db->where('status',$route_state);
		$ticket=$this->db->get('complain_mst')->result_array();
		return $ticket;
	}
	public function insertSite(){
		$city=$site=$this->input->post('city');
		$site=$this->input->post('site');
			$user_data=array(
				'site_name'=>$site,
				'city_id'=>$city
			);
		$site=$this->db->insert('sites',$user_data);
		return site;
	}
	public function insertSupervisor()
	{
		$supervisor_name=$this->input->post('supervisor_name');
		$qualification=$this->input->post('qualification');
		$expertise=$this->input->post('expertise');
			$user_data=array(
			'supervisor_name'=>$supervisor_name,
			'qualification'=>$qualification,
			'expertise'=>$expertise
			);
			$this->db->insert('supervisor_mst',$user_data);
		
	}
	public function getAllSupervisors(){
		$supervisors = $this->db->get('supervisor_mst')->result_array();
		return $supervisors;
	}
	public function allocateSupervisor()
	{	
			$ticket_id=$this->input->post('ticket_id');
			$this->db->where('ticket_id',$ticket_id);
			$status=$this->db->get('allocate_supervisor')->result_array();
			$sucess_status=0;
		if(empty($status))
		{
			$ticket_id=$this->input->post('ticket_id');
			$supervisor_id=$this->input->post('supervisor_id');
		
			$user_data=array(
			'ticket_id'=>$ticket_id,
			'supervisor_id'=>$supervisor_id,
			);
			$this->db->insert('allocate_supervisor',$user_data);
			$sucess_status=1;
		}
		return $sucess_status;
		
	}
	public function getAllTickets(){
		$this->db->where('status',0);
		$tickets = $this->db->get('complain_mst')->result_array();
		return $tickets;
	}
	public function getAllTicketsTech(){
		$this->db->where('status',0);
		$tickets = $this->db->get('complain_mst')->result_array();
		return $tickets;
	}
	public function insertTechnician()
	{
		$technician_name=$this->input->post('technician_name');
		$qualification=$this->input->post('qualification');
		$expertise=$this->input->post('expertise');
			$user_data=array(
			'technician_name'=>$technician_name,
			'qualification'=>$qualification,
			'expertise'=>$expertise
			);
			$this->db->insert('technician_mst',$user_data);
		
	}
	public function getAllTechnicians(){
		$technicians = $this->db->get('technician_mst')->result_array();
		return $technicians;
	}
	public function allocateTechnician()
	{	
			$ticket_id=$this->input->post('ticket_id');
			$this->db->where('ticket_id',$ticket_id);
			$status=$this->db->get('allocate_technician')->result_array();
			$sucess_status_tech=0;
		if(empty($status))
		{
			$ticket_id=$this->input->post('ticket_id');
			$technician_id=$this->input->post('technician_id');
		
			$user_data=array(
			'ticket_id'=>$ticket_id,
			'technician_id'=>$technician_id,
			);
			$this->db->insert('allocate_technician',$user_data);
			$this->db->where('ticket_id',$ticket_id);
			$user_data=array(
			'status'=>2
			);
			$this->db->update('complain_mst',$user_data);
			$sucess_status_tech=1;
		}
		return $sucess_status_tech;
	}
	
	public function getAllTicketsTechComment(){
		$this->db->where('status',2);
		$tickets = $this->db->get('complain_mst')->result_array();
		return $tickets;
	}
	public function insertComment()
	{
			$ticket_id=$this->input->post('ticket_id');
			$this->db->where('ticket_id',$ticket_id);
			$status=$this->db->get('closing_comment')->result_array();
			$sucess_status_issue=0;
		if(empty($status))
		{
			$ticket_id=$this->input->post('ticket_id');
			$techComment=$this->input->post('techComment');
			$tech_id=$this->input->post('technician_id');
			$user_data=array(
			'ticket_id'=>$ticket_id,
			'issue_comment'=>$techComment,
			'tech_id'=>$tech_id,
			'closed_at'=>date('Y-m-d h:i:s')
			);
			$insrt = $this->db->insert('closing_comment',$user_data);
			$this->db->where('ticket_id',$ticket_id);
			$user_data=array(
			'status'=>1,
			'c_updated'=>date('Y-m-d h:i:s')
			);
			$updt = $this->db->update('complain_mst',$user_data);
			$sucess_status_issue=1;
		
		}
		return $sucess_status_issue;
	}
	public function getAllTicketsSupervisorComment(){
		//$this->db->where('status',2);
		$tickets = $this->db->get('complain_mst')->result_array();
		return $tickets;
	}
	
	public function insertCommentSupervisor()
	{
			$ticket_id=$this->input->post('ticket_id');
			$this->db->where('ticket_id',$ticket_id);
			$status=$this->db->get('supervisor_comment')->result_array();
			$sucess_status_issue_supervisor=0;
		if(empty($status))
		{
			$ticket_id=$this->input->post('ticket_id');
			$supervisor_id=$this->input->post('supervisor_id');
			$supervisorComment=$this->input->post('supervisorComment');
		
			$user_data=array(
			'ticket_id'=>$ticket_id,
			'issue_comment'=>$supervisorComment,
			'supervisor_id'=>$supervisor_id
			);
			$this->db->insert('supervisor_comment',$user_data);
			$sucess_status_issue_supervisor=1;
		}
		return $sucess_status_issue_supervisor;
	}
	public function getSupervisorByTicketId()
	{
		$ticketId=$this->input->post('ticketId');
		$this->db->select('supervisor_mst.supervisor_name,allocate_supervisor.supervisor_id	');
		$this->db->from('supervisor_mst');
		$this->db->where('allocate_supervisor.ticket_id',$ticketId);
		$this->db->join('allocate_supervisor', 'allocate_supervisor.supervisor_id = supervisor_mst.supervisor_id');
		$supervisor = $this->db->get()->result_array();
		return $supervisor;
	}
	public function getTechnicianByTicketId()
	{
		$ticketId=$this->input->post('ticketId');
		$this->db->select('technician_mst.technician_name,allocate_technician.technician_id	');
		$this->db->from('technician_mst');
		$this->db->where('allocate_technician.ticket_id',$ticketId);
		$this->db->join('allocate_technician', 'allocate_technician.technician_id = technician_mst.technician_id');
		$technician = $this->db->get()->result_array();
		return $technician;
	}
	public function getClosingReport()
	{
		$this->db->select('complain_mst.*,allocate_supervisor.*,closing_comment.*');
		$this->db->from('complain_mst');
		$this->db->join('closing_comment','closing_comment.ticket_id=complain_mst.ticket_id');
		$this->db->join('allocate_supervisor','complain_mst.ticket_id=allocate_supervisor.ticket_id');
		$this->db->where('complain_mst.status',1);
		$closing_report=$this->db->get()->result_array();
		//echo $this->db->last_query();
		//die();
		return $closing_report;
	}
	public function getSupervisorById($supervisor_id)
	{
		$this->db->where('supervisor_id',$supervisor_id);
		$supervisor=$this->db->get('supervisor_mst')->result_array();
		return $supervisor;
	}
	public function getCitiesById($cityId)
	{
		$this->db->where('id',$cityId);
		$city=$this->db->get('cities')->result_array();
		return $city;
	}
	public function getSitesById($site_id)
	{
		$this->db->where('site_id',$site_id);
		$site=$this->db->get('sites')->result_array();
		return $site;
	}
	public function getTechnicianById($technician_id)
	{
		$this->db->where('technician_id',$technician_id);
		$technician=$this->db->get('technician_mst')->result_array();
		return $technician;
	}
}