<?php

namespace OpenCompany\Integrations\Ipstack;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the IPstack geolocation REST API.
 *
 * Authentication uses an API key passed as a query parameter (access_key=...).
 * Base URL: https://api.ipstack.com
 */
class IpstackService
{
    /**
     * Create a new IPstack service instance.
     *
     * @param  string  $apiKey  API key for IPstack authentication (passed as access_key query param).
     * @param  string  $baseUrl  Base URL for the IPstack API (default: https://api.ipstack.com).
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.ipstack.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Look up geolocation data for a single IP address.
     *
     * @param  string  $ip  The IP address to look up (e.g., "134.201.250.155").
     * @param  array<string, mixed>  $fields  Optional fields to include (e.g., ['main', 'location', 'timezone']).
     * @param  string|null  $language  Response language (e.g., "en", "de", "fr").
     * @return array<string, mixed> The geolocation data for the IP address.
     *
     * @see https://ipstack.com/documentation#single
     */
    public function lookupIp(string $ip, array $fields = [], ?string $language = null): array
    {
        $params = [];
        if (!empty($fields)) {
            $params['fields'] = implode(',', $fields);
        }
        if ($language !== null) {
            $params['language'] = $language;
        }

        return $this->request('GET', "/{$ip}", $params);
    }

    /**
     * Look up geolocation data for multiple IP addresses in a single request.
     *
     * @param  array<string>  $ips  Array of IP addresses to look up (max 50).
     * @param  array<string, mixed>  $fields  Optional fields to include.
     * @param  string|null  $language  Response language.
     * @return array<string, mixed> Array of geolocation results.
     *
     * @see https://ipstack.com/documentation#bulk
     */
    public function lookupBulk(array $ips, array $fields = [], ?string $language = null): array
    {
        $params = [];
        if (!empty($fields)) {
            $params['fields'] = implode(',', $fields);
        }
        if ($language !== null) {
            $params['language'] = $language;
        }

        return $this->request('GET', '/bulk', array_merge($params, ['ips' => implode(',', $ips)]));
    }

    /**
     * Check if an IP address is in a specific country or region.
     *
     * Returns the full geolocation result with a convenience `location_match` flag.
     *
     * @param  string  $ip  The IP address to check.
     * @param  string|null  $countryCode  ISO 3166-1 alpha-2 country code to match (e.g., "US").
     * @param  string|null  $regionCode  Region code to match (e.g., "CA").
     * @return array<string, mixed> Geolocation data with location_match indicator.
     */
    public function checkLocation(string $ip, ?string $countryCode = null, ?string $regionCode = null): array
    {
        $result = $this->lookupIp($ip, ['main', 'location', 'country']);

        $match = true;
        if ($countryCode !== null) {
            $match = ($result['country_code'] ?? '') === strtoupper($countryCode);
        }
        if ($regionCode !== null && $match) {
            $match = ($result['region_code'] ?? '') === strtoupper($regionCode);
        }

        $result['location_match'] = $match;

        return $result;
    }

    /**
     * Get timezone information for an IP address.
     *
     * @param  string  $ip  The IP address to look up.
     * @return array<string, mixed> Timezone data including ID, current time, and UTC offset.
     *
     * @see https://ipstack.com/documentation#timezone
     */
    public function getTimezone(string $ip): array
    {
        return $this->lookupIp($ip, ['main', 'timezone']);
    }

    /**
     * Get currency information for an IP address.
     *
     * @param  string  $ip  The IP address to look up.
     * @return array<string, mixed> Currency data including code, name, symbol, and exchange rates.
     *
     * @see https://ipstack.com/documentation#currency
     */
    public function getCurrency(string $ip): array
    {
        return $this->lookupIp($ip, ['main', 'currency']);
    }

    /**
     * Get connection information for an IP address.
     *
     * @param  string  $ip  The IP address to look up.
     * @return array<string, mixed> Connection data including ASN, ISP, and organization.
     *
     * @see https://ipstack.com/documentation#connection
     */
    public function getConnection(string $ip): array
    {
        return $this->lookupIp($ip, ['main', 'connection']);
    }

    /**
     * Get geolocation data for the requesting IP address (current user).
     *
     * Uses the "check" endpoint which automatically detects the caller's IP.
     *
     * @return array<string, mixed> Geolocation data for the current IP.
     *
     * @see https://ipstack.com/documentation#check
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/check');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST).
     * @param  string  $path  API endpoint path (e.g., "/check").
     * @param  array<string, mixed>  $data  Query parameters.
     * @return array<string, mixed> The parsed JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (!$this->isConfigured()) {
            throw new \RuntimeException('IPstack API key is not configured.');
        }

        // IPstack uses access_key as a query parameter
        $data['access_key'] = $this->apiKey;

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if ($response->failed()) {
                $body = $response->json();
                $message = $body['error']['info'] ?? $body['error']['type'] ?? $response->body();

                Log::error('IPstack API error', [
                    'method' => $method,
                    'path' => $path,
                    'status' => $response->status(),
                    'body' => $body,
                ]);

                throw new \RuntimeException("IPstack API error ({$response->status()}): {$message}");
            }

            $json = $response->json() ?? [];

            // IPstack may return errors in a 200 response with an "error" key
            if (isset($json['error']) && isset($json['error']['code'])) {
                $error = $json['error'];
                $message = $error['info'] ?? $error['type'] ?? 'Unknown error';
                throw new \RuntimeException("IPstack API error ({$error['code']}): {$message}");
            }

            return $json;
        } catch (ConnectionException $e) {
            Log::error('IPstack connection error', ['method' => $method, 'path' => $path, 'error' => $e->getMessage()]);
            throw new \RuntimeException("IPstack connection error: {$e->getMessage()}");
        }
    }
}
