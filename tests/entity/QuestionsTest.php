<?php


namespace App\Tests\entity;


use App\Entity\Questions;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class QuestionsTest extends KernelTestCase
{
    private ?object $validator;

    protected function setUp(): void
    {

        $kernel = self::bootKernel();
        $kernel->boot();
        $this->validator = $kernel->getContainer()->get("validator");
    }

    public function instanceOf()
    {
        $question = new Questions();
        $this->assertInstanceOf(Questions::class, $question);
        $this->assertClassHasAttribute("wording",Questions::class);
        $this->assertClassHasAttribute("multipleChoice",Questions::class);
    }

    /**
     * @dataProvider ProviderInvalidWording
     * @param $wording
     */
    public function testInvalidWording($wording)
    {
        $question = new Questions();
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
        $question = new Questions();
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

    /**
     * @dataProvider ProviderInvalidMultipleChoice
     * @param $multipleChoice
     */
    public function testInvalidMultipleChoice($multipleChoice)
    {
        $question = new Questions();
        $question->setMultipleChoice($multipleChoice);
        $errors = $this->validator->validate($question);
        $this->assertGreaterThanOrEqual(1, count($errors));

    }

    public function ProviderInvalidMultipleChoice(): array
    {
        return [
            ["hello"]
        ];
    }

    public function testValidMultipleChoice()
    {
        $question = new Questions();
        $multipleChoice = false;
        $question->setMultipleChoice($multipleChoice);
        $errors = $this->validator->validate($question);
        $this->assertCount(1, $errors);

    }

}