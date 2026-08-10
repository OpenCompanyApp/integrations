<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the PostHog REST and ingestion APIs.
 *
 * Executes generated operations from the official PostHog OpenAPI schema,
 * applies bearer-token authentication, and centralizes request/error handling.
 */
class PostHogService
{
    /**
     * @param  string  $apiToken  PostHog personal API token for private API endpoints.
     * @param  string  $baseUrl  PostHog host URL, such as https://us.posthog.com.
     * @param  string  $projectId  Optional default project ID for project-scoped operations.
     * @param  string  $environmentId  Optional default environment ID for environment-scoped operations.
     * @param  string  $projectApiKey  Optional project API key for event ingestion.
     */
    public function __construct(private string $apiToken = '', private string $baseUrl = 'https://us.posthog.com', private string $projectId = '', private string $environmentId = '', private string $projectApiKey = '')
    {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool { return $this->apiToken !== ''; }
    public function canCapture(): bool { return $this->projectApiKey !== '' || $this->apiToken !== ''; }

    /** @return array<string, array<string, mixed>> */
    public static function operations(): array { return PostHogOperations::all(); }

    /**
     * Execute an official PostHog OpenAPI operation.
     *
     * @param  array<string, mixed>  $operation  Operation metadata from PostHogOperations.
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
            $aliases = is_array($parameter['aliases'] ?? null) ? $parameter['aliases'] : [];
            $value = $this->argument($args, $argumentName, $apiName, $aliases);
            if ($value === null && $parameter['in'] === 'path') $value = $this->defaultPathParameter($argumentName);
            if ($value === null) {
                if (!empty($parameter['required'])) throw new \RuntimeException('The ' . $this->friendlyArgumentName($argumentName) . ' parameter is required.');
                continue;
            }
            $consumed[] = $apiName; $consumed[] = $argumentName; $consumed[] = $this->snakeName($apiName); $consumed[] = strtolower($apiName);
            foreach ($aliases as $alias) $consumed[] = (string) $alias;
            if ($parameter['in'] === 'path') $path = str_replace('{' . $apiName . '}', rawurlencode((string) $value), $path);
            elseif ($parameter['in'] === 'query') $query[$apiName] = $value;
            elseif ($parameter['in'] === 'header') $headers[$apiName] = $value;
        }
        if (preg_match('/\{([^}]+)\}/', $path, $missing)) throw new \RuntimeException('The ' . $this->snakeName($missing[1]) . ' parameter is required.');
        $requestBody = $operation['request_body'] ?? null;
        $body = null;
        if ($requestBody !== null) {
            $body = $args['body'] ?? $this->bodyFromLooseArguments($args, $consumed);
            if (!empty($requestBody['required']) && ($body === null || $body === [] || $body === '')) throw new \RuntimeException('body is required.');
            if (($requestBody['content_type'] ?? '') !== 'application/json') $headers['Content-Type'] = (string) $requestBody['content_type'];
        }
        return $this->request((string) $operation['method'], $this->baseUrl . $path, $query, $headers, $body);
    }

    /**
     * Capture one analytics event through PostHog's ingestion API.
     *
     * @param  array<string, mixed>  $args  Event payload with event, distinct_id, properties, and optional timestamp.
     * @return array<string, mixed>
     */
    public function captureEvent(array $args): array
    {
        $token = (string) ($args['api_key'] ?? $args['token'] ?? ($this->projectApiKey !== '' ? $this->projectApiKey : $this->apiToken));
        if ($token === '') throw new \RuntimeException('PostHog project API key is not configured.');
        foreach (['event', 'distinct_id'] as $required) if (($args[$required] ?? '') === '') throw new \RuntimeException("The {$required} parameter is required.");
        $payload = ['api_key' => $token, 'event' => $args['event'], 'distinct_id' => $args['distinct_id'], 'properties' => $args['properties'] ?? []];
        foreach (['timestamp', 'uuid', 'send_feature_flags'] as $optional) if (array_key_exists($optional, $args)) $payload[$optional] = $args[$optional];
        return $this->request('POST', $this->baseUrl . '/capture/', [], [], $payload, false);
    }

    /** @param  array<string, mixed>  $args  Tool arguments. @return array<string, mixed> */
    private function executeSlug(string $slug, array $args = []): array { $operations = self::operations(); if (!isset($operations[$slug])) throw new \RuntimeException("Unknown PostHog operation: {$slug}"); return $this->executeOperation($operations[$slug], $args); }
    /** @param  array<string, mixed>  $params  Query parameters. @return array<string, mixed> */
    public function listEvents(array $params = []): array { return $this->executeSlug('posthog_environmentseventslist', $params); }
    /** @return array<string, mixed> */
    public function getEvent(string $eventId, array $params = []): array { return $this->executeSlug('posthog_environmentseventsretrieve', array_merge($params, ['id' => $eventId])); }
    /** @param  array<string, mixed>  $params  Query parameters. @return array<string, mixed> */
    public function listPersons(array $params = []): array { return $this->executeSlug('posthog_environmentspersonslist', $params); }
    /** @return array<string, mixed> */
    public function getPerson(string $personId, array $params = []): array { return $this->executeSlug('posthog_environmentspersonsretrieve', array_merge($params, ['id' => $personId])); }
    /** @param  array<string, mixed>  $params  Query parameters. @return array<string, mixed> */
    public function listFeatureFlags(array $params = []): array { return $this->executeSlug('posthog_featureflagslist', $params); }
    /** @return array<string, mixed> */
    public function getFeatureFlag(int|string $flagId, array $params = []): array { return $this->executeSlug('posthog_featureflagsretrieve', array_merge($params, ['id' => $flagId])); }
    /** @param  array<string, mixed>  $args  Feature flag payload. @return array<string, mixed> */
    public function createFeatureFlag(array $args): array { return $this->executeSlug('posthog_featureflagscreate', $args); }
    /** @param  array<string, mixed>  $args  Feature flag patch payload. @return array<string, mixed> */
    public function updateFeatureFlag(int|string $flagId, array $args = []): array { return $this->executeSlug('posthog_featureflagsupdate', array_merge($args, ['id' => $flagId])); }
    /** @return array<string, mixed> */
    public function deleteFeatureFlag(int|string $flagId, array $params = []): array { return $this->executeSlug('posthog_featureflagsdestroy', array_merge($params, ['id' => $flagId])); }
    /** @param  array<string, mixed>  $params  Query parameters. @return array<string, mixed> */
    public function listInsights(array $params = []): array { return $this->executeSlug('posthog_environmentsinsightslist', $params); }
    /** @return array<string, mixed> */
    public function getInsight(int|string $insightId, array $params = []): array { return $this->executeSlug('posthog_environmentsinsightsretrieve', array_merge($params, ['id' => $insightId])); }
    /** @param  array<string, mixed>  $params  Query parameters. @return array<string, mixed> */
    public function listDashboards(array $params = []): array { return $this->executeSlug('posthog_environmentsdashboardslist', $params); }
    /** @return array<string, mixed> */
    public function getDashboard(int|string $dashboardId, array $params = []): array { return $this->executeSlug('posthog_environmentsdashboardsretrieve', array_merge($params, ['id' => $dashboardId])); }
    /** @param  array<string, mixed>  $params  Query parameters. @return array<string, mixed> */
    public function listCohorts(array $params = []): array { return $this->executeSlug('posthog_cohortslist', $params); }

    /** @return array{success: bool, message?: string, error?: string} */
    public function testConnection(): array { try { $this->rawRequest('GET', $this->baseUrl . '/api/users/', ['limit' => 1], [], null, true); return ['success' => true, 'message' => 'Connected to PostHog.']; } catch (\Throwable $e) { return ['success' => false, 'error' => $e->getMessage()]; } }

    /**
     * Make an API request and return parsed output.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $headers  Additional headers.
     * @param  mixed  $body  Request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $url, array $query = [], array $headers = [], mixed $body = null, bool $authenticated = true): array
    {
        $response = $this->rawRequest($method, $url, $query, $headers, $body, $authenticated);
        if ($response->status() === 204 || $response->body() === '') return [];
        $contentType = (string) $response->header('Content-Type');
        if ($contentType !== '' && !str_contains($contentType, 'json')) return ['body' => $response->body(), 'content_type' => $contentType];
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to PostHog.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $headers  Additional headers.
     * @param  mixed  $body  Request body.
     */
    private function rawRequest(string $method, string $url, array $query = [], array $headers = [], mixed $body = null, bool $authenticated = true): Response
    {
        if ($authenticated && !$this->isConfigured()) throw new \RuntimeException('PostHog API token is not configured.');
        try {
            $baseHeaders = ['Accept' => 'application/json', 'Content-Type' => 'application/json'];
            if ($authenticated) $baseHeaders['Authorization'] = 'Bearer ' . $this->apiToken;
            $http = Http::withHeaders(array_merge($baseHeaders, $headers))->timeout(120);
            $response = $this->sendRequest($http, $method, $url, $query, $body);
            if (!$response->successful()) {
                $error = $response->json('detail') ?? $response->json('error') ?? $response->json('message') ?? $response->body();
                Log::error("PostHog API error: {$method} {$url}", ['status' => $response->status(), 'error' => $error]);
                throw new \RuntimeException('PostHog API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)));
            }
            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) { Log::error("PostHog API connection error: {$method} {$url}", ['error' => $e->getMessage()]); throw new \RuntimeException("Failed to connect to PostHog API: {$e->getMessage()}"); }
    }

    /** @param  array<string, mixed>  $query  Query parameters. @param  mixed  $body  Request body. */
    private function sendRequest(PendingRequest $http, string $method, string $url, array $query, mixed $body): Response
    {
        $method = strtoupper($method);
        if ($query !== []) $url .= (str_contains($url, '?') ? '&' : '?') . http_build_query($query);
        return match ($method) { 'GET' => $http->get($url), 'POST' => $http->post($url, $body ?? []), 'PUT' => $http->put($url, $body ?? []), 'PATCH' => $http->patch($url, $body ?? []), 'DELETE' => $http->delete($url, is_array($body) ? $body : []), default => $http->send($method, $url, ['json' => $body ?? []]), };
    }

    private function defaultPathParameter(string $argumentName): ?string { return match ($this->friendlyArgumentName($argumentName)) { 'project_id' => $this->projectId !== '' ? $this->projectId : null, 'environment_id' => $this->environmentId !== '' ? $this->environmentId : null, default => null, }; }
    /** @param  array<string, mixed>  $args  Tool arguments. @param  array<int, string>  $aliases  Additional accepted argument names. */
    private function argument(array $args, string $argumentName, string $apiName, array $aliases = []): mixed { foreach (array_merge([$argumentName, $this->friendlyArgumentName($argumentName), $apiName, $this->snakeName($apiName), strtolower($apiName)], $aliases) as $key) if (array_key_exists($key, $args)) return $args[$key]; return null; }
    /** Keep the generated schema wire name while exposing familiar configuration keys in errors and accepted input. */
    private function friendlyArgumentName(string $name): string { return match ($name) { 'projectid' => 'project_id', 'environmentid' => 'environment_id', default => $name, }; }
    private function snakeName(string $name): string { $name = str_replace('[]', '', $name); $name = (string) preg_replace('/(?<!^)[A-Z]/', '_$0', $name); $name = (string) preg_replace('/[^A-Za-z0-9]+/', '_', $name); $name = (string) preg_replace('/_+/', '_', $name); return strtolower(trim($name, '_')) ?: 'value'; }
    /** @param  array<string, mixed>  $args  Tool arguments. @param  array<int, string>  $consumed  Already consumed parameter names. @return array<string, mixed> */
    private function bodyFromLooseArguments(array $args, array $consumed): array { $body = []; $consumed = array_flip($consumed); foreach ($args as $key => $value) if (!isset($consumed[$key])) $body[$key] = $value; return $body; }
}
