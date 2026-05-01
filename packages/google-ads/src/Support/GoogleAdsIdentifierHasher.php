<?php

namespace OpenCompany\Integrations\GoogleAds\Support;

/**
 * Normalizes and hashes user identifiers for Google Ads conversion and audience uploads.
 *
 * Raw identifiers should be transformed before being sent to Google and must never be logged.
 */
class GoogleAdsIdentifierHasher
{
    /**
     * Normalize and SHA-256 hash an email address for Google Ads uploads.
     */
    public static function hashEmail(string $email): string
    {
        $normalized = strtolower(trim($email));
        $parts = explode('@', $normalized, 2);

        if (count($parts) === 2 && in_array($parts[1], ['gmail.com', 'googlemail.com'], true)) {
            $local = str_replace('.', '', $parts[0]);
            $local = explode('+', $local, 2)[0];
            $normalized = $local . '@' . $parts[1];
        }

        return hash('sha256', $normalized);
    }

    /**
     * Normalize and SHA-256 hash a phone number.
     *
     * Google expects E.164 formatting before hashing; this method strips spaces and punctuation
     * but intentionally does not infer a missing country code.
     */
    public static function hashPhone(string $phone): string
    {
        $normalized = preg_replace('/[^\d+]/', '', trim($phone)) ?? trim($phone);

        return hash('sha256', $normalized);
    }

    /**
     * Normalize and SHA-256 hash a free-text identifier.
     */
    public static function hashText(string $value): string
    {
        $normalized = strtolower(preg_replace('/\s+/', '', trim($value)) ?? trim($value));

        return hash('sha256', $normalized);
    }
}
