<?php
declare(strict_types=1);

namespace Budkovsky\GpgWrapper\Collection;

use Budkovsky\Aid\CollectionTrait;
use Budkovsky\GpgWrapper\Entity\Subkey;

/**
 * GPG keyinfo subkey collection
 */
class SubkeyCollection implements \IteratorAggregate, \Countable
{
    use CollectionTrait;
    
    /**
     * @param Subkey $item
     * @return SubkeyCollection
     */
    public function add(Subkey $item): SubkeyCollection
    {
        $this->collection[] = $item;
        
        return $this;
    }
}
