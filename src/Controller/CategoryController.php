<?php
/**
 * Created by PhpStorm.
 * User: lucile
 * Date: 16/11/18
 * Time: 13:22
 */

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/catgory/{id}", name="category_show")
     */
    public function show(Category $category) :Response
    {
        return $this->render('category/showCategory.html.twig', [
            'category'=>$category
            ]
        );
    }
    /**
     * Form add a category
     *
     * @Route("/category",
     *     name = "blog_add_category")
     * @param $request Request
     * @return Response A response instance
     *
     */
    public function addFormCategory(Request $request) : Response
    {
        // 1. Build the form
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);

        // 2. handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // 3. Save the category
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute('blog_list_categories');
        }

        return $this->render(
            'blog/addCategory.html.twig', [
                'form' => $form->createView(),
            ]
        );
    }
}