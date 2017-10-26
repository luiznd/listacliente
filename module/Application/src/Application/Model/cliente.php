<?php

namespace Application\Model;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class cliente {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue("AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nome;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $email;
    
    /**
     * @ORM\Column(type="string", length=45)
     */
    private $telefone;   
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $foto;      

    /**
     * @ORM\Column(type="datetime")
     */
    private $created;


    public function __construct() {
        $this->created = date('Y-m-d H:i:s'); 
    }

    public function getId() {
        return $this->id;
    }

    public function setId($Value) {
        $this->id = $Value;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($Value) {
        $this->nome = $Value;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($Value) {
        $this->email = $Value;
    }
    
    public function getTelefone() {
        return $this->telefone;
    }

    public function setTelefone($Value) {
        $this->telefone = $Value;
    }    
    
    public function getFoto() {
        return $this->foto;
    }

    public function setFoto($Value) {
        $this->foto = '/cliente/data/imagens/'.$Value;
    }        

    public function getCreated() {
        return $this->created;
    }

    public function setCreated($Value) {
        $this->created = $Value;
    }
    public function modifiedDate() {
        $this->setCreated(new \DateTime("now"));
    }    
    public function uploadFoto($file)  {
        $dirraiz = getcwd();
        $dir = str_replace("\\","/",$dirraiz);
        $imagem_dir = $dir.'/data/imagens/';
        move_uploaded_file($file['tmp_name'], $imagem_dir . $file['name']);
    }
    public function deleteFoto($file)  {
        $arq = str_replace("/cliente","",$file);
        $dirraiz = getcwd();
        $dir = str_replace("\\","/",$dirraiz);
        $imagem_dir = $dir.$arq;
        unlink($imagem_dir);
    }    

}
