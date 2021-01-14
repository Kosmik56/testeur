<!--
@author L. S. D. Kidd
-->
<?php

class Client {

    private $_nom;
    private $_prenom;
    private $_numero;
    private $_email;
    private $_count;

    // method declaration
    function __construct($nom, $prenom, $numero, $email) {
        $this->_nom = $nom;
        $this->_prenom = $prenom;
        $this->_numero = $numero;
        $this->_email = $email;
        $this->_count = 0;
    }

	public function getCount($val){
		return $this->_count;
	}

    public function addCount($val) {
        $this->_count += $val;
		return $this;
    }
	
	public function getNom($t) {
        return $this->_nom;
    }

    public function addNom($t) {
        $this->_nom += $t;
		return $this;
    }

	public function getPrenom($val){
		return $this->_prenom;
	}
	
    public function addPrenom($t) {
        $this->_prenom += $t;
		return $this;
    }
	
	public function getNumero($val){
		return $this->_numero;
	}
	
    public function addNumero($t) {
        $this->numero += $t;
		return $this;
    }
	
	public function getEmail($val){
		return $this->_email;
	}
	
    public function addEmail($t) {
        $this->email += $t;
		return $this;
    }

}

?>