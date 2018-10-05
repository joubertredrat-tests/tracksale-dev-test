<?php
/**
 * Extreme GO
 *
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace App\Controller;

use App\Application\Presenter\SurveyPresenter;
use App\Domain\Exception\Service\SurveyService\CustomerNotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Customer Controller
 *
 * @package App\Controller
 */
class CustomerController extends Controller
{
    /**
     * @param string $customerDocument
     * @return JsonResponse
     */
    public function check(string $customerDocument): JsonResponse
    {
        try {
            $service = $this->get('app.application.service.survey');
            $survey = $service->customerCheck($customerDocument);
            $surveyPresenter = new SurveyPresenter($survey);

            return new JsonResponse($surveyPresenter->toArray());
        } catch (\Throwable $e) {
            throw new HttpException(
                JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                $e->getMessage()
            );
        }
    }

    /**
     * @param string $customerDocument
     * @return JsonResponse
     */
    public function remove(string $customerDocument): JsonResponse
    {
        try {
            $service = $this->get('app.application.service.survey');
            $response = $service->customerRemove($customerDocument);

            return new JsonResponse(['removed' => $response]);
        } catch (CustomerNotFoundException $e) {
            throw new HttpException(
                JsonResponse::HTTP_BAD_REQUEST,
                $e->getMessage()
            );
        } catch (\Throwable $e) {
            throw new HttpException(
                JsonResponse::HTTP_INTERNAL_SERVER_ERROR,
                $e->getMessage()
            );
        }
    }
}
