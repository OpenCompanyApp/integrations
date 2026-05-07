<?php

namespace OpenCompany\Integrations\DeepL;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the DeepL API.
 *
 * Executes generated OpenAPI operation metadata, handles DeepL auth-key
 * authentication, and parses API errors.
 */
class DeepLService
{
    /**
     * @param  string  $apiKey  DeepL API authentication key.
     * @param  string  $baseUrl  DeepL API root URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.deepl.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the DeepL API key has been configured.
     */
    public function isConfigured(): bool
    {
        return $this->apiKey !== '' && $this->baseUrl !== '';
    }

    /**
     * Return official DeepL operation metadata used by generated tools.
     *
     * @return array<string, array<string, mixed>>
     */
    public static function operations(): array
    {
        return DeepLOperations::all();
    }

    /**
     * Execute an official DeepL OpenAPI operation.
     *
     * @param  array<string, mixed>  $operation  Operation metadata from DeepLOperations.
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
            $name = (string) $parameter['name'];
            $value = $this->argument($args, $name);

            if ($value === null) {
                if (!empty($parameter['required'])) {
                    throw new \RuntimeException("The {$this->snakeName($name)} parameter is required.");
                }

                continue;
            }

            $consumed[] = $name;
            $consumed[] = $this->snakeName($name);
            $consumed[] = strtolower($name);

            if ($parameter['in'] === 'path') {
                $path = str_replace('{' . $name . '}', rawurlencode((string) $value), $path);
            } elseif ($parameter['in'] === 'query') {
                $query[$name] = $value;
            } elseif ($parameter['in'] === 'header') {
                $headers[$name] = $value;
            }
        }

        $requestBody = $operation['request_body'] ?? null;
        $body = null;
        $contentType = null;

        if ($requestBody !== null) {
            $body = $args['body'] ?? $this->bodyFromLooseArguments($args, array_merge($consumed, ['content_type']));
            $contentType = (string) ($args['content_type'] ?? $requestBody['default_content_type'] ?? $requestBody['content_types'][0] ?? 'application/json');

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
            $contentType,
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
            throw new \RuntimeException("Unknown DeepL operation: {$slug}");
        }

        return $this->executeOperation($operations[$slug], $args);
    }

    /**
     * Translate text using the DeepL API.
     *
     * @param  string|array<int, string>  $text  One or more texts to translate.
     * @return array<string, mixed>
     */
    public function translateText(string|array $text, string $targetLang, ?string $sourceLang = null): array
    {
        $body = [
            'text' => is_array($text) ? $text : [$text],
            'target_lang' => $targetLang,
        ];

        if ($sourceLang !== null) {
            $body['source_lang'] = $sourceLang;
        }

        return $this->executeSlug('deepl_translate_text', ['body' => $body]);
    }

    /**
     * List supported languages.
     *
     * @return array<string, mixed>
     */
    public function listLanguages(?string $type = null): array
    {
        return $this->executeSlug('deepl_list_languages', $type === null ? [] : ['type' => $type]);
    }

    /**
     * Get current DeepL API usage information.
     *
     * @return array<string, mixed>
     */
    public function getUsage(): array
    {
        return $this->executeSlug('deepl_get_usage');
    }

    /**
     * List all v2 glossaries.
     *
     * @return array<string, mixed>
     */
    public function listGlossaries(): array
    {
        return $this->executeSlug('deepl_list_glossaries');
    }

    /**
     * Get details of a v2 glossary.
     *
     * @return array<string, mixed>
     */
    public function getGlossary(string $id): array
    {
        return $this->executeSlug('deepl_get_glossary', ['glossary_id' => $id]);
    }

    /**
     * Create a new v2 glossary.
     *
     * @return array<string, mixed>
     */
    public function createGlossary(string $name, string $sourceLang, string $targetLang, string $entries): array
    {
        return $this->executeSlug('deepl_create_glossary', [
            'body' => [
                'name' => $name,
                'source_lang' => $sourceLang,
                'target_lang' => $targetLang,
                'entries' => $entries,
                'entries_format' => 'tsv',
            ],
        ]);
    }

    /**
     * Make an API request and return parsed output.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $url  Fully qualified request URL.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $headers  Additional headers.
     * @param  mixed  $body  Request body.
     * @param  string|null  $contentType  Request content type.
     * @return array<string, mixed>
     */
    private function request(string $method, string $url, array $query = [], array $headers = [], mixed $body = null, ?string $contentType = null): array
    {
        $response = $this->rawRequest($method, $url, $query, $headers, $body, $contentType);

        if ($response->status() === 204 || $response->body() === '') {
            return [];
        }

        $responseContentType = (string) $response->header('Content-Type');

        if (!str_contains($responseContentType, 'json')) {
            return [
                'body' => $response->body(),
                'content_type' => $responseContentType,
            ];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the DeepL API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $url  Fully qualified request URL.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $headers  Additional headers.
     * @param  mixed  $body  Request body.
     * @param  string|null  $contentType  Request content type.
     */
    private function rawRequest(string $method, string $url, array $query = [], array $headers = [], mixed $body = null, ?string $contentType = null): Response
    {
        if ($this->apiKey === '') {
            throw new \RuntimeException('DeepL API key is not configured.');
        }

        try {
            $http = Http::withHeaders(array_merge([
                'Authorization' => 'DeepL-Auth-Key ' . $this->apiKey,
                'Accept' => 'application/json',
            ], $headers))->timeout(120);

            $response = $this->sendRequest($http, $method, $url, $query, $body, $contentType);

            if (!$response->successful()) {
                $responseContentType = (string) $response->header('Content-Type');
                $rawBody = $response->body();

                if (str_contains($responseContentType, 'text/html') || str_starts_with(trim($rawBody), '<!DOCTYPE')) {
                    Log::warning("DeepL API returned HTML for {$method} {$url}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("DeepL API endpoint not available (HTTP {$response->status()}). Check the base URL configuration.");
                }

                $error = $response->json('message') ?? $response->body();
                Log::error("DeepL API error: {$method} {$url}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException('DeepL API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("DeepL API connection error: {$method} {$url}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to DeepL API: {$e->getMessage()}");
        }
    }

    /**
     * Dispatch the request with the appropriate HTTP verb and body encoding.
     *
     * @param  PendingRequest  $http  Pending HTTP request.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  mixed  $body  Request body.
     */
    private function sendRequest(PendingRequest $http, string $method, string $url, array $query, mixed $body, ?string $contentType): Response
    {
        $method = strtoupper($method);

        if ($query !== []) {
            $url .= (str_contains($url, '?') ? '&' : '?') . http_build_query($query);
        }

        if ($contentType === 'application/x-www-form-urlencoded') {
            $http = $http->asForm();
        } elseif ($contentType === 'multipart/form-data') {
            $http = $http->asMultipart();
        } elseif ($contentType !== null) {
            $http = $http->withHeaders(['Content-Type' => $contentType]);
        } else {
            $http = $http->withHeaders(['Content-Type' => 'application/json']);
        }

        return match ($method) {
            'GET' => $http->get($url),
            'POST' => $http->post($url, is_array($body) ? $body : []),
            'PUT' => $http->put($url, is_array($body) ? $body : []),
            'PATCH' => $http->patch($url, is_array($body) ? $body : []),
            'DELETE' => $http->delete($url, is_array($body) ? $body : []),
            default => $http->send($method, $url, ['json' => $body ?? []]),
        };
    }

    /**
     * Resolve an argument by exact, snake_case, or lower-case parameter name.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    private function argument(array $args, string $name): mixed
    {
        foreach ([$name, $this->snakeName($name), strtolower($name)] as $key) {
            if (array_key_exists($key, $args)) {
                return $args[$key];
            }
        }

        return null;
    }

    private function snakeName(string $name): string
    {
        $name = (string) preg_replace('/(?<!^)[A-Z]/', '_$0', $name);
        $name = (string) preg_replace('/[^A-Za-z0-9]+/', '_', $name);
        $name = (string) preg_replace('/_+/', '_', $name);

        return strtolower(trim($name, '_'));
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