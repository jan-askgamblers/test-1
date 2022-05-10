<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    public function __construct(
        private ArticleRepository $articleRepository,
    ) {}

    #[Route('/', name: 'app_list')]
    public function __index(): Response
    {
        return $this->render('index.html.twig', [
            'articles' => $this->articleRepository->findBy([], limit: 10),
        ]);
    }
}
