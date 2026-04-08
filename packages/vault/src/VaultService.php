<?php

namespace OpenCompany\Integrations\Vault;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the HashiCorp Vault REST API (v1).
 *
 * Provides methods for secrets management (KV v2), policy management,
 * and token introspection.
 */
class VaultService
{
    private const BASE_URL = 'https://api.vaultproject.io/v1';

    /**
     * @param  string  $token  Vault token (Bearer auth)
     * @param  string  $baseUrl  Optional custom Vault server URL
     */
    public function __construct(
        private string $token = '',
        private string $baseUrl = self::BASE_URL,
    ) {}

    /**
     * Check whether the Vault token has been configured.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->token);
    }

    /*-----------------------------------------------------------------------
     | Secrets (KV v2)
     *---------------------------------------------------------------------*/

    /**
     * List secrets at a given path in a KV v2 secrets engine.
     *
     * @return array<string, mixed>
     */
    public function listSecrets(string $enginePath = 'secret', string $path = ''): array
    {
        $urlPath = "/{$enginePath}/metadata/{$path}";
        $urlPath = rtrim($urlPath, '/');

        return $this->request('LIST', $urlPath);
    }

    /**
     * Get the latest version of a secret from a KV v2 secrets engine.
     *
     * @return array<string, mixed>
     */
    public function getSecret(string $path, string $enginePath = 'secret', ?int $version = null): array
    {
        $params = [];
        if ($version !== null) {
            $params['version'] = $version;
        }

        return $this->request('GET', "/{$enginePath}/data/{$path}", $params);
    }

    /**
     * Create or update a secret in a KV v2 secrets engine.
     *
     * @param  array<string, mixed>  $data  Key-value secret data
     * @return array<string, mixed>
     */
    public function createSecret(string $path, array $data, string $enginePath = 'secret'): array
    {
        return $this->request('POST', "/{$enginePath}/data/{$path}", [
            'data' => $data,
        ]);
    }

    /**
     * Delete all versions and metadata of a secret from a KV v2 secrets engine.
     *
     * @return array<string, mixed>
     */
    public function deleteSecret(string $path, string $enginePath = 'secret'): array
    {
        return $this->request('DELETE', "/{$enginePath}/metadata/{$path}");
    }

    /*-----------------------------------------------------------------------
     | Policies
     *---------------------------------------------------------------------*/

    /**
     * List all ACL policies.
     *
     * @return array<string, mixed>
     */
    public function listPolicies(): array
    {
        return $this->request('LIST', '/sys/policies/acl');
    }

    /**
     * Get details of a specific ACL policy.
     *
     * @return array<string, mixed>
     */
    public function getPolicy(string $name): array
    {
        return $this->request('GET', "/sys/policies/acl/{$name}");
    }

    /*-----------------------------------------------------------------------
     | Auth / Token
     *---------------------------------------------------------------------*/

    /**
     * Look up the current token's information.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/auth/token/lookup-self');
    }

    /*-----------------------------------------------------------------------
     | Core HTTP
     *---------------------------------------------------------------------*/

    /**
     * Make an authenticated API request to Vault.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $params = []): array
    {
        if (! $this->token) {
            throw new \RuntimeException('Vault token is not configured.');
        }

        $params = array_filter($params, fn ($v) => $v !== null && $v !== '');

        try {
            $http = Http::withHeaders([
                'Authorization' => "Bearer {$this->token}",
                'Accept' => 'application/json',
            ])->timeout(30);

            $url = rtrim($this->baseUrl, '/') . $path;

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $params),
                'POST' => $http->post($url, $params),
                'PUT' => $http->put($url, $params),
                'PATCH' => $http->patch($url, $params),
                'DELETE' => $http->delete($url, $params),
                'LIST' => $http->send('LIST', $url, ['query' => $params]),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if ($response->status() === 429) {
                throw new \RuntimeException('Vault rate limit exceeded.');
            }

            if (! $response->successful()) {
                $body = $response->json() ?? [];
                $error = $body['errors'][0] ?? $response->body();

                Log::error("Vault API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException(
                    'Vault API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error))
                );
            }

            // Some endpoints return 204 No Content
            if ($response->status() === 204 || $response->body() === '') {
                return ['success' => true];
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Vault API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Vault API: {$e->getMessage()}");
        }
    }
}
