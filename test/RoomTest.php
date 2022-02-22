<?php
use PHPUnit\Framework\TestCase;
use Faker\Factory as Faker;
use Campus\UnitTest\Models\Room;

class RoomTest extends TestCase 
{
   
    private \Faker\Generator $faker;
    private string $name;
    private string $description;
    private Room $room;

    public function setUp() : void 
    {
        $this->faker = Faker::create('fr_FR');
        $this->name = $this->faker->name();
        $this->description=$this->faker->words(4,true);
        $this->room = new Room(
            $this->name,
            $this->description
          );
    }
public function testCreateRoom() 
{
$this->assertEquals(
    ucfirst(strtolower($this->name)),
    $this->room->getName()
);

$this->assertEquals($this->description,$this->room->getDescription());
$this->assertEquals(60,$this->room->getDuration());

}

   

    public function testPushAndPop()
    {
        $stack = [];
        $this->assertSame(0, count($stack));

        array_push($stack, 'foo');
        $this->assertSame('foo', $stack[count($stack)-1]);
        $this->assertSame(1, count($stack));

        $this->assertSame('foo', array_pop($stack));
        $this->assertSame(0, count($stack));
    }

    public function testHowManyEnigma()

    {
         $levels = [Room::EASY_LEVEL, Room::MEDIUM_LEVEL,Room::HARD_LEVEL];

        foreach ($levels as $level){


        $this->room->setLevel($level);
        $number_enigma = $this->room->getNbEnigma();
        if($this->room->getLevel() == Room::EASY_LEVEL){
            $expected_enigma = 5;
        } else if ($this->room->getLevel() == Room::MEDIUM_LEVEL){
            $expected_enigma= 10;
        } else if ($this->room->getLevel() == Room::HARD_LEVEL){
            $expected_enigma = 25;
        }

        $this->assertEquals($expected_enigma,$number_enigma);
    }
    }
}