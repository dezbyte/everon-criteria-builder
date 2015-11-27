<?php
/**
 * This file is part of the Everon framework.
 *
 * (c) Oliwier Ptak <EveronFramework@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Everon\Component\CriteriaBuilder\Operator;

use Everon\Component\CriteriaBuilder\AbstractOperator;
use Everon\Component\CriteriaBuilder\Builder;
use Everon\Component\CriteriaBuilder\Exception\ValueMustBeAnArrayException;
use Everon\Component\CriteriaBuilder\OperatorInterface;
use Everon\Component\CriteriaBuilder\Criteria\CriteriumInterface;

class In extends AbstractOperator implements OperatorInterface
{

    const TYPE_NAME = 'In';
    const TYPE_AS_SQL = 'IN';

    /**
     * @inheritdoc
     */
    public function toSqlPartData(CriteriumInterface $Criterium)
    {
        $params = [];
        $data = $Criterium->getValue();

        if (is_array($data) === false) {
            throw new ValueMustBeAnArrayException('Value must be an array');
        }

        /** @var array $data */
        foreach ($data as $value) {
            $rand = Builder::randomizeParameterName($Criterium->getPlaceholderAsParameter());
            $params[$rand] = $value;
        }

        $placeholder_sql = ':' . rtrim(implode(',:', array_keys($params)), ',');
        $sql = sprintf('%s %s (%s)', $Criterium->getColumn(), $this->getTypeAsSql(), $placeholder_sql);

        return [$sql, $params];
    }

}
