<?php
/**
 * Created by PhpStorm.
 * User: lucile
 * Date: 07/11/18
 * Time: 22:45
 */

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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

        $repository = $this->getDoctrine()->getRepository(Article::class);
        $articles = $repository->findAll();

        if (!$articles) {
            throw $this->createNotFoundException(
                'No article found in article\'s table.'
            );
        }

        // Les méthodes getArticles() et getCategory() sont utilisées dans la vue Twig.

        return $this->render(
            'blog/index.html.twig',
            [
                'categories' => $categories,
                'articles' => $articles
            ]
        );
    }

    /**
     * Getting a article with a formatted slug for title
     *
     * @param string $slug The slugger
     *
     * @Route("/blog/{slug}",
     *     defaults={"slug" = null},
     *     requirements={"slug"="[a-z0-9-]+"},
     *     name="blog_show")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show($slug)
    {
        if (!$slug) {
            throw $this
                ->createNotFoundException('No slug has been sent to find an article in article\'s table.');
        }

        $slug = preg_replace(
            '/-/',
            ' ', ucwords(trim(strip_tags($slug)), "-")
        );

        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findOneBy(['title' => mb_strtolower($slug)]);

        if (!$article) {
            throw $this->createNotFoundException(
                'No article with ' . $slug . ' title, found in article\'s table.'
            );
        }
    }

    /**
     * @Route("/blog/category/{category}", name="blog_show_category")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showByCategory(string $category)
    {
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findBy(
                ['category'=>$category],
                ['id' => 'DESC'],
                3
            );

        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneBy(['name' => $category]);

        return $this->render('blog/category.html.twig',[
                'category' => $category,
                'articles' => $articles
            ]
        );
    }
}
