<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\Article;
use AppBundle\Entity\Comment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

class ArticleController extends Controller
{
    /**
     * @Route("/api/article", name="articles", methods={"GET"})
     */
    public function articleAction()
    {
        $repository = $this->getDoctrine()->getRepository(Article::class);
        $articles   = $repository->findAll();

        $normalizer = new GetSetMethodNormalizer();
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });

        $serializer = new Serializer([$normalizer], [new JsonEncoder()]);
        $json       = $serializer->serialize($articles, 'json');

        return JsonResponse::fromJsonString($json);
    }

    /**
     * @Route("/api/article/{id}", name="articleId", methods={"GET"})
     */
    public function articleIdAction($id)
    {
        $repository = $this->getDoctrine()->getRepository(Article::class);
        $article    = $repository->find($id);
        $data       = $article ? $article : ['error' => 'No such an article (id:' . $id . ')'];

        $normalizer = new GetSetMethodNormalizer();
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });

        $serializer = new Serializer([$normalizer], [new JsonEncoder()]);

        $json = $serializer->serialize($data, 'json');

        return JsonResponse::fromJsonString($json);
    }

    /**
     * @Route("/api/article/{id}/comments", name="articleComment", methods={"GET"})
     */
    public function articleCommentAction($id)
    {
        $repository = $this->getDoctrine()->getRepository(Comment::class);
        $comments   = $repository->findBy(
            ['article' => $id]
        );

        $data = $comments ? $comments : ['error' => 'No such an article (id:' . $id . ')'];

        $normalizer = new GetSetMethodNormalizer();
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });

        $serializer = new Serializer([$normalizer], [new JsonEncoder()]);

        $json = $serializer->serialize($data, 'json');

        return JsonResponse::fromJsonString($json);
    }
}
