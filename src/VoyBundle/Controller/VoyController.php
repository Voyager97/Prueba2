<?php

namespace VoyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use VoyBundle\Entity\Usuarios;

class VoyController extends Controller
{
    public function mostrarAction()
    {
         $varphp1 = 50;
         $varphp2 = 12;
         $varphp3 = 3;
         return $this->render("VoyBundle::Vista.html.twig", array("varphp1" => $varphp1, "varphp2" => $varphp2, "varphp3" => $varphp3));
    }

    public function verAction()
    {
      return $this->render('VoyBundle::Vista2.html.twig');
    }

    public function nombreAction($nombre)
    {
      return $this->render('VoyBundle::Vista3.html.twig', array("nombre" => $nombre));
    }

    public function formularioGetAction(Request $request){

      $nombre = $request->get("nombre");
      $apellidos = $request->get("apellidos");
      $edad = $request->get("edad");
      $email = $request->get("email");

      return $this->render('VoyBundle::Vista3.html.twig', array(
        "nombre" => $nombre,
        "apellidos"=> $apellidos,
        "edad"=>$edad,
        "email"=>$email
        ));
    }

    public function vistaUsuariosAction()
    {
      $em = $this->getDoctrine()->getManager();
      $usuariosRepo = $em->getRepository("VoyBundle:Usuarios");
      $usuariosAll = $usuariosRepo->finAll();

      return $this->render("VoyBundle::usuarios.html.twig", array("usuarios" => $usuariosAll));

    }

    public function formUsuariosAction()
    {
      return $this->render("VoyBundle::CrearUsuarios.html.twig");
    }

    public function crearUsuariosAction()
    {

      $request = Request::createFromGlobals();
      $em = $this->getDoctrine()->getManager();
      $usuario = new Usuarios();

      $nombre = $request->get("nombre");
      $apellidos = $request->get("apellidos");
      $edad = $request->get("edad");
      $correo = $request->get("correo");
      $ocupacion = $request->get("ocupacion");

      $usuario->setNombre($nombre);
      $usuario->setApellidos($apellidos);
      $usuario->setEdad($edad);
      $usuario->setCorreo($correo);
      $usuario->setOcupacion($ocupacion);+

      $em->persist($usuario);
      $em->flush();

      return $this->redirectToRoute("rutaCrearUsuarios");
    }

    public function mostrarUsuariosAction()
    {
      return $this->render("VoyBundle::usuarios.html.twig");
    }

    /*public function formularioGetVAction(Request $request){

      $nom = $request->get("nom");
      $ape = $request->get("ape");
      $ed = $request->get("ed");
      $em = $request->get("em");

      return $this->render('VoyBundle::VistaGet.html.twig', array(
          "nom" => $nom,
          "ape"=> $ape,
          "ed"=>$ed,
          "em"=>$em
          ));
    }*/

}
