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
			'issue_desc'=>$issueDesc
			);
		$status=$this->db->insert('complain_mst',$user_data);
		$id=$this->db->insert_id();
		$this->db->where('id',$id);
		$ticket_id=array(
			'ticket_id'=>$id
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
		
			$user_data=array(
			'ticket_id'=>$ticket_id,
			'issue_comment'=>$techComment
			);
			$this->db->insert('closing_comment',$user_data);
			$this->db->where('ticket_id',$ticket_id);
			$user_data=array(
			'status'=>1
			);
			$this->db->update('complain_mst',$user_data);
			$sucess_status_issue=1;
		}
		return $sucess_status_issue;
	}
	
}