<?php
class User {
	private $_db, $_data, $_sessionName, $_isLoggedIn;
	public function __construct($user = null) {
		$this->_db = DB::getInstance();
		$this->_sessionName = Config::get('session/session_name');
		if(!$user){
			if(Session::exists($this->_sessionName)){
				$user = Session::get($this->_sessionName);
				if($this->find($user)){
					$this->_isLoggedIn = true;
				}else{
					$this->logout();
				}
			}
		} else {
			$this->find($user);
		}
	}
	public function update($fields = array(), $username = null) {
		if(!$username && $this->isLoggedIn())
			$username = $this->data()->username;
		if(!$this->_db->uppdate('Users', $username, $fields))
			throw new Exeption('Ett fel uppstod vid uppdatering av datan. ');
	}
	public function create($fields) {
		if(!$this->_db->insert('Users', $fields))
			throw new Exeption('Kunde inte skapa en ny användare');
	}
	public function login($username = null, $password = null) {
		$user = $this->find($username);
		
		if($user){
			if($this->data()->password === Hash::make($password, $this->data()->salt)){
				Session::put($this->_sessionName, $this->data()->username);
				return true;
			}
		}
		return false;
	}
	public function find($username = null) {
		if($username){
			$data = $this->_db->get('Users', array('username', '=', $username));
			if($data->count()) {
				$this->_data = $data->first();
				return true;
			}
		}
		return false;
	}
	public function isAdmin() {
		return ($this->data()->regionId == -1) ? true : false;
	}
	public function logout() {
		Session::delete($this->_sessionName);
	}
	public function data() {
		return $this->_data;
	}
	public function isLoggedIn() {
		return $this->_isLoggedIn;
	}
}