<?php
// src/Controller/BlogController.php
namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class BlogController extends AbstractController
{

    /**
     * @Route("/blog", name="blog_list")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function list()
    {
        $repository = $this->getDoctrine()->getRepository(Category::class);
        $categories = $repository->findAll();

        // Les méthodes getArticles() et getCategory() sont utilisées dans la vue Twig.

        return $this->render('blog/index.html.twig', ['categories' => $categories]);
    }
}