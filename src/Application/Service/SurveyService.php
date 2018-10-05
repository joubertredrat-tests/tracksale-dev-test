<?php
/**
 * Extreme GO
 *
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace App\Application\Service;

use App\Domain\Exception\Service\SurveyService\CustomerNotFoundException;
use App\Domain\Model\Survey;
use App\Domain\Repository\SurveyRepositoryInterface;
use App\Domain\Service\SurveyServiceInterface;

/**
 * Survey Service
 *
 * @package App\Application\Service
 */
class SurveyService implements SurveyServiceInterface
{
    /**
     * @var SurveyRepositoryInterface
     */
    private $surveyRepository;

    /**
     * @var int
     */
    private $impactDaysInterval;

    /**
     * Survey Service constructor
     *
     * @param SurveyRepositoryInterface $surveyRepository
     * @param int $impactDaysInterval
     */
    public function __construct(
        SurveyRepositoryInterface $surveyRepository,
        int $impactDaysInterval
    ) {
        $this->surveyRepository = $surveyRepository;
        $this->impactDaysInterval = $impactDaysInterval;
    }

    /**
     * {@inheritdoc}
     */
    public function customerCheck(string $customerDocument): Survey
    {
        $survey = $this
            ->surveyRepository
            ->getSurveyIntoImpact($customerDocument, new \DateTime('today'))
        ;

        if ($survey instanceof Survey) {
            $survey->setAllowImpact(false);

            return $survey;
        }

        $survey = new Survey();
        $survey->setCustomerDocument($customerDocument);
        $survey->setDateImpactStart(new \DateTime('today'));
        $survey->setDateImpactEnd($this->getImpactDateInterval());
        $survey->setAllowImpact(true);

        $this
            ->surveyRepository
            ->add($survey)
        ;

        return $survey;
    }

    /**
     * {@inheritdoc}
     * @throws CustomerNotFoundException
     */
    public function customerRemove(string $customerDocument): bool
    {
        $survey = $this
            ->surveyRepository
            ->getSurveyIntoImpact($customerDocument, new \DateTime('today'))
        ;

        if (!$survey instanceof Survey) {
            throw CustomerNotFoundException::notFoundOnDatabase($customerDocument);
        }

        $this
            ->surveyRepository
            ->delete($survey)
        ;

        return true;
    }

    /**
     * @return \DateTime
     */
    public function getImpactDateInterval(): \DateTime
    {
        $date = new \DateTime('today');
        $date->modify('+' . $this->impactDaysInterval . ' days');

        return $date;
    }
}
