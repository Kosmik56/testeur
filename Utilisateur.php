<?php

class Client
{
    // property declaration
    private $_nom;
	private $_prenom;
	private $_numero;
	private $_email;
	private $_count;

    // method declaration
     function __construct($nom, $prenom, $numero, $email) {
       $this->_nom = $nom;
	   $this->_prenom = $prenom;
	   $this->_numero =$numero;
	   $this->_email = $email;
	   $this->_count = 0; 
    }
	public function __get(){
	
	
	
	}
	public function counter(){
	
	}		
}

?>