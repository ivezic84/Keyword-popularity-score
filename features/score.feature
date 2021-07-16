Feature: Popularity score of keyword
  Scenario: I want a popularity score of keyword
    When I request a score from "http://127.0.0.1:8000/api/v1/score?q=php"
    Then The results should include a score