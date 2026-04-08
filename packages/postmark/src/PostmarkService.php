<?php

namespace OpenCompany\Integrations\Postmark;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Postmark REST API covering email sending, messages, templates, and servers.
 *
 * Wraps HTTP calls to Postmark's API endpoints with Bearer token authentication
 * passed via the X-Postmark-Server-Token header on every request.
 */
class PostmarkService
{
    /**
     * @param  string  $serverToken  Postmark Server API token
     * @param  string  $baseUrl      Postmark API base URL
     */
    public function __construct(
        private string $serverToken = '',
        private string $baseUrl = 'https://api.postmarkapp.com',
    ) {}

    /**
     * Check whether the service has the minimum required configuration.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->serverToken);
    }

    // ── Connection ──────────────────────────────────────────

    /**
     * Test the connection by fetching the current server info.
     *
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(): array
    {
        try {
            $result = $this->request('GET', '/server');
            $name = $result['Name'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to Postmark server: {$name}.",
            ];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    // ── Messages ────────────────────────────────────────────

    /**
     * List outbound messages.
     *
     * @param  array<string, mixed>  $params  Query params (count, offset, recipient, fromemail, subject, status, tag)
     * @return array<string, mixed>
     */
    public function listMessages(array $params = []): array
    {
        return $this->request('GET', '/messages/outbound', $params);
    }

    /**
     * Get details for a single outbound message.
     *
     * @param  string  $messageId  Postmark message ID
     * @return array<string, mixed>
     */
    public function getMessage(string $messageId): array
    {
        return $this->request('GET', "/messages/outbound/{$messageId}/details");
    }

    // ── Email ───────────────────────────────────────────────

    /**
     * Send an email through Postmark.
     *
     * @param  array<string, mixed>  $params  Email parameters (To, From, Subject, TextBody, HtmlBody, Cc, Bcc, Tag, ReplyTo)
     * @return array<string, mixed>
     */
    public function sendEmail(array $params): array
    {
        return $this->request('POST', '/email', $params);
    }

    // ── Templates ───────────────────────────────────────────

    /**
     * List all templates.
     *
     * @param  array<string, mixed>  $params  Query params (count, offset)
     * @return array<string, mixed>
     */
    public function listTemplates(array $params = []): array
    {
        return $this->request('GET', '/templates', $params);
    }

    /**
     * Get details for a single template.
     *
     * @param  string  $templateId  Postmark template ID
     * @return array<string, mixed>
     */
    public function getTemplate(string $templateId): array
    {
        return $this->request('GET', "/templates/{$templateId}");
    }

    // ── Template Email ──────────────────────────────────────

    /**
     * Send an email using a Postmark template.
     *
     * @param  array<string, mixed>  $params  Email parameters (From, To, TemplateId or TemplateAlias, TemplateModel)
     * @return array<string, mixed>
     */
    public function sendTemplateEmail(array $params): array
    {
        return $this->request('POST', '/email/withTemplate', $params);
    }

    // ── Delivery Stats ──────────────────────────────────────

    /**
     * Get delivery statistics for the server.
     *
     * @return array<string, mixed>
     */
    public function getDeliveryStats(): array
    {
        return $this->request('GET', '/stats/outbound');
    }

    // ── Servers ─────────────────────────────────────────────

    /**
     * List servers (requires Account API token).
     *
     * @param  array<string, mixed>  $params  Query params (count, offset, name)
     * @return array<string, mixed>
     */
    public function listServers(array $params = []): array
    {
        return $this->request('GET', '/servers', $params);
    }

    // ── Account / Server Info ───────────────────────────────

    /**
     * Get the current server info (associated with the server token).
     *
     * @return array<string, mixed>
     */
    public function getCurrentServer(): array
    {
        return $this->request('GET', '/server');
    }

    // ── HTTP ─────────────────────────────────────────────────

    /**
     * Make an API request to Postmark.
     *
     * Sends Bearer token via X-Postmark-Server-Token header on every request.
     *
     * @param  string                 $method  HTTP method (GET, POST, PUT, DELETE)
     * @param  string                 $path    API path (e.g. /email, /messages/outbound)
     * @param  array<string, mixed>  $data    Query params (GET) or JSON body (POST/PUT)
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->isConfigured()) {
            throw new \RuntimeException('Postmark server token is not configured.');
        }

        $baseUrl = rtrim($this->baseUrl, '/');
        $url = $baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'X-Postmark-Server-Token' => $this->serverToken,
                'Accept' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET'    => $http->get($url, $data),
                'POST'   => $http->post($url, $data),
                'PUT'    => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default  => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                Log::error("Postmark API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);

                throw new \RuntimeException("Postmark API error ({$response->status()}): {$response->body()}");
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Postmark API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Postmark API: {$e->getMessage()}");
        }
    }
}
