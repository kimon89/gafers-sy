<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Post;

class DefaultController extends Controller
{
    /**
     * @Route("/post", name="post")
     */
    public function PostAction(Request $request)
    {
        if ($request->isMethod('GET')) {
            $repository = $this->getDoctrine()->getRepository('AppBundle:Post');
            $post = $repository->findOneBy([
                'title' => $request->request->get('title')
            ]);
            return $this->render('default/index.html.twig', [
                'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
            ]);
        }
        $post = new Post();
        $post->setTitle($request->request->get('title'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($post);
        $em->flush();
        
    }
}
