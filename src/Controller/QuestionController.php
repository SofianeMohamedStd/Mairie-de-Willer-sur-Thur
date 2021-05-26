<?php


namespace App\Controller;

use App\Repository\AnswerRepository;
use App\Repository\QuestionsRepository;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionController extends AbstractInertiaController
{
    #[Route('/sondage/{id}', name: 'sondageID')]
    public function Questionnaire (QuestionsRepository $questionsRepository,
                                   Request $request,
                                    int $id): Response
    {
        $data = $request->getContent();
        //dd($data);
        $data = json_decode($data, true);
        //dd($data);
        //$id = $data['idPolls'];
        //dd($id);
        $questionnaire = $questionsRepository->findby(["polls"=>$id]);

        foreach ($questionnaire as $quest)
        {
                $result1[] = array(
                    "id" => $quest->getId(),
                    "question" => $quest->getWording(),
                     "multiple" => $quest->getMultipleChoice(),
                     "answers" => $quest->getAnswers()->toArray()
                );
        }

        //dd($result1);

        return $this->renderWithInertia(
            'Sondage/ListQuestions',
            ['prop' => $result1, 'pop' => $id]
        );
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    #[Route('/sondageUser', name: 'sondageUser')]
    public function addPollsUser(Request $request):RedirectResponse
    {
        $data = $request->getContent();
        $data = json_decode($data, true);
        //dd($data);

        return $this->redirectToRoute('profile');

    }

}