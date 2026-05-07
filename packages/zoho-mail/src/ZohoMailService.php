<?php

namespace OpenCompany\Integrations\ZohoMail;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Zoho Mail REST API.
 *
 * Handles Zoho OAuth headers, regional Mail API base URLs, mailbox endpoints,
 * and safe raw relative API calls for advanced account operations.
 */
class ZohoMailService
{
    /**
     * @param  string  $accessToken  Zoho Mail OAuth access token.
     * @param  string  $baseUrl  Regional Zoho Mail API base URL.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://mail.zoho.com/api',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with an access token.
     */
    public function isConfigured(): bool
    {
        return $this->accessToken !== '';
    }

    /**
     * List Zoho Mail accounts available to the token.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->listAccounts();
    }

    /**
     * List Zoho Mail accounts available to the token.
     *
     * @return array<string, mixed>
     */
    public function listAccounts(): array
    {
        return $this->apiGet('/accounts');
    }

    /**
     * Get details for one Zoho Mail account.
     *
     * @param  string  $accountId  Zoho Mail account ID.
     * @return array<string, mixed>
     */
    public function getAccount(string $accountId): array
    {
        return $this->apiGet('/accounts/' . rawurlencode($accountId));
    }

    /**
     * List email messages using the official messages/view endpoint.
     *
     * @param  string  $accountId  Zoho Mail account ID.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listMessages(string $accountId, array $params = []): array
    {
        return $this->apiGet("/accounts/{$accountId}/messages/view", $params);
    }

    /**
     * Search email messages using the official messages/search endpoint.
     *
     * @param  string  $accountId  Zoho Mail account ID.
     * @param  array<string, mixed>  $params  Search query parameters.
     * @return array<string, mixed>
     */
    public function searchMessages(string $accountId, array $params = []): array
    {
        return $this->apiGet("/accounts/{$accountId}/messages/search", $params);
    }

    /**
     * Get email content by account, folder, and message ID.
     *
     * @param  string  $accountId  Zoho Mail account ID.
     * @param  string  $folderId  Folder ID containing the message.
     * @param  string  $messageId  Message ID.
     * @param  bool  $includeBlockContent  Whether to include quoted block content.
     * @return array<string, mixed>
     */
    public function getMessage(string $accountId, string $folderId, string $messageId, bool $includeBlockContent = false): array
    {
        return $this->apiGet("/accounts/{$accountId}/folders/{$folderId}/messages/{$messageId}/content", [
            'includeBlockContent' => $includeBlockContent ? 'true' : 'false',
        ]);
    }

    /**
     * Get email metadata by account, folder, and message ID.
     *
     * @param  string  $accountId  Zoho Mail account ID.
     * @param  string  $folderId  Folder ID containing the message.
     * @param  string  $messageId  Message ID.
     * @return array<string, mixed>
     */
    public function getMessageDetails(string $accountId, string $folderId, string $messageId): array
    {
        return $this->apiGet("/accounts/{$accountId}/folders/{$folderId}/messages/{$messageId}/details");
    }

    /**
     * Get email headers by account, folder, and message ID.
     *
     * @param  string  $accountId  Zoho Mail account ID.
     * @param  string  $folderId  Folder ID containing the message.
     * @param  string  $messageId  Message ID.
     * @return array<string, mixed>
     */
    public function getMessageHeaders(string $accountId, string $folderId, string $messageId): array
    {
        return $this->apiGet("/accounts/{$accountId}/folders/{$folderId}/messages/{$messageId}/header");
    }

    /**
     * Get original MIME representation for a message.
     *
     * @param  string  $accountId  Zoho Mail account ID.
     * @param  string  $messageId  Message ID.
     * @return array<string, mixed>
     */
    public function getOriginalMessage(string $accountId, string $messageId): array
    {
        return $this->apiGet("/accounts/{$accountId}/messages/{$messageId}/originalmessage");
    }

    /**
     * Get attachment metadata for an email.
     *
     * @param  string  $accountId  Zoho Mail account ID.
     * @param  string  $folderId  Folder ID containing the message.
     * @param  string  $messageId  Message ID.
     * @return array<string, mixed>
     */
    public function getAttachmentInfo(string $accountId, string $folderId, string $messageId): array
    {
        return $this->apiGet("/accounts/{$accountId}/folders/{$folderId}/messages/{$messageId}/attachmentinfo");
    }

    /**
     * Get attachment content for an email.
     *
     * @param  string  $accountId  Zoho Mail account ID.
     * @param  string  $folderId  Folder ID containing the message.
     * @param  string  $messageId  Message ID.
     * @param  string  $attachmentId  Attachment ID.
     * @return array<string, mixed>
     */
    public function getAttachmentContent(string $accountId, string $folderId, string $messageId, string $attachmentId): array
    {
        return $this->apiGet("/accounts/{$accountId}/folders/{$folderId}/messages/{$messageId}/attachments/{$attachmentId}");
    }

    /**
     * Send a new email message or save a draft/template using Zoho payload fields.
     *
     * @param  string  $accountId  Zoho Mail account ID.
     * @param  array<string, mixed>  $data  Message payload.
     * @return array<string, mixed>
     */
    public function sendMessage(string $accountId, array $data): array
    {
        return $this->apiPost("/accounts/{$accountId}/messages", $data);
    }

    /**
     * Reply to an existing email message.
     *
     * @param  string  $accountId  Zoho Mail account ID.
     * @param  string  $messageId  Message ID.
     * @param  array<string, mixed>  $data  Reply payload.
     * @return array<string, mixed>
     */
    public function replyMessage(string $accountId, string $messageId, array $data): array
    {
        return $this->apiPost("/accounts/{$accountId}/messages/{$messageId}", $data);
    }

    /**
     * Update one or more messages through the updatemessage endpoint.
     *
     * @param  string  $accountId  Zoho Mail account ID.
     * @param  array<string, mixed>  $payload  Update payload, including mode.
     * @return array<string, mixed>
     */
    public function updateMessages(string $accountId, array $payload): array
    {
        return $this->apiPut("/accounts/{$accountId}/updatemessage", $payload);
    }

    /**
     * Delete one email by account, folder, and message ID.
     *
     * @param  string  $accountId  Zoho Mail account ID.
     * @param  string  $folderId  Folder ID containing the message.
     * @param  string  $messageId  Message ID.
     * @return array<string, mixed>
     */
    public function deleteMessage(string $accountId, string $folderId, string $messageId): array
    {
        return $this->apiDelete("/accounts/{$accountId}/folders/{$folderId}/messages/{$messageId}");
    }

    /**
     * List folders for an account.
     *
     * @param  string  $accountId  Zoho Mail account ID.
     * @return array<string, mixed>
     */
    public function listFolders(string $accountId): array
    {
        return $this->apiGet("/accounts/{$accountId}/folders");
    }

    /**
     * Get one folder by ID.
     *
     * @param  string  $accountId  Zoho Mail account ID.
     * @param  string  $folderId  Folder ID.
     * @return array<string, mixed>
     */
    public function getFolder(string $accountId, string $folderId): array
    {
        return $this->apiGet("/accounts/{$accountId}/folders/{$folderId}");
    }

    /**
     * Create a folder.
     *
     * @param  string  $accountId  Zoho Mail account ID.
     * @param  array<string, mixed>  $payload  Folder creation payload.
     * @return array<string, mixed>
     */
    public function createFolder(string $accountId, array $payload): array
    {
        return $this->apiPost("/accounts/{$accountId}/folders", $payload);
    }

    /**
     * Update, rename, move, empty, or toggle IMAP view for a folder.
     *
     * @param  string  $accountId  Zoho Mail account ID.
     * @param  string  $folderId  Folder ID.
     * @param  array<string, mixed>  $payload  Folder update payload.
     * @return array<string, mixed>
     */
    public function updateFolder(string $accountId, string $folderId, array $payload): array
    {
        return $this->apiPut("/accounts/{$accountId}/folders/{$folderId}", $payload);
    }

    /**
     * Delete a folder.
     *
     * @param  string  $accountId  Zoho Mail account ID.
     * @param  string  $folderId  Folder ID.
     * @return array<string, mixed>
     */
    public function deleteFolder(string $accountId, string $folderId): array
    {
        return $this->apiDelete("/accounts/{$accountId}/folders/{$folderId}");
    }

    /**
     * List labels for an account.
     *
     * @param  string  $accountId  Zoho Mail account ID.
     * @return array<string, mixed>
     */
    public function listLabels(string $accountId): array
    {
        return $this->apiGet("/accounts/{$accountId}/labels");
    }

    /**
     * Get a label by ID.
     *
     * @param  string  $accountId  Zoho Mail account ID.
     * @param  string  $labelId  Label ID.
     * @return array<string, mixed>
     */
    public function getLabel(string $accountId, string $labelId): array
    {
        return $this->apiGet("/accounts/{$accountId}/labels/{$labelId}");
    }

    /**
     * Create a label.
     *
     * @param  string  $accountId  Zoho Mail account ID.
     * @param  array<string, mixed>  $payload  Label creation payload.
     * @return array<string, mixed>
     */
    public function createLabel(string $accountId, array $payload): array
    {
        return $this->apiPost("/accounts/{$accountId}/labels", $payload);
    }

    /**
     * Update a label.
     *
     * @param  string  $accountId  Zoho Mail account ID.
     * @param  string  $labelId  Label ID.
     * @param  array<string, mixed>  $payload  Label update payload.
     * @return array<string, mixed>
     */
    public function updateLabel(string $accountId, string $labelId, array $payload): array
    {
        return $this->apiPut("/accounts/{$accountId}/labels/{$labelId}", $payload);
    }

    /**
     * Delete a label.
     *
     * @param  string  $accountId  Zoho Mail account ID.
     * @param  string  $labelId  Label ID.
     * @return array<string, mixed>
     */
    public function deleteLabel(string $accountId, string $labelId): array
    {
        return $this->apiDelete("/accounts/{$accountId}/labels/{$labelId}");
    }

    /**
     * List tasks for an account.
     *
     * @param  string  $accountId  Zoho Mail account ID.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listTasks(string $accountId, array $params = []): array
    {
        return $this->apiGet("/accounts/{$accountId}/tasks", $params);
    }

    /**
     * Make a safe relative GET request.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array
    {
        return $this->request('GET', $path, [], $query);
    }

    /**
     * Make a safe relative POST request.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $body  JSON body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $body = [], array $query = []): array
    {
        return $this->request('POST', $path, $body, $query);
    }

    /**
     * Make a safe relative PUT request.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $body  JSON body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $body = [], array $query = []): array
    {
        return $this->request('PUT', $path, $body, $query);
    }

    /**
     * Make a safe relative DELETE request.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $query = []): array
    {
        return $this->request('DELETE', $path, [], $query);
    }

    /**
     * Make an API request and return parsed JSON or raw body.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $body  Request body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $body = [], array $query = []): array
    {
        $response = $this->rawRequest($method, $path, $body, $query);
        $json = $response->json();

        return is_array($json) ? $json : ['raw' => $response->body()];
    }

    /**
     * Make a raw HTTP request to the Zoho Mail API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $body  Request body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return Response
     */
    private function rawRequest(string $method, string $path, array $body = [], array $query = []): Response
    {
        $url = $this->buildUrl($path, $query);

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Zoho-oauthtoken ' . $this->requireAccessToken(),
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url),
                'POST' => $http->post($url, $body),
                'PUT' => $http->put($url, $body),
                'DELETE' => $http->delete($url),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $contentType = (string) $response->header('Content-Type');
                $bodyText = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($bodyText), '<!DOCTYPE')) {
                    Log::warning("Zoho Mail API returned HTML for {$method} {$path}", ['status' => $response->status()]);
                    throw new \RuntimeException("Zoho Mail API endpoint not available (HTTP {$response->status()}). Check the regional base URL.");
                }

                $error = $response->json('data.errorMessage') ?? $response->json('error') ?? $response->json('message') ?? $bodyText;
                Log::error("Zoho Mail API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Zoho Mail API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Zoho Mail API connection error: {$method} {$path}", ['error' => $e->getMessage()]);
            throw new \RuntimeException("Failed to connect to Zoho Mail API: {$e->getMessage()}");
        }
    }

    /**
     * Return an access token or throw a clear configuration error.
     */
    private function requireAccessToken(): string
    {
        if (! $this->isConfigured()) {
            throw new \RuntimeException('Zoho Mail access token is not configured.');
        }

        return $this->accessToken;
    }

    /**
     * Convert a safe relative path and query array into a full URL.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $query  Query parameters.
     */
    private function buildUrl(string $path, array $query): string
    {
        $path = '/' . ltrim($path, '/');

        if (str_contains($path, '://') || str_starts_with($path, '//') || str_contains($path, '..')) {
            throw new \RuntimeException('Zoho Mail API path must be a safe relative path.');
        }

        $query = array_filter($query, static fn ($value): bool => $value !== null && $value !== '');
        $queryString = $this->queryString($query);

        return $this->baseUrl . $path . ($queryString === '' ? '' : '?' . $queryString);
    }

    /**
     * Build a query string while preserving repeated array values.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     */
    private function queryString(array $query): string
    {
        $parts = [];

        foreach ($query as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $entry) {
                    if ($entry !== null && $entry !== '') {
                        $parts[] = rawurlencode((string) $key) . '=' . rawurlencode((string) $entry);
                    }
                }

                continue;
            }

            $parts[] = rawurlencode((string) $key) . '=' . rawurlencode((string) $value);
        }

        return implode('&', $parts);
    }
}
