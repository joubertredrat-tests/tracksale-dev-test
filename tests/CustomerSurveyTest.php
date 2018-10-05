<?php
/**
 * Extreme GO
 *
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace App\Tests;

use App\Application\Service\SurveyService;
use App\Domain\Service\SurveyServiceInterface;

/**
 * CustomerSurvey Test
 *
 * @package App\Tests
 */
class CustomerSurveyTest extends AppTestCase
{
    /**
     * @return void
     * @throws \Exception
     */
    public function testCustomerCanBeImpacted(): void
    {
        $service = $this->getService();

        $survey = $service->checkCustomer('12801867128');
        $result = $survey->isAllowImpact();

        self::assertTrue($result);
    }

    /**
     * @return SurveyServiceInterface
     * @throws \Exception
     */
    public function getService(): SurveyServiceInterface
    {
        $repo = $this
            ->getContainer()
            ->get('app.infrastructure.repository.survey')
        ;

        $daysInterval = 90;

        return new SurveyService($repo, $daysInterval);
    }
}
