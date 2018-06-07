<?php

namespace Tests\Unit;

use App\Post;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    // Information for all: Repasate los traits mi arma!
    use DatabaseTransactions;

    public function testBasicTeset()
    {
        $this->assertTrue(true);
    }
}