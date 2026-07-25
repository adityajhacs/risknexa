# Risk Scoring Engine Documentation

## Overview

The Risk Scoring Engine calculates vendor assessment risk based on questionnaire responses.

## Response Scoring

| Response  | Score |
| --------- | ----- |
| Yes       | 0     |
| Partially | 5     |
| No        | 10    |

## Risk Classification

| Score Range | Risk Level |
| ----------- | ---------- |
| 0 – 20      | Low        |
| 21 – 50     | Medium     |
| 51 – 80     | High       |
| 81+         | Critical   |

## Implementation

### Service Class

RiskScoringService

Methods:

* calculateScore()
* calculateRiskLevel()

### Assessment Flow

Assessment
→ Questions
→ Responses
→ Score Calculation
→ Risk Classification

### Unit Testing

Test Cases:

* Yes returns 0
* Partially returns 5
* No returns 10
* Low Risk Classification
* Medium Risk Classification
* High Risk Classification
* Critical Risk Classification

All tests passed successfully.
