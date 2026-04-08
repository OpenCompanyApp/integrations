<?php

namespace OpenCompany\Integrations\WhatsApp;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * WhatsApp Business API service.
 *
 * Wraps the Meta Cloud API (v21.0) for sending messages, retrieving message
 * status, listing templates and contacts, and fetching the authenticated user.
 *
 * @see https://developers.facebook.com/docs/whatsapp/cloud-api
 */
class WhatsAppService
{
    /**
     * Create a new WhatsAppService instance.
     *
     * @param  string  $accessToken  Meta System User access token.
     * @param  string  $phoneNumberId  WhatsApp Business phone number ID.
     * @param  string  $baseUrl  Meta Graph API base URL (configurable for testing).
     */
    public function __construct(
        private string $accessToken = '',
        private string $phoneNumberId = '',
        private string $baseUrl = 'https://graph.facebook.com/v21.0',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Determine whether the service has enough credentials to make API calls.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken) && !empty($this->phoneNumberId);
    }

    /**
     * Send a text message to a WhatsApp recipient.
     *
     * @param  string  $to  Recipient phone number in international format (e.g. "15551234567").
     * @param  string  $body  Text body of the message (max 4096 characters).
     * @param  bool  $previewUrl  Whether to render URLs as link previews.
     * @return array<string, mixed> API response containing the message ID and status.
     *
     * @see https://developers.facebook.com/docs/whatsapp/cloud-api/reference/messages#send-messages
     */
    public function sendMessage(string $to, string $body, bool $previewUrl = false): array
    {
        return $this->request('POST', "/{$this->phoneNumberId}/messages", [
            'messaging_product' => 'whatsapp',
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
     * @param  string  $to  Recipient phone number in international format.
     * @param  string  $templateName  Name of the approved template.
     * @param  string  $language  Language code (e.g. "en_US", "en").
     * @param  array<int, array{name: string, components?: array}>  $components  Template header/body/button components.
     * @return array<string, mixed> API response containing the message ID and status.
     *
     * @see https://developers.facebook.com/docs/whatsapp/cloud-api/reference/messages#send-template-messages
     */
    public function sendTemplate(string $to, string $templateName, string $language = 'en', array $components = []): array
    {
        $payload = [
            'messaging_product' => 'whatsapp',
            'recipient_type' => 'individual',
            'to' => $to,
            'type' => 'template',
            'template' => [
                'name' => $templateName,
                'language' => ['code' => $language],
            ],
        ];

        if (!empty($components)) {
            $payload['template']['components'] = $components;
        }

        return $this->request('POST', "/{$this->phoneNumberId}/messages", $payload);
    }

    /**
     * Retrieve a specific message by its ID.
     *
     * @param  string  $messageId  The WhatsApp message ID (e.g. "wamid.HBgM...").
     * @return array<string, mixed> Message details including status and timestamp.
     *
     * @see https://developers.facebook.com/docs/whatsapp/cloud-api/reference/messages#retrieve-messages
     */
    public function getMessage(string $messageId): array
    {
        return $this->request('GET', "/{$messageId}", []);
    }

    /**
     * List message templates for the WhatsApp Business Account.
     *
     * @param  int  $limit  Maximum number of templates to return (default 100).
     * @param  string|null  $after  Cursor for pagination.
     * @return array<string, mixed> List of templates with pagination info.
     *
     * @see https://developers.facebook.com/docs/whatsapp/business-management-api/message-templates
     */
    public function listTemplates(int $limit = 100, ?string $after = null): array
    {
        $params = [
            'limit' => $limit,
            'fields' => 'name,status,language,category,components',
        ];

        if ($after) {
            $params['after'] = $after;
        }

        return $this->request('GET', "/{$this->phoneNumberId}/message_templates", $params);
    }

    /**
     * List contacts for the WhatsApp Business phone number.
     *
     * @param  int  $limit  Maximum number of contacts to return (default 100).
     * @param  string|null  $after  Cursor for pagination.
     * @return array<string, mixed> List of contacts.
     *
     * @see https://developers.facebook.com/docs/whatsapp/cloud-api/reference/contacts
     */
    public function listContacts(int $limit = 100, ?string $after = null): array
    {
        $params = [
            'limit' => $limit,
            'fields' => 'wa_id,profile_name',
        ];

        if ($after) {
            $params['after'] = $after;
        }

        return $this->request('GET', "/{$this->phoneNumberId}/contacts", $params);
    }

    /**
     * Get the currently authenticated user / Business account info.
     *
     * @return array<string, mixed> User details including name, email, and business ID.
     *
     * @see https://developers.facebook.com/docs/graph-api/reference/v21.0/me
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/me', [
            'fields' => 'id,name,email',
        ]);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path  API path (e.g. "/{phone_number_id}/messages").
     * @param  array<string, mixed>  $data  Query params or JSON body.
     * @return array<string, mixed> Decoded JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the WhatsApp Cloud API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Request data.
     * @return \Illuminate\Http\Client\Response Raw HTTP response.
     *
     * @throws \RuntimeException On connection failure or API error.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('WhatsApp access token is not configured.');
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
                    Log::warning("WhatsApp API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("WhatsApp API endpoint not available (HTTP {$response->status()}). Check the base URL and phone number ID.");
                }

                $error = $response->json('error.message') ?? $response->json('error') ?? $body;
                Log::error("WhatsApp API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("WhatsApp API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("WhatsApp API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to WhatsApp API: {$e->getMessage()}");
        }
    }
}
