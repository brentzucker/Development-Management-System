<?php
require_once 'Database.php';
require_once 'Contact.php';
require_once 'Time.php';
require_once 'Client.php';

class Developer
{
	private $Info = array(
		"Team"=>"",
		"Username"=>"",
		"Position"=>"",
		"Contact"=>"",
		);
	private $Client_List = array();
	private $Project_List = array();
	private $Task_List = array();
	private $Time_Log = array();
	private $Current_TimeLog;

	function __construct($Username)
	{
		$db_entry_Developer = returnRowByUser("Developer", $Username);

		$this->Info['Team'] = $db_entry_Developer['Team'];
		$this->Info['Username'] = $db_entry_Developer['Username'];
		$this->Info['Position'] = $db_entry_Developer['Position'];

		$db_entry_Contact = returnRowByUser("Contact", $Username);

		$this->Info['Contact'] = new Contact(
			 $db_entry_Contact['Username'],
			 $db_entry_Contact['Firstname'], 
			 $db_entry_Contact['Lastname'],
			 $db_entry_Contact['Phone'],
			 $db_entry_Contact['Email'],
			 $db_entry_Contact['Address'],
			 $db_entry_Contact['City'],
			 $db_entry_Contact['State']);
	}

	function getInfo()
	{	
		return array_merge($this->getDeveloperInfo(), $this->getContact()->getInfo());
	}

	function getDeveloperInfo()
	{
		$developer_info = array("Team"=>$this->Info['Team'], "Username"=>$this->Info['Username'], "Position"=>$this->Info['Position']);
		return $developer_info;
	}

	function getClientList()
	{
		return $this->Client_List;
	}

	function getProjectList()
	{
		return $this->Project_List;
	}

	function getTaskList()
	{
		return $this->Task_List;
	}

	function getTimeLog()
	{
		return $this->Time_Log;
	}

	function getContact()
	{
		return $this->Info['Contact'];
	}

	function getTeam()
	{
		return $this->Info['Team'];
	}

	function setTeam($s)
	{
		$this->Info['Team'] = $s;
		updateTableByUser('Developer', 'Team', $s, $this->Username);
	}

	function getUsername()
	{
		return $this->Info['Username'];
	}

	function setUsername($s)
	{
		$this->Info['Username'] = $s;
		updateTableByUser('Developer', 'Username', $s, $this->Username);
	}

	function getPosition()
	{
		return $this->Info['Position'];
	}

	function setPosition($s)
	{
		$this->Info['Position'] = $s;
		updateTableByUser('Developer', 'Position', $s, $this->Username);
	}

	function assignClient($ClientObject)
	{
		array_push($this->Client_List, $ClientObject);
	}

	function assignProject($ProjectObject)
	{
		array_push($this->Project_List, $ProjectObject);
	}

	function assignTask($TaskObject)
	{
		newDeveloperAssignments($this->getUsername(), $TaskObject->getTaskID(), 'Task');
		array_push($this->Task_List, $TaskObject);
	}

	function clockIn()
	{
		//$this->Current_TimeLog();
	}

	function newTimeLog()
	{
		//array_push($this->Time_Log, )
	}
}
?>