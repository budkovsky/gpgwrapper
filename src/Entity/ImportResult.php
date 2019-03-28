<?php
declare(strict_types=1);

namespace Budkovsky\GpgWrapper\Entity;

/**
 * GnuPG import result container
 * @see http://php.net/manual/en/function.gnupg-import.php
 */
class ImportResult
{
    /**
     * @int
     */
    protected $imported;
    
    /**
     * @int
     */
    protected $unchanged;
    
    /**
     * @var
     */
    protected $newUserIds;
    
    /**
     * @int
     */
    protected $newSubkeys;
    
    /**
     * @int
     */
    protected $secretImported;
    
    /**
     * @int
     */
    protected $secretUnchanged;
    
    /**
     * @var
     */
    protected $newSignatures;
    
    /**
     * @var
     */
    protected $skippedKeys;
    
    /**
     * @var string
     */
    protected $fingerprint;
    
    public function __construct(?array $importResult = null)
    {
        if ($importResult === null) {
            return;
        }
        if (isset($importResult['imported'])) {
            $this->setImported($importResult['imported']);
        }
        if (isset($importResult['unchanged'])) {
            $this->setUnchanged($importResult['unchanged']);
        }
        if (isset($importResult['newuserids'])) {
            $this->setNewUserIds($importResult['newuserids']);
        }
        if (isset($importResult['newsubkeys'])) {
            $this->setNewSubkeys($importResult['newsubkeys']);
        }
        if (isset($importResult['secretimported'])) {
            $this->setSecretImported($importResult['secretimported']);
        }
        if (isset($importResult['secretunchanged'])) {
            $this->setSecretUnchanged($importResult['secretunchanged']);
        }
        if (isset($importResult['newsignatures'])) {
            $this->setNewSignatures($importResult['newsignatures']);
        }
        if (isset($importResult['skippedkeys'])) {
            $this->setSkippedKeys($importResult['skippedkeys']);
        }
        if (isset($importResult['fingerprint'])) {
            $this->setFingerprint($importResult['fingerprint']);
        }
    }

    /**
     * @return int
     */
    public function getImported(): ?int
    {
        return $this->imported;
    }

    /**
     * @param int $imported
     * @return ImportResult
     */
    public function setImported(int $imported): ImportResult
    {
        $this->imported = $imported;
        
        return $this;
    }

    /**
     * @return int
     */
    public function getUnchanged(): ?int
    {
        return $this->unchanged;
    }

    /**
     * @param int $unchanged
     * @return ImportResult
     */
    public function setUnchanged(int $unchanged): ImportResult
    {
        $this->unchanged = $unchanged;
        
        return $this;
    }

    /**
     * @return int
     */
    public function getNewUserIds(): ?int
    {
        return $this->newUserIds;
    }

    /**
     * @param int $newUserIds
     * @return ImportResult
     */
    public function setNewUserIds(int $newUserIds): ImportResult
    {
        $this->newUserIds = $newUserIds;
        
        return $this;
    }

    /**
     * @return int
     */
    public function getNewSubkeys(): ?int
    {
        return $this->newSubkeys;
    }

    /**
     * @param int $newSubkeys
     * @return ImportResult
     */
    public function setNewSubkeys(int $newSubkeys): ImportResult
    {
        $this->newSubkeys = $newSubkeys;
        
        return $this;
    }

    /**
     * @return int
     */
    public function getSecretImported(): ?int
    {
        return $this->secretImported;
    }

    /**
     * @param int $secretImported
     * @return ImportResult
     */
    public function setSecretImported(int $secretImported): ImportResult
    {
        $this->secretImported = $secretImported;
        
        return $this;
    }

    /**
     * @return int
     */
    public function getSecretUnchanged(): ?int
    {
        return $this->secretUnchanged;
    }

    /**
     * @param int $secretUnchanged
     * @return ImportResult
     */
    public function setSecretUnchanged(int $secretUnchanged): ImportResult
    {
        $this->secretUnchanged = $secretUnchanged;
        
        return $this;
    }

    /**
     * @return int
     */
    public function getNewSignatures(): ?int
    {
        return $this->newSignatures;
    }

    /**
     * @param int $newSignatures
     * @return ImportResult
     */
    public function setNewSignatures(int $newSignatures): ImportResult
    {
        $this->newSignatures = $newSignatures;
        return $this;
    }

    /**
     * @return int
     */
    public function getSkippedKeys(): ?int
    {
        return $this->skippedKeys;
    }

    /**
     * @param int $skippedKeys
     * @return ImportResult
     */
    public function setSkippedKeys(int $skippedKeys): ImportResult
    {
        $this->skippedKeys = $skippedKeys;
        
        return $this;
    }

    /**
     * @return string
     */
    public function getFingerprint(): ?string
    {
        return $this->fingerprint;
    }

    /**
     * @param string $fingerprint
     * @return ImportResult
     */
    public function setFingerprint(string $fingerprint): ImportResult
    {
        $this->fingerprint = $fingerprint;
        
        return $this;
    }
}
