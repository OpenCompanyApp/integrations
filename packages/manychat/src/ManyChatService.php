<?php

namespace OpenCompany\Integrations\ManyChat;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Manychat Account Public API.
 *
 * Handles bearer authentication, official /fb page, sending, and subscriber
 * endpoints, profile-template requests, and normalized API errors.
 */
class ManyChatService
{
    /**
     * @param  string  $apiKey  Manychat Account Public API key.
     * @param  string  $baseUrl  Manychat API base URL.
     * @param  string  $profileApiKey  Optional Profile Public API key for template endpoints.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.manychat.com',
        private string $profileApiKey = '',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->apiKey !== '';
    }

    /**
     * Get page/account information for the configured bot.
     *
     * @return array<string, mixed>
     */
    public function getPageInfo(): array
    {
        return $this->request('GET', '/fb/page/getInfo');
    }

    /**
     * Backward-compatible alias for the page info endpoint.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->getPageInfo();
    }

    /**
     * List flows configured in the bot.
     *
     * @return array<string, mixed>
     */
    public function listFlows(): array
    {
        return $this->request('GET', '/fb/page/getFlows');
    }

    /**
     * Find a flow in the listFlows response by flow namespace or ID.
     *
     * Manychat's public API lists flows but does not expose a documented
     * single-flow read endpoint, so this method performs a safe client-side
     * lookup over the documented list endpoint.
     *
     * @return array<string, mixed>
     */
    public function getFlow(string $flowNs): array
    {
        $flows = $this->listFlows();
        $items = $flows['data'] ?? $flows['flows'] ?? $flows['results'] ?? [];

        if (is_array($items)) {
            foreach ($items as $item) {
                if (!is_array($item)) {
                    continue;
                }

                foreach (['flow_ns', 'ns', 'id', 'page_id'] as $key) {
                    if ((string) ($item[$key] ?? '') === $flowNs) {
                        return $item;
                    }
                }
            }
        }

        return [
            'status' => 'not_found',
            'message' => 'Manychat does not expose a documented get-flow endpoint; no matching flow was found in getFlows.',
            'flow_ns' => $flowNs,
        ];
    }

    /**
     * List tags in the bot.
     *
     * @return array<string, mixed>
     */
    public function listTags(): array
    {
        return $this->request('GET', '/fb/page/getTags');
    }

    /**
     * Create a tag.
     *
     * @return array<string, mixed>
     */
    public function createTag(string $name): array
    {
        return $this->request('POST', '/fb/page/createTag', ['name' => $name]);
    }

    /**
     * Remove a tag by numeric tag ID.
     *
     * @return array<string, mixed>
     */
    public function removeTag(int $tagId): array
    {
        return $this->request('POST', '/fb/page/removeTag', ['tag_id' => $tagId]);
    }

    /**
     * Remove a tag by name.
     *
     * @return array<string, mixed>
     */
    public function removeTagByName(string $tagName): array
    {
        return $this->request('POST', '/fb/page/removeTagByName', ['tag_name' => $tagName]);
    }

    /**
     * List widgets/growth tools.
     *
     * @return array<string, mixed>
     */
    public function listWidgets(): array
    {
        return $this->request('GET', '/fb/page/getWidgets');
    }

    /**
     * List growth tools.
     *
     * @return array<string, mixed>
     */
    public function listGrowthTools(): array
    {
        return $this->request('GET', '/fb/page/getGrowthTools');
    }

    /**
     * List custom user fields.
     *
     * @return array<string, mixed>
     */
    public function listCustomFields(): array
    {
        return $this->request('GET', '/fb/page/getCustomFields');
    }

    /**
     * Create a custom user field.
     *
     * @param  array<string, mixed>  $data  Custom field payload with caption, type, and optional description.
     * @return array<string, mixed>
     */
    public function createCustomField(array $data): array
    {
        return $this->request('POST', '/fb/page/createCustomField', $data);
    }

    /**
     * List one-time notification topics.
     *
     * @return array<string, mixed>
     */
    public function listOtnTopics(): array
    {
        return $this->request('GET', '/fb/page/getOtnTopics');
    }

    /**
     * List bot fields.
     *
     * @return array<string, mixed>
     */
    public function listBotFields(): array
    {
        return $this->request('GET', '/fb/page/getBotFields');
    }

    /**
     * Create a bot field.
     *
     * @param  array<string, mixed>  $data  Bot field payload with name, type, optional description, and optional value.
     * @return array<string, mixed>
     */
    public function createBotField(array $data): array
    {
        return $this->request('POST', '/fb/page/createBotField', $data);
    }

    /**
     * Set a bot field by ID.
     *
     * @param  mixed  $value  Field value.
     * @return array<string, mixed>
     */
    public function setBotField(int $fieldId, mixed $value): array
    {
        return $this->request('POST', '/fb/page/setBotField', [
            'field_id' => $fieldId,
            'field_value' => $value,
        ]);
    }

    /**
     * Set a bot field by name.
     *
     * @param  mixed  $value  Field value.
     * @return array<string, mixed>
     */
    public function setBotFieldByName(string $fieldName, mixed $value): array
    {
        return $this->request('POST', '/fb/page/setBotFieldByName', [
            'field_name' => $fieldName,
            'field_value' => $value,
        ]);
    }

    /**
     * Set multiple bot fields.
     *
     * @param  array<int, array<string, mixed>>  $fields  Bot field updates.
     * @return array<string, mixed>
     */
    public function setBotFields(array $fields): array
    {
        return $this->request('POST', '/fb/page/setBotFields', ['fields' => $fields]);
    }

    /**
     * Send content to a subscriber.
     *
     * @param  array<string, mixed>  $payload  sendContent payload.
     * @return array<string, mixed>
     */
    public function sendContent(array $payload): array
    {
        return $this->request('POST', '/fb/sending/sendContent', $payload);
    }

    /**
     * Backward-compatible alias for sendContent.
     *
     * @param  array<string, mixed>  $message  Message payload from the legacy tool.
     * @return array<string, mixed>
     */
    public function sendMessage(array $message): array
    {
        $payload = $message;

        if (isset($message['message']) && !isset($message['data'])) {
            $payload['data'] = $message['message'];
            unset($payload['message']);
        }

        unset($payload['message_type']);

        return $this->sendContent($payload);
    }

    /**
     * Send content by user_ref.
     *
     * @param  array<string, mixed>  $payload  sendContentByUserRef payload.
     * @return array<string, mixed>
     */
    public function sendContentByUserRef(array $payload): array
    {
        return $this->request('POST', '/fb/sending/sendContentByUserRef', $payload);
    }

    /**
     * Send a flow to a subscriber.
     *
     * @return array<string, mixed>
     */
    public function sendFlow(int $subscriberId, string $flowNs): array
    {
        return $this->request('POST', '/fb/sending/sendFlow', [
            'subscriber_id' => $subscriberId,
            'flow_ns' => $flowNs,
        ]);
    }

    /**
     * Get subscriber information by subscriber ID.
     *
     * @return array<string, mixed>
     */
    public function getSubscriberInfo(int $subscriberId): array
    {
        return $this->request('GET', '/fb/subscriber/getInfo', ['subscriber_id' => $subscriberId]);
    }

    /**
     * Find subscribers by name.
     *
     * @return array<string, mixed>
     */
    public function findSubscriberByName(string $name): array
    {
        return $this->request('GET', '/fb/subscriber/findByName', ['name' => $name]);
    }

    /**
     * Get subscriber information by user_ref.
     *
     * @return array<string, mixed>
     */
    public function getSubscriberInfoByUserRef(int $userRef): array
    {
        return $this->request('GET', '/fb/subscriber/getInfoByUserRef', ['user_ref' => $userRef]);
    }

    /**
     * Find subscribers by custom field.
     *
     * @param  mixed  $fieldValue  Custom field value.
     * @return array<string, mixed>
     */
    public function findSubscriberByCustomField(int $fieldId, mixed $fieldValue): array
    {
        return $this->request('GET', '/fb/subscriber/findByCustomField', [
            'field_id' => $fieldId,
            'field_value' => $fieldValue,
        ]);
    }

    /**
     * Find subscribers by email or phone system field.
     *
     * @param  array<string, mixed>  $params  Query parameters containing email and/or phone.
     * @return array<string, mixed>
     */
    public function findSubscriberBySystemField(array $params): array
    {
        return $this->request('GET', '/fb/subscriber/findBySystemField', $params);
    }

    /**
     * Add a tag to a subscriber by tag ID.
     *
     * @return array<string, mixed>
     */
    public function addSubscriberTag(int $subscriberId, int $tagId): array
    {
        return $this->request('POST', '/fb/subscriber/addTag', [
            'subscriber_id' => $subscriberId,
            'tag_id' => $tagId,
        ]);
    }

    /**
     * Add a tag to a subscriber by tag name.
     *
     * @return array<string, mixed>
     */
    public function addSubscriberTagByName(int $subscriberId, string $tagName): array
    {
        return $this->request('POST', '/fb/subscriber/addTagByName', [
            'subscriber_id' => $subscriberId,
            'tag_name' => $tagName,
        ]);
    }

    /**
     * Remove a tag from a subscriber by tag ID.
     *
     * @return array<string, mixed>
     */
    public function removeSubscriberTag(int $subscriberId, int $tagId): array
    {
        return $this->request('POST', '/fb/subscriber/removeTag', [
            'subscriber_id' => $subscriberId,
            'tag_id' => $tagId,
        ]);
    }

    /**
     * Remove a tag from a subscriber by tag name.
     *
     * @return array<string, mixed>
     */
    public function removeSubscriberTagByName(int $subscriberId, string $tagName): array
    {
        return $this->request('POST', '/fb/subscriber/removeTagByName', [
            'subscriber_id' => $subscriberId,
            'tag_name' => $tagName,
        ]);
    }

    /**
     * Set one custom field on a subscriber by field ID.
     *
     * @param  mixed  $value  Field value.
     * @return array<string, mixed>
     */
    public function setSubscriberCustomField(int $subscriberId, int $fieldId, mixed $value): array
    {
        return $this->request('POST', '/fb/subscriber/setCustomField', [
            'subscriber_id' => $subscriberId,
            'field_id' => $fieldId,
            'field_value' => $value,
        ]);
    }

    /**
     * Set multiple custom fields on a subscriber.
     *
     * @param  array<int, array<string, mixed>>  $fields  Field update objects.
     * @return array<string, mixed>
     */
    public function setSubscriberCustomFields(int $subscriberId, array $fields): array
    {
        return $this->request('POST', '/fb/subscriber/setCustomFields', [
            'subscriber_id' => $subscriberId,
            'fields' => $fields,
        ]);
    }

    /**
     * Set one custom field on a subscriber by field name.
     *
     * @param  mixed  $value  Field value.
     * @return array<string, mixed>
     */
    public function setSubscriberCustomFieldByName(int $subscriberId, string $fieldName, mixed $value): array
    {
        return $this->request('POST', '/fb/subscriber/setCustomFieldByName', [
            'subscriber_id' => $subscriberId,
            'field_name' => $fieldName,
            'field_value' => $value,
        ]);
    }

    /**
     * Verify a subscriber signed request.
     *
     * @return array<string, mixed>
     */
    public function verifySubscriberSignedRequest(int $subscriberId, string $signedRequest): array
    {
        return $this->request('POST', '/fb/subscriber/verifyBySignedRequest', [
            'subscriber_id' => $subscriberId,
            'signed_request' => $signedRequest,
        ]);
    }

    /**
     * Create a subscriber.
     *
     * @param  array<string, mixed>  $data  Subscriber creation payload.
     * @return array<string, mixed>
     */
    public function createSubscriber(array $data): array
    {
        return $this->request('POST', '/fb/subscriber/createSubscriber', $data);
    }

    /**
     * Update a subscriber.
     *
     * @param  array<string, mixed>  $data  Subscriber update payload.
     * @return array<string, mixed>
     */
    public function updateSubscriber(array $data): array
    {
        return $this->request('POST', '/fb/subscriber/updateSubscriber', $data);
    }

    /**
     * Generate a single-use template installation link using the Profile API key when configured.
     *
     * @return array<string, mixed>
     */
    public function generateTemplateSingleUseLink(int $templateId): array
    {
        return $this->request('POST', '/user/template/generateSingleUseLink', [
            'template_id' => $templateId,
        ], $this->profileApiKey !== '' ? $this->profileApiKey : $this->apiKey);
    }

    /**
     * Call a documented Manychat GET endpoint.
     *
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function apiGet(string $path, array $params = []): array
    {
        return $this->request('GET', $path, $params);
    }

    /**
     * Call a documented Manychat POST endpoint.
     *
     * @param  array<string, mixed>  $body  JSON request body.
     * @return array<string, mixed>
     */
    public function apiPost(string $path, array $body = []): array
    {
        return $this->request('POST', $path, $body);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = [], ?string $apiKey = null): array
    {
        return $this->jsonResponse($this->rawRequest($method, $path, $data, $apiKey));
    }

    /**
     * Make a raw HTTP request to the Manychat API.
     *
     * @param  array<string, mixed>  $data  Query parameters or request body.
     * @return Response
     */
    private function rawRequest(string $method, string $path, array $data = [], ?string $apiKey = null): Response
    {
        $token = $apiKey ?? $this->apiKey;

        if ($token === '') {
            throw new \RuntimeException('Manychat API key is not configured.');
        }

        $url = $this->url($path);

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $this->throwApiError($method, $path, $response);
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Manychat API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Manychat API: {$e->getMessage()}");
        }
    }

    /**
     * Build a full request URL from a relative Manychat API path.
     */
    private function url(string $path): string
    {
        $path = ltrim(trim($path), '/');

        if ($path === '') {
            throw new \InvalidArgumentException('Manychat API path is required.');
        }

        if (preg_match('#^https?://#i', $path) === 1) {
            throw new \InvalidArgumentException('Use a Manychat API path relative to the configured base URL.');
        }

        return $this->baseUrl . '/' . $path;
    }

    /**
     * Return parsed JSON from the API response.
     *
     * @return array<string, mixed>
     */
    private function jsonResponse(Response $response): array
    {
        return $response->json() ?? [];
    }

    /**
     * Throw a normalized API exception.
     *
     * @throws \RuntimeException
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $contentType = (string) $response->header('Content-Type');
        $body = $response->body();

        if (str_contains($contentType, 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
            Log::warning("Manychat API returned HTML for {$method} {$path}", [
                'status' => $response->status(),
            ]);
            throw new \RuntimeException("Manychat API returned an unexpected response (HTTP {$response->status()}). The {$path} endpoint may be unavailable or the URL may be incorrect.");
        }

        $error = $response->json('message') ?? $response->json('error') ?? $body;
        Log::error("Manychat API error: {$method} {$path}", [
            'status' => $response->status(),
            'error' => $error,
        ]);
        throw new \RuntimeException("Manychat API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
    }
}
