<?php

namespace App\Controller\Admin;

use App\Entity\Grupe;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\User;
use App\Form\UserType;
use App\Form\GroupType;
//use http\Env\Request;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminUserController extends AdminBaseController
{
    /**
     * @Route("/admin/user", name= "admin_user")
     */
    public function index()
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        $grupes = $this->getDoctrine()->getRepository(Grupe::class)->findAll();
        $forRender = parent::renderDefault();
        $forRender['title'] = 'Data of users';
        $forRender['users'] = $users;
        $forRender['grupes'] = $grupes;
        return $this->render('admin/user/index.html.twig', $forRender);
    }

    /**
     * @Route("/admin/user/create", name= "admin_user_create")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return RedirectResponse/Response
     */

    public function create(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {

        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $em = $this->getDoctrine()->getManager();
        $form->handleRequest($request);
        if (($form->isSubmitted()) && ($form->isValid())) {
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            $user->setRoles($user->getRoles());
           // echo $user->getGrupe() . "zzzzzzzzzzzzzzzzzzzzzz";

            $user->setGrupe($user->getGrupe());
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('admin_user');
        }
        $forRender = parent::renderDefault();
        $forRender['form'] = $form->createView();
        $forRender['title'] = 'create user form';
        return $this->render('admin/user/form.html.twig', $forRender);
    }

    /**
     * @Route("/admin/user/delete/{id}", name= "admin_user_delete")
     */
    public function deleteUser($id)
    {
        $em = $this->getDoctrine()->getManager();
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        foreach($users as $user) {
          $un = $user -> getUserName() ;
          if ($un == $id) {
              $em->remove($user);
              $em->flush();
          }
        }
        return $this->redirectToRoute('admin_user');
    }
    /**
     * @Route("/admin/user/del_group/{gr}", name= "admin_user_del_gr")
     */
    public function deleteGrupe($gr, Request $request){
        $grupes = $this->getDoctrine()->getRepository(Grupe::class)->findAll();
        $em = $this->getDoctrine()->getManager();
        foreach($grupes as $grupe) {
            $un = $grupe -> getName() ;
            if ($un == $gr) {
                $em->remove($grupe);
                $em->flush();
            }
        }
        return $this->redirectToRoute('admin_user');
        //
        //unset($grupes[$gr]);
       // $forRender = parent::renderDefault();
        //$grupa = new Grupe();
        //$form = $this->createForm(GroupType::class, $grupa);
        //$form->handleRequest($request);
        //$forRender['form'] = $form->createView();
        //$forRender['title'] = 'create new grupe';
        //return $this->render('admin/user/form.html.twig', $forRender);
    }
    /**
     * @Route("/admin/delete/{rl}", name= "super_delete")
     */
    public function deleteRoles($rl)
    {
       // echo  $rl."yyyyyyyyyyyyyyyyyyyyyy";
        $em = $this->getDoctrine()->getManager();
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        foreach($users as $user) {
            $un = implode($user -> getRoles()) ;
            if ($un == $rl) {
                $em->remove($user);
                $em->flush();
            }
        }

        return $this->redirectToRoute('admin_user');
    }
    /**
     * @Route("/admin/user/grupe", name= "admin_user_create_gr")
     */
    public function createGrupe(Request $request)
    {
        $grupa = new Grupe();
        $form = $this->createForm(GroupType::class, $grupa);
        $em = $this->getDoctrine()->getManager();
        $form->handleRequest($request);
        if (($form->isSubmitted()) && ($form->isValid())) {
            $em->persist($grupa);
            $em->flush();
            return $this->redirectToRoute('admin_user');
        }
        $forRender = parent::renderDefault();
        $forRender['form'] = $form->createView();
        $forRender['title'] = 'create user form';
        return $this->render('admin/user/form.html.twig', $forRender);
    }


    /**
     * @Route("/admin/user/add_group/{id}", name= "admin_user_add_gr")
     */
    public function addGrupeToUser($id, Request $request){
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        $em = $this->getDoctrine()->getManager();
        foreach($users as $user) {
            $un = implode($user -> getEmail()) ;
            if ($un == $id) {
                $user->setGrupe();
                $em->remove($user);
                $em->flush();
            }
        }
     //   $forRender['form'] = $form->createView();
        $forRender['title'] = 'create new grupe';
        return $this->render('admin/user/index.html.twig', $forRender);
    }
    public function getGrupe(Request $request) {

        $grupes = $this->getDoctrine()->getRepository(Grupe::class)->findAll();
        return $grupes;
    }
}