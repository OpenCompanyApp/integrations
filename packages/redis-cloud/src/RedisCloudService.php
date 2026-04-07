<?php

namespace OpenCompany\Integrations\RedisCloud;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Service client for the Redis Cloud REST API.
 *
 * Redis Cloud exposes a management REST API at https://api.redislabs.com/v1
 * for administering subscriptions, databases, accounts, and teams.
 * Authentication uses an API key + secret key pair sent via HTTP Basic Auth.
 *
 * @see https://redis.io/docs/latest/operate/rc/api/
 */
class RedisCloudService
{
    /**
     * Base URL for the Redis Cloud REST API.
     */
    private string $baseUrl = 'https://api.redislabs.com/v1';

    /**
     * Create a new RedisCloudService instance.
     *
     * @param  string  $apiKey     Redis Cloud API key (account-level key).
     * @param  string  $secretKey  Redis Cloud API secret key.
     */
    public function __construct(
        private string $apiKey = '',
        private string $secretKey = '',
    ) {}

    /**
     * Check whether the service has enough configuration to make requests.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey) && !empty($this->secretKey);
    }

    // -------------------------------------------------------------------------
    // Account
    // -------------------------------------------------------------------------

    /**
     * Get the current authenticated account information.
     *
     * Uses GET /v1/accounts/current.
     *
     * @return array<string, mixed> Account details including owner, payment method, etc.
     */
    public function getCurrentAccount(): array
    {
        return $this->request('GET', '/accounts/current');
    }

    // -------------------------------------------------------------------------
    // Subscriptions
    // -------------------------------------------------------------------------

    /**
     * List all subscriptions in the account.
     *
     * Uses GET /v1/subscriptions.
     *
     * @return array<string, mixed> List of subscription objects.
     */
    public function listSubscriptions(): array
    {
        return $this->request('GET', '/subscriptions');
    }

    /**
     * Get details for a specific subscription.
     *
     * Uses GET /v1/subscriptions/{id}.
     *
     * @param  int  $subscriptionId  The subscription ID.
     * @return array<string, mixed> Subscription details.
     */
    public function getSubscription(int $subscriptionId): array
    {
        return $this->request('GET', '/subscriptions/' . $subscriptionId);
    }

    // -------------------------------------------------------------------------
    // Databases
    // -------------------------------------------------------------------------

    /**
     * List all databases in a subscription.
     *
     * Uses GET /v1/subscriptions/{subscriptionId}/databases.
     *
     * @param  int  $subscriptionId  The subscription ID.
     * @return array<string, mixed> List of database objects.
     */
    public function listDatabases(int $subscriptionId): array
    {
        return $this->request('GET', '/subscriptions/' . $subscriptionId . '/databases');
    }

    /**
     * Get details for a specific database.
     *
     * Uses GET /v1/subscriptions/{subscriptionId}/databases/{databaseId}.
     *
     * @param  int  $subscriptionId  The subscription ID.
     * @param  int  $databaseId      The database ID within the subscription.
     * @return array<string, mixed> Database details.
     */
    public function getDatabase(int $subscriptionId, int $databaseId): array
    {
        return $this->request(
            'GET',
            '/subscriptions/' . $subscriptionId . '/databases/' . $databaseId,
        );
    }

    // -------------------------------------------------------------------------
    // Teams & Users
    // -------------------------------------------------------------------------

    /**
     * List all teams (ACL roles) in the account.
     *
     * Uses GET /v1/teams.
     *
     * @return array<string, mixed> List of team objects.
     */
    public function listTeams(): array
    {
        return $this->request('GET', '/teams');
    }

    /**
     * Get details for a specific team.
     *
     * Uses GET /v1/teams/{id}.
     *
     * @param  int  $teamId  The team ID.
     * @return array<string, mixed> Team details including roles.
     */
    public function getTeam(int $teamId): array
    {
        return $this->request('GET', '/teams/' . $teamId);
    }

    // -------------------------------------------------------------------------
    // Internal request helpers
    // -------------------------------------------------------------------------

    /**
     * Make an authenticated request to the Redis Cloud REST API.
     *
     * Uses HTTP Basic Auth with the API key as username and secret key as password.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path (e.g. /subscriptions).
     * @param  array<string, mixed>  $query   Query parameters for GET requests.
     * @param  array<string, mixed>|null  $body   JSON body for POST/PUT requests.
     * @return array<string, mixed> Parsed JSON response.
     *
     * @throws \RuntimeException On missing config, connection failure, or API error.
     */
    private function request(
        string $method,
        string $path,
        array $query = [],
        ?array $body = null,
    ): array {
        if (!$this->isConfigured()) {
            throw new \RuntimeException('Redis Cloud API credentials are not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withBasicAuth($this->apiKey, $this->secretKey)
                ->withHeaders([
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ])
                ->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $query),
                'POST' => $http->post($url, $body ?? []),
                'PUT' => $http->put($url, $body ?? []),
                'DELETE' => $http->delete($url, $body ?? []),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('description')
                    ?? $response->json('error')
                    ?? $response->body();

                Log::error("Redis Cloud API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException(
                    'Redis Cloud API error (' . $response->status() . '): '
                    . (is_string($error) ? $error : json_encode($error)),
                );
            }

            $json = $response->json();

            return is_array($json) ? $json : [];
        } catch (ConnectionException $e) {
            Log::error("Redis Cloud API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Redis Cloud API: {$e->getMessage()}");
        }
    }
}
