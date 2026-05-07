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
     * Get the authenticated user's timeline.
     *
     * @param  int  $limit  Number of results per page.
     * @param  string|null  $cursor  Pagination cursor.
     * @return array<string, mixed>
     */
    public function getTimeline(int $limit = 50, ?string $cursor = null): array
    {
        return $this->xrpcGet('app.bsky.feed.getTimeline', array_filter([
            'limit' => $limit,
            'cursor' => $cursor,
        ], static fn ($value) => $value !== null && $value !== ''));
    }

    /**
     * Get posts and reposts by an actor.
     *
     * @param  string  $actor  Handle or DID.
     * @param  int  $limit  Number of results per page.
     * @param  string|null  $cursor  Pagination cursor.
     * @param  string|null  $filter  Optional Bluesky author-feed filter.
     * @return array<string, mixed>
     */
    public function getAuthorFeed(string $actor, int $limit = 50, ?string $cursor = null, ?string $filter = null): array
    {
        return $this->xrpcGet('app.bsky.feed.getAuthorFeed', array_filter([
            'actor' => $actor,
            'limit' => $limit,
            'cursor' => $cursor,
            'filter' => $filter,
        ], static fn ($value) => $value !== null && $value !== ''));
    }

    /**
     * Get posts from a feed generator URI.
     *
     * @param  string  $feed  Feed generator AT URI.
     * @param  int  $limit  Number of results per page.
     * @param  string|null  $cursor  Pagination cursor.
     * @return array<string, mixed>
     */
    public function getFeed(string $feed, int $limit = 50, ?string $cursor = null): array
    {
        return $this->xrpcGet('app.bsky.feed.getFeed', array_filter([
            'feed' => $feed,
            'limit' => $limit,
            'cursor' => $cursor,
        ], static fn ($value) => $value !== null && $value !== ''));
    }

    /**
     * Get metadata for a feed generator URI.
     *
     * @param  string  $feed  Feed generator AT URI.
     * @return array<string, mixed>
     */
    public function getFeedGenerator(string $feed): array
    {
        return $this->xrpcGet('app.bsky.feed.getFeedGenerator', ['feed' => $feed]);
    }

    /**
     * Get a post thread by root post URI.
     *
     * @param  string  $uri  Post AT URI.
     * @param  int|null  $depth  Reply depth.
     * @param  int|null  $parentHeight  Parent traversal height.
     * @return array<string, mixed>
     */
    public function getPostThread(string $uri, ?int $depth = null, ?int $parentHeight = null): array
    {
        return $this->xrpcGet('app.bsky.feed.getPostThread', array_filter([
            'uri' => $uri,
            'depth' => $depth,
            'parentHeight' => $parentHeight,
        ], static fn ($value) => $value !== null && $value !== ''));
    }

    /**
     * Get one or more posts by AT URI.
     *
     * @param  string[]  $uris  Post AT URIs.
     * @return array<string, mixed>
     */
    public function getPosts(array $uris): array
    {
        return $this->xrpcGet('app.bsky.feed.getPosts', ['uris' => $uris]);
    }

    /**
     * Get likes for a post.
     *
     * @param  string  $uri  Post AT URI.
     * @param  string|null  $cid  Optional post CID.
     * @param  int  $limit  Number of results per page.
     * @param  string|null  $cursor  Pagination cursor.
     * @return array<string, mixed>
     */
    public function getLikes(string $uri, ?string $cid = null, int $limit = 50, ?string $cursor = null): array
    {
        return $this->xrpcGet('app.bsky.feed.getLikes', array_filter([
            'uri' => $uri,
            'cid' => $cid,
            'limit' => $limit,
            'cursor' => $cursor,
        ], static fn ($value) => $value !== null && $value !== ''));
    }

    /**
     * Get actors who reposted a post.
     *
     * @param  string  $uri  Post AT URI.
     * @param  string|null  $cid  Optional post CID.
     * @param  int  $limit  Number of results per page.
     * @param  string|null  $cursor  Pagination cursor.
     * @return array<string, mixed>
     */
    public function getRepostedBy(string $uri, ?string $cid = null, int $limit = 50, ?string $cursor = null): array
    {
        return $this->xrpcGet('app.bsky.feed.getRepostedBy', array_filter([
            'uri' => $uri,
            'cid' => $cid,
            'limit' => $limit,
            'cursor' => $cursor,
        ], static fn ($value) => $value !== null && $value !== ''));
    }

    /**
     * List notifications for the authenticated account.
     *
     * @param  int  $limit  Number of results per page.
     * @param  string|null  $cursor  Pagination cursor.
     * @param  string|null  $seenAt  Optional seen timestamp.
     * @return array<string, mixed>
     */
    public function listNotifications(int $limit = 50, ?string $cursor = null, ?string $seenAt = null): array
    {
        return $this->xrpcGet('app.bsky.notification.listNotifications', array_filter([
            'limit' => $limit,
            'cursor' => $cursor,
            'seenAt' => $seenAt,
        ], static fn ($value) => $value !== null && $value !== ''));
    }

    /**
     * Create a record in the authenticated repository.
     *
     * @param  string  $collection  AT Protocol collection name.
     * @param  array<string, mixed>  $record  Record body.
     * @param  string|null  $rkey  Optional record key.
     * @return array<string, mixed>
     */
    public function createRecord(string $collection, array $record, ?string $rkey = null): array
    {
        return $this->xrpcPost('com.atproto.repo.createRecord', array_filter([
            'repo' => $this->did,
            'collection' => $collection,
            'rkey' => $rkey,
            'record' => $record,
        ], static fn ($value) => $value !== null && $value !== ''));
    }

    /**
     * Delete a record from the authenticated repository.
     *
     * @param  string  $collection  AT Protocol collection name.
     * @param  string  $rkey  Record key.
     * @return array<string, mixed>
     */
    public function deleteRecord(string $collection, string $rkey): array
    {
        return $this->xrpcPost('com.atproto.repo.deleteRecord', [
            'repo' => $this->did,
            'collection' => $collection,
            'rkey' => $rkey,
        ]);
    }

    /**
     * Like a post by creating an app.bsky.feed.like record.
     *
     * @param  string  $uri  Post AT URI.
     * @param  string  $cid  Post CID.
     * @return array<string, mixed>
     */
    public function likePost(string $uri, string $cid): array
    {
        return $this->createRecord('app.bsky.feed.like', [
            '$type' => 'app.bsky.feed.like',
            'subject' => ['uri' => $uri, 'cid' => $cid],
            'createdAt' => gmdate('c'),
        ]);
    }

    /**
     * Repost a post by creating an app.bsky.feed.repost record.
     *
     * @param  string  $uri  Post AT URI.
     * @param  string  $cid  Post CID.
     * @return array<string, mixed>
     */
    public function repostPost(string $uri, string $cid): array
    {
        return $this->createRecord('app.bsky.feed.repost', [
            '$type' => 'app.bsky.feed.repost',
            'subject' => ['uri' => $uri, 'cid' => $cid],
            'createdAt' => gmdate('c'),
        ]);
    }

    /**
     * Follow an actor by creating an app.bsky.graph.follow record.
     *
     * @param  string  $subject  Actor DID to follow.
     * @return array<string, mixed>
     */
    public function followActor(string $subject): array
    {
        return $this->createRecord('app.bsky.graph.follow', [
            '$type' => 'app.bsky.graph.follow',
            'subject' => $subject,
            'createdAt' => gmdate('c'),
        ]);
    }

    /**
     * Call any GET XRPC method.
     *
     * @param  string  $method  XRPC method ID.
     * @param  array<string, mixed>  $params  Query parameters.
     * @return array<string, mixed>
     */
    public function xrpcGet(string $method, array $params = []): array
    {
        return $this->request('GET', '/xrpc/'.$method, $params);
    }

    /**
     * Call any POST XRPC method.
     *
     * @param  string  $method  XRPC method ID.
     * @param  array<string, mixed>  $body  JSON body.
     * @return array<string, mixed>
     */
    public function xrpcPost(string $method, array $body = []): array
    {
        return $this->request('POST', '/xrpc/'.$method, $body);
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
                'GET' => $http->get($this->urlWithQuery($url, $data)),
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

    /**
     * Append XRPC query parameters while repeating array keys as required by lexicons.
     *
     * @param  array<string, mixed>  $query  Query parameters.
     */
    private function urlWithQuery(string $url, array $query): string
    {
        $parts = [];

        foreach ($query as $key => $value) {
            if ($value === null || $value === '') {
                continue;
            }

            foreach (is_array($value) ? $value : [$value] as $item) {
                if ($item === null || $item === '') {
                    continue;
                }

                $parts[] = rawurlencode((string) $key).'='.rawurlencode(is_bool($item) ? ($item ? 'true' : 'false') : (string) $item);
            }
        }

        return $parts === [] ? $url : $url.'?'.implode('&', $parts);
    }
}
