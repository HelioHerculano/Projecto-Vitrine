<?php

class Visitante{

	private $_db,
			$_data,
			$_sessionName,
			$_cookieName,
			$_isLoggedIn;

	public function __construct($user = null){
		$this->_db = DB::getInstance();

		$this->_sessionName = Config::get('session/session_name');
		$this->_cookieName = Config::get('remember/cookie_name');

		if(!$user){
			if(Session::exists($this->_sessionName)){

				$user = Session::get($this->_sessionName);
				
				if($this->find($user)){
					$this->_isLoggedIn = true;
				}else{
					//process logout
				}
			}  
		}else{
			$this->find($user);
		}
	}


		public function All(){
		return $this->_db->query("SELECT * FROM users");
	}


	public function update($fields = [], $id = null){

		if(!$id && $this->isLoggedIn()){
			$id = $this->data()->id;
		}

		if(!$this->_db->update('users',$id,$fields)){
			echo "update";
			throw new Exception('There was a problem updating');
		}
	}

	public function subscribe($fields = []){
		if(!$this->_db->insert('visitantes',$fields)){
			throw new Exception("There was a problem creating an count.");
		}
		return true;
	}

	public function find($visitante){
		if($visitante) {
			$field = (is_numeric($visitante)) ? 'id' : 'email';
			$data = $this->_db->get('visitantes',[$field , '=', $visitante]);
		
			if($data->count()){

				$this->_data = $data->first();

				return true;
			}

		}
		return false;
	}

	public function subscribeSession($email = null,$remember = false){
		
			$visitante = $this->find($email);

			if($visitante){
				
						//Session::put($this->_sessionName, $this->data()->id);


						if($remember){
							$hash = Hash::unique();
							$hashCheck = $this->_db->get('visitantes_session', ['vistante_id','=',$this->data()->id]);

							if(!$hashCheck->count()){
								$this->_db->insert('visitantes_session',[
									'vistante_id' => $this->data()->id,
									'hash' => $hash
								]);
							}else{
								$hash = $hashCheck->first()->hash;
							}

							Cookie::put($this->_cookieName, $hash, Config::get('remember/cookie_expiry'));

						}
						
						return true;
				
			}
		
		return false;
	}

	public function hasPermission($key){
		$group = $this->_db->get('groups',['id', '=', $this->data()->group]);
		//print_r($group->first());
		if($group->count()){
			$permissions = json_decode($group->first()->permissions, true);
			
			if($permissions[$key] == true){
				return true;
			}
		}
		return false;
	}

	public function exists(){
		return (!empty($this->_data)) ? true : false;
	}

	public function logout(){

		$this->_db->delete('users_session',['user_id', '=', $this->data()->id]);

		Session::delete($this->_sessionName);
		//Cookie::delete($this->_cookieName);
	}

	public function data(){
		return $this->_data;
	}

	public function isLoggedIn(){
		return $this->_isLoggedIn;
	}

}

