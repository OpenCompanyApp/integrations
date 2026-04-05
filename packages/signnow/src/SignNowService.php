<?php

namespace OpenCompany\Integrations\SignNow;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SignNowService
{
    /**
     * @param string $accessToken OAuth2 access token for the SignNow API
     * @param string $baseUrl     Base URL for the SignNow API
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.signnow.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has a configured access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * List documents accessible to the authenticated user.
     *
     * @param int $page    Page number (1-based)
     * @param int $perPage Number of results per page
     * @return array<string, mixed>
     */
    public function listDocuments(int $page = 1, int $perPage = 20): array
    {
        return $this->request('GET', '/document', [
            'page' => $page,
            'per_page' => $perPage,
        ]);
    }

    /**
     * Get details for a single document by ID.
     *
     * @param string $documentId The unique document identifier
     * @return array<string, mixed>
     */
    public function getDocument(string $documentId): array
    {
        return $this->request('GET', '/document/' . urlencode($documentId));
    }

    /**
     * Upload a file and create a new document.
     *
     * @param string $filePath Absolute path to the file to upload
     * @param string $fileName Original file name for the upload
     * @return array<string, mixed>
     */
    public function createDocument(string $filePath, string $fileName): array
    {
        if (!file_exists($filePath)) {
            throw new \RuntimeException("File not found: {$filePath}");
        }

        $response = $this->rawUpload('/document', $filePath, $fileName);

        return $response->json() ?? [];
    }

    /**
     * List templates accessible to the authenticated user.
     *
     * @return array<string, mixed>
     */
    public function listTemplates(): array
    {
        return $this->request('GET', '/template');
    }

    /**
     * Send a signing invite for a document.
     *
     * @param string $documentId The document to send an invite for
     * @param string $to         Recipient email address
     * @param string $from       Sender email address (must match account email)
     * @param string $subject    Email subject line for the invite
     * @param string|null $message Optional email body message
     * @return array<string, mixed>
     */
    public function sendInvite(string $documentId, string $to, string $from, string $subject, ?string $message = null): array
    {
        $data = [
            'to' => $to,
            'from' => $from,
            'subject' => $subject,
        ];

        if ($message !== null) {
            $data['message'] = $message;
        }

        return $this->request('POST', '/document/' . urlencode($documentId) . '/invite', $data);
    }

    /**
     * Get the currently authenticated user's profile.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param string $method HTTP method (GET, POST, PUT, DELETE)
     * @param string $path   API endpoint path
     * @param array<string, mixed> $data Query params (GET) or JSON body (POST/PUT/DELETE)
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the SignNow API.
     *
     * @param string $method HTTP method
     * @param string $path   API endpoint path
     * @param array<string, mixed> $data Request data
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException When the API key is missing or the request fails
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('SignNow access token is not configured.');
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

                if (str_contains((string) $contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("SignNow API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("SignNow API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the service is down.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("SignNow API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("SignNow API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("SignNow API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to SignNow API: {$e->getMessage()}");
        }
    }

    /**
     * Upload a file to the SignNow API using multipart form data.
     *
     * @param string $path     API endpoint path
     * @param string $filePath Absolute path to the file
     * @param string $fileName Original file name
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException When the access token is missing or the upload fails
     */
    private function rawUpload(string $path, string $filePath, string $fileName): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('SignNow access token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->accessToken,
            ])->timeout(60)->attach('file', file_get_contents($filePath), $fileName)
              ->post($url);

            if (!$response->successful()) {
                $error = $response->json('error') ?? $response->json('message') ?? $response->body();
                Log::error("SignNow API upload error: POST {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("SignNow API upload error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("SignNow API connection error: upload {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to SignNow API: {$e->getMessage()}");
        }
    }
}
