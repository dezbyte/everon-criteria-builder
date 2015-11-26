<?php
/**
 * This file is part of the Everon framework.
 *
 * (c) Oliwier Ptak <EveronFramework@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Everon\Component\CriteriaBuilder;

use Everon\Component\Collection\CollectionInterface;
use Everon\Component\CriteriaBuilder\Criteria\CriteriumInterface;
use Everon\Component\CriteriaBuilder\Exception\NoSubQueryFoundException;
use Everon\Component\Utils\Collection\ArrayableInterface;

interface CriteriaInterface extends ArrayableInterface
{
    /**
     * @param CriteriumInterface $Criterium
     * @return self
     */
    function where(CriteriumInterface $Criterium);

    /**
     * @param CriteriumInterface $Criterium
     *
     * @throws NoSubQueryFoundException
     * @return self
     */
    public function andWhere(CriteriumInterface $Criterium);

    /**
     * @param CriteriumInterface $Criterium
     *
     * @throws NoSubQueryFoundException
     * @return self
     */
    public function orWhere(CriteriumInterface $Criterium);

    /**
     * @return CollectionInterface
     */
    function getCriteriumCollection();

    /**
     * @param CollectionInterface $CriteriumCollection
     */
    function setCriteriumCollection(CollectionInterface $CriteriumCollection);

    /**
     * @return string
     */
    function getGlue();

    function resetGlue();

    function glueByAnd();

    function glueByOr();
}
