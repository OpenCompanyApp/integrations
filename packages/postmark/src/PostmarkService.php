<?php

namespace OpenCompany\Integrations\Postmark;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PostmarkService
{
    public function __construct(
        private string $serverToken = '',
        private string $baseUrl = 'https://api.postmarkapp.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->serverToken);
    }

    /**
     * Send a single email.
     *
     * @param  array  $params  Email parameters (From, To, Subject, HtmlBody, TextBody, Tag, etc.)
     * @return array API response
     */
    public function sendEmail(array $params): array
    {
        return $this->request('POST', '/email', $params);
    }

    /**
     * Send an email using a template.
     *
     * @param  array  $params  Template email parameters (TemplateId or TemplateAlias, From, To, TemplateModel, etc.)
     * @return array API response
     */
    public function sendTemplateEmail(array $params): array
    {
        return $this->request('POST', '/email/withTemplate', $params);
    }

    /**
     * Get delivery statistics for the server.
     *
     * @return array Delivery stats
     */
    public function getDeliveryStats(): array
    {
        return $this->request('GET', '/deliverystats');
    }

    /**
     * List outbound messages.
     *
     * @param  int  $count  Number of messages to return (default 100, max 500)
     * @param  int  $offset  Offset for pagination
     * @param  string|null  $recipient  Filter by recipient email
     * @param  string|null  $status  Filter by status (queued, sent, bounced, etc.)
     * @return array Messages list
     */
    public function listMessages(int $count = 100, int $offset = 0, ?string $recipient = null, ?string $status = null): array
    {
        $params = [
            'count' => $count,
            'offset' => $offset,
        ];

        if ($recipient !== null) {
            $params['recipient'] = $recipient;
        }

        if ($status !== null) {
            $params['status'] = $status;
        }

        return $this->request('GET', '/messages/outbound', $params);
    }

    /**
     * Get details of a specific outbound message.
     *
     * @param  string  $messageId  The message ID
     * @return array Message details
     */
    public function getMessage(string $messageId): array
    {
        return $this->request('GET', '/messages/outbound/' . urlencode($messageId));
    }

    /**
     * List email templates.
     *
     * @param  int  $count  Number of templates to return (default 100, max 500)
     * @param  int  $offset  Offset for pagination
     * @return array Templates list
     */
    public function listTemplates(int $count = 100, int $offset = 0): array
    {
        return $this->request('GET', '/templates', [
            'count' => $count,
            'offset' => $offset,
        ]);
    }

    /**
     * Get server (account) information for the current user.
     *
     * @return array Server details
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/server');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method
     * @param  string  $path  API path
     * @param  array  $data  Request data (body for POST, query for GET)
     * @return array Parsed JSON response
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Postmark API.
     *
     * @param  string  $method  HTTP method
     * @param  string  $path  API path
     * @param  array  $data  Request data
     * @return \Illuminate\Http\Client\Response Raw response
     *
     * @throws \RuntimeException On connection or API errors
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->serverToken) {
            throw new \RuntimeException('Postmark server token is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'X-Postmark-Server-Token' => $this->serverToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
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
                    Log::warning("Postmark API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Postmark API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect or the server token may be invalid.");
                }

                $error = $response->json('Message') ?? $response->json('error') ?? $body;
                Log::error("Postmark API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Postmark API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Postmark API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Postmark API: {$e->getMessage()}");
        }
    }
}
