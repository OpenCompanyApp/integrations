<?php

namespace OpenCompany\Integrations\Pipedrive;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Pipedrive API.
 *
 * Executes official v1 and v2 OpenAPI operation metadata, authenticates with
 * the Pipedrive API token header, and normalizes API errors for tools.
 */
class PipedriveService
{
    /**
     * @param  string  $apiToken  Pipedrive API token.
     * @param  string  $baseUrl  Pipedrive API root or versioned base URL.
     */
    public function __construct(
        private string $apiToken = '',
        private string $baseUrl = 'https://api.pipedrive.com',
    ) {
        $this->baseUrl = $this->normalizeBaseUrl($this->baseUrl);
    }

    /**
     * Check whether the service is configured with an API token.
     */
    public function isConfigured(): bool
    {
        return $this->apiToken !== '' && $this->baseUrl !== '';
    }

    /**
     * Return official Pipedrive operation metadata used by generated tools.
     *
     * @return array<string, array<string, mixed>>
     */
    public static function operations(): array
    {
        return PipedriveOperations::all();
    }

    /**
     * Execute an official Pipedrive OpenAPI operation.
     *
     * @param  array<string, mixed>  $operation  Operation metadata from PipedriveOperations.
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    public function executeOperation(array $operation, array $args = []): array
    {
        $path = (string) $operation['path'];
        $query = [];
        $headers = [];
        $consumed = [];

        foreach ($operation['parameters'] ?? [] as $parameter) {
            $apiName = (string) $parameter['name'];
            $argumentName = (string) ($parameter['argument_name'] ?? $this->snakeName($apiName));
            $value = $this->argument($args, $argumentName, $apiName);

            if ($value === null) {
                if (!empty($parameter['required'])) {
                    throw new \RuntimeException("The {$argumentName} parameter is required.");
                }

                continue;
            }

            $consumed[] = $apiName;
            $consumed[] = $argumentName;
            $consumed[] = $this->snakeName($apiName);
            $consumed[] = strtolower($apiName);

            if ($parameter['in'] === 'path') {
                $path = str_replace('{' . $apiName . '}', rawurlencode((string) $value), $path);
            } elseif ($parameter['in'] === 'query') {
                $query[$apiName] = $value;
            } elseif ($parameter['in'] === 'header') {
                $headers[$apiName] = $value;
            }
        }

        $requestBody = $operation['request_body'] ?? null;
        $body = null;

        if ($requestBody !== null) {
            $body = $args['body'] ?? $this->bodyFromLooseArguments($args, $consumed);

            if (!empty($requestBody['required']) && ($body === null || $body === [] || $body === '')) {
                throw new \RuntimeException('body is required.');
            }
        }

        return $this->request(
            (string) $operation['method'],
            $this->baseUrl . (string) $operation['base_path'] . $path,
            $query,
            $headers,
            $body,
        );
    }

    /**
     * Execute an operation by generated slug.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    private function executeSlug(string $slug, array $args = []): array
    {
        $operations = self::operations();

        if (!isset($operations[$slug])) {
            throw new \RuntimeException("Unknown Pipedrive operation: {$slug}");
        }

        return $this->executeOperation($operations[$slug], $args);
    }

    /** @return array<string, mixed> */
    public function listDeals(?int $userId = null, ?int $personId = null, ?int $orgId = null, ?string $status = null, int $limit = 25, int $start = 0): array
    {
        return $this->executeSlug('pipedrive_list_deals', array_filter([
            'owner_id' => $userId,
            'person_id' => $personId,
            'org_id' => $orgId,
            'status' => $status,
            'limit' => min($limit, 500),
        ], static fn ($value) => $value !== null));
    }

    /** @return array<string, mixed> */
    public function getDeal(int $id): array
    {
        return $this->executeSlug('pipedrive_get_deal', ['id' => $id]);
    }

    /** @param  array<string, mixed>  $extra  Additional deal fields. @return array<string, mixed> */
    public function createDeal(string $title, array $extra = []): array
    {
        return $this->executeSlug('pipedrive_create_deal', ['body' => array_merge(['title' => $title], $extra)]);
    }

    /** @return array<string, mixed> */
    public function listPersons(int $limit = 25, int $start = 0): array
    {
        return $this->executeSlug('pipedrive_list_persons', ['limit' => min($limit, 500), 'start' => $start]);
    }

    /** @return array<string, mixed> */
    public function getPerson(int $id): array
    {
        return $this->executeSlug('pipedrive_get_person', ['id' => $id]);
    }

    /** @return array<string, mixed> */
    public function listOrganizations(int $limit = 25, int $start = 0): array
    {
        return $this->executeSlug('pipedrive_list_organizations', ['limit' => min($limit, 500), 'start' => $start]);
    }

    /** @return array<string, mixed> */
    public function getOrganization(int $id): array
    {
        return $this->executeSlug('pipedrive_get_organization', ['id' => $id]);
    }

    /** @return array<string, mixed> */
    public function getCurrentUser(): array
    {
        return $this->executeSlug('pipedrive_get_current_user');
    }

    /**
     * Make an API request and return parsed output.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $url  Fully qualified request URL.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $headers  Additional headers.
     * @param  mixed  $body  Request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $url, array $query = [], array $headers = [], mixed $body = null): array
    {
        $response = $this->rawRequest($method, $url, $query, $headers, $body);

        if ($response->status() === 204 || $response->body() === '') {
            return [];
        }

        $contentType = (string) $response->header('Content-Type');

        if (!str_contains($contentType, 'json')) {
            return ['body' => $response->body(), 'content_type' => $contentType];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Pipedrive API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $url  Fully qualified request URL.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $headers  Additional headers.
     * @param  mixed  $body  Request body.
     */
    private function rawRequest(string $method, string $url, array $query = [], array $headers = [], mixed $body = null): Response
    {
        if ($this->apiToken === '') {
            throw new \RuntimeException('Pipedrive API token is not configured.');
        }

        try {
            $http = Http::withHeaders(array_merge([
                'x-api-token' => $this->apiToken,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ], $headers))->timeout(120);

            $response = $this->sendRequest($http, $method, $url, $query, $body);

            if (!$response->successful()) {
                $contentType = (string) $response->header('Content-Type');
                $rawBody = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($rawBody), '<!DOCTYPE')) {
                    Log::warning("Pipedrive API returned HTML for {$method} {$url}", ['status' => $response->status()]);
                    throw new \RuntimeException("Pipedrive API endpoint not available (HTTP {$response->status()}).");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $rawBody;
                Log::error("Pipedrive API error: {$method} {$url}", ['status' => $response->status(), 'error' => $error]);
                throw new \RuntimeException('Pipedrive API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Pipedrive API connection error: {$method} {$url}", ['error' => $e->getMessage()]);
            throw new \RuntimeException("Failed to connect to Pipedrive API: {$e->getMessage()}");
        }
    }

    /**
     * Dispatch the request with the appropriate HTTP verb.
     *
     * @param  PendingRequest  $http  Pending HTTP request.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  mixed  $body  Request body.
     */
    private function sendRequest(PendingRequest $http, string $method, string $url, array $query, mixed $body): Response
    {
        $method = strtoupper($method);

        if ($query !== []) {
            $url .= (str_contains($url, '?') ? '&' : '?') . $this->buildQuery($query);
        }

        return match ($method) {
            'GET' => $http->get($url),
            'POST' => $http->post($url, $body ?? []),
            'PUT' => $http->put($url, $body ?? []),
            'PATCH' => $http->patch($url, $body ?? []),
            'DELETE' => $http->delete($url, is_array($body) ? $body : []),
            default => $http->send($method, $url, ['json' => $body ?? []]),
        };
    }

    /**
     * Build query strings with repeated keys for array values.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     */
    private function buildQuery(array $query): string
    {
        $pairs = [];

        foreach ($query as $key => $value) {
            if ($value === null) {
                continue;
            }

            if (is_array($value)) {
                foreach ($value as $item) {
                    $name = str_ends_with((string) $key, '[]') ? (string) $key : ((string) $key . '[]');
                    $pairs[] = rawurlencode($name) . '=' . rawurlencode($this->scalarQueryValue($item));
                }

                continue;
            }

            $pairs[] = rawurlencode((string) $key) . '=' . rawurlencode($this->scalarQueryValue($value));
        }

        return implode('&', $pairs);
    }

    private function scalarQueryValue(mixed $value): string
    {
        if (is_bool($value)) {
            return $value ? 'true' : 'false';
        }

        if (is_scalar($value) || $value === null) {
            return (string) $value;
        }

        return json_encode($value) ?: '';
    }

    /**
     * Resolve an argument by generated, API, snake_case, or lower-case name.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    private function argument(array $args, string $argumentName, string $apiName): mixed
    {
        foreach ([$argumentName, $apiName, $this->snakeName($apiName), strtolower($apiName)] as $key) {
            if (array_key_exists($key, $args)) {
                return $args[$key];
            }
        }

        return null;
    }

    private function snakeName(string $name): string
    {
        $name = str_replace('[]', '', $name);
        $name = (string) preg_replace('/(?<!^)[A-Z]/', '_$0', $name);
        $name = (string) preg_replace('/[^A-Za-z0-9]+/', '_', $name);
        $name = (string) preg_replace('/_+/', '_', $name);

        return strtolower(trim($name, '_')) ?: 'value';
    }

    /**
     * Build a request body from arguments that are not path/query/header params.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @param  array<int, string>  $consumed  Already consumed parameter names.
     * @return array<string, mixed>
     */
    private function bodyFromLooseArguments(array $args, array $consumed): array
    {
        $body = [];
        $consumed = array_flip($consumed);

        foreach ($args as $key => $value) {
            if (!isset($consumed[$key])) {
                $body[$key] = $value;
            }
        }

        return $body;
    }

    private function normalizeBaseUrl(string $baseUrl): string
    {
        $baseUrl = rtrim($baseUrl, '/');

        foreach (['/api/v2', '/v1'] as $suffix) {
            if (str_ends_with($baseUrl, $suffix)) {
                return substr($baseUrl, 0, -strlen($suffix));
            }
        }

        return $baseUrl;
    }
}
