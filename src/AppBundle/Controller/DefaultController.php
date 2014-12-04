<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Discipline;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as Extra;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    /**
     * @param Discipline $discipline
     *
     * @Extra\Route("/term/{discipline}", name="term", methods={"GET"})
     * @Extra\ParamConverter("discipline", class="AppBundle:Discipline", options={"mapping": {"discipline" = "machineName"}})
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function termAction(Discipline $discipline = null)
    {
        $termRepo = $this->getDoctrine()->getRepository('AppBundle:Term');

        $term = $termRepo->findRandomTerm($discipline);

        return new JsonResponse($term->toJsonArray());
    }
}
