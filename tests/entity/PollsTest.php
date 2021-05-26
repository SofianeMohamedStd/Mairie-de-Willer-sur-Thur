<?php


namespace App\Tests\entity;


use App\Entity\Polls;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


class PollsTest extends KernelTestCase
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
        $polls = new Polls();
        $this->assertInstanceOf(Polls::class, $polls);
        $this->assertClassHasAttribute("title",Polls::class);
        $this->assertClassHasAttribute("createdDate",Polls::class);
        $this->assertClassHasAttribute("publishedDate",Polls::class);
        $this->assertClassHasAttribute("finishedDate",Polls::class);
        $this->assertClassHasAttribute("answerPublishedDate",Polls::class);
    }

    /**
     * @dataProvider ProviderInvalidTitle
     * @param $title
     */
    public function testInvalidTitle($title)
    {
        $polls = new Polls();

        $polls->setTitle($title);
        $errors = $this->validator->validate($polls);
        $this->assertGreaterThanOrEqual(1, count($errors));
    }

    public function ProviderInvalidTitle(): array
    {
        return [
            [""]
        ];
    }


    /**
     * @dataProvider ProviderValidTitle
     * @param $title
     */
    public function testValidTitle($title){
        $polls = new Polls();

        $polls->setTitle($title);
        $errors = $this->validator->validate($polls);
        $this->assertCount(0, $errors);
    }

    public function ProviderValidTitle(): array
    {
        return [
        ["questionnaire d’évaluation d’un service"]
        ];
    }

    /**
     * @dataProvider ProviderInvalidPublishedDate
     * @param $date
     */
    public function testInvalidPublishedDate($date)
    {
        $polls = new Polls ();

        $polls->setCreatedDate($date);
        $errors = $this->validator->validate($polls);
        $this->assertGreaterThanOrEqual(2, count($errors));
    }

    public function ProviderInvalidPublishedDate(): array
    {
        return [

                [DateTime::createFromFormat('Y-m-d','2021-05-16')]
        ];
    }

    /**
     * @dataProvider ProviderValidPublishedDate
     * @param $date
     */
    public function testValidPublishedDate($date)
    {
        $polls = new Polls ();

        $polls->setCreatedDate($date);
        $errors = $this->validator->validate($polls);
        $this->assertCount(1, $errors);
    }

    public function ProviderValidPublishedDate(): array
    {
        return [

            [DateTime::createFromFormat('Y-m-d','2021-05-17')]
        ];
    }

    /**
     * @dataProvider ProviderInvalidFinishedDate
     * @param $date
     */
    public function testInvalidFinishedDate($date)
    {
        $polls = new Polls();
        $publishedDate = DateTime::createFromFormat('Y-m-d', '2021-05-20');
        $result = $polls->setFinishedDate($date,$publishedDate);
        $this->assertSame($result, false);
    }

    public function ProviderInvalidFinishedDate(): array
    {
        return [
            [DateTime::createFromFormat('Y-m-d', '2021-05-16')]
        ];
    }

    /**
     * @dataProvider ProviderValidFinishedDate
     * @param $date
     */
    public function testValidFinishedDate($date)
    {
        $polls = new Polls();
        $publishedDate = DateTime::createFromFormat('Y-m-d', '2021-05-20');
        $result = $polls->setFinishedDate($date,$publishedDate);
        $this->assertSame($result, true);
    }

    public function ProviderValidFinishedDate(): array
    {
        return [
            [DateTime::createFromFormat('Y-m-d', '2021-05-25')]
        ];
    }

    /**
     * @dataProvider ProviderInvalidAnswerPublishedDate
     * @param $date
     */
    public function testInvalidAnswerPublishedDate($date)
    {
        $polls = new Polls();
        $finishedDate = dateTime::createFromFormat('Y-m-d','2021-05-25');
        $result = $polls->setAnswerPublishedDate($date,$finishedDate);
        $this->assertSame($result, false);
    }

    public function ProviderInvalidAnswerPublishedDate() :array
    {
        return [[DateTime::createFromFormat('Y-m-d', '2021-05-24')]

        ];
    }

    /**
     * @dataProvider ProviderValidAnswerPublishedDate
     * @param $date
     */
    public function testValidAnswerPublishedDate($date)
    {
        $polls = new Polls();
        $finishedDate = dateTime::createFromFormat('Y-m-d','2021-05-25');
        $result = $polls->setAnswerPublishedDate($date,$finishedDate);
        $this->assertSame($result, true);
    }

    public function ProviderValidAnswerPublishedDate() :array
    {
        return [[DateTime::createFromFormat('Y-m-d', '2021-05-30')]

        ];
    }

}