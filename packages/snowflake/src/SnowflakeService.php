<?php

namespace OpenCompany\Integrations\Snowflake;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SnowflakeService
{
    public function __construct(
        private string $accessToken = '',
        private string $account = '',
    ) {}

    /**
     * Check whether the service is properly configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken) && !empty($this->account);
    }

    /**
     * Get the configured Snowflake account identifier.
     */
    public function getAccount(): string
    {
        return $this->account;
    }

    /**
     * Build the base URL for the Snowflake REST API.
     */
    public function getBaseUrl(): string
    {
        return 'https://' . $this->account . '.snowflakecomputing.com/api/v2';
    }

    /**
     * Execute a SQL statement.
     *
     * @param  string  $sql  The SQL statement to execute.
     * @param  string|null  $warehouse  Optional warehouse context.
     * @param  string|null  $database  Optional database context.
     * @param  string|null  $schema  Optional schema context.
     * @return array<string, mixed> The parsed JSON response.
     */
    public function executeQuery(string $sql, ?string $warehouse = null, ?string $database = null, ?string $schema = null): array
    {
        $body = ['statement' => $sql];

        if ($warehouse !== null) {
            $body['warehouse'] = $warehouse;
        }
        if ($database !== null) {
            $body['database'] = $database;
        }
        if ($schema !== null) {
            $body['schema'] = $schema;
        }

        return $this->request('POST', '/statements', $body);
    }

    /**
     * List all databases in the Snowflake account.
     *
     * @return array<string, mixed>
     */
    public function listDatabases(): array
    {
        return $this->request('GET', '/databases');
    }

    /**
     * Get details for a specific database.
     *
     * @param  string  $id  The database name or ID.
     * @return array<string, mixed>
     */
    public function getDatabase(string $id): array
    {
        return $this->request('GET', '/databases/' . urlencode($id));
    }

    /**
     * List schemas in a database.
     *
     * @param  string  $database  The database name.
     * @return array<string, mixed>
     */
    public function listSchemas(string $database): array
    {
        return $this->request('GET', '/databases/' . urlencode($database) . '/schemas');
    }

    /**
     * List tables in a schema.
     *
     * @param  string  $database  The database name.
     * @param  string  $schema  The schema name.
     * @return array<string, mixed>
     */
    public function listTables(string $database, string $schema): array
    {
        return $this->request('GET', '/databases/' . urlencode($database) . '/schemas/' . urlencode($schema) . '/tables');
    }

    /**
     * Describe a table's columns and metadata.
     *
     * @param  string  $database  The database name.
     * @param  string  $schema  The schema name.
     * @param  string  $table  The table name.
     * @return array<string, mixed>
     */
    public function describeTable(string $database, string $schema, string $table): array
    {
        return $this->request('GET', '/databases/' . urlencode($database) . '/schemas/' . urlencode($schema) . '/tables/' . urlencode($table));
    }

    /**
     * List all warehouses in the Snowflake account.
     *
     * @return array<string, mixed>
     */
    public function listWarehouses(): array
    {
        return $this->request('GET', '/warehouses');
    }

    /**
     * Get details for a specific warehouse.
     *
     * @param  string  $name  The warehouse name.
     * @return array<string, mixed>
     */
    public function getWarehouse(string $name): array
    {
        return $this->request('GET', '/warehouses/' . urlencode($name));
    }

    /**
     * Get the current session user information.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/session');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path relative to base URL.
     * @param  array<string, mixed>  $data  Request body or query parameters.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Snowflake REST API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Request data.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException On connection or API errors.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Snowflake access token is not configured.');
        }

        if (!$this->account) {
            throw new \RuntimeException('Snowflake account identifier is not configured.');
        }

        $url = $this->getBaseUrl() . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(60);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Snowflake API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Snowflake API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the account identifier is wrong.");
                }

                $error = $response->json('message') ?? $response->json('error') ?? $body;
                Log::error("Snowflake API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Snowflake API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Snowflake API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Snowflake API: {$e->getMessage()}");
        }
    }
}
