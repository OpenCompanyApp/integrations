<?php

namespace OpenCompany\Integrations\Sendgrid;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SendgridService
{
    private string $baseUrl = 'https://api.sendgrid.com/v3';

    public function __construct(
        private string $apiKey = '',
    ) {}

    /**
     * Check whether the SendGrid service is configured with an API key.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * List emails with optional filtering and pagination.
     *
     * @param  array  $params  Query parameters (limit, query, etc.)
     * @return array The parsed JSON response from SendGrid.
     */
    public function listEmails(array $params = []): array
    {
        return $this->request('GET', '/messages', $params);
    }

    /**
     * Send an email via the SendGrid mail send API.
     *
     * @param  array  $data  Email payload (from, to, subject, content, etc.)
     * @return array The parsed JSON response from SendGrid.
     */
    public function sendEmail(array $data): array
    {
        return $this->request('POST', '/mail/send', $data);
    }

    /**
     * List email templates with optional pagination.
     *
     * @param  array  $params  Query parameters (page_size, page_token, etc.)
     * @return array The parsed JSON response from SendGrid.
     */
    public function listTemplates(array $params = []): array
    {
        return $this->request('GET', '/templates', $params);
    }

    /**
     * Get a specific template by its ID.
     *
     * @param  string  $id  The template ID.
     * @return array The parsed JSON response from SendGrid.
     */
    public function getTemplate(string $id): array
    {
        return $this->request('GET', '/templates/' . urlencode($id));
    }

    /**
     * List contacts with optional pagination.
     *
     * @param  array  $params  Query parameters (page_size, page_token, etc.)
     * @return array The parsed JSON response from SendGrid.
     */
    public function listContacts(array $params = []): array
    {
        return $this->request('GET', '/marketing/contacts', $params);
    }

    /**
     * Get a contact's details by their ID.
     *
     * @param  string  $id  The contact ID.
     * @return array The parsed JSON response from SendGrid.
     */
    public function getContact(string $id): array
    {
        return $this->request('GET', '/marketing/contacts/' . urlencode($id));
    }

    /**
     * Get the current authenticated user's profile.
     *
     * @return array The parsed JSON response from SendGrid.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/user/profile');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path (e.g. "/messages").
     * @param  array   $data    Query parameters (GET) or JSON body (POST/PUT).
     * @return array The parsed JSON response body.
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
     * Make a raw HTTP request to the SendGrid API.
     *
     * SendGrid authenticates via Bearer token in the Authorization header.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    API endpoint path.
     * @param  array   $data    Query parameters or JSON body.
     * @return \Illuminate\Http\Client\Response The raw HTTP response.
     *
     * @throws \RuntimeException If the API key is missing or the request fails.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('SendGrid API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
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
                $body = $response->body();
                $error = $response->json('errors.0.message') ?? $body;

                Log::error("SendGrid API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("SendGrid API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("SendGrid API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to SendGrid API: {$e->getMessage()}");
        }
    }
}
