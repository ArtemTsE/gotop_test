<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\Comment;
use AppBundle\Entity\Article;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

class CommentController extends Controller
{
    /**
     * @Route("/api/comment", name="comments", methods={"GET"})
     */
    public function commentAction()
    {
        $repository = $this->getDoctrine()->getRepository(Comment::class);
        $comments   = $repository->findAll();

        $normalizer = new GetSetMethodNormalizer();
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });

        $serializer = new Serializer([$normalizer], [new JsonEncoder()]);

        $json = $serializer->serialize($comments, 'json');

        return JsonResponse::fromJsonString($json);
    }

    /**
     * @Route("/api/comment/{id}", name="commentId", methods={"GET"})
     */
    public function commentIdAction($id)
    {
        $repository = $this->getDoctrine()->getRepository(Comment::class);
        $comment = $repository->find($id);

        $data = $comment ? $comment : ['error' => 'No such a comment (id:' . $id . ')'];

        $normalizer = new GetSetMethodNormalizer();
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });

        $serializer = new Serializer([$normalizer], [new JsonEncoder()]);
        $json       = $serializer->serialize($data, 'json');

        return JsonResponse::fromJsonString($json);
    }
}