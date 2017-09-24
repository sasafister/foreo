<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Todo;
use AppBundle\Form\TodoListFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TodoListController extends Controller
{

    /**
     * @Route("/", name="home")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $todos = $em->getRepository('AppBundle:Todo')->findAll();

        return $this->render('todo/index.html.twig', [
            'todos' => $todos
        ]);
    }

    /**
     * @Route("/todo/create", name="create_todo")
     */
    public function createAction(Request $request)
    {

        $form = $this->createForm(TodoListFormType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $todo = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($todo);
            $em->flush();

            return $this->redirectToRoute('home');

        }

        return $this->render('/todo/create.html.twig', [
            'todoListForm' => $form->createView()
        ]);
    }


    /**
     * @Route("/todo/{id}", name="show_todo")
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $todo = $em->getRepository('AppBundle:Todo')->find($id);

        return $this->render('todo/show.html.twig', [
            'todo' => $todo
        ]);
    }

    /**
     * @Route("/todo/{id}/edit", name="edit_todo")
     */
    public function editAction(Request $request, Todo $todo)
    {
        $form = $this->createForm(TodoListFormType::class, $todo);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $todo = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($todo);
            $em->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('todo/edit.html.twig', [
            'todo' => $todo,
            'todoListForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/todo/{id}/remove", name="remove_todo")
     */
    public function removeAction($id) {
        $em = $this->getDoctrine()->getManager();

        $todo = $em->getRepository(Todo::class)->find($id);
        $em->remove($todo);
        $em->flush();

        return $this->redirectToRoute('home');
    }
}
