<?php

namespace OpenCompany\Integrations\Mailgun;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Mailgun API service — handles HTTP communication with the Mailgun v3 REST API.
 *
 * Uses HTTP Basic Auth with the API key as the username and an empty password.
 */
class MailgunService
{
    private string $baseUrl = 'https://api.mailgun.net/v3';

    public function __construct(
        private string $apiKey = '',
        private string $domain = '',
    ) {}

    /**
     * Check whether the Mailgun service is configured with an API key.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Get the configured sending domain.
     */
    public function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * List stored messages for a domain with optional pagination.
     *
     * @param  array  $params  Query parameters (limit, page, etc.)
     * @return array The parsed JSON response from Mailgun.
     */
    public function listMessages(array $params = []): array
    {
        $domain = $this->domain;

        return $this->request('GET', "/{$domain}/events", $params);
    }

    /**
     * Send an email message.
     *
     * @param  array  $data  Email payload (from, to, subject, text, html, etc.)
     * @return array The parsed JSON response from Mailgun.
     */
    public function sendEmail(array $data): array
    {
        $domain = $this->domain;

        return $this->request('POST', "/{$domain}/messages", $data, true);
    }

    /**
     * List all domains in the Mailgun account.
     *
     * @param  array  $params  Query parameters (limit, skip, etc.)
     * @return array The parsed JSON response from Mailgun.
     */
    public function listDomains(array $params = []): array
    {
        return $this->request('GET', '/domains', $params);
    }

    /**
     * Get details of a specific domain.
     *
     * @param  string  $domainName  The domain name to retrieve.
     * @return array The parsed JSON response from Mailgun.
     */
    public function getDomain(string $domainName): array
    {
        return $this->request('GET', "/domains/{$domainName}");
    }

    /**
     * List all routes in the Mailgun account.
     *
     * @param  array  $params  Query parameters (limit, skip, etc.)
     * @return array The parsed JSON response from Mailgun.
     */
    public function listRoutes(array $params = []): array
    {
        return $this->request('GET', '/routes', $params);
    }

    /**
     * List all webhooks for a domain.
     *
     * @param  string  $domainName  The domain name (defaults to configured domain).
     * @return array The parsed JSON response from Mailgun.
     */
    public function listWebhooks(string $domainName = ''): array
    {
        $domain = $domainName ?: $this->domain;

        return $this->request('GET', "/domains/{$domain}/webhooks");
    }

    /**
     * Get the current authenticated user / account info via domain listing.
     *
     * @return array The parsed JSON response from Mailgun.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/domains', ['limit' => 1]);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method     HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path       API endpoint path (e.g. "/domains").
     * @param  array   $data       Query parameters (GET) or form body (POST).
     * @param  bool    $asForm     Whether to send data as form-encoded (for message sending).
     * @return array The parsed JSON response body.
     */
    private function request(string $method, string $path, array $data = [], bool $asForm = false): array
    {
        $response = $this->rawRequest($method, $path, $data, $asForm);

        if ($response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Mailgun API.
     *
     * Mailgun authenticates via HTTP Basic Auth with the API key as the username.
     *
     * @param  string  $method     HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path       API endpoint path.
     * @param  array   $data       Query parameters or form body.
     * @param  bool    $asForm     Whether to send data as form-encoded.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the API key is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = [], bool $asForm = false): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Mailgun API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withBasicAuth($this->apiKey, '')
                ->withHeaders([
                    'Accept' => 'application/json',
                ])
                ->timeout(30);

            if ($asForm) {
                $http = $http->asForm();
            }

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $body = $response->body();
                $error = $response->json('message') ?? $body;

                Log::error("Mailgun API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Mailgun API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Mailgun API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Mailgun API: {$e->getMessage()}");
        }
    }
}
