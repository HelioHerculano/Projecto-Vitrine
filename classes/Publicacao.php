<?php
class Publicacao{
    private $_db,$_data;

    public function __construct(){
        $this->_db = DB::getInstance();
    }

    public function uploadArquivos($IdFaculdade=null){
		//session_start();
		print_r($_FILES);

		$permitidos = ['image/jpeg', 'image/jpeg', 'image/png'];

		if(in_array($_FILES['arquivo']['type'], $permitidos)){

			$nome = md5(time().rand(0,1000)).'.jpg';

			$nomeTemp = str_replace('/','\\',$_FILES['arquivo']['tmp_name']);
			$dir = str_replace('/','\\',__DIR__).'/../img/arquivos/'.$nome;
			$dir_final = str_replace('/','\\',$dir);
			move_uploaded_file($nomeTemp, $dir_final);
            $urlImage = 'img/arquivos/'.$nome;

            $this->publicarArquivo(['url'=>$urlImage,
                              'data'=>date('Y-m-d H:i:s'),
                              'id_faculdade'=>$IdFaculdade
                                ]);

	}

    return true;

}


public function sobreArquivo($titulo,$assunto){
    $idArquivo = $this->getLastId()->results()[0]->id;
    $this->publicarSobreArquivo(['titulo'=>$titulo,
                                  'assunto'=>$assunto,
                                  'id_arquivo'=>$idArquivo 
                                    ]);
}


public function publicarEventos($fields = []){
    if(!$this->_db->insert('eventos',$fields)){
        throw new Exception("There was a problem creating an count.");
    }
}

public function publicarArquivo($fields = []){
    if(!$this->_db->insert('arquivos',$fields)){
        throw new Exception("There was a problem creating an count.");
    }
}

public function publicarSobreArquivo($fields = []){
    if(!$this->_db->insert('sobrearquivos',$fields)){
        throw new Exception("There was a problem creating an count.");
    }
}

public function getPublicacaoArquivo(){
    return $this->_db->query("SELECT * FROM arquivos INNER JOIN sobrearquivos WHERE arquivos.id = sobrearquivos.id_arquivo");
}

public function getEvent(){
    return $this->_db->query("SELECT * FROM eventos");
}

public function getLastId(){
    return $this->_db->query("SELECT MAX(id) as id FROM arquivos");
}



}