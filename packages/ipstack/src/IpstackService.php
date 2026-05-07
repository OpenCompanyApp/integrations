<?php

namespace OpenCompany\Integrations\Ipstack;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the IPstack geolocation REST API.
 *
 * Authentication uses an API key passed as a query parameter.
 * Base URL: https://api.ipstack.com
 */
class IpstackService
{
    /**
     * Create a new IPstack service instance.
     *
     * @param  string  $apiKey  API key for IPstack authentication.
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
     * @param  array<string>  $fields  Optional fields to include.
     * @param  array<string, mixed>  $options  Optional language, hostname, and security parameters.
     * @return array<string, mixed> The geolocation data for the IP address.
     *
     * @see https://ipstack.com/documentation#single
     */
    public function lookupIp(string $ip, array $fields = [], array $options = []): array
    {
        return $this->request('GET', "/{$ip}", $this->lookupParams($fields, $options));
    }

    /**
     * Look up geolocation data for multiple IP addresses in a single request.
     *
     * @param  array<string>  $ips  Array of IP addresses or domains to look up (max 50).
     * @param  array<string>  $fields  Optional fields to include.
     * @param  array<string, mixed>  $options  Optional language, hostname, and security parameters.
     * @return array<string, mixed> Array of geolocation results.
     *
     * @see https://ipstack.com/documentation#bulk
     */
    public function lookupBulk(array $ips, array $fields = [], array $options = []): array
    {
        return $this->request('GET', '/' . implode(',', $ips), $this->lookupParams($fields, $options));
    }

    /**
     * Get geolocation data for the requesting IP address.
     *
     * Uses the "check" endpoint which automatically detects the caller's IP.
     *
     * @param  array<string>  $fields  Optional fields to include.
     * @param  array<string, mixed>  $options  Optional language, hostname, and security parameters.
     * @return array<string, mixed> Geolocation data for the current IP.
     *
     * @see https://ipstack.com/documentation#check
     */
    public function lookupRequester(array $fields = [], array $options = []): array
    {
        return $this->request('GET', '/check', $this->lookupParams($fields, $options));
    }

    /**
     * Normalize optional lookup query parameters.
     *
     * @param  array<string>  $fields  Optional fields to include.
     * @param  array<string, mixed>  $options  Optional language, hostname, and security parameters.
     * @return array<string, mixed>
     */
    private function lookupParams(array $fields = [], array $options = []): array
    {
        $params = [];

        if (!empty($fields)) {
            $params['fields'] = implode(',', $fields);
        }
        if (!empty($options['language'])) {
            $params['language'] = $options['language'];
        }
        if (!empty($options['hostname'])) {
            $params['hostname'] = 1;
        }
        if (!empty($options['security'])) {
            $params['security'] = 1;
        }

        return $params;
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
