<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class IntroductoryTest extends TestCase {

    public function testIntro() {
        $this->get('/');
        $this->assertEquals(
          $this->response->getContent(),
          "FashionValet Interview Test - Abdul Mu'iz Bin Abu Bakar Musaddik"
        );
    }
}
