<?php

namespace OpenCompany\Integrations\ElasticEmail;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ElasticEmailService
{
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.elasticemail.com/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Send a transactional email.
     *
     * @param  string|array<string>  $to  Recipient email address(es).
     * @param  string  $subject  Email subject line.
     * @param  string  $body  HTML body content.
     * @param  array  $options  Additional options (from, reply_to, cc, bcc, etc.).
     * @return array API response data.
     */
    public function sendEmail(string|array $to, string $subject, string $body, array $options = []): array
    {
        $data = array_merge([
            'to' => is_array($to) ? implode(';', $to) : $to,
            'subject' => $subject,
            'bodyHtml' => $body,
        ], $options);

        return $this->request('POST', '/emails/transactional', $data);
    }

    /**
     * List email templates.
     *
     * @param  int  $limit  Maximum number of templates to return.
     * @param  int  $offset  Offset for pagination.
     * @return array API response data.
     */
    public function listTemplates(int $limit = 100, int $offset = 0): array
    {
        return $this->request('GET', '/templates', [
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }

    /**
     * Get a specific template by ID.
     *
     * @param  int|string  $id  The template ID.
     * @return array API response data.
     */
    public function getTemplate(int|string $id): array
    {
        return $this->request('GET', '/templates/' . urlencode((string) $id));
    }

    /**
     * List contacts from the account.
     *
     * @param  int  $limit  Maximum number of contacts to return.
     * @param  int  $offset  Offset for pagination.
     * @return array API response data.
     */
    public function listContacts(int $limit = 100, int $offset = 0): array
    {
        return $this->request('GET', '/contacts', [
            'limit' => $limit,
            'offset' => $offset,
        ]);
    }

    /**
     * Create or add a contact.
     *
     * @param  string  $email  Contact email address.
     * @param  string|null  $listName  Optional list name to add the contact to.
     * @param  array  $options  Additional contact fields (first_name, last_name, etc.).
     * @return array API response data.
     */
    public function createContact(string $email, ?string $listName = null, array $options = []): array
    {
        $data = array_merge([
            'email' => $email,
        ], $options);

        if ($listName !== null) {
            $data['listName'] = $listName;
        }

        return $this->request('POST', '/contacts', $data);
    }

    /**
     * Get current authenticated user information.
     *
     * @return array API response data.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Elastic Email API.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Elastic Email API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'X-ElasticEmail-ApiKey' => $this->apiKey,
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
                    Log::warning("Elastic Email API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Elastic Email API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect.");
                }

                $error = $response->json('error') ?? $body;
                Log::error("Elastic Email API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Elastic Email API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Elastic Email API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Elastic Email API: {$e->getMessage()}");
        }
    }
}
