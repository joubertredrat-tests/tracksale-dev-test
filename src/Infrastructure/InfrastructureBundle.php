<?php

namespace App\Infrastructure;

use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Infrastructure Bundle
 *
 * @package App\Infrastructure
 */
class InfrastructureBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    protected function getContainerExtensionClass()
    {
        $basename = preg_replace('/Bundle$/', '', $this->getName());

        return $this->getNamespace().'\\DependencyInjection\\'.$basename.'Extension';
    }
}
