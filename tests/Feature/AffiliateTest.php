<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Http\Controllers\AffiliateController;

class AffiliateTest extends TestCase
{
    public function testDistanceCalculation()
    {
        $controller = new AffiliateController();

        $distance = $controller->calculateDistance(53.3340285, -6.2535495, 53.2451022, -6.238335);
        $this->assertLessThanOrEqual(100, $distance);
    }
}
