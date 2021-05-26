<?php


namespace App\Controller;


use App\Repository\PollsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class SondageController extends AbstractInertiaController
{
    #[Route('/sondage', name: 'sondage')]
    public function listPolls (PollsRepository $pollsRepository):Response
    {
        $polls = $pollsRepository->findAll();
        //dd($polls);
        return $this->renderWithInertia(
            'Sondage/ListPolls',
            [
                'prop' => $polls
            ]
        );
    }

    /**
     * @param Request $request
     * @return Response
     * @Route ("/pollsConfirmed",name="polls_confirmed")
     */
    public function addSondage(Request $request):Response
    {
        $data = $request->getContent();
        $data = json_decode($data, true);
        dd($data);

    }



}