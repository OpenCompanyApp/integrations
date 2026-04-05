<?php

namespace OpenCompany\Integrations\Twilio;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Twilio API service for making requests to the Twilio REST API.
 *
 * Uses HTTP Basic Auth with Account SID as username and Auth Token as password.
 * Base URL includes the Account SID in the path per Twilio's API design.
 */
class TwilioService
{
    private const BASE_URL = 'https://api.twilio.com/2010-04-01/Accounts';

    private const LOOKUP_URL = 'https://lookups.twilio.com';

    /**
     * @param  string  $accountSid  Twilio Account SID (e.g., "ACxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx")
     * @param  string  $authToken   Twilio Auth Token
     */
    public function __construct(
        private string $accountSid = '',
        private string $authToken = '',
    ) {}

    /**
     * Check whether the Twilio service is properly configured.
     */
    public function isConfigured(): bool
    {
        return ! empty($this->accountSid) && ! empty($this->authToken);
    }

    // ── Messages ───────────────────────────────────────────

    /**
     * Send an SMS or MMS message.
     *
     * @param  array<string, mixed>  $data  Message parameters (To, From, Body, MediaUrl, StatusCallback)
     * @return array<string, mixed>
     */
    public function sendMessage(array $data): array
    {
        return $this->request('POST', '/Messages.json', $data);
    }

    /**
     * Get a message by SID.
     *
     * @param  string  $sid  Message SID (e.g., "SMxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx")
     * @return array<string, mixed>
     */
    public function getMessage(string $sid): array
    {
        return $this->request('GET', "/Messages/{$sid}.json");
    }

    /**
     * List messages with optional filtering.
     *
     * @param  array<string, mixed>  $params  Query parameters (To, From, DateSent, PageSize)
     * @return array<string, mixed>
     */
    public function listMessages(array $params = []): array
    {
        return $this->request('GET', '/Messages.json', $params);
    }

    // ── Calls ──────────────────────────────────────────────

    /**
     * Make an outbound call.
     *
     * @param  array<string, mixed>  $data  Call parameters (To, From, Url, Twiml, StatusCallback)
     * @return array<string, mixed>
     */
    public function makeCall(array $data): array
    {
        return $this->request('POST', '/Calls.json', $data);
    }

    /**
     * Get a call by SID.
     *
     * @param  string  $sid  Call SID (e.g., "CAxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx")
     * @return array<string, mixed>
     */
    public function getCall(string $sid): array
    {
        return $this->request('GET', "/Calls/{$sid}.json");
    }

    /**
     * List calls with optional filtering.
     *
     * @param  array<string, mixed>  $params  Query parameters (To, From, Status, PageSize)
     * @return array<string, mixed>
     */
    public function listCalls(array $params = []): array
    {
        return $this->request('GET', '/Calls.json', $params);
    }

    // ── Phone Numbers ──────────────────────────────────────

    /**
     * List incoming phone numbers on the account.
     *
     * @param  array<string, mixed>  $params  Query parameters (PageSize)
     * @return array<string, mixed>
     */
    public function listPhoneNumbers(array $params = []): array
    {
        return $this->request('GET', '/IncomingPhoneNumbers.json', $params);
    }

    /**
     * Get an incoming phone number by SID.
     *
     * @param  string  $sid  Phone number SID (e.g., "PNxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx")
     * @return array<string, mixed>
     */
    public function getPhoneNumber(string $sid): array
    {
        return $this->request('GET', "/IncomingPhoneNumbers/{$sid}.json");
    }

    // ── Lookups ────────────────────────────────────────────

    /**
     * Lookup a phone number using the Twilio Lookup API v2.
     *
     * Uses a different base URL (lookups.twilio.com) from the main API.
     *
     * @param  string  $phoneNumber  Phone number in E.164 format
     * @param  array<string, mixed>  $params  Query parameters (fields)
     * @return array<string, mixed>
     */
    public function lookupPhone(string $phoneNumber, array $params = []): array
    {
        return $this->request('GET', "/lookups/v2/PhoneNumbers/{$phoneNumber}", $params, true);
    }

    // ── Usage ──────────────────────────────────────────────

    /**
     * Create a usage trigger.
     *
     * @param  array<string, mixed>  $data  Trigger parameters (UsageCategory, TriggerValue, CallbackUrl, Recurring)
     * @return array<string, mixed>
     */
    public function createUsageTrigger(array $data): array
    {
        return $this->request('POST', '/Usage/Triggers.json', $data);
    }

    /**
     * List usage records with optional filtering.
     *
     * @param  array<string, mixed>  $params  Query parameters (Category, StartDate, EndDate, PageSize)
     * @return array<string, mixed>
     */
    public function listUsageRecords(array $params = []): array
    {
        return $this->request('GET', '/Usage/Records.json', $params);
    }

    // ── Account ────────────────────────────────────────────

    /**
     * Get account details by SID, or fetch current account.
     *
     * @param  string|null  $sid  Account SID, or null for current account
     * @return array<string, mixed>
     */
    public function getAccount(?string $sid = null): array
    {
        $path = $sid !== null
            ? "/Accounts/{$sid}.json"
            : '/Accounts/Current.json';

        return $this->request('GET', $path);
    }

    // ── Recordings ─────────────────────────────────────────

    /**
     * List recordings with optional filtering.
     *
     * @param  array<string, mixed>  $params  Query parameters (CallSid, DateCreated, PageSize)
     * @return array<string, mixed>
     */
    public function listRecordings(array $params = []): array
    {
        return $this->request('GET', '/Recordings.json', $params);
    }

    /**
     * Delete a recording by SID.
     *
     * @param  string  $sid  Recording SID (e.g., "RExxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx")
     * @return array<string, mixed>
     */
    public function deleteRecording(string $sid): array
    {
        return $this->request('DELETE', "/Recordings/{$sid}.json");
    }

    // ── HTTP ───────────────────────────────────────────────

    /**
     * Make an API request to Twilio.
     *
     * @param  string  $method   HTTP method (GET, POST, DELETE)
     * @param  string  $path     API path relative to the base URL
     * @param  array<string, mixed>  $data  Request parameters
     * @param  bool  $useLookupUrl  Whether to use the Lookup API base URL instead of the main API
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = [], bool $useLookupUrl = false): array
    {
        if (! $this->isConfigured()) {
            throw new \RuntimeException('Twilio Account SID and Auth Token are not configured.');
        }

        $baseUrl = $useLookupUrl
            ? self::LOOKUP_URL
            : self::BASE_URL . '/' . $this->accountSid;

        $url = $baseUrl . $path;

        try {
            $http = Http::withBasicAuth($this->accountSid, $this->authToken)
                ->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->asForm()->post($url, $data),
                'DELETE' => $http->asForm()->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            $json = $response->json() ?? [];

            if (! $response->successful()) {
                $error = $json['message'] ?? $response->body();
                $code = $json['code'] ?? '';
                $moreInfo = $json['more_info'] ?? '';

                Log::error("Twilio API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                    'code' => $code,
                    'more_info' => $moreInfo,
                ]);

                $msg = is_string($error) ? $error : json_encode($error);
                if ($code) {
                    $msg .= " (code: {$code})";
                }

                throw new \RuntimeException('Twilio API error (' . $response->status() . '): ' . $msg);
            }

            return $json;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Twilio API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Twilio API: {$e->getMessage()}");
        }
    }
}
