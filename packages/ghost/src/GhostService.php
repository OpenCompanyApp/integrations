<?php

namespace OpenCompany\Integrations\Ghost;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the Ghost Admin API.
 *
 * Handles Admin API JWT generation, safe URL construction, error logging, and
 * JSON response parsing for content, members, newsletters, tiers, offers, and webhooks.
 */
class GhostService
{
    /**
     * @param  string  $apiKey  Ghost Admin API key in id:secret format.
     * @param  string  $baseUrl  Ghost Admin API base URL, for example https://site.test/ghost/api/admin.
     */
    public function __construct(
        private string $apiKey = '',
        private string $baseUrl = '',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the Ghost integration has an API key and base URL.
     */
    public function isConfigured(): bool
    {
        return $this->apiKey !== '' && $this->baseUrl !== '';
    }

    /*
    |--------------------------------------------------------------------------
    | Posts and pages
    |--------------------------------------------------------------------------
    */

    /** @param array<string, mixed> $params @return array<string, mixed> */
    public function listPosts(array $params = []): array { return $this->collectionGet('posts', $params); }
    /** @param array<string, mixed> $params @return array<string, mixed> */
    public function listPages(array $params = []): array { return $this->collectionGet('pages', $params); }
    /** @param array<string, mixed> $params @return array<string, mixed> */
    public function getPost(string $id, array $params = []): array { return $this->collectionGetOne('posts', $id, $params); }
    /** @param array<string, mixed> $params @return array<string, mixed> */
    public function getPage(string $id, array $params = []): array { return $this->collectionGetOne('pages', $id, $params); }
    /** @param array<string, mixed> $data @return array<string, mixed> */
    public function createPost(array $data): array { return $this->collectionCreate('posts', $data); }
    /** @param array<string, mixed> $data @return array<string, mixed> */
    public function createPage(array $data): array { return $this->collectionCreate('pages', $data); }
    /** @param array<string, mixed> $data @return array<string, mixed> */
    public function updatePost(string $id, array $data): array { return $this->collectionUpdate('posts', $id, $data); }
    /** @param array<string, mixed> $data @return array<string, mixed> */
    public function updatePage(string $id, array $data): array { return $this->collectionUpdate('pages', $id, $data); }
    /** @return array<string, mixed> */
    public function deletePost(string $id): array { return $this->collectionDelete('posts', $id); }
    /** @return array<string, mixed> */
    public function deletePage(string $id): array { return $this->collectionDelete('pages', $id); }

    /*
    |--------------------------------------------------------------------------
    | Tags, authors, members, tiers, offers, newsletters, webhooks
    |--------------------------------------------------------------------------
    */

    /** @param array<string, mixed> $params @return array<string, mixed> */
    public function listTags(array $params = []): array { return $this->collectionGet('tags', $params); }
    /** @param array<string, mixed> $params @return array<string, mixed> */
    public function getTag(string $id, array $params = []): array { return $this->collectionGetOne('tags', $id, $params); }
    /** @param array<string, mixed> $data @return array<string, mixed> */
    public function createTag(array $data): array { return $this->collectionCreate('tags', $data); }
    /** @param array<string, mixed> $data @return array<string, mixed> */
    public function updateTag(string $id, array $data): array { return $this->collectionUpdate('tags', $id, $data); }
    /** @return array<string, mixed> */
    public function deleteTag(string $id): array { return $this->collectionDelete('tags', $id); }

    /** @param array<string, mixed> $params @return array<string, mixed> */
    public function listAuthors(array $params = []): array { return $this->collectionGet('users', $params); }
    /** @param array<string, mixed> $params @return array<string, mixed> */
    public function getAuthor(string $id, array $params = []): array { return $this->collectionGetOne('users', $id, $params); }

    /** @param array<string, mixed> $params @return array<string, mixed> */
    public function listMembers(array $params = []): array { return $this->collectionGet('members', $params); }
    /** @param array<string, mixed> $params @return array<string, mixed> */
    public function getMember(string $id, array $params = []): array { return $this->collectionGetOne('members', $id, $params); }
    /** @param array<string, mixed> $data @return array<string, mixed> */
    public function createMember(array $data): array { return $this->collectionCreate('members', $data); }
    /** @param array<string, mixed> $data @return array<string, mixed> */
    public function updateMember(string $id, array $data): array { return $this->collectionUpdate('members', $id, $data); }
    /** @return array<string, mixed> */
    public function deleteMember(string $id): array { return $this->collectionDelete('members', $id); }

    /** @param array<string, mixed> $params @return array<string, mixed> */
    public function listTiers(array $params = []): array { return $this->collectionGet('tiers', $params); }
    /** @param array<string, mixed> $params @return array<string, mixed> */
    public function getTier(string $id, array $params = []): array { return $this->collectionGetOne('tiers', $id, $params); }
    /** @param array<string, mixed> $data @return array<string, mixed> */
    public function createTier(array $data): array { return $this->collectionCreate('tiers', $data); }
    /** @param array<string, mixed> $data @return array<string, mixed> */
    public function updateTier(string $id, array $data): array { return $this->collectionUpdate('tiers', $id, $data); }

    /** @param array<string, mixed> $params @return array<string, mixed> */
    public function listOffers(array $params = []): array { return $this->collectionGet('offers', $params); }
    /** @param array<string, mixed> $params @return array<string, mixed> */
    public function getOffer(string $id, array $params = []): array { return $this->collectionGetOne('offers', $id, $params); }
    /** @param array<string, mixed> $data @return array<string, mixed> */
    public function createOffer(array $data): array { return $this->collectionCreate('offers', $data); }
    /** @param array<string, mixed> $data @return array<string, mixed> */
    public function updateOffer(string $id, array $data): array { return $this->collectionUpdate('offers', $id, $data); }

    /** @param array<string, mixed> $params @return array<string, mixed> */
    public function listNewsletters(array $params = []): array { return $this->collectionGet('newsletters', $params); }
    /** @param array<string, mixed> $params @return array<string, mixed> */
    public function getNewsletter(string $id, array $params = []): array { return $this->collectionGetOne('newsletters', $id, $params); }

    /** @param array<string, mixed> $params @return array<string, mixed> */
    public function listWebhooks(array $params = []): array { return $this->collectionGet('webhooks', $params); }
    /** @param array<string, mixed> $data @return array<string, mixed> */
    public function createWebhook(array $data): array { return $this->collectionCreate('webhooks', $data); }
    /** @param array<string, mixed> $data @return array<string, mixed> */
    public function updateWebhook(string $id, array $data): array { return $this->collectionUpdate('webhooks', $id, $data); }
    /** @return array<string, mixed> */
    public function deleteWebhook(string $id): array { return $this->collectionDelete('webhooks', $id); }

    /*
    |--------------------------------------------------------------------------
    | Site/user and raw helpers
    |--------------------------------------------------------------------------
    */

    /** @return array<string, mixed> */
    public function getCurrentUser(): array { return $this->request('GET', '/users/me'); }
    /** @return array<string, mixed> */
    public function getSite(): array { return $this->request('GET', '/site'); }
    /** @param array<string, mixed> $query @return array<string, mixed> */
    public function apiGet(string $path, array $query = []): array { return $this->request('GET', $path, query: $query); }
    /** @param array<string, mixed> $body @param array<string, mixed> $query @return array<string, mixed> */
    public function apiPost(string $path, array $body = [], array $query = []): array { return $this->request('POST', $path, query: $query, body: $body); }
    /** @param array<string, mixed> $body @param array<string, mixed> $query @return array<string, mixed> */
    public function apiPut(string $path, array $body = [], array $query = []): array { return $this->request('PUT', $path, query: $query, body: $body); }
    /** @param array<string, mixed> $query @return array<string, mixed> */
    public function apiDelete(string $path, array $query = []): array { return $this->request('DELETE', $path, query: $query); }

    /** @param array<string, mixed> $params @return array<string, mixed> */
    private function collectionGet(string $resource, array $params = []): array { return $this->request('GET', '/'.$resource, query: $params); }
    /** @param array<string, mixed> $params @return array<string, mixed> */
    private function collectionGetOne(string $resource, string $id, array $params = []): array { return $this->request('GET', '/'.$resource.'/'.$this->segment($id), query: $params); }
    /** @param array<string, mixed> $data @return array<string, mixed> */
    private function collectionCreate(string $resource, array $data): array { return $this->request('POST', '/'.$resource, body: [$resource => [$data]]); }
    /** @param array<string, mixed> $data @return array<string, mixed> */
    private function collectionUpdate(string $resource, string $id, array $data): array { return $this->request('PUT', '/'.$resource.'/'.$this->segment($id), body: [$resource => [$data]]); }
    /** @return array<string, mixed> */
    private function collectionDelete(string $resource, string $id): array { return $this->request('DELETE', '/'.$resource.'/'.$this->segment($id)); }

    /**
     * Generate a Ghost Admin API JWT token from the API key.
     */
    private function generateToken(int $exp = 300): string
    {
        $parts = explode(':', $this->apiKey);
        if (count($parts) !== 2) {
            throw new RuntimeException('Invalid Ghost API key format. Expected "id:secret".');
        }

        [$id, $secret] = $parts;
        $secretDecoded = hex2bin($secret);
        if ($secretDecoded === false) {
            throw new RuntimeException('Invalid Ghost API key secret; not valid hex.');
        }

        $now = time();
        $header = $this->base64UrlEncode(json_encode(['alg' => 'HS256', 'typ' => 'JWT', 'kid' => $id], JSON_THROW_ON_ERROR));
        $payload = $this->base64UrlEncode(json_encode(['iat' => $now, 'exp' => $now + $exp, 'aud' => '/admin/'], JSON_THROW_ON_ERROR));
        $signature = $this->base64UrlEncode(hash_hmac('sha256', "{$header}.{$payload}", $secretDecoded, true));

        return "{$header}.{$payload}.{$signature}";
    }

    /**
     * Base64URL encode a string without padding.
     */
    private function base64UrlEncode(string $data): string
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $body  JSON body.
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $query = [], array $body = []): array
    {
        $response = $this->rawRequest($method, $path, $query, $body);

        if ($response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Ghost Admin API.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     * @param  array<string, mixed>  $body  JSON body.
     * @return Response
     *
     * @throws RuntimeException
     */
    private function rawRequest(string $method, string $path, array $query = [], array $body = []): Response
    {
        if (!$this->isConfigured()) {
            throw new RuntimeException('Ghost integration is not configured. Provide an API key and base URL.');
        }

        $url = $this->buildUrl($path, $query);
        $token = $this->generateToken();

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Ghost '.$token,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Accept-Version' => 'v5.0',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url),
                'POST' => $http->post($url, $body),
                'PUT' => $http->put($url, $body),
                'DELETE' => $http->delete($url, $body),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('errors.0.message') ?? $response->body();
                Log::error("Ghost API error: {$method} {$path}", ['status' => $response->status(), 'error' => $error]);
                throw new RuntimeException("Ghost API error ({$response->status()}): ".(is_string($error) ? $error : json_encode($error)));
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Ghost API connection error: {$method} {$path}", ['error' => $e->getMessage()]);
            throw new RuntimeException("Failed to connect to Ghost API: {$e->getMessage()}");
        }
    }

    /**
     * Build a safe URL below the configured Ghost Admin API root.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     */
    private function buildUrl(string $path, array $query = []): string
    {
        if (preg_match('/^https?:\/\//i', $path) === 1 || str_contains($path, '..')) {
            throw new RuntimeException('Ghost API path must be a safe relative path.');
        }

        $path = '/'.ltrim($path, '/');
        $queryString = $this->buildQuery($query);

        return $this->baseUrl.$path.($queryString !== '' ? '?'.$queryString : '');
    }

    /**
     * Build a query string while preserving repeated array values.
     *
     * @param  array<string, mixed>  $query  Query string parameters.
     */
    private function buildQuery(array $query): string
    {
        $pairs = [];

        foreach ($query as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }

            if (is_bool($value)) {
                $value = $value ? 'true' : 'false';
            }

            if (is_array($value)) {
                foreach ($value as $item) {
                    $pairs[] = rawurlencode((string) $key).'='.rawurlencode(is_scalar($item) ? (string) $item : json_encode($item, JSON_THROW_ON_ERROR));
                }
                continue;
            }

            $pairs[] = rawurlencode((string) $key).'='.rawurlencode((string) $value);
        }

        return implode('&', $pairs);
    }

    /**
     * URL encode one path segment.
     */
    private function segment(string $value): string
    {
        return rawurlencode($value);
    }
}
