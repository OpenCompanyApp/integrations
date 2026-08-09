<?php

namespace OpenCompany\Integrations\Pagerduty;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the PagerDuty REST API.
 *
 * Executes official OpenAPI operation metadata, handles bearer-token
 * authentication, and normalizes PagerDuty error responses for tools.
 */
class PagerdutyService
{
    /**
     * @param  string  $apiToken  PagerDuty REST API token.
     * @param  string  $baseUrl  PagerDuty API base URL.
     */
    public function __construct(
        private string $apiToken = '',
        private string $baseUrl = 'https://api.pagerduty.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an API token.
     */
    public function isConfigured(): bool
    {
        return $this->apiToken !== '' && $this->baseUrl !== '';
    }

    /**
     * Return official PagerDuty REST operation metadata used by generated tools.
     *
     * @return array<string, array<string, mixed>>
     */
    public static function operations(): array
    {
        return PagerdutyOperations::all();
    }

    /**
     * Execute an official PagerDuty OpenAPI operation.
     *
     * @param  array<string, mixed>  $operation  Operation metadata from PagerdutyOperations.
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

        $path = preg_replace_callback('/\{([^}]+)\}/', function (array $matches) use ($args, &$consumed): string {
            $apiName = (string) $matches[1];
            $argumentName = $this->snakeName($apiName);
            $value = $this->argument($args, $argumentName, $apiName);

            if ($value === null) {
                throw new \RuntimeException("The {$argumentName} parameter is required.");
            }

            $consumed[] = $apiName;
            $consumed[] = $argumentName;
            $consumed[] = strtolower($apiName);

            return rawurlencode((string) $value);
        }, $path) ?? $path;

        if (strtoupper((string) $operation['method']) === 'GET') {
            $consumedLookup = array_flip($consumed);

            foreach ($args as $key => $value) {
                if (!isset($consumedLookup[$key])) {
                    $query[$key] = $value;
                }
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
            $this->baseUrl . $path,
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
            throw new \RuntimeException("Unknown PagerDuty operation: {$slug}");
        }

        return $this->executeOperation($operations[$slug], $args);
    }

    /** @return array<string, mixed> */
    public function listIncidents(?string $status = null, ?string $urgency = null, ?string $serviceId = null, ?string $teamId = null, int $limit = 25, int $offset = 0): array
    {
        return $this->executeSlug('pagerduty_list_incidents', array_filter([
            'statuses' => $status !== null ? [$status] : null,
            'urgencies' => $urgency !== null ? [$urgency] : null,
            'service_ids' => $serviceId !== null ? [$serviceId] : null,
            'team_ids' => $teamId !== null ? [$teamId] : null,
            'limit' => min($limit, 100),
            'offset' => $offset,
        ], static fn ($value) => $value !== null));
    }

    /** @return array<string, mixed> */
    public function getIncident(string $id): array
    {
        return $this->executeSlug('pagerduty_get_incident', ['id' => $id]);
    }

    /** @return array<string, mixed> */
    public function listServices(?string $teamId = null, int $limit = 25, int $offset = 0): array
    {
        return $this->executeSlug('pagerduty_list_services', array_filter([
            'team_ids' => $teamId !== null ? [$teamId] : null,
            'limit' => min($limit, 100),
            'offset' => $offset,
        ], static fn ($value) => $value !== null));
    }

    /** @return array<string, mixed> */
    public function getService(string $id): array
    {
        return $this->executeSlug('pagerduty_get_service', ['id' => $id]);
    }

    /** @return array<string, mixed> */
    public function listTeams(int $limit = 25, int $offset = 0): array
    {
        return $this->executeSlug('pagerduty_list_teams', ['limit' => min($limit, 100), 'offset' => $offset]);
    }

    /** @return array<string, mixed> */
    public function getTeam(string $id): array
    {
        return $this->executeSlug('pagerduty_get_team', ['id' => $id]);
    }

    /** @return array<string, mixed> */
    public function getCurrentUser(): array
    {
        return $this->executeSlug('pagerduty_get_current_user');
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
     * Make a raw HTTP request to the PagerDuty API.
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
            throw new \RuntimeException('PagerDuty API token is not configured.');
        }

        try {
            $http = Http::withToken($this->apiToken)
                ->withHeaders(array_merge([
                    'Accept' => 'application/vnd.pagerduty+json;version=2',
                    'Content-Type' => 'application/json',
                ], $headers))
                ->timeout(120);

            $response = $this->sendRequest($http, $method, $url, $query, $body);

            if (!$response->successful()) {
                $contentType = (string) $response->header('Content-Type');
                $rawBody = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($rawBody), '<!DOCTYPE')) {
                    Log::warning("PagerDuty API returned HTML for {$method} {$url}", ['status' => $response->status()]);
                    throw new \RuntimeException("PagerDuty API endpoint not available (HTTP {$response->status()}).");
                }

                $error = $response->json('error.message') ?? $response->json('message') ?? $response->json('error') ?? $rawBody;
                Log::error("PagerDuty API error: {$method} {$url}", ['status' => $response->status(), 'error' => $error]);
                throw new \RuntimeException('PagerDuty API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("PagerDuty API connection error: {$method} {$url}", ['error' => $e->getMessage()]);
            throw new \RuntimeException("Failed to connect to PagerDuty API: {$e->getMessage()}");
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
     * Build query strings with repeated array keys that match PagerDuty docs.
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
}
