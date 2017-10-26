<?php

/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {

    public function indexAction() {
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $lista = $em->getRepository("Application\Model\cliente")->findAll();
        return new ViewModel(array('lista' => $lista));
    }

    public function excluirAction() {
        $id = $this->params()->fromRoute("id", 0);
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
        $cliente = $em->find("Application\Model\cliente", $id);
        $cliente->deleteFoto($cliente->getFoto());
        $em->remove($cliente);
        $em->flush();


        return $this->redirect()->toRoute('application/default', array('controller' => 'index', 'action' => 'index'));
    }

    public function editarAction() {
        $id = $this->params()->fromRoute("id", 0);
        $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");

        $cliente = $em->find("Application\Model\cliente", $id);
        $request = $this->getRequest();
        if ($request->isPost()) {
            try {
                $foto = $request->getFiles("foto");
                $nome = $request->getPost("nome");
                $email = $request->getPost("email");
                $telefone = $request->getPost("telefone");
                
                if ($foto['name'] !=''){
                    $cliente->setFoto($foto['name']);
                }                
                $cliente->setNome($nome);
                $cliente->setEmail($email);
                $cliente->setTelefone($telefone);
                $cliente->modifiedDate();

                $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
                $em->merge($cliente);
                $em->flush();
                $cliente->uploadFoto($foto);
            } catch (Exception $e) {
                
            }

            return $this->redirect()->toRoute('application/default', array('controller' => 'index', 'action' => 'index'));
        }

        return new ViewModel(array('f' => $cliente));
    }
    public function adicionarAction() {
          $request = $this->getRequest();
          $result = array();
          if($request->isPost())
          {
              try{
                  $foto = $request->getFiles("foto");
                  $nome = $request->getPost("nome");
                  $email = $request->getPost("email");
                  $telefone = $request->getPost("telefone");   
                  $cliente = new \Application\Model\Cliente();
                  $cliente->setFoto($foto['name']);
                  $cliente->setNome($nome);
                  $cliente->setEmail($email);
                  $cliente->setTelefone($telefone);
                  $cliente->modifiedDate();
   
                  $em = $this->getServiceLocator()->get("Doctrine\ORM\EntityManager");
                  $em->persist($cliente);
                  $em->flush();
                  $cliente->uploadFoto($foto);
                  $result["resp"] = $nome. ", Adicionado corretamente!";
              }  catch (Exception $e){
                  
              }
              return $this->redirect()->toRoute('application/default', array('controller' => 'index', 'action' => 'index'));
          }
          
          return new ViewModel($result);
    }    

}
