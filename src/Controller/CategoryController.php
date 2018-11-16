<?php
/**
 * Created by PhpStorm.
 * User: lucile
 * Date: 16/11/18
 * Time: 13:22
 */

namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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
}