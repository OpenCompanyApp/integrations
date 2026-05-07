<?php

namespace OpenCompany\Integrations\MailerSend;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the MailerSend API.
 *
 * Handles bearer authentication, safe URL construction, error parsing, and
 * convenience methods for MailerSend email operations.
 */
class MailerSendService
{
    /**
     * Create a new MailerSendService instance.
     *
     * @param  string  $apiToken  The MailerSend API token for Bearer auth.
     * @param  string  $baseUrl  The MailerSend API base URL.
     */
    public function __construct(
        private string $apiToken = '',
        private string $baseUrl = 'https://api.mailersend.com/v1',
    ) {
        $this->baseUrl = rtrim($baseUrl, '/');
    }

    /**
     * Check whether the service is properly configured with an API token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiToken);
    }

    /**
     * List messages from the MailerSend account.
     *
     * @param  int  $limit  Number of results per page.
     * @param  int  $page   Page number for pagination.
     * @return array<string, mixed>
     */
    public function listMessages(int $limit = 25, int $page = 1): array
    {
        return $this->request('GET', '/messages', [
            'limit' => $limit,
            'page' => $page,
        ]);
    }

    /**
     * Get a single message by its ID.
     *
     * @param  string  $id  The message ID.
     * @return array<string, mixed>
     */
    public function getMessage(string $id): array
    {
        return $this->request('GET', '/messages/' . urlencode($id));
    }

    /**
     * Send an email through the MailerSend API.
     *
     * @param  array{email: string, name?: string}  $from  Sender email and name.
     * @param  array<int, array{email: string, name?: string}>  $to  Recipients.
     * @param  string  $subject  Email subject line.
     * @param  string|null  $html  Optional HTML body.
     * @param  string|null  $text  Optional plain text body.
     * @param  array<string, mixed>  $options  Optional MailerSend email fields.
     * @return array<string, mixed>
     */
    public function sendEmail(array $from, array $to, string $subject, ?string $html = null, ?string $text = null, array $options = []): array
    {
        $payload = array_merge($options, [
            'from' => $from,
            'to' => $to,
            'subject' => $subject,
        ]);

        if ($html !== null) {
            $payload['html'] = $html;
        }

        if ($text !== null) {
            $payload['text'] = $text;
        }

        return $this->request('POST', '/email', body: $payload);
    }

    /**
     * Send a bulk email payload through MailerSend.
     *
     * @param  array<int, array<string, mixed>>  $messages  Bulk email message payloads.
     * @return array<string, mixed>
     */
    public function sendBulkEmail(array $messages): array
    {
        return $this->request('POST', '/bulk-email', body: $messages);
    }

    /**
     * List email templates.
     *
     * @param  int  $limit  Number of results per page.
     * @param  int  $page   Page number for pagination.
     * @return array<string, mixed>
     */
    public function listTemplates(int $limit = 25, int $page = 1): array
    {
        return $this->request('GET', '/templates', [
            'limit' => $limit,
            'page' => $page,
        ]);
    }

    /**
     * List domains configured in the MailerSend account.
     *
     * @param  int  $limit     Number of results per page.
     * @param  int  $page      Page number for pagination.
     * @param  bool|null  $verified  Filter by verification status.
     * @return array<string, mixed>
     */
    public function listDomains(int $limit = 25, int $page = 1, ?bool $verified = null): array
    {
        $params = [
            'limit' => $limit,
            'page' => $page,
        ];

        if ($verified !== null) {
            $params['verified'] = $verified ? 'true' : 'false';
        }

        return $this->request('GET', '/domains', $params);
    }

    /**
     * List recipients from the MailerSend account.
     *
     * @param  int  $limit  Number of results per page.
     * @param  int  $page   Page number for pagination.
     * @return array<string, mixed>
     */
    public function listRecipients(int $limit = 25, int $page = 1): array
    {
        return $this->request('GET', '/recipients', [
            'limit' => $limit,
            'page' => $page,
        ]);
    }

    /**
     * Make a generic GET request to a safe MailerSend API path.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array
    {
        return $this->request('GET', $path, query: $query);
    }

    /**
     * Make a generic POST request to a safe MailerSend API path.
     *
     * @param  array<string, mixed>  $body  JSON body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $body = [], array $query = []): array
    {
        return $this->request('POST', $path, query: $query, body: $body);
    }

    /**
     * Make a generic PUT request to a safe MailerSend API path.
     *
     * @param  array<string, mixed>  $body  JSON body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $body = [], array $query = []): array
    {
        return $this->request('PUT', $path, query: $query, body: $body);
    }

    /**
     * Make a generic DELETE request to a safe MailerSend API path.
     *
     * @param  array<string, mixed>  $body  JSON body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $body = [], array $query = []): array
    {
        return $this->request('DELETE', $path, query: $query, body: $body);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $body  Request body.
     * @return array<string, mixed>
     *
     * @throws RuntimeException When the request fails.
     */
    private function request(string $method, string $path, array $query = [], array $body = []): array
    {
        $response = $this->rawRequest($method, $path, $query, $body);

        if ($response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the MailerSend API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API endpoint path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @param  array<string, mixed>  $body  Request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws RuntimeException When not configured or the request fails.
     */
    private function rawRequest(string $method, string $path, array $query = [], array $body = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiToken) {
            throw new RuntimeException('MailerSend API token is not configured.');
        }

        $url = $this->buildUrl($path, $query);

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url),
                'POST' => $http->post($url, $body),
                'PUT' => $http->put($url, $body),
                'DELETE' => $http->delete($url, $body),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = (string) $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("MailerSend API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new RuntimeException("MailerSend API endpoint not available (HTTP {$response->status()}).");
                }

                $error = $response->json('message') ?? $body;
                Log::error("MailerSend API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new RuntimeException("MailerSend API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("MailerSend API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new RuntimeException("Failed to connect to MailerSend API: {$e->getMessage()}");
        }
    }

    /**
     * Build a safe MailerSend API URL.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     */
    private function buildUrl(string $path, array $query = []): string
    {
        if (preg_match('/^https?:\/\//i', $path) === 1 || str_contains($path, '..')) {
            throw new RuntimeException('MailerSend API path must be a safe relative path.');
        }

        $queryString = $this->buildQuery($query);

        return $this->baseUrl.'/'.ltrim($path, '/').($queryString !== '' ? '?'.$queryString : '');
    }

    /**
     * Build query strings with repeated array values for MailerSend filters.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     */
    private function buildQuery(array $query): string
    {
        $pairs = [];

        foreach ($query as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }

            if (is_bool($value)) {
                $value = $value ? 'true' : 'false';
            }

            if (is_array($value)) {
                foreach ($value as $item) {
                    $queryKey = str_ends_with((string) $key, '[]') ? (string) $key : (string) $key.'[]';
                    $pairs[] = rawurlencode($queryKey).'='.rawurlencode(is_scalar($item) ? (string) $item : json_encode($item, JSON_THROW_ON_ERROR));
                }
                continue;
            }

            $pairs[] = rawurlencode((string) $key).'='.rawurlencode((string) $value);
        }

        return implode('&', $pairs);
    }
}
