<?php

namespace OpenCompany\Integrations\Resend;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Resend REST API.
 *
 * Executes official OpenAPI operation metadata, sends bearer-token
 * authentication, and normalizes Resend error responses for generated tools.
 */
class ResendService
{
    /**
     * @param  string  $apiKey  Resend API key.
     * @param  string  $baseUrl  Resend API base URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.resend.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the API key is configured.
     */
    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * Return official Resend operation metadata used by generated tools.
     *
     * @return array<string, array<string, mixed>>
     */
    public static function operations(): array
    {
        return ResendOperations::all();
    }

    /**
     * Execute an official Resend OpenAPI operation.
     *
     * @param  array<string, mixed>  $operation  Operation metadata from ResendOperations.
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
            if ($value === null) {
                if (!empty($parameter['required'])) throw new \RuntimeException("The {$argumentName} parameter is required.");
                continue;
            }
            $consumed[] = $apiName; $consumed[] = $argumentName; $consumed[] = $this->snakeName($apiName); $consumed[] = strtolower($apiName);
            foreach ($aliases as $alias) $consumed[] = (string) $alias;
            if ($parameter['in'] === 'path') $path = str_replace('{' . $apiName . '}', rawurlencode((string) $value), $path);
            elseif ($parameter['in'] === 'query') $query[$apiName] = $value;
            elseif ($parameter['in'] === 'header') $headers[$apiName] = $value;
        }
        $requestBody = $operation['request_body'] ?? null;
        $body = null;
        if ($requestBody !== null) {
            $body = $args['body'] ?? $this->bodyFromLooseArguments($args, $consumed);
            if (!empty($requestBody['required']) && ($body === null || $body === [] || $body === '')) throw new \RuntimeException('body is required.');
        }
        return $this->request((string) $operation['method'], $this->baseUrl . $path, $query, $headers, $body);
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
        if (!isset($operations[$slug])) throw new \RuntimeException("Unknown Resend operation: {$slug}");
        return $this->executeOperation($operations[$slug], $args);
    }

    /** @param  array<string, mixed>  $args  Email payload. @return array<string, mixed> */
    public function sendEmail(array $args): array { return $this->executeSlug('resend_send_email', $args); }
    /** @param  array<string, mixed>  $params  Query parameters. @return array<string, mixed> */
    public function listEmails(array $params = []): array { return $this->executeSlug('resend_list_emails', $params); }
    /** @return array<string, mixed> */
    public function getEmail(string $emailId): array { return $this->executeSlug('resend_get_email', ['id' => $emailId]); }
    /** @param  array<string, mixed>  $args  API key payload. @return array<string, mixed> */
    public function createApiKey(array $args): array { return $this->executeSlug('resend_create_api_key', $args); }
    /** @return array<string, mixed> */
    public function listApiKeys(): array { return $this->executeSlug('resend_list_api_keys'); }
    /** @param  array<string, mixed>  $args  Domain payload. @return array<string, mixed> */
    public function createDomain(array $args): array { return $this->executeSlug('resend_create_domain', $args); }
    /** @return array<string, mixed> */
    public function getDomain(string $domainId): array { return $this->executeSlug('resend_get_domain', ['id' => $domainId]); }
    /** @return array<string, mixed> */
    public function listDomains(): array { return $this->executeSlug('resend_list_domains'); }
    /** @return array<string, mixed> */
    public function verifyDomain(string $domainId): array { return $this->executeSlug('resend_verify_domain', ['id' => $domainId]); }
    /** @param  array<string, mixed>  $args  Contact payload. @return array<string, mixed> */
    public function createContact(array $args): array { return $this->executeSlug('resend_create_contact', $args); }

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
        if ($response->status() === 204 || $response->body() === '') return [];
        $contentType = (string) $response->header('Content-Type');
        if (!str_contains($contentType, 'json')) return ['body' => $response->body(), 'content_type' => $contentType];
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Resend API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $url  Fully qualified request URL.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $headers  Additional headers.
     * @param  mixed  $body  Request body.
     */
    private function rawRequest(string $method, string $url, array $query = [], array $headers = [], mixed $body = null): Response
    {
        if (!$this->isConfigured()) throw new \RuntimeException('Resend API key is not configured.');
        try {
            $http = Http::withHeaders(array_merge(['Authorization' => 'Bearer ' . $this->apiKey, 'Accept' => 'application/json', 'Content-Type' => 'application/json'], $headers))->timeout(120);
            $response = $this->sendRequest($http, $method, $url, $query, $body);
            if (!$response->successful()) {
                $error = $response->json('message') ?? $response->json('name') ?? $response->body();
                Log::error("Resend API error: {$method} {$url}", ['status' => $response->status(), 'error' => $error]);
                throw new \RuntimeException('Resend API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)));
            }
            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Resend API connection error: {$method} {$url}", ['error' => $e->getMessage()]);
            throw new \RuntimeException("Failed to connect to Resend API: {$e->getMessage()}");
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
        if ($query !== []) $url .= (str_contains($url, '?') ? '&' : '?') . http_build_query($query);
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
     * Resolve an argument by generated, API, snake_case, lower-case, or alias name.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @param  array<int, string>  $aliases  Additional accepted argument names.
     */
    private function argument(array $args, string $argumentName, string $apiName, array $aliases = []): mixed
    {
        foreach (array_merge([$argumentName, $apiName, $this->snakeName($apiName), strtolower($apiName)], $aliases) as $key) if (array_key_exists($key, $args)) return $args[$key];
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
        foreach ($args as $key => $value) if (!isset($consumed[$key])) $body[$key] = $value;
        return $body;
    }
}
