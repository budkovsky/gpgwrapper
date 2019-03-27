<?php
declare(strict_types=1);

namespace Budkovsky\GpgWrapper\Collection;

use Budkovsky\Aid\CollectionTrait;
use Budkovsky\GpgWrapper\Entity\Uid;

/**
 * Keyinfo Uid collection
 */
class UidCollection implements \IteratorAggregate, \Countable
{
    use CollectionTrait;
    
    /**
     * @param Uid $uid
     * @return UidCollection
     */
    public function add(Uid $uid): UidCollection
    {
        $this->collection[] = $uid;
        
        return $this;
    }
}
