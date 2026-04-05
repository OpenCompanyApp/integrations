<?php

namespace OpenCompany\Integrations\ZohoMail;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Service class for interacting with the Zoho Mail REST API.
 *
 * Handles authentication via Bearer token and provides methods for
 * messages, folders, tasks, and account information.
 *
 * @see https://www.zoho.com/mail/help/api/getmails.html
 */
class ZohoMailService
{
    /**
     * Create a new ZohoMailService instance.
     *
     * @param string $accessToken Zoho Mail OAuth access token
     * @param string $baseUrl     Base URL for the Zoho Mail API
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://mail.zoho.com/api/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * Get the current user's account information.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/accounts');
    }

    /**
     * List messages in a specific folder for an account.
     *
     * @param string               $accountId The Zoho Mail account ID
     * @param array<string, mixed> $params    Query parameters (folderId, start, limit, etc.)
     *
     * @return array<string, mixed>
     */
    public function listMessages(string $accountId, array $params = []): array
    {
        return $this->request('GET', "/accounts/{$accountId}/messages", $params);
    }

    /**
     * Get a single message by ID.
     *
     * @param string $accountId The Zoho Mail account ID
     * @param string $messageId The message ID
     *
     * @return array<string, mixed>
     */
    public function getMessage(string $accountId, string $messageId): array
    {
        return $this->request('GET', "/accounts/{$accountId}/messages/{$messageId}");
    }

    /**
     * Send a new email message.
     *
     * @param string               $accountId The Zoho Mail account ID
     * @param array<string, mixed> $data      Message payload (toAddress, subject, content, etc.)
     *
     * @return array<string, mixed>
     */
    public function sendMessage(string $accountId, array $data): array
    {
        return $this->request('POST', "/accounts/{$accountId}/messages", $data);
    }

    /**
     * List folders for an account.
     *
     * @param string $accountId The Zoho Mail account ID
     *
     * @return array<string, mixed>
     */
    public function listFolders(string $accountId): array
    {
        return $this->request('GET', "/accounts/{$accountId}/folders");
    }

    /**
     * List tasks for an account.
     *
     * @param string               $accountId The Zoho Mail account ID
     * @param array<string, mixed> $params    Query parameters (limit, start, etc.)
     *
     * @return array<string, mixed>
     */
    public function listTasks(string $accountId, array $params = []): array
    {
        return $this->request('GET', "/accounts/{$accountId}/tasks", $params);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param string               $method HTTP method (GET, POST, PUT, DELETE)
     * @param string               $path   API endpoint path
     * @param array<string, mixed> $data   Query parameters or request body
     *
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Zoho Mail API.
     *
     * @param string               $method HTTP method (GET, POST, PUT, DELETE)
     * @param string               $path   API endpoint path
     * @param array<string, mixed> $data   Query parameters or request body
     *
     * @throws \RuntimeException If the access token is missing or the request fails
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Zoho Mail access token is not configured.');
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
                    Log::warning("Zoho Mail API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Zoho Mail API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may require a different plan or the URL may be incorrect.");
                }

                $error = $response->json('error') ?? $body;
                Log::error("Zoho Mail API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Zoho Mail API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Zoho Mail API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Zoho Mail API: {$e->getMessage()}");
        }
    }
}
