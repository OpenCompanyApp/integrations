<?php

namespace OpenCompany\Integrations\Adyen;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for official Adyen Checkout and Management OpenAPI operations.
 *
 * Handles API-key authentication, versioned base URLs, default merchant/company
 * identifiers, and response parsing for generated operation tools.
 */
class AdyenService
{
    private const DEFAULT_CHECKOUT_URL = 'https://checkout-test.adyen.com';

    private const DEFAULT_MANAGEMENT_URL = 'https://management-test.adyen.com';

    /**
     * @param  string  $apiKey  Adyen API key sent in the X-API-Key header.
     * @param  string  $merchantAccount  Optional default merchant account or merchant ID.
     * @param  string  $baseUrl  Checkout API base URL without the version suffix.
     * @param  string  $managementUrl  Management API base URL without the version suffix.
     * @param  string  $companyId  Optional default Adyen company ID for company-scoped Management API paths.
     */
    public function __construct(
        private string $apiKey = '',
        private string $merchantAccount = '',
        private string $baseUrl = self::DEFAULT_CHECKOUT_URL,
        private string $managementUrl = self::DEFAULT_MANAGEMENT_URL,
        private string $companyId = '',
    ) {
        $this->baseUrl = rtrim($this->baseUrl !== '' ? $this->baseUrl : self::DEFAULT_CHECKOUT_URL, '/');
        $this->managementUrl = rtrim($this->managementUrl !== '' ? $this->managementUrl : self::DEFAULT_MANAGEMENT_URL, '/');
    }

    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    public function getMerchantAccount(): string
    {
        return $this->merchantAccount;
    }

    public function getCompanyId(): string
    {
        return $this->companyId;
    }

    /**
     * Return all official Adyen operations exposed by this integration.
     *
     * @return list<array<string, mixed>>
     */
    public static function operations(): array
    {
        return AdyenOperations::all();
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

        throw new \RuntimeException("Unsupported Adyen operation: {$operation}");
    }

    /**
     * Execute an official Adyen OpenAPI operation using normalized tool arguments.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    public function call(string $operation, array $args = []): array
    {
        $definition = $this->operation($operation);
        [$path, $pathArgs] = $this->preparePath($definition, $args);
        $query = $this->prepareQuery($definition, $args);
        foreach ($pathArgs as $param) {
            unset($query[$param]);
        }
        $body = $this->prepareBody($definition, $args);

        return $this->request($definition, $path, $query, $body);
    }

    /**
     * Build request path and replace path variables.
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
            $value = $args[$param] ?? $this->defaultParameterValue($original);

            if ($value === null || $value === '') {
                throw new \RuntimeException("{$param} is required for {$definition['slug']}.");
            }

            $path = str_replace('{'.$original.'}', rawurlencode((string) $value), $path);
            $pathArgs[] = $param;
        }

        return [$path, $pathArgs];
    }

    /**
     * Build query parameters.
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

            $original = (string) $parameter['name'];
            $param = (string) $parameter['param'];
            $value = array_key_exists($param, $args) ? $args[$param] : $this->defaultParameterValue($original);
            if ($value !== null && $value !== '') {
                $query[$original] = $value;
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
     * Build JSON body for write operations.
     *
     * @param  array<string, mixed>  $definition  Operation metadata.
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>|list<mixed>|null
     */
    private function prepareBody(array $definition, array $args): array|null
    {
        $bodyParameter = null;
        foreach ($definition['parameters'] as $parameter) {
            if (($parameter['in'] ?? null) === 'body') {
                $bodyParameter = $parameter;
                break;
            }
        }

        if ($bodyParameter === null) {
            return null;
        }

        if (! array_key_exists('body', $args)) {
            if (! ($bodyParameter['required'] ?? false)) {
                return null;
            }

            throw new \RuntimeException("body is required for {$definition['slug']}.");
        }

        if (! is_array($args['body'])) {
            throw new \RuntimeException('body must be an object or array.');
        }

        $body = $args['body'];
        if (($definition['service'] ?? null) === 'checkout' && $this->merchantAccount !== '' && ! array_is_list($body)) {
            $body['merchantAccount'] ??= $this->merchantAccount;
        }

        return $body;
    }

    /**
     * Send an HTTP request and parse the JSON response.
     *
     * @param  array<string, mixed>  $definition  Operation metadata.
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>|list<mixed>|null  $body  JSON body.
     * @return array<string, mixed>
     */
    private function request(array $definition, string $path, array $query = [], array|null $body = null): array
    {
        $response = $this->rawRequest($definition, $path, $query, $body);
        if ($response->status() === 204) {
            return [];
        }

        $json = $response->json();

        return is_array($json) ? $json : [];
    }

    /**
     * Send a raw HTTP request to Adyen.
     *
     * @param  array<string, mixed>  $definition  Operation metadata.
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>|list<mixed>|null  $body  JSON body.
     */
    private function rawRequest(array $definition, string $path, array $query = [], array|null $body = null): Response
    {
        if (! $this->isConfigured()) {
            throw new \RuntimeException('Adyen API key is not configured.');
        }

        $method = (string) $definition['method'];
        $url = $this->baseUrlFor($definition).$path;

        try {
            $http = Http::withHeaders([
                'X-API-Key' => $this->apiKey,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $options = [];
            if ($query !== []) {
                $options['query'] = $query;
            }
            if ($body !== null) {
                $options['json'] = $body;
            }

            $response = $http->send($method, $url, $options);
            if (! $response->successful()) {
                $error = $response->json('message') ?? $response->json('errorType') ?? $response->json('title') ?? $response->body();
                Log::error("Adyen API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException('Adyen API error ('.$response->status().'): '.(is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Adyen API connection error: {$method} {$path}", ['error' => $e->getMessage()]);

            throw new \RuntimeException("Failed to connect to Adyen API: {$e->getMessage()}");
        }
    }

    /**
     * Resolve a default value for common Adyen account path/query parameters.
     */
    private function defaultParameterValue(string $name): ?string
    {
        return match ($name) {
            'merchantId', 'merchantAccount' => $this->merchantAccount !== '' ? $this->merchantAccount : null,
            'companyId' => $this->companyId !== '' ? $this->companyId : null,
            default => null,
        };
    }

    /**
     * Build the versioned base URL for a service family.
     *
     * @param  array<string, mixed>  $definition  Operation metadata.
     */
    private function baseUrlFor(array $definition): string
    {
        $base = ($definition['service'] ?? null) === 'management' ? $this->managementUrl : $this->baseUrl;
        $version = (string) ($definition['version'] ?? '');

        if ($version !== '' && ! preg_match('#/v'.preg_quote($version, '#').'$#', $base)) {
            $base .= '/v'.$version;
        }

        return $base;
    }
}
