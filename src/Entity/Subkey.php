<?php
declare(strict_types=1);

namespace Budkovsky\GpgWrapper\Entity;

/**
 * GPG keyinfo's subkey container
 */
class Subkey
{
    /**
     * @var string
     */
    protected $fingerprint;
    
    /**
     * @var string
     */
    protected $keyId;
    
    /**
     * @var int
     */
    protected $timestamp;
    
    /**
     * @var int
     */
    protected $expires;
    
    /**
     * @var bool
     */
    protected $isSecret;
    
    /**
     * @var bool
     */
    protected $invalid;
    
    /**
     * @var bool
     */
    protected $canEncrypt;
    
    /**
     * @var bool
     */
    protected $canSign;
    
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
    
    public function __construct(array $subkey = [])
    {
        if (isset($subkey['fingerprint'])) {
            $this->setFingerprint($subkey['fingerprint']);
        }
        if (isset($subkey['keyid'])) {
            $this->setKeyId($subkey['keyid']);
        }
        if (isset($subkey['timestamp'])) {
            $this->setTimestamp($subkey['timestamp']);
        }
        if (isset($subkey['expires'])) {
            $this->setExpires($subkey['expires']);
        }
        if (isset($subkey['is_secret'])) {
            $this->setIsSecret($subkey['is_secret']);
        }
        if (isset($subkey['invalid'])) {
            $this->setInvalid($subkey['invalid']);
        }
        if (isset($subkey['can_encrypt'])) {
            $this->setCanEncrypt($subkey['can_encrypt']);
        }
        if (isset($subkey['can_sign'])) {
            $this->setCanSign($subkey['can_sign']);
        }
        if (isset($subkey['disabled'])) {
            $this->setDisabled($subkey['disabled']);
        }
        if (isset($subkey['expired'])) {
            $this->setExpired($subkey['expired']);
        }
        if (isset($subkey['revoked'])) {
            $this->setRevoked($subkey['revoked']);
        }
    }

    /**
     * @return string
     */
    public function getFingerprint(): string
    {
        return $this->fingerprint;
    }

    /**
     * @param string $fingerprint
     * @return Subkey
     */
    public function setFingerprint(string $fingerprint): self
    {
        $this->fingerprint = $fingerprint;
        
        return $this;
    }

    /**
     * @return string
     */
    public function getKeyId(): string
    {
        return $this->keyId;
    }

    /**
     * @param string $keyId
     * @return Subkey
     */
    public function setKeyId(string $keyId): self
    {
        $this->keyId = $keyId;
        
        return $this;
    }

    /**
     * @return int
     */
    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    /**
     * @param int $timestamp
     * @return Subkey
     */
    public function setTimestamp(int $timestamp): self
    {
        $this->timestamp = $timestamp;
        
        return $this;
    }

    /**
     * @return int
     */
    public function getExpires(): int
    {
        return $this->expires;
    }

    /**
     * @param int $expires
     * @return Subkey
     */
    public function setExpires(int $expires): self
    {
        $this->expires = $expires;
        
        return $this;
    }

    /**
     * @return bool
     */
    public function getIsSecret(): bool
    {
        return $this->isSecret;
    }

    /**
     * @param bool $isSecret
     * @return Subkey
     */
    public function setIsSecret(bool $isSecret): self
    {
        $this->isSecret = $isSecret;
        
        return $this;
    }

    /**
     * @return bool
     */
    public function getInvalid(): bool
    {
        return $this->invalid;
    }

    /**
     * @param bool $invalid
     * @return Subkey
     */
    public function setInvalid(bool $invalid): self
    {
        $this->invalid = $invalid;
        
        return $this;
    }

    /**
     * @return bool
     */
    public function getCanEncrypt(): bool
    {
        return $this->canEncrypt;
    }

    /**
     * @param bool $canEncrypt
     * @return Subkey
     */
    public function setCanEncrypt(bool $canEncrypt): self
    {
        $this->canEncrypt = $canEncrypt;
        
        return $this;
    }

    /**
     * @return bool
     */
    public function getCanSign(): bool
    {
        return $this->canSign;
    }

    /**
     * @param bool $canSign
     * @return Subkey
     */
    public function setCanSign(bool $canSign): self
    {
        $this->canSign = $canSign;
        
        return $this;
    }

    /**
     * disabled
     * @return bool
     */
    public function getDisabled(): bool
    {
        return $this->disabled;
    }

    /**
     * disabled
     * @param bool $disabled
     * @return Subkey
     */
    public function setDisabled(bool $disabled): self
    {
        $this->disabled = $disabled;
        
        return $this;
    }

    /**
     * expired
     * @return bool
     */
    public function getExpired(): bool
    {
        return $this->expired;
    }

    /**
     * expired
     * @param bool $expired
     * @return Subkey
     */
    public function setExpired(bool $expired): self
    {
        $this->expired = $expired;
        
        return $this;
    }

    /**
     * revoked
     * @return bool
     */
    public function getRevoked(): bool
    {
        return $this->revoked;
    }

    /**
     * @param bool $revoked
     * @return Subkey
     */
    public function setRevoked(bool $revoked): self
    {
        $this->revoked = $revoked;
        
        return $this;
    }
}
