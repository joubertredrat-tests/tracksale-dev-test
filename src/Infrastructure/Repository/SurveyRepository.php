<?php
/**
 * Extreme GO
 *
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace App\Infrastructure\Repository;

use App\Domain\Model\Survey;
use App\Domain\Repository\SurveyRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Survey Repository
 *
 * @package App\Infrastructure\Repository
 */
class SurveyRepository extends ServiceEntityRepository implements SurveyRepositoryInterface
{
    /**
     * Survey Repository constructor
     *
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Survey::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getSurveyIntoImpact(
        string $customerDocument,
        \DateTime $dateConsult
    ): ?Survey {
        $queryBuilder = $this->createQueryBuilder('s');

        $data = $queryBuilder
            ->where(
                $queryBuilder
                    ->expr()
                    ->andX(
                        $queryBuilder
                            ->expr()
                            ->eq('s.customerDocument', ':customerDocument'),
                        $queryBuilder
                            ->expr()
                            ->lte('s.dateImpactStart', ':dateImpactStart'),
                        $queryBuilder
                            ->expr()
                            ->gte('s.dateImpactEnd', ':dateImpactEnd')
                    )
            )
            ->setParameter('customerDocument', $customerDocument)
            ->setParameter('dateImpactStart', $dateConsult->format('Y-m-d'))
            ->setParameter('dateImpactEnd', $dateConsult->format('Y-m-d'))
            ->getQuery()
            ->getResult()
        ;

        if (count($data) == 0) {
            return null;
        }

        return $data[0];
    }

    /**
     * {@inheritdoc}
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function add(Survey $survey): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($survey);
        $entityManager->flush();
    }
}
