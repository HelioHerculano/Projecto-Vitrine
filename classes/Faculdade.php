<?php

class Faculdade{

	private $_db,
			$_data;

	public function __construct($faculdade = null){

		
			$this->_db = DB::getInstance();

			$this->find($faculdade);

			
	}


	public function All(){
		return $this->_db->query("SELECT * FROM faculdades");
	}

	public function update($fields = [], $id = null){

	
			$id = $this->data()->id;

			//echo $id;
	
		if(!$this->_db->update('faculdades',$id,$fields)){
			echo "update";
			throw new Exception('There was a problem updating');
		}
	}


	
	public function create($fields = []){
		if(!$this->_db->insert('faculdades',$fields)){
			throw new Exception("There was a problem creating an count.");
		}
	}

	public function find($user){
		if($user) {
			$field = (is_numeric($user)) ? 'id' : 'id';
			$data = $this->_db->get('faculdades',[$field , '=', $user]);
		
			if($data->count()){

				$this->_data = $data->first();

				return true;
			}

		}
		return false;
	}



	 

	public function exists(){
		return (!empty($this->_data)) ? true : false;
	}

	

	public function data(){
		return $this->_data;
	}


}