<?php

namespace Hemker\RandomString;

class CharPreset
{
    /** @var string [0-9] */
    public const DECIMAL = self::DIGIT;

    /** @var string [a-z] */
    public const LETTER_LOWER_CASE = self::LOWER_A_Z;

    /** @var string [A-Z] */
    public const LETTER_UPPER_CASE = self::UPPER_A_Z;

    /** @var string [A-F0-9] */
    public const BASE16 = 'ABCDEF'.self::DIGIT;

    /** @var string [A-Z2-7] */
    public const BASE32 = self::UPPER_A_Z.'234567';

    /** @var string [A-Z0-9] */
    public const BASE36 = self::UPPER_A_Z.self::DIGIT;

    /** @var string Like BASE62 [a-zA-Z0-9], but without i (lower I), I (upper i), o (lower O), O (upper o), 0 (Zero) and l (lower L) */
    public const BASE56 = 'abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ123456789';

    /** @var string Like BASE62 [a-zA-Z0-9], but without 0 (zero), O (upper o), I (upper i) and l (lower L) */
    public const BASE58 = 'abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ123456789';

    /** @var string [a-zA-Z0-9] */
    public const BASE62 = self::LOWER_A_Z.self::UPPER_A_Z.self::DIGIT;

    /** @var string Like BASE64 [a-zA-Z0-9], additional + and / */
    public const BASE64 = self::BASE62.'+/';

    /** @var string [0-9] */
    private const DIGIT = '0123456789';

    /** @var string [a-z] */
    private const LOWER_A_Z = 'abcdefghijklmnopqrstuvwxyz';

    /** @var string [A-Z] */
    private const UPPER_A_Z = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
}
