<?php
/**
 * This file is part of the Everon framework.
 *
 * (c) Oliwier Ptak <EveronFramework@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Everon\Component\CriteriaBuilder\Tests\Unit;

use Everon\Component\CriteriaBuilder\CriteriaBuilder;
use Everon\Component\CriteriaBuilder\Criteria\ContainerInterface as CriteriaContainerInterface;
use Everon\Component\CriteriaBuilder\CriteriaInterface;
use Everon\Component\Factory\Dependency\Container;
use Everon\Component\Factory\Tests\Unit\Doubles\FactoryStub;
use Everon\Component\Utils\TestCase\MockeryTest;
use Everon\Component\Utils\Text\StartsWith;
use Mockery;

class ContainerTest extends MockeryTest
{

    use StartsWith;

    /**
     * @var CriteriaContainerInterface
     */
    protected $CriteriaContainer;


    protected function setUp()
    {
        $Container = new Container();
        $Factory = new FactoryStub($Container);
        $CriteriaBuilderFactoryWorker = $Factory->getWorkerByName('CriteriaBuilder', 'Everon\Component\CriteriaBuilder');

        $Criteria = Mockery::mock('Everon\Component\CriteriaBuilder\CriteriaInterface');
        /* @var CriteriaInterface  $Criteria */
        $this->CriteriaContainer = $CriteriaBuilderFactoryWorker->buildCriteriaContainer($Criteria, CriteriaBuilder::GLUE_AND);
    }

    public function test_Constructor()
    {
        $this->assertInstanceOf('Everon\Component\CriteriaBuilder\Criteria\ContainerInterface', $this->CriteriaContainer);
    }

    public function test_glue_by_and()
    {
        $this->CriteriaContainer->resetGlue();
        $this->assertEquals(null, $this->CriteriaContainer->getGlue());

        $this->CriteriaContainer->glueByAnd();
        $this->assertEquals(CriteriaBuilder::GLUE_AND, $this->CriteriaContainer->getGlue());
    }

    public function test_glue_by_or()
    {
        $this->CriteriaContainer->resetGlue();
        $this->assertEquals(null, $this->CriteriaContainer->getGlue());

        $this->CriteriaContainer->glueByOr();
        $this->assertEquals(CriteriaBuilder::GLUE_OR, $this->CriteriaContainer->getGlue());
    }

    public function test_reset_glue()
    {
        $this->CriteriaContainer->resetGlue();

        $this->assertEquals(null, $this->CriteriaContainer->getGlue());
    }

}
