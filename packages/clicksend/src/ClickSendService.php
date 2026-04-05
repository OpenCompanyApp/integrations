<?php

namespace OpenCompany\Integrations\ClickSend;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the ClickSend REST API.
 *
 * Wraps HTTP calls to ClickSend's v3 REST endpoints for SMS, email,
 * voice, post letters, contacts, and account management using
 * HTTP Basic authentication (username + API key).
 */
class ClickSendService
{
    private const BASE_URL = 'https://rest.clicksend.com/v3';

    /**
     * @param  string  $username  ClickSend account username
     * @param  string  $apiKey    ClickSend API key
     */
    public function __construct(
        private string $username = '',
        private string $apiKey = '',
    ) {}

    /**
     * Check whether the service has credentials configured.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->username) && ! empty($this->apiKey);
    }

    // ── Account ──────────────────────────────────────────────

    /**
     * Get authenticated account details.
     *
     * @return array<string, mixed>
     */
    public function getAccount(): array
    {
        return $this->request('GET', '/account');
    }

    /**
     * Get the current account balance.
     *
     * @return array<string, mixed>
     */
    public function getAccountBalance(): array
    {
        return $this->request('GET', '/account/balance');
    }

    // ── SMS ──────────────────────────────────────────────────

    /**
     * Send one or more SMS messages.
     *
     * @param  array<int, array{to: string, body: string, from?: string}>  $messages  Array of message objects
     * @return array<string, mixed>
     */
    public function sendSms(array $messages): array
    {
        return $this->request('POST', '/sms/send', ['messages' => $messages]);
    }

    /**
     * Get SMS history with optional date filtering and pagination.
     *
     * @param  array<string, mixed>  $params  Query parameters (date_from, date_to, limit, page)
     * @return array<string, mixed>
     */
    public function getSmsHistory(array $params = []): array
    {
        return $this->request('GET', '/sms/history', $params);
    }

    /**
     * Get pricing for one or more SMS messages.
     *
     * @param  array<int, array{to: string, body: string, from?: string}>  $messages  Array of message objects
     * @return array<string, mixed>
     */
    public function getSmsPrice(array $messages): array
    {
        return $this->request('POST', '/sms/price', ['messages' => $messages]);
    }

    // ── Email ────────────────────────────────────────────────

    /**
     * Send an email message.
     *
     * @param  array<string, mixed>  $data  Email payload (to, subject, body, from_email_address, from_name)
     * @return array<string, mixed>
     */
    public function sendEmail(array $data): array
    {
        return $this->request('POST', '/email/send', $data);
    }

    /**
     * Get email history with pagination.
     *
     * @param  array<string, mixed>  $params  Query parameters (limit, page)
     * @return array<string, mixed>
     */
    public function getEmailHistory(array $params = []): array
    {
        return $this->request('GET', '/email/history', $params);
    }

    // ── Voice ────────────────────────────────────────────────

    /**
     * Send one or more voice messages.
     *
     * @param  array<int, array{to: string, body: string, voice?: string, lang?: string}>  $messages  Array of voice message objects
     * @return array<string, mixed>
     */
    public function sendVoice(array $messages): array
    {
        return $this->request('POST', '/voice/send', ['messages' => $messages]);
    }

    /**
     * Get voice history with pagination.
     *
     * @param  array<string, mixed>  $params  Query parameters (limit, page)
     * @return array<string, mixed>
     */
    public function getVoiceHistory(array $params = []): array
    {
        return $this->request('GET', '/voice/history', $params);
    }

    // ── Post Letters ─────────────────────────────────────────

    /**
     * Send a post letter.
     *
     * @param  array<string, mixed>  $data  Letter payload (file_url, template_id, recipients, duplex)
     * @return array<string, mixed>
     */
    public function sendPostLetter(array $data): array
    {
        return $this->request('POST', '/post/letters/send', $data);
    }

    // ── Contact Lists ────────────────────────────────────────

    /**
     * List contact lists with pagination.
     *
     * @param  array<string, mixed>  $params  Query parameters (limit, page)
     * @return array<string, mixed>
     */
    public function listContactLists(array $params = []): array
    {
        return $this->request('GET', '/lists', $params);
    }

    // ── HTTP ─────────────────────────────────────────────────

    /**
     * Make an authenticated API request to ClickSend.
     *
     * @param  string               $method  HTTP method (GET, POST)
     * @param  string               $path    API endpoint path (e.g. '/sms/send')
     * @param  array<string, mixed> $data    Query params (GET) or JSON body (POST)
     * @return array<string, mixed>
     *
     * @throws \RuntimeException If credentials are missing or the request fails.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->isConfigured()) {
            throw new \RuntimeException('ClickSend credentials are not configured.');
        }

        $url = self::BASE_URL . $path;

        try {
            $http = Http::withBasicAuth($this->username, $this->apiKey)
                ->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if ($response->failed()) {
                $body = $response->json() ?? [];
                $message = $body['response_msg'] ?? $body['response_code'] ?? $response->body();

                Log::error('ClickSend API error', [
                    'method' => $method,
                    'path' => $path,
                    'status' => $response->status(),
                    'body' => $body,
                ]);

                throw new \RuntimeException("ClickSend API error ({$response->status()}): {$message}");
            }

            return $response->json() ?? [];
        } catch (ConnectionException $e) {
            Log::error('ClickSend connection error', [
                'method' => $method,
                'path' => $path,
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("ClickSend connection error: {$e->getMessage()}");
        }
    }
}
