<?php
class Upload{
	public $ficheiro,$pasta;
	private $formatos,$tipos_permitidos;

	public function operacao(){
#=====================Percorrer o array==============
		for ($i=0; $i < count($this->ficheiro) ; $i++) { 
#================tipos de extensões permetidos=============
			$this->tipos_permitidos = array('png','jpg','svg','jpeg');
#=========Pegando a Extensão dos arquivos==============================
			$this->formatos = strtolower(pathinfo($this->ficheiro[$i]['name'], PATHINFO_EXTENSION));
#========= Verificando se o arquivo extensão existe no array==========
			if(in_array($this->formatos, $this->tipos_permitidos)):
#======= verificanco se o directorio existe se não, cria-o ===========
				if(!is_dir($this->pasta)):
					mkdir($this->pasta);
				endif;
#========= movendo o arquivo, realizando o upload ========================
			$mover_ficheiro = move_uploaded_file($this->ficheiro[$i]['tmp_name'], $this->pasta.DIRECTORY_SEPARATOR.$this->ficheiro[$i]['name']);
#===========Verificando se o upload foi realizado ====================
				if($mover_ficheiro == true):
					echo "Upload Realizado Com Sucesso<br>";
				else:
					echo "Upload Not Realizado<br>";
				endif;
#======= Resultado caso a extensão do arquivo não existe no array ======
			else:
				echo "Formato Não Permetido";
			endif;
		}

	}
		
}
$uplaod = new Upload();
$uplaod->pasta='upload';
$uplaod->ficheiro =array($_FILES['arquivo1'],$_FILES['arquivo2'],$_FILES['arquivo3']);
$uplaod->operacao();