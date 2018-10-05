<?php
/**
 * Extreme GO
 *
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace App\Domain\Exception\Service\SurveyService;

/**
 * CustomerNotFound Exception
 *
 * @package App\Domain\Exception\Service\SurveyService
 */
class CustomerNotFoundException extends \Exception
{
    /**
     * @param string $customerDocument
     * @return CustomerNotFoundException
     */
    public static function notFoundOnDatabase(string $customerDocument): self
    {
        return new self(
            sprintf(
                'Customer with document not found on database: %s',
                $customerDocument
            )
        );
    }
}
