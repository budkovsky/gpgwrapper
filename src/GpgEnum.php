<?php
declare(strict_types=1);

namespace Budkovsky\GpgWrapper;

/**
 * GPG Enumerations
 * @see http://git.gnupg.org/cgi-bin/gitweb.cgi?p=gpgme.git;a=blob;f=src/gpgme.h.in;h=6cea2c777e2e763f063ad88e7b2135d21ba4bd4a;hb=107bff70edb611309f627058dd4777a5da084b1a
 */
class GpgEnum
{
    /**
     * Minimum length length of valid fingerprint
     * TODO confirm fingerprint minimum length
     * @var int
     */
    const FINGERPRINT_MINIMUM_LENGTH = 16;

    /**
     * Available modes for error_reporting
     * @see http://php.net/manual/en/function.gnupg-seterrormode.php
     */
    const ERROR_MODE_ALL = [
        GNUPG_ERROR_WARNING,
        GNUPG_ERROR_EXCEPTION,
        GNUPG_ERROR_SILENT
    ];
    const ERROR_MODE_WARNING = GNUPG_ERROR_WARNING;
    const ERROR_MODE_EXCEPTION = GNUPG_ERROR_EXCEPTION;
    const ERROR_MODE_SILENT = GNUPG_ERROR_SILENT;
    
    /**
     * Available modes for signing
     * @see http://php.net/manual/en/function.gnupg-setsignmode.php
     */
    const SIGN_MODE_ALL = [
        GNUPG_SIG_MODE_NORMAL,
        GNUPG_SIG_MODE_DETACH,
        GNUPG_SIG_MODE_CLEAR
    ];
    const SIGN_MODE_NORMAL = GNUPG_SIG_MODE_NORMAL;
    const SIGN_MODE_DETACH = GNUPG_SIG_MODE_DETACH;
    const SIGN_MODE_CLEAR = GNUPG_SIG_MODE_CLEAR;
    
    /**
     * Signature's summary available values
     * @see https://www.php.net/manual/en/function.gnupg-verify.php
     * @see https://www.php.net/manual/en/function.gnupg-decryptverify.php
     * @see http://git.gnupg.org/cgi-bin/gitweb.cgi?p=gpgme.git;a=blob;f=src/gpgme.h.in;h=6cea2c777e2e763f063ad88e7b2135d21ba4bd4a;hb=107bff70edb611309f627058dd4777a5da084b1a#l1506
     */
    const SIGSUM_VALID = 0x0001; //1
    const SIGSUM_GREEN = 0x0002; //2
    const SIGSUM_RED = 0x0004; //4
    const SIGSUM_KEY_REVOKED = 0x0010; //16
    const SIGSUM_KEY_EXPIRED = 0x0020; //32
    const SIGSUM_SIG_EXPIRED = 0x0040; //64
    const SIGSUM_KEY_MISSING = 0x0080; //128
    const SIGSUM_CRL_MISSING = 0x0100; //256
    const SIGSUM_CRL_TOO_OLD = 0x0200; //512
    const SIGSUM_BAD_POLICY = 0x0400; //1024
    const SIGSUM_SYS_ERROR = 0x0800; //2048
    
    /**
     * Signature's summary messages
     */
    const SIGSUM_MESSAGE = [
        self::SIGSUM_VALID => 'The signature is fully valid',
        self::SIGSUM_GREEN => 'The signature is good',
        self::SIGSUM_RED => 'The signature is bad',
        self::SIGSUM_KEY_REVOKED => 'One key has been revoked',
        self::SIGSUM_KEY_EXPIRED => 'One key has expired',
        self::SIGSUM_SIG_EXPIRED => 'The signature has expired',
        self::SIGSUM_KEY_MISSING => 'Can\'t verify: key missing',
        self::SIGSUM_CRL_MISSING => 'CRL not available',
        self::SIGSUM_CRL_TOO_OLD => 'Available CRL is too old',
        self::SIGSUM_BAD_POLICY => 'A policy was not met',
        self::SIGSUM_SYS_ERROR => 'A system error occured',
    ];
    
    /**
     * The available validities for a trust item or key
     * @see https://www.php.net/manual/en/function.gnupg-verify.php
     * @see https://www.php.net/manual/en/function.gnupg-decryptverify.php
     * @see http://git.gnupg.org/cgi-bin/gitweb.cgi?p=gpgme.git;a=blob;f=src/gpgme.h.in;h=6cea2c777e2e763f063ad88e7b2135d21ba4bd4a;hb=107bff70edb611309f627058dd4777a5da084b1a#l360
     */
    const VALIDITY_UNKNOWN   = 0;
    const VALIDITY_UNDEFINED = 1;
    const VALIDITY_NEVER     = 2;
    const VALIDITY_MARGINAL  = 3;
    const VALIDITY_FULL      = 4;
    const VALIDITY_ULTIMATE  = 5;

    /**
     * Siganture's validity messages
     */
    const VALIDITY_MESSAGE = [
        self::VALIDITY_UNKNOWN   => 'unknown',
        self::VALIDITY_UNDEFINED => 'undefined',
        self::VALIDITY_NEVER     => 'never',
        self::VALIDITY_MARGINAL  => 'marginal',
        self::VALIDITY_FULL      => 'full',
        self::VALIDITY_ULTIMATE  => 'ultimate',
    ];
    
    /**
     * Available protocols.
     * There are more undocument for gnupg extension.
     * @see https://www.php.net/manual/en/function.gnupg-getprotocol.php
     * @see http://git.gnupg.org/cgi-bin/gitweb.cgi?p=gpgme.git;a=blob;f=src/gpgme.h.in;h=6cea2c777e2e763f063ad88e7b2135d21ba4bd4a;hb=107bff70edb611309f627058dd4777a5da084b1a#l373
     */
    const PROTOCOL_OPEN_PGP = GNUPG_PROTOCOL_OpenPGP;
    const PROTOCOL_CMS = GNUPG_PROTOCOL_CMS;
}
