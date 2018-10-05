<?php
/**
 * Extreme GO
 *
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace App\Domain\Service;

use App\Domain\Model\Survey;

/**
 * SurveyService Interface
 *
 * @package App\Domain\Service
 */
interface SurveyServiceInterface
{
    /**
     * @param string $customerDocument
     * @return Survey
     */
    public function customerCheck(string $customerDocument): Survey;

    /**
     * @param string $customerDocument
     * @return bool
     */
    public function customerRemove(string $customerDocument): bool;
}
