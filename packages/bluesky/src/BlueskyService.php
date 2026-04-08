<?php

namespace OpenCompany\Integrations\Bluesky;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * BlueskyService — HTTP client for the Bluesky AT Protocol API.
 *
 * Wraps the Bluesky XRPC endpoints used by the integration tools.
 * Authentication uses a Bearer access token passed via the
 * {@link https://atproto.com/specs/xrpc AT Protocol XRPC} Authorization header.
 */
class BlueskyService
{
    /**
     * Create a new BlueskyService instance.
     *
     * @param  string  $accessToken  Bearer token for authenticated requests.
     * @param  string  $baseUrl      Base URL of the Bluesky PDS (default: https://bsky.social).
     * @param  string  $did          The DID (Decentralised Identifier) of the authenticated user, used as the repo for posts.
     */
    public function __construct(
        private string $accessToken = '',
        private string $baseUrl = 'https://bsky.social',
        private string $did = '',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    /**
     * Check whether the service has been configured with an access token.
     */
    public function isConfigured(): bool
    {
        return !empty($this->accessToken);
    }

    /**
     * Get the DID of the authenticated account.
     */
    public function getDid(): string
    {
        return $this->did;
    }

    /**
     * Create a new post (record) in the authenticated user's repository.
     *
     * Wraps {@link POST /xrpc/com.atproto.repo.createRecord}.
     *
     * @param  array  $record  The AT Record payload (e.g. a `app.bsky.feed.post` record).
     * @return array  The API response containing `uri`, `cid`, etc.
     *
     * @see https://docs.bsky.app/docs/api/com-atproto-repo-create-record
     */
    public function createPost(array $record): array
    {
        $body = [
            'repo' => $this->did,
            'collection' => 'app.bsky.feed.post',
            'record' => $record,
        ];

        return $this->request('POST', '/xrpc/com.atproto.repo.createRecord', $body);
    }

    /**
     * Get the profile of a Bluesky user by their handle or DID.
     *
     * Wraps {@link GET /xrpc/app.bsky.actor.getProfile}.
     *
     * @param  string  $actor  Handle (e.g. "alice.bsky.social") or DID.
     * @return array  The actor profile including display name, avatar, follower counts, etc.
     *
     * @see https://docs.bsky.app/docs/api/app-bsky-actor-get-profile
     */
    public function getProfile(string $actor): array
    {
        return $this->request('GET', '/xrpc/app.bsky.actor.getProfile', [
            'actor' => $actor,
        ]);
    }

    /**
     * List followers of a given actor.
     *
     * Wraps {@link GET /xrpc/app.bsky.graph.getFollowers}.
     *
     * @param  string  $actor  Handle or DID of the user whose followers to list.
     * @param  int  $limit  Number of results per page (1–100, default 50).
     * @param  string|null  $cursor  Pagination cursor from a previous response.
     * @return array  Contains `subject`, `followers` list, and optional `cursor`.
     *
     * @see https://docs.bsky.app/docs/api/app-bsky-graph-get-followers
     */
    public function listFollowers(string $actor, int $limit = 50, ?string $cursor = null): array
    {
        $params = [
            'actor' => $actor,
            'limit' => $limit,
        ];
        if ($cursor !== null) {
            $params['cursor'] = $cursor;
        }

        return $this->request('GET', '/xrpc/app.bsky.graph.getFollowers', $params);
    }

    /**
     * List accounts that a given actor follows.
     *
     * Wraps {@link GET /xrpc/app.bsky.graph.getFollows}.
     *
     * @param  string  $actor  Handle or DID of the user whose follows to list.
     * @param  int  $limit  Number of results per page (1–100, default 50).
     * @param  string|null  $cursor  Pagination cursor from a previous response.
     * @return array  Contains `subject`, `follows` list, and optional `cursor`.
     *
     * @see https://docs.bsky.app/docs/api/app-bsky-graph-get-follows
     */
    public function listFollowing(string $actor, int $limit = 50, ?string $cursor = null): array
    {
        $params = [
            'actor' => $actor,
            'limit' => $limit,
        ];
        if ($cursor !== null) {
            $params['cursor'] = $cursor;
        }

        return $this->request('GET', '/xrpc/app.bsky.graph.getFollows', $params);
    }

    /**
     * Search for posts matching a query.
     *
     * Wraps {@link GET /xrpc/app.bsky.feed.searchPosts}.
     *
     * @param  string  $q  Search query string.
     * @param  int  $limit  Number of results per page (1–100, default 25).
     * @param  string|null  $cursor  Pagination cursor from a previous response.
     * @return array  Contains `posts` list and optional `cursor`.
     *
     * @see https://docs.bsky.app/docs/api/app-bsky-feed-search-posts
     */
    public function searchPosts(string $q, int $limit = 25, ?string $cursor = null): array
    {
        $params = [
            'q' => $q,
            'limit' => $limit,
        ];
        if ($cursor !== null) {
            $params['cursor'] = $cursor;
        }

        return $this->request('GET', '/xrpc/app.bsky.feed.searchPosts', $params);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE).
     * @param  string  $path    XRPC endpoint path (e.g. "/xrpc/app.bsky.actor.getProfile").
     * @param  array  $data     Query params (GET) or JSON body (POST/PUT/DELETE).
     * @return array  Decoded JSON response.
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);
        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Bluesky AT Protocol API.
     *
     * @param  string  $method  HTTP method.
     * @param  string  $path    XRPC endpoint path.
     * @param  array  $data     Query params or JSON body.
     * @return \Illuminate\Http\Client\Response  The raw HTTP response.
     *
     * @throws \RuntimeException  On connection failure or non-2xx response.
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->accessToken) {
            throw new \RuntimeException('Bluesky access token is not configured.');
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
                $body = $response->body();
                $error = $response->json('message') ?? $response->json('error') ?? $body;

                Log::error("Bluesky API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException(
                    "Bluesky API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error))
                );
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Bluesky API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Bluesky API: {$e->getMessage()}");
        }
    }
}
