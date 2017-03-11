<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class SpecializedOneTest extends TestCase {
    var $endPoint = "/special-1";
    public function testSpecializedOneNoArgument() {
        # Accessing without arguments will return error
        $response = $this->call('GET', $this->endPoint);
        $this->assertTrue(
            $response->headers->contains('Content-Type', 'application/json'),
            $response->headers
        );
        $this->assertEquals(200, $response->status());
        $this->assertArrayHasKey("error", $response->original);
    }

    public function testSpecializedOneInsufficientArgument() {
        # Accessing with insufficient arguments will return error
        $args = [ "a" => true ];
        $response = $this->call('GET', $this->endPoint, $args);
        $this->assertTrue(
            $response->headers->contains('Content-Type', 'application/json'),
            $response->headers
        );
        $this->assertEquals(200, $response->status());
        $this->assertArrayHasKey("error", $response->original);
    }

    public function testSpecializedOneTrueTrueFalse() {
        # X = S => Y = D + ( D * E / 100 )
        $args = array(
                    "a" => "true", "b" => "true", "c" => "false",
                    "d" => 10, "e" => 20, "f" => 30
                );

        $y = 10 + ( 10 * 20 / 100 );
        $x = [true, false, false];
        $response = $this->call('GET', $this->endPoint, $args);
        $this->assertEquals(200, $response->status());
        $this->assertTrue(
            $response->headers->contains('Content-Type', 'application/json'),
            $response->headers
        );
        $this->assertArrayNotHasKey("error", $response->original);
        $this->assertEquals($x, $response->original['X']);
        $this->assertEquals($y, $response->original['Y']);
    }

    public function testSpecializedOneTrueTrueTrue() {
        # X = R => Y = 2 * D + ( D * E / 100 )
        $args = array(
                    "a" => "true", "b" => "true", "c" => "true",
                    "d" => 10, "e" => 20, "f" => 30
                );

        $y = 2 * 10 + ( 10 * 20 / 100 );
        $x = [false, true, false];
        $response = $this->call('GET', $this->endPoint, $args);
        $this->assertEquals(200, $response->status());
        $this->assertTrue(
            $response->headers->contains('Content-Type', 'application/json'),
            $response->headers
        );
        $this->assertArrayNotHasKey("error", $response->original);
        $this->assertEquals($x, $response->original['X']);
        $this->assertEquals($y, $response->original['Y']);
    }

    public function testSpecializedOneFalseTrueTrue() {
        # X = T => Y = D - ( D * F / 100 )
        $args = array(
                    "a" => "false", "b" => "true", "c" => "true",
                    "d" => 10, "e" => 20, "f" => 30
                );

        $y = 10 - ( 10 * 30 / 100 );
        $x = [false, false, true];
        $response = $this->call('GET', $this->endPoint, $args);
        $this->assertEquals(200, $response->status());
        $this->assertTrue(
            $response->headers->contains('Content-Type', 'application/json'),
            $response->headers
        );
        $this->assertArrayNotHasKey("error", $response->original);
        $this->assertEquals($x, $response->original['X']);
        $this->assertEquals($y, $response->original['Y']);
    }

    public function testSpecializedOneInvalidABCInput() {
        # Accessing with wrong a, b, c arguments will return error
        $args = array(
                    "a" => "true", "b" => "false", "c" => "true",
                    "d" => 10, "e" => 20, "f" => 30
                );

        $response = $this->call('GET', $this->endPoint, $args);
        $this->assertEquals(200, $response->status());
        $this->assertTrue(
            $response->headers->contains('Content-Type', 'application/json'),
            $response->headers
        );
        $this->assertArrayHasKey("error", $response->original);
        $this->assertEquals(
            "Invalid input for a, b, or c",
            $response->original["msg"]
        );
    }

    public function testSpecializedOneInvalidDEFInput() {
        # Accessing with invalid d, e, f arguments will return error
        $args = array(
                    "a" => "true", "b" => "false", "c" => "true",
                    "d" => 10, "e" => 20, "f" => "false"
                );

        $response = $this->call('GET', $this->endPoint, $args);
        $this->assertEquals(200, $response->status());
        $this->assertTrue(
            $response->headers->contains('Content-Type', 'application/json'),
            $response->headers
        );
        $this->assertArrayHasKey("error", $response->original);
    }
}
