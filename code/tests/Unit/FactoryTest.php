<?php

namespace Unit;

use PHPUnit\Framework\TestCase;
use Returnnull\Application;
use \Returnnull\Factory;
use Returnnull\MySQLConnector;

/**
 * @covers \Returnnull\Factory
 */
class FactoryTest extends TestCase
{
    public function testFactoryCanBeConstructed(): void
    {
        self::assertInstanceOf(Factory::class, new Factory());
    }

    /**
     * @runInSeparateProcess
     */
    public function testCreateApplication()
    {
        $mySqlConnectorMock = $this->getMockBuilder(MySQLConnector::class)
            ->disableOriginalConstructor()
            ->getMock();
        $_SERVER['REQUEST_URI'] = "/";

        $factory = new Factory();
        self::assertInstanceOf(Application::class, $factory->createApplication($mySqlConnectorMock));
    }
}
