<?php

namespace OpenCompany\Integrations\Resend;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Resend REST API covering email delivery, domain management,
 * API key management, and audience contacts.
 *
 * Authentication uses a Bearer API key via the Authorization header.
 */
class ResendService
{
    private const BASE_URL = 'https://api.resend.com';

    /** @param string $apiKey Resend API key */
    public function __construct(
        private string $apiKey = '',
    ) {}

    /**
     * Check whether the API key is configured.
     *
     * @return bool
     */
    public function isConfigured(): bool
    {
        return ! empty($this->apiKey);
    }

    // ── Emails ─────────────────────────────────────────

    /**
     * Send an email via the Resend API.
     *
     * @param  string                $to       Recipient email address (or array of addresses).
     * @param  string                $from     Sender email address.
     * @param  string                $subject  Email subject line.
     * @param  string|null           $html     HTML body content.
     * @param  string|null           $text     Plain-text body content.
     * @param  string|array|null     $cc       CC recipient email address(es).
     * @param  string|array|null     $bcc      BCC recipient email address(es).
     * @param  string|array|null     $replyTo  Reply-to email address(es).
     * @param  array<int, array>     $tags     Tags to attach to the email. Each tag is ['name' => string, 'value' => string].
     * @param  array<string, string> $headers  Custom email headers.
     * @return array<string, mixed>  The sent email object with id.
     */
    public function sendEmail(
        string $to,
        string $from,
        string $subject,
        ?string $html = null,
        ?string $text = null,
        string|array|null $cc = null,
        string|array|null $bcc = null,
        string|array|null $replyTo = null,
        array $tags = [],
        array $headers = [],
    ): array {
        $payload = array_filter([
            'from' => $from,
            'to' => [$to],
            'subject' => $subject,
            'html' => $html,
            'text' => $text,
            'cc' => is_array($cc) ? $cc : ($cc !== null ? [$cc] : null),
            'bcc' => is_array($bcc) ? $bcc : ($bcc !== null ? [$bcc] : null),
            'reply_to' => is_array($replyTo) ? $replyTo : ($replyTo !== null ? [$replyTo] : null),
            'tags' => ! empty($tags) ? $tags : null,
            'headers' => ! empty($headers) ? $headers : null,
        ], fn ($value) => $value !== null);

        return $this->request('POST', '/emails', $payload);
    }

    /**
     * Get a single email by ID.
     *
     * @param  string              $emailId  The email ID returned by sendEmail.
     * @return array<string, mixed>
     */
    public function getEmail(string $emailId): array
    {
        return $this->request('GET', "/emails/{$emailId}");
    }

    /**
     * List emails with optional pagination.
     *
     * @param  int|null     $limit  Maximum number of emails to return.
     * @param  string|null  $token  Cursor token for pagination.
     * @return array<string, mixed>
     */
    public function listEmails(?int $limit = null, ?string $token = null): array
    {
        $params = array_filter([
            'limit' => $limit,
            'token' => $token,
        ], fn ($value) => $value !== null);

        return $this->request('GET', '/emails', $params);
    }

    // ── API Keys ───────────────────────────────────────

    /**
     * Create a new API key.
     *
     * @param  string       $name        Name for the API key.
     * @param  string|null  $permission  Permission scope: "full_access" or "sending_access".
     * @param  string|null  $domainId    Domain ID to restrict the key to.
     * @return array<string, mixed>  The created API key object.
     */
    public function createApiKey(
        string $name,
        ?string $permission = null,
        ?string $domainId = null,
    ): array {
        $payload = array_filter([
            'name' => $name,
            'permission' => $permission,
            'domain_id' => $domainId,
        ], fn ($value) => $value !== null);

        return $this->request('POST', '/api-keys', $payload);
    }

    /**
     * List all API keys.
     *
     * @return array<string, mixed>
     */
    public function listApiKeys(): array
    {
        return $this->request('GET', '/api-keys');
    }

    // ── Domains ────────────────────────────────────────

    /**
     * Create a new domain.
     *
     * @param  string       $name    Domain name (e.g. "example.com").
     * @param  string|null  $region  Region for the domain: "us-east-1" or "eu-west-1".
     * @return array<string, mixed>  The created domain object.
     */
    public function createDomain(string $name, ?string $region = null): array
    {
        $payload = array_filter([
            'name' => $name,
            'region' => $region,
        ], fn ($value) => $value !== null);

        return $this->request('POST', '/domains', $payload);
    }

    /**
     * Get a single domain by ID.
     *
     * @param  string  $domainId  The domain ID.
     * @return array<string, mixed>
     */
    public function getDomain(string $domainId): array
    {
        return $this->request('GET', "/domains/{$domainId}");
    }

    /**
     * List all domains.
     *
     * @return array<string, mixed>
     */
    public function listDomains(): array
    {
        return $this->request('GET', '/domains');
    }

    /**
     * Verify a domain by ID.
     *
     * @param  string  $domainId  The domain ID to verify.
     * @return array<string, mixed>
     */
    public function verifyDomain(string $domainId): array
    {
        return $this->request('POST', "/domains/{$domainId}/verify");
    }

    // ── Contacts ───────────────────────────────────────

    /**
     * Create a contact in an audience.
     *
     * @param  string       $audienceId   The audience ID to add the contact to.
     * @param  string       $email        Contact email address.
     * @param  string|null  $firstName    Contact first name.
     * @param  string|null  $lastName     Contact last name.
     * @param  bool|null    $unsubscribed Whether the contact is unsubscribed.
     * @return array<string, mixed>  The created contact object.
     */
    public function createContact(
        string $audienceId,
        string $email,
        ?string $firstName = null,
        ?string $lastName = null,
        ?bool $unsubscribed = null,
    ): array {
        $payload = array_filter([
            'email' => $email,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'unsubscribed' => $unsubscribed,
        ], fn ($value) => $value !== null);

        return $this->request('POST', "/audiences/{$audienceId}/contacts", $payload);
    }

    // ── HTTP ───────────────────────────────────────────

    /**
     * Send an authenticated request to the Resend API.
     *
     * @param  string                $method  HTTP method (GET, POST, PUT, PATCH, DELETE).
     * @param  string                $path    API path (e.g. /emails).
     * @param  array<string, mixed>  $data    Query params (GET) or JSON body (POST/PUT/PATCH).
     * @return array<string, mixed>
     *
     * @throws \RuntimeException If the API key is missing or the request fails.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->isConfigured()) {
            throw new \RuntimeException('Resend API key is not configured.');
        }

        $url = self::BASE_URL . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET'    => $http->get($url, $data),
                'POST'   => $http->post($url, $data),
                'PUT'    => $http->put($url, $data),
                'PATCH'  => $http->patch($url, $data),
                'DELETE' => $http->delete($url, $data),
                default  => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if ($response->failed()) {
                $body = $response->json();
                $message = $body['message'] ?? $response->body();

                Log::error('Resend API error', [
                    'method' => $method,
                    'path'   => $path,
                    'status' => $response->status(),
                    'body'   => $body,
                ]);

                throw new \RuntimeException("Resend API error ({$response->status()}): {$message}");
            }

            return $response->json() ?? [];
        } catch (ConnectionException $e) {
            Log::error('Resend connection error', ['method' => $method, 'path' => $path, 'error' => $e->getMessage()]);
            throw new \RuntimeException("Resend connection error: {$e->getMessage()}");
        }
    }
}
