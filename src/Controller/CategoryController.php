<?php
/**
 * Created by PhpStorm.
 * User: lucile
 * Date: 11/11/18
 * Time: 21:30
 */

namespace App\Controller;


use App\Entity\Category;
use Egulias\EmailValidator\Warning\Comment;
use Symfony\Component\BrowserKit\Response;

/**
 * @method render(string $string, array $array)
 */
class CategoryController
{
    /**
     * @Route("/category/{id}", name="category_show")
     */
    public function show(Category $category): Response
    {
        return $this->render('category.html.twig', [
                'category' => $category,
            ]
        );
    }

    /**
     * @Route("/category/{category}/comment/{comment}", name="show_article_comment")
     */
    public function showCategoryComment(Category $category, Comment $comment): Response
    {
        return $this->render('comment.html.twig', [
                'category'=>$category,
                'comment'=>$comment,
            ]
        );
    }
}
