<?php

namespace OpenCompany\Integrations\DocuSign;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DocuSignService
{
    /**
     * Create a new DocuSign service instance.
     *
     * @param  string  $accessToken  OAuth2 access token for DocuSign API.
     * @param  string  $accountId    DocuSign account ID used in API paths.
     * @param  string  $basePath     DocuSign API base URL (e.g. "https://demo.docusign.net/restapi").
     */
    public function __construct(
        private string $accessToken = '',
        private string $accountId = '',
        private string $basePath = '',
    ) {
        $this->basePath = rtrim($this->basePath, '/');
    }

    /**
     * Check whether the service has the minimum required credentials.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken) && !empty($this->accountId) && !empty($this->basePath);
    }

    /**
     * Get the configured account ID.
     */
    public function getAccountId(): string
    {
        return $this->accountId;
    }

    /**
     * List envelopes for the account.
     *
     * @param  array  $params  Query parameters (from_date, to_date, status, count, start_position, etc.).
     * @return array<string, mixed>
     *
     * @see https://developers.docusign.com/docs/esign-rest-api/reference/envelopes/envelopes/list/
     */
    public function listEnvelopes(array $params = []): array
    {
        return $this->request('GET', "/v2.1/accounts/{$this->accountId}/envelopes", $params);
    }

    /**
     * Get details for a single envelope.
     *
     * @param  string  $envelopeId  The envelope ID.
     * @param  array  $params       Optional query parameters (include, advanced_update, etc.).
     * @return array<string, mixed>
     *
     * @see https://developers.docusign.com/docs/esign-rest-api/reference/envelopes/envelopes/get/
     */
    public function getEnvelope(string $envelopeId, array $params = []): array
    {
        return $this->request('GET', "/v2.1/accounts/{$this->accountId}/envelopes/{$envelopeId}", $params);
    }

    /**
     * Create and send (or draft) a new envelope.
     *
     * @param  array  $body  The envelope definition payload.
     * @return array<string, mixed>
     *
     * @see https://developers.docusign.com/docs/esign-rest-api/reference/envelopes/envelopes/create/
     */
    public function createEnvelope(array $body): array
    {
        return $this->request('POST', "/v2.1/accounts/{$this->accountId}/envelopes", $body);
    }

    /**
     * List templates available in the account.
     *
     * @param  array  $params  Query parameters (search_text, folder_id, etc.).
     * @return array<string, mixed>
     *
     * @see https://developers.docusign.com/docs/esign-rest-api/reference/templates/templates/list/
     */
    public function listTemplates(array $params = []): array
    {
        return $this->request('GET', "/v2.1/accounts/{$this->accountId}/templates", $params);
    }

    /**
     * Get details for a single template.
     *
     * @param  string  $templateId  The template ID.
     * @return array<string, mixed>
     *
     * @see https://developers.docusign.com/docs/esign-rest-api/reference/templates/templates/get/
     */
    public function getTemplate(string $templateId): array
    {
        return $this->request('GET', "/v2.1/accounts/{$this->accountId}/templates/{$templateId}");
    }

    /**
     * List documents in an envelope.
     *
     * @param  string  $envelopeId  The envelope ID.
     * @return array<string, mixed>
     *
     * @see https://developers.docusign.com/docs/esign-rest-api/reference/envelopes/documents/list/
     */
    public function listDocuments(string $envelopeId): array
    {
        return $this->request('GET', "/v2.1/accounts/{$this->accountId}/envelopes/{$envelopeId}/documents");
    }

    /**
     * Download a document from an envelope.
     *
     * Returns the raw file contents as a string (PDF by default).
     *
     * @param  string  $envelopeId  The envelope ID.
     * @param  string  $documentId  The document ID.
     * @return string  Raw document bytes.
     *
     * @see https://developers.docusign.com/docs/esign-rest-api/reference/envelopes/documents/get/
     */
    public function getDocument(string $envelopeId, string $documentId): string
    {
        return $this->rawRequest('GET', "/v2.1/accounts/{$this->accountId}/envelopes/{$envelopeId}/documents/{$documentId}")
            ->body();
    }

    /**
     * Get information about the currently authenticated user.
     *
     * Uses the OAuth userinfo endpoint (not account-scoped).
     *
     * @return array<string, mixed>
     *
     * @see https://developers.docusign.com/platform/auth/reference/user-info
     */
    public function getCurrentUser(): array
    {
        // The userinfo endpoint is served from account-d.docusign.com (demo) or account.docusign.com (prod).
        // We infer it from the basePath, or fall back to the standard prod endpoint.
        $userInfoBase = $this->resolveUserInfoBase();

        return $this->requestAbsolute('GET', "{$userInfoBase}/oauth/userinfo");
    }

    /**
     * Make an API request to a DocuSign endpoint and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    Relative API path (appended to basePath).
     * @param  array<string, mixed>  $data  Query parameters (GET) or JSON body (POST/PUT).
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to a DocuSign endpoint (relative to basePath).
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    Relative API path.
     * @param  array<string, mixed>  $data  Query params or JSON body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException  When credentials are missing or the API returns an error.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('DocuSign access token is not configured.');
        }

        $url = $this->basePath . $path;

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
                    Log::warning("DocuSign API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("DocuSign API endpoint not available (HTTP {$response->status()}). Check the base path and account ID.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("DocuSign API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("DocuSign API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("DocuSign API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to DocuSign API: {$e->getMessage()}");
        }
    }

    /**
     * Make an API request to an absolute URL using the stored access token.
     *
     * Used for endpoints that live outside the account-scoped basePath
     * (e.g. the OAuth userinfo endpoint).
     *
     * @param  string  $method  HTTP method.
     * @param  string  $url     Fully-qualified URL.
     * @return array<string, mixed>
     */
    private function requestAbsolute(string $method, string $url): array
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('DocuSign access token is not configured.');
        }

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            throw new \RuntimeException("Failed to connect to DocuSign API: {$e->getMessage()}");
        }
    }

    /**
     * Resolve the OAuth userinfo base URL from the configured basePath.
     *
     * Demo environments use account-d.docusign.com; production uses account.docusign.com.
     */
    private function resolveUserInfoBase(): string
    {
        if (str_contains($this->basePath, 'demo')) {
            return 'https://account-d.docusign.com';
        }

        return 'https://account.docusign.com';
    }
}
