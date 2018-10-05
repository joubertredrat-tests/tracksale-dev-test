<?php
/**
 * Extreme GO
 *
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace App\Domain\Repository;

use App\Domain\Model\Survey;

/**
 * SurveyRepository Interface
 *
 * @package App\Domain\Repository
 */
interface SurveyRepositoryInterface
{
    /**
     * @param string $customerDocument
     * @param \DateTime $dateConsult
     * @return Survey|null
     */
    public function getSurveyIntoImpact(
        string $customerDocument,
        \DateTime $dateConsult
    ): ?Survey;

    /**
     * @param Survey $survey
     * @return void
     */
    public function add(Survey $survey): void;
}
