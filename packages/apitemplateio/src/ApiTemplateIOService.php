<?php

namespace OpenCompany\Integrations\ApiTemplateIO;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Service class for interacting with the API Template IO API.
 *
 * Handles authentication, HTTP communication, and error handling for generating
 * PDFs and images from templates, managing templates, and account information.
 */
class ApiTemplateIOService
{
    /**
     * Create a new ApiTemplateIOService instance.
     *
     * @param string $apiKey  The API key for authenticating with API Template IO.
     * @param string $baseUrl The base URL for the API Template IO API.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.apitemplate.io/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured with an API key.
     *
     * @return bool True if an API key is set.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Generate a PDF document from a template.
     *
     * @param string               $templateId   The template ID to use for generation.
     * @param array<string, mixed> $data         The data to merge into the template.
     * @param array<string, mixed> $extraParams  Additional parameters (e.g., output_html, meta, expire).
     *
     * @return array<string, mixed> The API response containing the generated PDF URL and metadata.
     */
    public function createPdf(string $templateId, array $data = [], array $extraParams = []): array
    {
        $body = array_merge($extraParams, [
            'template_id' => $templateId,
            'data' => $data,
            'output_format' => 'pdf',
        ]);

        return $this->request('POST', '/create', $body);
    }

    /**
     * Generate an image (PNG or JPEG) from a template.
     *
     * @param string               $templateId   The template ID to use for generation.
     * @param array<string, mixed> $data         The data to merge into the template.
     * @param string               $outputFormat The image format — either "png" or "jpeg".
     * @param array<string, mixed> $extraParams  Additional parameters (e.g., output_html, meta, expire).
     *
     * @return array<string, mixed> The API response containing the generated image URL and metadata.
     */
    public function createImage(string $templateId, array $data = [], string $outputFormat = 'png', array $extraParams = []): array
    {
        $body = array_merge($extraParams, [
            'template_id' => $templateId,
            'data' => $data,
            'output_format' => $outputFormat,
        ]);

        return $this->request('POST', '/create', $body);
    }

    /**
     * List available templates with pagination.
     *
     * @param int    $limit  Number of templates to return per page (default: 50).
     * @param int    $offset Offset for pagination (default: 0).
     * @param string $filter Optional filter expression for templates.
     *
     * @return array<string, mixed> The paginated list of templates.
     */
    public function listTemplates(int $limit = 50, int $offset = 0, string $filter = ''): array
    {
        $params = [
            'limit' => $limit,
            'offset' => $offset,
        ];

        if ($filter !== '') {
            $params['filter'] = $filter;
        }

        return $this->request('GET', '/templates', $params);
    }

    /**
     * Get details for a specific template by ID.
     *
     * @param string $templateId The template ID to retrieve.
     *
     * @return array<string, mixed> The template details.
     */
    public function getTemplate(string $templateId): array
    {
        return $this->request('GET', '/templates/' . urlencode($templateId));
    }

    /**
     * Get the current authenticated user's account information.
     *
     * @return array<string, mixed> The account details including usage and subscription info.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/account');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param string               $method The HTTP method (GET, POST, PUT, DELETE).
     * @param string               $path   The API endpoint path.
     * @param array<string, mixed> $data   Request data (query params for GET, body for POST/PUT).
     *
     * @return array<string, mixed> The parsed JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the API Template IO API.
     *
     * @param string               $method The HTTP method (GET, POST, PUT, DELETE).
     * @param string               $path   The API endpoint path.
     * @param array<string, mixed> $data   Request data.
     *
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the API key is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('API Template IO API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'X-API-KEY' => $this->apiKey,
                'Content-Type' => 'application/json',
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
                    Log::warning("API Template IO returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("API Template IO endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be unavailable or the URL may be incorrect.");
                }

                $error = $response->json('message') ?? $response->json('error') ?? $body;
                Log::error("API Template IO error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("API Template IO error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("API Template IO connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to API Template IO: {$e->getMessage()}");
        }
    }
}
