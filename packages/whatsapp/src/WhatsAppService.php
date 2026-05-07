<?php

namespace OpenCompany\Integrations\WhatsApp;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the WhatsApp Business Platform Graph API.
 *
 * Handles authentication, request dispatch, endpoint-specific helpers, and
 * safe raw relative Graph API calls for advanced WhatsApp operations.
 */
class WhatsAppService
{
    /**
     * @param  string  $accessToken  Meta System User access token.
     * @param  string  $phoneNumberId  WhatsApp Business phone number ID.
     * @param  string  $whatsAppBusinessAccountId  WhatsApp Business Account ID for template and subscription operations.
     * @param  string  $baseUrl  Meta Graph API base URL.
     */
    public function __construct(
        private string $accessToken = '',
        private string $phoneNumberId = '',
        private string $whatsAppBusinessAccountId = '',
        private string $baseUrl = 'https://graph.facebook.com/v24.0',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Determine whether phone-number based Cloud API calls can run.
     */
    public function isConfigured(): bool
    {
        return $this->hasAccessToken() && $this->hasPhoneNumber();
    }

    /**
     * Determine whether an access token is available for account-level Graph calls.
     */
    public function hasAccessToken(): bool
    {
        return $this->accessToken !== '';
    }

    /**
     * Determine whether a phone number ID is available for Cloud API calls.
     */
    public function hasPhoneNumber(): bool
    {
        return $this->phoneNumberId !== '';
    }

    /**
     * Determine whether a WhatsApp Business Account ID is available.
     */
    public function hasBusinessAccount(): bool
    {
        return $this->whatsAppBusinessAccountId !== '';
    }

    /**
     * Send a text message to a WhatsApp recipient.
     *
     * @param  string  $to  Recipient phone number in international format without a plus sign.
     * @param  string  $body  Text body of the message.
     * @param  bool  $previewUrl  Whether to render URLs as link previews.
     * @return array<string, mixed>
     */
    public function sendMessage(string $to, string $body, bool $previewUrl = false): array
    {
        return $this->sendMessagePayload([
            'recipient_type' => 'individual',
            'to' => $to,
            'type' => 'text',
            'text' => [
                'preview_url' => $previewUrl,
                'body' => $body,
            ],
        ]);
    }

    /**
     * Send a template message to a WhatsApp recipient.
     *
     * @param  string  $to  Recipient phone number in international format without a plus sign.
     * @param  string  $templateName  Approved template name.
     * @param  string  $language  Template language code.
     * @param  array<int, array<string, mixed>>  $components  Template components.
     * @return array<string, mixed>
     */
    public function sendTemplate(string $to, string $templateName, string $language = 'en', array $components = []): array
    {
        $payload = [
            'recipient_type' => 'individual',
            'to' => $to,
            'type' => 'template',
            'template' => [
                'name' => $templateName,
                'language' => ['code' => $language],
            ],
        ];

        if ($components !== []) {
            $payload['template']['components'] = $components;
        }

        return $this->sendMessagePayload($payload);
    }

    /**
     * Send any supported WhatsApp message payload through the messages endpoint.
     *
     * @param  array<string, mixed>  $payload  Cloud API message payload without the messaging_product field.
     * @return array<string, mixed>
     */
    public function sendMessagePayload(array $payload): array
    {
        $this->requirePhoneNumber();
        $payload['messaging_product'] = $payload['messaging_product'] ?? 'whatsapp';

        return $this->apiPost("/{$this->phoneNumberId}/messages", $payload);
    }

    /**
     * Mark an inbound message as read.
     *
     * @param  string  $messageId  WhatsApp message ID.
     * @return array<string, mixed>
     */
    public function markMessageRead(string $messageId): array
    {
        $this->requirePhoneNumber();

        return $this->apiPost("/{$this->phoneNumberId}/messages", [
            'messaging_product' => 'whatsapp',
            'status' => 'read',
            'message_id' => $messageId,
        ]);
    }

    /**
     * Retrieve a specific Graph object, such as a message or template ID.
     *
     * @param  string  $messageId  Graph object or WhatsApp message ID.
     * @param  string|null  $fields  Optional comma-separated fields.
     * @return array<string, mixed>
     */
    public function getMessage(string $messageId, ?string $fields = null): array
    {
        $query = [];
        if ($fields !== null && $fields !== '') {
            $query['fields'] = $fields;
        }

        return $this->apiGet('/' . rawurlencode($messageId), $query);
    }

    /**
     * Validate WhatsApp contacts for one or more phone numbers.
     *
     * @param  array<int, string>  $contacts  Phone numbers in international format.
     * @return array<string, mixed>
     */
    public function checkContacts(array $contacts): array
    {
        $this->requirePhoneNumber();

        return $this->apiPost("/{$this->phoneNumberId}/contacts", [
            'messaging_product' => 'whatsapp',
            'contacts' => array_values($contacts),
        ]);
    }

    /**
     * List templates for the configured WhatsApp Business Account.
     *
     * @param  int  $limit  Maximum number of templates to return.
     * @param  string|null  $after  Pagination cursor.
     * @param  string|null  $status  Optional template status filter.
     * @param  string|null  $name  Optional template name filter.
     * @return array<string, mixed>
     */
    public function listTemplates(int $limit = 100, ?string $after = null, ?string $status = null, ?string $name = null): array
    {
        $this->requireBusinessAccount();

        $params = [
            'limit' => $limit,
            'fields' => 'id,name,status,language,category,components,quality_score,rejected_reason',
        ];

        if ($after !== null && $after !== '') {
            $params['after'] = $after;
        }

        if ($status !== null && $status !== '') {
            $params['status'] = $status;
        }

        if ($name !== null && $name !== '') {
            $params['name'] = $name;
        }

        return $this->apiGet("/{$this->whatsAppBusinessAccountId}/message_templates", $params);
    }

    /**
     * Retrieve one message template by Graph template ID.
     *
     * @param  string  $templateId  Message template Graph ID.
     * @return array<string, mixed>
     */
    public function getTemplate(string $templateId): array
    {
        return $this->apiGet('/' . rawurlencode($templateId), [
            'fields' => 'id,name,status,language,category,components,quality_score,rejected_reason',
        ]);
    }

    /**
     * Create a WhatsApp message template on the configured business account.
     *
     * @param  array<string, mixed>  $payload  Template creation payload.
     * @return array<string, mixed>
     */
    public function createTemplate(array $payload): array
    {
        $this->requireBusinessAccount();

        return $this->apiPost("/{$this->whatsAppBusinessAccountId}/message_templates", $payload);
    }

    /**
     * Update a WhatsApp message template by Graph template ID.
     *
     * @param  string  $templateId  Message template Graph ID.
     * @param  array<string, mixed>  $payload  Template update payload.
     * @return array<string, mixed>
     */
    public function updateTemplate(string $templateId, array $payload): array
    {
        return $this->apiPost('/' . rawurlencode($templateId), $payload);
    }

    /**
     * Delete a WhatsApp message template by name and optional template ID.
     *
     * @param  string  $name  Template name.
     * @param  string|null  $templateId  Optional template ID for deleting a specific language variant.
     * @return array<string, mixed>
     */
    public function deleteTemplate(string $name, ?string $templateId = null): array
    {
        $this->requireBusinessAccount();

        $query = ['name' => $name];
        if ($templateId !== null && $templateId !== '') {
            $query['hsm_id'] = $templateId;
        }

        return $this->apiDelete("/{$this->whatsAppBusinessAccountId}/message_templates", $query);
    }

    /**
     * Upload a local media file to the configured WhatsApp phone number.
     *
     * @param  string  $filePath  Local file path.
     * @param  string  $mimeType  MIME type accepted by WhatsApp.
     * @return array<string, mixed>
     */
    public function uploadMedia(string $filePath, string $mimeType): array
    {
        $this->requirePhoneNumber();

        if (! is_file($filePath) || ! is_readable($filePath)) {
            throw new \RuntimeException('media file_path must point to a readable local file.');
        }

        $response = $this->rawMultipartRequest("/{$this->phoneNumberId}/media", [
            'messaging_product' => 'whatsapp',
            'type' => $mimeType,
        ], $filePath);

        return $response->json() ?? [];
    }

    /**
     * Retrieve metadata and a temporary download URL for uploaded media.
     *
     * @param  string  $mediaId  WhatsApp media ID.
     * @return array<string, mixed>
     */
    public function getMedia(string $mediaId): array
    {
        return $this->apiGet('/' . rawurlencode($mediaId));
    }

    /**
     * Delete uploaded WhatsApp media by media ID.
     *
     * @param  string  $mediaId  WhatsApp media ID.
     * @return array<string, mixed>
     */
    public function deleteMedia(string $mediaId): array
    {
        return $this->apiDelete('/' . rawurlencode($mediaId));
    }

    /**
     * Retrieve phone number metadata.
     *
     * @param  string|null  $phoneNumberId  Optional phone number ID. Defaults to configured phone number.
     * @return array<string, mixed>
     */
    public function getPhoneNumber(?string $phoneNumberId = null): array
    {
        $id = $phoneNumberId ?: $this->phoneNumberId;
        if ($id === '') {
            throw new \RuntimeException('WhatsApp phone number ID is not configured.');
        }

        return $this->apiGet('/' . rawurlencode($id), [
            'fields' => 'id,display_phone_number,verified_name,code_verification_status,quality_rating,platform_type,throughput',
        ]);
    }

    /**
     * List phone numbers attached to the configured WhatsApp Business Account.
     *
     * @param  int  $limit  Maximum number of phone numbers to return.
     * @param  string|null  $after  Pagination cursor.
     * @return array<string, mixed>
     */
    public function listPhoneNumbers(int $limit = 100, ?string $after = null): array
    {
        $this->requireBusinessAccount();

        $query = [
            'limit' => $limit,
            'fields' => 'id,display_phone_number,verified_name,code_verification_status,quality_rating,platform_type,throughput',
        ];

        if ($after !== null && $after !== '') {
            $query['after'] = $after;
        }

        return $this->apiGet("/{$this->whatsAppBusinessAccountId}/phone_numbers", $query);
    }

    /**
     * Request a phone number registration code.
     *
     * @param  string  $codeMethod  SMS or VOICE.
     * @param  string  $language  Language code for the verification message.
     * @param  string|null  $phoneNumberId  Optional phone number ID. Defaults to configured phone number.
     * @return array<string, mixed>
     */
    public function requestVerificationCode(string $codeMethod, string $language = 'en', ?string $phoneNumberId = null): array
    {
        $id = $phoneNumberId ?: $this->phoneNumberId;
        if ($id === '') {
            throw new \RuntimeException('WhatsApp phone number ID is not configured.');
        }

        return $this->apiPost('/' . rawurlencode($id) . '/request_code', [
            'code_method' => strtoupper($codeMethod),
            'language' => $language,
        ]);
    }

    /**
     * Verify a phone number registration code.
     *
     * @param  string  $code  Verification code from Meta.
     * @param  string|null  $phoneNumberId  Optional phone number ID. Defaults to configured phone number.
     * @return array<string, mixed>
     */
    public function verifyCode(string $code, ?string $phoneNumberId = null): array
    {
        $id = $phoneNumberId ?: $this->phoneNumberId;
        if ($id === '') {
            throw new \RuntimeException('WhatsApp phone number ID is not configured.');
        }

        return $this->apiPost('/' . rawurlencode($id) . '/verify_code', ['code' => $code]);
    }

    /**
     * Register a phone number for Cloud API use.
     *
     * @param  string  $pin  Two-step verification PIN.
     * @param  string|null  $phoneNumberId  Optional phone number ID. Defaults to configured phone number.
     * @return array<string, mixed>
     */
    public function registerPhoneNumber(string $pin, ?string $phoneNumberId = null): array
    {
        $id = $phoneNumberId ?: $this->phoneNumberId;
        if ($id === '') {
            throw new \RuntimeException('WhatsApp phone number ID is not configured.');
        }

        return $this->apiPost('/' . rawurlencode($id) . '/register', [
            'messaging_product' => 'whatsapp',
            'pin' => $pin,
        ]);
    }

    /**
     * Deregister a phone number from the Cloud API.
     *
     * @param  string|null  $phoneNumberId  Optional phone number ID. Defaults to configured phone number.
     * @return array<string, mixed>
     */
    public function deregisterPhoneNumber(?string $phoneNumberId = null): array
    {
        $id = $phoneNumberId ?: $this->phoneNumberId;
        if ($id === '') {
            throw new \RuntimeException('WhatsApp phone number ID is not configured.');
        }

        return $this->apiPost('/' . rawurlencode($id) . '/deregister', []);
    }

    /**
     * Get the configured phone number business profile.
     *
     * @param  string  $fields  Comma-separated profile fields.
     * @return array<string, mixed>
     */
    public function getBusinessProfile(string $fields = 'about,address,description,email,profile_picture_url,websites,vertical'): array
    {
        $this->requirePhoneNumber();

        return $this->apiGet("/{$this->phoneNumberId}/whatsapp_business_profile", [
            'fields' => $fields,
        ]);
    }

    /**
     * Update the configured phone number business profile.
     *
     * @param  array<string, mixed>  $payload  Business profile fields.
     * @return array<string, mixed>
     */
    public function updateBusinessProfile(array $payload): array
    {
        $this->requirePhoneNumber();
        $payload['messaging_product'] = $payload['messaging_product'] ?? 'whatsapp';

        return $this->apiPost("/{$this->phoneNumberId}/whatsapp_business_profile", $payload);
    }

    /**
     * Subscribe the configured app to WABA webhook events.
     *
     * @return array<string, mixed>
     */
    public function subscribeApp(): array
    {
        $this->requireBusinessAccount();

        return $this->apiPost("/{$this->whatsAppBusinessAccountId}/subscribed_apps", []);
    }

    /**
     * List apps subscribed to WABA webhook events.
     *
     * @return array<string, mixed>
     */
    public function listSubscribedApps(): array
    {
        $this->requireBusinessAccount();

        return $this->apiGet("/{$this->whatsAppBusinessAccountId}/subscribed_apps");
    }

    /**
     * Unsubscribe the configured app from WABA webhook events.
     *
     * @return array<string, mixed>
     */
    public function unsubscribeApp(): array
    {
        $this->requireBusinessAccount();

        return $this->apiDelete("/{$this->whatsAppBusinessAccountId}/subscribed_apps");
    }

    /**
     * Get the currently authenticated Graph user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->apiGet('/me', [
            'fields' => 'id,name,email',
        ]);
    }

    /**
     * Make a safe relative GET request to the configured Graph API base URL.
     *
     * @param  string  $path  Relative Graph API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $query = []): array
    {
        $response = $this->rawRequest('GET', $path, [], $query);

        return $response->json() ?? [];
    }

    /**
     * Make a safe relative POST request to the configured Graph API base URL.
     *
     * @param  string  $path  Relative Graph API path.
     * @param  array<string, mixed>  $body  JSON body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $body = [], array $query = []): array
    {
        $response = $this->rawRequest('POST', $path, $body, $query);

        return $response->json() ?? [];
    }

    /**
     * Make a safe relative DELETE request to the configured Graph API base URL.
     *
     * @param  string  $path  Relative Graph API path.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $query = []): array
    {
        $response = $this->rawRequest('DELETE', $path, [], $query);

        return $response->json() ?? [];
    }

    /**
     * Require phone-number credentials for Cloud API phone-number operations.
     */
    private function requirePhoneNumber(): void
    {
        if (! $this->hasPhoneNumber()) {
            throw new \RuntimeException('WhatsApp phone number ID is not configured.');
        }
    }

    /**
     * Require WABA credentials for business-account operations.
     */
    private function requireBusinessAccount(): void
    {
        if (! $this->hasBusinessAccount()) {
            throw new \RuntimeException('WhatsApp Business Account ID is not configured.');
        }
    }

    /**
     * Make a raw JSON HTTP request to Meta Graph API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  Safe relative API path.
     * @param  array<string, mixed>  $body  JSON body.
     * @param  array<string, mixed>  $query  Query parameters.
     * @return Response
     */
    private function rawRequest(string $method, string $path, array $body = [], array $query = []): Response
    {
        $url = $this->buildUrl($path, $query);

        try {
            $http = $this->http();

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url),
                'POST' => $http->post($url, $body),
                'DELETE' => $http->delete($url),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            return $this->handleResponse($response, $method, $path);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("WhatsApp API connection error: {$method} {$path}", ['error' => $e->getMessage()]);
            throw new \RuntimeException("Failed to connect to WhatsApp API: {$e->getMessage()}");
        }
    }

    /**
     * Make a raw multipart media upload request.
     *
     * @param  string  $path  Safe relative API path.
     * @param  array<string, string>  $fields  Multipart form fields.
     * @param  string  $filePath  Local file path.
     * @return Response
     */
    private function rawMultipartRequest(string $path, array $fields, string $filePath): Response
    {
        $url = $this->buildUrl($path, []);

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->requireAccessToken(),
                'Accept' => 'application/json',
            ])->timeout(60)->attach('file', file_get_contents($filePath), basename($filePath));

            $response = $http->post($url, $fields);

            return $this->handleResponse($response, 'POST', $path);
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("WhatsApp API connection error: POST {$path}", ['error' => $e->getMessage()]);
            throw new \RuntimeException("Failed to connect to WhatsApp API: {$e->getMessage()}");
        }
    }

    /**
     * Create an authenticated HTTP pending request.
     */
    private function http(): \Illuminate\Http\Client\PendingRequest
    {
        return Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->requireAccessToken(),
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ])->timeout(30);
    }

    /**
     * Return an access token or throw a clear configuration error.
     */
    private function requireAccessToken(): string
    {
        if (! $this->hasAccessToken()) {
            throw new \RuntimeException('WhatsApp access token is not configured.');
        }

        return $this->accessToken;
    }

    /**
     * Convert a safe relative path and query array into a full URL.
     *
     * @param  string  $path  Safe relative API path.
     * @param  array<string, mixed>  $query  Query parameters.
     */
    private function buildUrl(string $path, array $query): string
    {
        $path = '/' . ltrim($path, '/');

        if (str_contains($path, '://') || str_starts_with($path, '//') || str_contains($path, '..')) {
            throw new \RuntimeException('WhatsApp API path must be a safe relative Graph API path.');
        }

        $query = array_filter($query, static fn ($value): bool => $value !== null && $value !== '');
        $queryString = $this->queryString($query);

        return $this->baseUrl . $path . ($queryString === '' ? '' : '?' . $queryString);
    }

    /**
     * Build a query string while preserving repeated array values.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     */
    private function queryString(array $query): string
    {
        $parts = [];

        foreach ($query as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $entry) {
                    if ($entry !== null && $entry !== '') {
                        $parts[] = rawurlencode((string) $key) . '=' . rawurlencode((string) $entry);
                    }
                }

                continue;
            }

            $parts[] = rawurlencode((string) $key) . '=' . rawurlencode((string) $value);
        }

        return implode('&', $parts);
    }

    /**
     * Validate an HTTP response and convert Graph API failures to exceptions.
     */
    private function handleResponse(Response $response, string $method, string $path): Response
    {
        if ($response->successful()) {
            return $response;
        }

        $contentType = (string) $response->header('Content-Type');
        $body = $response->body();

        if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
            Log::warning("WhatsApp API returned HTML for {$method} {$path}", ['status' => $response->status()]);
            throw new \RuntimeException("WhatsApp API endpoint not available (HTTP {$response->status()}). Check the base URL and Graph API version.");
        }

        $error = $response->json('error.message') ?? $response->json('error') ?? $body;
        Log::error("WhatsApp API error: {$method} {$path}", [
            'status' => $response->status(),
            'error' => $error,
        ]);

        throw new \RuntimeException("WhatsApp API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
    }
}
