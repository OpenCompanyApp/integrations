<?php

namespace OpenCompany\Integrations\Lever;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Lever Postings and Data APIs.
 *
 * Handles public posting reads, application submission, authenticated Data API
 * requests, response parsing, and Lever error normalization.
 */
class LeverService
{
    /**
     * @param  string  $apiKey  Lever Postings API key, required only for application submission.
     * @param  string  $baseUrl  Lever Postings API base URL.
     * @param  string  $dataBaseUrl  Lever Data API base URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.lever.co/v0/postings',
        private string $dataBaseUrl = 'https://api.lever.co/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
        $this->dataBaseUrl = rtrim($this->dataBaseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return true;
    }

    public function canSubmitApplications(): bool
    {
        return $this->apiKey !== '';
    }

    public function canUseDataApi(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * List published postings for a Lever site.
     *
     * @param  array<string, mixed>  $query  Filters such as mode, skip, limit, location, commitment, team, department, level, group, css, and resize.
     * @return array<string, mixed>
     */
    public function listPostings(string $site, array $query = []): array
    {
        return $this->request('GET', '/{site}', ['site' => $site], $this->filterQuery($query, [
            'mode', 'skip', 'limit', 'location', 'commitment', 'team', 'department', 'level', 'group', 'css', 'resize',
        ]));
    }

    /**
     * Get a single published posting by Lever posting ID.
     *
     * @return array<string, mixed>
     */
    public function getPosting(string $site, string $postingId): array
    {
        return $this->request('GET', '/{site}/{postingId}', ['site' => $site, 'postingId' => $postingId], ['mode' => 'json']);
    }

    /**
     * Submit a JSON application to a Lever posting.
     *
     * @param  array<string, mixed>  $application  Candidate application fields accepted by Lever.
     * @return array<string, mixed>
     */
    public function applyToPosting(string $site, string $postingId, array $application): array
    {
        if (!$this->canSubmitApplications()) {
            throw new RuntimeException('Lever API key is required to submit applications.');
        }

        return $this->request('POST', '/{site}/{postingId}', ['site' => $site, 'postingId' => $postingId], ['key' => $this->apiKey], $application);
    }

    /**
     * Execute an authenticated GET request against the Lever Data API.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array
    {
        return $this->dataRequest('GET', $path, $query);
    }

    /**
     * Execute an authenticated POST request against the Lever Data API.
     *
     * @param  array<string, mixed>  $body  JSON request body.
     * @param  array<string, mixed>  $query  Query string parameters.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $body = [], array $query = []): array
    {
        return $this->dataRequest('POST', $path, $query, $body);
    }

    /**
     * Execute an authenticated PUT request against the Lever Data API.
     *
     * @param  array<string, mixed>  $body  JSON request body.
     * @param  array<string, mixed>  $query  Query string parameters.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $body = [], array $query = []): array
    {
        return $this->dataRequest('PUT', $path, $query, $body);
    }

    /**
     * Execute an authenticated DELETE request against the Lever Data API.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $query = []): array
    {
        return $this->dataRequest('DELETE', $path, $query);
    }

    /**
     * Execute an authenticated Lever Data API request.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $body  JSON request body.
     * @return array<string, mixed>
     */
    private function dataRequest(string $method, string $path, array $query = [], array $body = []): array
    {
        if (!$this->canUseDataApi()) {
            throw new RuntimeException('Lever API key is required for Data API requests.');
        }

        $method = strtoupper($method);
        $path = $this->safeRelativePath($path);
        $url = $this->urlWithQuery($this->dataBaseUrl.$path, $this->filterEmpty($query));

        try {
            $http = Http::acceptJson()->withBasicAuth($this->apiKey, '')->timeout(60);
            $response = match ($method) {
                'GET' => $http->get($url),
                'POST' => $http->withHeaders(['Content-Type' => 'application/json'])->post($url, $body),
                'PUT' => $http->withHeaders(['Content-Type' => 'application/json'])->put($url, $body),
                'DELETE' => $http->delete($url),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            return $this->parseResponse($response, $method, $path);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Lever Data API connection error: {$method} {$path}", ['error' => $e->getMessage()]);

            throw new RuntimeException("Failed to connect to Lever Data API: {$e->getMessage()}");
        }
    }

    /**
     * Execute a Lever Postings API request.
     *
     * @param  array<string, mixed>  $pathParams  Path parameters.
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $body  JSON request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $pathTemplate, array $pathParams = [], array $query = [], array $body = []): array
    {
        $method = strtoupper($method);
        $path = $this->expandPath($pathTemplate, $pathParams);
        $url = $this->urlWithQuery($this->baseUrl.$path, $query);

        try {
            $http = Http::acceptJson()->timeout(60);
            $response = match ($method) {
                'GET' => $http->get($url),
                'POST' => $http->withHeaders(['Content-Type' => 'application/json'])->post($url, $body),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            return $this->parseResponse($response, $method, $path);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Lever API connection error: {$method} {$path}", ['error' => $e->getMessage()]);

            throw new RuntimeException("Failed to connect to Lever API: {$e->getMessage()}");
        }
    }

    /**
     * Parse Lever JSON responses and raise normalized errors.
     *
     * @return array<string, mixed>
     */
    private function parseResponse(Response $response, string $method, string $path): array
    {
        if (!$response->successful()) {
            $error = $response->json('error') ?? $response->body();
            Log::error("Lever API error: {$method} {$path}", ['status' => $response->status(), 'error' => $error]);

            throw new RuntimeException('Lever API error ('.$response->status().'): '.(is_string($error) ? $error : json_encode($error)));
        }

        if ($response->body() === '') {
            return ['success' => true, 'status' => $response->status()];
        }

        $json = $response->json();

        return is_array($json) ? $json : ['body' => $response->body(), 'status' => $response->status()];
    }

    /**
     * Expand path parameters using URL encoding.
     *
     * @param  array<string, mixed>  $pathParams  Path parameter values.
     */
    private function expandPath(string $template, array $pathParams): string
    {
        return (string) preg_replace_callback('/\{([A-Za-z0-9_]+)\}/', function (array $matches) use ($pathParams): string {
            $key = $matches[1];
            $value = $pathParams[$key] ?? null;
            if (!is_scalar($value) || trim((string) $value) === '') {
                throw new RuntimeException($key.' must be a non-empty path parameter.');
            }

            return rawurlencode((string) $value);
        }, $template);
    }

    /**
     * Keep only supported Lever query parameters.
     *
     * @param  array<string, mixed>  $query  Candidate query values.
     * @param  string[]  $allowed  Allowed query keys.
     * @return array<string, mixed>
     */
    private function filterQuery(array $query, array $allowed): array
    {
        return array_filter(
            array_intersect_key($query, array_flip($allowed)),
            static fn (mixed $value): bool => $value !== null && $value !== '',
        );
    }

    /**
     * Remove empty query values.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @return array<string, mixed>
     */
    private function filterEmpty(array $query): array
    {
        return array_filter($query, static fn (mixed $value): bool => $value !== null && $value !== '');
    }

    /**
     * Validate a relative Data API path.
     */
    private function safeRelativePath(string $path): string
    {
        if ($path === '' || str_contains($path, '://')) {
            throw new RuntimeException('Lever Data API path must be a relative path.');
        }

        $path = '/'.ltrim($path, '/');
        if (str_contains($path, '..')) {
            throw new RuntimeException('Lever Data API path cannot contain parent directory traversal.');
        }

        return $path;
    }

    /**
     * Append query parameters while preserving repeated Lever filters.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     */
    private function urlWithQuery(string $url, array $query): string
    {
        $parts = [];
        foreach ($query as $key => $value) {
            foreach (is_array($value) ? $value : [$value] as $item) {
                if ($item !== null && $item !== '') {
                    $parts[] = rawurlencode((string) $key).'='.rawurlencode((string) $item);
                }
            }
        }

        return $parts === [] ? $url : $url.'?'.implode('&', $parts);
    }
}
