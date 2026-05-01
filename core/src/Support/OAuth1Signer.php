<?php

namespace OpenCompany\IntegrationCore\Support;

/**
 * Builds OAuth 1.0a HMAC-SHA1 authorization headers.
 *
 * X Ads and some X user-context endpoints require a signed Authorization
 * header for every request. This helper keeps request signing deterministic
 * and testable without coupling integrations to a specific HTTP client.
 */
class OAuth1Signer
{
    /**
     * Build an OAuth 1.0a Authorization header.
     *
     * @param  array<string, mixed>  $queryParams  Query parameters included in the request URL
     * @param  array<string, mixed>  $bodyParams  Form body parameters included in the signature base string
     */
    public static function authorizationHeader(
        string $method,
        string $url,
        array $queryParams,
        array $bodyParams,
        string $consumerKey,
        string $consumerSecret,
        string $token,
        string $tokenSecret,
        ?string $nonce = null,
        ?int $timestamp = null,
    ): string {
        $oauth = [
            'oauth_consumer_key' => $consumerKey,
            'oauth_nonce' => $nonce ?? bin2hex(random_bytes(16)),
            'oauth_signature_method' => 'HMAC-SHA1',
            'oauth_timestamp' => (string) ($timestamp ?? time()),
            'oauth_token' => $token,
            'oauth_version' => '1.0',
        ];

        $oauth['oauth_signature'] = self::signature(
            method: $method,
            url: $url,
            params: array_merge($queryParams, $bodyParams, $oauth),
            consumerSecret: $consumerSecret,
            tokenSecret: $tokenSecret,
        );

        $parts = [];
        foreach ($oauth as $key => $value) {
            $parts[] = self::encode($key) . '="' . self::encode((string) $value) . '"';
        }

        return 'OAuth ' . implode(', ', $parts);
    }

    /**
     * Generate the HMAC-SHA1 signature for a normalized request.
     *
     * @param  array<string, mixed>  $params  OAuth, query, and form parameters
     */
    public static function signature(
        string $method,
        string $url,
        array $params,
        string $consumerSecret,
        string $tokenSecret,
    ): string {
        $baseString = implode('&', [
            strtoupper($method),
            self::encode(self::baseUrl($url)),
            self::encode(self::normalizedParameters($params)),
        ]);

        $signingKey = self::encode($consumerSecret) . '&' . self::encode($tokenSecret);

        return base64_encode(hash_hmac('sha1', $baseString, $signingKey, true));
    }

    /**
     * Normalize parameters according to RFC 5849.
     *
     * @param  array<string, mixed>  $params
     */
    public static function normalizedParameters(array $params): string
    {
        $pairs = [];
        foreach ($params as $key => $value) {
            if ($value === null) {
                continue;
            }

            $values = is_array($value) ? array_values($value) : [$value];
            foreach ($values as $item) {
                if ($item === null) {
                    continue;
                }

                $pairs[] = [self::encode((string) $key), self::encode((string) $item)];
            }
        }

        usort($pairs, static function (array $a, array $b): int {
            return $a[0] === $b[0] ? $a[1] <=> $b[1] : $a[0] <=> $b[0];
        });

        return implode('&', array_map(
            static fn (array $pair): string => $pair[0] . '=' . $pair[1],
            $pairs,
        ));
    }

    private static function baseUrl(string $url): string
    {
        $parts = parse_url($url);
        $scheme = strtolower($parts['scheme'] ?? 'https');
        $host = strtolower($parts['host'] ?? '');
        $port = isset($parts['port']) ? ':' . $parts['port'] : '';
        $path = $parts['path'] ?? '';

        if (($scheme === 'http' && $port === ':80') || ($scheme === 'https' && $port === ':443')) {
            $port = '';
        }

        return $scheme . '://' . $host . $port . $path;
    }

    private static function encode(string $value): string
    {
        return str_replace('%7E', '~', rawurlencode($value));
    }
}
