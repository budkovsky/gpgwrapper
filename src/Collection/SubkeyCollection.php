<?php
declare(strict_types=1);

namespace Budkovsky\GpgWrapper\Collection;

use Budkovsky\Aid\Abstraction\CollectionAbstract;
use Budkovsky\GpgWrapper\Entity\Subkey;

/**
 * GPG keyinfo subkey collection
 */
class SubkeyCollection extends CollectionAbstract
{


    /**
     * @param Subkey $item
     * @return SubkeyCollection
     */
    public function add(?Subkey $item=null): SubkeyCollection
    {
        if ($item) {
            $this->collection[] = $item;
        }

        return $this;
    }
}
