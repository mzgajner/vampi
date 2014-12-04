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
     * @Extra\Route("/game", name="game", methods={"POST"})
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function gameAction(Request $request)
    {
        $jsonSession = $request->get('session', null, true);

        if (! $jsonSession) {
            new JsonResponse(['error' => 'no session posted ?!?'], 500);
        }

        $sessionArray = json_decode($jsonSession);

        $termRepo = $this->getDoctrine()->getRepository('AppBundle:Term');
        $term = $termRepo->find($sessionArray['termId']);

        if (!$term) {
            new JsonResponse(['error' => sprintf('term with id not found?!?', $sessionArray['termId'])], 404);
        }

        $disciplineRepo = $this->getDoctrine()->getRepository('AppBundle:Discipline');
        $discipline = $disciplineRepo->findOneBy(['machineName' => $sessionArray['discipline'] ]);

        if (!$discipline) {
            new JsonResponse(['error' => sprintf('discipline with id not found?!?', $sessionArray['discipline'])], 404);
        }

        $session = new Session();
        $session
            ->setDiscipline($discipline)
            ->setTerm($term)
            ->setTime($sessionArray['time'])
        ;
        $this->getDoctrine()->getManager()->persist($session);
        $this->getDoctrine()->getManager()->flush();

        return new JsonResponse(['success' => 'ok'], 200);
    }
}
