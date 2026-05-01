<?php

namespace OpenCompany\Integrations\GoogleDataManager;

use App\Models\IntegrationSetting;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Google Data Manager API.
 *
 * Handles OAuth token refresh, v1 ingestion endpoints, request status polling,
 * and normalized error handling for agent-facing tools.
 */
class GoogleDataManagerService
{
    private const BASE_URL = 'https://datamanager.googleapis.com/v1';

    /**
     * @param  string  $clientId  OAuth client ID
     * @param  string  $clientSecret  OAuth client secret
     * @param  string  $accessToken  OAuth access token
     * @param  string  $refreshToken  OAuth refresh token for CLI/manual setup
     * @param  int|null  $expiresAt  Unix timestamp when the access token expires
     */
    public function __construct(
        private string $clientId = '',
        private string $clientSecret = '',
        private string $accessToken = '',
        private string $refreshToken = '',
        private ?int $expiresAt = null,
    ) {}

    public function isConfigured(): bool
    {
        return $this->accessToken !== '';
    }

    /**
     * Return safe runtime diagnostics without exposing secrets.
     *
     * @return array<string, mixed>
     */
    public function diagnostics(): array
    {
        return [
            'configured' => $this->isConfigured(),
            'hasRefreshToken' => $this->refreshToken !== '',
            'supportsCliManualTokenSetup' => true,
            'oauthScope' => 'https://www.googleapis.com/auth/datamanager',
            'baseUrl' => self::BASE_URL,
        ];
    }

    /**
     * Upload conversion event resources to Google advertising destinations.
     *
     * @param  array<string, mixed>  $body
     * @return array<string, mixed>
     */
    public function ingestEvents(array $body): array
    {
        return $this->request('POST', '/events:ingest', $body);
    }

    /**
     * Upload audience member resources to Google advertising destinations.
     *
     * @param  array<string, mixed>  $body
     * @return array<string, mixed>
     */
    public function ingestAudienceMembers(array $body): array
    {
        $count = count($body['audienceMembers'] ?? []);
        if ($count > 10000) {
            throw new \InvalidArgumentException('Google Data Manager allows at most 10,000 audienceMembers per ingest request.');
        }

        return $this->request('POST', '/audienceMembers:ingest', $body);
    }

    /**
     * Remove audience member resources from Google advertising destinations.
     *
     * @param  array<string, mixed>  $body
     * @return array<string, mixed>
     */
    public function removeAudienceMembers(array $body): array
    {
        $count = count($body['audienceMembers'] ?? []);
        if ($count > 10000) {
            throw new \InvalidArgumentException('Google Data Manager allows at most 10,000 audienceMembers per remove request.');
        }

        return $this->request('POST', '/audienceMembers:remove', $body);
    }

    /**
     * Retrieve the async processing status for an ingestion request.
     *
     * @return array<string, mixed>
     */
    public function retrieveRequestStatus(string $requestId): array
    {
        return $this->request('GET', '/requestStatus:retrieve', query: ['requestId' => $requestId]);
    }

    /**
     * Perform a raw Data Manager API request.
     *
     * @param  array<string, mixed>  $body
     * @param  array<string, mixed>  $query
     * @return array<string, mixed>
     */
    public function raw(string $method, string $path, array $body = [], array $query = []): array
    {
        return $this->request($method, $path, $body, $query);
    }

    /**
     * @param  array<string, mixed>  $data
     * @param  array<string, mixed>  $query
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = [], array $query = []): array
    {
        $this->ensureValidToken();

        $url = self::BASE_URL . '/' . ltrim($path, '/');
        $http = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->accessToken,
            'Content-Type' => 'application/json',
        ])->timeout(60)->acceptJson();

        if ($query !== []) {
            $http = $http->withQueryParameters($query);
        }

        $started = microtime(true);
        $response = match (strtoupper($method)) {
            'GET' => $http->get($url),
            'POST' => $http->post($url, $this->cleanNulls($data)),
            'PATCH' => $http->patch($url, $this->cleanNulls($data)),
            'DELETE' => $http->delete($url, $this->cleanNulls($data)),
            default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
        };

        $elapsedMs = (int) round((microtime(true) - $started) * 1000);
        if (! $response->successful()) {
            $this->handleError(strtoupper($method), $path, $response, $elapsedMs);
        }

        $json = $response->json();
        $result = is_array($json) ? $json : [];
        $result['_meta'] = [
            'elapsedMs' => $elapsedMs,
        ];

        return $result;
    }

    private function ensureValidToken(): void
    {
        if ($this->accessToken === '') {
            throw new \RuntimeException('Google Data Manager access token is not configured.');
        }
        if ($this->expiresAt !== null && $this->expiresAt > time() + 60) {
            return;
        }
        if ($this->refreshToken === '' || $this->clientId === '' || $this->clientSecret === '') {
            return;
        }

        $this->refreshAccessToken();
    }

    private function refreshAccessToken(): void
    {
        $response = Http::asForm()->timeout(15)->post('https://oauth2.googleapis.com/token', [
            'client_id' => $this->clientId,
            'client_secret' => $this->clientSecret,
            'refresh_token' => $this->refreshToken,
            'grant_type' => 'refresh_token',
        ]);

        if (! $response->successful()) {
            $error = $response->json('error_description') ?? $response->json('error') ?? $response->body();
            throw new \RuntimeException('Failed to refresh Google Data Manager access token: ' . (is_string($error) ? $error : json_encode($error)));
        }

        $data = $response->json() ?? [];
        $this->accessToken = (string) ($data['access_token'] ?? '');
        $this->expiresAt = time() + (int) ($data['expires_in'] ?? 3600);

        if (class_exists(IntegrationSetting::class)) {
            $setting = IntegrationSetting::where('integration_id', 'google_data_manager')->first();
            if ($setting) {
                $config = $setting->config ?? [];
                $config['access_token'] = $this->accessToken;
                $config['expires_at'] = $this->expiresAt;
                $setting->config = $config;
                $setting->save();
            }
        }
    }

    /**
     * @return array<string, mixed>
     */
    private function cleanNulls(array $value): array
    {
        foreach ($value as $key => $item) {
            if ($item === null) {
                unset($value[$key]);
            } elseif (is_array($item)) {
                $value[$key] = $this->cleanNulls($item);
            }
        }

        return $value;
    }

    private function handleError(string $method, string $path, Response $response, int $elapsedMs): void
    {
        $body = $response->json() ?? [];
        $error = $body['error']['message'] ?? $body['message'] ?? $response->body();

        Log::error('Google Data Manager API error', [
            'method' => $method,
            'path' => $path,
            'status' => $response->status(),
            'elapsed_ms' => $elapsedMs,
            'error' => $error,
        ]);

        throw new \RuntimeException('Google Data Manager API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)));
    }
}
