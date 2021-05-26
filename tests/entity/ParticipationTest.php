<?php


namespace App\Tests\entity;


use App\Entity\Participation;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ParticipationTest extends KernelTestCase
{
    private $validator;

    protected function setUp(): void
    {

        $kernel = self::bootKernel();
        $kernel->boot();
        $this->validator = $kernel->getContainer()->get("validator");
    }

    public function testInstanceOf ()
    {
        $participation = new Participation();
        $this->assertInstanceOf(Participation::class, $participation);
        $this->assertClassHasAttribute("createdDate",$participation::class);
    }

}