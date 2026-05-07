<?php

namespace OpenCompany\Integrations\Typefully;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the Typefully API v2.
 *
 * Handles bearer-token authentication and social-set-scoped draft, media, tag, and queue operations.
 */
class TypefullyService
{
    /**
     * @param  string  $apiKey  Typefully API v2 key.
     * @param  string  $baseUrl  Typefully API base URL.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = 'https://api.typefully.com/v2',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the Typefully integration is properly configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiKey);
    }

    /**
     * Get the currently authenticated Typefully user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/me');
    }

    /**
     * List social sets available to the authenticated account.
     *
     * @param  array<string, mixed>  $params  Query parameters such as limit and offset.
     * @return array<string, mixed>
     */
    public function listSocialSets(array $params = []): array
    {
        return $this->request('GET', '/social-sets', $params);
    }

    /**
     * Get one social set by id.
     *
     * @param  string  $socialSetId  Social set identifier.
     * @return array<string, mixed>
     */
    public function getSocialSet(string $socialSetId): array
    {
        return $this->request('GET', '/social-sets/' . urlencode($socialSetId));
    }

    /**
     * List drafts for a social set.
     *
     * @param  string  $socialSetId  Social set identifier.
     * @param  array<string, mixed>  $params  Query parameters (status, tags, limit, offset, sort).
     * @return array<string, mixed>
     */
    public function listDrafts(string $socialSetId, array $params = []): array
    {
        return $this->request('GET', "/social-sets/{$socialSetId}/drafts", $params);
    }

    /**
     * Create a draft for a social set.
     *
     * @param  string  $socialSetId  Social set identifier.
     * @param  array<string, mixed>  $payload  Draft payload using Typefully v2 platforms structure.
     * @return array<string, mixed>
     */
    public function createDraft(string $socialSetId, array $payload): array
    {
        return $this->request('POST', "/social-sets/{$socialSetId}/drafts", $payload);
    }

    /**
     * Get a single draft by id.
     *
     * @param  string  $socialSetId  Social set identifier.
     * @param  string  $draftId  Draft identifier.
     * @return array<string, mixed>
     */
    public function getDraft(string $socialSetId, string $draftId): array
    {
        return $this->request('GET', "/social-sets/{$socialSetId}/drafts/" . urlencode($draftId));
    }

    /**
     * Update a draft.
     *
     * @param  string  $socialSetId  Social set identifier.
     * @param  string  $draftId  Draft identifier.
     * @param  array<string, mixed>  $updates  Draft fields to update.
     * @return array<string, mixed>
     */
    public function updateDraft(string $socialSetId, string $draftId, array $updates): array
    {
        return $this->request('PATCH', "/social-sets/{$socialSetId}/drafts/" . urlencode($draftId), $updates);
    }

    /**
     * Delete a draft.
     *
     * @param  string  $socialSetId  Social set identifier.
     * @param  string  $draftId  Draft identifier.
     */
    public function deleteDraft(string $socialSetId, string $draftId): void
    {
        $this->request('DELETE', "/social-sets/{$socialSetId}/drafts/" . urlencode($draftId));
    }

    /**
     * Request a presigned upload URL for media.
     *
     * @param  string  $socialSetId  Social set identifier.
     * @param  array<string, mixed>  $payload  Media upload request fields.
     * @return array<string, mixed>
     */
    public function requestMediaUpload(string $socialSetId, array $payload): array
    {
        return $this->request('POST', "/social-sets/{$socialSetId}/media/upload", $payload);
    }

    /**
     * Get media processing status.
     *
     * @param  string  $socialSetId  Social set identifier.
     * @param  string  $mediaId  Media identifier.
     * @return array<string, mixed>
     */
    public function getMedia(string $socialSetId, string $mediaId): array
    {
        return $this->request('GET', "/social-sets/{$socialSetId}/media/" . urlencode($mediaId));
    }

    /**
     * List tags for a social set.
     *
     * @param  string  $socialSetId  Social set identifier.
     * @param  array<string, mixed>  $params  Query parameters such as limit and offset.
     * @return array<string, mixed>
     */
    public function listTags(string $socialSetId, array $params = []): array
    {
        return $this->request('GET', "/social-sets/{$socialSetId}/tags", $params);
    }

    /**
     * Create a tag for a social set.
     *
     * @param  string  $socialSetId  Social set identifier.
     * @param  string  $name  Tag display name.
     * @return array<string, mixed>
     */
    public function createTag(string $socialSetId, string $name): array
    {
        return $this->request('POST', "/social-sets/{$socialSetId}/tags", ['name' => $name]);
    }

    /**
     * Get upcoming scheduled content for a social set.
     *
     * @param  string  $socialSetId  Social set identifier.
     * @param  array<string, mixed>  $params  Query parameters such as limit and offset.
     * @return array<string, mixed>
     */
    public function getQueue(string $socialSetId, array $params = []): array
    {
        return $this->request('GET', "/social-sets/{$socialSetId}/queue", $params);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query params or JSON body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        if ($response->body() === '') {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Typefully API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path  API path.
     * @param  array<string, mixed>  $data  Query params or JSON body.
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiKey) {
            throw new \RuntimeException('Typefully API key is not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PATCH' => $http->patch($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $contentType = $response->header('Content-Type');
                $body = $response->body();

                if (str_contains($contentType ?? '', 'text/html') || str_starts_with(trim($body), '<!DOCTYPE')) {
                    Log::warning("Typefully API returned HTML for {$method} {$path}", [
                        'status' => $response->status(),
                    ]);
                    throw new \RuntimeException("Typefully API endpoint not available (HTTP {$response->status()}). The {$path} endpoint may be incorrect.");
                }

                $error = $response->json('error') ?? $response->json('message') ?? $body;
                Log::error("Typefully API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);
                throw new \RuntimeException("Typefully API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Typefully API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Typefully API: {$e->getMessage()}");
        }
    }
}
