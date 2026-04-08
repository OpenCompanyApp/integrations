<?php

namespace OpenCompany\Integrations\MailerSend;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MailerSendService
{
    /**
     * The API token used for Bearer authentication.
     */
    private string $apiToken;

    /**
     * The base URL for the MailerSend API.
     */
    private string $baseUrl;

    /**
     * Create a new MailerSendService instance.
     *
     * @param  string  $apiToken  The MailerSend API token for Bearer auth.
     * @param  string  $baseUrl   The MailerSend API base URL.
     */
    public function __construct(
        string $apiToken = '',
        string $baseUrl = 'https://api.mailersend.com/v1',
    ) {
        $this->apiToken = $apiToken;
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
     * @param  array{email: string, name: string}  $from     Sender email and name.
     * @param  array<int, array{email: string, name?: string}>  $to      Recipients.
     * @param  string  $subject  Email subject line.
     * @param  string|null  $html  Optional HTML body.
     * @param  string|null  $text  Optional plain text body.
     * @return array<string, mixed>
     */
    public function sendEmail(array $from, array $to, string $subject, ?string $html = null, ?string $text = null): array
    {
        $payload = [
            'from' => $from,
            'to' => $to,
            'subject' => $subject,
        ];

        if ($html !== null) {
            $payload['html'] = $html;
        }

        if ($text !== null) {
            $payload['text'] = $text;
        }

        return $this->request('POST', '/email', $payload);
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
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     *
     * @throws \RuntimeException When the request fails.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the MailerSend API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    API endpoint path.
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException When not configured or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiToken) {
            throw new \RuntimeException('MailerSend API token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiToken,
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

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("MailerSend API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("MailerSend API endpoint not available (HTTP {$response->status()}).");
                }

                $error = $response->json('message') ?? $body;
                Log::error("MailerSend API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("MailerSend API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("MailerSend API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to MailerSend API: {$e->getMessage()}");
        }
    }
}
