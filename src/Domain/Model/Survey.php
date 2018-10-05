<?php
/**
 * Extreme GO
 *
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace App\Domain\Model;

use RedRat\Entity\DateTimeTrait;

/**
 * Survey
 *
 * @package App\Domain\Model
 */
class Survey
{
    use DateTimeTrait;

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $customerDocument;

    /**
     * @var \DateTime
     */
    private $dateImpactStart;

    /**
     * @var \DateTime
     */
    private $dateImpactEnd;

    /**
     * @var bool
     */
    private $allowImpact;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCustomerDocument(): string
    {
        return $this->customerDocument;
    }

    /**
     * @param string $customerDocument
     * @return void
     */
    public function setCustomerDocument(string $customerDocument): void
    {
        $this->customerDocument = $customerDocument;
    }

    /**
     * @return \DateTime
     */
    public function getDateImpactStart(): \DateTime
    {
        return $this->dateImpactStart;
    }

    /**
     * @param \DateTime $dateImpactStart
     * @return void
     */
    public function setDateImpactStart(\DateTime $dateImpactStart): void
    {
        $this->dateImpactStart = $dateImpactStart;
    }

    /**
     * @return \DateTime
     */
    public function getDateImpactEnd(): \DateTime
    {
        return $this->dateImpactEnd;
    }

    /**
     * @param \DateTime $dateImpactEnd
     * @return void
     */
    public function setDateImpactEnd(\DateTime $dateImpactEnd): void
    {
        $this->dateImpactEnd = $dateImpactEnd;
    }

    /**
     * @return bool
     */
    public function isAllowImpact(): bool
    {
        return $this->allowImpact;
    }

    /**
     * @param bool $allowImpact
     * @return void
     */
    public function setAllowImpact(bool $allowImpact): void
    {
        $this->allowImpact = $allowImpact;
    }
}
