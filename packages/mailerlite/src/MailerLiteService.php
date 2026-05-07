<?php

namespace OpenCompany\Integrations\MailerLite;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the current MailerLite REST API.
 *
 * Wraps the connect.mailerlite.com API with Bearer token authentication and
 * exposes subscriber, audience, campaign, automation, form, webhook, and batch
 * operations for tool classes.
 */
class MailerLiteService
{
    /**
     * Create a new MailerLite service instance.
     *
     * @param  string  $apiKey  MailerLite API token for Bearer auth.
     * @param  string  $baseUrl  Base URL for the current MailerLite API.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://connect.mailerlite.com/api',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has an API key configured.
     */
    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * Verify the token with a lightweight account-scoped subscriber count call.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return [
            'authenticated' => true,
            'subscriber_summary' => $this->request('GET', '/subscribers', ['limit' => 0]),
        ];
    }

    /**
     * List subscribers with cursor pagination, status filtering, and includes.
     *
     * @param  array<string, mixed>|int  $params  Query parameters, or legacy page value.
     * @param  int  $limit  Legacy limit argument.
     * @param  string|null  $status  Legacy status filter.
     * @return array<string, mixed>
     */
    public function listSubscribers(array|int $params = [], int $limit = 25, ?string $status = null): array
    {
        if (is_int($params)) {
            $params = ['limit' => $limit] + ($status === null ? [] : ['filter[status]' => $status]);
        }

        return $this->request('GET', '/subscribers', $params);
    }

    /**
     * Fetch a subscriber by id or email address.
     *
     * @param  int|string  $id  Subscriber id or email address.
     * @return array<string, mixed>
     */
    public function getSubscriber(int|string $id): array
    {
        return $this->request('GET', '/subscribers/' . rawurlencode((string) $id));
    }

    /**
     * Create or upsert a subscriber.
     *
     * @param  string|array<string, mixed>  $emailOrPayload  Email address, or full subscriber payload.
     * @param  string|null  $name  Legacy name argument.
     * @param  array<string, mixed>  $fields  Legacy custom fields argument.
     * @return array<string, mixed>
     */
    public function createSubscriber(string|array $emailOrPayload, ?string $name = null, array $fields = []): array
    {
        $payload = is_array($emailOrPayload) ? $emailOrPayload : ['email' => $emailOrPayload];

        if (!is_array($emailOrPayload)) {
            if ($name !== null) {
                $payload['fields']['name'] = $name;
            }

            if ($fields !== []) {
                $payload['fields'] = array_merge($payload['fields'] ?? [], $fields);
            }
        }

        return $this->request('POST', '/subscribers', $payload);
    }

    /**
     * Update a subscriber by id or email.
     *
     * @param  int|string  $id  Subscriber id or email address.
     * @param  array<string, mixed>|string|null  $payloadOrName  Update payload, or legacy name argument.
     * @param  array<string, mixed>  $fields  Legacy fields argument.
     * @return array<string, mixed>
     */
    public function updateSubscriber(int|string $id, array|string|null $payloadOrName = [], array $fields = []): array
    {
        $payload = is_array($payloadOrName) ? $payloadOrName : [];

        if (!is_array($payloadOrName)) {
            if ($payloadOrName !== null) {
                $payload['fields']['name'] = $payloadOrName;
            }

            if ($fields !== []) {
                $payload['fields'] = array_merge($payload['fields'] ?? [], $fields);
            }
        }

        return $this->request('PUT', '/subscribers/' . rawurlencode((string) $id), $payload);
    }

    /**
     * Delete a subscriber by id or email.
     *
     * @param  int|string  $id  Subscriber id or email address.
     * @return array<string, mixed>
     */
    public function deleteSubscriber(int|string $id): array
    {
        return $this->request('DELETE', '/subscribers/' . rawurlencode((string) $id));
    }

    /**
     * Fetch subscriber activity log entries.
     *
     * @param  int|string  $id  Subscriber id.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listSubscriberActivity(int|string $id, array $params = []): array
    {
        return $this->request('GET', '/subscribers/' . rawurlencode((string) $id) . '/activity-log', $params);
    }

    /**
     * List subscriber groups.
     *
     * @param  array<string, mixed>|int  $params  Query parameters, or legacy page value.
     * @param  int  $limit  Legacy limit argument.
     * @return array<string, mixed>
     */
    public function listGroups(array|int $params = [], int $limit = 25): array
    {
        if (is_int($params)) {
            $params = ['page' => $params, 'limit' => $limit];
        }

        return $this->request('GET', '/groups', $params);
    }

    /**
     * Create a subscriber group.
     *
     * @param  array<string, mixed>  $payload  Group payload.
     * @return array<string, mixed>
     */
    public function createGroup(array $payload): array
    {
        return $this->request('POST', '/groups', $payload);
    }

    /**
     * Update a subscriber group.
     *
     * @param  int|string  $groupId  Group id.
     * @param  array<string, mixed>  $payload  Group payload.
     * @return array<string, mixed>
     */
    public function updateGroup(int|string $groupId, array $payload): array
    {
        return $this->request('PUT', '/groups/' . rawurlencode((string) $groupId), $payload);
    }

    /**
     * Delete a subscriber group.
     *
     * @param  int|string  $groupId  Group id.
     * @return array<string, mixed>
     */
    public function deleteGroup(int|string $groupId): array
    {
        return $this->request('DELETE', '/groups/' . rawurlencode((string) $groupId));
    }

    /**
     * List subscribers in a group.
     *
     * @param  int|string  $groupId  Group id.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listGroupSubscribers(int|string $groupId, array $params = []): array
    {
        return $this->request('GET', '/groups/' . rawurlencode((string) $groupId) . '/subscribers', $params);
    }

    /**
     * Create or update a subscriber and include the requested group.
     *
     * @param  int|string  $groupId  Group id.
     * @param  string  $email  Subscriber email address.
     * @param  string|null  $name  Optional subscriber name.
     * @return array<string, mixed>
     */
    public function addSubscriberToGroup(int|string $groupId, string $email, ?string $name = null): array
    {
        $payload = ['email' => $email, 'groups' => [(string) $groupId]];

        if ($name !== null) {
            $payload['fields'] = ['name' => $name];
        }

        return $this->createSubscriber($payload);
    }

    /**
     * Assign an existing subscriber to a group.
     *
     * @param  int|string  $subscriberId  Subscriber id.
     * @param  int|string  $groupId  Group id.
     * @return array<string, mixed>
     */
    public function assignSubscriberToGroup(int|string $subscriberId, int|string $groupId): array
    {
        return $this->request('POST', '/subscribers/' . rawurlencode((string) $subscriberId) . '/groups/' . rawurlencode((string) $groupId));
    }

    /**
     * Remove an existing subscriber from a group.
     *
     * @param  int|string  $subscriberId  Subscriber id.
     * @param  int|string  $groupId  Group id.
     * @return array<string, mixed>
     */
    public function unassignSubscriberFromGroup(int|string $subscriberId, int|string $groupId): array
    {
        return $this->request('DELETE', '/subscribers/' . rawurlencode((string) $subscriberId) . '/groups/' . rawurlencode((string) $groupId));
    }

    /**
     * Bulk import subscribers into a group.
     *
     * @param  int|string  $groupId  Group id.
     * @param  array<int, array<string, mixed>>  $subscribers  Subscriber payloads.
     * @return array<string, mixed>
     */
    public function importSubscribersToGroup(int|string $groupId, array $subscribers): array
    {
        return $this->request('POST', '/groups/' . rawurlencode((string) $groupId) . '/import-subscribers', [
            'subscribers' => $subscribers,
        ]);
    }

    /**
     * List segments.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listSegments(array $params = []): array
    {
        return $this->request('GET', '/segments', $params);
    }

    /**
     * List subscribers in a segment.
     *
     * @param  int|string  $segmentId  Segment id.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listSegmentSubscribers(int|string $segmentId, array $params = []): array
    {
        return $this->request('GET', '/segments/' . rawurlencode((string) $segmentId) . '/subscribers', $params);
    }

    /**
     * Update a segment.
     *
     * @param  int|string  $segmentId  Segment id.
     * @param  array<string, mixed>  $payload  Segment payload.
     * @return array<string, mixed>
     */
    public function updateSegment(int|string $segmentId, array $payload): array
    {
        return $this->request('PUT', '/segments/' . rawurlencode((string) $segmentId), $payload);
    }

    /**
     * Delete a segment.
     *
     * @param  int|string  $segmentId  Segment id.
     * @return array<string, mixed>
     */
    public function deleteSegment(int|string $segmentId): array
    {
        return $this->request('DELETE', '/segments/' . rawurlencode((string) $segmentId));
    }

    /**
     * List subscriber fields.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listFields(array $params = []): array
    {
        return $this->request('GET', '/fields', $params);
    }

    /**
     * Create a subscriber field.
     *
     * @param  array<string, mixed>  $payload  Field payload.
     * @return array<string, mixed>
     */
    public function createField(array $payload): array
    {
        return $this->request('POST', '/fields', $payload);
    }

    /**
     * Update a subscriber field.
     *
     * @param  int|string  $fieldId  Field id.
     * @param  array<string, mixed>  $payload  Field payload.
     * @return array<string, mixed>
     */
    public function updateField(int|string $fieldId, array $payload): array
    {
        return $this->request('PUT', '/fields/' . rawurlencode((string) $fieldId), $payload);
    }

    /**
     * Delete a subscriber field.
     *
     * @param  int|string  $fieldId  Field id.
     * @return array<string, mixed>
     */
    public function deleteField(int|string $fieldId): array
    {
        return $this->request('DELETE', '/fields/' . rawurlencode((string) $fieldId));
    }

    /**
     * List automations.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listAutomations(array $params = []): array
    {
        return $this->request('GET', '/automations', $params);
    }

    /**
     * Get an automation.
     *
     * @param  int|string  $automationId  Automation id.
     * @return array<string, mixed>
     */
    public function getAutomation(int|string $automationId): array
    {
        return $this->request('GET', '/automations/' . rawurlencode((string) $automationId));
    }

    /**
     * List subscriber activity for an automation.
     *
     * @param  int|string  $automationId  Automation id.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listAutomationActivity(int|string $automationId, array $params = []): array
    {
        return $this->request('GET', '/automations/' . rawurlencode((string) $automationId) . '/activity', $params);
    }

    /**
     * Create a draft automation.
     *
     * @param  array<string, mixed>  $payload  Automation payload.
     * @return array<string, mixed>
     */
    public function createAutomation(array $payload): array
    {
        return $this->request('POST', '/automations', $payload);
    }

    /**
     * Delete an automation.
     *
     * @param  int|string  $automationId  Automation id.
     * @return array<string, mixed>
     */
    public function deleteAutomation(int|string $automationId): array
    {
        return $this->request('DELETE', '/automations/' . rawurlencode((string) $automationId));
    }

    /**
     * List campaigns.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listCampaigns(array $params = []): array
    {
        return $this->request('GET', '/campaigns', $params);
    }

    /**
     * Get a campaign.
     *
     * @param  int|string  $campaignId  Campaign id.
     * @return array<string, mixed>
     */
    public function getCampaign(int|string $campaignId): array
    {
        return $this->request('GET', '/campaigns/' . rawurlencode((string) $campaignId));
    }

    /**
     * Create a campaign.
     *
     * @param  array<string, mixed>  $payload  Campaign payload.
     * @return array<string, mixed>
     */
    public function createCampaign(array $payload): array
    {
        return $this->request('POST', '/campaigns', $payload);
    }

    /**
     * Update a campaign.
     *
     * @param  int|string  $campaignId  Campaign id.
     * @param  array<string, mixed>  $payload  Campaign payload.
     * @return array<string, mixed>
     */
    public function updateCampaign(int|string $campaignId, array $payload): array
    {
        return $this->request('PUT', '/campaigns/' . rawurlencode((string) $campaignId), $payload);
    }

    /**
     * Schedule a campaign.
     *
     * @param  int|string  $campaignId  Campaign id.
     * @param  array<string, mixed>  $payload  Schedule payload.
     * @return array<string, mixed>
     */
    public function scheduleCampaign(int|string $campaignId, array $payload): array
    {
        return $this->request('POST', '/campaigns/' . rawurlencode((string) $campaignId) . '/schedule', $payload);
    }

    /**
     * Cancel a campaign send.
     *
     * @param  int|string  $campaignId  Campaign id.
     * @return array<string, mixed>
     */
    public function cancelCampaign(int|string $campaignId): array
    {
        return $this->request('POST', '/campaigns/' . rawurlencode((string) $campaignId) . '/cancel');
    }

    /**
     * Delete a campaign.
     *
     * @param  int|string  $campaignId  Campaign id.
     * @return array<string, mixed>
     */
    public function deleteCampaign(int|string $campaignId): array
    {
        return $this->request('DELETE', '/campaigns/' . rawurlencode((string) $campaignId));
    }

    /**
     * List subscriber activity for a sent campaign.
     *
     * @param  int|string  $campaignId  Campaign id.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listCampaignSubscriberActivity(int|string $campaignId, array $params = []): array
    {
        return $this->request('GET', '/campaigns/' . rawurlencode((string) $campaignId) . '/reports/subscriber-activity', $params);
    }

    /**
     * List forms by type.
     *
     * @param  string  $type  Form type: popup, embedded, or promotion.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listForms(string $type, array $params = []): array
    {
        return $this->request('GET', '/forms/' . rawurlencode($type), $params);
    }

    /**
     * Get a form.
     *
     * @param  int|string  $formId  Form id.
     * @return array<string, mixed>
     */
    public function getForm(int|string $formId): array
    {
        return $this->request('GET', '/forms/' . rawurlencode((string) $formId));
    }

    /**
     * Update a form.
     *
     * @param  int|string  $formId  Form id.
     * @param  array<string, mixed>  $payload  Form payload.
     * @return array<string, mixed>
     */
    public function updateForm(int|string $formId, array $payload): array
    {
        return $this->request('PUT', '/forms/' . rawurlencode((string) $formId), $payload);
    }

    /**
     * Delete a form.
     *
     * @param  int|string  $formId  Form id.
     * @return array<string, mixed>
     */
    public function deleteForm(int|string $formId): array
    {
        return $this->request('DELETE', '/forms/' . rawurlencode((string) $formId));
    }

    /**
     * List subscribers who signed up through a form.
     *
     * @param  int|string  $formId  Form id.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listFormSubscribers(int|string $formId, array $params = []): array
    {
        return $this->request('GET', '/forms/' . rawurlencode((string) $formId) . '/subscribers', $params);
    }

    /**
     * List webhooks.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function listWebhooks(array $params = []): array
    {
        return $this->request('GET', '/webhooks', $params);
    }

    /**
     * Get a webhook.
     *
     * @param  int|string  $webhookId  Webhook id.
     * @return array<string, mixed>
     */
    public function getWebhook(int|string $webhookId): array
    {
        return $this->request('GET', '/webhooks/' . rawurlencode((string) $webhookId));
    }

    /**
     * Create a webhook.
     *
     * @param  array<string, mixed>  $payload  Webhook payload.
     * @return array<string, mixed>
     */
    public function createWebhook(array $payload): array
    {
        return $this->request('POST', '/webhooks', $payload);
    }

    /**
     * Update a webhook.
     *
     * @param  int|string  $webhookId  Webhook id.
     * @param  array<string, mixed>  $payload  Webhook payload.
     * @return array<string, mixed>
     */
    public function updateWebhook(int|string $webhookId, array $payload): array
    {
        return $this->request('PUT', '/webhooks/' . rawurlencode((string) $webhookId), $payload);
    }

    /**
     * Delete a webhook.
     *
     * @param  int|string  $webhookId  Webhook id.
     * @return array<string, mixed>
     */
    public function deleteWebhook(int|string $webhookId): array
    {
        return $this->request('DELETE', '/webhooks/' . rawurlencode((string) $webhookId));
    }

    /**
     * Execute a MailerLite batch request.
     *
     * @param  array<int, array<string, mixed>>  $requests  Batch request objects.
     * @return array<string, mixed>
     */
    public function batch(array $requests): array
    {
        return $this->request('POST', '/batch', ['requests' => $requests]);
    }

    /**
     * Execute a GET request against a safe relative MailerLite API path.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $params = []): array
    {
        return $this->request('GET', $this->normalizePath($path), $params);
    }

    /**
     * Execute a POST request against a safe relative MailerLite API path.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $payload  JSON payload.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $payload = []): array
    {
        return $this->request('POST', $this->normalizePath($path), $payload);
    }

    /**
     * Execute a PUT request against a safe relative MailerLite API path.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $payload  JSON payload.
     * @return array<string, mixed>
     */
    public function apiPut(string $path, array $payload = []): array
    {
        return $this->request('PUT', $this->normalizePath($path), $payload);
    }

    /**
     * Execute a PATCH request against a safe relative MailerLite API path.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $payload  JSON payload.
     * @return array<string, mixed>
     */
    public function apiPatch(string $path, array $payload = []): array
    {
        return $this->request('PATCH', $this->normalizePath($path), $payload);
    }

    /**
     * Execute a DELETE request against a safe relative MailerLite API path.
     *
     * @param  string  $path  Relative API path.
     * @param  array<string, mixed>  $payload  JSON payload.
     * @return array<string, mixed>
     */
    public function apiDelete(string $path, array $payload = []): array
    {
        return $this->request('DELETE', $this->normalizePath($path), $payload);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query params or body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        if ($response->status() === 204 || trim($response->body()) === '') {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the MailerLite API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query params or body.
     * @return Response
     *
     * @throws RuntimeException On auth failure, connection error, or API error.
     */
    private function rawRequest(string $method, string $path, array $data = []): Response
    {
        if (!$this->apiKey) {
            throw new RuntimeException('MailerLite API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'PATCH' => $http->patch($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('message') ?? $response->json('error') ?? $response->body();
                Log::error("MailerLite API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new RuntimeException("MailerLite API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("MailerLite API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new RuntimeException("Failed to connect to MailerLite API: {$e->getMessage()}");
        }
    }

    /**
     * Normalize raw helper paths to safe relative API paths.
     *
     * @param  string  $path  Relative API path.
     */
    private function normalizePath(string $path): string
    {
        $path = '/' . ltrim(trim($path), '/');

        if ($path === '/' || str_contains($path, '://') || str_contains($path, '//')) {
            throw new RuntimeException('Path must be a non-empty relative MailerLite API path.');
        }

        return $path;
    }
}
