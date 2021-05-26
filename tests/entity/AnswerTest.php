<?php


namespace App\Tests\entity;


use App\Entity\Answer;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AnswerTest extends KernelTestCase
{
    private ?object $validator;

    protected function setUp(): void
    {

        $kernel = self::bootKernel();
        $kernel->boot();
        $this->validator = $kernel->getContainer()->get("validator");
    }

    public function testInstanceOf()
    {
        $answers = new Answer();
        $this->assertInstanceOf(Answer::class, $answers);
        $this->assertClassHasAttribute("wording",Answer::class);
    }

    /**
     * @dataProvider ProviderInvalidWording
     * @param $wording
     */
    public function testInvalidWording($wording)
    {
        $question = new Answer();
        $question->setWording($wording);
        $errors = $this->validator->validate($question);
        $this->assertGreaterThanOrEqual(1, count($errors));
    }

    public function ProviderInvalidWording(): array
    {
        return [
            [""]
        ];
    }

    /**
     * @dataProvider ProviderValidWording
     * @param $wording
     */
    public function testValidWording($wording)
    {
        $question = new Answer();
        $question->setWording($wording);
        $errors = $this->validator->validate($question);
        $this->assertCount(0, $errors);
    }

    public function ProviderValidWording(): array
    {
        return [
            ["questionnaire d’évaluation d’un service"]
        ];
    }

}