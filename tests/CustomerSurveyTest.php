<?php
/**
 * Extreme GO
 *
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace App\Tests;

use App\Application\Service\SurveyService;
use App\Domain\Model\Survey;
use App\Domain\Repository\SurveyRepositoryInterface;
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
        $customerDocument = '12801867128';

        $survey = $service->customerCheck($customerDocument);

        self::assertTrue($survey->isAllowImpact());
        self::assertSame($customerDocument, $survey->getCustomerDocument());
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function testCustomerCanNotBeImpacted(): void
    {
        $service = $this->getService();
        $customerDocument = $this->getSurveyPreviousAdded();

        $survey = $service->customerCheck($customerDocument);

        self::assertFalse($survey->isAllowImpact());
        self::assertSame($customerDocument, $survey->getCustomerDocument());
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function testRemoveCustomerData(): void
    {
        $service = $this->getService();
        $customerDocument = $this->getSurveyForRemove();

        $result = $service->customerRemove($customerDocument);

        self::assertTrue($result);
    }

    /**
     * @return void
     */
    public function testRemoveCustomerDataNotFound(): void
    {
        self::expectException(\Exception::class);
    }

    /**
     * @return SurveyRepositoryInterface
     * @throws \Exception
     */
    public function getRepository(): SurveyRepositoryInterface
    {
        return $this
            ->getContainer()
            ->get('app.infrastructure.repository.survey')
        ;
    }

    /**
     * @return SurveyServiceInterface
     * @throws \Exception
     */
    public function getService(): SurveyServiceInterface
    {
        $repo = $this->getRepository();
        $daysInterval = 90;

        return new SurveyService($repo, $daysInterval);
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getSurveyPreviousAdded(): string
    {
        $customerDocument = '74326782862';
        $dateImpactStart = new \DateTime('today');
        $dateImpactStart->modify('-30 days');
        $dateImpactEnd = new \DateTime('today');
        $dateImpactEnd->modify('+60 days');

        $survey = new Survey();
        $survey->setCustomerDocument($customerDocument);
        $survey->setDateImpactStart($dateImpactStart);
        $survey->setDateImpactEnd($dateImpactEnd);

        $this
            ->getRepository()
            ->add($survey)
        ;

        return $customerDocument;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getSurveyForRemove(): string
    {
        $customerDocument = '19391512607';
        $dateImpactStart = new \DateTime('today');
        $dateImpactStart->modify('-30 days');
        $dateImpactEnd = new \DateTime('today');
        $dateImpactEnd->modify('+60 days');

        $survey = new Survey();
        $survey->setCustomerDocument($customerDocument);
        $survey->setDateImpactStart($dateImpactStart);
        $survey->setDateImpactEnd($dateImpactEnd);

        $this
            ->getRepository()
            ->add($survey)
        ;

        return $customerDocument;
    }
}
