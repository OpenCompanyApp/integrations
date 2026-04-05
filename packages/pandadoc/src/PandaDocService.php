<?php

namespace OpenCompany\Integrations\PandaDoc;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PandaDocService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.pandadoc.com/public/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List documents.
     *
     * @param  int  $page  Page number (1-based).
     * @param  int  $count  Number of results per page.
     * @return array<string, mixed>
     */
    public function listDocuments(int $page = 1, int $count = 50): array
    {
        return $this->request('GET', '/documents', [
            'page' => $page,
            'count' => $count,
        ]);
    }

    /**
     * Get a single document by ID.
     *
     * @param  string  $id  The document UUID.
     * @return array<string, mixed>
     */
    public function getDocument(string $id): array
    {
        return $this->request('GET', '/documents/' . urlencode($id));
    }

    /**
     * Create a new document from a template.
     *
     * @param  string  $name  Document name.
     * @param  string  $templateId  Template UUID to create from.
     * @param  array<string, mixed>  $options  Additional options (recipients, tokens, etc.).
     * @return array<string, mixed>
     */
    public function createDocument(string $name, string $templateId, array $options = []): array
    {
        $body = array_merge([
            'name' => $name,
            'template_uuid' => $templateId,
        ], $options);

        return $this->request('POST', '/documents', $body);
    }

    /**
     * Send a document for signature.
     *
     * @param  string  $id  The document UUID.
     * @param  array<string, mixed>  $options  Send options (message, silent, etc.).
     * @return array<string, mixed>
     */
    public function sendDocument(string $id, array $options = []): array
    {
        return $this->request('POST', '/documents/' . urlencode($id) . '/send', $options);
    }

    /**
     * List templates.
     *
     * @param  int  $page  Page number (1-based).
     * @return array<string, mixed>
     */
    public function listTemplates(int $page = 1): array
    {
        return $this->request('GET', '/templates', [
            'page' => $page,
        ]);
    }

    /**
     * Get a single template by ID.
     *
     * @param  string  $id  The template UUID.
     * @return array<string, mixed>
     */
    public function getTemplate(string $id): array
    {
        return $this->request('GET', '/templates/' . urlencode($id));
    }

    /**
     * Download a document as a PDF.
     *
     * @param  string  $id  The document UUID.
     * @return array{content: string, content_type: string}
     */
    public function downloadDocument(string $id): array
    {
        $response = $this->rawRequest('GET', '/documents/' . urlencode($id) . '/download');

        return [
            'content' => base64_encode($response->body()),
            'content_type' => $response->header('Content-Type') ?? 'application/pdf',
        ];
    }

    /**
     * Create a signed sharing link (session) for a document.
     *
     * @param  string  $id  The document UUID.
     * @param  int  $lifetime  Session lifetime in seconds.
     * @return array<string, mixed>
     */
    public function createLink(string $id, int $lifetime = 3600): array
    {
        return $this->request('POST', '/documents/' . urlencode($id) . '/session', [
            'lifetime' => $lifetime,
        ]);
    }

    /**
     * Get the currently authenticated user's profile.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path (relative to base URL).
     * @param  array<string, mixed>  $data  Query params or JSON body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        if ($response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the PandaDoc API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query params or JSON body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('PandaDoc access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

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
                    Log::warning("PandaDoc API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("PandaDoc API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be unavailable.");
                }

                $error = $response->json('detail') ?? $response->json('error') ?? $body;
                Log::error("PandaDoc API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("PandaDoc API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("PandaDoc API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to PandaDoc API: {$e->getMessage()}");
        }
    }
}
