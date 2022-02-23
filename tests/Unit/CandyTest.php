<?php

namespace Tests\Unit;

use App\Models\Candy;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CandyTest extends TestCase
{
    use DatabaseMigrations;

    public function test_empty() {
        $this->assertNan(Candy::csokisakCukortartalmaAtlag());
        $this->assertEquals(0, Candy::cukormentesCsokimentesMennyi());
        $this->assertNan(Candy::cukrosakLegkissebbCukor());

    }

    public function test_one_chocolate_sugar_candy() {
        Candy::factory()->create([
            "name" => "Chocolate",
            "cocoa_content" => 12.5,
            "sugar_content" => 2
        ]);

        $this->assertEquals(2, Candy::csokisakCukortartalmaAtlag());
        $this->assertEquals(0, Candy::cukormentesCsokimentesMennyi());
        $this->assertEquals(2, Candy::cukrosakLegkissebbCukor());
    }

    public function test_one_no_chocolate_no_sugar_candy() {
        Candy::factory()->create([
            "name" => "Chocolate",
            "cocoa_content" => 0,
            "sugar_content" => 0
        ]);

        $this->assertNan(Candy::csokisakCukortartalmaAtlag());
        $this->assertEquals(1, Candy::cukormentesCsokimentesMennyi());
        $this->assertNan(Candy::cukrosakLegkissebbCukor());

    }

    public function test_many_chocolate_sugar_candy() {
        Candy::factory()->createMany([
            [
                "name" => "Chocolate",
                "cocoa_content" => 12.5,
                "sugar_content" => 2
            ],
            [
                "name" => "White Chocolate",
                "cocoa_content" => 5,
                "sugar_content" => 1
            ],
            [
                "name" => "Dark Chocolate",
                "cocoa_content" => 20,
                "sugar_content" => 6
            ]
        ]);

        $this->assertEquals(3, Candy::csokisakCukortartalmaAtlag());
        $this->assertEquals(0, Candy::cukormentesCsokimentesMennyi());
        $this->assertEquals(1, Candy::cukrosakLegkissebbCukor());

    }

    public function test_many_no_chocolate_no_sugar_candy() {
        Candy::factory()->createMany([
            [
                "name" => "Chocolate",
                "cocoa_content" => 0,
                "sugar_content" => 0
            ],
            [
                "name" => "White Chocolate",
                "cocoa_content" => 0,
                "sugar_content" => 0
            ],
            [
                "name" => "Dark Chocolate",
                "cocoa_content" => 0,
                "sugar_content" => 0
            ]
        ]);

        $this->assertNan(Candy::csokisakCukortartalmaAtlag());
        $this->assertEquals(3, Candy::cukormentesCsokimentesMennyi());
        $this->assertNan(Candy::cukrosakLegkissebbCukor());
        }

    public function test_many_some_chocolate_some_sugar_candy() {
        Candy::factory()->createMany([
            [
                "name" => "Chocolate",
                "cocoa_content" => 0,
                "sugar_content" => 0
            ],
            [
                "name" => "White Chocolate",
                "cocoa_content" => 15,
                "sugar_content" => 6
            ],
            [
                "name" => "Dark Chocolate",
                "cocoa_content" => 15,
                "sugar_content" => 0
            ],
            [
                "name" => "Blue Chocolate",
                "cocoa_content" => 0,
                "sugar_content" => 2
            ]
        ]);

        $this->assertEquals(3, Candy::csokisakCukortartalmaAtlag());
        $this->assertEquals(1, Candy::cukormentesCsokimentesMennyi());
        $this->assertEquals(2, Candy::cukrosakLegkissebbCukor());

    }
}
