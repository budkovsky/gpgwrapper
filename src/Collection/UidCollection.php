<?php
declare(strict_types=1);

namespace Budkovsky\GpgWrapper\Collection;

use Budkovsky\Aid\Abstraction\CollectionAbstract;
use Budkovsky\GpgWrapper\Entity\Uid;

/**
 * Keyinfo Uid collection
 */
class UidCollection extends CollectionAbstract
{

    /**
     * @param Uid $uid
     * @return UidCollection
     */
    public function add(?Uid $uid=null): UidCollection
    {
        if ($uid) {
            $this->collection[] = $uid;
        }

        return $this;
    }
}
