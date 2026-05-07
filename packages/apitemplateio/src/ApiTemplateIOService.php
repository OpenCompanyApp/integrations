<?php

namespace OpenCompany\Integrations\ApiTemplateIO;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the APITemplate.io REST API v2.
 *
 * Handles API-key authentication, request dispatch, error logging, and response parsing for PDF,
 * image, generated-object, account, and template-management endpoints.
 */
class ApiTemplateIOService
{
    /**
     * @param  string  $apiKey  APITemplate.io API key
     * @param  string  $baseUrl  APITemplate.io API base URL, including the regional host but not a trailing slash
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://rest.apitemplate.io',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * Generate a PDF document from a saved template.
     *
     * @param  string  $templateId  Template ID from the APITemplate.io console
     * @param  array<string, mixed>  $data  JSON payload merged into the template
     * @param  array<string, mixed>  $query  Optional query parameters such as expiration, async, filename, or webhook_url
     * @return array<string, mixed>
     */
    public function createPdf(string $templateId, array $data = [], array $query = []): array
    {
        return $this->request('POST', '/v2/create-pdf', $data, array_merge($query, [
            'template_id' => $templateId,
        ]));
    }

    /**
     * Generate an image from a saved visual template.
     *
     * @param  string  $templateId  Template ID from the APITemplate.io console
     * @param  array<string, mixed>  $payload  Image override payload, usually containing an overrides array
     * @param  array<string, mixed>  $query  Optional query parameters such as output_image_type, expiration, or meta
     * @return array<string, mixed>
     */
    public function createImage(string $templateId, array $payload = [], array $query = []): array
    {
        return $this->request('POST', '/v2/create-image', $payload, array_merge($query, [
            'template_id' => $templateId,
        ]));
    }

    /**
     * Generate a PDF directly from HTML content.
     *
     * @param  string  $body  HTML body content, including optional Jinja2 placeholders
     * @param  string  $css  Optional CSS, normally including a style tag
     * @param  array<string, mixed>  $data  Values for dynamic placeholders in the HTML body
     * @param  array<string, mixed>  $settings  PDF rendering settings such as paper_size or margins
     * @param  array<string, mixed>  $query  Optional query parameters such as expiration, async, filename, or webhook_url
     * @return array<string, mixed>
     */
    public function createPdfFromHtml(string $body, string $css = '', array $data = [], array $settings = [], array $query = []): array
    {
        return $this->request('POST', '/v2/create-pdf-from-html', $this->documentPayload([
            'body' => $body,
            'css' => $css,
            'data' => $data,
            'settings' => $settings,
        ]), $query);
    }

    /**
     * Generate a PDF from a public URL.
     *
     * @param  string  $url  Public URL to render into a PDF
     * @param  array<string, mixed>  $settings  PDF rendering settings such as paper_size or margins
     * @param  array<string, mixed>  $query  Optional query parameters such as expiration, async, filename, or webhook_url
     * @return array<string, mixed>
     */
    public function createPdfFromUrl(string $url, array $settings = [], array $query = []): array
    {
        return $this->request('POST', '/v2/create-pdf-from-url', $this->documentPayload([
            'url' => $url,
            'settings' => $settings,
        ]), $query);
    }

    /**
     * Generate a PDF from Markdown content.
     *
     * @param  string  $body  Markdown body content, including optional Jinja2 placeholders
     * @param  string  $css  Optional CSS, normally including a style tag
     * @param  array<string, mixed>  $data  Values for dynamic placeholders in the Markdown body
     * @param  array<string, mixed>  $settings  PDF rendering settings such as paper_size or margins
     * @param  array<string, mixed>  $query  Optional query parameters such as expiration, async, filename, or webhook_url
     * @return array<string, mixed>
     */
    public function createPdfFromMarkdown(string $body, string $css = '', array $data = [], array $settings = [], array $query = []): array
    {
        return $this->request('POST', '/v2/create-pdf-from-markdown', $this->documentPayload([
            'body' => $body,
            'css' => $css,
            'data' => $data,
            'settings' => $settings,
        ]), $query);
    }

    /**
     * List generated PDFs and images.
     *
     * @param  array<string, mixed>  $params  Query filters such as limit, offset, template_id, transaction_type, or transaction_ref
     * @return array<string, mixed>
     */
    public function listObjects(array $params = []): array
    {
        return $this->request('GET', '/v2/list-objects', [], $params);
    }

    /**
     * Delete a generated object from the CDN and mark its transaction as deleted.
     *
     * @param  string  $transactionRef  Generated object transaction reference
     * @return array<string, mixed>
     */
    public function deleteObject(string $transactionRef): array
    {
        return $this->request('GET', '/v2/delete-object', [], [
            'transaction_ref' => $transactionRef,
        ]);
    }

    /**
     * Get current account information for the configured API key.
     *
     * @return array<string, mixed>
     */
    public function getAccountInformation(): array
    {
        return $this->request('GET', '/v2/account-information');
    }

    /**
     * Backward-compatible alias for account information.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->getAccountInformation();
    }

    /**
     * List saved templates.
     *
     * @param  int|array<string, mixed>  $limit  Page size or a complete query parameter array
     * @param  int  $offset  Offset when using the legacy positional signature
     * @param  string  $format  Optional PDF/JPEG format filter when using the legacy positional signature
     * @param  array<string, mixed>  $extraParams  Additional query parameters such as template_id, group_name, or with_layer_info
     * @return array<string, mixed>
     */
    public function listTemplates(int|array $limit = 300, int $offset = 0, string $format = '', array $extraParams = []): array
    {
        if (is_array($limit)) {
            return $this->request('GET', '/v2/list-templates', [], $limit);
        }

        $params = array_merge($extraParams, [
            'limit' => $limit,
            'offset' => $offset,
        ]);

        if ($format !== '') {
            $params['format'] = $format;
        }

        return $this->request('GET', '/v2/list-templates', [], $params);
    }

    /**
     * Get details for a saved PDF template.
     *
     * @param  string  $templateId  Template ID from the APITemplate.io console
     * @return array<string, mixed>
     */
    public function getTemplate(string $templateId): array
    {
        return $this->request('GET', '/v2/get-template', [], [
            'template_id' => $templateId,
        ]);
    }

    /**
     * Update a saved PDF template.
     *
     * @param  string  $templateId  Template ID from the APITemplate.io console
     * @param  array<string, mixed>  $fields  Template fields such as body, css, or settings
     * @return array<string, mixed>
     */
    public function updateTemplate(string $templateId, array $fields): array
    {
        return $this->request('POST', '/v2/update-template', array_merge($fields, [
            'template_id' => $templateId,
        ]));
    }

    /**
     * Merge multiple PDF URLs or PDF data URLs into one PDF.
     *
     * @param  array<int, string>  $urls  PDF URLs or data URLs to merge in order
     * @param  array<string, mixed>  $params  Optional body parameters such as export_type, expiration, cloud_storage, or postaction settings
     * @return array<string, mixed>
     */
    public function mergePdfs(array $urls, array $params = []): array
    {
        return $this->request('POST', '/v2/merge-pdfs', array_merge($params, [
            'urls' => array_values($urls),
        ]));
    }

    /**
     * Make an APITemplate.io API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method
     * @param  string  $path  API path
     * @param  array<string, mixed>  $body  JSON request body for write endpoints
     * @param  array<string, mixed>  $query  Query string parameters
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $body = [], array $query = []): array
    {
        $response = $this->rawRequest($method, $path, $body, $this->compact($query));

        $json = $response->json();
        if (is_array($json)) {
            return $json;
        }

        return [
            'status' => $response->status(),
            'content_type' => $response->header('Content-Type'),
            'body' => $response->body(),
        ];
    }

    /**
     * Dispatch a raw HTTP request.
     *
     * @param  string  $method  HTTP method
     * @param  string  $path  API path
     * @param  array<string, mixed>  $body  JSON request body
     * @param  array<string, mixed>  $query  Query string parameters
     * @return Response
     *
     * @throws RuntimeException
     */
    private function rawRequest(string $method, string $path, array $body = [], array $query = []): Response
    {
        if ($this->apiKey === '') {
            throw new RuntimeException('API Template IO API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'X-API-KEY' => $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(100);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $query),
                'POST' => $http->withOptions(['query' => $query])->post($url, $body),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $this->throwApiError($method, $path, $response);
            }

            return $response;
        } catch (ConnectionException $e) {
            Log::error("API Template IO connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new RuntimeException("Failed to connect to API Template IO: {$e->getMessage()}");
        }
    }

    /**
     * Build a request body without optional empty values.
     *
     * @param  array<string, mixed>  $payload  Raw document payload
     * @return array<string, mixed>
     */
    private function documentPayload(array $payload): array
    {
        return $this->compact($payload);
    }

    /**
     * Remove null and empty string parameters while preserving false, zero, and empty arrays.
     *
     * @param  array<string, mixed>  $values  Input values
     * @return array<string, mixed>
     */
    private function compact(array $values): array
    {
        return array_filter($values, static fn (mixed $value): bool => $value !== null && $value !== '');
    }

    /**
     * Log and throw a normalized API exception.
     *
     * @throws RuntimeException
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $contentType = $response->header('Content-Type');
        $body = $response->body();

        if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
            Log::warning("API Template IO returned HTML for {$method} {$path}", [
                'status' => $response->status(),
            ]);

            throw new RuntimeException("API Template IO endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be unavailable or the URL may be incorrect.");
        }

        $error = $response->json('message') ?? $response->json('error') ?? $body;

        Log::error("API Template IO error: {$method} {$path}", [
            'status' => $response->status(),
            'error' => $error,
        ]);

        throw new RuntimeException("API Template IO error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
    }
}
