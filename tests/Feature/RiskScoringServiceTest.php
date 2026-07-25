<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\RiskScoringService;

class RiskScoringServiceTest extends TestCase
{
    public function test_yes_returns_zero()
    {
        $service = new RiskScoringService();

        $this->assertEquals(
            0,
            $service->calculateScore('Yes')
        );
    }

    public function test_partially_returns_five()
    {
        $service = new RiskScoringService();

        $this->assertEquals(
            5,
            $service->calculateScore('Partially')
        );
    }

    public function test_no_returns_ten()
    {
        $service = new RiskScoringService();

        $this->assertEquals(
            10,
            $service->calculateScore('No')
        );
    }

    public function test_low_risk()
    {
        $service = new RiskScoringService();

        $this->assertEquals(
            'Low',
            $service->calculateRiskLevel(15)
        );
    }

    public function test_medium_risk()
    {
        $service = new RiskScoringService();

        $this->assertEquals(
            'Medium',
            $service->calculateRiskLevel(45)
        );
    }

    public function test_high_risk()
    {
        $service = new RiskScoringService();

        $this->assertEquals(
            'High',
            $service->calculateRiskLevel(70)
        );
    }

    public function test_critical_risk()
    {
        $service = new RiskScoringService();

        $this->assertEquals(
            'Critical',
            $service->calculateRiskLevel(90)
        );
    }
}