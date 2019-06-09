<?php
declare(strict_types=1);

namespace Budkovsky\GpgWrapper;

use Budkovsky\GpgWrapper\Entity\VerifyResult;
use Budkovsky\GpgWrapper\Collection\SignatureInfoCollection;
use Budkovsky\GpgWrapper\Entity\ImportResult;

/**
 * GnuPG Wrapper
 * Unifies parameters and return types for type hinting in PHP7
 */
class GpgWrapper
{
    /**
     * A GnuPG resource connection used by other GnuPG functions
     * @see http://php.net/manual/en/function.gnupg-init.php
     * @var resource
     */
    protected $gpgResource;

    /**
     * The constructor
     * @see http://php.net/manual/en/function.gnupg-init.php
     * @return self
     */
    public function __construct()
    {
        $this->gpgResource = gnupg_init();
    }
    
    /**
     * Add a key for decryption
     * @param string $fingerprint
     * @param string $passphrase
     * @throws GpgException
     * @return self
     */
    public function addDecryptKey(string $fingerprint): self
    {
        $success = gnupg_adddecryptkey($this->gpgResource, $fingerprint, null);
        if (!$success) {
            throw new GpgException('GPG: add decrypt key failure');
        }
        
        return $this;
    }
    
    /**
     * Add a key for encryption
     * @see http://php.net/manual/en/function.gnupg-addencryptkey.php
     * @param string $fingerprint
     * @throws GpgException
     * @return self
     */
    public function addEncryptKey(string $fingerprint): self
    {
        $success = gnupg_addencryptkey($this->gpgResource, $fingerprint);
        if (!$success) {
            throw new GpgException('GPG failure during action `add encrypt key`');
        }
        
        return $this;
    }
    
    /**
     *  Add a key for signing
     * TODO confirm is $passphrase='' valid for non-passphrase keys
     * @see http://php.net/manual/en/function.gnupg-addsignkey.php
     * @param string $fingerprint
     * @param string $passphrase
     * @throws GpgException
     * @return self
     */
    public function addSignKey(string $fingerprint, string $passphrase = ''): self
    {
        $success = gnupg_addsignkey($this->gpgResource, $fingerprint, $passphrase);
        if (!$success) {
            throw new GpgException('GPG: add sign key failure');
        }
        
        return $this;
    }
    
    /**
     * Removes decryption keys
     * @see http://php.net/manual/de/function.gnupg-cleardecryptkeys.php
     * @throws GpgException
     * @return self
     */
    public function clearDecryptKeys(): self
    {
        $success = gnupg_cleardecryptkeys($this->gpgResource);
        if (!$success) {
            throw new GpgException('GPG failure on action: `clear decrypt keys`');
        }
        
        return $this;
    }
    
    /**
     * Removes encryption keys
     * @see http://php.net/manual/en/function.gnupg-clearencryptkeys.php
     * @throws GpgException
     * @return self
     */
    public function clearEncryptKeys(): self
    {
        $success = gnupg_clearencryptkeys($this->gpgResource);
        if (!$success) {
            throw new GpgException('GPG failure on action: `clear encrypt keys`');
        }
        
        return $this;
    }
    
    /**
     * Removes sign keys
     * @see http://php.net/manual/en/function.gnupg-clearsignkeys.php
     * @throws GpgException
     * @return self
     */
    public function clearSignKeys(): self
    {
        $success = gnupg_clearsignkeys($this->gpgResource);
        if (!$success) {
            throw new GpgException('GPG failure on action: `clear sign keys`');
        }
        
        return $this;
    }
    
    /**
     * Decrypts a given text
     * @see http://php.net/manual/en/function.gnupg-decrypt.php
     * @param string $text
     * @throws GpgException
     * @return string
     */
    public function decrypt(string $text): string
    {
        $result = gnupg_decrypt($this->gpgResource, $text);
        if ($result === false) {
            throw new GpgException('GPG: decrypt failure');
        }
        
        return $result;
    }
    
    /**
     * Decrypts and verifies a given text
     * @see http://php.net/manual/en/function.gnupg-decryptverify.php
     * Data structure returned by gnupu_verify():
     * @see https://stackoverflow.com/questions/32787007/what-do-returned-values-of-php-gnupg-signature-verification-mean
     * @param string $text
     * @return VerifyResult
     * Returns signature info collection and plain text packed into VerifyResult object or NULL on failure
     */
    public function decryptVerify(string $text): ?VerifyResult
    {
        $plaintext = null;
        $result = gnupg_decryptverify($this->gpgResource, $text, $plaintext);
        
        return $result === false 
            ? null
            : new VerifyResult(new SignatureInfoCollection($result), $plaintext);
    }
    
    /**
     * Encrypts a given text
     * @see http://php.net/manual/en/function.gnupg-encrypt.php
     * @param string $plainText
     * @throws GpgException
     * @return string Returns encrypted string or empty string on failure
     */
    public function encrypt(string $plainText): string
    {
        $result = gnupg_encrypt($this->gpgResource, $plainText);
        if ($result === false) {
            throw new GpgException('GPG: encrypt failure');
        }
        
        return $result;
    }
    
    /**
     * Encrypts and signs a given text
     * @see http://php.net/manual/en/function.gnupg-encryptsign.php
     * @throws GpgException
     * @return string
     */
    public function encryptSign(string $plaintext): string
    {
        $result = gnupg_encryptsign($this->gpgResource, $plaintext);
        
        if ($result === false) {
            throw new GpgException('GPG failure on action: `encrypt and sign`');
        }
        
        return $result;
    }
    
    /**
     * Exports a key
     * @see http://php.net/manual/en/function.gnupg-export.php
     * @throws GpgException
     * @return string
     */
    public function export(string $fingerprint): string
    {
        $result = gnupg_export($this->gpgResource, $fingerprint);
        if ($result === false) {
            throw new GpgException('GPG failure on action: `export');
        }
        
        return $result;
    }
    
    /**
     * Returns the error as text
     * @return string Returns error as text if the a function fails or NULL otherwise
     */
    public function getError(): ?string
    {
        $result = gnupg_geterror($this->gpgResource);
        
        return $result === false ? null : $result;
    }
    
    /**
     * Returns the currently active protocol for all operations
     * @see http://php.net/manual/en/function.gnupg-getprotocol.php
     * @return int GNUPG_PROTOCOL_OpenPGP or GNUPG_PROTOCOL_CMS
     */
    public function getProtocol(): int
    {
        return gnupg_getprotocol($this->gpgResource);
    }
    
    /**
     * Imports a key
     * @see http://php.net/manual/en/function.gnupg-import.php
     * @param string $keyData
     * @throws GpgException
     * @return ImportResult
     */
    public function import(string $keyData): ImportResult
    {
        $result = gnupg_import($this->gpgResource, $keyData);
        if ($result === false) {
            throw new GpgException('GPG: key import failure');
        }
        
        return new ImportResult($result);
    }
    
    /**
     * Returns an array with information about all keys that matches the given pattern
     * @see http://php.net/manual/en/function.gnupg-keyinfo.php
     * @param string $pattern
     * @throws GpgException
     * @return array
     */
    public function keyinfo(string $pattern): array
    {
        $result = gnupg($this->gpgResource, $pattern);
        if ($result === false) {
            throw new GpgException('GPG: keyinfo failure');
        }
        
        return $result;
    }
    
    /**
     * Toggle armored output
     * @see http://php.net/manual/en/function.gnupg-setarmor.php
     * @param int $armor
     * @throws GpgException
     * @return self
     */
    public function setArmor(int $armor): self
    {
        $success = gnupg_setarmor($this->gpgResource, $armor);
        if (!$success) {
            throw new GpgException('GPG: set armor failure');
        }
        
        return $this;
    }
    
    /**
     * Sets the mode for error_reporting
     * @see http://php.net/manual/en/function.gnupg-seterrormode.php
     * @param int $errorMode
     * @return self
     */
    public function setErrorMode(int $errorMode): self
    {
        if (!in_array($errorMode, GpgEnum::ERROR_MODE_ALL)) {
            throw new GpgException('GPG: invalid parameter for error mode');
        }
        gnupg_seterrormode($this->gpgResource, $errorMode);
        
        return $this;
    }
    
    /**
     * Sets the mode for signing
     * @see http://php.net/manual/en/function.gnupg-setsignmode.php
     * @param int $signMode
     * @return self
     */
    public function setSignMode(int $signMode): self
    {
        if (!in_array($signMode, GpgEnum::SIGN_MODE_ALL)) {
            throw new GpgException('GPG: Invalid parameter for sign mode');
        }
        $success = gnupg_setsignmode($this->gpgResource, $signMode);
        if (!$success) {
            throw new GpgException('GPG: set sign mode failure');
        }
        
        return $this;
    }
    
    /**
     * Signs a given text
     * @see http://php.net/manual/en/function.gnupg-sign.php
     * @param string $plainText
     * @throws GpgException
     * @return string Returns the signed text or the signature
     */
    public function sign(string $plainText): string
    {
        $result = gnupg_sign($this->gpgResource, $plainText);
        if ($result === false) {
            throw new GpgException('GPG: sign failure');
        }
        
        return $result;
    }
    
    /**
     * Verifies a signed text
     * @see http://www.php.net/manual/en/function.gnupg-verify.php
     * Data structure returned by gnupu_verify():
     * @see https://stackoverflow.com/questions/32787007/what-do-returned-values-of-php-gnupg-signature-verification-mean
     * @param string $signedText
     * @return VerifyResult
     * Returns signature info collection and plain text packed into VerifyResult object or NULL on failure
     */
    public function verify(string $signedText): ?VerifyResult
    {
        $plainText = null;
        $result = gnupg_verify($this->gpgResource, $signedText, false, $plainText);
        
        return $result === false
            ? null
            : new VerifyResult(new SignatureInfoCollection($result), $plainText);
    }
}
