<?php
/**
 * Extreme GO
 *
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace App\Application\Presenter;

use App\Domain\Model\Survey;

/**
 * Survey Presenter
 *
 * @package App\Application\Presenter
 */
class SurveyPresenter implements PresenterInterface
{
    /**
     * @var Survey
     */
    private $survey;

    /**
     * Survey Presenter constructor
     *
     * @param Survey $survey
     */
    public function __construct(Survey $survey)
    {
        $this->survey = $survey;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray(): array
    {
        $survey = $this->survey;

        return [
            'id' => $survey->getId(),
            'customerDocument' => $survey->getCustomerDocument(),
            'dateImpactStart' => $survey->getDateImpactStartString(),
            'dateImpactEnd' => $survey->getDateImpactEndString(),
            'allowImpact' => $survey->isAllowImpact(),
            'createdAt' => $survey->getCreatedAtString(),
            'updatedAt' => $survey->getUpdatedAtString(),
        ];
    }
}
