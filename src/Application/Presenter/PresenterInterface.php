<?php
/**
 * Extreme GO
 *
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace App\Application\Presenter;

/**
 * Presenter Interface
 *
 * @package App\Application\Presenter
 */
interface PresenterInterface
{
    /**
     * @return array
     */
    public function toArray(): array;
}
