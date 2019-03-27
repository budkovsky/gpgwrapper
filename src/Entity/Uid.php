<?php
declare(strict_types=1);

namespace Budkovsky\GpgWrapper\Entity;

/**
 * GPG keyinfo's UID container
 * @see http://php.net/manual/en/function.gnupg-keyinfo.php
 */
class Uid
{
    /**
     * @var string
     */
    protected $name;
    
    /**
     * @var string
     */
    protected $comment;
    
    /**
     * @var string
     */
    protected $email;
    
    /**
     * @var string
     */
    protected $uid;
    
    /**
     * @var bool
     */
    protected $revoked;
    
    /**
     * @var bool
     */
    protected $invalid;
    
    public function __construct(array $input = [])
    {
        if (isset($input['name'])) {
            $this->setName($input['name']);
        }
        if (isset($input['comment'])) {
            $this->setComment($input['comment']);
        }
        if (isset($input['email'])) {
            $this->setEmail($input['email']);
        }
        if (isset($input['uid'])) {
            $this->setUid($input['uid']);
        }
        if (isset($input['revoked'])) {
            $this->setRevoked($input['revoked']);
        }
        if (isset($input['invalid'])) {
            $this->setInvalid($input['invalid']);
        }
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Uid
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        
        return $this;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     * @return Uid
     */
    public function setComment(string $comment): self
    {
        $this->comment = $comment;
        
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Uid
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;
        
        return $this;
    }

    /**
     * @return string
     */
    public function getUid(): string
    {
        return $this->uid;
    }

    /**
     * @param string $uid
     * @return Uid
     */
    public function setUid(string $uid): self
    {
        $this->uid = $uid;
        
        return $this;
    }

    /**
     * @return bool
     */
    public function getRevoked(): bool
    {
        return $this->revoked;
    }

    /**
     * @param bool $revoked
     * @return Uid
     */
    public function setRevoked(bool $revoked): self
    {
        $this->revoked = $revoked;
        
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
     * @return Uid
     */
    public function setInvalid(bool $invalid): self
    {
        $this->invalid = $invalid;
        
        return $this;
    }

}
