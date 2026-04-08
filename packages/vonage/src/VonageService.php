<?php

namespace OpenCompany\Integrations\Vonage;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class VonageService
{
    /**
     * Create a new Vonage service instance.
     *
     * @param  string  $apiKey     Vonage API key
     * @param  string  $apiSecret  Vonage API secret
     * @param  string  $baseUrl    Base URL for the Vonage REST API
     */
    public function __construct(
        private string $apiKey = '',
        private string $apiSecret = '',
        private string $baseUrl = 'https://rest.nexmo.com',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service is configured with credentials.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey) && !empty($this->apiSecret);
    }

    /**
     * Send an SMS message.
     *
     * @param  string       $from  Sender ID or phone number
     * @param  string       $to    Recipient phone number (E.164 format)
     * @param  string       $text  Message body text
     * @param  array<mixed> $extra Additional parameters (e.g. type, status_report_req)
     * @return array<string, mixed>
     */
    public function sendSms(string $from, string $to, string $text, array $extra = []): array
    {
        $params = array_merge([
            'from' => $from,
            'to' => $to,
            'text' => $text,
        ], $extra);

        return $this->request('POST', '/sms/json', $params);
    }

    /**
     * Search/list messages.
     *
     * @param  array<string, mixed>  $params  Query parameters (date, to, etc.)
     * @return array<string, mixed>
     */
    public function listMessages(array $params = []): array
    {
        return $this->request('GET', '/search/messages', $params);
    }

    /**
     * Get the current account balance.
     *
     * @return array<string, mixed>
     */
    public function getAccountBalance(): array
    {
        return $this->request('GET', '/account/get-balance');
    }

    /**
     * List purchased numbers on the account.
     *
     * @param  array<string, mixed>  $params  Query parameters (pattern, search_pattern, size, index)
     * @return array<string, mixed>
     */
    public function listNumbers(array $params = []): array
    {
        return $this->request('GET', '/account/numbers', $params);
    }

    /**
     * List Vonage applications.
     *
     * @param  array<string, mixed>  $params  Query parameters (page_size, page)
     * @return array<string, mixed>
     */
    public function listApplications(array $params = []): array
    {
        return $this->request('GET', '/v2/applications', $params);
    }

    /**
     * Initiate a verify request (send a verification code to a number).
     *
     * @param  array<string, mixed>  $data  Request body (number, brand, etc.)
     * @return array<string, mixed>
     */
    public function verifyRequest(array $data): array
    {
        return $this->request('POST', '/verify/json', $data);
    }

    /**
     * Check a verification code against a verify request.
     *
     * @param  string  $requestId  The request_id from the verify request
     * @param  string  $code       The code entered by the user
     * @return array<string, mixed>
     */
    public function verifyCheck(string $requestId, string $code): array
    {
        return $this->request('POST', '/verify/check/json', [
            'request_id' => $requestId,
            'code' => $code,
        ]);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string                $method  HTTP method (GET, POST)
     * @param  string                $path    API endpoint path
     * @param  array<string, mixed>  $data    Request parameters
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Vonage REST API.
     *
     * Vonage authenticates via api_key and api_secret query parameters
     * appended to every request URL.
     *
     * @param  string                $method  HTTP method
     * @param  string                $path    API endpoint path
     * @param  array<string, mixed>  $data    Request parameters
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->isConfigured()) {
            throw new \RuntimeException('Vonage API credentials are not configured.');
        }

        // Always append api_key and api_secret as query parameters
        $authParams = [
            'api_key' => $this->apiKey,
            'api_secret' => $this->apiSecret,
        ];

        $url = $this->baseUrl . $path;

        try {
            $http = Http::asForm()
                ->timeout(30)
                ->acceptJson();

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, array_merge($authParams, $data)),
                'POST' => $http->post($url, array_merge($authParams, $data)),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $json = $response->json();
                $error = $json['error_title'] ?? $json['error_text'] ?? $json['description'] ?? $response->body();

                Log::error("Vonage API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Vonage API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Vonage API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Vonage API: {$e->getMessage()}");
        }
    }
}
