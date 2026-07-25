<?php

namespace App\Services;

class RiskScoringService
{
    public function calculateScore($response)
    {
        if ($response == 'Yes') {
            return 0;
        }

        if ($response == 'Partially') {
            return 5;
        }

        if ($response == 'No') {
            return 10;
        }

        return 0;
    }

    public function calculateRiskLevel($score)
    {
        if ($score <= 20) {
            return 'Low';
        }

        if ($score <= 50) {
            return 'Medium';
        }

        if ($score <= 80) {
            return 'High';
        }

        return 'Critical';
    }
}