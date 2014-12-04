<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Discipline;
use AppBundle\Entity\Session;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as Extra;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

    /**
     * @Extra\Route("", name="home", methods={"GET"})
     *
     * @return array
     */
    public function indexAction()
    {
        return $this->render(':Default:index.html.twig');
    }

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

    /**
     * @param Request $request
     *
     * @Extra\Route("/session", name="session", methods={"POST"})
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function sessionAction(Request $request)
    {
        if (! $request->getContent()) {
            return new JsonResponse(['error' => 'no content posted ?!?'], 500);
        }

        $content = json_decode($request->getContent(), true);

        $termRepo = $this->getDoctrine()->getRepository('AppBundle:Term');
        $term = $termRepo->find($content['termId']);

        if (!$term) {
            return new JsonResponse(['error' => sprintf('term with id not found?!?', $content['termId'])], 404);
        }

        $disciplineRepo = $this->getDoctrine()->getRepository('AppBundle:Discipline');
        $discipline = $disciplineRepo->findOneBy(['machineName' => $content['discipline'] ]);

        if (!$discipline) {
            return new JsonResponse(['error' => sprintf('discipline with id not found?!?', $content['discipline'])], 404);
        }

        $session = new Session();
        $session
            ->setDiscipline($discipline)
            ->setTerm($term)
            ->setTime($content['time'])
        ;
        $this->getDoctrine()->getManager()->persist($session);
        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse(['success' => 'ok'], 200);
    }
}
