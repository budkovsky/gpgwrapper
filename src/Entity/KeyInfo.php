<?php
declare(strict_types=1);

namespace Budkovsky\GpgWrapper\Entity;

use Budkovsky\GpgWrapper\Collection\UidCollection;
use Budkovsky\GpgWrapper\Collection\SubkeyCollection;

/**
 * GPG key info
 * @see http://php.net/manual/en/function.gnupg-keyinfo.php
 */
class KeyInfo
{
    /**
     * @var bool
     */
    protected $disabled;
    
    /**
     * @var bool
     */
    protected $expired;
    
    /**
     * @var bool
     */
    protected $revoked;
    
    /**
     * @var bool
     */
    protected $isSecret;
    
    /**
     * @var bool
     */
    protected $canSign;
    
    /**
     * @var bool
     */
    protected $canEncrypt;
    
    /**
     * @var UidCollection
     */
    protected $uids;
    
    /**
     * @var SubkeyCollection
     */
    protected $subkeys;
   
    /**
     * The constructor
     * @param array gnupg_keyinfo() result
     * @see http://php.net/manual/en/function.gnupg-keyinfo.php
     */
    public function __construct(array $keyinfo = [])
    {
        if (isset($keyinfo['disabled'])) {
            $this->setDisabled($keyinfo['disabled']);
        }
        if (isset($keyinfo['expired'])) {
            $this->setExpired($keyinfo['expired']);
        }
        if (isset($keyinfo['revoked'])) {
            $this->setRevoked($keyinfo['revoked']);
        }
        if (isset($keyinfo['is_secret'])) {
            $this->setIsSecret($keyinfo['is_secret']);
        }
        if (isset($keyinfo['can_sign'])) {
            $this->setCanSign($keyinfo['can_sign']);
        }
        if (isset($keyinfo['can_encrypt'])) {
            $this->setCanEncrypt($keyinfo['can_encrypt']);
        }
        if (isset($keyinfo['uids'])) {
            $this->setUids(new UidCollection($keyinfo['uids']));
        }
        if (isset($keyinfo['subkeys'])) {
            $this->setSubkeys(new SubkeyCollection($keyinfo['subkeys']));
        }
    }

    /**
     * @return bool
     */
    public function getDisabled(): ?bool
    {
        return $this->disabled;
    }

    /**
     * @param bool $disabled
     * @return KeyInfo
     */
    public function setDisabled(bool $disabled): self
    {
        $this->disabled = $disabled;
        
        return $this;
    }

    /**
     * @return bool
     */
    public function getExpired(): ?bool
    {
        return $this->expired;
    }

    /**
     * @param bool $expired
     * @return KeyInfo
     */
    public function setExpired(bool $expired): self
    {
        $this->expired = $expired;
        
        return $this;
    }

    /**
     * @return bool
     */
    public function getRevoked(): ?bool
    {
        return $this->revoked;
    }

    /**
     * revoked
     * @param bool $revoked
     * @return KeyInfo
     */
    public function setRevoked(bool $revoked): self
    {
        $this->revoked = $revoked;
        
        return $this;
    }

    /**
     * @return bool
     */
    public function getIsSecret(): ?bool
    {
        return $this->isSecret;
    }

    /**
     * @param bool $isSecret
     * @return KeyInfo
     */
    public function setIsSecret(bool $isSecret): self
    {
        $this->isSecret = $isSecret;
        
        return $this;
    }

    /**
     * @return bool
     */
    public function getCanSign(): ?bool
    {
        return $this->canSign;
    }

    /**
     * @param bool $canSign
     * @return KeyInfo
     */
    public function setCanSign(bool $canSign): self
    {
        $this->canSign = $canSign;
        
        return $this;
    }

    /**
     * @return bool
     */
    public function getCanEncrypt(): ?bool
    {
        return $this->canEncrypt;
    }

    /**
     * @param bool $canEncrypt
     * @return KeyInfo
     */
    public function setCanEncrypt(bool $canEncrypt): self
    {
        $this->canEncrypt = $canEncrypt;
        
        return $this;
    }

    /**
     * @return UidCollection
     */
    public function getUids(): ?UidCollection
    {
        return $this->uids;
    }

    /**
     * uids
     * @param UidCollection $uids
     * @return KeyInfo
     */
    public function setUids(UidCollection $uids): self
    {
        $this->uids = $uids;
        
        return $this;
    }

    /**
     * @return SubkeyCollection
     */
    public function getSubkeys(): ?SubkeyCollection
    {
        return $this->subkeys;
    }

    /**
     * @param SubkeyCollection $subkeys
     * @return KeyInfo
     */
    public function setSubkeys(SubkeyCollection $subkeys): self
    {
        $this->subkeys = $subkeys;
        
        return $this;
    }
}
