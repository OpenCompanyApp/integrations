<?php

namespace OpenCompany\Integrations\Gorgias;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GorgiasService
{
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://api.gorgias.com/v1',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * Get the authenticated user's profile.
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /**
     * List tickets with optional filters.
     *
     * @param  int|null  $page   Page number (1-based).
     * @param  int|null  $limit  Results per page (max 100).
     * @param  string|null  $status  Filter by status: open, closed, spam.
     * @param  string|null  $q  Search query.
     */
    public function listTickets(?int $page = null, ?int $limit = null, ?string $status = null, ?string $q = null): array
    {
        $params = array_filter([
            'page' => $page,
            'limit' => $limit,
            'status' => $status,
            'q' => $q,
        ], fn ($value) => $value !== null);

        return $this->request('GET', '/tickets', $params);
    }

    /**
     * Get a single ticket by ID.
     */
    public function getTicket(string $id): array
    {
        return $this->request('GET', '/tickets/' . urlencode($id));
    }

    /**
     * Create a new ticket.
     *
     * @param  string  $subject   Ticket subject.
     * @param  string  $body      Ticket body / message content.
     * @param  string|null  $fromEmail  Sender email address.
     * @param  string|null  $toEmail    Recipient email address.
     * @param  string|null  $channel   Ticket channel (e.g., "email", "chat", "facebook", "instagram").
     * @param  string|null  $priority  Ticket priority: "normal", "urgent", "high", "low".
     */
    public function createTicket(string $subject, string $body, ?string $fromEmail = null, ?string $toEmail = null, ?string $channel = null, ?string $priority = null): array
    {
        $data = array_filter([
            'subject' => $subject,
            'body' => $body,
            'from' => $fromEmail ? ['address' => $fromEmail] : null,
            'to' => $toEmail ? [['address' => $toEmail]] : null,
            'channel' => $channel,
            'priority' => $priority,
        ], fn ($value) => $value !== null);

        return $this->request('POST', '/tickets', $data);
    }

    /**
     * List customers with optional filters.
     *
     * @param  int|null  $page   Page number (1-based).
     * @param  int|null  $limit  Results per page (max 100).
     * @param  string|null  $q  Search query (name, email, etc.).
     */
    public function listCustomers(?int $page = null, ?int $limit = null, ?string $q = null): array
    {
        $params = array_filter([
            'page' => $page,
            'limit' => $limit,
            'q' => $q,
        ], fn ($value) => $value !== null);

        return $this->request('GET', '/customers', $params);
    }

    /**
     * Get a single customer by ID.
     */
    public function getCustomer(string $id): array
    {
        return $this->request('GET', '/customers/' . urlencode($id));
    }

    /**
     * List satisfaction surveys with optional filters.
     *
     * @param  int|null  $page   Page number (1-based).
     * @param  int|null  $limit  Results per page (max 100).
     * @param  string|null  $ticketId  Filter by ticket ID.
     */
    public function listSatisfactionSurveys(?int $page = null, ?int $limit = null, ?string $ticketId = null): array
    {
        $params = array_filter([
            'page' => $page,
            'limit' => $limit,
            'ticket_id' => $ticketId,
        ], fn ($value) => $value !== null);

        return $this->request('GET', '/satisfaction-surveys', $params);
    }

    /**
     * Make an API request and return parsed JSON.
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
     * Make a raw HTTP request to the Gorgias API.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Gorgias access token is not configured.');
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

                if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Gorgias API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Gorgias API endpoint not available (HTTP {$response->status()}). The URL may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Gorgias API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Gorgias API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Gorgias API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Gorgias API: {$e->getMessage()}");
        }
    }
}
