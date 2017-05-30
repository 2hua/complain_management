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
}