<?php
/**
 * Extreme GO
 *
 * @author Joubert RedRat <me+github@redrat.com.br>
 */

namespace App\Tests;

use App\Kernel;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\Container;

/**
 * AppTest Case
 *
 * @package App\Tests
 */
class AppTestCase extends TestCase
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * {@inheritdoc}
     */
    public function setUp(): void
    {
        $kernel = new Kernel("test", true);
        $kernel->boot();

        $this->container = $kernel->getContainer();
    }

    /**
     * @return Container
     */
    public function getContainer(): Container
    {
        return $this->container;
    }
}
