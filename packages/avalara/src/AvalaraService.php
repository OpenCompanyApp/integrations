<?php

namespace OpenCompany\Integrations\Avalara;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the official Avalara AvaTax REST API.
 *
 * Handles Bearer or AccountId/LicenseKey authentication, request mapping, and response parsing for generated tools.
 */
class AvalaraService
{
    /**
     * @param  string  $accessToken  Avalara OAuth bearer token.
     * @param  string  $accountId  Avalara account ID for license-key Basic authentication.
     * @param  string  $licenseKey  Avalara license key for Basic authentication.
     * @param  string  $companyId  Optional default company ID for company-scoped operations.
     * @param  string  $baseUrl  AvaTax host root such as https://rest.avatax.com or https://sandbox-rest.avatax.com.
     * @param  string  $clientHeader  X-Avalara-Client header value identifying this integration.
     */
    public function __construct(
        private string $accessToken = '',
        private string $accountId = '',
        private string $licenseKey = '',
        private string $companyId = '',
        private string $baseUrl = 'https://rest.avatax.com',
        private string $clientHeader = 'OpenCompany Integrations; 1.0; PHP; AvaTax',
    ) {
        $this->baseUrl = $this->normalizeBaseUrl($baseUrl);
    }

    public function isConfigured(): bool
    {
        return $this->accessToken !== '' || ($this->accountId !== '' && $this->licenseKey !== '');
    }

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * Return all official AvaTax operations exposed by this integration.
     *
     * @return list<array<string, mixed>>
     */
    public static function operations(): array
    {
        return AvalaraOperations::all();
    }

    /**
     * Return one operation definition by slug.
     *
     * @return array<string, mixed>
     */
    public function operation(string $operation): array
    {
        foreach (self::operations() as $definition) {
            if ($definition['slug'] === $operation) {
                return $definition;
            }
        }

        throw new \RuntimeException("Unsupported Avalara operation: {$operation}");
    }

    /**
     * Execute an official AvaTax operation using normalized tool arguments.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    public function call(string $operation, array $args = []): array
    {
        $definition = $this->operation($operation);
        [$path, $pathArgs] = $this->preparePath($definition, $args);
        $query = $this->prepareQuery($definition, $args);
        $body = $this->prepareBody($definition, $args);

        foreach ($pathArgs as $param) {
            unset($query[$param]);
        }

        return $this->request((string) $definition['method'], $path, $query, $body);
    }

    /**
     * Convenience wrapper for Avalara's connectivity endpoint.
     *
     * @return array<string, mixed>
     */
    public function ping(): array
    {
        return $this->request('GET', '/api/v2/utilities/ping');
    }

    /**
     * Build an API path and replace path variables.
     *
     * @param  array<string, mixed>  $definition  Operation metadata.
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array{0: string, 1: list<string>}
     */
    private function preparePath(array $definition, array $args): array
    {
        $path = (string) $definition['path'];
        $pathArgs = [];

        foreach ($definition['parameters'] as $parameter) {
            if (($parameter['in'] ?? null) !== 'path') {
                continue;
            }

            $original = (string) $parameter['name'];
            $param = (string) $parameter['param'];
            $value = $args[$param] ?? null;

            if ($value === null && in_array(strtolower($original), ['companyid'], true) && $this->companyId !== '') {
                $value = $this->companyId;
            }

            if ($value === null || $value === '') {
                throw new \RuntimeException("{$param} is required for {$definition['slug']}.");
            }

            $path = str_replace('{'.$original.'}', rawurlencode((string) $value), $path);
            $pathArgs[] = $param;
        }

        return [$path, $pathArgs];
    }

    /**
     * Build query parameters from normalized and passthrough arguments.
     *
     * @param  array<string, mixed>  $definition  Operation metadata.
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    private function prepareQuery(array $definition, array $args): array
    {
        $query = [];

        foreach ($definition['parameters'] as $parameter) {
            if (($parameter['in'] ?? null) !== 'query') {
                continue;
            }

            $param = (string) $parameter['param'];
            if (array_key_exists($param, $args)) {
                $query[(string) $parameter['name']] = $args[$param];
            }
        }

        if (isset($args['query']) && is_array($args['query'])) {
            foreach ($args['query'] as $key => $value) {
                $query[(string) $key] = $value;
            }
        }

        return $query;
    }

    /**
     * Build the JSON body for write operations.
     *
     * @param  array<string, mixed>  $definition  Operation metadata.
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>|list<mixed>|null
     */
    private function prepareBody(array $definition, array $args): array|null
    {
        if (array_key_exists('body', $args) && is_array($args['body'])) {
            return $args['body'];
        }

        $bodyParameters = array_values(array_filter($definition['parameters'], static fn (array $parameter): bool => ($parameter['in'] ?? null) === 'body'));
        if ($bodyParameters === []) {
            return null;
        }

        if (count($bodyParameters) === 1) {
            $param = (string) $bodyParameters[0]['param'];
            if (array_key_exists($param, $args) && is_array($args[$param])) {
                return $args[$param];
            }
        }

        $body = [];
        foreach ($bodyParameters as $parameter) {
            $param = (string) $parameter['param'];
            if (array_key_exists($param, $args)) {
                $body[(string) $parameter['name']] = $args[$param];
            }
        }

        return $body === [] ? null : $body;
    }

    /**
     * Send an HTTP request to Avalara and parse the response body.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>|list<mixed>|null  $body  JSON body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $query = [], array|null $body = null): array
    {
        $response = $this->rawRequest($method, $path, $query, $body);

        if ($response->status() === 204) {
            return [];
        }

        if (strtoupper($method) === 'HEAD') {
            return ['status' => $response->status(), 'headers' => $response->headers()];
        }

        $json = $response->json();

        return is_array($json) ? $json : [];
    }

    /**
     * Send an HTTP request to Avalara and raise runtime exceptions on API failures.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>|list<mixed>|null  $body  JSON body.
     */
    private function rawRequest(string $method, string $path, array $query = [], array|null $body = null): Response
    {
        $url = $this->baseUrl.$path;

        try {
            $http = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'X-Avalara-Client' => $this->clientHeader,
            ])->timeout(30);

            if ($this->accessToken !== '') {
                $http = $http->withToken($this->accessToken);
            } elseif ($this->accountId !== '' && $this->licenseKey !== '') {
                $http = $http->withBasicAuth($this->accountId, $this->licenseKey);
            }

            $options = [];
            if ($query !== []) {
                $options['query'] = $query;
            }
            if ($body !== null) {
                $options['json'] = $body;
            }

            $response = $http->send(strtoupper($method), $url, $options);

            if (!$response->successful()) {
                $error = $response->json('message')
                    ?? $response->json('error')
                    ?? $response->json('title')
                    ?? $response->json('detail')
                    ?? $response->body();

                Log::error("Avalara API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Avalara API error ({$response->status()}): ".(is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Avalara API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new \RuntimeException("Failed to connect to Avalara API: {$e->getMessage()}");
        }
    }

    private function normalizeBaseUrl(string $baseUrl): string
    {
        $baseUrl = rtrim($baseUrl !== '' ? $baseUrl : 'https://rest.avatax.com', '/');

        foreach (['/api/v2', '/v2', '/api'] as $suffix) {
            if (str_ends_with($baseUrl, $suffix)) {
                return substr($baseUrl, 0, -strlen($suffix));
            }
        }

        return $baseUrl;
    }
}