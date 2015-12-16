<?php
/**
 * This file is part of the Everon components.
 *
 * (c) Oliwier Ptak <everonphp@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Everon\Component\CriteriaBuilder;

use Everon\Component\CriteriaBuilder\Criteria\ContainerInterface;
use Everon\Component\CriteriaBuilder\Criteria\CriteriumInterface;
use Everon\Component\Factory\AbstractWorker;
use Everon\Component\Factory\Exception\UnableToInstantiateException;

class CriteriaBuilderFactoryWorker extends AbstractWorker implements CriteriaBuilderFactoryWorkerInterface
{

    /**
     * @inheritdoc
     */
    protected function registerBeforeWork()
    {
        $this->registerWorker('CriteriaBuilderFactoryWorker', function () {
            return $this->getFactory()->getWorkerByName('CriteriaBuilder', 'Everon\Component\CriteriaBuilder');
        });
    }

    /**
     * @inheritdoc
     */
    public function buildCriteria($namespace='Everon\Component\CriteriaBuilder'): CriteriaInterface
    {
        try {
            return $this->getFactory()->buildWithEmptyConstructor('Criteria', $namespace);
        } catch (\Exception $e) {
            throw new UnableToInstantiateException($e);
        }
    }

    /**
     * @inheritdoc
     */
    public function buildCriteriaBuilder($namespace='Everon\Component\CriteriaBuilder'): CriteriaBuilderInterface
    {
        try {
            return $this->getFactory()->buildWithEmptyConstructor('CriteriaBuilder', $namespace);
        } catch (\Exception $e) {
            throw new UnableToInstantiateException($e);
        }
    }

    /**
     * @inheritdoc
     */
    public function buildCriteriaCriterium($column, $operator, $value, $namespace = 'Everon\Component\CriteriaBuilder\Criteria'): CriteriumInterface
    {
        try {
            return $this->getFactory()->buildWithConstructorParameters('Criterium', $namespace,
                $this->getFactory()->buildParameterCollection([
                    $column, $operator, $value,
                ])
            );
        } catch (\Exception $e) {
            throw new UnableToInstantiateException($e);
        }
    }

    /**
     * @inheritdoc
     */
    public function buildCriteriaContainer(CriteriaInterface $Criteria, $glue, $namespace='Everon\Component\CriteriaBuilder\Criteria'): ContainerInterface
    {
        try {
            return $this->getFactory()->buildWithConstructorParameters('Container', $namespace,
                $this->getFactory()->buildParameterCollection([
                    $Criteria, $glue,
                ])
            );
        } catch (\Exception $e) {
            throw new UnableToInstantiateException($e);
        }
    }

    /**
     * @inheritdoc
     */
    public function buildCriteriaOperator($class_name): OperatorInterface
    {
        try {
            return $this->getFactory()->buildWithEmptyConstructor($class_name, '');
        } catch (\Exception $e) {
            throw new UnableToInstantiateException($e);
        }
    }

    /**
     * @inheritdoc
     */
    public function buildSqlPart($sql, array $parameters, $namespace = 'Everon\Component\CriteriaBuilder'): SqlPartInterface
    {
        try {
            return $this->getFactory()->buildWithConstructorParameters('SqlPart', $namespace,
                $this->getFactory()->buildParameterCollection([
                    $sql, $parameters,
                ])
            );
        } catch (\Exception $e) {
            throw new UnableToInstantiateException($e);
        }
    }

}
