<?php

namespace OpenCompany\Integrations\Bitwarden;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Bitwarden Public API.
 *
 * Handles OAuth client-credentials token exchange, bearer authentication,
 * JSON request dispatch, path/query construction, and API error handling.
 */
class BitwardenService
{
    private ?string $cachedAccessToken = null;

    /**
     * @param  string  $clientId  Bitwarden organization API client id.
     * @param  string  $clientSecret  Bitwarden organization API client secret.
     * @param  string  $accessToken  Optional pre-issued bearer access token.
     * @param  string  $baseUrl  Bitwarden API base URL, for example https://api.bitwarden.com.
     * @param  string  $identityUrl  Bitwarden OAuth token URL.
     */
    public function __construct(
        private string $clientId = '',
        private string $clientSecret = '',
        private string $accessToken = '',
        private string $baseUrl = 'https://api.bitwarden.com',
        private string $identityUrl = 'https://identity.bitwarden.com/connect/token',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
        $this->identityUrl = rtrim($this->identityUrl, '/');
    }

    /**
     * Check whether the service has either a bearer token or OAuth client credentials.
     */
    public function isConfigured(): bool
    {
        return $this->accessToken !== '' || ($this->clientId !== '' && $this->clientSecret !== '');
    }

    /**
     * Return official Bitwarden Public API operation metadata.
     *
     * @return array<string, array<string, mixed>>
     */
    public static function operations(): array
    {
        return BitwardenOperations::all();
    }

    /**
     * Exchange organization API credentials for a bearer token.
     *
     * @return array<string, mixed>
     */
    public function fetchAccessToken(): array
    {
        if ($this->clientId === '' || $this->clientSecret === '') {
            throw new RuntimeException('Bitwarden client id and client secret are required to fetch an access token.');
        }

        try {
            $response = Http::asForm()
                ->acceptJson()
                ->timeout(30)
                ->post($this->identityUrl, [
                    'grant_type' => 'client_credentials',
                    'scope' => 'api.organization',
                    'client_id' => $this->clientId,
                    'client_secret' => $this->clientSecret,
                ]);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error('Bitwarden token request connection error', ['error' => $e->getMessage()]);
            throw new RuntimeException('Failed to connect to Bitwarden identity endpoint: '.$e->getMessage());
        }

        if (! $response->successful()) {
            $error = $response->json('error_description') ?? $response->json('error') ?? $response->body();
            Log::error('Bitwarden token request failed', ['status' => $response->status(), 'error' => $error]);
            throw new RuntimeException('Bitwarden token request failed ('.$response->status().'): '.(is_string($error) ? $error : json_encode($error)));
        }

        $json = $response->json() ?? [];
        $token = $json['access_token'] ?? null;

        if (! is_string($token) || $token === '') {
            throw new RuntimeException('Bitwarden token response did not include an access_token.');
        }

        $this->cachedAccessToken = $token;

        return $json;
    }

    /**
     * Execute an official Bitwarden Public API operation.
     *
     * @param  array<string, mixed>  $pathParams  Path parameters keyed by upstream name.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $headers  Extra headers.
     * @param  array<string, mixed>  $body  JSON request body.
     * @return array<string, mixed>
     */
    public function request(string $method, string $pathTemplate, array $pathParams = [], array $query = [], array $headers = [], array $body = []): array
    {
        $response = $this->rawRequest($method, $this->expandPath($pathTemplate, $pathParams), $query, $headers, $body);

        if ($response->status() === 204 || $response->body() === '') {
            return ['success' => true, 'status' => $response->status()];
        }

        $contentType = (string) $response->header('Content-Type');

        if (! str_contains($contentType, 'json')) {
            return ['body' => $response->body(), 'content_type' => $contentType, 'status' => $response->status()];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw authenticated request to the Bitwarden API.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $headers  Extra headers.
     * @param  array<string, mixed>  $body  JSON request body.
     */
    private function rawRequest(string $method, string $path, array $query = [], array $headers = [], array $body = []): Response
    {
        if (! $this->isConfigured()) {
            throw new RuntimeException('Bitwarden integration is not configured.');
        }

        $method = strtoupper($method);
        $url = $this->urlWithQuery($this->baseUrl.$path, $query);

        try {
            $http = Http::withHeaders(array_merge([
                'Authorization' => 'Bearer '.$this->bearerToken(),
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ], $headers))->timeout(120);

            $response = match ($method) {
                'GET' => $http->get($url),
                'POST' => $http->post($url, $body),
                'PUT' => $http->put($url, $body),
                'PATCH' => $http->patch($url, $body),
                'DELETE' => $http->delete($url, $body),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Bitwarden API connection error: {$method} {$path}", ['error' => $e->getMessage()]);
            throw new RuntimeException('Failed to connect to Bitwarden API: '.$e->getMessage());
        }

        if (! $response->successful()) {
            $error = $response->json('message') ?? $response->json('error_description') ?? $response->json('error') ?? $response->body();
            Log::error("Bitwarden API error: {$method} {$path}", ['status' => $response->status(), 'error' => $error]);
            throw new RuntimeException('Bitwarden API error ('.$response->status().'): '.(is_string($error) ? $error : json_encode($error)));
        }

        return $response;
    }

    private function bearerToken(): string
    {
        if ($this->accessToken !== '') {
            return $this->accessToken;
        }

        if ($this->cachedAccessToken !== null) {
            return $this->cachedAccessToken;
        }

        $token = $this->fetchAccessToken()['access_token'] ?? null;

        if (! is_string($token) || $token === '') {
            throw new RuntimeException('Bitwarden token response did not include an access_token.');
        }

        return $token;
    }

    /**
     * @param  array<string, mixed>  $pathParams  Path parameters.
     */
    private function expandPath(string $template, array $pathParams): string
    {
        return (string) preg_replace_callback('/\{([^}]+)\}/', function (array $matches) use ($pathParams): string {
            $key = $matches[1];

            if (! array_key_exists($key, $pathParams) || $pathParams[$key] === null || $pathParams[$key] === '') {
                throw new RuntimeException($key.' must be a non-empty path parameter.');
            }

            return rawurlencode((string) $pathParams[$key]);
        }, $template);
    }

    /**
     * @param  array<string, mixed>  $query  Query parameters.
     */
    private function urlWithQuery(string $url, array $query): string
    {
        $parts = [];

        foreach ($query as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }

            foreach (is_array($value) ? $value : [$value] as $item) {
                if ($item === null || $item === '') {
                    continue;
                }

                $encodedValue = is_bool($item) ? ($item ? 'true' : 'false') : (string) $item;
                $parts[] = rawurlencode((string) $key).'='.rawurlencode($encodedValue);
            }
        }

        return $parts === [] ? $url : $url.'?'.implode('&', $parts);
    }
}