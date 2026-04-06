<?php

namespace OpenCompany\Integrations\Prismic;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PrismicService
{
    /**
     * Create a new Prismic service instance.
     *
     * @param  string  $accessToken  The Prismic API access token (Bearer token).
     * @param  string  $repository   The Prismic repository name (e.g., "my-repo").
     */
    public function __construct(
        private string $accessToken = '',
        private string $repository = '',
    ) {}

    /**
     * Determine whether the service is configured with an access token and repository.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken) && !empty($this->repository);
    }

    /**
     * Build the base API URL for the configured repository.
     *
     * @return string The base URL, e.g. "https://my-repo.prismic.io/api/v2"
     */
    public function getBaseUrl(): string
    {
        return rtrim("https://{$this->repository}.prismic.io/api/v2", '/');
    }

    /**
     * Search / list documents from the repository.
     *
     * @param  array  $params  Query parameters: q, pageSize, page, orderings, lang, ref, etc.
     * @return array The parsed JSON response.
     */
    public function searchDocuments(array $params = []): array
    {
        return $this->request('GET', '/documents/search', $params);
    }

    /**
     * List all custom types defined in the repository.
     *
     * @param  int  $limit   Maximum number of types to return.
     * @param  int  $page    Page number for pagination.
     * @return array The parsed JSON response.
     */
    public function listTypes(int $limit = 100, int $page = 1): array
    {
        return $this->request('GET', '/types', [
            'limit' => $limit,
            'page' => $page,
        ]);
    }

    /**
     * Get all tags defined in the repository.
     *
     * @return array The parsed JSON response.
     */
    public function getTags(): array
    {
        return $this->request('GET', '/tags');
    }

    /**
     * List all refs (releases / drafts) for the repository.
     *
     * @return array The parsed JSON response.
     */
    public function listRefs(): array
    {
        return $this->request('GET', '/refs');
    }

    /**
     * List all languages configured in the repository.
     *
     * @return array The parsed JSON response.
     */
    public function listLanguages(): array
    {
        return $this->request('GET', '/languages');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, etc.).
     * @param  string  $path    API path (e.g., "/documents/search").
     * @param  array   $params  Query or body parameters.
     * @return array The parsed JSON response.
     *
     * @throws \RuntimeException If the service is not configured or the request fails.
     */
    private function request(string $method, string $path, array $params = []): array
    {
        $response = $this->rawRequest($method, $path, $params);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Prismic API.
     *
     * @param  string  $method  HTTP method (GET, POST, etc.).
     * @param  string  $path    API path (e.g., "/documents/search").
     * @param  array   $params  Query or body parameters.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the access token or repository is missing, or the request fails.
     */
    private function rawRequest(string $method, string $path, array $params = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Prismic access token is not configured.');
        }

        if (!$this->repository) {
            throw new \RuntimeException('Prismic repository name is not configured.');
        }

        $url = $this->getBaseUrl() . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Accept' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $params),
                'POST' => $http->post($url, $params),
                'PUT' => $http->put($url, $params),
                'DELETE' => $http->delete($url, $params),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Prismic API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Prismic API endpoint not available (HTTP {$response->status()}). The repository name may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Prismic API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Prismic API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Prismic API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Prismic API: {$e->getMessage()}");
        }
    }
}
